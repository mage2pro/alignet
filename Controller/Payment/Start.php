<?php
namespace Dfe\Alignet\Controller\Payment;
use Magento\Framework\Exception\LocalizedException;
class Start extends \Magento\Framework\App\Action\Action {
	/**
	 * @var \Dfe\Alignet\Model\Order
	 */
	protected $orderHelper;

	/**
	 * @var \Dfe\Alignet\Model\Session
	 */
	protected $session;

	/**
	 * @var \Dfe\Alignet\Logger\Logger
	 */
	protected $logger;

	/**
	 * @param \Magento\Framework\App\Action\Context $context
	 * @param \Dfe\Alignet\Model\ClientFactory $clientFactory
	 * @param \Dfe\Alignet\Model\Order $orderHelper
	 * @param \Dfe\Alignet\Model\Session $session
	 * @param \Dfe\Alignet\Logger\Logger $logger
	 */
	function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Dfe\Alignet\Model\Order $orderHelper,
		\Dfe\Alignet\Model\Session $session,
		\Dfe\Alignet\Logger\Logger $logger
	) {
		parent::__construct($context);
		$this->orderHelper = $orderHelper;
		$this->session = $session;
		$this->logger = $logger;
	}

	/**
	 * @return \Magento\Framework\Controller\Result\Redirect
	 */
	function execute() {
		/**
		 * @var $clientOrderHelper \Dfe\Alignet\Model\Client\OrderInterface
		 * @var $resultRedirect \Magento\Framework\Controller\Result\Redirect
		 */
		$resultRedirect = $this->resultRedirectFactory->create();
		$redirectUrl = 'checkout/cart';
		$redirectParams = [];
		$orderId = $this->orderHelper->getOrderIdForPaymentStart();
		if ($orderId) {
			$order = $this->orderHelper->loadOrderById($orderId);
			if ($this->orderHelper->canStartFirstPayment($order)) {
				try {
					$client = $this->clientFactory->create();
					$clientOrderHelper = $client->getOrderHelper();
					$orderData = $clientOrderHelper->getDataForOrderCreate($order);
					$result = $client->orderCreate($orderData);
					$this->orderHelper->addNewOrderTransaction(
						$order,
						$result['orderId'],
						$result['extOrderId'],
						$clientOrderHelper->getNewStatus()
					);
					$this->orderHelper->setNewOrderStatus($order);

					$configHelper = $client->getConfigHelper();

					$this->session->setGatewayUrl($configHelper->getConfig('url'));
					$this->session->setPaymeEntorno($configHelper->getConfig('payme_entorno'));
					$this->session->setWsDomain($configHelper->getConfig('wsdomain'));

					  $order->setState(\Magento\Sales\Model\Order::STATE_PENDING_PAYMENT, true)->save();
			$order->setStatus(\Magento\Sales\Model\Order::STATE_PENDING_PAYMENT, true)->save();
			$order->save();

					$redirectUrl = $result['redirectUri'];
				} catch (LocalizedException $e) {
					$this->logger->critical($e);
					$redirectUrl = 'paymecheckout/payment/end';
					$redirectParams = ['exception' => '1'];
				}
				$this->session->setLastOrderId($orderId);
			}
		}
		$resultRedirect->setPath($redirectUrl, $redirectParams);
		return $resultRedirect;
	}
}
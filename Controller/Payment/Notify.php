<?php
namespace Dfe\Alignet\Controller\Payment;
use Magento\Framework\Exception\LocalizedException;
class Notify extends \Magento\Framework\App\Action\Action {
	/**
	 * @var \Magento\Framework\App\Action\Context
	 */
	protected $context;

	/**
	 * @var \Magento\Framework\Controller\Result\ForwardFactory
	 */
	protected $resultForwardFactory;

	/**
	 * @var \Dfe\Alignet\Logger\Logger
	 */
	protected $logger;

	/**
	 * @param \Magento\Framework\App\Action\Context $context
	 * @param \Dfe\Alignet\Model\ClientFactory $clientFactory
	 * @param \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory
	 * @param \Dfe\Alignet\Logger\Logger $logger
	 */
	function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory,
		\Dfe\Alignet\Logger\Logger $logger
	) {
		parent::__construct($context);
		$this->context = $context;
		$this->resultForwardFactory = $resultForwardFactory;
		$this->logger = $logger;
	}

	function execute()
	{
		/**
		 * @var $client \Dfe\Alignet\Model\Client
		 */
		$request = $this->context->getRequest();
		try {
			$client = dfe_alignet_cl();
			$response = $client->orderConsumeNotification($request);
			$clientOrderHelper = $client->getOrderHelper();
			if ($clientOrderHelper->canProcessNotification($response['referenceCode'])) {
				return $clientOrderHelper->processNotification(
					$response['referenceCode'],
					$response['status'],
					$response['amount']
				);
			}
		} catch (LocalizedException $e) {
			$this->logger->critical($e);
		}
		/**
		 * @var $resultForward \Magento\Framework\Controller\Result\Forward
		 */
		$resultForward = $this->resultForwardFactory->create();
		$resultForward->forward('noroute');
		return $resultForward;
	}
}
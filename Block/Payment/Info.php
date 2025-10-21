<?php
namespace Dfe\Alignet\Block\Payment;
class Info extends \Magento\Payment\Block\Info {
	/**
	 * @var \Dfe\Alignet\Model\ResourceModel\Transaction
	 */
	protected $transactionResource;

	/**
	 * @param \Magento\Framework\View\Element\Template\Context $context
	 * @param \Dfe\Alignet\Model\ResourceModel\Transaction $transactionResource
	 * @param \Dfe\Alignet\Model\ClientFactory $clientFactory
	 * @param array $data
	 */
	function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Dfe\Alignet\Model\ResourceModel\Transaction $transactionResource,
		\Dfe\Alignet\Model\ClientFactory $clientFactory,
		array $data = []
	) {
		parent::__construct($context, $data);
		$this->transactionResource = $transactionResource;
		$this->clientFactory = $clientFactory;
	}

	protected function _prepareLayout()
	{
		$this->addChild('buttons', Info\Buttons::class);
		parent::_prepareLayout();
	}

	protected function _prepareSpecificInformation($transport = null)
	{
		/**
		 * @var $client \Dfe\Alignet\Model\Client
		 */
		$transport = parent::_prepareSpecificInformation($transport);
		$orderId = $this->getInfo()->getParentId();
		$status = $this->transactionResource->getLastStatusByOrderId($orderId);
		$client = $this->clientFactory->create();
		$statusDescription = $client->getOrderHelper()->getStatusDescription($status);
		$transport->setData((string) __('Status'), $statusDescription);
		return $transport;
	}
}
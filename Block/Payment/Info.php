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
	 * @param array $data
	 */
	function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Dfe\Alignet\Model\ResourceModel\Transaction $transactionResource,
		array $data = []
	) {
		parent::__construct($context, $data);
		$this->transactionResource = $transactionResource;
	}

	protected function _prepareLayout()
	{
		$this->addChild('buttons', Info\Buttons::class);
		parent::_prepareLayout();
	}

	protected function _prepareSpecificInformation($transport = null) {
		$transport = parent::_prepareSpecificInformation($transport);
		$orderId = $this->getInfo()->getParentId();
		$status = $this->transactionResource->getLastStatusByOrderId($orderId);
		$statusDescription = dfe_alignet_cl()->getOrderHelper()->getStatusDescription($status);
		$transport->setData((string) __('Status'), $statusDescription);
		return $transport;
	}
}
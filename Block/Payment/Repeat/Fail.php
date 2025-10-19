<?php
namespace Dfe\Alignet\Block\Payment\Repeat;
class Fail extends \Magento\Framework\View\Element\Template {
	/**
	 * @var \Dfe\Alignet\Helper\Payment
	 */
	protected $paymentHelper;

	/**
	 * @var \Dfe\Alignet\Model\Session
	 */
	protected $session;

	function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Dfe\Alignet\Model\Session $session,
		\Dfe\Alignet\Helper\Payment $paymentHelper,
		array $data = []
	) {
		parent::__construct(
			$context,
			$data
		);
		$this->session = $session;
		$this->paymentHelper = $paymentHelper;
	}

	/**
	 * @return string|false
	 */
	function getPaymentUrl()
	{
		$orderId = $this->session->getLastOrderId();
		if ($orderId) {
			$repeatPaymentUrl = $this->paymentHelper->getRepeatPaymentUrl($orderId);
			if (!$repeatPaymentUrl) {
				return $this->paymentHelper->getStartPaymentUrl($orderId);
			}
			return $repeatPaymentUrl;
		}
		return false;
	}
}
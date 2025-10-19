<?php
namespace Dfe\Alignet\Controller\Payment;
class Repeat extends \Magento\Framework\App\Action\Action {
	/**
	 * @var \Magento\Framework\App\Action\Context
	 */
	protected $context;

	/**
	 * @var \Dfe\Alignet\Helper\Payment
	 */
	protected $paymentHelper;

	/**
	 * @var \Dfe\Alignet\Model\Session
	 */
	protected $session;

	function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Dfe\Alignet\Helper\Payment $paymentHelper,
		\Dfe\Alignet\Model\Session $session
	) {
		parent::__construct($context);
		$this->context = $context;
		$this->paymentHelper = $paymentHelper;
		$this->session = $session;
	}

	function execute()
	{
		$resultRedirect = $this->resultRedirectFactory->create();
		return $resultRedirect;
	}
}
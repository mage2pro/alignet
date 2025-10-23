<?php
namespace Dfe\Alignet\Controller\Payment;
use Dfe\Alignet\Model\Client as Cl;
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

	function execute() {
		try {
			$cl = dfe_alignet_cl(); /** @var Cl $cl */
			$response = $cl->orderConsumeNotification($this->context->getRequest());
			$clientOrderHelper = $cl->getOrderHelper();
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
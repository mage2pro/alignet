<?php
/**
 *
 */

namespace Dfe\Alignet\Controller\Payment;

use Magento\Framework\Exception\LocalizedException;

class End extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Checkout\Model\Session\SuccessValidator
     */
    protected $successValidator;

    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $checkoutSession;

    /**
     * @var \Dfe\Alignet\Model\Session
     */
    protected $session;

    /**
     * @var \Magento\Framework\App\Action\Context
     */
    protected $context;

    /**
     * @var \Dfe\Alignet\Model\Order
     */
    protected $orderHelper;

    /**
     * @var \Dfe\Alignet\Logger\Logger
     */
    protected $logger;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Checkout\Model\Session\SuccessValidator $successValidator
     * @param \Magento\Checkout\Model\Session $checkoutSession
     * @param \Dfe\Alignet\Model\Session $session
     * @param \Dfe\Alignet\Model\Order $orderHelper
     * @param \Dfe\Alignet\Logger\Logger $logger
     */
    function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Checkout\Model\Session\SuccessValidator $successValidator,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Dfe\Alignet\Model\Session $session,
        \Dfe\Alignet\Model\Order $orderHelper,
        \Dfe\Alignet\Logger\Logger $logger
    ) {
        parent::__construct($context);
        $this->context = $context;
        $this->successValidator = $successValidator;
        $this->checkoutSession = $checkoutSession;
        $this->session = $session;
        $this->orderHelper = $orderHelper;
        $this->logger = $logger;
    }

    /**
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    function execute() {
        $resultPage = $this->resultPageFactory->create();
        $data = ['message' => 'Hello world!'];
        $this->session->setPostdata($data);
        $resultPage->getLayout()->getBlock('paymecheckout.payment.end')->setPostdata($data);
        return $resultPage;
    }

    /**
     * @return \Dfe\Alignet\Model\Client\OrderInterface
     */
    protected function getClientOrderHelper() {return dfe_alignet_cl()->getOrderHelper();}
}
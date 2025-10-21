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
     * @param \Dfe\Alignet\Model\ClientFactory $clientFactory
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
    function execute()
    {
        /**
         * @var $clientOrderHelper \Dfe\Alignet\Model\Client\OrderInterface
         */



        // $resultRedirect = $this->resultRedirectFactory->create();
        // $redirectUrl = '/';
        // try {
        //     if ($this->successValidator->isValid()) {
        //         $redirectUrl = 'payme/payment/error';
        //         $this->session->setLastOrderId(null);
        //         $clientOrderHelper = $this->getClientOrderHelper();
        //         if ($this->orderHelper->paymentSuccessCheck() && $clientOrderHelper->paymentSuccessCheck()) {
        //             $redirectUrl = 'checkout/onepage/success';
        //         }

        //     } else {
        //         if ($this->session->getLastOrderId()) {
        //             $redirectUrl = 'payme/payment/repeat_error';
        //             $clientOrderHelper = $this->getClientOrderHelper();
        //             if ($this->orderHelper->paymentSuccessCheck() && $clientOrderHelper->paymentSuccessCheck()) {
        //                 $redirectUrl = 'payme/payment/repeat_success';
        //             }
        //         }
        //     }
        // } catch (LocalizedException $e) {
        //     $this->logger->critical($e);
        // }
        // $resultRedirect->setPath($redirectUrl);


        $resultPage = $this->resultPageFactory->create();
        $data = ['message' => 'Hello world!'];
        $this->session->setPostdata($data);
        $postdata = $this->session->getPostdata();
        $resultPage->getLayout()->getBlock('paymecheckout.payment.end')->setPostdata($data);
        return $resultPage;
        
        // return $resultRedirect;
    }

    /**
     * @return \Dfe\Alignet\Model\Client\OrderInterface
     */
    protected function getClientOrderHelper()
    {
        return $this->clientFactory->create()->getOrderHelper();
    }
}
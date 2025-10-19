<?php
/**
 *
 */

namespace Dfe\Alignet\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Payment extends AbstractHelper
{
    /**
     * @var \Dfe\Alignet\Model\ResourceModel\Transaction
     */
    protected $transactionResource;

    /**
     * @var \Dfe\Alignet\Model\Order
     */
    protected $orderHelper;

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Dfe\Alignet\Model\ResourceModel\Transaction $transactionResource
     */
    function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Dfe\Alignet\Model\ResourceModel\Transaction $transactionResource,
        \Dfe\Alignet\Model\Order $orderHelper
    ) {
        parent::__construct($context);
        $this->transactionResource = $transactionResource;
        $this->orderHelper = $orderHelper;
    }

    /**
     * @param int $orderId
     * @return string|false
     */
    function getStartPaymentUrl($orderId)
    {
        $order = $this->orderHelper->loadOrderById($orderId);
        
        if ($order && $this->orderHelper->canStartFirstPayment($order)) {
            return $this->_urlBuilder->getUrl('paymecheckout/payment/start', ['id' => $orderId]);
        }
        return false;
    }

    /**
     * @param int $orderId
     * @return string|false
     */
    function getRepeatPaymentUrl($orderId)
    {
        $order = $this->orderHelper->loadOrderById($orderId);
        if ($order && $this->orderHelper->canRepeatPayment($order)) {
            return $this->_urlBuilder->getUrl(
                'paymecheckout/payment/repeat',
                ['id' => $this->transactionResource->getLastPayuplOrderIdByOrderId($orderId)]
            );
        }
        return false;
    }

    /**
     * @param string $paymecheckoutOrderId
     * @return bool
     */
    function getOrderIdIfCanRepeat($paymecheckoutOrderId = null)
    {
        if ($paymecheckoutOrderId && $this->transactionResource->checkIfNewestByPayuplOrderId($paymecheckoutOrderId)) {
            return $this->transactionResource->getOrderIdByPayuplOrderId($paymecheckoutOrderId);
        }
        return false;
    }
}

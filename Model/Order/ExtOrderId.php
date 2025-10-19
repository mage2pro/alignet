<?php
/**
 *
 */

namespace Dfe\Alignet\Model\Order;

class ExtOrderId
{
    /**
     * @var \Dfe\Alignet\Model\ResourceModel\Transaction
     */
    protected $transactionResource;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $dateTime;

    /**
     * @param \Dfe\Alignet\Model\ResourceModel\Transaction $transactionResource
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $dateTime
     */
    function __construct(
        \Dfe\Alignet\Model\ResourceModel\Transaction $transactionResource,
        \Magento\Framework\Stdlib\DateTime\DateTime $dateTime
    ) {
        $this->transactionResource = $transactionResource;
        $this->dateTime = $dateTime;
    }

    /**
     * @param \Magento\Sales\Model\Order $order
     * @return string
     */
    function generate(\Magento\Sales\Model\Order $order)
    {
        $try = $this->transactionResource->getLastTryByOrderId($order->getId()) + 1;
        return $order->getIncrementId() . ':' . $this->dateTime->timestamp() . ':' . $try;
    }
}

<?php
namespace Dfe\Alignet\Model;
# 2025-09-23 Dmitrii Fediuk https://github.com/dmitrii-fediuk
# "Refactor the `Alignet_Paymecheckout` module": https://github.com/innomuebles/m2/issues/10
/**
 * @method int getLastOrderId()
 * @method Session setLastOrderId(int)
 * @method array getOrderCreateData()
 * @method Session setOrderCreateData(array)
 */
class Session extends \Magento\Framework\Session\SessionManager
{

}
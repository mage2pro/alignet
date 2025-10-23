<?php
use Dfe\Alignet\Cfg;
use Dfe\Alignet\Model\Client\Classic as Cl;
use Dfe\Alignet\Model\Session as S;

/**
 * 2025-10-22 Dmitrii Fediuk https://upwork.com/fl/mage2pro
 * "Delete `Dfe\Alignet\Model\ClientFactory`": https://github.com/mage2pro/alignet/issues/9
 * @used-by \Dfe\Alignet\Block\Payment\Info::_prepareSpecificInformation()
 * @used-by \Dfe\Alignet\Controller\Payment\End::getClientOrderHelper()
 * @used-by \Dfe\Alignet\Controller\Payment\Notify::execute()
 * @used-by \Dfe\Alignet\Controller\Payment\Start::execute()
 */
function dfe_alignet_cl() {return df_new_om(Cl::class);}

/**
 * 2025-10-22 Dmitrii Fediuk https://upwork.com/fl/mage2pro
 * "Refactor `Dfe\Alignet\Model\Client\ConfigInterface` as it currently has only one implementation":
 * https://github.com/mage2pro/alignet/issues/6
 * @used-by \Dfe\Alignet\Model\Client\Classic\Order\DataGetter::getAccountId()
 * @used-by \Dfe\Alignet\Model\Client\Classic\Order\DataGetter::getBasicData()
 * @used-by \Dfe\Alignet\Model\Client\Classic\Order\DataGetter::getMerchantId()
 * @used-by \Dfe\Alignet\Model\Client\Classic\Order\DataGetter::getSigForOrderCreate()
 * @used-by \Dfe\Alignet\Model\Client\Classic\Order\DataGetter::getSigForOrderRetrieve()
 * @used-by \Dfe\Alignet\Model\Client\Classic\Order\DataGetter::getTestMode()
 * @used-by \Dfe\Alignet\Model\Client\Classic\Order\DataGetter::userCodePayme()
 * @used-by \Dfe\Alignet\Model\Client\Classic\Order\Notification::getPayuplOrderId()
 * @used-by vendor/mage2pro/alignet/view/frontend/templates/classic/form.phtml
 */
function dfe_alignet_cfg() {return Cfg::s();}

/**
 * 2025-09-23 Dmitrii Fediuk https://upwork.com/fl/mage2pro
 * "Refactor the `Alignet_Paymecheckout` module": https://github.com/innomuebles/m2/issues/10
 */
function dfe_alignet_payme_sess() {return df_o(S::class);}
<?php
use Dfe\Alignet\Model\Client\Classic as C;
use Dfe\Alignet\Model\Session as S;

/**
 * 2025-10-22 Dmitrii Fediuk https://upwork.com/fl/mage2pro
 * "Delete `Dfe\Alignet\Model\ClientFactory`": https://github.com/mage2pro/alignet/issues/9
 * @used-by \Dfe\Alignet\Block\Payment\Info::_prepareSpecificInformation()
 * @used-by \Dfe\Alignet\Controller\Payment\End::getClientOrderHelper()
 * @used-by \Dfe\Alignet\Controller\Payment\Notify::execute()
 * @used-by \Dfe\Alignet\Controller\Payment\Start::execute()
 */
function dfe_alignet_cl() {return df_new_om(C::class);}

/**
 * 2025-09-23 Dmitrii Fediuk https://upwork.com/fl/mage2pro
 * "Refactor the `Alignet_Paymecheckout` module": https://github.com/innomuebles/m2/issues/10
 */
function dfe_alignet_payme_sess() {return df_o(S::class);}
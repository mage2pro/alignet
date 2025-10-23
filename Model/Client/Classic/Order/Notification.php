<?php
namespace Dfe\Alignet\Model\Client\Classic\Order;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Phrase;
class Notification {
	/**
	 * @used-by \Dfe\Alignet\Model\Client\Classic\Order::consumeNotification()
	 */
    function getPayuplOrderId($request) {
        if (!$request->isPost()) {
            throw new LocalizedException(new Phrase('POST request is required.'));
        }
        $sig = $request->getParam('sig');
        $ts = $request->getParam('ts');
        $posId = $request->getParam('pos_id');
        $sessionId = $request->getParam('referenceCode');
		# 2025-10-23
		# "`Dfe\Alignet\Model\Client\Classic\Order\Notification::getPayuplOrderId()`
		# attempts to retrieve the value of the missing configuration option `second_key_md5`":
		# https://github.com/mage2pro/alignet/issues/17
        $secondKeyMd5 = dfe_alignet_cfg()->getConfig('second_key_md5');
        if (md5($posId . $sessionId . $ts . $secondKeyMd5) === $sig) {
            return $sessionId;
        }
        throw new LocalizedException(new Phrase('Invalid SIG.'));
    }
}

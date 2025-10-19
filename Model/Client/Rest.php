<?php
namespace Dfe\Alignet\Model\Client;
use Dfe\Alignet\Model\Client\Rest\Config;
use Dfe\Alignet\Model\Client\Rest\Order;
final class Rest extends \Dfe\Alignet\Model\Client {
	/**
	 * @param Config $configHelper
	 * @param Order $orderHelper
	 */
	function __construct(Config $configHelper, Order $orderHelper) {
		parent::__construct(
			$configHelper,
			$orderHelper
		);
	}
}
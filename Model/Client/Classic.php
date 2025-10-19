<?php
namespace Dfe\Alignet\Model\Client;
use Dfe\Alignet\Model\Client\Classic\Config;
use Dfe\Alignet\Model\Client\Classic\Order;
final class Classic extends \Dfe\Alignet\Model\Client {
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
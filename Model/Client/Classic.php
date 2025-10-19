<?php
namespace Dfe\Alignet\Model\Client;
final class Classic extends \Dfe\Alignet\Model\Client {
	/**
	 * @param Classic\Config $configHelper
	 * @param Classic\Order $orderHelper
	 */
	function __construct(
		Classic\Config $configHelper,
		Classic\Order $orderHelper
	) {
		parent::__construct(
			$configHelper,
			$orderHelper
		);
	}
}
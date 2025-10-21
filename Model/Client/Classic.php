<?php
namespace Dfe\Alignet\Model\Client;
use Dfe\Alignet\Cfg;
use Dfe\Alignet\Model\Client\Classic\Order;
/** @used-by dfe_alignet_cl() */
final class Classic extends \Dfe\Alignet\Model\Client {
	/**
	 * @param Order $orderHelper
	 */
	function __construct(Order $orderHelper) {parent::__construct($orderHelper);}
}
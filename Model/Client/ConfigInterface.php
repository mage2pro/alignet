<?php
namespace Dfe\Alignet\Model\Client;
/**
 * @see \Dfe\Alignet\Model\Client\Classic\Config
 */
interface ConfigInterface {
	/**
	 * @see \Dfe\Alignet\Model\Client\Classic\Config::getConfig()
	 */
    function getConfig($key);

	/**
	 * @see \Dfe\Alignet\Model\Client\Classic\Config::setConfig()
	 */
	function setConfig();
}

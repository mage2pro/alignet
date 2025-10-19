<?php
namespace Dfe\Alignet\Model\Client;
/**
 * @see \Dfe\Alignet\Model\Client\Classic\Config
 * @see \Dfe\Alignet\Model\Client\Rest\Config
 */
interface ConfigInterface {
    function setConfig();

	/**
	 * @see \Dfe\Alignet\Model\Client\Classic\Config::getConfig()
	 * @see \Dfe\Alignet\Model\Client\Rest\Config::getConfig()
	 */
    function getConfig($key);
}

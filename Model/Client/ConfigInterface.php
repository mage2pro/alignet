<?php
namespace Dfe\Alignet\Model\Client;
/**
 * @see \Dfe\Alignet\Model\Client\Classic\Config
 * @see \Dfe\Alignet\Model\Client\Rest\Config
 */
interface ConfigInterface {
    function setConfig();

    function getConfig($key);
}

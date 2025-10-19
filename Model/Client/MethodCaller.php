<?php
/**
 *
 */

namespace Dfe\Alignet\Model\Client;

use Dfe\Alignet\Model\Client\MethodCallerInterface;

class MethodCaller implements MethodCallerInterface
{
    /**
     * @var MethodCaller\RawInterface
     */
    protected $_rawMethod;

    /**
     * @var \Dfe\Alignet\Logger\Logger
     */
    protected $_logger;

    /**
     * @param MethodCaller\RawInterface $rawMethod
     * @param \Dfe\Alignet\Logger\Logger $logger
     */
    function __construct(
        MethodCaller\RawInterface $rawMethod,
        \Dfe\Alignet\Logger\Logger $logger
    ) {
        $this->_rawMethod = $rawMethod;
        $this->_logger = $logger;
    }

    /**
     * @param string $methodName
     * @param array $args
     * @return \stdClass|false
     */
    function call($methodName, array $args = [])
    {
        try {
            return $this->_rawMethod->call($methodName, $args);
        } catch (\Exception $e) {
            $this->_logger->critical($e);
            return false;
        }
    }
}

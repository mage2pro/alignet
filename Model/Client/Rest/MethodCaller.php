<?php
/**
 *
 */

namespace Dfe\Alignet\Model\Client\Rest;

class MethodCaller extends \Dfe\Alignet\Model\Client\MethodCaller
{
    function __construct(
        MethodCaller\Raw $rawMethod,
        \Dfe\Alignet\Logger\Logger $logger
    ) {
        parent::__construct(
            $rawMethod,
            $logger
        );
    }
}

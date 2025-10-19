<?php
/**
 *
 */

namespace Dfe\Alignet\Model\Client\Classic\Order;

class DataValidator extends \Dfe\Alignet\Model\Client\DataValidator
{
    /**
     * @var array
     */
    protected $requiredBasicKeys = [
        'idEntCommerce'
       
    ];

    /**
     * @param array $data
     * @return bool
     */
    function validateBasicData(array $data = [])
    {

        return true;
    }

    /**
     * @return array
     */
    protected function getRequiredBasicKeys()
    {
        return $this->requiredBasicKeys;
    }
}

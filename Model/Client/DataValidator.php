<?php
/**
 *
 */

namespace Dfe\Alignet\Model\Client;

class DataValidator
{
    /**
     * @param mixed $data
     * @return bool
     */
    function validateEmpty($data)
    {
        return !empty($data);
    }

    /**
     * @param mixed $value
     * @return bool
     */
    function validatePositiveInt($value)
    {
        return is_integer($value) && $value > 0;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    function validatePositiveFloat($value)
    {
        return (is_integer($value) || is_float($value)) && $value > 0;
    }
}

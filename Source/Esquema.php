<?php
namespace Dfe\Alignet\Source;
use Magento\Framework\Option\ArrayInterface;
class Esquema implements ArrayInterface
{
    /**
     * To option array
     *
     * @return array
     */
    function toOptionArray()
    {
        return [
            [
                'value' => '0',
                'label' => 'Redirect'
            ],
            // [
            //     'value' => '1',
            //     'label' => 'Modal'
            // ]
        ];
    }
}

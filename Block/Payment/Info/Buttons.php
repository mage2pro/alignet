<?php
namespace Dfe\Alignet\Block\Payment\Info;
class Buttons extends \Magento\Framework\View\Element\Template {
	protected $_template = 'payment/info/buttons.phtml';

	function getOrderId()
	{
		return $this->getParentBlock()->getInfo()->getOrder()->getId();
	}
}
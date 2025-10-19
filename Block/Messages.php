<?php
namespace Dfe\Alignet\Block;
class Messages extends \Magento\Framework\View\Element\Messages {
	protected function _prepareLayout()
	{
		$this->addMessages($this->messageManager->getMessages(true));
		return parent::_prepareLayout();
	}
}
<?php
namespace Dfe\Alignet\Model;
use Dfe\Alignet\Model\Client\Classic;
class ClientFactory {
    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     */
    function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->objectManager = $objectManager;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @param array $data
     * @return object
     */
    function create(array $data = []) {return $this->objectManager->create(Classic::class, []);}
}

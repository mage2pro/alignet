<?php
namespace Dfe\Alignet\Model;
use Magento\Payment\Model\Method\AbstractMethod;
class Paymecheckout  extends AbstractMethod {
	const CODE = 'paymecheckout';
    const XML_PATH_API_KEY              = 'payment/payme/ApiKey';
    const XML_PATH_API_LOGIN       = 'payment/payme/ApiLogin';
    const XML_PATH_TEST       = 'payment/payme/test';
     const XML_PATH_PAYME_DEBUG      = 'payment/payme_gateway/main_parameters/payme_debug';
    const XML_PATH_PAYME_ENVIROMENT       = 'payment/payme_environment';
    protected $_isGateway = true;
    protected $_canCapture = true;
    protected $_canCapturePartial = true;
    protected $_canRefund = false;
    protected $_canRefundInvoicePartial = false;
    protected $_stripeApi = false;

    /**
     * @var string
    */
    protected $_code = self::CODE;

    protected $_supportedCurrencyCodes = array('ARS','BRL','CLP','COP','MXN','PEN','USD');
    protected $urlBuilder;

    function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Api\ExtensionAttributesFactory $extensionFactory,
        \Magento\Framework\Api\AttributeValueFactory $customAttributeFactory,
        \Magento\Payment\Helper\Data $paymentData,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Payment\Model\Method\Logger $logger,
        \Magento\Framework\UrlInterface $urlBuilder,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $registry,
            $extensionFactory,
            $customAttributeFactory,
            $paymentData,
            $scopeConfig,
            $logger,
            null,
            null,
            $data
        );

        $this->urlBuilder = $urlBuilder;

    }


    function canUseForCurrency($currencyCode)
    {
        // if (!in_array($currencyCode, $this->_supportedCurrencyCodes)) {
        //     return false;
        // }
        return true;
    }



}
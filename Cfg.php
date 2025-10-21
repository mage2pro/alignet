<?php
namespace Dfe\Alignet;
use Magento\Framework\Exception\LocalizedException;
use Dfe\Alignet\Model\Paymecheckout;
/** @used-by dfe_alignet_cfg() */
final class Cfg {
	/**
	 * @var \Magento\Framework\App\Config\ScopeConfigInterface
	 */
	protected $scopeConfig;

	/**
	 * @var string
	 */
	protected $url;

	/**
	 * @var string
	 */
	protected $payme_adquir_id;

   /**
	 * @var string
	 */
	protected $payme_comerce_id;

	  /**
	 * @var string
	 */
	protected $payme_vpos_id;

	  /**
	 * @var string
	 */
	protected $payme_wallet_id;

	  /**
	 * @var string
	 */
	protected $payme_wallet_secret;

	protected $test;

	 /**
	 * @var string
	 */
	protected $payme_adquir_id_dls;

   /**
	 * @var string
	 */
	protected $payme_comerce_id_dls;

	  /**
	 * @var string
	 */
	protected $payme_vpos_id_dls;

	  /**
	 * @var string
	 */
	protected $payme_wallet_id_dls;

	  /**
	 * @var string
	 */
	protected $payme_wallet_secret_dls;


	protected $payme_debug;
	protected $payme_entorno;
	protected $wsdomain;
	protected $wsdl;

	/**
	 * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
	 */
	function __construct(
		\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
	) {
		$this->scopeConfig = $scopeConfig;
	}

	/**
	 * @used-by \Dfe\Alignet\Model\Client::__construct()
	 * @throws LocalizedException
	 */
	function setConfig():void {
		$this->payme_entorno = $this->scopeConfig->getValue('payment/payme_gateway/main_parameters/payme_environment', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
		switch ($this->payme_entorno) {
			case 0:
				$this->wsdomain = 'https://integracion.alignetsac.com';
				$this->wsdl = $this->wsdomain.'/WALLETWS/services/WalletCommerce?wsdl';
				$this->url = "https://integracion.alignetsac.com/VPOS2/faces/pages/startPayme.xhtml";
				break;
			case 1:
				$this->wsdomain = 'https://vpayment.verifika.com';
				$this->wsdl = "https://www.pay-me.pe/WALLETWS/services/WalletCommerce?wsdl";
				$this->url = "https://vpayment.verifika.com/VPOS2/faces/pages/startPayme.xhtml";
				break;
		}
		$payme_adquir_id = $this->scopeConfig->getValue(Paymecheckout::XML_PATH_PAYME_ADQUIR_ID, 'store');
		if ($payme_adquir_id) {
			$this->payme_adquir_id = $payme_adquir_id;
		}
		$payme_comerce_id = $this->scopeConfig->getValue(Paymecheckout::XML_PATH_PAYME_COMERCE_ID, 'store');
		if ($payme_comerce_id) {
			$this->payme_comerce_id = $payme_comerce_id;
		}
		 $payme_vpos_id = $this->scopeConfig->getValue(Paymecheckout::XML_PATH_PAYME_VPOS_ID, 'store');
		if ($payme_vpos_id) {
			$this->payme_vpos_id = $payme_vpos_id;
		}
		$payme_wallet_id = $this->scopeConfig->getValue(Paymecheckout::XML_PATH_PAYME_WALLET_ID, 'store');
		if ($payme_wallet_id) {
			$this->payme_wallet_id = $payme_wallet_id;
		}
		$payme_wallet_secret = $this->scopeConfig->getValue(Paymecheckout::XML_PATH_PAYME_WALLET_SECRET, 'store');
		if ($payme_wallet_secret) {
			$this->payme_wallet_secret = $payme_wallet_secret;
		}
		$payme_adquir_id_dls = $this->scopeConfig->getValue(Paymecheckout::XML_PATH_PAYME_ADQUIR_ID_DLS, 'store');
		if ($payme_adquir_id_dls) {
			$this->payme_adquir_id_dls = $payme_adquir_id_dls;
		}
		$payme_comerce_id_dls = $this->scopeConfig->getValue(Paymecheckout::XML_PATH_PAYME_COMERCE_ID_DLS, 'store');
		if ($payme_comerce_id_dls) {
			$this->payme_comerce_id_dls = $payme_comerce_id_dls;
		}
		 $payme_vpos_id_dls = $this->scopeConfig->getValue(Paymecheckout::XML_PATH_PAYME_VPOS_ID_DLS, 'store');
		if ($payme_vpos_id_dls) {
			$this->payme_vpos_id_dls = $payme_vpos_id_dls;
		}
		$payme_wallet_id_dls = $this->scopeConfig->getValue(Paymecheckout::XML_PATH_PAYME_WALLET_ID_DLS, 'store');
		if ($payme_wallet_id_dls) {
			$this->payme_wallet_id_dls = $payme_wallet_id_dls;
		}
		$payme_wallet_secret_dls = $this->scopeConfig->getValue(Paymecheckout::XML_PATH_PAYME_WALLET_SECRET_DLS, 'store');
		if ($payme_wallet_secret_dls) {
			$this->payme_wallet_secret_dls = $payme_wallet_secret_dls;
		}
	}

	/**
	 * @param string|null $key
	 * @return string|array
	 */
	function getConfig($key = null) {
		 $config = [
			'test' => $this->test,
			'url' => $this->url,
			'wsdl' => $this->wsdl,
			'idEntCommerce' => $this->payme_wallet_id,
			'keywallet' => $this->payme_wallet_secret,
			'acquirerId' => $this->payme_adquir_id,
			'idCommerce' => $this->payme_comerce_id,
			'key' => $this->payme_vpos_id,
			'idEntCommerce_usd' => $this->payme_wallet_id_dls,
			'keywallet_usd' => $this->payme_wallet_secret_dls,
			'acquirerId_usd' => $this->payme_adquir_id_dls,
			'idCommerce_usd' => $this->payme_comerce_id_dls,
			'key_usd' => $this->payme_vpos_id_dls,
			'payme_entorno' => $this->payme_entorno,
			'wsdomain' => $this->wsdomain
			// 'payme_debug' => $this->payme_debug;
		];
		if ($key) {
			return $config[$key];
		}
		return $config;
	}
}
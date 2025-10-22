<?php
namespace Dfe\Alignet;
use Dfe\Alignet\Model\Paymecheckout;
/** @used-by dfe_alignet_cfg() */
final class Cfg {
	/**
	 * @param string|null $key
	 * @return string|array
	 */
	function getConfig($key = null) {
		 $config = [
			'test' => null,
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
		];
		if ($key) {
			return $config[$key];
		}
		return $config;
	}

	/**
	 * @used-by self::s()
	 */
	private function __construct() {
		$this->payme_entorno = df_cfg('payment/payme_gateway/main_parameters/payme_environment');
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
		$payme_adquir_id = df_cfg(Paymecheckout::XML_PATH_PAYME_ADQUIR_ID);
		if ($payme_adquir_id) {
			$this->payme_adquir_id = $payme_adquir_id;
		}
		$payme_comerce_id = df_cfg(Paymecheckout::XML_PATH_PAYME_COMERCE_ID);
		if ($payme_comerce_id) {
			$this->payme_comerce_id = $payme_comerce_id;
		}
		 $payme_vpos_id = df_cfg(Paymecheckout::XML_PATH_PAYME_VPOS_ID);
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
	 * @var string
	 */
	private $url;

	/**
	 * @var string
	 */
	private $payme_adquir_id;

   /**
	 * @var string
	 */
	private $payme_comerce_id;

	  /**
	 * @var string
	 */
	private $payme_vpos_id;

	  /**
	 * @var string
	 */
	private $payme_wallet_id;

	  /**
	 * @var string
	 */
	private $payme_wallet_secret;

	 /**
	 * @var string
	 */
	private $payme_adquir_id_dls;

   /**
	 * @var string
	 */
	private $payme_comerce_id_dls;

	  /**
	 * @var string
	 */
	private $payme_vpos_id_dls;

	  /**
	 * @var string
	 */
	private $payme_wallet_id_dls;

	  /**
	 * @var string
	 */
	private $payme_wallet_secret_dls;

	private $payme_debug;
	private $payme_entorno;
	private $wsdomain;
	private $wsdl;

	/**
	 * 2025-10-22
	 * @used-by dfe_alignet_cfg()
	 */
	static function s():self {static $r; return $r ? $r : $r = new self;}
}
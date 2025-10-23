<?php
namespace Dfe\Alignet;
use Df\Core\O;
/** @used-by dfe_alignet_cfg() */
final class Cfg {
	/**
	 * 2025-10-22
	 * @used-by self::urlStart()
	 * @used-by vendor/mage2pro/alignet/view/frontend/templates/classic/form.phtml
	 */
	function url(string $p):string {return df_cc_path($this->urlBase(), 'VPOS2', $p);}

	/**
	 * 2025-10-22
	 * @used-by vendor/mage2pro/alignet/view/frontend/templates/classic/form.phtml
	 */
	function urlStart():string {return $this->url('faces/pages/startPayme.xhtml');}

	/**
	 * 2025-10-22
	 * @used-by \Dfe\Alignet\Model\Client\Classic\Order\DataGetter::userCodePayme()
	 */
	function urlWalletWSDL():string {return df_cc_path(
		$this->isProduction() ? 'https://www.pay-me.pe' : $this->urlBase()
		,'WALLETWS/services/WalletCommerce?wsdl'
	);}

	/**
	 * 2025-10-22
	 * @used-by self::urlBase()
	 * @used-by self::urlWalletWSDL()
	 */
	private function isProduction():bool {return dfc($this, function():bool {return !!df_cfg(
		'payment/payme_gateway/main_parameters/payme_environment'
	);});}

	/**
	 * 2025-10-22
	 * @used-by self::urlWalletWSDL()
	 * @used-by self::url()
	 */
	private function urlBase():string {return $this->isProduction()
		? 'https://vpayment.verifika.com' : 'https://integracion.alignetsac.com'
	;}

	/**
	 * @used-by \Dfe\Alignet\Model\Client\Classic\Order\DataGetter::getBasicData()
	 * @used-by \Dfe\Alignet\Model\Client\Classic\Order\DataGetter::getSigForOrderRetrieve()
	 * @used-by \Dfe\Alignet\Model\Client\Classic\Order\DataGetter::getTestMode()
	 * @param string|null $key
	 * @return string|array
	 */
	function getConfig($key = null) {
		 $config = [
			'test' => null,
			'idEntCommerce' => $this->payme_wallet_id,
			'keywallet' => $this->payme_wallet_secret,
			'acquirerId' => $this->payme_adquir_id,
			'idCommerce' => $this->payme_comerce_id,
			'key' => $this->payme_vpos_id,
			'idEntCommerce_usd' => $this->payme_wallet_id_dls,
			'keywallet_usd' => $this->payme_wallet_secret_dls,
			'acquirerId_usd' => $this->payme_adquir_id_dls,
			'idCommerce_usd' => $this->payme_comerce_id_dls,
			'key_usd' => $this->payme_vpos_id_dls
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
		$this->payme_adquir_id = df_cfg('payment/payme_gateway/pos_parameters_soles/payme_adquir_id');
		$this->payme_comerce_id = df_cfg('payment/payme_gateway/pos_parameters_soles/payme_comerce_id');
		$this->payme_vpos_id = df_cfg('payment/payme_gateway/pos_parameters_soles/payme_vpos_id');
		$this->payme_wallet_id = df_cfg('payment/payme_gateway/pos_parameters_soles/payme_wallet_id');
		$this->payme_wallet_secret = df_cfg('payment/payme_gateway/pos_parameters_soles/payme_wallet_secret');
		$this->payme_adquir_id_dls = df_cfg(
			'payment/payme_gateway/pos_parameters_dolares/payme_adquir_id_dls'
		);
		$this->payme_comerce_id_dls = df_cfg(
			'payment/payme_gateway/pos_parameters_dolares/payme_comerce_id_dls'
		);
		$this->payme_vpos_id_dls = df_cfg('payment/payme_gateway/pos_parameters_dolares/payme_vpos_id_dls');
		$this->payme_wallet_id_dls = df_cfg(
			'payment/payme_gateway/pos_parameters_dolares/payme_wallet_id_dls'
		);
		$this->payme_wallet_secret_dls = df_cfg(
			'payment/payme_gateway/pos_parameters_dolares/payme_wallet_secret_dls'
		);
	}

	/**
	 * 2025-10-22
	 * @var O
	 */
	private $_d;

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

	/**
	 * 2025-10-22
	 * @used-by dfe_alignet_cfg()
	 */
	static function s():self {static $r; return $r ? $r : $r = new self;}
}
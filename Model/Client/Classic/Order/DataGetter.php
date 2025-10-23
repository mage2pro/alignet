<?php
namespace Dfe\Alignet\Model\Client\Classic\Order;
use Dfe\Alignet\Cfg;
# 2020-12-09
final class DataGetter {
	 /**
	 * @var \Dfe\Alignet\Model\Order\ExtOrderId
	 */
	protected $extOrderIdHelper;

	/**
	 * @var \Magento\Framework\Stdlib\DateTime\DateTime
	 */
	protected $dateTime;

	/**
	 * @var \Dfe\Alignet\Model\Session
	 */
	protected $session;

	protected $idEntCommerce;
	protected $keywallet;
	protected $idCommerce;
	protected $key;
	protected $modalVPOS2;
	protected $tipoModal;
	protected $currency_iso;

	/**
	 * @param \Dfe\Alignet\Model\Order\ExtOrderId $extOrderIdHelper
	 * @param \Magento\Framework\Stdlib\DateTime\DateTime $dateTime
	 * @param \Dfe\Alignet\Model\Session $session
	 */
	function __construct(
		\Dfe\Alignet\Model\Order\ExtOrderId $extOrderIdHelper,
		\Magento\Framework\Stdlib\DateTime\DateTime $dateTime,
		\Dfe\Alignet\Model\Session $session
	) {
		$this->extOrderIdHelper = $extOrderIdHelper;
		$this->dateTime = $dateTime;
		$this->session = $session;
	}

	/**
	 * @used-by \Dfe\Alignet\Model\Client\Classic\Order::getDataForOrderCreate()
	 * @param \Magento\Sales\Model\Order $order
	 * @return array
	 */
	function getBasicData(\Magento\Sales\Model\Order $order) {
		$oid =(int)$order->getId(); /** @var int $oid */
		$ba = $order->getBillingAddress();
		$sa = $order->getShippingAddress();
		$c = dfe_alignet_cfg(); /** @var Cfg $c */
		if ($order->getOrderCurrencyCode() == 'USD') {
			$this->idEntCommerce = $c->getConfig('idEntCommerce_usd');
			$this->keywallet = $c->getConfig('keywallet_usd');
			$this->acquirerId = $c->getConfig('acquirerId_usd');
			$this->idCommerce = $c->getConfig('idCommerce_usd');
			$this->key = $c->getConfig('key_usd');
		}
		else {
			$this->idEntCommerce = $c->getConfig('idEntCommerce');
			$this->keywallet = $c->getConfig('keywallet');
			$this->acquirerId = $c->getConfig('acquirerId');
			$this->idCommerce = $c->getConfig('idCommerce');
			$this->key = $c->getConfig('key');
		}
		$this->currency_iso = $this->setCurrencyIso($order->getOrderCurrencyCode());
		$amt = str_replace('.','',number_format($order->getGrandTotal(),2,'.',''));
		return [
			'acquirerId' => $this->acquirerId,
			'billingAddress' => $ba['street'],
			'billingCity' => $ba['city'],
			'billingCountry' => $order->getBillingAddress()->getCountryId() ? : '-',
			'billingEmail' => $ba['email'],
			'billingFirstName' => $ba['firstname'],
			'billingLastName' => $ba['lastname'],
			'billingPhone' => $ba['telephone'],
			'billingState' => $ba['region'] ?: '-',
			'billingZIP' => $ba['postcode'] ,
			'idCommerce' =>  $this->idCommerce,
			'language' => 'ES',
			'purchaseAmount' =>  $amt,
			'purchaseCurrencyCode' =>  $this->currency_iso,
			'purchaseOperationNumber' => $oid,
			'shippingAddress' => $sa['street'],
			'shippingCity' => $sa['city'],
			'shippingCountry' => $order->getShippingAddress()->getCountryId() ?: '-',
			'shippingEmail' => $sa['email'],
			'shippingFirstName' => $sa['firstname'],
			'shippingLastName' => $sa['lastname'],
			'shippingPhone' =>$sa['telephone'],
			'shippingState' => $sa['region'] ?: '-',
			'shippingZIP' => $ba['postcode'],
			'userCodePayme' => $this->userCodePayme([
				'userCommerce' =>(string)$order->getCustomerId(),
				'billingEmail' => $ba['email'],
				'billingFirstName' => $sa['firstname'],
				'billingLastName'=> $sa['lastname'],
				'billingEmail'=> $ba['email'],
				'reserved1'=> '',
				'reserved2'=> '',
				'reserved3'=> '',
				'currency' => $this->currency_iso
			]),
			'userCommerce' =>  (string)$order->getCustomerId(),
			'descriptionProducts' => 'Productos varios',
			'programmingLanguage' => 'ALG-MG-v3.0.3',
			'reserved2' => '',
			'reserved3' => '',
			'reserved4' => '',
			'reserved5' => '',
			'reserved6' => '',
			'reserved7' => '',
			'reserved8' => '',
			'reserved9' => '',
			'reserved10' => '',
			'purchaseVerification' => $this->purchaseVerification($oid, $amt, $this->currency_iso),
		];
	}

	function setCurrencyIso($code){
		$iso_code = '' ;
		switch ($code) {
			case 'USD':
				$iso_code = '840';
				break;
			case 'PEN':
				$iso_code = '604';
				break;
			 case 'BOB':
				$iso_code = '068';
				break;
			 case 'CRC':
				$iso_code = '188';
				break;
			default:
				$iso_code = '840';
				break;
		}

		return $iso_code;
	}

  function purchaseVerification($purchOperNum, $purchAmo, $purchCurrCod, $authRes = null)
	{
		$concatPurchase = $this->acquirerId.$this->idCommerce.$purchOperNum.$purchAmo.$purchCurrCod.$authRes.$this->key;

		return (phpversion() >= 5.3) ? openssl_digest($concatPurchase, 'sha512') : hash('sha512', $concatPurchase);
	}

	/**
	 * @return string
	 */
	function getClientIp()
	{
		return $_SERVER['REMOTE_ADDR'];
	}

	/**
	 * @return int
	 */
	function getTs()
	{
		return $this->dateTime->timestamp();
	}

	/**
	 * @param array $data
	 * @return string
	 */
	function getSigForOrderRetrieve(array $data = []) {return md5(dfe_alignet_cfg()->getConfig('keywallet'));}

	/**
	 * @used-by self::getBasicData()
	 * @param array(string => mixed) $d
	 * @return string
	 * @throws \SoapFault
	 */
	private function userCodePayme(array $d) {
		$r = ''; /** @var string $r */
		if ($customerId = dfa($d, 'userCommerce')) { /** @var int|null $customerId */
			$row = df_fetch_one('payme_usercode', '*', ['user_code' => $customerId, 'currency' => $this->currency_iso]);
			if (!($r = dfa($row, 'userCodePayme'))
				# 2021-05-13
				# The line below can throw the error:
				# «Couldn't load from 'https://www.pay-me.pe/WALLETWS/services/WalletCommerce?wsdl'»
				# https://github.com/innomuebles/m2/issues/17#issuecomment-840054608
				&& ($s = df_try(function() {return new \SoapClient(dfe_alignet_cfg()->urlWalletWSDL());}))
			) {/** @var \SoapClient $s */
				try {
					$res = $s->RegisterCardHolder([
						'idEntCommerce' => (string)$this->idEntCommerce,
						'codCardHolderCommerce' => (string)$customerId,
						'names' => $d['billingFirstName'],
						'lastNames' => $d['billingLastName'],
						'mail' => $d['billingEmail'] ,
						'reserved1' => $d['reserved1'],
						'reserved2' => $d['reserved2'],
						'reserved3' => $d['reserved3'],
						'registerVerification'=> openssl_digest(df_cc(
							$this->idEntCommerce, $customerId, $d['billingEmail'], $this->keywallet
						), 'sha512')
					]); /** @var object $res */
					$r = dfo($res, 'codAsoCardHolderWallet');
				}
				catch (\Exception $e) {df_log_e($e, $this);}
				if ($r) {
					$t = df_table('payme_usercode'); /** @var string $t */
					$p = ['userCodePayme' => $r]; /** @var array(string => mixed) $p */
					$row
						? df_conn()->update($t, $p, ['? = user_code' => $customerId, '? = currency' => $this->currency_iso])
						: df_conn()->insert($t, $p + ['currency' => $this->currency_iso, 'user_code' => $customerId])
					;
				}
			}
		}
		return $r;
	}
}
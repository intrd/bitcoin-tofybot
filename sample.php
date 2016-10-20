<?php
/**
 * TOFY - bitcoin trader bot (former HAL10K)
* 
* @package intrd/bitcoin-tofybot
* @version 1.0
* @tags bitcoin, bot, eggdrop, php, okcoin
* @link http://github.com/intrd/bitcoin-tofybot
* @author intrd (Danilo Salles) - http://dann.com.br
* @author rafadefine (Rafael) - http://nonononno.com
* @copyright (CC-BY-SA-4.0) 2016, intrd
* @license Creative Commons Attribution-ShareAlike 4.0 - http://creativecommons.org/licenses/by-sa/4.0
* Dependencies: 
* - php >=5.3.0
* - intrd/php-common >=1.0.x-dev <dev-master
* - intrd/sqlite-dbintrd >=1.0.x-dev <dev-master
*** @docbloc 1.1 */

require __DIR__ . '/vendor/autoload.php';
use php\intrdCommons as i;
use bitcoin\tofybot as bot;
use database\dbintrd as db;
use OKCoin as okc;

if (!file_exists("config.ini")) die("\n*** config.ini does no exist.\n");
$conf = parse_ini_file("config.ini", false);

date_default_timezone_set($conf["timezone"]); 
$conf["root"]=dirname(__FILE__)."/";
i::check_dir(array($conf["root"]."DATA/",$conf["root"]."TMP/",$conf["root"]."LOGS/")); 
$ext_path=$conf["root"]."../";
$conf["tmp_path"]=$conf["root"]."TMP/";
$conf["data_path"]=$conf["root"]."DATA/";
$cookie=$conf["tmp_path"]."cookie"; 
if (!file_exists($conf["data_path"]."secrets.ini")) die("\n*** config.ini does no exist.\n");
$secrets = parse_ini_file($conf["data_path"]."secrets.ini", false);

bot::hello(); //bot welcome screen

$client = new okc(new OKCoin_ApiKeyAuthentication($secrets["API_KEY"], $secrets["SECRET_KEY"]));

//$params = array('symbol' => 'btc_usd', 'size' => 5);
//$result = $client -> depthApi($params);

//$params = array('api_key' => $secrets["API_KEY"]);
//$result = $client -> userinfoApi($params);

//$params = array('symbol' => 'btc_usd', 'contract_type' => 'this_week');
//$result = $client -> tickerFutureApi($params);

// $params = array('symbol' => 'btc_usd', 'contract_type' => 'this_week');
// $result = $client -> tradesFutureApi($params);

// $params = array('api_key' => $secrets["API_KEY"]);
// $result = $client -> userinfoFutureApi($params);

// $params = array('api_key' => $secrets["API_KEY"], 'symbol' => 'btc_usd', 'contract_type' => 'this_week');
// $result = $client -> positionFutureApi($params);

$params = array('api_key' => $secrets["API_KEY"], 'symbol' => 'btc_usd', 'contract_type' => 'this_week', 'type' => 1);
$result = $client -> singleBondPositionFutureApi($params);

print_r($result);
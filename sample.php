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
$conf["ext_path"]=$conf["root"].$conf["ext"];
$conf["tmp_path"]=$conf["root"].$conf["tmp"];
$conf["data_path"]=$conf["root"].$conf["data"];
$conf["logs_path"]=$conf["root"].$conf["logs"];
i::check_dir(array($conf["data_path"],$conf["tmp_path"],$conf["logs_path"])); 
$conf["cookie1"]=$conf["tmp_path"].$conf["cookie1"];
$db_path=$conf["data_path"].$conf["dbfile"];

if (!file_exists($conf["data_path"]."secrets.ini")) die("\n*** secrets.ini does no exist.\n");
$secrets = parse_ini_file($conf["data_path"]."secrets.ini", false);

bot::hello(); //bot welcome screen


//$dbtest = new db("transactions","filter:id='156'");
//var_dump($dbtest);
//die;


$client = new okc(new OKCoin_ApiKeyAuthentication($secrets["API_KEY"], $secrets["SECRET_KEY"]));

//$params = array('symbol' => 'btc_usd', 'size' => 5);
//$result = $client -> depthApi($params);

//$params = array('api_key' => $secrets["API_KEY"]);
//$result = $client -> userinfoApi($params);

//$params = array('symbol' => 'btc_usd', 'contract_type' => 'this_week');
//$result = $client -> tickerFutureApi($params);

// $params = array('symbol' => 'btc_usd', 'contract_type' => 'this_week');
// $result = $client -> tradesFutureApi($params);

//$params = array('api_key' => $secrets["API_KEY"]);
//$result = $client -> userinfoFutureApi($params);

// $params = array('api_key' => $secrets["API_KEY"], 'symbol' => 'btc_usd', 'contract_type' => 'this_week');
// $result = $client -> positionFutureApi($params);

// $params = array('api_key' => $secrets["API_KEY"], 'symbol' => 'btc_usd', 'contract_type' => 'this_week', 'type' => 1);
// $result = $client -> singleBondPositionFutureApi($params);

// $params = array(
//   'api_key' => $secrets["API_KEY"], 
//   'symbol' => 'btc_usd', 
//   'contract_type' => 'this_week',  
//   'amount' => '1', 
//   'type'=> '1', 
//   'price' => '636.23',
//   'match_price'=> '0',
//   'lever_rate' => '20');
// $result = $client->tradeFutureApi($params);

// print_r($result);
// die;


$okcPL_constant="0.31914893617";
$buyd_price="235.91";
$last_price="235.64";
echo "\r\nPL: ".bot::okc_calculatePL($buyd_price,$last_price);
die;


//testing backtest data
$file=$conf["data_path"]."2016-10-19.2016-10-20.tsv";
bot::backtesting_getTSV($file);



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
use php\mcrypt256cbc as cry;

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
$brain=$conf["root"].$conf["brain"];
$brain_cry=$conf["root"].$conf["brain_cry"];

if (!file_exists($conf["data_path"]."secrets.ini")) die("\n*** secrets.ini does no exist, request it w/ developers.\n");
$secrets = parse_ini_file($conf["data_path"]."secrets.ini", false);

if (!defined('ENCRYPTION_KEY')) define('ENCRYPTION_KEY', $secrets["ENCRYPTION_KEY"]);

if (!file_exists($brain)){
  $fil=file_get_contents($brain_cry);
  $cry = cry::mc_decrypt($fil, ENCRYPTION_KEY);
  file_put_contents($brain, $cry);
}else{
  $fil=file_get_contents($brain);
  $fil = cry::mc_encrypt($fil, ENCRYPTION_KEY);
  //$cry = cry::mc_decrypt($fil, ENCRYPTION_KEY);
  file_put_contents($brain_cry, $fil);
}

$positions=array(); //starta as positions
$uinfo=array();

bot::hello(); //bot welcome screen


//$dbtest = new db("transactions","filter:id='156'");
//var_dump($dbtest);
//die;


$client = new okc(new OKCoin_ApiKeyAuthentication($secrets["API_KEY"], $secrets["SECRET_KEY"]));

// $params = array(
//   'api_key' => $secrets["API_KEY"], 
//   'symbol' => 'btc_usd', 
//   'contract_type' => 'this_week',  
//   'amount' => '1', 
//   'type'=> '2', 
//   'price' => '636.23',
//   'match_price'=> '1',
//   'lever_rate' => '20');
// $result = $client->tradeFutureApi($params);

// $params = array(
//   'api_key' => $secrets["API_KEY"], 
//   'symbol' => 'btc_usd', 
//   'contract_type' => 'this_week',  
//   'amount' => '1', 
//   'type'=> '4', //4 fecha short position
//   'price' => '636.23',
//   'match_price'=> '1',
//   'lever_rate' => '20');
// $result = $client->tradeFutureApi($params);

//$params = array('api_key' => $secrets["API_KEY"]);
//$result = $client -> userinfoFutureApi($params);

// $params = array('api_key' => $secrets["API_KEY"], 'symbol' => 'btc_usd', 'status' => '2', 'order_id' => '-1', 'contract_type' => 'this_week');
// $result = $client -> getOrderFutureApi($params); //-1 does not work, why?

// $params = array('api_key' => $secrets["API_KEY"], 'symbol' => 'btc_usd', 'status' => '1', 'order_id' => '3049433976', 'contract_type' => 'this_week');
// $result = $client -> getOrderFutureApi($params);

//$string = "-4.72E-5";
//echo sprintf('%f', $string);
//echo number_format($string, 8);
//die;

// $params = array('api_key' => $secrets["API_KEY"], 'symbol' => 'btc_usd', 'contract_type' => 'this_week', 'type' => 1);
// $result = $client -> singleBondPositionFutureApi($params);

// print_r($result);
// die;

/*
0.0329017 //meu balance antes das operacoes
100/635.63=0.1573242295 //valor do contrato na cotacao do momento da abertura da posicao
0.03% of 0.1573242295=0.00004719726 //valor da fee batendo com o valor exibido na api fee = -0.00004720
0.0329017-0.00004720=0.0328545 //subtrai a fee de abertura da posicao, detalhe que a fee é sobre o valor do contrato em 20x
0.0328545-(0.1573242295/20)=0.02498828852 //subtrai o valor do contrato bateu com o valor certinho exibido na api [balance] => 0.02498829 
100/636.4=0.15713387806 //novo valor do contrato ao fechar a posicao!
0.1573242295-0.15713387806=0.00019035144 //subtraio o valor de abertura do contrato pro valor de fechamento e tenho meu p/l expressado em btc
0.0328545-0.00019035144=0.03266414856 //saldo final da minha conta batendo com o exibido na api [balance] => 0.03266415
*/

/*
  backtesting loop..
 */
$lever="20";
$openPosFee="0.03";
$available="0.03266415"; //saldo inicial
$datetime_start="2016-10-18 00:27:00";
$datetime_end="2016-10-18 00:59:00";
$interval="1";
$file=$conf["data_path"]."2016-10-19.2016-10-20.tsv";
$uinfo=bot::backtesting_userInfo($available,$lever);
$uinfo=bot::backtesting_userInfo(false,false,true);

bot::backtesting_start();
$file=bot::backtesting_getTSV($file);



//start order
$contract=array("qty"=>"1","usd_cost"=>"100");
$price="636.96";
$type="short";
$position=bot::backtesting_openPos($type,$contract,$price,$lever,true);
$position_startid=$position["id"];
$uinfo=bot::backtesting_userInfo(false,false,true);

$datetime=$datetime_start;
$d2 = new DateTime($datetime_end);
$dcur = new DateTime($datetime_start);
while ($dcur < $d2):
  $price_ticker=bot::backtesting_getPriceByDatetime($file, $datetime);
  $dtime=$price_ticker[0];
  $last_price=$price_ticker[1];
  $dcur = new DateTime($dtime);
  echo "\r\n [".$dtime."] - ".$last_price;

  $position=bot::backtesting_updatePos($position_startid,$last_price,false,true); //checa pl's sem fechar a posicao

  $datetime=bot::backtesting_addminute($interval,$datetime);
endwhile;


die;

/*
  backtesting single position test..
 */
//$pl_constant="0.31914893617"; //0.31914893617 é quanto custa 0.01% de PL na okc
$lever="20";
$openPosFee="0.03";
$available="0.03266415"; //saldo inicial
$uinfo=bot::backtesting_userInfo($available,$lever);

bot::backtesting_start();
$uinfo=bot::backtesting_userInfo(false,false,true);

$contract=array("qty"=>"1","usd_cost"=>"100");
$price="636.00";
$type="short";
$position=bot::backtesting_openPos($type,$contract,$price,$lever,true);
$uinfo=bot::backtesting_userInfo(false,false,true);
//$position=bot::backtesting_updatePos($position["id"],"636.10",false,true); //checa pl's sem fechar a posicao
//die;

$price_current="636.10";
$position=bot::backtesting_updatePos($position["id"],$price_current,$close=true,true);
$uinfo=bot::backtesting_userInfo(false,false,true);

bot::backtesting_start(true);
die;



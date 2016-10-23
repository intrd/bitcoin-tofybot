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
* - intrd/php-mcrypt256CBC >=1.0.x-dev <dev-master
*** @docbloc 1.1 */

require __DIR__ . '/vendor/autoload.php';
use php\intrdCommons as i;
use bitcoin\tofybot as bot;
use database\dbintrd as db;
use OKCoin as okc;
use php\mcrypt256cbc as cry;

if (!file_exists("config.ini")) die("\r\n*** config.ini does no exist.\r\n");
$conf = parse_ini_file("config.ini", false);

date_default_timezone_set($conf["timezone"]); 
$conf["root"]=dirname(__FILE__)."/";
$conf["ext_path"]=$conf["root"].$conf["ext"];
$conf["tmp_path"]=$conf["root"].$conf["tmp"];
$conf["data_path"]=$conf["root"].$conf["data"];
$conf["logs_path"]=$conf["root"].$conf["logs"];
i::check_dir(array($conf["data_path"],$conf["tmp_path"],$conf["logs_path"])); 
$conf["cookie2"]=$conf["tmp_path"].$conf["cookie1"].".2";
$conf["cookie1"]=$conf["tmp_path"].$conf["cookie1"];
$db_path=$conf["data_path"].$conf["dbfile"];
$brain=$conf["root"].$conf["brain"];
$brain_cry=$conf["root"].$conf["brain_cry"];
$algorithm=$conf["root"].$conf["algorithm"];
$algorithm_cry=$conf["root"].$conf["algorithm_cry"];
$positions=array(); 
$uinfo=array();
$orders=array();

if (!file_exists($conf["data_path"]."secrets.ini")) die("\r\n*** secrets.ini does no exist, request it w/ developers.\r\n");
$secrets = parse_ini_file($conf["data_path"]."secrets.ini", false);

if (!defined('ENCRYPTION_KEY')) define('ENCRYPTION_KEY', $secrets["ENCRYPTION_KEY"]);

if (!file_exists($brain)){
  $fil=file_get_contents($brain_cry);
  $cry = cry::mc_decrypt($fil, ENCRYPTION_KEY);
  file_put_contents($brain, $cry);
}else{
  $fil=file_get_contents($brain);
  $fil = cry::mc_encrypt($fil, ENCRYPTION_KEY);
  file_put_contents($brain_cry, $fil);
}

if (!file_exists($algorithm)){
  $fil=file_get_contents($algorithm_cry);
  $cry = cry::mc_decrypt($fil, ENCRYPTION_KEY);
  file_put_contents($algorithm, $cry);
}else{
  $fil=file_get_contents($algorithm);
  $fil = cry::mc_encrypt($fil, ENCRYPTION_KEY);
  file_put_contents($algorithm_cry, $fil);
}

require_once($algorithm);


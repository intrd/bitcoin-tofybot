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
use bitcoin\okc as okc;
use database\dbintrd as db;

if (!file_exists("config.ini")) die("\n*** config.ini does no exist.\n");
$conf = parse_ini_file("config.ini", false);

date_default_timezone_set($conf["timezone"]); 
$conf["root"]=dirname(__FILE__)."/";
i::check_dir(array($conf["root"]."DATA/",$conf["root"]."TMP/",$conf["root"]."LOGS/")); 
$ext_path=$conf["root"]."../";
$conf["tmp_path"]=$conf["root"]."TMP/";
$conf["data_path"]=$conf["root"]."DATA/";

$browser_agent="Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.0";
$cookie=$conf["tmp_path"]."cookie"; 

bot::hello();
okc::hello();



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

namespace bitcoin;
use database\dbintrd as db;
use php\intrdCommons as i;

class tofybot {
	public function hello(){
		echo "\r\n*** TOFY - bitcoin trader bot (former HAL10K) ***";
	}

}

class okc {
	public function hello(){
		global $cookie;
		$header=array();
		$result=i::url_get("https://www.okcoin.com/api/ticker.do?ok=1",$cookie,"r",$header);
		$ticker=json_decode($result["content"]);
		$last_price=$ticker->ticker->last;
		echo "\n>Last price: $last_price";
	}

}

?>
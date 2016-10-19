<?php
/**
 * Bitcoin - OKC Futures trader bot
* 
* @package intrd/bitcoin-tofybot
* @version 1.1
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

if (1==1 //1==1 = whitelist disabled
	or $_SERVER['REMOTE_ADDR']=="192.168.0.103"){ //whitelist
	require("adminer.php"); //calling adminer
}
?>

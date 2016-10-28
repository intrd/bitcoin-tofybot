<?php
/**
 * TOFY - bitcoin trader bot (former HAL10K)
* 
* @package intrd/bitcoin-tofybot
* @version 1.0
* @tags bitcoin, bot, eggdrop, php, okcoin
* @link http://github.com/intrd/bitcoin-tofybot
* @author intrd (Danilo Salles) - http://dann.com.br
* @author rafadefine (Rafael) - http://
* @copyright (proprietary) 2016, intrd
* @license Proprietary software - https://en.wikipedia.org/wiki/Proprietary_software
* Dependencies: 
* - php >=5.3.0
* - intrd/php-common >=1.0.x-dev <dev-master
* - intrd/sqlite-dbintrd >=1.0.x-dev <dev-master
* - intrd/php-mcrypt256CBC >=1.0.x-dev <dev-master
*** @docbloc 1.1 */

if (1==1 //1==1 = whitelist disabled
	or $_SERVER['REMOTE_ADDR']=="192.168.0.103"){ //whitelist
	require("adminer.php"); //calling adminer
}
?>

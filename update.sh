##
# TOFY - bitcoin trader bot (former HAL10K)
#
# @package intrd/bitcoin-tofybot
# @version 1.0
# @tags bitcoin, bot, eggdrop, php, okcoin
# @link http://github.com/intrd/bitcoin-tofybot
# @author intrd (Danilo Salles) - http://dann.com.br
# @author rafadefine (Rafael) - http://nosite.xxx
# @copyright (proprietary) 2016, intrd
# @license Proprietary software - https://en.wikipedia.org/wiki/Proprietary_software
# Dependencies: 
# - php >=5.3.0
# - intrd/php-common >=1.0.x-dev <dev-master
# - intrd/sqlite-dbintrd >=1.0.x-dev <dev-master
# - intrd/php-mcrypt256CBC >=1.0.x-dev <dev-master
# - j7mbo/twitter-api-php dev-master
## @docbloc 1.1

#!/bin/bash

rm src/*.php
git fetch --all && git reset --hard origin/1.0
composer install -o
composer install -o








<!-- docbloc -->
<span id='docbloc'>
TOFY - bitcoin trader bot (former HAL10K)
<table>
<tr>
<th>Package</th>
<td>intrd/bitcoin-tofybot</td>
</tr>
<tr>
<th>Version</th>
<td>1.0</td>
</tr>
<tr>
<th>Tags</th>
<td>bitcoin, bot, eggdrop, php, okcoin</td>
</tr>
<tr>
<th>Project URL</th>
<td>http://github.com/intrd/bitcoin-tofybot</td>
</tr>
<tr>
<th>Author</th>
<td>intrd (Danilo Salles) - http://dann.com.br
<tr>
<th>Author</th>
<td>rafadefine (Rafael) - http://nonononno.com</td>
<tr>
<th>Copyright</th>
<td>(CC-BY-SA-4.0) 2016, intrd</td>
</tr>
<tr>
<th>License</th>
<td><a href='http://creativecommons.org/licenses/by-sa/4.0'>Creative Commons Attribution-ShareAlike 4.0</a></td>
</tr>
<tr>
<th>Dependencies</th>
<td> &#8226; php >=5.3.0 &#8226; intrd/php-common >=1.0.x-dev <dev-master &#8226; intrd/sqlite-dbintrd >=1.0.x-dev <dev-master &#8226; intrd/php-mcrypt256CBC >=1.0.x-dev <dev-master</td>
</tr>
</table>
</span>
<!-- @docbloc 1.1 -->

A reboot of my old traderbot HAL10K that i had deprecated the project after the MTGox crash. 

Installation
============

System requiriments & dependencies

```
$ sudo apt-get update & sudo apt-get upgrade
$ sudo apt-get install curl git php5-curl php5-cli php5-mcrypt 
$ curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

Now download the package (Composer automatically install all dependencies)
$ git clone https://github.com/intrd/bitcoin-tofybot && cd bitcoin-tofybot
$ composer install -o

To check for update..
$ git pull && composer update

```
## Usage

1. Request secret.ini w/ developers (it contains you serial number to decrypt the bot's brain) 
2. Review config.ini, and..

```
$ ./run.sh
```




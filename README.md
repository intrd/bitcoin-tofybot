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
<td>Rafael (Rafael Def) - http://nosite.xxx</td>
<tr>
<th>Copyright</th>
<td>(proprietary) 2016, intrd</td>
</tr>
<tr>
<th>License</th>
<td><a href='https://en.wikipedia.org/wiki/Proprietary_software'>Proprietary software</a></td>
</tr>
<tr>
<th>Dependencies</th>
<td> &#8226; php >=5.3.0 &#8226; intrd/php-common >=1.0.x-dev <dev-master &#8226; intrd/sqlite-dbintrd >=1.0.x-dev <dev-master &#8226; intrd/php-mcrypt256CBC >=1.0.x-dev <dev-master &#8226; j7mbo/twitter-api-php dev-master</td>
</tr>
</table>
</span>
<!-- @docbloc 1.1 -->

A reboot of my old HAL10K traderbot that was deprecated on MTGox crash. (new algos, new approach)

![running_win](/imgs/output.gif?raw=true "sample")

* Working on OKCoin Futures

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
$ composer install -o (yes, twice to rebuild autoload)

```
## Usage

1. Rename `secrets_sample.ini` to `secrets.ini`.  
2. Open secrets.ini and change `ENCRYPTION_KEY` to serial number given to you (Request it from developers. Yes, its needed to decrypt/run this bot) 
3. Review `config.ini`, and..

```
Backtesting # Cryptowat.ch - okcoinUSDfutures (1min interval), 24 hours ago
$ ./run.sh backtesting cryptowat_okcoinUSDfutures 0

Backtesting # INTRD Records - okcoinUSDfutures (custom interval or 10s minimum), since 10/28/2016 01:43:19
$ ./run.sh backtesting intrd_okcoinUSDfutures 0

Paper # OkCoinUSDfutures LIVE API
$ ./run.sh paper live_okcoinUSDfutures 0
* Set the last argument to 1, to reset balance/orders/positions. 
```

## Update

```
$ ./update.sh

```

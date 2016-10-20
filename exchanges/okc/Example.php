<?php

require_once (dirname(__FILE__) . '/OKCoin/OKCoin.php');

const API_KEY = "OKCoin提供的api_key";
const SECRET_KEY = "OKCoin提供的secret_key";

try {

	//OKCoin DEMO 入口
	$client = new OKCoin(new OKCoin_ApiKeyAuthentication(API_KEY, SECRET_KEY));

	
	//获取OKCoin行情（盘口数据）
	$params = array('symbol' => 'ltc_usd');
	$result = $client -> tickerApi($params);
	print_r($result);

	//获取OKCoin市场深度
	$params = array('symbol' => 'btc_usd', 'size' => 5);
	$result = $client -> depthApi($params);
	print_r($result);
	

	//获取OKCoin历史交易信息
	//$params = array('symbol' => 'btc_usd');
	//$result = $client -> tradesApi($params);

	//获取比特币或莱特币的K线数据
	//$params = array('symbol' => 'btc_usd', 'type' => '1day', 'size' => 5);
	//$result = $client -> klineDataApi($params);

	//获取用户信息
	//$params = array('api_key' => API_KEY);
	//$result = $client -> userinfoApi($params);

	//下单交易
	//$params = array('api_key' => API_KEY, 'symbol' => 'btc_usd', 'type' => 'buy', 'price' => 1, 'amount' => 1);
	//$result = $client -> tradeApi($params);
	//var_dump($result);

	//批量下单
	//$params = array('api_key' => API_KEY, 'symbol' => 'btc_usd', 'type' => 'buy', 'orders_data' => "[;price:3,amount:5,type:'sell'var_dump($result);,;price:3,amount:3,type:'buy'var_dump($result);,;price:3,amount:3var_dump($result);]");
	//$result = $client -> batchTradeApi($params);

	//撤销订单
	//$params = array('api_key' => API_KEY, 'symbol' => 'btc_usd', 'order_id' => '546,456,998,65656');
	//$result = $client -> cancelOrderApi($params);

	//获取用户的订单信息
	//$params = array('api_key' => API_KEY, 'symbol' => 'btc_usd', 'order_id' => -1);
	//$result = $client -> orderInfoApi($params);

	//批量获取用户订单
	//$params = array('api_key' => API_KEY, 'symbol' => 'btc_usd', 'status' => 0, 'current_page' => '1', 'page_length' => '1');
	//$result = $client -> ordersInfoApi($params);

	//获取历史订单信息，只返回最近七天的信息
	//$params = array('api_key' => API_KEY, 'symbol' => 'btc_usd', 'type' => 0, 'order_id' => '123,123,555');
	//$result = $client -> orderHistoryApi($params);

	//提币BTC/LTC
	//$params = array('api_key' => API_KEY, 'symbol' => 'btc_usd', 'chargefee' => '0.0001', 'trade_pwd' => '123456', 'withdraw_address' => '405sdsdsdsdsdsds', 'withdraw_amount' => 1);
	//$result = $client -> withdrawApi($params);

	//取消提币BTC/LTC
	//$params = array('api_key' => API_KEY, 'symbol' => 'btc_usd', 'withdraw_id' => 301);
	//$result = $client -> cancelWithdrawApi($params);

	//获取OKCoin期货行情（期货盘口）
	//$params = array('symbol' => 'btc_usd', 'contract_type' => 'this_week');
	//$result = $client -> tickerFutureApi($params);

	//获取OKCoin期货深度信息
	//$params = array('symbol' => 'btc_usd', 'contract_type' => 'this_week', 'size' => 5);
	//$result = $client -> depthFutureApi($params);

	//获取OKCoin期货交易记录信息
	//$params = array('symbol' => 'btc_usd', 'contract_type' => 'this_week');
	//$result = $client -> tradesFutureApi($params);

	//获取美元人民币汇率
	//$result = $client -> getUSD2CNYRateFutureApi(null);

	//获取交割预估价
	//$params = array('symbol' => 'btc_usd');
	//$result = $client -> getEstimatedPriceFutureApi($params);

	//获取OKCoin期货交易历史
	//$params = array('symbol' => 'btc_usd', 'date' => '2014-10-31', 'since' => '0');
	//$result = $client -> futureTradesHistoryFutureApi($params);

	//获取期货合约的K线数据
	//$params = array('symbol' => 'btc_usd', 'type' => '1day', 'contract_type' => 'this_week', 'size' => 5);
	//$result = $client -> getFutureIndexFutureApi($params);

	//获取OKCoin期货账户信息 （全仓）
	//$params = array('api_key' => API_KEY);
	//$result = $client -> userinfoFutureApi($params);

	//获取用户持仓获取OKCoin期货账户信息 （全仓）
	//$params = array('api_key' => API_KEY, 'symbol' => 'btc_usd', 'contract_type' => 'this_week');
	//$result = $client -> positionFutureApi($params);

	//期货下单
	//$params = array('api_key' => API_KEY, 'symbol' => 'btc_usd', 'contract_type' => 'this_week', 'price' => '400', 'amount' => '1', 'type' => '1', 'lever_rate' => '10');
	//$result = $client -> tradeFutureApi($params);

	//期货批量下单
	//$params = array('api_key' => API_KEY, 'orders_data' => '[;price:5,amount:2,type:1,match_price:1var_dump($result);,;price:2,amount:3,type:1,match_price:1var_dump($result);]', 'symbol' => 'btc_usd', 'contract_type' => 'this_week', 'lever_rate' => '10');
	//$result = $client -> batchTradeFutureApi($params);

	//获取期货订单信息
	//$params = array('api_key' => API_KEY, 'symbol' => 'btc_usd', 'order_id' => '173126', 'contract_type' => 'this_week');
	//$result = $client -> getOrderFutureApi($params);

	//取消期货订单
	//$params = array('api_key' => API_KEY, 'symbol' => 'btc_usd', 'order_id' => '173126', 'contract_type' => 'this_week');
	//$result = $client -> cancelFutureApi($params);

	//获取逐仓期货账户信息
	//$params = array('api_key' => API_KEY);
	//$result = $client -> fixUserinfoFutureApi($params);

	//逐仓用户持仓查询
	//$params = array('api_key' => API_KEY, 'symbol' => 'btc_usd', 'contract_type' => 'this_week', 'type' => 1);
	//$result = $client -> singleBondPositionFutureApi($params);

} catch (Exception $e) {
	$msg = $e -> getMessage();
	error_log($msg);
}

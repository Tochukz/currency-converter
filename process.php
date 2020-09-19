<?php
spl_autoload_register(function($className){
	$classPath = str_replace("\\", "/", $className);
    require_once($classPath.'.php');
});

$to_currency_amount =  0;
$from_currency_amount = 0;
$activeFromCurrecny = '';
$activeToCurrency = '';
$exchangeRate = '';
$errorMessage = null;

$currencyConverter = new CurrencyConverter(5);
$supportedCurrencies = $currencyConverter->getSupportedCurrencies();

$requiredInputs = ['from_currency', 'from_currency_amount', 'to_currency'];
if(isset($_POST) && array_keys($_POST) == $requiredInputs){   
    $from_currency = filter_var($_POST['from_currency'], FILTER_SANITIZE_STRING);
	$from_currency_amount = $_POST['from_currency_amount']; 
	$to_currency = filter_var($_POST['to_currency'], FILTER_SANITIZE_STRING);

	$activeFromCurrecny = $from_currency;
	$activeToCurrency = $to_currency;
        
    $valid = CurrencyConverter::validate($_POST);
    if($valid === true){    
            	
    	$array = $currencyConverter->convert($from_currency_amount, $from_currency, $to_currency);
    	

        if($array['status'] == 'failure'){
             $errorMessage = $array['message'];
        }
    	$to_currency_amount = $array['toCurrencyAmount']?? '';
    	$exchangeRate = $array['exchangeRate']?? '';
       
       
    }else{
    	$errorMessage = $valid['message'];
    }
    
}

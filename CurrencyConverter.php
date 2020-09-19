<?php
class CurrencyConverter
{
	/**
	 * Relationship between currencies with ZAR as the base currency.
     * To support a new currency, add the currency's R1 equivalent to the array.
     *
     * @var array
	 */
	protected $equivalent = ['ZAR'=>1.00, 'USD'=>0.08084 , 'GBP'=>0.05164]; 	
    
    /**
     * Number of decimal places of amount after conversion
     *
     * @var int     
     */
	protected $precision;

    /**
     * Instantiate the $amount variable
     */
	public function __construct(int $precision = 2)
	{     
       $this->precision = $precision;
	}

    /**
     * Validate the user inputs.
     *
     * @param array $inputs;
     * @return bool
     */
	public static function validate(array $inputs)
	{       	             
        $message = [];    
        $validated = true;   
        foreach($inputs as $key=>$input){
        	if(empty($input)){
                $validated = false;
                $message[] = '"'.ucwords(str_replace('_', ' ', $key)).'" is required.';
        	}

        	if($key == 'from_currency_amount' && !is_numeric($input)){
        	     $message[] = '"From currency amount" must contain  a numeric input.';
        	}
        }
          
        if($validated == false){
        	return['status'=>'failure', 'message'=>$message];
        }

        return true;
	}

    /**
     * Converts an amount from one currency to the other
     * 
     * @param string $fromCurrency
     * @param string $toCurrency
     * @return array 
     */
	public function convert(string $from_currency_amount, string $fromCurrency, string $toCurrency)
	{		
		 $equiv = $this->equivalent;
		 $precision = $this->precision;
		 if(array_key_exists($fromCurrency, $equiv) && array_key_exists($toCurrency, $equiv)){
		 	 $toAmount = (float) $from_currency_amount * ($equiv[$toCurrency] / $equiv[$fromCurrency]);

		 	 $rate = 1 * ($equiv[$toCurrency] / $equiv[$fromCurrency]);
		 	 $exchangeRate = "1 $fromCurrency = ".round($rate, $precision)." $toCurrency ";

		 	 return ['toCurrencyAmount'=>round($toAmount, $precision), 'exchangeRate'=>$exchangeRate, 'status'=>'success'];
                       
		 }else {
        	return[ 'status'=>'failure', 'message'=>['One or both currency is not supported.']];
        }
	}

    /**
     * Returns the supported currencies.     
     *
     * @return array
     */
	public function getSupportedCurrencies()
    {
        return array_keys($this->equivalent);
    }

}

<?php
require_once('process.php');
?>

<!DOCTYPE html>
<html>

<head>
    <title>Currency App</title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"> </script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"> </script>	
	<![endif]-->
</head>

<body>
    <nav class="navbar navbar-default navbar-static-top" id="nav">
        <div class="container">
            <div class="navbar-header">
                <a href="index.php" class="navbar-brand">Currency Converter</a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-menu" aria-expanded="false">
            <span class="sr-only"> Toggle Navigation </span>
            <span class="icon-bar"> </span>
            <span class="icon-bar"> </span>
            <span class="icon-bar"> </span>
        </button>
            </div>
            <div class="collapse navbar-collapse navbar-right" id="nav-menu">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">HOME</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <?php if($errorMessage): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php
                            $msgs  = '';
                            foreach($errorMessage as $msg){
                                $msgs .='<li>'.$msg.'</li>';
                            }
                            echo $msgs;
                          ?>
                                <ul>
                    </div>
                    <?php endif; ?>

                    <form method="post" id="converter_form">
                        <div class="form-group">
                            <label for="from_currency">From Currency</label>
                            <select class="form-control" name="from_currency" id="from_currency">
                            <?php                                  
                               $currencyOptions = ' ';                            
                               foreach($supportedCurrencies as $currency){
                                   if($activeFromCurrecny == $currency){
                                       $currencyOptions .= '<option value="'.$currency.'" selected="selected">'.$currency.'</option>';
                                       continue;
                                   }
                                   $currencyOptions .= '<option value="'.$currency.'">'.$currency.'</option>';
                               }
                               echo $currencyOptions;
                            ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="from_currency_amount">From Currency Amount</label>
                            <input type="number" step="0.00001" name="from_currency_amount" data-name="From Currency Amount" id="from_currency_amount" class="form-control" value="<?php echo $from_currency_amount ?>" />
                        </div>
                        <div class="form-group">
                            <label for="to_currency">To Currrency</label>
                            <select class="form-control" name="to_currency" data-name="To Currency " id="to_currency">
                                <option></option>
                                <?php 
                                    $currencyOptions = ' ';  
                                    foreach($supportedCurrencies as $currency){
                                        if($activeToCurrency == $currency){
                                            $currencyOptions .= '<option value="'.$currency.'" selected="selected">'.$currency.'</option>';
                                            continue;
                                        }
                                        $currencyOptions .= '<option value="'.$currency.'">'.$currency.'</option>';
                                    }
                                    echo $currencyOptions;                    
                                ?>
                           </select>
                        </div>
                        <input type="submit" value="Convert" class="btn btn-primary" />

                        <div class="form-group">
                            <label for="to_currency_amount">To Currency Amount</label>
                            <input type="text" id="to_currency_amount" class="form-control" value="<?php echo number_format($to_currency_amount, 2),' ', $activeToCurrency ; ?>" readonly />
                        </div>

                        <p><strong>Exchange Rate:</strong>
                            <?php echo $exchangeRate; ?> </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="js/app.js"></script>
</body>

</html>

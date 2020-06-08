<?php
    // get the data from the form
    $investment = filter_input(INPUT_POST, 'investment',
        FILTER_VALIDATE_FLOAT);
    $interest_rate = filter_input(INPUT_POST, 'interest_rate',
        FILTER_VALIDATE_FLOAT);                                 //error - no semi colon at the end of the line
    $years = filter_input(INPUT_POST, 'years',
        FILTER_VALIDATE_INT);

    // validate investment
    if ($investment === FALSE ) {                              //error - '===' required to compare the value
        $error_message = 'Investment must be a valid number.'; 
    } 
    else if ( $investment <= 0 ) {
        $error_message = 'Investment must be greater than zero.'; 
    } 
    // validate interest rate
    else if ( $interest_rate === FALSE )  {
        $error_message = 'Interest rate must be a valid number.'; 
    } 
    else if ( $interest_rate <= 0 ) {
        $error_message = 'Interest rate must be greater than zero.'; 
    }
    // validate years
    else if ( $years === FALSE ) {
        $error_message = 'Years must be a valid whole number.';
    } 
    else if ( $years <= 0 ) {                                     //error - '<=' shows the comparision for less than zero
        $error_message = 'Years must be greater than zero.';
    } 
    else if ( $years > 30 ) {
        $error_message = 'Years must be less than 31.';             //error - quotations differed
    }
    // set error message to empty string if no invalid entries
    else {
        $error_message = ''; 
    }

    // if an error message exists, go to the index page
    if ($error_message != '') {
        include('index.php');               //error - no such file as ind.php
        exit();                             //error - semi colon for the exit function needed
    }

    // calculate the future value
    $future_value = $investment;            //error - change in the name of variable to match the variable names afterwards
    for ($i = 1; $i <= $years; $i++) {
        $future_value = 
            $future_value + ($future_value * $interest_rate * .01); 
    }

    // apply currency and percent formatting
    $investment_f = '$'.number_format($investment, 2, ".", ",");            //error - number of maximum parameters is 4 and the parameters were wrong
    $yearly_rate_f = $interest_rate.'%';
    $future_value_f = '$'.number_format($future_value, 2);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Future Value Calculator</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <main>
        <h1>Future Value Calculator</h1>

        <label>Investment Amount:</label>
        <span><?php echo $investment_f; ?></span><br>

        <label>Yearly Interest Rate:</label>
        <span><?php echo $yearly_rate_f; ?></span><br>

        <label>Number of Years:</label>
        <span><?php echo $years; ?></span><br>

        <label>Future Value:</label>
        <span><?php echo $future_value_f; ?></span><br>       <!-- Error - No quotation required -->
    </main>

</body>
</html>

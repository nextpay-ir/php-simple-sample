<html>
<body>
<div style="margin:0 auto" align=center>
    <h2>ENTER AMOUNT</h2>
    <form method="POST">
	<input type="number" min="1000" name="amount" />
	<input type="SUBMIT" value="PAY" />
    </form>
</div>
</body>
</html>

<?php

if (isset($_POST['amount']) and is_numeric($_POST['amount'])){

    $Amount = $_POST['amount'];
    // dont't forget to et your Api key
    $Api_Key = "e1850164-0c84-4521-ab7a-ea5c2efeb283"; //Required
    $Order_ID = time(); // Required
    $Callback = 'http://localhost/callback.php?amount=' . $Amount; // Required

    $client = new SoapClient('https://api.nextpay.org/gateway/token.wsdl', array('encoding' => 'UTF-8'));
    $result = $client->TokenGenerator([
	    'api_key' => $Api_Key,
	    'amount' => $Amount,
	    'order_id' => $Order_ID,
	    'callback_uri' => $Callback,
    ]);

    $result = $result->TokenGeneratorResult;

    if ($result->code == -1) {
	    header( 'Location: https://api.nextpay.org/gateway/payment/' . $result->trans_id) ;
    }else{
	    print "Error Code: " . $result->code ;
    }

}

/* End of file pay.php */

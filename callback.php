<?php

if (!isset($_GET['amount']) or !is_numeric($_GET['amount']))
    exit('Invalid Amount!');


$Api_Key = "e1850164-0c84-4521-ab7a-ea5c2efeb283";
$Amount = $_GET['amount']; //Amount will be based on Toman
$TransactionID = $_POST['trans_id'];
$Order_ID = $_POST['order_id'];

if (isset($TransactionID) && isset($Order_ID)) {
    $client = new SoapClient('https://api.nextpay.org/gateway/verify.wsdl', array('encoding' => 'UTF-8'));
    $result = $client->PaymentVerification(
        [
            'api_key' => $Api_Key,
            'trans_id' => $TransactionID,
            'order_id' => $Order_ID ,
            'amount' => $Amount,
        ]
    );
    $result = $result->PaymentVerificationResult;

    if ($result->code == 0) {
	echo "<h2>Payment Success!</h2>";
    } else {
	echo "<h2>Failed Payment " . $result->code . "</h2>" ;
    }
}

/* End of callback.php */

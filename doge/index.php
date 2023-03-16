<?php
    // we sanitize POST/GET
    $_GET   = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
    // we check if its SodogeTip or MyDogeTip payment
    if (isset($_GET['s'])){
      $doge = explode(":d:", trim($_GET['s']));
      $pay = "SodogeTip";
    }else{
      $doge = explode(":d:", trim($_GET['m']));
      $pay = "MydogeTip";
    }
    
    // we check if is to Sell someting or to send Donations
    $typeH = "Create-Donations";
    $type = '🛍️ I Just Donated to '.trim($doge[1]).' in $Doge%0a%0a';      
    if(trim($doge[3]) != "Donate"){
      $typeH = "Sell-Anything-in-Doge";
      $type = '🛍️ I Just Bought '.trim($doge[1]).' in $Doge%0a%0a';
    };

    // we build the Tweet to send Dogecoin Money  
    $url = "ironicpay.com/index.php?t=".trim($doge[0]).":d:".trim($doge[1]).":d:".trim($doge[2].":d:".$typeH);
    $pay = $type."@".$pay."%20tip%20@".trim($doge[0])."%20".trim($doge[2])."%20Doge%20✅";      
    header('Location: https://twitter.com/intent/tweet?text='.$pay.'%0a%0aby%20'.$url.'%0a$Doge&hashtags=Dogecoin,IronicPay');      
?>
<?php
    // we sanitize POST/GET
    $_GET   = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    // we check if the form was submited
    if(isset($_POST['shibe'])){

        // we try to clean some bad inputs
        $shibe = str_replace("@", '', trim($_POST['shibe']));
        $ref = str_replace(array("#"), '', trim($_POST['ref']));
        $desc = str_replace(array("\r"), '', trim($_POST['desc']));
        $desc = str_replace(array("<br />","\n"), '%0a', trim($desc));
        $desc = str_replace(array(",","'",'"'), ' ', trim($desc));
        $doge = trim($_POST['doge']);

        // we check if its to create a donation Tweet or to Sell something
        $typeI = "Donate";
        $type = "🪙 [ Donate";
        if ($_POST['type'] != "Donate"){
            $typeI = "Pay";
            $type = "🪙 [ Price";
        };

        // we create the Tweet header text and url type
        $typeH = "🛍️ ".$_POST['type']." on Twitter using Doge";
        $do = ":d:".$_POST['type'];

        // we check if is to create a Tweet with all payment options and build the tweet
        if ($_POST['submit'] == "sodogemydoge"){

            // we build the tweet
            $cart1 = $type." Ð ".$doge." ]%0a ".$typeI." with @SoDogeTip 👉";
            $cart2 = $type." Ð ".$doge." ]%0a ".$typeI." with @MyDogeTip 👉";
            $link1 = $cart1."ironicpay.com/doge/?s=".$shibe.":d:".$ref.":d:".$doge.$do;
            $link2 = $cart2."ironicpay.com/doge/?m=".$shibe.":d:".$ref.":d:".$doge.$do;

            // we redirect the Shibe to is own Tweeter Account with the Auto Created Tweet
            header('Location: https://twitter.com/intent/tweet?text='.$typeH.'%0a%0a&hashtags='.$ref.' '.$desc.'%0a%0a'.$link1.'%0a%0a'.$link2.'%0a%0a$Doge,Dogecoin,IronicPay');

        }else{

          // we build the tweet with the payment option choosen
            if ($_POST['submit'] == "sodoge"){ $cart = $type." Ð ".$doge."]%0a Pay with @SoDogeTip 👉"; $wallet = "s"; };
            if ($_POST['submit'] == "mydoge"){ $cart = $type." Ð ".$doge."]%0a Pay with @MyDogeTip 👉"; $wallet = "m"; };
            $link = $cart."ironicpay.com/doge/?".$wallet."=".$shibe.":d:".$ref.":d:".$doge.$do;

            // we redirect the Shibe to is own Tweeter Account with the Auto Created Tweet
            header('Location: https://twitter.com/intent/tweet?text='.$typeH.'%0a%0a&hashtags='.$ref.' '.$desc.'%0a%0a'.$link.'%0a%0a$Doge,Dogecoin,IronicPay');

        }

    }

?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Sell Anything on Twitter with Dogecoin - Ironic Payment Gateway for Twitter</title>
  <meta name="description" content="Create Tweets to Sell Products in Dogecoin.Create Donate Tweets in Doge. Sell Memes">
  <meta name="author" content="All Dogecoin Community!">
  <meta name="generator" content="You!">
<?php
    // we create twitter cards to display dynamic content on Tweets wen loading a IronicPay URL
    if (isset($_GET['t'])){
      $t = explode(":d:", trim($_GET['t']));
 ?>
  <meta name="twitter:card" content="summary">
  <meta name="twitter:title" content="<?php echo trim($t[3]); ?> <?php echo trim($t[1]); ?>">
  <meta name="twitter:site" content="https://ironicpay.com">
  <meta name="twitter:description" content="&ETH; <?php echo trim($t[2]); ?> to <?php echo trim($t[0]); ?>">
  <meta name="twitter:image" content="https://ironicpay.com/img/doge_ironicpay.png">
<?php
}else{
?>
  <meta name="twitter:card" content="summary">
  <meta name="twitter:title" content="Dogecoin Ironic Payment Gateway">
  <meta name="twitter:site" content="https://ironicpay.com">
  <meta name="twitter:description" content="Create Tweets to Sell Products in Dogecoin. Create Donate Tweets in Doge. Sell TFT (Twitter Fungible Tokens) in Doge">
  <meta name="twitter:image" content="https://ironicpay.com/img/doge_ironicpay.png">
<?php
}
?>
  <link href="//ironicpay.com/img/ironicpay.png" rel="icon" />
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" crossorigin="anonymous">
  <link href="//cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="css/doge.css" crossorigin="anonymous">
  <script src="//cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.min.js" crossorigin="anonymous"></script>
>
</head>

<body>
<div class="background-container">
<img src="img/moon.png" alt="">
<div class="stars"></div>
<div class="twinkling"></div>
</div>
  <div class="content" style="max-width: 700px; margin: auto;  z-index: 2; position: relative;">
  <div style="margin:50px;background-color: rgba(255, 255, 255, 0.9); padding: 10px; border-radius: 15px; top: 20px;">
  <div class="row">
  <div class="col">
      <div class="alert btn-primary" role="alert" style="text-align: center; font-weight: bold;">
      <img src="img/ironic.gif" style="max-width:100px !important; height:auto !important; left:-60px; top: -60px; position:absolute">
        <i class="fa fa-twitter" aria-hidden="true"></i> Sell anything on twitter in Doge easly and recive the dogecoin money directly on your wallet.
      </div>
  </div>
 </div>

<form id="MuchWow" name="MuchWow" method="post" action="<?php echo($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
  <p style="padding: 10px">This will generate a Tweet. You only have then to select a image after. To work you must have <a href="https://sodogetip.xyz">SoDoge</a> and/or <a href="https://mydoge.com">MyDoge</a> wallet connected to the Twitter account.</p>

<h5><span class="badge" style="background: #0d6efd; border-radius: 50px;">1</span> Add the Twitter username that will recive the Dogecoin money.</h5>
<div class="input-group mb-3">
  <span class="input-group-text" id="basic-doge"><i class="fa fa-twitter" aria-hidden="true"></i></span>
  <input type="text" id="shibe" name="shibe" class="form-control" placeholder="@dogecoin" aria-label="@dogecoin" aria-describedby="basic-doge" required="required">
</div>
<div style="display:none" id="step2">
<h5><span class="badge" style="background: #0d6efd; border-radius: 50px;">2</span> What do you want?</h5>

<div style="padding: 10px; background-color: rgba(204, 204, 204, 1); border-radius: 15px; margin-bottom: 10px">
<div class="form-check">
  <input id="step2check1" class="form-check-input" type="radio" name="type" value="Sell" >
  <label class="form-check-label" for="flexRadioSell">
    Sell (create Product/Service Tweet to be paid in Doge)
  </label>
</div>
<div class="form-check">
  <input id="step2check2" class="form-check-input" type="radio" name="type" value="Donate">
  <label class="form-check-label" for="flexRadioDonation">
    Recive Donations (creating donation Tweet to recive in Doge)
  </label>
</div>
</div>
</div>
<div style="display:none" id="step3">
<h5><span class="badge" style="background: #0d6efd; border-radius: 50px;">3</span> Hashtag for the product or donation reference, title and short description.</h5>
<div class="input-group mb-3">
  <span class="input-group-text" id="basic-desc"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
  <input id="step3check" type="text" name="ref" class="form-control" placeholder="#SuchReference (insert one hashtag)" aria-label="#SuchReference" aria-describedby="basic-doge" required="required">
</div>

<div class="input-group mb-3">
  <span class="input-group-text" id="basic-desc"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
  <textarea class="form-control" placeholder="Much product or donation title and short description" name="desc" maxlength="200" required="required"></textarea>
</div>
</div>
<div style="display:none" id="step4">
<h5><span class="badge" style="background: #0d6efd; border-radius: 50px;">4</span> How much Doge?</h5>
<div class="input-group mb-3">
  <span class="input-group-text" id="basic-doge">&ETH;</span>
  <input id="step4check" type="number" step="any" name="doge" min="0.01" class="form-control" placeholder="420.69" aria-label="420.69" aria-describedby="basic-doge" required="required">
</div>
</div>
<div style="display:none" id="step5">
<div class="row" style="padding-bottom: 10px">
<div class="col"><button type="submit" class="btn btn-primary" name="submit" value="sodoge" style="width: 100%"><i class="fa fa-twitter" aria-hidden="true"></i> Generate Tweet to pay using SoDogeTip! <i class="fa fa-shopping-cart" aria-hidden="true"></i></button></div>
<div class="col"><button type="submit" class="btn btn-warning" name="submit" value="mydoge" style="width: 100%"><i class="fa fa-twitter" aria-hidden="true"></i> Generate Tweet to pay using MyDogeTip! <i class="fa fa-shopping-cart" aria-hidden="true"></i></button></div>
</div>
<button type="submit" class="btn btn-secondary" name="submit" value="sodogemydoge" style="width: 100%"><i class="fa fa-twitter" aria-hidden="true"></i>Generate Tweet to pay using any payment option! <i class="fa fa-shopping-cart" aria-hidden="true"></i></button>
</div>
</form>
</div>
</div>
<script type="text/javascript">

// wen typing we check to show step by step options
$('#MuchWow').on('keydown', function() {
  if($('input#shibe').val().length > 1){
    $('#step2').show("slow");    
  }
  if($('input#step3check').val().length > 1){
    $('#step4').show("slow");
    $('#step5').show("slow");    
  }  
});

$('#MuchWow').on('change', function() {
  if($('#step2check1').is(':checked')){ $('#step3').show("slow"); $("html, body").animate({ scrollTop: $("html, body").height() }, 1000);};
  if($('#step2check2').is(':checked')){ $('#step3').show("slow"); $("html, body").animate({ scrollTop: $("html, body").height() }, 1000);};    
});

</script>
</body>
</html>
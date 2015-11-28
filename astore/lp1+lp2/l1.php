<?php

  require 'libs/Kokarat.php';

  if (isset($_GET['asin'])) {
    $asin = $_GET['asin'];
  } else {
    $asin = 'B00T2GT9L4';
  }

  $affID    = "test-20";
  $siteName = "Offervote.com";
?>
<!DOCTYPE html>
<html>
<head>
  <title><?=$asin?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
  <!-- Apps -->
  <link rel="stylesheet" type="text/css" href="assets/css/app.css">
</head>
<body>
<div class="container">
  <div class="row-fluid">
    <div class="span8 content-block">
      <div class="pagination-centered">
        <iframe src="http://rcm-na.amazon-adsystem.com/e/cm?t=<?=$affID?>&o=1&p=48&l=ur1&category=hallow&banner=0508KX57AAZJ6VEFPKG2&f=ifr" width="728" height="90" scrolling="no" border="0" marginwidth="0" style="border:none;" frameborder="0"></iframe>
        <a href="http://www.amazon.com/gp/product/<?=$asin?>/?tag=<?=$affID?>">
          <img border="0" src="http://ws.assoc-amazon.com/widgets/q?_encoding=UTF8&amp;Format=_SL350_&amp;ID=AsinImage&amp;MarketPlace=US&amp;ServiceVersion=20070822&amp;WS=1&amp;ASIN=<?=$asin?>"/>
        </a>
        <div>

          <a href="http://www.amazon.com/gp/product/<?=$asin?>/?tag=<?=$affID?>"><img src="assets/img/button-more-detials.gif"/> </a> <a href="http://www.amazon.com/gp/offer-listing/<?=$asin?>/?tag=<?=$affID?>"><img src="assets/img/button-check-prices.gif"></a>
        </div>
      </div>
    </div>
    <div class="span4 content-block">
      <div class="pagination-centered">
        <iframe scrolling="no" frameborder="0" marginheight="0" marginwidth="0" style="width:120px;height:240px;" src="http://rcm.amazon.com/e/cm?lt1=_blank&amp;bc1=FFFFFF&amp;IS2=1&amp;bg1=FFFFFF&amp;fc1=000000&amp;lc1=0000FF&amp;t=<?=$affID?> &amp;o=1&amp;p=8&amp;l=as1&amp;m=amazon&amp;f=ifr&amp;ref=tf_til&amp;asins=<?=$asin?>">
        </iframe>
      </div>
    </div>

    <div class="span4 content-block">
      <div class="pagination-centered">
        <iframe src="http://rcm-na.amazon-adsystem.com/e/cm?t=<?=$affID?>&o=1&p=12&l=ur1&category=hallow&banner=0RPBMEGJY1ZD67TEAV82&f=ifr" width="300" height="250" scrolling="no" border="0" marginwidth="0" style="border:none;" frameborder="0"></iframe>
        </iframe>
      </div>
    </div>
  </div>

  <div class="row-fluid">
    <div class="span12 content-block">
      <div class="pagination-centered">
        <p>
          <?=$siteName?> is a participant in the Amazon Services LLC Associates Program, an affiliate advertising program designed to provide a means for sites to earn advertising fees by advertising and linking to amazon.com.
        </p>
        <p>
          CERTAIN CONTENT THAT APPEARS ON THIS SITE COMES FROM AMAZON SERVICES LLC. THIS CONTENT IS PROVIDED 'AS IS' AND IS SUBJECT TO CHANGE OR REMOVAL AT ANY TIME.
          <br>
          Amazon and the Amazon logo are trademarks of Amazon.com, Inc. or its affiliates.
        </p>
      </div>
    </div>
  </div>
</div>

<script src="http://code.jquery.com/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
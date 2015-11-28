<?php

use App\libs\Kokarat;

require 'libs/Kokarat.php';

if (isset($_REQUEST['asin'])) {
    $asin = $_REQUEST['asin'];
} else {
    $asin = 'B00T2GT9L4';
}

$affID    = "test-20";
$siteName = "Offervote.com";

$obj = new Kokarat();

//print_r($obj->dom_request("B00GDQ0RMG"));
$data = $obj->dom_request($asin);
?>
<!DOCTYPE html>
<html>
<head>
  <title><?=$asin?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

<style>
  body {
    margin: 70px;
  }
</style>

</head>
<body>

<div class="bs-example bs-navbar-bottom-example" data-example-id="navbar-fixed-to-bottom">
  <nav class="navbar navbar-default navbar-fixed-top">
    <!-- We use the fluid option here to avoid overriding the fixed width of a normal container within the narrow content columns. -->
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-7" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"><?=$siteName?></a>
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-7">
        <ul class="nav navbar-nav">
<!--          <li class="active"><a href="#">Home</a></li>-->
<!--          <li><a href="#">Link</a></li>-->
<!--          <li><a href="#">Link</a></li>-->
        </ul>
      </div><!-- /.navbar-collapse -->
    </div>
  </nav>
</div>

<div class="container">

  <div class="row">


      <div class="row">
        <div class="col-md-5">
          <a href="http://www.amazon.com/gp/product/<?=$asin?>/?tag=<?=$affID?>">
<!--            <img border="0" src="http://ws.assoc-amazon.com/widgets/q?_encoding=UTF8&amp;Format=_SL350_&amp;ID=AsinImage&amp;MarketPlace=US&amp;ServiceVersion=20070822&amp;WS=1&amp;ASIN=--><?//=$asin?><!--" class="img-responsive"/>-->
            <img src="<?=$data['getBigImage']?>" alt="" class="img-responsive">
          </a>
        </div>
        <div class="col-md-7">
          <strong><?=$data['getTitle']?></strong><br/>
          <strong>Brand :</strong>  <?=$data['getBrand']?><br/>
          <strong>Model: </strong> <?=$data['getModel']?><br/>
          <hr/>
          <strong>Features:</strong>

          <?=$data['ulFeatures']?>

          <div class="text-center">
            <a href="<?=$link_out?>"><button type="button" class="btn btn-warning btn-lg"><h3 class="<?=$title?>" rel="nofollow">Check Last Price Now !!!</h3></button></a>
          </div>
        </div>
      </div>
      <hr/>
      <div class="row">

        <div class="col-md-12">
          <h3>Video</h3>

          <iframe src='http://www.youtube.com/embed?listType=search&list=<?=$data['getTitle']?>' width='840' height='473'/></iframe>

        </div>

        </div>
      </div>
      <hr/>


</div>

<script src="http://code.jquery.com/jquery.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
</body>
</html>
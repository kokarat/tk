<?php
    use App\libs\Kokarat;

    require 'libs/Kokarat.php';

    if (isset($_REQUEST['asin'])) {


        $asin = $_REQUEST['asin'];
        $affID    = "test-20";
        $siteName = "Offervote.com";

        $Amzsite  = 'com';

        $obj = new Kokarat();

        $data = $obj->dom_request($asin);


?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <!-- Your Site Title, Description, Keywords, Author name -->
        <title><?=$data['getTitle']?></title>
        <meta name="description" content="<?=$data['getTitle']?>">
        <meta name="keywords" content="<?=$data['getTitle']?>">
        <meta name="author" content="-------">

        <!-- Google -->
        <meta name="country" content="us"/>
        <meta name="geo.placename" content="United States" />
        <meta name="geo.region" content="usa" />
        <meta name="rating" content="general">
        <meta name="revisit-after" content="3 days" />
        <meta name="robots" content="index, follow" />
        <link rel="profile" href="http://gmpg.org/xfn/11" />

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Stylesheets -->
        <link href="assets/css/bootstrap.css" rel="stylesheet">
        <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
        <link href="assets/css/font-awesome.css" rel="stylesheet">
        <link href="assets/css/apps.css" rel="stylesheet">

        <!-- Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>

        <!-- Socials share -->

        <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
        <script type="text/javascript">stLight.options({publisher: "aadc480f-dbcf-42d5-ac0e-c22b166765f0", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>

    </head>

    <body>
    <header>
        <div class="container">
            <div class="row">
                <div class="span12">
                    <div class="padd">
                        <div class="logo">
                            <!-- Logo Area. You can add your website name or logo image here. -->
                            <h1><a href="http://www.amazon.<?=$Amzsite?>/dp/<?=$asin?>/?tag=<?=$affID?>"><i class="icon-shopping-cart"></i> <?=$data['getTitle']?></a></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="intro">
        <div class="container">
            <div class="row">
                <div class="span5">
                    <!-- Graphic. Replace the below image with your Graphic. -->
                    <div class="screens">
                        <a href="http://www.amazon.<?=$Amzsite?>/dp/<?=$asin?>/?tag=<?=$affID?>">
                            <img src="<?=$data['getBigImage']?>" alt="" class="img-responsive">
                        </a>
                    </div>
                </div>
                <div class="span7">
                    <div class="padd">
                        <div class="cta">
                            <!-- Give some catchy intro here -->
                            <h2><?=$data['getTitle']?></h2>
                            <p class="meta">
                                <strong>Brand :</strong>  <?=$data['getBrand']?><br/>
                                <strong>Model: </strong> <?=$data['getModel']?><br/>
                            </p>
                            <div class="buttons">
                                <div class="button">
                                    <a href="#">&nbsp;</a>
                                </div>
                                <div class="demo">
                                    <a href="http://www.amazon.<?=$Amzsite?>/dp/<?=$asin?>/?tag=<?=$affID?>" class="btn btn-warning btn-large">
                                        <h1><i class="icon-shopping-cart"></i> Read more information</h1>
                                    </a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="span12">
                    <span class='st_facebook_hcount' displayText='Facebook'></span>
                    <span class='st_twitter_hcount' displayText='Tweet'></span>
                    <span class='st_googleplus_hcount' displayText='Google +'></span>
                    <span class='st_pinterest_hcount' displayText='Pinterest'></span>
                </div>
            </div>
        </div>
    </div>



    <div class="main">
        <div class="container">
            <!-- Para -->
            <div class="para">
                <div class="row">
                    <div class="span12">
                        <div class="padd">
                            <h2><span>Product Description</span></h2>
                            <h4><?=$data['getTitle']?> Description</h4>
                            <p><?=$data['ulFeatures']?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($similarHAVE > 0 ){?>
                <!-- Frequently Bought Together -->
                <div class="para">
                    <div class="row">
                        <div class="span12">
                            <div class="padd">
                                <h2><span>Frequently Bought Together</span></h2>
                                <h4>Customers Who Bought This Item Also Bought</h4>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="span3">
                            <a href="http://www.amazon.<?=$Amzsite?>/dp/<?=$similar['asin'][0]?>/?tag=<?=$affID?>"><img src="<?=$similar_image[0]?>" alt="" /><br />
                                <?=$similar_title[0]?>
                            </a>
                        </div>
                        <div class="span3">
                            <a href="http://www.amazon.<?=$Amzsite?>/dp/<?=$similar['asin'][1]?>/?tag=<?=$affID?>"><img src="<?=$similar_image[1]?>" alt="" /><br />
                                <?=$similar_title[1]?>
                            </a>
                        </div>
                        <div class="span3">
                            <a href="http://www.amazon.<?=$Amzsite?>/dp/<?=$similar['asin'][2]?>/?tag=<?=$affID?>"><img src="<?=$similar_image[2]?>" alt="" /><br />
                                <?=$similar_title[2]?>
                            </a>
                        </div>
                        <div class="span3">
                            <a href="http://www.amazon.<?=$Amzsite?>/dp/<?=$similar['asin'][3]?>/?tag=<?=$affID?>"><img src="<?=$similar_image[3]?>" alt="" /><br />
                                <?=$similar_title[3]?>
                            </a>
                        </div>
                    </div>
                </div>
            <?php }?>
            <!-- Buy it Now  -->
            <div class="info">
                <div class="row">
                    <div class="span12">
                        <div class="padd">
                            <div class="buynow">
                                <h2><span>Disclaimer</span></h2>
                                <p>"This site is a participant in the Amazon Services LLC Associates Program, an affiliate advertising program designed to provide a means for sites to earn advertising fees by advertising and linking to this site the applicable site name (amazon.com, endless.com, amazonsupply.com, or myhabit.com)."</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Buy it Now  -->
            <div class="info">
                <div class="row">
                    <div class="span12">
                        <div class="padd">
                            <div class="buynow">
                                <h2><span>Sitemap</span></h2>
                                <p>See web site structure <a href="../sitemap.php">Offervote.com Sitemap</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>   <!-- end container -->
    </div> <!-- end main -->


    <script src="http://code.jquery.com/jquery.js"></script>
    </body>

    </html>

    <?php

    } else {

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <!-- Your Site Title, Description, Keywords, Author name -->
        <meta name="author" content="-------">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Stylesheets -->
        <link href="assets/css/bootstrap.css" rel="stylesheet">
        <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
        <link href="assets/css/font-awesome.css" rel="stylesheet">
        <link href="assets/css/apps.css" rel="stylesheet">

        <!-- Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>

        <!-- Socials share -->

        <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
        <script type="text/javascript">stLight.options({publisher: "aadc480f-dbcf-42d5-ac0e-c22b166765f0", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>

    </head>

    <body>
    <div class="row-fluid container">
        <h1 class="pagination-centered">Sorry you can't access this page !!!</h1>
    </div>
    </body>

    </html>
<?php }?>
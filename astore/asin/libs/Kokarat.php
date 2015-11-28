<?php
	namespace App\libs;

	class Kokarat {

		public function dom_request($asin) {
			require_once ("simple_html_dom.php");

			$amz_amazon_site = "com";
			$amz_aff_id = "test-20";
			$astore_id =  'chiliheads';

			$checkURL = "http://astore.amazon.com/$astore_id/detail/" . $asin;
			$checkImgURL = "http://astore.amazon.com/$astore_id/images/" . $asin;
			$html = file_get_html ( $checkURL );
			$htmlImage = file_get_html ( $checkImgURL );

			// -------- Get Image
			$get_imageViewerLink = $html->getElementById ( "imageViewerLink" );
			$chkData = explode ( "<br>", $get_imageViewerLink );
			$chkData = explode ( "src", $chkData [0] );
			$chkData = explode ( "\"", $chkData [1] );
			$getImage = $chkData [1];

			// -------- Get Big Image
			$chkBigImage = 1; // if have multi big image;
			$get_bigimage = $htmlImage->getElementById ( "content" );
			$chkData = explode ( "text/javascript", $get_bigimage );
			$chkData = explode ( "\"", $chkData [1] );
			$chkArr = 0;
			for($i = 2; $i < count ( $chkData ); $i = $i + 2) {
				$getBigImage [$chkArr] = $chkData [$i];
				$chkArr ++;
			}

			if ($getBigImage [0] == "") {
				// -------- Get Big Image
				$chkBigImage = 0; // if have one big image;
				$get_imageViewerLink = $htmlImage->getElementById ( "bigImage" );
				$chkData = explode ( "<br>", $get_imageViewerLink );
				$chkData = explode ( "src", $chkData [0] );
				$chkData = explode ( "\"", $chkData [1] );
				$getBigImage [0] = $chkData [1];
			}

			$getBigImage = $getBigImage [0];

			// -------- Get Title
			$get_titleAndByLine = $html->getElementById ( "titleAndByLine" );
			$chkData = explode ( "<br>", $get_titleAndByLine );
			$chkData = explode ( "<h2>", $chkData [0] );
			$getTitle = $chkData [1];

			// -------- Get ListPrice
			$get_detailListPrice = $html->getElementById ( "detailListPrice" );
			$chkData = explode ( ">", $get_detailListPrice );
			$chkData = explode ( "<", $chkData [1] );
			$getListPrice = $chkData [0];

			// -------- Get OfferPrice
			$get_detailOfferPrice = $html->getElementById ( "detailOfferPrice" );
			$chkData = explode ( ">", $get_detailOfferPrice );
			$chkData = explode ( "<", $chkData [1] );
			$getOfferPrice = $chkData [0];

			// ---------- Calculate Discount
			$chkListPrice = str_replace ( "$", "", $getListPrice );
			$chkListPrice = str_replace ( ",", "", $chkListPrice );

			$chkOfferPrice = str_replace ( "$", "", $getOfferPrice );
			$chkOfferPrice = str_replace ( ",", "", $chkOfferPrice );

			$discount = $chkListPrice - $chkOfferPrice;
			$getDiscount = "$" . $discount;
			$discountPercent = number_format ( ($discount * 100) / $chkListPrice, 2 ) . "%";

			// -------- Get Availability & New or used available from
			$get_detailheader = $html->getElementById ( "detailheader" );

			// Get Availability
			$chkData = explode ( "<p>", $get_detailheader );
			$chkData = explode ( "</p>", $chkData [1] );
			$chkData = explode ( "</b>", $chkData [0] );
			$getAvailable = str_replace ( "<br>", "", $chkData [1] );

			// Get New or User
			$chkData = explode ( "<br> </p> <p>", $get_detailheader );
			$chkData = explode ( "</a> ", $chkData [1] );
			$chkData = explode ( "\"", $chkData [0] );
			$getNewUrl = $chkData [1];
			$totalOffers = str_replace ( ">", "", $chkData [4] );

			// Get New or User
			$chkData = explode ( "<br> </p> <p>", $get_detailheader );
			$chkData = explode ( "</p>", $chkData [1] );
			$chkData = explode ( "<a href=\"", $chkData [1] );
			$chkData = explode ( "\" target=\"_blank\">", $chkData [2] );
			$getTotalReviewUrl = $chkData [0];

			$chkData = explode ( "customer reviews", $chkData [1] );
			$getTotalReview = $chkData [0];

			// print_r($chkData);
			// echo $getNew;

			// -------- Get Prdduct Detail & Product
			$get_productDetails = $html->getElementById ( "productDetails" );
			$chkHR = array ("<hr>", "<hr/>" );
			$chkData = explode ( "<ul>", $get_productDetails );

			// --- Detail
			$getCheckDetail = explode ( "</ul>", $chkData [1] );
			$getCheckDetail = explode ( "<li>", $getCheckDetail [0] );
			for($i = 1; $i < count ( $getCheckDetail ); $i ++) {
				$getDetail [$i - 1] = str_replace ( "</li>", "", $getCheckDetail [$i] );
			}

			// --- Feature
			$getCheckFeature = explode ( "</ul>", $chkData [2] );
			$getCheckFeature = explode ( "<li>", $getCheckFeature [0] );

			$getCheckFeature = str_replace("<ul>", "", $getCheckFeature);
			$getCheckFeature = str_replace("<li>", "", $getCheckFeature);
			$getCheckFeature = str_replace("</li>", "", $getCheckFeature);
			$getCheckFeature = str_replace("</ul>", "", $getCheckFeature);

			/*
             * for($i=1;$i<count($getCheckFeature);$i++){ $getFeature[$i-1] =
            * str_replace("</li>","",$getCheckFeature[$i]); }
            */

			$ulFeatures = "";
			foreach ( $getCheckFeature as $feature_li ) {
				if ($feature_li !=$feature_li[0]) {
					$ulFeatures .= "<li>" . $feature_li . "</li>";
				}

			}
			$ulFeatures = "<ul>" . $ulFeatures . "</ul>";

			// -------- Get Brand And Model
			$get_productDetails = $html->getElementById ( "productDetails" );
			$chkData = explode ( "<li>", $get_productDetails );
			// -- Brand
			for($i = 0; $i < 10; $i ++) {
				$brand = strpos ( $chkData [$i], "Brand: " );
				if ($brand !== FALSE) {
					$getBrand = $chkData [$i];
					break;
				}
			}

			$getBrand = str_replace ( "</li>", "", $getBrand );
			$getBrand = str_replace ( "Brand: ", "", $getBrand );

			// -- Model
			for($i = 0; $i < 10; $i ++) {
				$model = strpos ( $chkData [$i], "Model: " );
				if ($model !== FALSE) {
					$getModel = $chkData [$i];
					break;
				}

			}

			$getModel = str_replace ( "</li>", "", $getModel );
			$getModel = str_replace ( "Model: ", "", $getModel );

			if ($getModel == '') {
				$getModel = $asin;
			}

			// -------- Get ProductDescription
			$get_productDescription = $html->getElementById ( "productDescription" );
			$chkData = explode ( "<p>", $get_productDescription );
			$chkData = explode ( "</p>", $chkData [1] );
			$getDest = $chkData [0];

			// -------- Get Editoria Reviews
			$get_editorialReviews = $html->getElementById ( "editorialReviews" );
			$chkData = explode ( "class=\"reviewtitle\">", $get_editorialReviews );
			$getAmazonReview = $chkData [1];
			//-------- Get Customer Review
			$get_customerReviews = $html->getElementById("customerReviews");
			$chkData = explode("<br>",$get_customerReviews);
			$totalBy = substr_count($get_customerReviews,"<span>By "); // total review from customer
			if($totalBy == 0){
				// IF No Review
				$customerReview = "Are you looking to buy the " . $getBrand . " " . $getBrand . "? Good news! You can purchase " . $getBrand . " " . $getBrand . " with low price and compare to view best price on this product. Best deals on this product is available only for limited time.";

			}else{

				if($totalBy == 1){
					$lastReview = explode("</p>",$chkData[3]);
					$chkData[3] = $lastReview[0];
				}elseif($totalBy == 2){
					$lastReview = explode("</p>",$chkData[6]);
					$chkData[6] = $lastReview[0];
				}elseif($totalBy == 3){
					$lastReview = explode("</p>",$chkData[9]);
					$chkData[9] = $lastReview[0];
				}

				$arrPointer = 2; //chk Arr chkData
				for($i=0;$i<$totalBy;$i++){
					$getReview[$i] = $chkData[$arrPointer] . "<br>"; //get customer
					$arrPointer++;
					$getReview[$i] .= str_replace("<a href=\"","",$chkData[$arrPointer]); //ger review
					$arrPointer = $arrPointer+2;
				}
				//for($i=0;$i<$totalBy;$i++){}
			}
			//print_r($getReview);
			shuffle($getReview);
			foreach($getReview as $customerReview){
				$customerReview . "<br/>";
			}

			// Product URL
			$ItemUrl = "http://www.amazon." . $amz_amazon_site . "/dp/$asin/?tag=$amz_aff_id";
			// Brand and Model search
			$brand_search = "http://www.amazon." . $amz_amazon_site . "/s/ref=nb_sb_noss?url=search-alias%3Daps&field-keywords=$getBrand&tag=$amz_aff_id";
			$model_search = "http://www.amazon." . $amz_amazon_site . "/s/ref=nb_sb_noss?url=search-alias%3Daps&field-keywords=$getModel&tag=$amz_aff_id";

			if ($getNewUrl == "") {
				$getNewUrl = $ItemUrl;

			}

			if ($totalOffers =='') {
				$totalOffers = "Only one special seller offer now.";
			}

			$ItemPostTime = date ( "d-M-Y h:i:s: a" );

			$ireturn = array();

			// Return
			$ireturn['getTitle'] = $getTitle;
			$ireturn['getDest'] = $getDest;
			$ireturn['getImage'] = $getImage;
			$ireturn['getBigImage'] = $getBigImage;
			$ireturn['getListPrice'] = $getListPrice;
			$ireturn['getOfferPrice'] = $getOfferPrice;
			$ireturn['ulFeatures'] = $ulFeatures;
			$ireturn['getBrand'] = $getBrand;
			$ireturn['getModel'] = $getModel;
			$ireturn['getPostTime'] = $ItemPostTime;
			$ireturn['getTotalOffers'] = $totalOffers;
			$ireturn['getTotalOffersURL'] = $getNewUrl;
			$ireturn['getItemUrl'] = $ItemUrl;
			$ireturn['getCustomerReviews'] = $customerReview;
			$ireturn['getCustomerReviewsURL'] = $getTotalReviewUrl;

			return $ireturn;
		}

		public function greeting(){
			return "Hello";
		}
	}
	?>
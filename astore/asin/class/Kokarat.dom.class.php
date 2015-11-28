<?php
class Kokarat_dom_request {
		public function dom_request($semi_asin) {
		
		require_once ("simple_html_dom.php");

		$checkURL = "http://astore.amazon.com/k-astore-20/detail/" . $semi_asin;
		$checkImgURL = "http://astore.amazon.com/k-astore-20/images/" . $semi_asin;
		$html = file_get_html ( $checkURL );
		$htmlImage = file_get_html ( $checkImgURL );
		

		
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
		return $getBigImage;;
	}
}
?>
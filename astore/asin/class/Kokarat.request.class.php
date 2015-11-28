<?php

class Kokarat_amz_request {
	
	public function kokarat_request_asin($asin) {
		include 'config.php';
		
		$params = array ("MerchantId" => "All", "Operation" => "ItemLookup", "ItemId" => $asin, "ResponseGroup" => "Large,OfferFull,Offers,OfferSummary,Reviews,Similarities,Variations", "AssociateTag" => $amazonAssoc );
		
		$pxml = $this->wpr_aws_request ( $Amzsite, $params, $public_key, $private_key );
		
		return $pxml;
	}
	
	private function aws_signed_request($region, $params, $public_key, $private_key) {
		// some paramters
		$method = "GET";
		$host = "ecs.amazonaws." . $region;
		$uri = "/onca/xml";
		
		// additional parameters
		$params ["Service"] = "AWSECommerceService";
		$params ["AWSAccessKeyId"] = $public_key;
		// GMT timestamp
		$params ["Timestamp"] = gmdate ( "Y-m-d\TH:i:s\Z" );
		// API version
		$params ["Version"] = "2009-03-31";
		
		// sort the parameters
		ksort ( $params );
		
		// create the canonicalized query
		$canonicalized_query = array ();
		foreach ( $params as $param => $value ) {
			$param = str_replace ( "%7E", "~", rawurlencode ( $param ) );
			$value = str_replace ( "%7E", "~", rawurlencode ( $value ) );
			$canonicalized_query [] = $param . "=" . $value;
		}
		$canonicalized_query = implode ( "&", $canonicalized_query );
		
		// create the string to sign
		$string_to_sign = $method . "\n" . $host . "\n" . $uri . "\n" . $canonicalized_query;
		
		// calculate HMAC with SHA256 and base64-encoding
		$signature = base64_encode ( hash_hmac ( "sha256", $string_to_sign, $private_key, True ) );
		
		// encode the signature for the request
		$signature = str_replace ( "%7E", "~", rawurlencode ( $signature ) );
		
		// create request
		$request = "http://" . $host . $uri . "?" . $canonicalized_query . "&Signature=" . $signature;
		// echo $request;
		// do request
		// $response = @file_get_contents($request);
		$session = curl_init ( $request );
		curl_setopt ( $session, CURLOPT_HEADER, false );
		curl_setopt ( $session, CURLOPT_RETURNTRANSFER, true );
		$response = curl_exec ( $session );
		curl_close ( $session );
		
		if ($response === False) {
			return False;
		} else {
			// parse XML
			$pxml = simplexml_load_string ( $response );
			if ($pxml === False) {
				return False; // no xml
			} else {
				return $pxml;
			}
		}
	}
	
	private function wpr_aws_request($region, $params, $public_key, $private_key) {
		libxml_use_internal_errors ( true );
		$method = "GET";
		$host = "ecs.amazonaws." . $region;
		$uri = "/onca/xml";
		
		$params ["Service"] = "AWSECommerceService";
		$params ["AWSAccessKeyId"] = $public_key;
		
		$t = time () + 10000;
		$params ["Timestamp"] = gmdate ( "Y-m-d\TH:i:s\Z", $t );
		$params ["Version"] = "2010-09-01";
		ksort ( $params );
		
		$canonicalized_query = array ();
		foreach ( $params as $param => $value ) {
			$param = str_replace ( "%7E", "~", rawurlencode ( $param ) );
			$value = str_replace ( "%7E", "~", rawurlencode ( $value ) );
			$canonicalized_query [] = $param . "=" . $value;
		}
		$canonicalized_query = implode ( "&", $canonicalized_query );
		$string_to_sign = $method . "\n" . $host . "\n" . $uri . "\n" . $canonicalized_query;
		$signature = base64_encode ( hash_hmac ( "sha256", $string_to_sign, $private_key, True ) );
		$signature = str_replace ( "%7E", "~", rawurlencode ( $signature ) );
		$request = "http://" . $host . $uri . "?" . $canonicalized_query . "&Signature=" . $signature;
		
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; Konqueror/4.0; Microsoft Windows) KHTML/4.0.80 (like Gecko)" );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_URL, $request );
		curl_setopt ( $ch, CURLOPT_TIMEOUT, 60 );
		$response = curl_exec ( $ch );
		
		$response = @file_get_contents ( $request );
		
		$pxml = simplexml_load_string ( $response );
		if ($pxml === False) {
			// $emessage = __ ( "Failed loading XML, errors returned: ",
			// "wprobot" );
			foreach ( libxml_get_errors () as $error ) {
				$emessage .= $error->message . ", ";
			}
			libxml_clear_errors ();
			$return ["error"] ["module"] = "Amazon";
			$return ["error"] ["reason"] = "XML Error";
			// $return ["error"] ["message"] = $emessage;
			return $return;
		} else {
			return $pxml;
		}
	}
	
	public function check_image_existing($image) {
		
		$ch = curl_init ( $image );
		curl_setopt ( $ch, CURLOPT_NOBODY, true );
		curl_setopt ( $ch, CURLOPT_TIMEOUT, 2 );
		curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 2 );
		curl_exec ( $ch );
		if (curl_getinfo ( $ch, CURLINFO_HTTP_CODE ) == 200) {
			// Found Image
			$image_found = 1;
		} else {
			$image_found = 0;
		}
		
		return $image_found;
		curl_close ( $ch );
	
	}
	
	public function generate_user_permalink($str) {
		setlocale ( LC_ALL, 'en_US.UTF8' );
		$plink = iconv ( 'UTF-8', 'ASCII//TRANSLIT', $str );
		$plink = preg_replace ( "/[^a-zA-Z0-9\/_| -]/", '', $plink );
		$plink = strtolower ( trim ( $plink, '-' ) );
		$plink = preg_replace ( "/[\/_| -]+/", '-', $plink );
		
		return $plink;
	
	}
}
?>
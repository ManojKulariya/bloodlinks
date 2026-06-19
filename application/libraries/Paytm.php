<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');


class Paytm {

	public function pgRedirect($param){
		header("Pragma: no-cache");
		header("Cache-Control: no-cache");
		header("Expires: 0");

		if(empty($param)){

			$checkSum = "";
			$paramList = array();


			// Create an array having all required parameters for creating checksum.
			$paramList["MID"] 				= $param['mid'];
			$paramList["ORDER_ID"] 			= $param["order_id"];
			$paramList["CUST_ID"] 			= $param["cust_id"];
			$paramList["INDUSTRY_TYPE_ID"] 	= $param['industry_type_id'];
			$paramList["CHANNEL_ID"] 		= $param['channel_id'];
			$paramList["TXN_AMOUNT"] 		= $param["txn_amount"];
			$paramList["WEBSITE"] 			= $param['mwebsite'];
			$paramList["CALLBACK_URL"] 		= $param['callback'];

			/*$paramList["MSISDN"] = $MSISDN; //Mobile number of customer
			$paramList["EMAIL"] = $EMAIL; //Email ID of customer
			$paramList["VERIFIED_BY"] = "EMAIL"; //
			$paramList["IS_USER_VERIFIED"] = "YES"; //

			*/

			//print_obj($paramList);die;

			//Here checksum string will return by getChecksumFromArray() function.
			$checkSum = getChecksumFromArray($paramList,$param['mkey']);

			//print_obj($checkSum);die;

			return $checkSum;
		}else{
			return 'Prameters are empty';
		}		
	}


	public function pgResponse($param){
		header("Pragma: no-cache");
		header("Cache-Control: no-cache");
		header("Expires: 0");

		if(!empty($param)){
			$paytmChecksum = "";
			$paramList = array();
			$isValidChecksum = "FALSE";

			$paramList = $_POST;
			$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

			//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
			$isValidChecksum = verifychecksum_e($paramList, $param['mkey'], $paytmChecksum); //will return TRUE or FALSE string.

			if($isValidChecksum == "TRUE"){

				if ($_POST["STATUS"] == "TXN_SUCCESS"){
					if (isset($_POST["ORDER_ID"]) && $_POST["ORDER_ID"] != ""){
						// In Test Page, we are taking parameters from POST request. In actual implementation these can be collected from session or DB. 
						$ORDER_ID = $_POST["ORDER_ID"];

						// Create an array having all required parameters for status query.
						$requestParamList = array("MID" => $param['mid'] , "ORDERID" => $ORDER_ID);  
						
						$StatusCheckSum = getChecksumFromArray($requestParamList,$param['mkey']);
						
						$requestParamList['CHECKSUMHASH'] = $StatusCheckSum;

						// Call the PG's getTxnStatusNew() function for verifying the transaction status.
						$responseParamList = getTxnStatusNew($requestParamList);

						if (isset($responseParamList) && count($responseParamList)>0 ){
							$return=$responseParamList;
						}else{
							$return='Paytm Response error';
						}
					}else{
						$return='No Order ID Found';
					}
				}else{
					$return='Transaction Failed';
				}

			}else{
				$return='Checksum mismatched';
			}
		}else{
			$return='Parameter is empty';
		}	

		return $return;
	}


}
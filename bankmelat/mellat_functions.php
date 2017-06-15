<?php
include("lib/JDate.php");

function f_front__f_html($pos)
{
    switch($pos){
		case 1 :
			$prompt= require_once('F_header.php');
			break;
		case 2 :
			$prompt= require_once('F_footer.php');
			break;
		case 3 :
			$prompt= require_once('F_header_message.php');
			break;
        case 4 :
			$prompt= require_once('F_footer_message.php');
			break;		
		DEFAULT :
			$prompt=false;
	}	
	
	return $pos;
}


         /////////////////  v a l i d a t e   p o s t   p a r a m s                         /////////////////////
function validatePosts($postParam,$ErrorCode)
  {
	  if (isset($_POST[$postParam])){
	  $postParam = $_REQUEST[$postParam];
	  return $postParam;
	  }
	  else {
			 f_front__f_html(1);
			echo "
			<h3 style='padding-right:25px;'>
			**********************خطا :$ErrorCode **********************<br/>
			پارامتر	".$postParam ." نامعتبر است. </h3>";
			f_front__f_html(2);
			die ();
	   }
  }
  
  
  ////error handling 
  function getMellatResId( $ResCode  )
{

include("./cons.php");

if(!@mysql_connect($servername,$database_username,$database_password))
{
include("./Error.inc");
exit;
}
if($ResCode==80){
datas($_SESSION['ids'],0,0);
}
if(isset($_SESSION['ids'])){
$_SESSION['ids']="";
$_SESSION['Rink']="";
@session_destroy();
}
mysql_select_db($database_name);
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET 'utf8'");
$getRecord_sql	="select * from table_10 where id=".$ResCode;
$a=mysql_query($getRecord_sql);
while ($row = mysql_fetch_array($a))
{

$b=$row['outs'];
}
return $b;
}


         ///////////////// S o a p s 
 //call verify via nusoap
 function verifySoap($saleCode,$trnsID)
 {
    $trnsID = $trnsID;
   $saleCode=$saleCode;
 
	$client = new nusoap_client('https://pgwstest.bpm.bankmellat.ir/pgwchannel/services/pgw?wsdl');
	$namespace='http://interfaces.core.sw.bps.com/';
	// Check for an error
	$err = $client->getError();
		if ($err) {
			echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
			die();
		}
	
	
				$parameters = array(
			 'terminalId' => your terminal,
			'userName' => 'your user name',
			'userPassword' => "your password",
			'orderId' => $saleCode,
			'saleOrderId' => $saleCode,
			'saleReferenceId' => $trnsID);

		// Call the SOAP method
		$result = $client->call('bpVerifyRequest', $parameters, $namespace);

		// Check for a fault
		if ($client->fault) {
			echo '<h2>Fault in verify soap</h2><pre>';
			print_r($result);
			echo '</pre>';
		 }
		else {

			$resultStr = $result;
			
			$err = $client->getError();
			if ($err) {
				// Display the error
//				echo '<h2>Error</h2><pre>' . $err . '</pre>';
		
		return false;
			} 
		
				else {
					// Display the result
							
					    	$resp=$resultStr;
							
							return $resp;
							
							
				}
		  }
					

							
 }
  
  //call inquiry via nusoap
 function inquirySoap($saleCode,$trnsID)
 {
	$trnsID = $trnsID;
   	$saleCode=$saleCode;
	
	$client = new nusoap_client('https://pgwstest.bpm.bankmellat.ir/pgwchannel/services/pgw?wsdl');
	$namespace='http://interfaces.core.sw.bps.com/';
		// Check for an error
		$err = $client->getError();
		if ($err) {
			// Display the error
			echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
			// At this point, you know the call that follows will fail
		}

			$parameters = array(
			 'terminalId' => your terminal,
			'userName' => 'your user name',
			'userPassword' => "your password",
			'orderId' => $saleCode,
			'saleOrderId' => $saleCode,
			'saleReferenceId' => $trnsID);

		// Call the SOAP method
		$result = $client->call('bpInquiryRequest', $parameters, $namespace);

		// Check for a fault
		if ($client->fault) {
			echo '<h2>Fault in inquiry request</h2><pre>';
			print_r($result);
			echo '</pre>';
		 }
		else {
			$resultStr = $result;
			
			$err = $client->getError();
			if ($err) {
				// Display the error
		//		echo '<h2>Error</h2><pre>' . $err . '</pre>';
	//			die();
	
	return false;
			} 
			else {					// Display the result
							
							$resp=$resultStr;
							
							return $resp;				
							}
		  }
					

							
 }
  //call settle via nusoap
 function settleSoap($saleCode,$trnsID)
 {
   $trnsID = $trnsID;
   $saleCode=$saleCode;
   
	$client = new nusoap_client('https://pgwstest.bpm.bankmellat.ir/pgwchannel/services/pgw?wsdl');
	$namespace='http://interfaces.core.sw.bps.com/';

		// Check for an error
		$err = $client->getError();
		if ($err) {
		echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
		}
			
			
		$parameters = array(
			 'terminalId' => your terminal,
			'userName' => 'your user name',
			'userPassword' => "your password",
			'orderId' => $saleCode,
			'saleOrderId' => $saleCode,
			'saleReferenceId' => $trnsID);

		// Call the SOAP method
		$result = $client->call('bpSettleRequest', $parameters, $namespace);
		// Check for a fault
		if ($client->fault) {
			echo '<h2>Fault Settle</h2><pre>';
			print_r($result);
			echo '</pre>';
		 }
		 else {
				// Check for errors
				$resultStr = $result;
				
				$err = $client->getError();
				if ($err) {
					/*
					// Display the error
					echo '<h2>Error</h2><pre>' . $err . '</pre>';*/
					return false;
				} 
				else {
					// Display the result
							$resp=$resultStr;
							
							return $resp;
							
				}
		  }
 }
 
 
 //call reverse via nusoap
 function reverseSoap($saleCode,$trnsID)
 {
   $trnsID = $trnsID;
   $saleCode=$saleCode;
   
	$client = new nusoap_client('https://pgwstest.bpm.bankmellat.ir/pgwchannel/services/pgw?wsdl');
	$namespace='http://interfaces.core.sw.bps.com/';
		// Check for an error
		$err = $client->getError();
		if ($err) {
			// Display the error
			echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
			// At this point, you know the call that follows will fail
		}

$parameters = array(
			 'terminalId' => your terminal,
			'userName' => 'your user name',
			'userPassword' => "your password",
			'orderId' => $saleCode,
			'saleOrderId' => $saleCode,
			'saleReferenceId' => $trnsID);

		// Call the SOAP method
		$result = $client->call('bpReversalRequest', $parameters, $namespace);
		// Check for a fault
		if ($client->fault) {
			echo '<h2>Fault in Rerse Money</h2><pre>';
			print_r($result);
			echo '</pre>';
		 }
		 else {
				// Check for errors
							$resultStr = $result;
				$err = $client->getError();
				if ($err) {
					/*
					// Display the error
					echo '<h2>Error</h2><pre>' . $err . '</pre>';
					*/
					return false;
				} 
				else {
					// Display the result
							$resp=$resultStr;
							
							return $resp;
				}
		  }
					

							
 }
 

function amo($x){
include("./cons.php");
if(!@mysql_connect($servername,$database_username,$database_password))
{
include("./Error.inc");
exit;
}
if($x==""){return 0;die();}

mysql_select_db($database_name);
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET 'utf8'");
if($row = mysql_fetch_array(mysql_query("select * from information where refid='$x'")))
{
return $row['Amount'];
}
}
 
 

 
 
?>
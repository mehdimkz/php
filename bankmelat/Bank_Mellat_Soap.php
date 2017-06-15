<?php

session_start();

?>
<script language="javascript" type="text/javascript">    
		function postRefId (refIdValue) {
			var form = document.createElement("form");
			form.setAttribute("method", "POST");
			form.setAttribute("action", "https://pgwtest.bpm.bankmellat.ir/pgwchannel/startpay.mellat");         
			form.setAttribute("target", "formresult");
			var hiddenField = document.createElement("input");              
			hiddenField.setAttribute("name", "RefId");
			hiddenField.setAttribute("value", refIdValue);
			form.appendChild(hiddenField);

			document.body.appendChild(form);         
			form.submit();
			document.body.removeChild(form);
			
		}
</script>

<?php

include_once ("./lib/nusoap.php");
include_once ("./mellat_functions.php"); 
include_once("lib/JDate.php");
include("cnn.php");

$num=rand();
$pool=$_POST['pul'];

//get post data from your app
    if ($pool!="")
    {

	$amount = $pool ;
	$orderId =$num;   
	$date =  date("Ymd");
    $time =  date("His");

	$callbackUrl = "your call back url";
	$namespace='http://interfaces.core.sw.bps.com/';
		
    $_SESSION['payinfo']=$_POST['pul'];
		$_SESSION['name']="your post name";
	$_SESSION['family']="family post name for payment";
	$_SESSION['email']="email paymenter";
	$_SESSION['toz']="desceription of Payment";

	
		
		
		// executeservice method
		
	$client = new nusoap_client('https://pgwstest.bpm.bankmellat.ir/pgwchannel/services/pgw?wsdl');


		// Check for an error
		        $err = $client->getError();
			    if ($err) {
				f_front__f_html(1);
				f_front__f_html(3);
				
				// Display the error
				echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
				// At this point, you know the call that follows will fail
				f_front__f_html(4);
				f_front__f_html(2);
				die();
			    }
  
		$parameters = array(
            'terminalId' => "649544",
			'userName' => "online",
			'userPassword' => "6661",
			'orderId' => $orderId,
			'amount' => $amount,
			'localDate' => $date,
			'localTime' => $time,
			'additionalData' =>  'موضوع پرداخت',
			'callBackUrl' => $callbackUrl,
			'payerId' => "0");


           


print_r($parameters);

		// Call the SOAP method
$result = $client->call('bpPayRequest', $parameters,$namespace);
		
			
		
		  // Check for a fault
		    if ($client->fault) {
			f_front__f_html(1);
			f_front__f_html(3);

			echo '<h2>Fault</h2><pre>';
			print_r($result);
			echo '</pre>';
			f_front__f_html(4);
			f_front__f_html(2);
			die();
		    } 
		    else {
				// Check for errors
							$resultStr  = $result;
							
			$err = $client->getError();
			
				    if ($err) {
					f_front__f_html(1);
					f_front__f_html(3);

					// Display the error
					echo '<h2>Error</h2><pre>' . $err . '</pre>';
					f_front__f_html(4);
					f_front__f_html(2);
					die();
				    } 
				    else {
					// Display the result
				  
					      
				           $res = explode (',',$resultStr);
                           settype($res[0],"string");
						   settype($res[1],"string");

						   $ResCode = $res[0];
						   $Hashcode = $res[1];
								if ($ResCode == 0) {
								//here insert Hashcode to your databse and log it
								
//datas($Hashcode,$amount,0);

$_SESSION['ids']=$Hashcode;				
$x=$Hashcode;
if($row = mysql_fetch_array(mysql_query("select max(id) from information")))
{
$o=$row['max(id)']+1;
}
else
{
$o=0;
}
$s="Rink".time();
$datepsh=jdate("Y")."/".jdate("m")."/".jdate("d");
$datep=jdate("Ymd");
$pardakhtinfo=$_SESSION['payinfo'];
$nam=$_SESSION['name'];
$famil=$_SESSION['family'];
$email=$_SESSION['email'];
$com=$_SESSION['toz'];
$y=$pool;
mysql_query("insert into information values('$o','".$x."','$y','".date("Y-m-d H:i:s")."','$s','". $pardakhtinfo ."','". $datep ."','". $datepsh ."','". $nam ."','". $famil ."','". $email ."','". $com ."')");




$_SESSION['Rink']="https://pgwtest.bpm.bankmellat.ir/pgwchannel/payment.mellat?RefId=$Hashcode";								


								
						echo "<script language='javascript' type='text/javascript'>postRefId('" . $res[1] . "');</script>";								
								
								

								} 
								
								else {
							// log error in app
							
							
							///
								f_front__f_html(1);
								f_front__f_html(3);
								echo "خطایی در سیستم به وجود آمده است <b>شماره خطا</b> :"; 
								echo $ResCode ;
								echo "<br/>";
                                $GetMeesage =  getMellatResId( $ResCode  );
				                echo $GetMeesage." <br>";
								
							 
							 ///
		   
								echo "شماره سفارش :".$orderId;
								
								f_front__f_html(4);
								f_front__f_html(2);
								die();
								}
							
							
				          
				   }// end Display the result
	
             }// end Check for errors
	}
	
	
	else{//no sale code
				f_front__f_html(1);
				f_front__f_html(3);

echo "<div dir='rtl'>سفارش نامعتبر است</div>";
				f_front__f_html(4);
				f_front__f_html(2);
		
		        die();
	}

?>
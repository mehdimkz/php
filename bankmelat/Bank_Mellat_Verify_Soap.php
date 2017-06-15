<?php 
error_reporting(E_ERROR | E_PARSE);
session_start();

						include("cnn.php");
include_once ("./lib/nusoap.php");
include_once ("./mellat_functions.php"); 

set_time_limit("500");

// check if referre is Mellat bank
if (preg_match("/pgwtest.bpm.bankmellat.ir/",$_SESSION['Rink'])) {
		 $bank = 1;//we set mellat bank id to 1 in app;
} else {
	
		  mysql_query("delete from information where refid='" . $_SESSION['ids'] . "'; ");
f_front__f_html(1);
			f_front__f_html(3);
			echo "دسترسی غیر قانونی";
			
			f_front__f_html(4);
			f_front__f_html(2);

		    die();

		  
}
//validate posts
if($_POST['ResCode']!=0)
{
	echo "<META http-equiv='Content-Type' content='text/html; charset=utf-8'' >";
							  			  mysql_query("delete from information where refid='" . $_SESSION['ids'] . "'; ");
								f_front__f_html(1);
								f_front__f_html(3);
				               echo getMellatResId($_POST["ResCode"]);	   
								f_front__f_html(4);
								f_front__f_html(2);

		
								die(); 
								
}
$refID = validatePosts("RefId" , 1);
$saleCode = validatePosts("SaleOrderId" , 2);
$status = validatePosts("ResCode" , 3);		
$trnsID = validatePosts("SaleReferenceId" , 4);      
$dat =  date("Y-m-d H:i:s");     



if (($status == 0) && ($bank == 1)){



		if (!$bank){
				  mysql_query("delete from information where refid='" . $_SESSION['ids'] . "'; ");
		f_front__f_html(1);
		f_front__f_html(3);
		echo "<p>متاسفانه قبلا از این رسید دیجیتالی استفاده گردیده است . لطفا در صورت اطمینان از عدم استفاده با پشتیبانی تماس حاصل فرمایید</P>";
		echo "</br>";
		echo "<b>شماره رسید دیجیتالی </b>:";
		echo $trnsID;
		f_front__f_html(4);
		f_front__f_html(2);

		die();
		}
		// begin soaps
		else { 
		// get amount from app
		
//888888		$amount =amo($_SESSION['ids']);  

// !!!! some function to get amount from app az tarighe ids mablagh migirad
// in male version ghadim baraye gereftan Amount ast dar inje bahash kar nadarim :)
		//call verify function
		         #$callverify= verifySoap($dat,$refID,$amount);
		         
 $callverify= verifySoap($saleCode,$trnsID);
		         //if verify failed call inquiry
			 if ($callverify!=0){
				 
					 	   //call inquiry function
						   $callinquiry = inquirySoap($saleCode,$trnsID); 
						   if ($callinquiry == 0 ){
						  
						   //log success in app here
						   //set parameters
						   $ResCode =  0;
						   $PaygiryID =  $trnsID;
						   
						   //call Settle function
                 		   $callsettle = settleSoap($saleCode,$trnsID); 
					           //write Settle result in db
						   if ($callsettle == 0 ){

						
						   //log success in app here
						   //$comment = "عملیات تایید واریز نهایی در بانک انجام گردید";
						   //save $comment in salecode row in database
             					   //
							   }
							   else{//settle failed

							   //log failed in app here
							   $comment = "عملیات تایید واریز نهایی در بانک انجام نگردید.با پشتیبانی تماس حاصل فرمایید";
							   //save $comment in salecode row in database
							  			  mysql_query("delete from information where refid='" . $_SESSION['ids'] . "'; ");
								f_front__f_html(1);
								f_front__f_html(3);
				                echo $comment." <br>";	   
								f_front__f_html(4);
								f_front__f_html(2);

									@session_destroy();
								die(); 
							   
							   } 
							}//end if ($callinquiry == "SUCCESS" )
							else{
		  mysql_query("delete from information where refid='" . $_SESSION['ids'] . "'; ");
f_front__f_html(1);
								f_front__f_html(3);
					//			datas($_SESSION['ids'],0,$trnsID);
//						mysql_query("update information set Response='" . $trnsID . "' where  refid='" . $_SESSION['ids'] . "'; ");

echo "تراکنش به پيگيري نیاز دارد";
				               echo " <br>";
				               echo "لطفا با آدرس زیر مکاتبه نمایید"	   ;
				               echo "<br>";
				               echo "your email support<br>";
								echo "شماره پیگیری:".$trnsID;
								f_front__f_html(4);
								f_front__f_html(2);
								@session_destroy();
								die();
						        //write inquiry failed result in db
							//call reverse function
							$callreverse = reverseSoap($saleCode,$trnsID); 
							//write reverse result in db
								   if ($callreverse == 0 ){
								   //failed verify and inquiry--- sucsses reverse 
								   $comment = "عملیات بازگشت پول پرداختی انجام گردید";
								   
								   //write reverse sucsses result in db
								   f_front__f_html(1);
								   f_front__f_html(3);
								   echo $comment."<br>";
								   exit("Sorry, connection to Mellat Bank failed after retrying several times. the amount has been reversed. Please try later or contact support ");
								   f_front__f_html(4);
								   f_front__f_html(2);
								   die();
								   }
								   else{
								   //failed verify and inquiry and reverse
								   //write reverse failed result in db
								   $comment = "پرداخت انجام نیافت";
								   //save $comment in salecode row in database
								   ///
								   f_front__f_html(1);
								   f_front__f_html(3);
								  echo $comment."<br>";						 
								   exit("Sorry, connection to Mellat Bank failed after retrying several times. the amount has  <b>not</b> been reversed. Please try later or contact support ");
								   f_front__f_html(4);
								   f_front__f_html(2);
								   }
						      }//end if verify failed call inquiry and settle and if inquiry failed call reverse
							 
                 }//end unsucessful verify
				 else //sucessful verify
				 {		     
				 	   // log success of verify in database
					   // Display the verify result

					   $ResCode = $callverify;
					   
		if($ResCode!='0')	
		{
			
			                  	f_front__f_html(1);
								f_front__f_html(3);
								echo "<br>";
echo getMellatResId(80);	   
echo "<br>";
								f_front__f_html(4);
								f_front__f_html(2);
				                die();			
		}
					   
					   
					   
						$callsettle = settleSoap($saleCode,$trnsID); 
					       //write Settle result in db
						   if ($callsettle == 0 ){ 
						   	                  	
								f_front__f_html(1);
								f_front__f_html(3);
								//datas($_SESSION['ids'],0,$PaygiryID);
					mysql_query("update information set Response='" . $trnsID . "' where  refid='" . $_SESSION['ids'] . "'; ");
                                $GetMeesage =  getMellatResId( $ResCode  );
				                echo $GetMeesage." <br>";	   
								echo "شماره پیگیری:".$trnsID;
								f_front__f_html(4);
								f_front__f_html(2);
								@session_destroy();
								die();		
                  				
						   }
						   else 
						   {
						   			  mysql_query("delete from information where refid='" . $_SESSION['ids'] . "'; ");						   	                  		
							    f_front__f_html(1);
								f_front__f_html(3);
	
	//datas($_SESSION['ids'],0,$trnsID);
//		mysql_query("update information set Response='" . $trnsID . "' where  refid='" . $_SESSION['ids'] . "'; ");

echo "تراکنش به پیگری نیاز دارد";
				               echo " <br>";
				               echo "لطفا با آدرس زیر مکاتبه نمایید"	   ;
				               echo "<br>";
				               echo "your email support<br>";
								echo "شماره پیگیری:".$trnsID;
								f_front__f_html(4);
								f_front__f_html(2);
									@session_destroy();
								die();		
						   }
					   
					   
					   
				  }         //end of sucess verify	

	   if ($ResCode == 0) {
	   //check if pay amount is equal to order Amount

	                       //call Settle

                	/*       $callsettle = settleSoap($trnsID); 

      			       //write Settle result in db

			       if ($callsettle == "SUCCESS" ){*/
			       	
        					// $comment = "عملیات تایید واریز نهایی در بانک انجام گردید";
                  				//save $comment in salecode row in database
                  				f_front__f_html(1);
								f_front__f_html(3);
//								datas($_SESSION['ids'],0,$trnsID);
								
		
		mysql_query("update information set Response='" . $trnsID . "' where  refid='" . $_SESSION['ids'] . "'; ");
								
								
								
                                $GetMeesage =  getMellatResId( $ResCode  );
				                echo $GetMeesage." <br>";	   
								echo "شماره پیگیری:".$trnsID;
								f_front__f_html(4);
								f_front__f_html(2);
									@session_destroy();
								die();		
                  				
			#}
				/*else{

						//$comment = "عملیات تایید واریز نهایی در بانک انجام نگردید.با پشتیبانی تماس حاصل فرمایید";
						//save $comment in salecode row in database
				} */
				// insert PaygiryID from bank to order
				// get order details from app
				// do necessary order processinh here based on order and your shop product as send mail , sms or pin code of product and .....
				// send to confirm page and show virtual product

				 #header("Location: https://www.yourshop.com/index.php?order_detailed=$saleCode");
				 
				}//pay amount is  not equal to order Amount
		
				//else {//pay amount is  not equal to order Amount

				//$comment = "پرداخت انجام نیافت";
				//save $comment in salecode row in database
				
//		}//end of rescode=00	
       }//end of soaps
}//if status == 00
else {
                        $GetMeesage =  getMellatResId( $status  );
			$Message = $GetMeesage["Message"];
			///log again .do it for ever :) !!!!
			f_front__f_html(1);
		        f_front__f_html(3);
				  mysql_query("delete from information where refid='" . $_SESSION['ids'] . "'; ");
			echo "خطايي در سيستم به وجود آمده است <b>شماره خطا</b>:$status <br/>"; 
			echo $GetMeesage;
			echo "<br/> با پشتیبانی تماس حاصل فرمایید ";
			 echo "<br>your email support";
			f_front__f_html(4);
			f_front__f_html(2);
												@session_destroy();
		        die();
}

/// Display the request and response
//echo '<h2>Request</h2>';
//echo '<pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
//echo '<h2>Response</h2>';
//echo '<pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
////// Display the debug messages
//echo '<h2>Debug</h2>';
//echo '<pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';
?>
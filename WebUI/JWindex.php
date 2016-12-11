<!DOCTYPE HTML>
<html>
 <head>
   <meta charset="utf-8" />
   <title>BPM-WebUI-Group10</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
   <script type="text/javascript" src="bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
   <link rel="icon" href="img/kirsche.png" type="image/png">
   <link rel="stylesheet" type="text/css" href="bootstrap-3.3.5-dist/css/bootstrap.css"/>

   <style>
	html{
		position: relative;
		min-height: 100%;
	}
    #head {
       background-color: #19425b;
    }
    #head-text {
       color: #FFF;
    }	
	#sog-footer {
		background-color: #19425b;
		color: #FFF;
		position: absolute;
		left: 0;
		bottom: 0;
		height: 20px;
		width: 100%;
		overflow:hidden;
	}
	.sog-product-area {
		min-height: 100%;
	}

	.container {
		padding-bottom: 20px;
	}
	label {
		padding-top: 5px;
	}
   </style>

 </head> 
   
<?php 
	// for testing and presentation, wsdl cache should probably be disabled
	ini_set("soap.wsdl_cache_enabled", "0");
	
?>
   
   
 <body>
   <nav class="navbar navbar-inverse">
      <div class="container-fluid" id="head">
         <div class="navbar-header">
            <a class="navbar-brand" id="head-text" href="index.html">
               SoG-Shop (Group10)
            </a>
         </div>
      </div>
   </nav>

   <div class="container">
	  <div class="col-sm-2 col-md-3"></div>
	  <div class="col-sm-8 col-md-6">

<?php 		   
	try
	{	
		// create the SoapClient
		// http://stackoverflow.com/questions/15300843/creating-a-soap-call-using-php-with-an-xml-body
		$webSv = new SoapClient("http://46.101.159.46:" . $_GET["port"] . "/ode/processes/ConductOrder?wsdl",
					array(
						'location' => "http://46.101.159.46:" . $_GET["port"] . "/ode/processes/ConductOrder",
						'uri' => 'http://de.ustutt.simtech',
						'trace' => 1,
				        'use' => SOAP_LITERAL,
						'type' => SOAP_DOCUMENT)
					);

	  	// $textxml contains the input data for the WS as a SoapVar
		$data = new SoapVar(
					"<tns:ConductOrderRequest xmlns:tns=\"http://de.ustutt.simtech\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"><tns:input><tns:customerID>" . $_GET["cid"] . "</tns:customerID><tns:products><tns:product><tns:productId>" . $_GET["pid1"] . "</tns:productId><tns:numberOfItems>" . $_GET["pno1"] . "</tns:numberOfItems></tns:product><tns:product><tns:productId>" . $_GET["pid2"] . "</tns:productId><tns:numberOfItems>" . $_GET["pno2"] . "</tns:numberOfItems></tns:product></tns:products><tns:shipingAddress>" . $_GET["address"] . "</tns:shipingAddress><tns:paymentDetails><tns:bankName>" . $_GET["bn"] . "</tns:bankName><tns:bankAddress>" . $_GET["bic"] . "</tns:bankAddress><tns:accountNumber>" . $_GET["iban"] . "</tns:accountNumber><tns:accountHolderName>" . $_GET["ah"] . "</tns:accountHolderName></tns:paymentDetails><tns:shippingDate>" . $_GET["sd"] . "</tns:shippingDate></tns:input></tns:ConductOrderRequest>", 
					XSD_ANYXML);

		//echo("</br> <b>Web Service Call:</b> </br>" );
		// $param = new SoapParam($data, 'Data');
		$soapReply = $webSv->process($data);
	   
	  }
	  catch (Exception $e)
	  {
  			echo 'Exception: ' . $e->getMessage();	  
	  }	  

	  if($soapReply->result != NULL){
		  echo "<div class=\"alert alert-success\"><font size=\"5\">";
		  echo $soapReply->result;
		  echo "<br>The delivery will be made to: ". $_GET["address"];
		  echo "<br>Thank you for shopping at SoG-Shop. Enjoy your delicious food!";
		  echo "</font></div>";
	  }
	  else{
		  echo "<div class=\"alert alert-danger\">";
		  echo "<br>We are experiencing some problems with our shop. Please come again later.";
		  echo "</div>";
	  }
	  	
	  ?>
	
	</div> 
	
	<div class="col-sm-2 col-md-3"></div>	   
    </div> 

    <div class="container-fluid"  id="sog-footer">
       (C) Manh Phi Nguyen, Johannes Wanner, Jens Thenent, 2016
    </div>

 </body>
</html>

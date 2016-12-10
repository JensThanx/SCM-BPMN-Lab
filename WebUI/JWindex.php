<!DOCTYPE HTML>
<html>
 <head>
   <meta charset="utf-8" />
   <title>BPM-WebUI-Group10</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
   <script type="text/javascript" src="script.js"></script>
   <script type="text/javascript" src="bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
   <link rel="stylesheet" type="text/css" href="bootstrap-3.3.5-dist/css/bootstrap.css"/>
<?php 
ini_set("soap.wsdl_cache_enabled", "0");
	class paymentDetails {
		
		function paymentDetails($varbankName, $varbankAddress, $varaccountNumber, $varaccountHolderName){
			$this->bankName = $varbankName;
			$this->bankAddress = $varbankAddress;
			$this->accountNumber = $varaccountNumber;
			$this->accountHolderName = $varaccountHolderName;
		}
	}
	
	class product{
		
		function product($_productId, $_numberOfItems){
			$this->productId = $_productId;
			$this->numberOfItems = $_numberOfItems;
		}
	}

	/*
	<tns:productId>44162d90-9315-4acc-980e-cf975c6b9397</tns:productId>
	<tns:numberOfItems>1</tns:numberOfItems>
	*/
	
//	var_dump($webSv->checkAvailability(array('productId' => '479e8b20-3697-4609-9ed6-bde2a4b22e41')));
    ?>
   <style>
		html{
			position: relative;
			min-height: 100%;
		}
	    #head {
	       background-color: #116;
	    }
		#footer {
			background-color: #EEF;
			position: absolute;
			left: 0;
			bottom: 0;
			height: 20px;
			width: 100%;
			overflow:hidden;
		}
		.container {
			padding-bottom: 20px;
		}
   </style>
<nav class="navbar navbar-inverse">
      <div class="container-fluid" id="head">
         <div class="navbar-header">
            <a class="navbar-brand" href="#">
               BPM-WebUI-Group10
            </a>
         </div>
      </div>
   </nav>
 </head>

 <body>
   
   
   <div class="container">
      <div id="alertspace"></div>
	  <div class="col-sm-2 col-md-3"></div>
      
	  <div class="col-sm-8 col-md-6">
	<?php 
	//"479e8b20-3697-4609-9ed6-bde2a4b22e41",
	try
	{
  	$webSv = new SoapClient("http://46.101.159.46:32845/ode/processes/ConductOrder?wsdl");
  	$webSv2 = new SoapClient("C:\eclipse\eclipse_win64\workspace\sync\\rev0\FlowSOG.wsdl");
  	
  	$list = $webSv->__getFunctions();
  	var_dump($list);
  	echo("</br></br>");
  	$list = $webSv2->__getFunctions();
  	var_dump($list);
  	echo("</br></br>");
	$testxml = '
  	<tns:ConductOrderRequest xmlns:tns="http://de.ustutt.simtech" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
  	<tns:input>
	  	<tns:customerID>tns:customerID</tns:customerID>
	  	<tns:products>
		  	<tns:product>
			  	<tns:productId>44162d90-9315-4acc-980e-cf975c6b9397</tns:productId>
			  	<tns:numberOfItems>1</tns:numberOfItems>
		  	</tns:product>
		  	<tns:product>
			  	<tns:productId>3bae3778-8577-4b36-9572-a0b020931ba5</tns:productId>
			  	<tns:numberOfItems>2</tns:numberOfItems>
		  	</tns:product>
	  	</tns:products>
	  	<tns:shipingAddress>Max Mustermann, Musterstr. 1, 12345 Musterstadt</tns:shipingAddress>
	  	<tns:paymentDetails>
		  	<tns:bankName>Muster Bank</tns:bankName>
		  	<tns:bankAddress>SOLADEST600</tns:bankAddress>
		  	<tns:accountNumber>DE02600501017495530102</tns:accountNumber>
		  	<tns:accountHolderName>Max Mustermann</tns:accountHolderName>
	  	</tns:paymentDetails>
	  	<tns:shippingDate>2016-12-24</tns:shippingDate>
  	</tns:input>
  	</tns:ConductOrderRequest>
  	';
	
	 
	 
	 $xmlr = new SimpleXMLElement('<tns:ConductOrderRequest xmlns:tns="http://de.ustutt.simtech" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
  								   </tns:ConductOrderRequest>');
  //	 $xmlr->addAttribute("tns", "http://de.ustutt.simtech");
 // 	 $xmlr->addAttribute("xsi", "http://www.w3.org/2001/XMLSchema-instance");
  	  
	 
	 $xmlInput = $xmlr->addChild('tns:input');
  	 $xmlInput->addChild('tns:customerID', $_GET["cid"]);
  	 
  	 $xmlpros = $xmlInput->addChild('tns:products');
  	 $xmlproduct =$xmlpros->addChild('tns:product');
	 $xmlproduct->addChild('tns:productId', $_GET['pid1']);
	 $xmlproduct->addChild('tns:numberOfItems', $_GET['pno1']);

	 $xmlproduct2 = $xmlpros->addChild('tns:product');
	 $xmlproduct2->addChild('tns:productId', $_GET['pid2']);
	 $xmlproduct2->addChild('tns:numberOfItems', $_GET['pno2']);
	 
  	 $xmlInput->addChild('tns:shippingAddress',  $_GET["address"]);
  	 $xmlPayment = $xmlInput->addChild('tns:paymentDetails');
  	 $xmlPayment->addChild('tns:bankName',$_GET["bn"]);
  	 $xmlPayment->addChild('tns:bankAddress', $_GET["bic"]);
  	 $xmlPayment->addChild('tns:accountNumber', $_GET["iban"]);
  	 $xmlPayment->addChild('tns:accountHolderName', $_GET["ah"]);
  	 $xmlInput->addChild('tns:shipingDate', $_GET["sd"]);
	 
  	
  	 
  	 
  	 
  	  
  	 $params = new stdClass();
  	 $params->xml = $xmlr->asXML();
  	 
  	 $ConductOrderparam2 = array(
  			"input" => array(
	  			"customerID" => $_GET["cid"],
  					"products" => array(
			  			"product" => array(
			  								"productId" =>$_GET['pid1'],
			  								"numberOfItems"		=> $_GET['pno1']),
			  			"product" => array(
			  								"productId" =>$_GET['pid2'],
			  								"numberOfItems"		=> $_GET['pno2']),
  				),	
	  			"shipingAddress" => $_GET["address"],
	  			"paymentDetails" => array(
	  					"bankName" =>$_GET["bn"],
	  					"bankAddress" =>$_GET["bic"],
	  					"accountNumber" => $_GET["iban"],
	  					"accountHolderName" => $_GET["ah"]
	  					),  	 
	  			"shippingDate" => $_GET["sd"]
  			) 
  	);
	$ConductOrderparam = array(
  			"input" => array(
			  	"customerID" => $_GET["cid"], 
  				"products" => array(
				  	"product" => array(new product($_GET['pid1'], $_GET['pno1']) ),
				  	"product" => array(new product($_GET['pid2'], $_GET['pno2']) ), 
  							),		 
			  	"shipingAddress" => $_GET["address"],
			  	"paymentDetails" => new paymentDetails($_GET["bn"], $_GET["bic"], $_GET["iban"], $_GET["ah"]),
			  	"shippingDate" => $_GET["sd"]
		  		)
		  	);
// 	  echo("</br> <b>Parameters:</b> </br>" );
// 	  var_dump($ConductOrderparam);
// 	  echo("</br><b> Parameters2:</b> </br>" );
// 	  var_dump($ConductOrderparam2);
	  echo("</br> <b>ParametersXML:</b> </br>" );
	  var_dump($xmlr->asXML());
	 // echo("</br> <b>Web Service Call1:</b> </br>" );
	  //var_dump($webSv->conductOrder($testxml->xml) );
	  
	  //echo("</br> <b>Web Service Call2:</b> </br>" );
	  //var_dump($webSv->conductOrder($testxml->xml) );
	echo("</br> <b>Getfunction:</b> </br>" );
	var_dump($webSv->__getFunctions());
	  
	  echo("</br> <b>Web Service Call3:</b> </br>" );
	  $options = array (uri => "http://de.ustutt.simtech");
	  $webSv->conductorder($ConductOrderparam);
	  //var_dump($webSv->__soapCall("ConductOrder", $ConductOrderparam, $options) );
	  var_dump($webSv->__soapCall("conductOrder",array( $xmlr->asXML()), $options) );
	   
	  }
	  catch (SoapFault $e)
	  {
  			echo 'SOAP Fault: ' . $e->getMessage();	  	
	  }
	  catch (Exception $e)
	  {
  			echo 'SOAPE Exception: ' . $e->getMessage();	  
	  }	  

	  	
	  ?>
            

       </div> 
	
	<div class="col-sm-2 col-md-3"></div>	   
    </div> 

    <div class="container-fluid" id="footer">
       (C) Manh Phi Nguyen, Johannes Wanner, Jens Thenent, 2016
    </div>

 </body>
</html>

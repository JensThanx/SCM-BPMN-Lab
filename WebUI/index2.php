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
<?php 

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

//	$webSv = new SoapClient("C:\eclipse\eclipse_win64\workspace\ManhS\ConductOrderArtifacts.wsdl");

	$webSv = new SoapClient("http://46.101.159.46:32770/ode/processes/ConductOrder?wsdl");
 	$webSv2 = new SoapClient("C:\eclipse\eclipse_win64\workspace\sync\\rev0\FlowSOG.wsdl");
// 	$webAS = new SoapClient("C:\eclipse\eclipse_win64\workspace\\test\ConductOrderArtifacts.wsdl");
// 	$webAS2 = new SoapClient("C:\eclipse\eclipse_win64\workspace\\test\FlowSOG.wsdl");
	$list = $webSv->__getFunctions();
	var_dump($list);
	?>
	 </br>
	 </br>
	<?php
	$list = $webSv2->__getFunctions();
	var_dump($list);
	?>
	 </br>
	 </br>
	 <?php 
//	var_dump($webSv->checkAvailability(array('productId' => '479e8b20-3697-4609-9ed6-bde2a4b22e41')));
              
	?>
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

 <body>
   <nav class="navbar navbar-inverse">
      <div class="container-fluid" id="head">
         <div class="navbar-header">
            <a class="navbar-brand" href="#">
               BPM-WebUI-Group10
            </a>
         </div>
      </div>
   </nav>
   
   <div class="container">
      <div id="alertspace"></div>
	  <div class="col-sm-2 col-md-3"></div>
      
	  <div class="col-sm-8 col-md-6">
	  <?php 
	  //"479e8b20-3697-4609-9ed6-bde2a4b22e41",
	  
	  $ConductOrderparam = array(
		  	"customerID" => $_GET["cid"],
		  	"product" => new product($_GET['pid1'], $_GET['pno1']),
		  	"product" => new product($_GET['pid2'], $_GET['pno2']),  		 
		  	"shipingAddress" => $_GET["address"],
		  	"paymentDetails" => new paymentDetails($_GET["bn"], $_GET["bic"], $_GET["iban"], $_GET["ah"]),
		  	"shippingDate" => $_GET["sd"]
		  	
		  	);
		  	
	  var_dump($webSv->__call(conductOrder,$ConductOrderparam));	  	
	  ?>
            
	  <?php echo $_GET["cid"]; ?><br>
	  <?php echo $_GET["pid1"]; ?><br>
	  <?php echo $_GET["pno1"]; ?><br>
	  <?php echo $_GET["pid2"]; ?><br>
	  <?php echo $_GET["pno2"]; ?><br>
	  <?php echo $_GET["address"]; ?><br>
	  <?php echo $_GET["bn"]; ?><br>
	  <?php echo $_GET["bic"]; ?><br>
	  <?php echo $_GET["iban"]; ?><br>
	  <?php echo $_GET["ah"]; ?><br>
	  <?php echo $_GET["sd"]; ?><br>
       </div> 
	
	<div class="col-sm-2 col-md-3"></div>	   
    </div> 

    <div class="container-fluid" id="footer">
       (C) Manh Phi Nguyen, Johannes Wanner, Jens Thenent, 2016
    </div>

 </body>
</html>
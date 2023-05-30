
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="kXpJxRoJnj947CD6j88LvO8d0mk59l6WEikSkVZv">
    <title>AutofactorNG | Admin</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Favicone Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
    <link rel="icon" href="/img/favicon.ico" type="image/x-icon">
    <link rel="icon" type="image/png" href="/img/favicon-96x96.png">
    <link rel="apple-touch-icon" href="/img/favicon-96x96.png">




    <!--  Material Dashboard CSS    -->
    </head>
 <style>
#invoice-POS{
  box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
  padding:2mm;
  margin: 0 auto;
  width: 100mm;
  background: #FFF;
  
  
::selection {background: #f31544; color: #FFF;}
::moz-selection {background: #f31544; color: #FFF;}
h1{
  font-size: 1.5em;
  color: #222;
}
h2{font-size: .9em;}
h3{
  font-size: 1.2em;
  font-weight: 300;
  line-height: 2em;
}
p{
  font-size: .7em;
  color: #666;
  line-height: 1.2em;
}
 
#top, #mid,#bot{ /* Targets all id with 'col-' */
  border-bottom: 1px solid #EEE;
}

#top{min-height: 100px;}
#mid{min-height: 80px;} 
#bot{ min-height: 50px;}

#top .logo{
  //float: left;
	height: 60px;
	width: 60px;
	background: url(http://michaeltruong.ca/images/logo1.png) no-repeat;
	background-size: 60px 60px;
}
.clientlogo{
  float: left;
	height: 60px;
	width: 60px;
	background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
	background-size: 60px 60px;
  border-radius: 50px;
}
.info{
  display: block;
  //float:left;
  margin-left: 0;
}
.title{
  float: right;
}
.title p{text-align: right;} 
table{
  width: 100%;
  border-collapse: collapse;
}
td{
  //padding: 5px 0 5px 15px;
  //border: 1px solid #EEE
}
.tabletitle{
  //padding: 5px;
  font-size: .5em;
  background: #EEE;
}
.service{border-bottom: 1px solid #EEE;}
.item{width: 24mm;}
.itemtext{font-size: .5em;}

#legalcopy{
  margin-top: 5mm;
}

  
  
}
 </style>
    


<body class="g-sidenav-show bg-gray-200">
<div id="invoice-POS">
    
    <center id="top">
      <div class="logo"></div>
      <div class="info"> 
      <img class="mb-2  p-2" src="https://autofactorng.com/images/afng_logo.png" alt="Logo">
      </div><!--End Info-->
    </center><!--End InvoiceTop-->
    
    <div id="mid">
      <div class="info">
        <h2>Contact Info</h2>
        <p> 
            Address : street city, state 0000</br>
            Email   : JohnDoe@gmail.com</br>
            Phone   : 555-555-5555</br>
        </p>
      </div>
    </div><!--End Invoice Mid-->
    
    <div id="bot">

					<div id="table">
						<table>
							<tr class="tabletitle">
								<td class="item"><h2>Item</h2></td>
								<td class="Hours"><h2>Qty</h2></td>
								<td class="Rate"><h2>Sub Total</h2></td>
							</tr>

							<tr class="service">
								<td class="tableitem"><p class="itemtext">Communication</p></td>
								<td class="tableitem"><p class="itemtext">5</p></td>
								<td class="tableitem"><p class="itemtext">$375.00</p></td>
							</tr>

							<tr class="service">
								<td class="tableitem"><p class="itemtext">Asset Gathering</p></td>
								<td class="tableitem"><p class="itemtext">3</p></td>
								<td class="tableitem"><p class="itemtext">$225.00</p></td>
							</tr>

							<tr class="service">
								<td class="tableitem"><p class="itemtext">Design Development</p></td>
								<td class="tableitem"><p class="itemtext">5</p></td>
								<td class="tableitem"><p class="itemtext">$375.00</p></td>
							</tr>

							<tr class="service">
								<td class="tableitem"><p class="itemtext">Animation</p></td>
								<td class="tableitem"><p class="itemtext">20</p></td>
								<td class="tableitem"><p class="itemtext">$1500.00</p></td>
							</tr>

							<tr class="service">
								<td class="tableitem"><p class="itemtext">Animation Revisions</p></td>
								<td class="tableitem"><p class="itemtext">10</p></td>
								<td class="tableitem"><p class="itemtext">$750.00</p></td>
							</tr>


							<tr class="tabletitle">
								<td></td>
								<td class="Rate"><h2>tax</h2></td>
								<td class="payment"><h2>$419.25</h2></td>
							</tr>

							<tr class="tabletitle">
								<td></td>
								<td class="Rate"><h2>Total</h2></td>
								<td class="payment"><h2>$3,644.25</h2></td>
							</tr>

						</table>
					</div><!--End Table-->

					<div id="legalcopy">
						<p class="legal"><strong>Thank you for your business!</strong>  Payment is expected within 31 days; please process this invoice within that time. There will be a 5% interest charge per month on late invoices. 
						</p>
					</div>

				</div><!--End InvoiceBot-->
  </div><!--End Invoice-->





<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="/js/dashboard.js"></script>
        <script type="text/javascript">
            </script>
</body>


</html>
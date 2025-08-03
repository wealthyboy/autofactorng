<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8" />
   <title>Template builder</title>
   <meta charset="UTF-8" />
   <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" />
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
   <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"
  />
  <link href="{{ asset('store/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet" />

   <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,600,700" rel="stylesheet" type="text/css">
   <style type="text/css">
      @import url('https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:300,400,600,700,800');
      body {margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; outline: none !important;}
      table {border-spacing:0;}
      .pointer{cursor:pointer; position:relative;}
      .border-custom{ 2px solid #222 !important;}

      .hide{ display: none;}
      .cancel-button{ position: absolute; top: 10px;  right: 0px; height: 30px; color: #ffffff;  width: 30px; border-radius: 100%; padding-right: 10px; background-color: #007bff;}
      .cancel-button a{display: inline-block;left: 10px;position: relative;top: 3px;}

      table td {border-collapse: collapse;}
      img {-ms-interpolation-mode: bicubic; display: block; outline: none !important;}
      .ExternalClass {width: 100%;}
      .ExternalClass,.ExternalClass p,.ExternalClass span,.ExternalClass font,.ExternalClass td,.ExternalClass div {line-height: inherit;}
      .ReadMsgBody {width: 100%;background-color: #ffffff;}
      a[x-apple-data-detectors] { color: inherit !important; text-decoration: none !important; font-size: inherit !important; font-family: inherit !important; font-weight: inherit !important; line-height: inherit !important; }
      td a {color: inherit; text-decoration: none; outline: none !important; }
      a {color: inherit; text-decoration: none; border-style: none; outline: none !important; }
      .undoreset a, .undoreset a:hover {text-decoration: none !important;}
      .yshortcuts a {border-bottom: none !important;}
      .ios-footer a {color: #aaaaaa !important;text-decoration: none;}
      table p, table h1, table h2, table h3, table h4{ margin-top:0!important;margin-right:0!important;margin-bottom:0!important;margin-left:0!important;padding-top:0!important;padding-right:0!important;padding-bottom:0!important;padding-left:0!important;display: inline-block!important;font-family: inherit!important;}
      #canspamBar a img{display: inline-block !important;}
      .badge a img{display: inline-block !important;}
      @media screen and (max-width: 599px)
      {
         body{width:100% !important;}
         .container-main {width:100% !important; min-width:100% !important;}
         .container {width:100% !important; min-width:100% !important;}
         .container-wrap {display:inline-block !important; width:100% !important; height:auto !important; border-radius:0 !important;}
         .container-wrap>table{width:100% !important; min-width:100% !important;}
         .main-row>td{padding-left:15px !important; padding-right:15px !important;}
         .row {padding-left:15px !important; padding-right:15px !important;}
         .container-image img {width: 100% !important; height: auto !important; max-width:100% !important;}
         .fl-center {display: block !important; text-align: center !important;}
         .fl-center table {display: inline-block !important; float: none !important;}
         .fl-left {display:inline-block !important;}
         .icon-center {display:block !important; text-align:center !important;}
         .icon-center img {display:inline-block !important; float:none !important;}
         .icon-left {display:block !important; text-align:left !important;}
         .disable {display: none !important;}
         .pn {padding: 0 !important;}
         .pt-10 {padding-top: 10px !important;}
         .pt-20 {padding-top: 20px !important;}
         .pt-40 {padding-top: 40px !important;}
         .mob-40 {height:40px !important;}
         .txt-center {text-align: center !important;}
         .txt-left {text-align: left !important;}
         .bg-cov-perc {background-size: 100% 79% !important;}
         .border-none {border:0 !important;}
      }

      @media only screen and (max-width: 480px) {
  td[align="center"][valign="top"] {
    width: 50% !important;
    display: inline-block !important;
  }
}
   </style>


</head>
<body class="body">
   <div class="container-fluid">
      <div class="row">
         <div style="background-color: #ffffff;" class="col-md-12">
            <div class="navigation mb-1 pointer">
               <table data-group="navigation" width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 0px; border-collapse: collapse; margin: 0 auto;" data-module="navigation-11" data-thumb="http://www.stampready.net/dashboard/editor/user_uploads/zip_uploads/2019/04/01/quA5rxOyIJGf1ltjV7sLaSM8/Full/thumbnails/nav-11.jpg">
                  <tbody>
                     <tr>
                        <td align="center" style="background-color: #ededed" bgcolor="#ededed" data-bgcolor="body-bg">
                           <table class="container-main" align="center" border="0" cellpadding="0" cellspacing="0" style="min-width: 100%;">
                              <tbody>
                                 <tr class="main-row">
                                    <td align="center" style="width:100%; background-color:#ffffff;" bgcolor="#ffffff" data-bgcolor="white-bg">
                                       <table width="600" align="center" class="container" border="0" cellpadding="0" cellspacing="0" style="width:600px;">
                                          <tbody>
                                             <tr>
                                                <td height="20"></td>
                                             </tr>
                                             <tr>
                                                <td align="center">
                                                   <a href="https://autofactorng.com"><img src="https://autofactorng.com/images/logo/autofactor_logo.png" data-crop="false" width="auto" height="auto" alt="" style="display:block; width:197px;"></a>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td height="13"></td>
                                             </tr>
                                             <tr>
                                                <td align="center" style="padding-top:1px;">
                                                   <span class="text"  style="text-align:center; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size:12px; line-height: 20px; text-decoration: none; color: #000000 !important; font-weight:600; text-transform: uppercase; letter-spacing: 0.05em; display: inline-block;"  data-color="#000000" data-fontweight="600"  data-fontsize="12"  data-letterspacing="0.05" data-lineheight="20"  data-align="center"   data-size="nav-11-link-size" data-color="nav-11-link-color" data-link-style="color: #000000;" data-link-color="nav-11-link-color"><a  class="anchor-link  anchor" href="https://autofactorng.com/products/spare-parts-body-light-parts">Body Parts |</a></span>
                                                   <span class="text"  style="text-align:center; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size:12px; line-height: 20px; text-decoration: none; color: #000000  !important; font-weight:600; text-transform: uppercase; letter-spacing: 0.05em; display: inline-block;"  data-color="#000000" data-letterspacing="0.05"  data-fontsize="12"  data-lineheight="20"  data-align="center" data-size="nav-11-link-size" data-color="nav-11-link-color" data-link-style="color: #000000;" data-link-color="nav-11-link-color"><a  class="anchor-link  anchor"  href="https://autofactorng.com/products/lubricants-fluids-engine-oil">Engine Oil |
</a></span>
                                                   <span class="text"  style="text-align:center; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size:12px; line-height: 20px; text-decoration: none; color: #000000  !important; font-weight:600; text-transform: uppercase; letter-spacing: 0.05em; display: inline-block;" data-color="#000000"  data-fontweight="600"  data-fontsize="12"   data-letterspacing="0.05" data-lineheight="20"  data-align="center"  data-size="nav-11-link-size" data-color="nav-11-link-color" data-link-style="color: #000000;" data-link-color="nav-11-link-color"><a  class="anchor-link  anchor"  href="https://autofactorng.com/products/batteries">Batteries 
 |</a></span>
                                                   <span class="text"  style="text-align:center; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size:12px; line-height: 20px; text-decoration: none; color: #000000 !important; font-weight:600; text-transform: uppercase; letter-spacing: 0.05em; display: inline-block;"  data-color="#000000" data-fontweight="600"  data-fontsize="12"  data-letterspacing="0.05" data-lineheight="20"  data-align="center"  data-size="nav-11-link-size" data-color="nav-11-link-color" data-link-style="color: #000000;" data-link-color="nav-11-link-color"><a  class="anchor-link  anchor"   href="https://autofactorng.com/products/tyres">Tyres </a></span>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td height="15"></td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <div class="titles mb-1 pointer">
              <div style="display:none;" class="cancel-button "><a id="#" href="#">X</a></div>
              <table data-group="titles" width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 0px; border-collapse: collapse; margin: 0 auto;" data-module="title-variant-8" data-thumb="http://www.stampready.net/dashboard/editor/user_uploads/zip_uploads/2019/04/01/quA5rxOyIJGf1ltjV7sLaSM8/Full/thumbnails/var-8.jpg">
                  <tbody>
                     <tr>
                        <td align="center" style="background-color: #ededed" bgcolor="#ededed" data-bgcolor="body-bg">
                           <table class="container-main" align="center" border="0" cellpadding="0" cellspacing="0" style="min-width: 100%;">
                              <tbody>
                                 <tr class="main-row">
                                    <td align="center" style="width:100%; background-color:#ffffff;" bgcolor="#ffffff" data-bgcolor="white-bg">
                                       <table width="600" align="center" class="container" border="0" cellpadding="0" cellspacing="0" style="width:600px;">
                                          <tbody>
                                             <tr>
                                                <td height="19"></td>
                                             </tr>
                                             <tr>
                                                <td  data-color="#000000" data-fontweight="600" data-fontsize="20"  data-letterspacing="0.05" data-lineheight="25"  data-align="left" class="text" style="text-align:left; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size:20px; line-height: 25px; text-decoration: none; color: #000000; font-weight:600; text-transform: uppercase; letter-spacing: 0.05em" data-size="var-8-title-size" data-color="var-8-title-color" data-link-color="var-8-link-color" data-link-style="color: blue;">
                                                   Hey {{ $items->user->name }}
                                                </td>
                                             </tr>
                                             <tr>
                                                <td height="15"></td>
                                             </tr>
                                             <tr>
                                                <td data-color="#000000" class="text" data-fontsize="12"  data-fontweight="600"  data-letterspacing="0.05" data-lineheight="20"  data-align="left" style="text-align:left; font-family: 'Open Sans', Arial, Helvetica, sans-serif; font-size:12px; line-height: 19px; text-decoration: none; color: #444444; font-weight:400;" data-size="var-6-text-size" data-color="var-6-text-color" data-link-color="var-6-link-color" data-link-style="color: blue;">
                                                   Your cart is still parked, and those parts are itching to get your car back on the road.
                                                </td>
                                             </tr>
                                              <tr>
                                                <td height="10"></td>
                                             </tr>
                                              <tr>
   <td style="padding: 10px 0;">
      <table border="0" cellpadding="0" cellspacing="0" style="width: auto;">
         <tr>
            <!-- Text -->
            <td data-color="#000000" class="text"
                data-fontsize="12"
                data-fontweight="600"
                data-letterspacing="0.05"
                data-lineheight="20"
                data-align="left"
                style="font-weight: bold; text-align:left; font-family: 'Open Sans', Arial, Helvetica, sans-serif; font-size:12px; line-height:19px; color:#444444; font-weight:400;"
                data-size="var-6-text-size"
                data-color="var-6-text-color"
                data-link-color="var-6-link-color"
                data-link-style="color: blue;">
               Need assistance? Chat with us
            </td>

            <!-- Icon -->
            <td style="padding-left: 8px;">
               <a href="https://wa.me/+23409081155505" style="display: inline-block;">
                  <img src="https://autofactorng.com/images/icons/whatsapp.png"
                       alt="WhatsApp"
                       width="44"
                       height="44"
                       style="display: block; width: 44px; height: 44px; border: 0;">
               </a>
            </td>
         </tr>
      </table>
   </td>
</tr>

                                             <tr>
                                                <td height="25"></td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
            
            <div class="sale1 mb-1 pointer">
               <table data-group="sale" class="main-table" id="sale1" width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 0px; border-collapse: collapse; margin: 0 auto;" data-module="sale-2" data-thumb="">
                  <tbody>
                     <tr>
                        <td align="center" style="background-color: #ededed" bgcolor="#ededed" data-bgcolor="body-bg">
                           <table class="container-main" align="center" border="0" cellpadding="0" cellspacing="0" style="min-width: 100%;">
                              <tbody>
                                 <tr class="main-row">
                                    <td  class="bg-color-section" align="center" style="width:100%; background-color:#ffffff;" bgcolor="#ffffff" data-bgcolor="white-bg">
                                       <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                                          <tbody>
                                             <tr>
                                                <td height="40"></td>
                                             </tr>
                                          </tbody>
                                       </table>
         <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="max-width:600px; margin: 0 auto;">
  <tr>
    @foreach($items as $index => $cartItem)
    <td align="center" valign="top" width="33.33%" style="padding: 4px;">
      <!--[if (gte mso 9)|(IE)]>
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr><td>
      <![endif]-->
      <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="border:1px solid #ddd; border-radius:5px;">
        <tr>
          <td align="center" style="padding: 0;">
            <img src="{{ $cartItem['image_url'] }}" alt="{{ $cartItem['name'] }}" style="display: block; width: 100%; max-width: 160px; height: auto; border: 0;">
          </td>
        </tr>
        <tr>
          <td align="center" style="padding: 6px 4px 2px; font-family: Arial, sans-serif; font-size: 13px; font-weight: bold; color: #333;">
            {{ \Illuminate\Support\Str::limit($cartItem['name'], 22) }}
          </td>
        </tr>
        <tr>
          <td align="center" style="font-size: 14px; color: #000; font-weight: bold; padding-bottom: 8px;">
            ₦{{ number_format($cartItem['price']) }}
          </td>
        </tr>
      </table>
      <!--[if (gte mso 9)|(IE)]>
        </td></tr></table>
      <![endif]-->
    </td>

    @if(($index + 1) % 3 == 0)
      </tr><tr>
    @endif

    @endforeach
  </tr>
</table>



                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
            
             <div  style="margin-top: 30px;" class="footer mb-1 pointer">
               <table  data-group="footer" class="main-table" width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 0px; border-collapse: collapse; margin: 0 auto;" data-module="footer-4" data-thumb="">
                  <tbody>
                     <tr>
                        <td align="center" style="background-color: #ffffff" bgcolor="#ffffff" data-bgcolor="body-bg">
                           <table class="container-main" align="center" border="0" cellpadding="0" cellspacing="0" style="min-width: 100%;">
                              <tbody>
                                 <tr class="main-row">
                                    <td align="center" class="bg-color-section" style="width:100%; background-color:#ffffff;" bgcolor="#ffffff" data-bgcolor="gray-bg">
                                       <table width="280" align="center" class="container" border="0" cellpadding="0" cellspacing="0" style="border-radius: 15px; background-color: #000000; min-width: 110px;">
                                          <tbody>
                                               <tr>
                                                <td height="10"></td>
                                             </tr>
                                             
                                             
                                             <tr>

                                                <td class="text"  -color="#000000"  style="vertical-align:top; text-align:center; font-family: 'Open Sans', Arial, Helvetica, sans-serif; font-size:13px; line-height: 20px; text-decoration: none; color: #000000; font-weight: 400;" data-size="footer-4-rights-size" data-color="footer-4-rights-color" data-link-color="footer-4-link-color" data-link-style="color: blue;">
                                                   <a href="{{ url('/checkout') }}" class="anchor-link  anchor"  data-size="blue-btn-txt-size" data-color="blue-btn-txt-color" style="color:#ffffff;">Checkout</a>
                                             
                                                </td>

                                             </tr>
                                              <tr>
                                                <td height="10"></td>
                                             </tr>
                                            
                                            
                                            
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>

        
            
            <div class="footer mb-1 pointer">
               <table data-group="footer" class="main-table" width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 0px; border-collapse: collapse; margin: 0 auto;" data-module="footer-4" data-thumb="">
                  <tbody>
                     <tr>
                        <td align="center" style="background-color: #ffffff" bgcolor="#ffffff" data-bgcolor="body-bg">
                           <table class="container-main" align="center" border="0" cellpadding="0" cellspacing="0" style="min-width: 100%;">
                              <tbody>
                                 <tr class="main-row">
                                    <td align="center" class="bg-color-section" style="width:100%; background-color:#ffffff;" bgcolor="#ffffff" data-bgcolor="gray-bg">
                                       <table width="280" align="center" class="container" border="0" cellpadding="0" cellspacing="0" style="width:280px;">
                                          <tbody>
                                             <tr>
                                                <td height="35"></td>
                                             </tr>
                                             <tr>
                                                <td class="text"  data-color="#000000"  style="vertical-align:top; text-align:center; font-family: 'Open Sans', Arial, Helvetica, sans-serif; font-size:13px; line-height: 20px; text-decoration: none; color: #444444; font-weight: 400;" data-size="footer-4-rights-size" data-color="footer-4-rights-color" data-link-color="footer-4-link-color" data-link-style="color: blue;">
                                                  © {{date('Y')}} Autofactorng. All rights reserved.                                                
                                                </td>
                                             </tr>
                                             <tr>
                                                <td height="20"></td>
                                             </tr>
                                             <tr>
                                                <td valign="top" align="center">
                                                   <table border="0" cellpadding="0" cellspacing="0" align="center">
                                                      <tbody>
                                                         <tr>
                                                            <td align="center">
                                                               <!--[if (gte mso 9)|(IE)]>
                                                            </td>
                                                            <td valign="middle">
                                                               <![endif]-->
                                                               <table data-repeatable="" border="0" cellpadding="0" cellspacing="0" style="display:table-cell;vertical-align:middle;">
                                                                  <tbody>
                                                                     <tr>
                                                                        <td align="center" style="padding-right:6px;" valign="middle">
                                                                           <a href="https://www.facebook.com/autofactorng/">
                                                                              <img src="https://autofactorng.com/images/icons/facebook.png" border="0" data-crop="false" width="100" height="100" alt="" style="height: 40px; display:block; max-width: 40px; width: 40px; border: 0px; width: auto;">
                                                                           </a>
                                                                        </td>
                                                                     </tr>
                                                                  </tbody>
                                                               </table>
                                                               <!--[if (gte mso 9)|(IE)]>
                                                            </td>
                                                            <td valign="middle">
                                                               <![endif]-->
                                                               
                                                               <!--[if (gte mso 9)|(IE)]>
                                                            </td>
                                                            <td valign="middle">
                                                               <![endif]-->
                                                               <table data-repeatable="" border="0" cellpadding="0" cellspacing="0" style="display:table-cell;vertical-align:middle;">
                                                                  <tbody>
                                                                     <tr>
                                                                        <td align="center" style="padding:0 6px;" valign="middle">
                                                                           <a href="http://instagram.com/autofactorng/">
                                                                              <img src="https://autofactorng.com/images/icons/icon-ig.png" border="0" data-crop="false" width="auto" height="auto" alt="" style="height: 40px; display:block; max-width: 40px; width: 40px; border: 0px; width: auto;">

                                                                           </a>
                                                                        </td>
                                                                     </tr>
                                                                  </tbody>
                                                               </table>
                                                               <!--[if (gte mso 9)|(IE)]>
                                                            </td>
                                                            <td valign="middle">
                                                               <![endif]-->
                                                             
                                                               <!--[if (gte mso 9)|(IE)]>
                                                            </td>
                                                            <td valign="middle">
                                                               <![endif]-->
                                                              
                                                               <!--[if (gte mso 9)|(IE)]>
                                                            </td>
                                                            <td valign="middle">
                                                               <![endif]-->
                                                               <table data-repeatable="" border="0" cellpadding="0" cellspacing="0" style="display:table-cell;vertical-align:middle;">
                                                                  <tbody>
                                                                     <tr>
                                                                        <td align="center" style="padding:0 6px;" valign="middle">
                                                                           <a href="">
                                                                           </a>
                                                                        </td>
                                                                     </tr>
                                                                  </tbody>
                                                               </table>
                                                               <!--[if (gte mso 9)|(IE)]>
                                                            </td>
                                                            <td valign="middle">
                                                               <![endif]-->
                                                              
                                                            </td>
                                                         </tr>
                                                      </tbody>
                                                   </table>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td height="15"></td>
                                             </tr>
                                             <tr>
                                             </tr>
                                             <tr>
                                                <td height="44"></td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
            
         </div>
         
                  
                 
      </div>
   </div>




    
   </body>
</html>


<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
   <meta charset="UTF-8" />
   <title>Template builder</title>
   <meta charset="UTF-8" />
   <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" />
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
   
   <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,600,700" rel="stylesheet" type="text/css">
   <style type="text/css">
      @import url('https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:300,400,600,700,800');
      body {margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; outline: none !important;}
      table {border-spacing:0;}
      .pointer{cursor:pointer;}
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
   </style>

</head>
<body class="body">
    {!! html_entity_decode($template->text) !!}
</body>
</html>
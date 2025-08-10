<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="format-detection" content="telephone=no">
   <title>{{ Config('app.name')}} Reciept</title>
   <style>
      table {
         mso-table-lspace: 0pt;
         mso-table-rspace: 0pt;
      }

      td,
      th {
         border-collapse: collapse;
      }

      a {
         text-decoration: none;
      }

      .antd {
         color: #425065;
         font-family: sans-serif;
         font-size: 18px;
         text-align: right;
         line-height: 150%;
         font-weight: bold;
         letter-spacing: 2px;
      }

      .antd a {
         color: #425065;
      }

      .header2TD,
      .header5TD {
         color: #425065;
         font-family: sans-serif;
         font-size: 18px;
         text-align: center;
         line-height: 27px;
         font-weight: bold;
      }

      .header2TD {
         font-size: 14px;
         font-weight: lighter;
         text-align: left;
         line-height: 19px;
      }

      .header5TD {
         color: #ffffff;
         font-size: 15px;
         font-weight: bold;
         text-align: center;
      }

      .header2TD a {
         color: #425065;
         font-weight: bold;
      }

      .header5TD a {
         color: #ffffff;
      }

      .RegularTextTD,
      .RegularText4TD,
      .rt5td {
         color: #000;
         font-family: sans-serif;
         font-size: 13px;
         font-weight: lighter;
         text-align: left;
         line-height: 23px;
      }

      .RegularTextTD a {
         color: #67bffd;
         font-weight: bold;
      }

      .RegularText4TD {
         color: #425065;
         font-size: 14px;
         font-weight: bold;
         text-align: left;
      }

      .RegularText4TD a {
         color: #425065;
      }

      .rt5td {
         color: #425065;
         font-size: 14px;
         text-align: center;
      }

      .rt5td a {
         color: #67bffd;
         font-weight: bold;
      }

      td a img {
         text-decoration: none;
         border: none;
      }

      .catd {
         color: #67bffd;
         font-family: sans-serif;
         font-size: 13px;
         text-align: center;
         font-weight: bold;
         line-height: 190%;
      }

      .catd a {
         color: #67bffd;
         font-weight: bold;
      }

      .moptd {
         color: #aab1bd;
         font-family: sans-serif;
         font-size: 12px;
         text-align: center;
         line-height: 170%;
      }

      .moptd a {
         color: #333;
         font-weight: bold;
      }

      .ReadMsgBody {
         width: 100%;
      }

      .ExternalClass {
         width: 100%;
      }

      body {
         -webkit-text-size-adjust: 100%;
         -ms-text-size-adjust: 100%;
         -webkit-font-smoothing: antialiased;
         margin: 0 !important;
         padding: 0 !important;
         min-width: 100% !important;
      }

      @media only screen and (max-width: 479px) {
         body {
            min-width: 100% !important;
         }

         th[class=stack] {
            display: block !important;
            width: 300px !important;
            border-left: 0 !important;
            height: auto !important;
         }

         table[class=table600Logo] {
            width: 300px !important;
         }

         table[class=centerize] {
            margin: 0 auto 0 auto !important;
            border-bottom-width: 2px !important;
            border-bottom-style: solid !important;
         }

         table[class=table600Menu] {
            width: 300px !important;
         }

         table[class=table600Menu] td {
            height: 20px !important;
         }

         td[class=antd] {
            width: 300px !important;
            text-align: center !important;
            font-size: 17px !important;
         }

         td[class=table600st] {
            width: 300px !important;
            min-width: 300px !important;
            height: 20px !important;
         }

         td[class=header2TD] {
            height: 0 !important;
            font-size: 12px !important;
         }

         td[class=header5TD] {
            font-size: 12px !important;
            font-weight: lighter !important;
         }

         table[class=table600] {
            width: 300px !important;
         }

         table[class=table6003] {
            width: 300px !important;
            border-bottom-style: solid !important;
            border-bottom-width: 1px !important;
         }

         table[class=table600Min] {
            width: 300px !important;
            min-width: 300px !important;
         }

         td[class=wz] {
            height: 10px !important;
         }

         td[class=wz2] {
            width: 10px !important;
            height: 10px !important;
         }

         td[class=RegularTextTD] {
            width: 240px !important;
            height: 0 !important;
         }

         td[class=rt5td] {
            font-size: 13px !important;
         }

         td[class=esFrMb] {
            width: 0 !important;
            height: 0 !important;
            display: none !important;
         }

         table[class=tableTxt] {
            width: 240px !important;
         }

         td[class=vrtclAlgn] {
            height: 30px !important;
         }

         td[class=va2] {
            height: 20px !important;
         }

         th[class=stack2] {
            width: 100px !important;
         }

         table[class=table60032] {
            width: 98px !important;
         }

         th[class=stack3] {
            width: 66px !important;
         }

         table[class=table60033] {
            width: 64px !important;
         }

         th[class=stack4] {
            width: 166px !important;
         }

         table[class=table60034] {
            width: 164px !important;
         }

         td[class=TDtable60034] {
            width: 162px !important;
         }

         td[class=RegularText4TD] {
            font-size: 13px !important;
            font-weight: lighter !important;
         }
      }

      /* Light mode styles */
      .logo-light {
         display: block;
      }

      /* Dark mode styles */
      @media (prefers-color-scheme: dark) {
         .logo-light {
            display: none;
         }

         .logo-dark {
            display: block;
         }
      }
   </style>
   </style>

</head>

<body style="margin-top: 0; margin-bottom: 0; padding-top: 0; padding-bottom: 0; width: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;" offset="0" topmargin="0" leftmargin="0" marginwidth="0" marginheight="0">
   <table data-bgcolor="tbc" style="table-layout: fixed; margin: 0px auto; background-color: rgb(234, 235, 235);" data-module="TopLogoModule" data-thumb="" class="" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#3b485b" align="center">
      <tr>
         <td align="center">
            <table data-bgcolor="tbc" style="table-layout: fixed; margin: 0px auto; background-color: rgb(234, 235, 235);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#384855" align="center">
               <tr>
                  <td align="center">
                     <table data-bgcolor="tbc" class="table600Min" style="table-layout: fixed; margin: 0px auto; min-width: 668px; background-color: rgb(234, 235, 235);" width="668" cellspacing="0" cellpadding="0" border="0" bgcolor="#384855" align="center">
                        <tr>
                           <td class="table600st" style="min-width:668px;" height="30" align="center"></td>
                        </tr>
                     </table>
                  </td>
               </tr>
            </table>

            <table data-bgcolor="tbc" style="table-layout: fixed; margin: 0px auto; background-color: rgb(234, 235, 235);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#384855" align="center">
               <tr>
                  <td align="center">
                     <table class="table600Min" data-bgcolor="tbc" style="table-layout: fixed; margin: 0px auto; min-width: 668px; background-color: rgb(234, 235, 235);" width="668" cellspacing="0" cellpadding="0" border="0" bgcolor="#384855" align="center">
                        <tr>
                           <td class="table600st" style="min-width:668px;" align="center">
                              <table data-bgcolor="cbc" class="table600" data-border-bottom-color="borderColor" style="border-bottom: 1px solid rgb(200, 198, 198); border-radius: 6px 6px 0px 0px;" width="629" cellspacing="0" cellpadding="0" border="0" bgcolor="#fdfdfd" align="center">
                                 <tr>
                                    <td class="table600st" style="min-width:629px;" width="629" align="left">
                                       <table class="table600Logo" width="260" cellspacing="0" cellpadding="0" border="0" align="left">
                                          <tr>
                                             <td>
                                                <table class="centerize" data-border-bottom-color="LogoDivider-OnMobile" style="border-bottom-color:#67bffd; margin-left:0;" cellspacing="0" cellpadding="0" border="0">
                                                   <tr>
                                                      <td class="esFrMb" width="30"></td>
                                                      <td style="line-height:1px;" align="center"><a href="/" target="_blank" style="text-decoration: none;">

                                                            <img class="logo-light" src="https://avenuemontaigne.ng/images/logo/avem-logo.png" style="display: none; max-width:100px; height: 51px; margin-top: 37px;display: block;text-decoration: none;border: none;" alt="Avm" vspace="0" hspace="0" border="0" align="top">
                                                            <img class="logo-dark" src="https://avenuemontaigne.ng/images/logo/avnmont-white-04.png" style="display: none; max-width:100px; height: 51px; margin-top: 37px;display: block;text-decoration: none;border: none;" alt="Avm" vspace="0" hspace="0" border="0" align="top">

                                                         </a></td>
                                                      <td class="esFrMb" width="30"></td>
                                                   </tr>
                                                </table>
                                             </td>
                                          </tr>
                                       </table>
                                       <table class="table600Menu" width="348" cellspacing="0" cellpadding="0" border="0" align="right">
                                          <tr>
                                             <td colspan="2" style="font-size:0;line-height:0;" height="10">&nbsp;</td>
                                          </tr>
                                          <tr>
                                             <td class="antd" data-link-style="text-decoration:none; color:#67bffd;" data-link-color="AnnouncementLink" data-color="AnnouncementTXT" style="color: #425065;font-family: sans-serif;font-size: 18px;text-align: right;line-height: 150%;font-weight: bold;letter-spacing: 2px;" width="318" valign="middle" height="80" align="right"><a href="#" target="_blank" style="text-decoration: none;color: #425065;" data-color="AnnouncementLink"></a>YOUR RECEIPT</td>
                                             <td class="esFrMb" width="30"></td>
                                          </tr>
                                          <tr>
                                             <td colspan="2" style="font-size:0;line-height:0;" height="10">&nbsp;</td>
                                          </tr>
                                       </table>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                     </table>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
   </table>

   <!--= MAILING BODY =-->
   <table data-bgcolor="tbc" style="table-layout: fixed; margin: 0px auto; background-color: rgb(234, 235, 235);" data-module="WelcomeTextModule" class="" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#384855" align="center">
      <tr>
         <td align="center">
            <table data-bgcolor="tbc" class="table600Min" style="table-layout: fixed; margin: 0px auto; min-width: 668px; background-color: rgb(234, 235, 235);" width="668" cellspacing="0" cellpadding="0" border="0" bgcolor="#384855" align="center">
               <tr>
                  <td class="table600st" style="min-width:668px;" align="center">
                     <table data-bgcolor="cbc" class="table600Min" style="min-width:629px;" width="629" cellspacing="0" cellpadding="0" border="0" bgcolor="#fdfdfd" align="center">
                        <tr>
                           <td class="table600st" style="min-width:629px;">
                              <table class="table600" data-border-bottom-color="borderColor" style="border-bottom: 1px solid rgb(200, 198, 198);" width="629" cellspacing="0" cellpadding="0" border="0" align="left">
                                 <tr>
                                    <td align="center">
                                       <table cellspacing="0" cellpadding="0" border="0">
                                          <tr>
                                             <td align="center">
                                                <table class="table600" width="629" cellspacing="0" cellpadding="0" border="0">
                                                   <tr>
                                                      <td colspan="3" style="font-size:0;line-height:0;" class="vrtclAlgn2" height="25">&nbsp;</td>
                                                   </tr>
                                                   <tr>
                                                      <td class="wz" width="30"></td>
                                                      <td class="RegularTextTD" data-link-style="text-decoration:none; color:#67bffd;" data-link-color="RegularLink" data-color="RegularTXT" style="color: #000;font-family: sans-serif;font-size: 13px;font-weight: lighter;text-align: left;line-height: 23px;">Dear {{ $user_reservation->guest_user->fullname() }},<br>Thank you for choosing Avenue montaigne for your stay. We are pleased to inform you that your reservation request is CONFIRMED and your reservation details are as follows.
                                                         <br />
                                                         <b>Note: You’re required to present a valid ID upon arrival to check-in. You can also self check-in by clicking the link below to upload your ID

                                                            <br />
                                                            <a style="text-align:left; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size:14px; line-height: 14px; text-decoration: none; color: #27af9a; font-weight:600; text-transform: uppercase; letter-spacing: 0.05em" class="" href="https://avenuemontaigne.ng/check-in?id={{$user_reservation->id}}">Click here to Check-in</a>
                                                         </b>

                                                      </td>
                                                      <td class="wz" width="30"></td>
                                                   </tr>
                                                   <tr>
                                                      <td colspan="3" style="font-size:0;line-height:0;" class="vrtclAlgn" height="25">&nbsp;</td>
                                                   </tr>
                                                </table>
                                             </td>
                                          </tr>
                                       </table>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                     </table>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
   </table>


   <!--= MAILING BODY =-->
   <table data-bgcolor="tbc" style="table-layout: fixed; margin: 0px auto; background-color: rgb(234, 235, 235);" data-module="InvoiceCredentialsModule-2COL" class="" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#384855" align="center">
      <tr>
         <td align="center">
            <table data-bgcolor="tbc" class="table600Min" style="table-layout: fixed; margin: 0px auto; min-width: 668px; background-color: rgb(234, 235, 235);" width="668" cellspacing="0" cellpadding="0" border="0" bgcolor="#384855" align="center">
               <tr>
                  <td class="table600st" style="min-width:668px;" align="center">
                     <table class="table600Min" style="min-width:628px;" width="629" cellspacing="0" cellpadding="0" border="0" align="center">
                        <tr>
                           <td class="table600st" style="min-width:628px;">
                              <table data-bgcolor="cbc" class="table600" width="629" cellspacing="0" cellpadding="0" border="0" bgcolor="#fdfdfd" align="left">
                                 <tr>
                                    <td>
                                       <table data-bgcolor="cbc" cellspacing="0" cellpadding="0" border="0" bgcolor="#fdfdfd" align="center">
                                          <tr>

                                             <th class="stack" data-border-left-color="borderColor" data-border-bottom-color="borderColor" style="border-left: 1px solid rgb(200, 198, 198); border-bottom: 1px solid rgb(200, 198, 198); margin: 0px; padding: 0px; vertical-align: top;" width="628" valign="top">
                                                <table class="table600" width="628" cellspacing="0" cellpadding="0" border="0" align="center">
                                                   <tr>
                                                      <td colspan="3" style="font-size:0;line-height:0;" height="25">&nbsp;</td>
                                                   </tr>
                                                   <tr>
                                                      <td class="wz" width="900"></td>
                                                      <td valign="top" align="center">
                                                         <table class="tableTxt" width="600" cellspacing="0" cellpadding="0" border="0" align="left">

                                                            <tr>
                                                               <td class="RegularText4TD" data-link-style="text-decoration:none; color:#67bffd;" data-link-color="SectionInfoLink" data-color="SectionInfoTXT" style="color: #425065;font-family: sans-serif;font-size: 18px;font-weight: bold;text-align: left;line-height: 23px;" width="179" valign="top" align="left"><a href="#" target="_blank" style="text-decoration: none;color: #67bffd;font-weight: bold;" data-color="SectionInfoLink"></a>Property Address</td>
                                                            </tr>

                                                            <tr>
                                                               <td colspan="3" class="RegularTextTD" data-color="RegularTXT" style="margin-left: 3px;color: #000;font-family: sans-serif;font-size: 13px;font-weight: lighter;line-height: 23px; margin-bottom: 6px;"> {{ $user_reservation->property->address }} <br />

                                                                  <div style="font-size: 18px;font-weight: bold;  margin-bottom: 6px;">Check-in Time: <span style="font-size: 13px;font-weight: normal;"> {{ optional($user_reservation->property)->check_in_time }}</span></div>
                                                                  <div style="font-size: 18px;font-weight: bold;  margin-bottom: 6px;">Check-out Time: <span style="font-size: 13px;font-weight: normal;"> {{ optional($user_reservation->property)->check_out_time }}</span></div>

                                                               </td>
                                                            </tr>
                                                            <tr>
                                                               <td colspan="3" style="font-size:0;line-height:0;" height="25"></td>
                                                            </tr>
                                                         </table>
                                                      </td>
                                                      <td class="wz" width="30"></td>
                                                   </tr>
                                                </table>
                                             </th>
                                          </tr>
                                       </table>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                     </table>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
   </table>
   <table data-bgcolor="tbc" style="table-layout: fixed; margin: 0px auto; background-color: rgb(234, 235, 235);" data-module="InvoiceCredentialsModule-3COL" class="" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#384855" align="center">
      <tr>
         <td align="center">
            <table data-bgcolor="tbc" class="table600Min" style="table-layout: fixed; margin: 0px auto; min-width: 668px; background-color: rgb(234, 235, 235);" width="668" cellspacing="0" cellpadding="0" border="0" bgcolor="#384855" align="center">
               <tr>
                  <td class="table600st" style="min-width:668px;" align="center">
                     <table class="table600Min" style="min-width:629px;" width="629" cellspacing="0" cellpadding="0" border="0" align="center">
                        <tr>
                           <td class="table600st" style="min-width:629px;">
                              <table data-bgcolor="cbc" class="table600" width="629" cellspacing="0" cellpadding="0" border="0" bgcolor="#fdfdfd" align="left">
                                 <tr>
                                    <td align="left">
                                       <table data-bgcolor="cbc" cellspacing="0" cellpadding="0" border="0" bgcolor="#fdfdfd" align="center">
                                          <tr>
                                             <th class="stack" style="margin: 0px; padding: 0px; vertical-align: top; border-bottom: 1px solid rgb(200, 198, 198);" data-border-bottom-color="borderColor" width="209">
                                                <table class="table600" width="209" cellspacing="0" cellpadding="0" border="0" align="center">
                                                   <tr>
                                                      <td colspan="3" style="font-size:0;line-height:0;" height="25">&nbsp;</td>
                                                   </tr>
                                                   <tr>
                                                      <td class="wz" width="30"></td>
                                                      <td valign="top" align="center">
                                                         <table class="tableTxt" width="200" cellspacing="0" cellpadding="0" border="0" align="left">
                                                            <tr>

                                                               <td rowspan="2" style="font-size:0;line-height:0;" width="31">&nbsp;</td>
                                                               <td class="header2TD" data-link-style="text-decoration:none; color:#67bffd;" data-link-color="scl" data-color="SectionCaptionTXT" style="color: #425065;font-family: sans-serif;font-size: 14px;text-align: left;line-height: 19px;font-weight: lighter;" valign="top" align="left"><a href="#" target="_blank" style="text-decoration: none;color: #67bffd;font-weight: bold;" data-color="scl"></a>Booking No</td>
                                                            </tr>
                                                            <tr>
                                                               <td class="RegularText4TD" data-link-style="text-decoration:none; color:#67bffd;" data-link-color="sil" data-color="SectionInfoTXT" style="color: #425065;font-family: sans-serif;font-size: 14px;font-weight: bold;text-align: left;line-height: 23px;" valign="top" align="left"><a href="#" target="_blank" style="text-decoration: none;color: #67bffd;font-weight: bold;" data-color="sil"></a>{{ $user_reservation->invoice }}</td>
                                                            </tr>
                                                            <tr>
                                                               <td colspan="3" style="font-size:0;line-height:0;" height="25">&nbsp;</td>
                                                            </tr>
                                                         </table>
                                                      </td>
                                                      <td class="wz" width="30"></td>
                                                   </tr>
                                                </table>
                                             </th>
                                             <th class="stack" data-border-left-color="borderColor" data-border-bottom-color="borderColor" style="border-bottom: 1px solid rgb(200, 198, 198); border-left: 1px solid rgb(200, 198, 198); margin: 0px; padding: 0px; vertical-align: top;" width="209">
                                                <table class="table600" width="209" cellspacing="0" cellpadding="0" border="0" align="center">
                                                   <tr>
                                                      <td colspan="3" style="font-size:0;line-height:0;" height="25">&nbsp;</td>
                                                   </tr>
                                                   <tr>
                                                      <td class="wz" width="30"></td>
                                                      <td valign="top" align="center">
                                                         <table class="tableTxt" width="145" cellspacing="0" cellpadding="0" border="0" align="left">
                                                            <tr>
                                                               <td rowspan="2" style="line-height:1px;" width="25" valign="top" align="center">
                                                                  <!-- <img src="" style="display:block;" alt="IMG" vspace="0" hspace="0" border="0"> -->
                                                               </td>
                                                               <td rowspan="2" style="font-size:0;line-height:0;" width="14">&nbsp;</td>
                                                               <td class="header2TD" data-link-style="text-decoration:none; color:#67bffd;" data-link-color="scl" data-color="SectionCaptionTXT" style="color: #425065;font-family: sans-serif;font-size: 14px;text-align: left;line-height: 19px;font-weight: lighter;" valign="top" align="left"><a href="#" target="_blank" style="text-decoration: none;color: #67bffd;font-weight: bold;" data-color="scl"></a>Receipt Date</td>
                                                            </tr>
                                                            <tr>
                                                               <td class="RegularText4TD" data-link-style="text-decoration:none; color:#67bffd;" data-link-color="sil" data-color="SectionInfoTXT" style="color: #425065;font-family: sans-serif;font-size: 14px;font-weight: bold;text-align: left;line-height: 23px;" valign="top" align="left"><a href="#" target="_blank" style="text-decoration: none;color: #67bffd;font-weight: bold;" data-color="sil"></a>{{ $user_reservation->created_at->toFormattedDateString()  }}</td>
                                                            </tr>
                                                            <tr>
                                                               <td colspan="3" style="font-size:0;line-height:0;" height="25">&nbsp;</td>
                                                            </tr>
                                                         </table>
                                                      </td>
                                                      <td class="wz" width="30"></td>
                                                   </tr>
                                                </table>
                                             </th>
                                             <th class="stack" data-border-left-color="borderColor" data-border-bottom-color="borderColor" style="border-bottom: 1px solid rgb(200, 198, 198); border-left: 1px solid rgb(200, 198, 198); margin: 0px; padding: 0px; vertical-align: top;" width="209">
                                                <table class="table600" width="209" cellspacing="0" cellpadding="0" border="0" align="center">
                                                   <tr>
                                                      <td colspan="3" style="font-size:0;line-height:0;" height="25">&nbsp;</td>
                                                   </tr>
                                                   <tr>
                                                      <td class="wz" width="30"></td>
                                                      <td valign="top" align="center">
                                                         <table class="tableTxt" width="145" cellspacing="0" cellpadding="0" border="0" align="left">
                                                            <tr>
                                                               <td rowspan="2" style="line-height:1px;" width="25" valign="top" align="center">
                                                                  <!-- <img src="" style="display:block;" alt="IMG" vspace="0" hspace="0" border="0"> -->
                                                               </td>
                                                               <td rowspan="2" style="font-size:0;line-height:0;" width="14">&nbsp;</td>
                                                               <td class="header2TD" data-link-style="text-decoration:none; color:#67bffd;" data-link-color="scl" data-color="SectionCaptionTXT" style="color: #425065;font-family: sans-serif;font-size: 14px;text-align: left;line-height: 19px;font-weight: lighter;" valign="top" align="left"><a href="#" target="_blank" style="text-decoration: none;color: #67bffd;font-weight: bold;" data-color="scl"></a>Receipt Total</td>
                                                            </tr>
                                                            <tr>
                                                               <td class="RegularText4TD" data-link-style="text-decoration:none; color:#67bffd;" data-link-color="sil" data-color="SectionInfoTXT" style="color: #425065;font-family: sans-serif;font-size: 14px;font-weight: bold;text-align: left;line-height: 23px;" valign="top" align="left"><a href="#" target="_blank" style="text-decoration: none;color: #67bffd;font-weight: bold;" data-color="sil"></a>{{ $user_reservation->currency ?? '₦'}}{{ number_format($user_reservation->total) }}</td>
                                                            </tr>
                                                            <tr>
                                                               <td colspan="3" style="font-size:0;line-height:0;" height="25">&nbsp;</td>
                                                            </tr>
                                                         </table>
                                                      </td>
                                                      <td class="wz" width="30"></td>
                                                   </tr>
                                                </table>
                                             </th>
                                          </tr>
                                       </table>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                     </table>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
   </table>
   <table data-bgcolor="tbc" style="table-layout: fixed; margin: 0px auto; position: relative; opacity: 1; top: 0px; left: 0px; background-color: rgb(234, 235, 235);" data-module="MainInvoiceCaptionsModule" class="" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#384855" align="center">
      <tr>
         <td align="center">
            <table data-bgcolor="tbc" class="table600Min" style="table-layout: fixed; margin: 0px auto; min-width: 668px; background-color: rgb(234, 235, 235);" width="668" cellspacing="0" cellpadding="0" border="0" bgcolor="#384855" align="center">
               <tr>
                  <td class="table600st" style="min-width:668px;" align="center">
                     <table class="table600Min" style="min-width:629px;" width="629" cellspacing="0" cellpadding="0" border="0" align="center">
                        <tr>
                           <td class="table600st" style="min-width:629px;">
                              <table data-bgcolor="ThemeColorBG" class="table600" style="background-color: #342c27;" width="629" cellspacing="0" cellpadding="0" border="0" bgcolor="#67bffd" align="left">
                                 <tr>
                                    <td class="" align="left">
                                       <table cellspacing="0" cellpadding="0" border="0" align="center">
                                          <tr>

                                             <th class="stack2" style="margin: 0px; padding: 0px; vertical-align: top; border-bottom: 1px solid rgb(200, 198, 198);" data-border-bottom-color="borderColor" width="209">
                                                <table class="table60032" width="600" cellspacing="0" cellpadding="0" border="0" align="center">

                                                   <tr>
                                                      <td class="header5TD" data-link-style="text-decoration:none; color:#ffffff;" data-link-color="InvoiceCaptionsLink" data-color="InvoiceCaptionsTXT" style="padding: 4px;color: #ffffff;font-family: sans-serif;font-size: 15px;text-align: left;line-height: 27px;font-weight: bold;"><a href="#" target="_blank" data-color="InvoiceCaptionsLink" style="text-decoration: none;color: #ffffff;"></a>Reservation Details
</td>
                                                   </tr>

                                                </table>
                                             </th>

                                          </tr>
                                       </table>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                     </table>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
   </table>
   <div class="pofbg"></div>
   <?php foreach ($user_reservation->reservations as $reservation) { ?>
      <table data-bgcolor="tbc" style="table-layout: fixed; margin: 0px auto; background-color: rgb(234, 235, 235);" data-module="InvoiceItemDetailsModule" class="" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#384855" align="center">
         <tr>
            <td align="center">
               <table data-bgcolor="tbc" class="table600Min" style="table-layout: fixed; margin: 0px auto; min-width: 668px; background-color: rgb(234, 235, 235);" width="668" cellspacing="0" cellpadding="0" border="0" bgcolor="#384855" align="center">
                  <tr>
                     <td class="table600st" style="min-width:668px;" align="center">
                        <table class="table600Min" style="min-width:629px;" width="629" cellspacing="0" cellpadding="0" border="0" align="center">
                           <tr>
                              <td class="table600st" style="min-width:629px;">
                                 <table data-bgcolor="CalculationsBGColor" class="table600" width="629" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="left">
                                    <tr>
                                       <td align="left">
                                          <table cellspacing="0" cellpadding="0" border="0" align="center">
                                             <tr>


                                                <th class="stack2" style="margin: 0px; padding: 0px; border-bottom: 1px solid rgb(200, 198, 198);" data-border-bottom-color="borderColor" width="1000">

                                                   <table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box; margin: 30px auto; padding: 0; text-align: center; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
                                                      <tr>
                                                         <td align="center" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box;">
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box;">
                                                               <tr>
                                                                  <th width="50%" align="left" class="container-wrap" valign="top" style="vertical-align: top; width:30%;">
                                                                     <table width="100%" align="left" class="container" border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                                                                        <tbody>
                                                                           <tr>
                                                                              <td align="right" class="container-image">
                                                                                 <img class="p-img" src="{{ optional($reservation->apartment)->image_g }}" width="100%" height="auto" alt="locl" style="width: 100%; max-width: 150px; display: block; border: 0px;">

                                                                              </td>
                                                                           </tr>
                                                                        </tbody>
                                                                     </table>
                                                                  </th>
                                                                  <th width="50%" align="left" class="container-wrap" valign="top" style="vertical-align: top; width:70%;">
                                                                     <table width="100%" align="left" class="container" border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                                                                        <tbody>
                                                                           <tr>
                                                                              <td align="left" class="pn" style="padding-left:10px;">
                                                                                 <table width="260" align="left" class="container" border="0" cellpadding="0" cellspacing="0" style="width:260px;">
                                                                                    <tbody>

                                                                                       <tr>
                                                                                          <td class="text" style="text-align:left; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size:14px; line-height: 14px; text-decoration: none; color: #27af9a; font-weight:600; text-transform: uppercase; letter-spacing: 0.05em">
                                                                                             {{ optional($reservation->apartment)->name ?? optional($reservation->property)->name }}
                                                                                          </td>
                                                                                       </tr>
                                                                                       <tr>
                                                                                          <td height="9"></td>
                                                                                       </tr>
                                                                                       <tr>
                                                                                          <td class="text" data-color="#000000" data-fontsize="13" data-fontweight="400" data-letterspacing="0.05" data-lineheight="20" data-color="" data-align="left" style="text-align:left; font-family: 'Open Sans', Arial, Helvetica, sans-serif; font-size:13px; line-height: 20px; text-decoration: none; color: #444444; font-weight:400;" data-size="img-left-text-size" data-color="img-left-text-color" data-link-color="img-left-link-color" data-link-style="color: blue;">
                                                                                             <b>Check-in</b> : {{ optional($reservation->checkin)->isoFormat('dddd, MMMM Do YYYY') }}
                                                                                          </td>
                                                                                       </tr>
                                                                                       <tr>
                                                                                          <td height="9"></td>
                                                                                       </tr>

                                                                                       <tr>
                                                                                          <td class="text" data-color="#000000" data-fontsize="13" data-fontweight="400" data-letterspacing="0.05" data-lineheight="20" data-color="" data-align="left" style="text-align:left; font-family: 'Open Sans', Arial, Helvetica, sans-serif; font-size:13px; line-height: 20px; text-decoration: none; color: #444444; font-weight:400;" data-size="img-left-text-size" data-color="img-left-text-color" data-link-color="img-left-link-color" data-link-style="color: blue;">
                                                                                             <b>Check-out</b>: {{ optional($reservation->checkout)->isoFormat('dddd, MMMM Do YYYY') }}
                                                                                          </td>
                                                                                       </tr>
                                                                                       <tr>
                                                                                          <td height="9"></td>
                                                                                       </tr>


                                                                                       <tr>
                                                                                          <td class="text" data-color="#000000" data-fontsize="13" data-fontweight="400" data-letterspacing="0.05" data-lineheight="20" data-color="" data-align="left" style="text-align:left; font-family: 'Open Sans', Arial, Helvetica, sans-serif; font-size:13px; line-height: 20px; text-decoration: none; color: #444444; font-weight:400;" data-size="img-left-text-size" data-color="img-left-text-color" data-link-color="img-left-link-color" data-link-style="color: blue;">
                                                                                             {{ $user_reservation->currency ?? '₦' }}{{ $reservation->price * $reservation->rate }} per night
                                                                                          </td>
                                                                                       </tr>
                                                                                       <tr>
                                                                                          <td height="9"></td>
                                                                                       </tr>
                                                                                     
                                                                                    </tbody>
                                                                                 </table>
                                                                              </td>
                                                                           </tr>
                                                                     </table>
                                                                  </th>
                                                               </tr>
                                                            </table>
                                                         </td>
                                                      </tr>
                                                   </table>
                                                </th>

                                             </tr>
                                          </table>
                                       </td>
                                    </tr>
                                 </table>
                              </td>
                           </tr>
                        </table>
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
      </table>

   <?php  } ?>

   <!-- reservation goes here -->



   <table data-bgcolor="tbc" style="table-layout: fixed; margin: 0px auto; background-color: rgb(234, 235, 235);" data-module="FinalCalculationsModule-4ROWS" class="" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#384855" align="center">
      <tr>
         <td align="center">
            <table data-bgcolor="tbc" class="table600Min" style="table-layout: fixed; margin: 0px auto; min-width: 668px; background-color: rgb(234, 235, 235);" width="668" cellspacing="0" cellpadding="0" border="0" bgcolor="#384855" align="center">
               <tr>
                  <td class="table600st" style="min-width:668px;" align="center">
                     <table class="table600Min" style="min-width:629px;" width="629" cellspacing="0" cellpadding="0" border="0" align="center">
                        <tr>
                           <td align="left">
                              <table cellspacing="0" cellpadding="0" border="0" align="center">
                                 <tr>
                                    <th rowspan="4" class="stack4" data-bgcolor="CalculationsBGColor" data-border-bottom-color="borderColor" style="margin: 0px; padding: 0px; vertical-align: top; border-bottom: 1px solid rgb(200, 198, 198);" width="349" height="100" bgcolor="#ffffff">
                                       <table class="table60034" width="349" cellspacing="0" cellpadding="0" border="0" align="center">

                                          <tr>
                                             <td style="line-height:1px;" class="TDtable60034" width="347" align="center"></td>
                                          </tr>

                                       </table>
                                    </th>


                                 </tr>
                                 <tr>
                                    <th class="stack3" data-bgcolor="CalculationsBGColor" data-border-bottom-color="borderColor" data-border-left-color="borderColor" style="border-left: 1px solid rgb(200, 198, 198); margin: 0px; padding: 0px; vertical-align: top; border-bottom: 1px solid rgb(200, 198, 198);" width="139" valign="top" bgcolor="#ffffff">
                                       <table class="table60033" width="139" cellspacing="0" cellpadding="0" border="0" align="center">
                                          <tr>
                                             <td class="wz2" height="10" width="30"></td>
                                          </tr>
                                          <tr>
                                             <td class="wz2" width="30"><br></td>
                                             <td class="rt5td" data-link-style="text-decoration:none; color:#67bffd;" data-link-color="RegularLink" data-color="RegularTXT" style="color: #425065;font-family: sans-serif;font-size: 14px;font-weight: lighter;text-align: center;line-height: 23px;"><a href="#" target="_blank" data-color="RegularLink" style="text-decoration: none;color: #67bffd;"></a>Sub Total </td>
                                             <td class="wz2" width="30"><br></td>
                                          </tr>
                                          <tr>
                                             <td class="wz2" height="10" width="30"></td>
                                          </tr>
                                       </table>
                                    </th>
                                    <th class="stack3" data-bgcolor="CalculationsBGColor" data-border-bottom-color="borderColor" data-border-left-color="borderColor" style="border-left: 1px solid rgb(200, 198, 198); margin: 0px; padding: 0px; vertical-align: top; border-bottom: 1px solid rgb(200, 198, 198);" width="139" valign="top" bgcolor="#ffffff">
                                       <table class="table60033" width="139" cellspacing="0" cellpadding="0" border="0" align="center">
                                          <tr>
                                             <td class="wz2" height="10" width="30"></td>
                                          </tr>
                                          <tr>
                                             <td class="wz2" width="30"><br></td>
                                             <td class="rt5td" data-link-style="text-decoration:none; color:#67bffd;" data-link-color="RegularLink" data-color="RegularTXT" style="color: #425065;font-family: sans-serif;font-size: 14px;font-weight: lighter;text-align: center;line-height: 23px;"><a href="#" target="_blank" data-color="RegularLink" style="text-decoration: none;color: #67bffd;"></a>{{ $user_reservation->currency ?? '₦'}}{{ number_format($user_reservation->original_amount)   }}</td>
                                             <td class="wz2" width="30"><br></td>
                                          </tr>
                                          <tr>
                                             <td class="wz2" height="10" width="30"></td>
                                          </tr>
                                       </table>
                                    </th>
                                 </tr>
                                 <tr>
                                    <th class="stack3" data-bgcolor="CalculationsBGColor" data-border-bottom-color="borderColor" data-border-left-color="borderColor" style="border-left: 1px solid rgb(200, 198, 198); margin: 0px; padding: 0px; vertical-align: top; border-bottom: 1px solid rgb(200, 198, 198);" width="139" valign="top" bgcolor="#ffffff">
                                       <table class="table60033" width="139" cellspacing="0" cellpadding="0" border="0" align="center">
                                          <tr>
                                             <td class="wz2" height="10" width="30"></td>
                                          </tr>
                                          <tr>
                                             <td class="wz2" width="30"><br></td>
                                             <td class="rt5td" data-link-style="text-decoration:none; color:#67bffd;" data-link-color="RegularLink" data-color="RegularTXT" style="color: #425065;font-family: sans-serif;font-size: 14px;font-weight: lighter;text-align: center;line-height: 23px;"><a href="#" target="_blank" data-color="RegularLink" style="text-decoration: none;color: #67bffd;"></a>
                                             {{ $user_reservation->payment_type === 'checkin' ?  'Discount' : 'Coupon' }} 
                                          
                                          </td>
                                             <td class="wz2" width="30"><br></td>
                                          </tr>
                                          <tr>
                                             <td class="wz2" height="10" width="30"></td>
                                          </tr>
                                       </table>
                                    </th>
                                    <th class="stack3" data-bgcolor="CalculationsBGColor" data-border-bottom-color="borderColor" data-border-left-color="borderColor" style="border-left: 1px solid rgb(200, 198, 198); margin: 0px; padding: 0px; vertical-align: top; border-bottom: 1px solid rgb(200, 198, 198);" width="139" valign="top" bgcolor="#ffffff">
                                       <table class="table60033" width="139" cellspacing="0" cellpadding="0" border="0" align="center">
                                          <tr>
                                             <td class="wz2" height="10" width="30"></td>
                                          </tr>
                                          <tr>
                                             <td class="wz2" width="30"><br></td>
                                             <td class="rt5td" data-link-style="text-decoration:none; color:#67bffd;" data-link-color="RegularLink" data-color="RegularTXT" style="color: #425065;font-family: sans-serif;font-size: 14px;font-weight: lighter;text-align: center;line-height: 23px;"><a href="#" target="_blank" data-color="RegularLink" style="text-decoration: none;color: #67bffd;"></a> 
                                                @if ( $user_reservation->payment_type === 'checkin' )
                                                   {{ $user_reservation->discount ?  $user_reservation->discount : "" }} 
                                                @else
                                                  {{ $user_reservation->coupon ?  $user_reservation->coupon.'  -%'.$user_reservation->voucher()->amount . 'off'  : '---' }} 
                                                @endif
                                             </td>
                                             <td class="wz2" width="30"><br></td>
                                          </tr>
                                          <tr>
                                             <td class="wz2" height="10" width="30"></td>
                                          </tr>
                                       </table>
                                    </th>
                                 </tr>


                                 <tr>
                                    <th class="stack3" data-bgcolor="ThemeColorBG" data-border-bottom-color="borderColor" data-border-left-color="borderColor" style="border-left: 1px solid rgb(200, 198, 198); margin: 0px; padding: 0px; vertical-align: top; border-bottom: 1px solid rgb(200, 198, 198); background-color:#342c27;" width="139" valign="top" bgcolor="#67bffd">
                                       <table class="table60033" width="139" cellspacing="0" cellpadding="0" border="0" align="center">
                                          <tr>
                                             <td class="wz2" height="10" width="30"></td>
                                          </tr>
                                          <tr>
                                             <td class="wz2" width="30"><br></td>
                                             <td data-bgcolor="ThemeColorBG" class="header5TD" data-link-style="text-decoration:none; color:#ffffff;" data-link-color="InvoiceCaptionsLink" data-color="InvoiceCaptionsTXT" style="color: rgb(255, 255, 255); font-family: sans-serif; font-size: 15px; text-align: center; line-height: 27px; font-weight: bold; background-color:#342c27;" bgcolor="#67bffd"><a href="#" target="_blank" data-color="InvoiceCaptionsLink" style="text-decoration: none;color: #ffffff;"></a>Total</td>
                                             <td class="wz2" width="30"><br></td>
                                          </tr>
                                          <tr>
                                             <td class="wz2" height="10" width="30"></td>
                                          </tr>
                                       </table>
                                    </th>
                                    <th class="stack3" data-bgcolor="ThemeColorBG" data-border-bottom-color="borderColor" data-border-left-color="borderColor" style="border-left: 1px solid rgb(200, 198, 198); margin: 0px; padding: 0px; vertical-align: top; border-bottom: 1px solid rgb(200, 198, 198); background-color:#342c27;" width="139" valign="top" bgcolor="#67bffd">
                                       <table class="table60033" width="139" cellspacing="0" cellpadding="0" border="0" align="center">
                                          <tr>
                                             <td class="wz2" height="10" width="30"></td>
                                          </tr>
                                          <tr>
                                             <td class="wz2" width="30"><br></td>
                                             <td data-bgcolor="ThemeColorBG" class="header5TD" data-link-style="text-decoration:none; color:#ffffff;" data-link-color="InvoiceCaptionsLink" data-color="InvoiceCaptionsTXT" style="color: rgb(255, 255, 255); font-family: sans-serif; font-size: 15px; text-align: center; line-height: 27px; font-weight: bold; background-color:#342c27;" bgcolor="#67bffd"><a href="#" target="_blank" data-color="InvoiceCaptionsLink" style="text-decoration: none;color: #ffffff;"></a>{{ $user_reservation->currency ?? '₦' }}{{ number_format($user_reservation->total) }}</td>
                                             <td class="wz2" width="30"><br></td>
                                          </tr>
                                          <tr>
                                             <td class="wz2" height="10" width="30"></td>
                                          </tr>
                                       </table>
                                    </th>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                     </table>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
   </table>
   <table data-bgcolor="tbc" style="table-layout: fixed; margin: 0px auto; background-color: rgb(234, 235, 235);" data-module="FooterModule" data-thumb="http://www.emailtemplatebuilders.com/INVOICE-Generator/03_TBThumbnails/module-10.jpg" class="" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#384855" align="center">
      <tr>
         <td align="center">
            <table data-bgcolor="tbc" class="table600Min" style="table-layout: fixed; margin: 0px auto; min-width: 668px; background-color: rgb(234, 235, 235);" width="668" cellspacing="0" cellpadding="0" border="0" bgcolor="#384855" align="center">
               <tr>
                  <td class="table600st" style="min-width:668px;" align="center">
                     <table data-bgcolor="tbc" class="table600Min" style="table-layout: fixed; margin: 0px auto; min-width: 629px; background-color: rgb(234, 235, 235);" width="629" cellspacing="0" cellpadding="0" border="0" bgcolor="#384855" align="center">
                        <tr>
                           <td class="table600st" style="border:1px solid #f4f4f4; background-color: #f4f4f4;min-width:629px;" align="center">
                              <table class="table600" width="610" cellspacing="0" cellpadding="0" border="0" align="center">

                                 <tr>

                                    <td class="catd" data-link-style="text-decoration:none; color:#ffffff;" data-link-color="FooterCaptionLink" data-color="FooterCaptionTXT" style="color: rgb(12, 13, 13); font-family: sans-serif; font-size: 13px; text-align: center; font-weight: bold; line-height: 190%;">
                                       <a href="https://avenuemontaigne.ng/pages/cancellation-policy" target="_blank" style="text-decoration: none;color: #67bffd;font-weight: bold;" data-color="FooterCaptionLink">
                                          Click here read about our cancellation policy.

                                       </a>
                                       <br /> Thank you for using our service.
                                    </td>
                                 </tr>

                                 <tr>

                                    <td class="moptd" data-link-style="text-decoration:none; color:#333;" data-link-color="MailingOptionsLink" data-color="MailingOptionsTXT" style="color: #333; font-family: sans-serif; font-size: 12px; text-align: center; line-height: 170%;"><a href="https://avenuemonatigne.ng"></a></td>
                                 </tr>

                                 <tr>

                                    <td class="moptd" data-link-style="text-decoration:none; color:#ffffff;" data-link-color="MailingOptionsLink" data-color="MailingOptionsTXT" style="color: rgb(13, 14, 12); font-family: sans-serif; font-size: 12px; text-align: center; line-height: 170%;">All rights Reserved name </td>
                                 </tr>

                              </table>
                           </td>
                        </tr>
                     </table>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
   </table>


</body>

</html>
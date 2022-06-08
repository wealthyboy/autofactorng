<?php

namespace App\Http;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\SystemSetting;



class Helper{



    function active_link (array $url)  { 
        $uri =   $_SERVER['REQUEST_URI'];
        $link = explode("/",$uri);
        $link = isset( $link[2] ) ? strtolower($link[2]) : '';
        return in_array($link, $url) ? 'active' : '';
    }

    function getShippingPrice($id){
        $price =  Shipping::findOfail($id);
        return $price->price;
    }

    public  static function getFormatedDate($date)
    {
        if($date) {
            $exp_date = explode('-', $date);
            $expiry_date = Carbon::createFromDate($exp_date[0], $exp_date[1], $exp_date[2]);//
        }else{
            $expiry_date = null;
        }
        return $expiry_date;
    }


    function make_active ($link) { 
        foreach ( $this->my_link () as $pages) { 
            if ( strtolower($pages) == strtolower($link)) { 
                return 'active';
            }
        }
    }


    public   static function getDate($date){
        if ($date){
            $exp_date = explode(' ', $date);
            $exp_date = $date[0];
        // $expiry_date = Carbon::createFromDate($exp_date[2], $exp_date[1], $exp_date[0]);
        } else {
            $expiry_date = null;
        }

        return $expiry_date;
    }


    public static function getTableColumns($table)
    {
        return \DB::getSchemaBuilder()->getColumnListing($table);
    }


    public static function makeSlug ( $string ) { 
        $slug=strtolower( $string );
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $slug);
        return ltrim(rtrim($slug,'-'));      
    }


    public static function sanitizeTags ( $string ) { 
        $tag=strtolower( $string );
        $tag = preg_replace('/[^A-Za-z0-9-]+/', ',', $tag);
        return ltrim(rtrim($tag, ','));   
    }

    public static function rate(){
        $rate=session('rate');;
        $rate = json_decode($rate);
        return $rate;
    }

    public static function getCurrency(){
        return Helper::rate()->symbol ?? optional(optional(SystemSetting::first())->currency)->symbol;
    } 

    public  static function getIsoCode(){
        return Helper::rate()->iso_code3 ?? optional(optional(SystemSetting::first())->currency)->iso_code3;
    }


    public static function EU(){
       
        return [
        "AT" => "Austria",
        "BE" => "Belgium",
        "BG" => "Bulgaria",
        "CY" => "Cyprus",
        "CZ" => "Czech Republic",
        "DK" => "Denmark",
        "EE" => "Estonia",
        "FI" => "Finland",
        "FR" => "France",
        "DE" => "Germany",
        "GR" => "Greece",
        "HU" => "Hungary",
        "IE" => "Ireland",
        "IT" => "Italy",
        "LV" => "Latvia",
        "LT" => "Lithuania",
        "LU" => "Luxembourg",
        "MT" => "Malta",
        "NL" => "Netherlands",
        "PL" => "Poland",
        "PT" => "Portugal",
        "RO" => "Romania",
        "SK" => "Slovakia (Slovak Republic)",
        "SI" => "Slovenia",
        "ES" => "Spain",
        ];
         
    }

    public static function col_width(){
        return [
            'col-lg-12',
            'col-lg-10',
            'col-lg-9',
            'col-lg-8',
            'col-lg-7',
            'col-lg-6',
            'col-lg-5',
            'col-lg-4',
            'col-lg-3',
            'col-lg-2',
            'col-lg-1',
    ];
    }




    public static function getPercentageDiscount($percentage_value,$fee){
        $var =($percentage_value/100) * $fee;
        $new_fee = $fee - $var;
        return $new_fee;
    }

    function display_html($link,$html) { 
        
        if ( $pages) { 
            return $html;
        } else  { 
            return '';
        }
    }

    public static function Countries(){

        return  $countries = array("Afghanistan", 
                "Albania",
                "Algeria", 
                "American Samoa", 
                "Andorra", 
                "Angola", 
                "Anguilla", 
                "Antarctica",
                "Antigua and Barbuda", 
                "Argentina", "Armenia", 
                "Aruba", "Australia", 
                "Austria", "Azerbaijan", 
                "Bahamas", "Bahrain",
                "Bangladesh",
                "Barbados", 
                "Belarus", "Belgium",
                "Belize", 
                "Benin", "Bermuda", 
                "Bhutan", "Bolivia", 
                "Bosnia and Herzegowina", 
                "Botswana", "Bouvet Island", 
                "Brazil", "British Indian Ocean Territory",
                "Brunei Darussalam", "Bulgaria",
                "Burkina Faso", "Burundi", "Cambodia",
                "Cameroon", "Canada",
                "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
            
    }

}




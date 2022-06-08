<?php  namespace App\Http\Controllers\Admin\Settings;

use Illuminate\Http\Request;

use App\Http\Requests\SystemSettingsRequest;

use App\SystemSetting;
use App\User;
use App\Http\Controllers\Controller;
use App\Http\Flash;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Currency;
use App\Payment;



class SettingsController extends Controller
{
    //
	
	
	 public function __construct()
    {
       $this->middleware('admin'); 
    }

	public function index(){
		$setting = SystemSetting::first();
		//$ship_company = ShipCompany::all();
		if ( $setting) { 
		  	 return view('admin.settings.index',compact('setting'));
		}
		User::canTakeAction(5);
	    return view('admin.settings.create',compact('setting','currencies'));
    }

	
	
	public function edit($id){
		User::canTakeAction(4);
		$setting = SystemSetting::find($id); 
		$currencies = Currency::all();
		$payments = Payment::all();
		return view('admin.settings.create', compact('setting','payments','currencies'));	
    }
	
	
	public function update(Request $request,$id){
		$ip = $_SERVER['REMOTE_ADDR'];
		$settings = SystemSetting::find($id); 
		$file_logo = '';
		$logo = '';	
	
		if ( $request->file('image') )  { 
			$file_logo = $request->file('image');
			$logo      =  !empty($file_logo->getClientOriginalName()) ?  time().$file_logo->getClientOriginalName() :  '' ;
			$file_logo->move('images/logo',$logo);
			$settings->store_logo = $logo;
		    $settings->store_icon =  $logo;
		}

		$settings->image =  null;
		$settings->store_name                   =$request->store_name;
		$settings->address                      =$request->address;
		$settings->store_email                  =$request->store_email;
		$settings->store_phone                  =$request->store_phone;
		$settings->meta_title                   =$request->meta_title;
		$settings->alert_email                  =$request->alert_email;
		$settings->order_status                 ='';
		$settings->invoice_prefix               =$request->invoice_prefix;
		$settings->s_h_w_l                      = $request->s_h_w_l;
		$settings->s_h_o_l                      = $request->s_h_o_l;
		$settings->allow_multi_currency         = $request->allow_multi_currency ? true : false;
		$settings->opening_times                =$request->opening_times;
		$settings->currency_id                  =$request->currency_id;
		$settings->meta_description             =$request->meta_description;
		$settings->meta_tag_keywords            =$request->meta_tag_keywords;
		$settings->products_items_per_page      =$request->products_items_per_page;
		$settings->products_items_size_h        =$request->products_items_size_h;
		$settings->products_items_size_w        =$request->products_items_size_w;
		$settings->facebook_link                =$request->facebook_link;
		$settings->instagram_link               =$request->instagram_link;
		$settings->twitter_link                 =$request->twitter_link;
		$settings->youtube_link                 =$request->youtube_link;
		$settings->shipping_is_free  = $request->shipping_is_free ? 1 : 0;

		//$settings->max_file_size                =$request->max_file_size;
		$settings->save();
		$flash = app('App\Http\Flash');
		$flash->success("Success","Inserted");
		return \Redirect::to('/admin/settings');
    }
	
	 
	public function store(Request $request){
		//Check the databse for the owner
		$ip = $_SERVER['REMOTE_ADDR'];
		$settings =  new SystemSetting;
		$file_logo = '';
		$logo = '';	
		if ( $request->file('image') )  { 
			$file_logo = $request->file('image');
			$logo      =  !empty($file_logo->getClientOriginalName()) ?  time().$file_logo->getClientOriginalName() :  '' ;
			$file_logo->move('images/logo',$logo);
		}
		$settings->store_logo = $logo;
		$settings->store_icon =  $logo;
		$settings->image =  null;
		$settings->store_name                   =$request->store_name;
		$settings->address                      =$request->address;
		$settings->store_email                  =$request->store_email;
		$settings->store_phone                  =$request->store_phone;
		$settings->meta_title                   =$request->meta_title;
		$settings->alert_email                  =$request->alert_email;
		$settings->order_status                 ='Pending';
		$settings->invoice_prefix               =$request->invoice_prefix;
		$settings->s_h_w_l                      =$request->s_h_w_l;
		$settings->s_h_o_l                      =$request->s_h_o_l;
		$settings->allow_multi_currency         = $request->allow_multi_currency ? true : false;
		$settings->opening_times                =$request->opening_times;
		$settings->meta_description             =$request->meta_description;
		$settings->meta_tag_keywords            =$request->meta_tag_keywords;
		$settings->facebook_link                =$request->facebook_link;
		$settings->instagram_link               =$request->instagram_link;
		$settings->twitter_link                 =$request->twitter_link;
		$settings->youtube_link                 =$request->youtube_link;
		$settings->currency_id                  =$request->currency_id;
		$settings->products_items_per_page      =$request->products_items_per_page;
		$settings->products_items_size_h        =$request->products_items_size_h;
		$settings->products_items_size_w        =$request->products_items_size_w;
		$settings->shipping_is_free  = $request->shipping_is_free ? 1 : 0;

		//$settings->max_file_size                =$request->max_file_size;
		$settings->save();
		//$flash = app('App\Http\Flash');
		//$flash->success("Success","Inserted");
		return \Redirect::to('/admin/settings');

	}
	    
}

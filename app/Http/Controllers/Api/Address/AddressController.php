<?php

namespace App\Http\Controllers\Api\Address;




use Illuminate\Support\Facades\Auth;

use Validator;
use App\Models\State;
use App\Models\Location;
use App\Models\User;
use App\Models\Shipping;
use App\Models\Address;

use App\Http\Controllers\Controller;
use App\Http\Resources\AddressResource;
use Illuminate\Http\Request;
use App\Http\Resources\LocationResource;
use App\Models\Cart;

class AddressController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        // sleep(30);
        return $this->allAddress();
    }


    public function allAddress()
    {
        $user =  \Auth::user();
        $addresses = User::find($user->id)->addresses;
        $locations = Location::parents()->orderBy('name', 'asc')->get();
        $shipping_parents = Shipping::parents()->get();
        $default_address = $user->activeAddress();

        $prices = [];

        $sub_total =  Cart::sum_items_in_cart();

        //return $default_address;

        $ship_price =   $default_address ? optional(optional($default_address->address_state)->shipping)->price : null;

        $heavy_item_price = 2;

        $prices['ship_price'] =  $ship_price;
        $prices['heavy_item_price'] =  $heavy_item_price;
        $prices['total'] =   $sub_total + $ship_price + $heavy_item_price;



        return AddressResource::collection(
            $addresses
        )->additional([
            'meta' => [
                'prices' => collect($prices),
                'default_shipping' => null,
                'states' => Location::all(),
                'default_address' =>  $default_address
            ]
        ]);
    }


    public function store(Request $request)
    {
        $id = Auth::user()->id;
        $this->validate($request, [
            'first_name'   => 'required|max:30',
            'last_name'    => 'required|max:30',
            'address'      => 'required|max:200',
            'city'         => 'required|max:100',
            'state_id'        => 'required|numeric',
        ]);
        $address  = new Address();
        $address->user_id     =  $id;
        $address->first_name  =  $request->first_name;
        $address->last_name   =  $request->last_name;
        $address->address     =  $request->address;
        $address->address_2   =  $request->address_2;
        //$address->email           =  $request->email;
        $address->is_active =  false;
        $address->city  =  $request->city;
        $address->state_id =  $request->state_id;
        $address->save();
        $addresses =  Address::where(['user_id' =>  \Auth::id(), 'is_active' => true])->first();


        if (null == $addresses) {
            $address->is_active  = 1;
            $address->save();
        }

        return $this->allAddress();
    }




    public function destroy(Request $request, $id)
    {
        $address = Address::findOrFail($id);
        $user =  \Auth::user();
        if ($address) {
            $address->delete();
            $addresses = User::find($user->id)->addresses;
            if ($addresses) {
                $default_address = $user->activeAddress();
                if (null == $default_address) {
                    $address = $addresses->first();
                    if ($address) {
                        $address->is_active = 1;
                        $address->save();
                    }
                }
            }
            return $this->allAddress();
        }
        return response()->json([], 419);
    }

    public function makeDefault(Request $request, $id)
    {
        $request->user()->addresses()
            ->where('is_active', true)
            ->update(['is_active' => false]);
        $address  = Address::find($id);
        $address->is_active = true;
        if ($address->save()) {
            return $this->allAddress();
        }
        return response()->json([], 419);
    }


    public function update(Request $request, $id)
    {

        $address = Address::find($id);
        $user = \Auth::user();
        $this->validate($request, [
            'first_name'   => 'required|max:30',
            'last_name'    => 'required|max:30',
            'address'      => 'required|max:200',
            'city'         => 'required|max:100',
            'state_id'        => 'required|numeric',
            'country_id'      => 'required'
        ]);

        $address->user_id    =  $user->id;
        $address->first_name =  $request->first_name;
        $address->last_name  =  $request->last_name;
        $address->address    =  $request->address;
        $address->address_2  =  $request->address_2;
        $address->email                       =  $request->email;
        $address->phone_number                =  $request->phone_number;
        $address->city       =  $request->city;
        $address->state_id   =  $request->state_id;
        $address->country_id =  $request->country_id;
        $address->save();
        //Get The Address
        return $this->allAddress();
    }
}

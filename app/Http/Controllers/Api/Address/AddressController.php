<?php

namespace App\Http\Controllers\Api\Address;




use Illuminate\Support\Facades\Auth;

use Validator;
use App\Models\ShippingRate;
use App\Models\Location;
use App\Models\User;
use App\Models\Shipping;
use App\Models\Address;

use App\Http\Controllers\Controller;
use App\Http\Resources\AddressResource;
use Illuminate\Http\Request;
use App\Http\Resources\LocationResource;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Builder;

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

        $sub_total = Cart::sum_items_in_cart();
        $carts = Cart::all_items_in_cart();
        $ship_price = $default_address ? optional(optional($default_address->address_state)->shipping)->price : null;

        $heavy_item_price = [];


        $is_lagos = null !== $default_address && optional($default_address->address_state)->name  == 'Lagos' ? 1 : 0;

        foreach ($carts as $key => $cart) {
            if ($cart->product->condition_is_present) {
                $heavy_item_prices = ShippingRate::where(['product_id' => $cart->product_id, 'is_lagos' => $is_lagos])->get();

                // foreach ($heavy_item_prices as $heavy_item_price) {
                //     if ($heavy_item_price->condition == '=') {
                //         $heavy_item_price[] = $cart->quantity == $heavy_item_price->tag_value ? $heavy_item_price->price :  null;
                //     }

                //     if ($heavy_item_price->condition == '>') {
                //         $heavy_item_price[] = $cart->quantity > $heavy_item_price->tag_value ? $heavy_item_price->price :  null;
                //     }
                // }
            }
        }

        return $heavy_item_price;

        $hp = null;

        if (!empty($heavy_item_price)) {
            $hp = collect($heavy_item_price)->sum('price');
            $prices['heavy_item_price'] = $hp;
        }

        $prices['ship_price'] =  $ship_price;
        $prices['total'] =   $sub_total + $ship_price + $hp;

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
        ]);

        $address->user_id = $user->id;
        $address->first_name = $request->first_name;
        $address->last_name = $request->last_name;
        $address->address = $request->address;
        $address->address_2 = $request->address_2;
        $address->email = $request->email;
        $address->phone_number = $request->phone_number;
        $address->city =  $request->city;
        $address->state_id = $request->state_id;
        $address->save();
        //Get The Address
        return $this->allAddress();
    }
}

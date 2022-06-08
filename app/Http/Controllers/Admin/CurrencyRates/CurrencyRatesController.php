<?php

namespace App\Http\Controllers\Admin\CurrencyRates;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CurrencyRate;
use App\Currency;
use App\SystemSetting;

class CurrencyRatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rates = CurrencyRate::all();
        $default = SystemSetting::first();
        return view('admin.rates.index',compact('rates','default'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $default = SystemSetting::first();
        $currencies = Currency::where('id','!=', $default->currency_id)->get();
        return view('admin.rates.create',compact('currencies','default'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $currency_rate = new CurrencyRate();
        $currency_rate->currency1_id = $request->currency1_id;
        $currency_rate->currency2_id = $request->currency2_id;
        $currency_rate->rate = $request->rate;
        $currency_rate->save();
        return redirect()->route('rates.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $default = SystemSetting::first();
        $currencies = Currency::where('id','!=', $default->currency_id)->get();
        $currency_rate = CurrencyRate::find($id);
        return view('admin.rates.edit',compact('currencies','default','currency_rate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $currency_rate = CurrencyRate::find($id);
        $currency_rate->currency1_id = $request->currency1_id;
        $currency_rate->currency2_id = $request->currency2_id;
        $currency_rate->rate = $request->rate;
        $currency_rate->save();
        return redirect()->route('rates.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
		$rules = array(
				'_token' => 'required',
		);
		$validator = \Validator::make($request->all(),$rules);
		if ( empty ( $request->selected ) ) {
			$validator->getMessageBag()->add('Selected', 'Nothing to Delete');    
			return \Redirect::back()
						->withErrors($validator)
						->withInput();
		}
		CurrencyRate::destroy($request->selected);
		return redirect()->back();
    }
}

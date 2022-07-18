<?php

namespace App\Http\Controllers\Admin\Brand;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\User;



class BrandsController extends Controller
{
    //

    
    
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }


    public function index()
    {    
        $brands =  Brand::orderBy('name','asc')->get();
        return view('admin.brands.index',compact('brands'));
	}
	

	 public function create()
    {   
		//User::canTakeAction(2);
		return view('admin.brands.create');
    }
	
	public function store(Request $request)
    {   
		$this->validate($request, [
			'name' => 'required|unique:brands',
		]);
		Brand::Insert($request->except('_token'));
		return redirect()->route('brands.index') ; 
	}
	
	
	public function edit(Request $request ,$id)
    {   
		$brand = Brand::find($id);
		return view('admin.brands.edit',compact('brand'));
	}


	public function update(Request $request, $id)
    {    

		$this->validate($request, [
			//'name' => 'required|unique:brands',
		]);

		$brand = Brand::find($id);
		$brand->update($request->all());
		return redirect()->route('brands.index'); 
	}
	
	
	public function destroy(Request $request,$id)
    {     
		//User::canTakeAction(5);
		$rules = array(
				'_token' => 'required',
		);
		$validator = \Validator::make($request->all(),$rules);
		if ( empty ( $request->selected)) {
			$validator->getMessageBag()->add('Selected', 'Nothing to Delete');
			return \Redirect::back()
			->withErrors($validator)
			->withInput();
		}
		Brand::destroy($request->selected);  	
	
		return redirect()->back();	 
	}
	
	
}



<?php

namespace App\Http\Controllers\Admin\Engines;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Engine;

class EnginesController extends Controller
{
    public function index()
    {    
        $engines =  Engine::orderBy('name','asc')->get();
        return view('admin.engines.index',compact('engines'));
	}
	

	 public function create()
    {   
		//User::canTakeAction(2);
		return view('admin.engines.create');
    }
	
	public function store(Request $request)
    {   

		$this->validate($request, [
			'name' => 'required|unique:engines',
		]);

		Engine::Insert($request->except('_token'));
		return redirect()->route('engines.index') ; 
	}
	
	
	public function edit(Request $request ,$id)
    {   
		$engine = Engine::find($id);
		return view('admin.engines.edit',compact('engine'));
	}


	public function update(Request $request, $id)
    {    

		$this->validate($request, [
			//'name' => 'required|unique:brands',
		]);

		$engine = Engine::find($id);
		$engine->update($request->all());
		return redirect()->route('engines.index'); 
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
		Engine::destroy($request->selected);  	
	
		return redirect()->back();
    		 
	}
}

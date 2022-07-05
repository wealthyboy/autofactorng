<?php

namespace App\Http\Controllers\Admin\Live;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Live;

class LiveController extends Controller  { 


    
    public function index(Request $request)
    {     
    	$st = Live::first();	
        return view('admin.site_status.index',compact('st'));
    }
    
    public function activate(Request $request){

        $st= Live::first();

       if (null !== $st && $st->make_live == true) {
       	    $st->update([
       	    	'make_live'=>false
       	    ]);
       	    return redirect()->route('maintainance', [$st]);
       } 

       if(null !== $st && $st->make_live == false){
            $st->update([
                'make_live'=>true
            ]);
            return redirect()->route('maintainance', [$st]);
       }
        $st= Live::create([
            'make_live'=>true
        ]);
        return redirect()->route('maintainance', [$st]);	
       
       
    	
    }


}
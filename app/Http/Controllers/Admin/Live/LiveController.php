<?php

namespace App\Http\Controllers\Admin\Live;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Models\Live;
use App\Models\User;

class LiveController extends Controller
{



    public function index(Request $request)
    {
        User::canTakeAction(User::canEnableSite);
        $st = Live::first();
        return view('admin.site_status.index', compact('st'));
    }

    public function activate(Request $request)
    {

        $st = Live::first();

        if (null !== $st && $st->make_live == true) {
            $st->update([
                'make_live' => false
            ]);
            return redirect()->route('maintainance', [$st]);

            (new Activity)->put("Disabled site");
        }

        if (null !== $st && $st->make_live == false) {

            $st->update([
                'make_live' => true
            ]);

            (new Activity)->put("Enabled site");

            return redirect()->route('maintainance', [$st]);
        }

        $st = Live::create([
            'make_live' => true
        ]);

        (new Activity)->put("Enabled site");

        return redirect()->route('maintainance', [$st]);
    }
}

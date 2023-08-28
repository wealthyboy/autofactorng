<?php

namespace App\Http\Controllers\Admin\Customers;

use App\DataTable\Table;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletBalance;
use App\Notifications\AutoCreditNotification;
use App\Notifications\ReminderNotification;
use Illuminate\Support\Facades\Notification;


class CustomersController extends Table
{

    public $deleted_names = 'email';

    public $link = '/admin/customers';


    public $deleted_specific = 'user with emails';

    public function builder()
    {
        return User::query();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = (new User())->customers()->orderBy('id', 'DESC')->paginate(100);
        $users = $this->getColumnListings(request(), $users);
        return   view('admin.customers.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        // dd($user);
        return view('admin.customers.show', compact('user', 'id'));
    }


    public function routes()
    {
        return [
            'edit' =>  [
                'admin.users.edit',
                'user'
            ],
            'update' => null,
            'show' => null,
            'destroy' =>  [
                'admin.users.destroy',
                'user'
            ],
            'create' => [
                'admin.users.create'
            ],
            'index' => null
        ];
    }

    public function unique()
    {
        return [
            'show'  => true,
            'right' => false,
            'edit' => false,
            'search' => true,
            'add' => false,
            'destroy' => true,
            'export' => true
        ];
    }


    public function fundWallet(Request $request, $id)
    {
        $user = User::find($id);
        $balance = WalletBalance::where('user_id', $id)->first();
        $wallet = new Wallet;
        $wallet->amount = $request->amount;
        $wallet->user_id = $id;
        $wallet->status = $request->status;
        $wallet_status = null;
        if ($request->type == 'auto_credit' && $request->status == 'added') {
            $wallet_status =  'Added to  your auto credit';
        }

        if ($request->type == 'auto_credit' && $request->status == 'removed') {
            $wallet_status =  'Removed from auto credit';
        }

        if ($request->type == 'wallet' && $request->status == 'added') {
            $wallet_status =  'Added to your wallet';
        }

        if ($request->type == 'wallet' && $request->status == 'removed') {
            $wallet_status = 'Removed from your wallet';
        }

        $wallet->status = $wallet_status;
        $wallet->save();

        if ($request->type == 'wallet') {

            $wallet =  WalletBalance::firstOrNew(
                ['user_id' => $id]
            );

            $wallet->balance = $request->status == 'added' ? (int) optional($balance)->balance + $request->amount :  optional($balance)->balance  - $request->amount;
            $wallet->user_id = $id;
            $wallet->save();
        }

        if ($request->type == 'auto_credit') {
            $wallet =  WalletBalance::firstOrNew(
                ['user_id' => $id]
            );

            $wallet->auto_credit = $request->status == 'added' ? (int) optional($balance)->auto_credit  + $request->amount :  $balance->auto_credit  - $request->amount;
            $wallet->user_id = $id;
            $wallet->save();
        }

        try {
            $message = '₦' . number_format($request->amount) . " has been " . $wallet_status . '.';
            $user->notify(new ReminderNotification($user, $message));
        } catch (\Throwable $th) {
            throw $th;
        }

        $message = '₦' . number_format($request->amount) . " has been " . $request->status . '.';

        return redirect()->to('/admin/customers')->with('message', $message);
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request, $id)
    {
        // User::canTakeAction(User::canDelete);

        $customers = User::find($request->selected)->pluck('email')->toArray();

        $this->builder->whereIn('id', $request->selected)->delete();

        // (new Activity)->put("Deleted a  " . implode(',', $customers));

        if ($this->useJson) {
            return;
        }

        return back();
    }
}

<?php

namespace App\Http\Controllers\Wallets;

use App\DataTable\Table;
use App\Http\Controllers\Controller;
use App\Models\Wallet;
use App\Utils\AccountSettingsNav;
use Illuminate\Http\Request;
use App\Events\NewBid;
use App\Models\Subscribe;
use App\Models\WalletBalance;
use Carbon\Carbon;

class WalletsController extends Table
{

    public function __construct()
    {
        $this->middleware('auth');

        parent::__construct();
    }


    public function builder()
    {
        return Wallet::query();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nav = (new AccountSettingsNav())->nav();
        $user = auth()->user();
        $collections = $this->getColumnListings(request(), $user->wallets()->paginate(20));

        if (request()->ajax()) {
            return response()->json([
                'collections' =>  $collections,
            ]);
        }

        return view('wallet.index', compact('nav', 'user'));
    }


    public function walletBalnce()
    {
        $wallet_balance  =   auth()->user()->wallet_balance;
        $total  = (int) optional($wallet_balance)->balance + optional($wallet_balance)->auto_credit;
        return response()->json([
            'wallet_balance' => (int) optional($wallet_balance)->balance,
            'auto_credit' => (int) optional($wallet_balance)->auto_credit,
            'total' => $total
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $input = $request->all();
        $amount = (10 * $input['amount']) / 100;
        $amount = $input['amount'] +  $amount;
        // return $amount;

        $wallet = new Wallet;
        $wallet->amount = !$request->auto_credit ?  $request->amount : $amount;
        $wallet->user_id = $user->id;
        $wallet->status = $request->auto_credit ?  'Added to auto credit' : 'Added to wallet';
        $wallet->save();

        $balance = WalletBalance::where('user_id', $user->id)->first();

        if (!$request->auto_credit) {
            if (null !== $balance) {
                $balance->balance = $balance->balance +  $input['amount'];
                $balance->save();
            } else {
                $balance = new WalletBalance;
                $balance->balance = $input['amount'];
                $balance->user_id = $user->id;
                $balance->save();
            }
        }

        if ($request->auto_credit) {

            if (null !== $balance) {
                $balance->auto_credit = $balance->auto_credit +  $amount;
                $balance->save();
            } else {
                $balance = new WalletBalance;
                $balance->auto_credit = $amount;
                $balance->user_id = $user->id;
                $balance->save();
            }

            $subscribe = Subscribe::where('user_id', $user->id)->first();

            $dt = Carbon::now();

            if (null !== $subscribe) {
                $subscribe->user_id = $user->id;
                $subscribe->starts_at =  $dt;
                $subscribe->ends_at =  $dt->addYear(1);
                $subscribe->plan = session('plan');
                $subscribe->save();
            } else {
                $subscribe = new Subscribe;
                $subscribe->user_id = $user->id;
                $subscribe->starts_at =  $dt;
                $subscribe->ends_at = $dt->addYear(1);
                $subscribe->plan = session('plan');
                $subscribe->save();
            }
        }

        $wallet_balance  = auth()->user()->wallet_balance;
        $total  = (int) optional($wallet_balance)->balance + optional($wallet_balance)->auto_credit;
        return response()->json([
            'wallet_balance' => (int) optional($wallet_balance)->balance,
            'auto_credit' => (int) optional($wallet_balance)->auto_credit,
            'total' => $total
        ]);

        return response($balance, 200);
    }


    protected function getGetCustomColumnNames()
    {
        return [
            "Ref Id",
            "amount",
            "status",
            "date_added",
        ];
    }

    public function unique()
    {
        return [
            'show'  => false,
            'right' => true,
        ];
    }
}

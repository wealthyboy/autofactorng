<?php

namespace App\Http\Controllers\Wallets;

use App\Http\Controllers\Controller;
use App\Models\Wallet;
use App\Utils\AccountSettingsNav;
use Illuminate\Http\Request;
use App\Events\NewBid;
use App\Models\WalletBalance;

class WalletsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nav = (new AccountSettingsNav())->nav();
        $pagination = auth()->user()->wallets()->latest()->paginate(50);

        $collections = $this->getColumnNames($pagination);
        $columns = $this->getGetCustomColumnNames();

        $data = [];



        if (request()->ajax()) {
            return response([
                'collections' => $this->getColumnNames($pagination),
                'pagination' =>  $pagination
            ]);
        }

        return view('wallet.index', compact('nav', 'collections', 'columns', 'pagination'));
    }


    public function walletBalnce()
    {
        $balance  = auth()->user()->wallet_balance;
        return response()->json([
            'balance' => $balance
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
        $wallet = new Wallet;
        $wallet->user_id = $user->id;
        $wallet->amount = $request->amount;
        $wallet->save();
        return response(null, 200);
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

    protected function getColumnNames($collection)
    {
        return [
            'items' => [
                $collection->map(function (Wallet $wallet) {
                    return [
                        "Ref Id" => '#' . optional($wallet)->id,
                        "amount" => '₦' . number_format(optional($wallet)->amount),
                        "status" =>  optional($wallet)->status,
                        "date_added" => $wallet->created_at->format('d-m-y')
                    ];
                })
            ],
            'meta' => [
                'show' => false,
                'right' => 'Balance: 0000',
                'wallet' => true
            ]
        ];
    }
}

<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Models\BrandCategory;
use App\Models\Error;
use App\Models\Order;
use App\Models\OrderedProduct;
use App\Models\Product;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletBalance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;





class HomeController extends Controller
{
    protected $redirectTo = '/admin/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('admin'); 
    }

    public function index(Request $request)
    {


        $top_selling_product = OrderedProduct::select('product_id')
            ->groupBy('product_id')
            ->orderByRaw('COUNT(*) DESC')
            ->whereMonth('created_at', date('m'))
            ->with('product')
            ->first();

        $stats = [];
        $stats['sales'] = 0;
        $stats['Customers'] = (new User())->customers()->count();
        // $stats['top_sells'] = 0;

        return view('admin.index', compact('stats'));
    }

    public function orders()
    {
        return $wallet = array(
            array('id' => '1', 'user_id' => '2604', 'created_at' => '2020-08-04 16:31:04', 'updated_at' => '2020-08-06 21:27:52', 'deleted_at' => NULL, 'amount' => '1900.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '2', 'user_id' => '2604', 'created_at' => '2020-08-04 17:49:35', 'updated_at' => '2020-08-04 17:49:35', 'deleted_at' => NULL, 'amount' => '10000.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '3', 'user_id' => '2604', 'created_at' => '2020-08-04 17:50:08', 'updated_at' => '2020-08-04 17:50:08', 'deleted_at' => NULL, 'amount' => '10000.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '4', 'user_id' => '2604', 'created_at' => '2020-08-05 04:29:07', 'updated_at' => '2020-08-05 04:29:07', 'deleted_at' => NULL, 'amount' => '10000.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '5', 'user_id' => '2605', 'created_at' => '2020-08-05 04:41:01', 'updated_at' => '2020-08-08 21:34:22', 'deleted_at' => NULL, 'amount' => '15000.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '6', 'user_id' => '2604', 'created_at' => '2020-08-05 09:52:09', 'updated_at' => '2020-08-05 09:52:09', 'deleted_at' => NULL, 'amount' => '7000.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '7', 'user_id' => '2604', 'created_at' => '2020-08-05 09:52:45', 'updated_at' => '2020-08-05 09:52:45', 'deleted_at' => NULL, 'amount' => '7000.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '8', 'user_id' => '2604', 'created_at' => '2020-08-05 09:57:17', 'updated_at' => '2020-08-05 09:57:17', 'deleted_at' => NULL, 'amount' => '7000.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '9', 'user_id' => '2604', 'created_at' => '2020-08-05 09:57:42', 'updated_at' => '2020-08-05 09:57:42', 'deleted_at' => NULL, 'amount' => '10000.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '10', 'user_id' => '2604', 'created_at' => '2020-08-05 09:58:45', 'updated_at' => '2020-08-05 09:58:45', 'deleted_at' => NULL, 'amount' => '10000.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '11', 'user_id' => '2604', 'created_at' => '2020-08-05 09:59:52', 'updated_at' => '2020-08-05 09:59:52', 'deleted_at' => NULL, 'amount' => '10000.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '12', 'user_id' => '2603', 'created_at' => '2020-08-06 15:31:24', 'updated_at' => '2020-08-10 22:03:13', 'deleted_at' => NULL, 'amount' => '0.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '14', 'user_id' => '2670', 'created_at' => '2020-10-12 14:07:36', 'updated_at' => '2020-10-12 14:07:36', 'deleted_at' => NULL, 'amount' => '1000.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '15', 'user_id' => '2390', 'created_at' => '2020-10-12 14:37:11', 'updated_at' => '2020-10-12 14:37:11', 'deleted_at' => NULL, 'amount' => '100.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '16', 'user_id' => '2283', 'created_at' => '2020-10-12 18:25:40', 'updated_at' => '2020-10-12 19:30:14', 'deleted_at' => NULL, 'amount' => '24900.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '17', 'user_id' => '2392', 'created_at' => '2020-10-14 10:49:04', 'updated_at' => '2020-10-14 10:49:04', 'deleted_at' => NULL, 'amount' => '100.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '18', 'user_id' => '1373', 'created_at' => '2021-01-27 17:09:52', 'updated_at' => '2023-06-19 03:03:09', 'deleted_at' => NULL, 'amount' => '1000.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '19', 'user_id' => '1299', 'created_at' => '2021-01-27 17:19:04', 'updated_at' => '2021-01-27 17:19:04', 'deleted_at' => NULL, 'amount' => '21000.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '20', 'user_id' => '2705', 'created_at' => '2021-01-28 15:50:44', 'updated_at' => '2021-01-28 15:50:44', 'deleted_at' => NULL, 'amount' => '7000.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '21', 'user_id' => '2812', 'created_at' => '2021-03-25 13:17:56', 'updated_at' => '2021-03-25 13:17:56', 'deleted_at' => NULL, 'amount' => '6500.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '22', 'user_id' => '2817', 'created_at' => '2021-03-25 14:13:22', 'updated_at' => '2021-09-06 17:56:58', 'deleted_at' => NULL, 'amount' => '5.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '23', 'user_id' => '1096', 'created_at' => '2021-05-04 15:26:37', 'updated_at' => '2021-06-15 12:52:41', 'deleted_at' => NULL, 'amount' => '3000.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '24', 'user_id' => '1519', 'created_at' => '2021-07-08 18:35:04', 'updated_at' => '2023-07-07 04:58:51', 'deleted_at' => NULL, 'amount' => '500.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '25', 'user_id' => '312', 'created_at' => '2021-07-16 12:42:33', 'updated_at' => '2021-08-16 10:34:13', 'deleted_at' => NULL, 'amount' => '0.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '26', 'user_id' => '2789', 'created_at' => '2021-08-16 17:27:39', 'updated_at' => '2021-11-11 18:04:43', 'deleted_at' => NULL, 'amount' => '0.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '27', 'user_id' => '303', 'created_at' => '2021-10-06 11:45:52', 'updated_at' => '2021-10-06 11:45:52', 'deleted_at' => NULL, 'amount' => '600.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '28', 'user_id' => '2987', 'created_at' => '2021-11-11 16:56:23', 'updated_at' => '2021-11-15 09:56:03', 'deleted_at' => NULL, 'amount' => '0.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '29', 'user_id' => '2702', 'created_at' => '2021-12-16 13:27:13', 'updated_at' => '2022-07-03 19:57:53', 'deleted_at' => NULL, 'amount' => '600.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '30', 'user_id' => '1686', 'created_at' => '2021-12-17 11:02:14', 'updated_at' => '2023-08-14 15:50:20', 'deleted_at' => NULL, 'amount' => '0.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '31', 'user_id' => '3297', 'created_at' => '2022-01-15 12:39:59', 'updated_at' => '2022-01-17 10:30:15', 'deleted_at' => NULL, 'amount' => '0.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '32', 'user_id' => '1945', 'created_at' => '2022-01-18 15:28:02', 'updated_at' => '2022-04-16 11:51:46', 'deleted_at' => NULL, 'amount' => '0.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '33', 'user_id' => '2747', 'created_at' => '2022-02-02 10:38:05', 'updated_at' => '2022-02-02 10:38:05', 'deleted_at' => NULL, 'amount' => '9000.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '34', 'user_id' => '3376', 'created_at' => '2022-02-16 10:13:38', 'updated_at' => '2022-02-16 17:53:00', 'deleted_at' => NULL, 'amount' => '250.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '35', 'user_id' => '1620', 'created_at' => '2022-03-17 12:47:36', 'updated_at' => '2023-02-06 07:46:59', 'deleted_at' => NULL, 'amount' => '0.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '36', 'user_id' => '3452', 'created_at' => '2022-03-21 13:24:34', 'updated_at' => '2022-03-21 13:24:34', 'deleted_at' => NULL, 'amount' => '2185.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '37', 'user_id' => '2341', 'created_at' => '2022-03-28 14:44:04', 'updated_at' => '2022-08-08 16:51:34', 'deleted_at' => NULL, 'amount' => '0.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '38', 'user_id' => '2804', 'created_at' => '2022-03-31 14:20:59', 'updated_at' => '2022-03-31 16:33:42', 'deleted_at' => NULL, 'amount' => '2500.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '39', 'user_id' => '937', 'created_at' => '2022-04-11 14:45:58', 'updated_at' => '2022-05-31 00:20:37', 'deleted_at' => NULL, 'amount' => '500.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '40', 'user_id' => '2709', 'created_at' => '2022-05-24 18:00:40', 'updated_at' => '2022-05-24 18:00:40', 'deleted_at' => NULL, 'amount' => '750.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '41', 'user_id' => '2993', 'created_at' => '2022-07-15 09:03:58', 'updated_at' => '2022-08-04 11:41:43', 'deleted_at' => NULL, 'amount' => '0.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '42', 'user_id' => '2312', 'created_at' => '2022-09-21 01:53:15', 'updated_at' => '2022-09-21 02:54:54', 'deleted_at' => NULL, 'amount' => '0.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '43', 'user_id' => '3119', 'created_at' => '2022-10-10 09:49:17', 'updated_at' => '2022-10-10 09:49:17', 'deleted_at' => NULL, 'amount' => '6500.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '44', 'user_id' => '2814', 'created_at' => '2022-10-27 16:18:17', 'updated_at' => '2022-10-27 16:18:17', 'deleted_at' => NULL, 'amount' => '800.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '45', 'user_id' => '2493', 'created_at' => '2022-11-04 12:09:58', 'updated_at' => '2022-11-04 12:33:31', 'deleted_at' => NULL, 'amount' => '0.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '46', 'user_id' => '4087', 'created_at' => '2022-11-08 12:38:20', 'updated_at' => '2022-11-08 12:38:20', 'deleted_at' => NULL, 'amount' => '4000.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '47', 'user_id' => '1799', 'created_at' => '2022-11-25 17:18:08', 'updated_at' => '2023-04-25 08:23:38', 'deleted_at' => NULL, 'amount' => '0.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '48', 'user_id' => '4558', 'created_at' => '2023-01-03 10:13:31', 'updated_at' => '2023-01-03 10:13:31', 'deleted_at' => NULL, 'amount' => '700.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '49', 'user_id' => '1055', 'created_at' => '2023-03-07 14:49:27', 'updated_at' => '2023-03-09 09:06:41', 'deleted_at' => NULL, 'amount' => '3900.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '50', 'user_id' => '3028', 'created_at' => '2023-03-16 15:48:42', 'updated_at' => '2023-04-26 14:18:12', 'deleted_at' => NULL, 'amount' => '0.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '51', 'user_id' => '2321', 'created_at' => '2023-04-17 15:11:52', 'updated_at' => '2023-07-31 15:01:24', 'deleted_at' => NULL, 'amount' => '60000.00', 'sent_by' => NULL, 'addition' => '1'),
            array('id' => '52', 'user_id' => '3419', 'created_at' => '2023-05-09 09:44:16', 'updated_at' => '2023-08-04 09:32:29', 'deleted_at' => NULL, 'amount' => '24500.00', 'sent_by' => NULL, 'addition' => '1')
        );
    }
}

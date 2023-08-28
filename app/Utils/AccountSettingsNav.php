<?php

namespace App\Utils;




class AccountSettingsNav
{

    public $data = array();

    public function nav()
    {

        return $nav =  [
            'Address' => [
                'icon' => 'material-symbols-outlined  text-main',
                'iconText' => 'home',
                'link' => '/address'
            ],
            'Account Settings'  => [
                'icon' => 'material-symbols-outlined text-main',
                'iconText' => 'settings',
                'link' => '/account/create'
            ],
            'Change Password' => [
                'icon' => 'material-symbols-outlined text-main',
                'iconText' => 'edit',
                'link' => '/change/password'
            ],
            'Orders' => [
                'icon' => 'material-symbols-outlined text-main',
                'iconText' => 'shopping_bag',
                'link' => '/orders'
            ],
            'Track Order' => [
                'icon' => 'material-symbols-outlined text-main',
                'link' => '/tracking',
                'iconText' => 'show_chart',
            ],

            'Wallet/Auto Credit' => [
                'icon' => 'material-symbols-outlined text-main',
                'iconText' => 'account_balance_wallet',
                'link' => '/wallets'
            ],

        ];

        return array_merge($nav, $this->data);
    }
}

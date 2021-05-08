<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */

    'menu' => [[
		'icon' => '<i class="nav-icon fa fa-home"></i>',
		'title' => 'Dashboard',
		'url' => '/dashboard',
		'id' => 'dashboard'
	],
    [
		'icon' => '<i class="nav-icon fa fa-database"></i>',
		'title' => 'Master',
		'url' => 'javascript:void(0)',
		'id' => 'master',
		'sub_menu' => [[
            'url' => '/master/contract',
            'id' => 'mastercontract',
            'title' => 'Contract'
        ],[
            'url' => '/master/rating',
            'id' => 'masterrating',
            'title' => 'Rating'
        ]]
	],
    [
		'icon' => '<i class="nav-icon fa fa-users"></i>',
		'title' => 'Member',
		'url' => 'javascript:void(0)',
		'id' => 'member',
		'sub_menu' => [[
            'url' => '/member/appkey',
            'id' => 'memberappkey',
            'title' => 'App Key'
        ],[
            'url' => '/member/data',
            'id' => 'memberdata',
            'title' => 'Member Data'
        ],[
            'url' => '/member/registration',
            'id' => 'memberregistration',
            'title' => 'Registration'
        ],[
            'url' => '/member/transaction',
            'id' => 'membertransaction',
            'title' => 'Wallet Member Transaction'
        ]]
    ],
    [
		'icon' => '<i class="nav-icon fa fa-trophy"></i>',
		'title' => 'Reward',
		'url' => 'javascript:void(0)',
		'id' => 'reward',
		'sub_menu' => [[
            'url' => '/reward/achievement',
            'id' => 'rewardachievement',
            'title' => 'Achievement'
        ],[
            'url' => '/reward/daily',
            'id' => 'rewarddaily',
            'title' => 'Daily'
        ]]
    ],
    [
		'icon' => '<i class="nav-icon fa fa-cogs"></i>',
		'title' => 'Setup',
		'url' => 'javascript:void(0)',
		'id' => 'setup',
		'sub_menu' => [[
            'url' => '/setup/rate',
            'id' => 'rate',
            'title' => 'Rate'
        ],[
            'url' => '/setup/user',
            'id' => 'user',
            'title' => 'User'
        ]]
	],
    [
		'icon' => '<i class="nav-icon fa fa-clock"></i>',
		'title' => 'System Transaction',
        'id' => 'transaction',
		'url' => '/transaction'
	],
    [
		'icon' => '<i class="nav-icon fa fa-wallet"></i>',
		'title' => 'Wallet',
        'id' => 'wallet',
		'url' => '/wallet'
	]]
];

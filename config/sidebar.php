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
            'url' => '/master/achievement',
            'id' => 'masterachievement',
            'title' => 'Achievement'
        ]]
	],
    [
		'icon' => '<i class="nav-icon fa fa-users"></i>',
		'title' => 'Member',
		'url' => 'javascript:void(0)',
		'id' => 'member',
		'sub_menu' => [[
            'url' => '/member',
            'id' => 'memberdata',
            'title' => 'Member Data'
        ],[
            'url' => '/member/registration',
            'id' => 'memberregistration',
            'title' => 'Registration'
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
            'url' => '/setup/harilibur',
            'id' => 'harilibur',
            'title' => 'Hari Libur'
        ],[
            'url' => '/setup/pengguna',
            'id' => 'pengguna',
            'title' => 'Pengguna'
        ],[
            'url' => '/setup/rate',
            'id' => 'rate',
            'title' => 'Rate'
        ]]
	],
    [
		'icon' => '<img src="/images/favicon.ico" class="ml-10" style="margin-left: 13px; margin-right: 5px; height: 25px">',
		'title' => 'Wallet',
		'url' => '/wallet'
	]]
];

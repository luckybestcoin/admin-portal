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
	],[
		'icon' => '<i class="nav-icon fa fa-database"></i>',
		'title' => 'Data Master',
		'url' => 'javascript:void(0)',
		'id' => 'datamaster',
		'sub_menu' => [[
            'url' => '/datamaster/paket',
            'id' => 'datamasterpaket',
            'title' => 'Paket'
        ],[
            'url' => '/datamaster/peringkat',
            'id' => 'datamasterperingkat',
            'title' => 'Peringkat'
        ]]
	],[
		'icon' => 'fa fa-users',
		'title' => 'Member',
		'url' => 'javascript:void(0)',
		'id' => 'member',
		'sub_menu' => [[
            'url' => '/member/registrasi',
            'id' => 'registrasi',
            'title' => 'Registrasi'
        ],[
            'url' => '/member/data',
            'id' => 'datamember',
            'title' => 'Data Member'
        ]]
	],[
		'icon' => 'fa fa-cogs',
		'title' => 'Setup',
		'url' => 'javascript:void(0)',
		'id' => 'setup',
		'sub_menu' => [[
            'url' => '/setup/harilibur',
            'id' => 'harilibur',
            'title' => 'Hari Libur'
        ],[
            'url' => '/setup/kurs',
            'id' => 'kurs',
            'title' => 'Kurs'
        ],[
            'url' => '/setup/pengguna',
            'id' => 'pengguna',
            'title' => 'Pengguna'
        ]]
	]]
];

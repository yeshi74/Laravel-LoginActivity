<?php

namespace App\Http\Controllers\Admin;

use App\User;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController
{
    public function index()
    {

        $list_blocks = [
            [
                'title' => 'Login Activity Table',
                'entries' => User::orderBy('last_login_at', 'desc')
                    ->take(5)
                    ->get(),
            ],
        ];

        return view('home', compact('list_blocks'));
    }
}

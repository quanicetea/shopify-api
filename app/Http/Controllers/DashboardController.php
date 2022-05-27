<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstallRequest;

class DashboardController extends Controller
{
    public function index(InstallRequest $reuqest)
    {
        // $code = '098d3779e78029da2816dd346e33e726';
        dd($reuqest->all());
        $code = $reuqest->getCode();
        $shop = $reuqest->getShop();
        // $token = $this->
        return view('welcome');
    }
}

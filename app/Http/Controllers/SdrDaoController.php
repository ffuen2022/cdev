<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SdrDaoController extends Controller
{
    public function index()
    {
        return view('content.pages.pages-sdr-livewire');
    }
}

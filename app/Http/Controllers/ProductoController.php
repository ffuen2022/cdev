<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
   
    public function index()
    {
        return view('content.pages.pages-producto-livewire');
    }

}

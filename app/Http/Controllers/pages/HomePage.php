<?php

namespace App\Http\Controllers\pages;

use App\Models\User;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\DB;

class HomePage extends Controller
{
  public function index()
  {
    $user = Auth::user();
    $roleExist = DB::table('model_has_roles')->where('model_id',$user->id)->first();
    
    if(!$roleExist){

      DB::table('model_has_roles')->insert([
        'role_id' => 2,
        'model_type' => 'App\Models\User',
        'model_id' => $user->id
        ]);
    }
    
    return view('content.pages.pages-home');
  }
}

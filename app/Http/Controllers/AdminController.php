<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Services\AdminService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{

  public $admin_service;
  public $user_service;

  public function __construct(AdminService $admin_service, UserService $user_service) 
  {
    $this->admin_service = $admin_service;
    $this->user_service = $user_service;
  }

  
}
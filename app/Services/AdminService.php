<?php 

namespace App\Services;

use App\Repositories\AdminRepository;
use Illuminate\Support\Facades\Auth;

class AdminService {

  public $admin_repository;

  public function __construct(AdminRepository $admin_repository)
  {
    $this->admin_repository = $admin_repository;
  }

}

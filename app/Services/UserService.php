<?php 

namespace App\Services;

use App\Repositories\UserRepository;
class UserService {

  public $user_repository;

  public function __construct(UserRepository $user_repository)
  {
    $this->user_repository = $user_repository;
  }
}
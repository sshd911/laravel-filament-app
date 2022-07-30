<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Blog;
use App\Models\Comment;

class AdminRepository {

  public $user;
  public $blog;
  public $comment;

  public function __construct(User $user, Blog $blog, Comment $comment) 
  {
    $this->user = $user;
    $this->blog = $blog;
    $this->comment = $comment;
  }
}
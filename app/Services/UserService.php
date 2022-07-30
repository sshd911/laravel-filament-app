<?php 

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class UserService {

  public $user_repository;

  public function __construct(UserRepository $user_repository)
  {
    $this->user_repository = $user_repository;
  }

  public function getUserAttributes() {
    $user_id = Auth::id();
    $email = $this->user_repository->getUserEmail($user_id);
    return $email;
  }

  public function getBlogs($email) {
    $blogs = $this->user_repository->getBlogs($email);
    return $blogs;
  }

  public function updateBlog($id, $blog, $body) {
    $this->user_repository->updateBlog($id, $blog, $body);
  }

  public function deleteBlog($blog_id) {
    $this->user_repository->deleteBlog($blog_id);
  }

  public function createBlog($count, $email, $name, $blog, $body, $open) {
    $this->user_repository->createBlog($count, $email, $name, $blog, $body, $open);
  }

  public function restoreBlog($blog_id) {
    $this->user_repository->restoreBlog($blog_id);
  }

  public function destoryBlog($blog_id) {
    $this->user_repository->destoryBlog($blog_id);
  }

  public function changeOpen($id, $open) {
    $this->user_repository->changeOpen($id, $open);
  }

  public function getOthers($email) {
    $this->user_repository->getOthers($email);
  }
  public function getThisBlog($blog_id) {
    return $this->user_repository->getThisBlog($blog_id);
  }

  public function getArchives($email) {
    return $this->user_repository->getArchives($email);
  }

  public function getComments($user_id) {
    $this->user_repository->getComments($user_id);
  }

  public function postUser($user_id) {
    return $this->user_repository->postUser($user_id);
  }
  public function postComment($blog_id, $comment, $email, $name) {
    $this->user_repository->postComment($blog_id, $comment, $email, $name);
  }

  public function unsubscribe($user_id) {
    $this->user_repository->unsubscribe($user_id);
  }
}
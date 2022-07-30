<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Blog;
use App\Models\Comment;
class UserRepository {

  public $user;
  public $blog;
  public $comment;

  public function __construct(User $user, Blog $blog, Comment $comment) 
  {
    $this->user = $user;
    $this->blog = $blog;
    $this->comment = $comment;
  }

  public function getUserEmail($user_id) {
    return User::where('id', '=', $user_id)->pluck('email')[0];
  }

  public function getBlogs($email) {
    return Blog::where('users.email', '=', $email)
      ->where('blogs.user_email', '=',  $email)
      ->crossJoin('users') 
      ->whereNull('blogs.deleted_at')->get();
  }

  public function updateBlog($id, $blog, $body) {
    return Blog::where('id', '=', $id)
      ->update([
        'blog' => $blog, 
        'body' => $body
      ]);
  }

  public function deleteBlog($blog_id) {
    Blog::find($blog_id)->delete();
  }

  public function createBlog($count, $email, $name, $blog, $body, $open) {
    Blog::insert([
      'id'         => $count,
      'user_email' => $email,
      'user_name'  => $name, 
      'blog' => $blog,
      'body' => $body,
      'open' => $open,
    ]);
  }

  public function restoreBlog($blog_id) {
    Blog::where('id', '=', $blog_id)
      ->update(['deleted_at' => null]);
  }

  public function destoryBlog($user_id) {
    Blog::where('id', '=', $user_id)->forceDelete();
  }

  public function changeOpen($id, $open) {
    Blog::where('id', '=', $id)->update(['open' => $open]);
  }

  public function getOthers($email) {
    return Blog::select('blogs.*')
    ->where('users.email', '<>', $email)
    ->where('blogs.user_email', '<>', $email)
    ->where('blogs.open', '=', true)
    ->distinct()
    ->whereNull('blogs.deleted_at')
    ->crossJoin('users')->get();
  }

  public function getThisBlog($blog_id) {
    return Blog::where('id', '=', $blog_id)->get();
  }

  public function getArchives($email) {
    return Blog::select('blogs.*')
    ->where('users.email', '=', $email)
    ->where('blogs.user_email', '=', $email)
    ->crossJoin('users') 
    ->whereNotNull('blogs.deleted_at')->get();
  }

  public function getComments($blog_id) {
    Comment::where('blog_id', '=', $blog_id)->get();
  }

  public function postUser($user_id) {
    return User::where('id', '=', $user_id)->get();
  }

  public function postComment($blog_id, $comment, $email, $name) {
    Comment::insert([
      'blog_id'    => $blog_id,
      'comment'    => $comment,
      'user_email' => $email,
      'user_name'  => $name,
    ]);
  }

  public function unsubscribe($user_id) {
    User::find($user_id)->delete();
  }
}
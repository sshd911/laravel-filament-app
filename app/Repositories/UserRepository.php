<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

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

  public function getUserName($user_id) {
    return User::where('id', '=', $user_id)->pluck('name')[0];
  }

  public function getBlogs($user_id) {
    return Blog::where('user_id', '=', $user_id)
      ->whereNull('deleted_at')->get()->toArray();
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

  public function createBlog($count, $email, $name, $blog, $body) {
    Blog::insert([
      'id' => $count,
      'user_id' => Auth::id(),
      'user_email' => $email,
      'user_name'  => $name, 
      'blog' => $blog,
      'body' => $body,
      'open' => true,
    ]);
  }

  public function restoreBlog($blog_id) {
    Blog::where('user_id', '=', Auth::id())
      ->where('id', '=', $blog_id)->restore();
  }

  public function destoryBlog($user_id) {
    Blog::where('id', '=', $user_id)->forceDelete();
  }

  public function changeOpen($id, $open) {
    Blog::where('id', '=', $id)->update(['open' => $open]);
  }

  public function getOthers($user_id) {
    return Blog::where('user_email', '<>', $user_id)
    ->where('open', '=', true)
    ->whereNull('deleted_at')->get();
  }

  public function getThisBlog($blog_id) {
    return Blog::where('id', '=', $blog_id)->get();
  }

  public function getArchives($user_id) {
    return Blog::onlyTrashed()->where('user_id', '=', $user_id)->get()->toArray();
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
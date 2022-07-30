<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public $user_service;

    public function __construct(UserService $user_service)
    {
        $this->user_service = $user_service;
    }

    public function index()
    {
        $blogs = $this->user_service->getBlogs();
        $others = $this->others();
        $archives = $this->archive();

        return view('users.index', compact('blogs', 'others', 'archives'));
    }

    public function edit($blog_id)
    {
        $blog = $this->user_service->getThisBlog($blog_id)->toArray()[0];
        return view('users.blogs.edit', compact('blog'));
    }

    public function update(Request $request)
    {
        $blog = $request->blog ? $request->blog : '未定';
        $body = $request->body ? $request->body : '未定';
        $this->user_service->updateBlog($request->id, $blog, $body);
        return redirect('users/index');
    }

    public function delete($blog_id) // 論理削除
    {
        $this->user_service->deleteBlog($blog_id);
        return redirect('users/index');
    }

    public function create(Request $request) // 新規作成
    {
        $blog = $request->blog ?? '未定';
        $body = $request->body ?? '未定';
        $email = $this->user_service->getUserEmail();
        $name = $this->user_service->getUserName();
        $count = DB::table('blogs')->max('id')+1 ?? 1;
        $this->user_service->createBlog(Auth::id(), $count, $email, $name, $blog, $body);
        return redirect('users/index');
    }

    public function archive()
    {
        $archives = $this->user_service->getArchives(Auth::id());
        return $archives;
    }

    public function restore($blog_id)
    { 
        $this->user_service->restoreBlog(Auth::id(), $blog_id);
        return redirect('users/index');
    }

    public function destory(Request $request) // 物理削除
    {
        $this->user_service->destoryBlog($request->id);
        return redirect('users/index');
    }

    public function open()
    {
        $blogs = $this->user_service->getBlogs(Auth::id());
        return view('users.blogs.open', compact('blogs'));
    }

    public function change($id, $open)
    {
        $open = $open === '非公開' ? true : false;
        $this->user_service->changeOpen($id, $open);
        $blogs = $this->user_service->getBlogs();
        return view('users.blogs.open', compact('blogs'));
    }

    public function others()
    {
        return $this->user_service->getOthers(Auth::id());
    }

    public function comment(Request $request)
    {
        $blogs = $this->user_service->getThisBlog($request->id);
        $comments = $this->user_service->getComments($request->id);
        return view('users.blogs.comment', compact('blogs', 'comments'));
    }

    public function post(Request $request)
    {
        $user_email = $this->user_service->getUserEmail();
        $user_name = $this->user_service->getUserName();
        $this->user_service->postComment($request->id, $request->comment, $user_email, $user_name);
        $blogs = $this->user_service->getThisBlog($request->id);
        $comments = $this->user_service->getComments($request->id);
        return view('users.blogs.comment', compact('blogs', 'comments'));
    }

    public function unsubscribe()
    {
        $this->user_service->unsubscribe(Auth::id());
        return view('welcome');
    }
}
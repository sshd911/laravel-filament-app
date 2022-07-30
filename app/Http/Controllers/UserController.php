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
        $email = $this->user_service->getUserAttributes();
        $blogs = $this->user_service->getBlogs($email);
        $others = $this->others();
        $archives = $this->archive();
        // dd($archives);
        return view('users.index', compact('blogs', 'others', 'archives'));
    }

    public function edit(int $id, string $blog, string $body)
    {
        return view('users.blogs.edit', ['id' => $id, 'blog' => $blog, 'body' => $body]);
    }

    public function update(Request $request)
    {
        $blog = $request->blog ? $request->blog : '未定';
        $body = $request->body ? $request->body : '未定';
        $this->user_service->updateBlog($request->id, $blog, $body);

        return view('users.index');
    }

    public function delete(Request $request) // 論理削除
    {
        $this->user_service->deleteBlog($request->id);
        return view('users.index');
    }

    public function create(Request $request) // 新規作成
    {
        $blog = $request->blog ? $request->blog : '未定';
        $body = $request->body ? $request->body : '未定';
        $open = true;

        $email = $this->user_service->getUserAttributes();
        $blogs = $this->user_service->getBlogs($email);

        $email = $blogs->pluck('email')[0];
        $name  = $blogs->pluck('name')[0];
        // $count = $blogs->max('id')+1;
        $count = DB::table('blogs')->max('id')+1;

        $this->user_service->createBlog($count, $email, $name, $blog, $body, $open);

        $blogs = $this->user_service->getBlogs($email);
        $datalist = UserController::archive();

        return view('users.index', compact('blogs', 'datalist'));
    }

    public function archive()
    {
        $email = $this->user_service->getUserAttributes();
        $archives = $this->user_service->getArchives($email);
        return $archives;
        // return view('users.blogs.index', compact('datalist'));
    }

    public function restore(Request $request)
    { 
        $this->user_service->restoreBlog($request->id);
        return view('users.index');
    }

    public function destory(Request $request) // 物理削除
    {
        $this->user_service->destoryBlog($request->id);
        return view('users.index');
    }

    public function open()
    {
        $user_id = Auth::id();
        $email = $this->user_service->getUserAttributes();
        $blogs = $this->user_service->getBlogs($email);

        return view('users.blogs.open', compact('blogs'));
    }

    public function change($id, $open)
    {
        $user_id = Auth::id();
        $open = $open === '非公開' ? true : false;

        $this->user_service->changeOpen($id, $open);
        $email = $this->user_service->getUserAttributes();
        $blogs = $this->user_service->getBlogs($email);

        return view('users.blogs.open', compact('blogs'));
    }

    public function others()
    {
        $email = $this->user_service->getUserAttributes();
        $others = $this->user_service->getOthers($email);
        return $others;
    // return view('users.blogs.others', compact('others'));
    }

    public function comment(Request $request)
    {
        $blogs = $this->user_service->getThisBlog($request->id);
        $comments = $this->user_service->getComments($request->id);
        return view('users.blogs.comment', compact('blogs', 'comments'));
    }

    public function post(Request $request)
    {
        $user_id = Auth::id();
        $user = $this->user_service->postuser($user_id);
        $user_email = $user->pluck('email')[0] ;
        $user_name  = $user->pluck('name')[0];
        $this->user_service->postComment($request->id, $request->comment, $user_email, $user_name);
        $blogs = $this->user_service->getThisBlog($request->id);
        $comments = $this->user_service->getComments($request->id);

        return view('users.blogs.comment', compact('blogs', 'comments'));
    }

    public function warning()
    {
        return view('users.blogs.warning');
    }

    public function unsubscribe()
    {
        $user_id = Auth::id();
        $this->user_service->unsubscribe($user_id);
        return view('users.index');
    }
}
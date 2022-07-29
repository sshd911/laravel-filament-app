<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class blogController extends Controller
{
    use SoftDeletes;

    public function index()
    {
        $user_id    = Auth::id(); 
        // 今のユーザのメアドを取得
        $user_email = DB::table('users')
            ->select('email')
            ->where('id', '=', $user_id)
            ->get()->pluck('email')[0];

        $blogs = DB::table('blogs') 
            ->select('blogs.*')
            ->where('users.email', '=', $user_email)
            ->where('blogs.user_email', '=',  $user_email)
            ->crossJoin('users') 
            ->whereNull('blogs.deleted_at')
            ->paginate(10); 

        return view('dashboard', compact('blogs'));
    }

    public function edit(int $id, string $blog, string $body)
    {
        return view('users.blogs.edit', ['id' => $id, 'blog' => $blog, 'body' => $body]);
    }

    public function update(Request $request)
    {
        $id   = (int)    $request->id;
        $blog = (string) $request->blog ? $request->blog : '未定';
        $body = (string) $request->body ? $request->body : '未定';
        
        DB::table('blogs')
            ->where('id', '=', $id)
            ->update([
            'blog' => $blog,
            'body' => $body,
            ]);

        return redirect('dashboard');
    }

    public function delete(Request $request)
    {
        // 論理削除
        $id = (int) $request->id;
        $data = Blog::find($id);
        $data->delete();
        
        return redirect('dashboard');
    }

    public function create()
    {
        return view('users.blogs.create');
    }

    public function upgrade(Request $request) // 新規作成
    {
        $blog = (string)    $request->blog  ? $request->blog     : '未定';
        $body = (string)    $request->body ? $request->body : '未定';
        $open = (bool) true;

        $user_id    = Auth::id(); 
        // ユーザのテーブル情報取得
        $user_info = DB::table('users')
            ->select('*')
            ->where('id', '=', $user_id)
            ->get();

        $user_email = $user_info->pluck('email')[0];
        $user_name  = $user_info->pluck('name')[0];
        $count = DB::table('blogs')->max('id');
        $count++;

        DB::table('blogs')
            ->insert([
            'id'         => $count,
            'user_email' => $user_email,
            'user_name'  => $user_name, 
            'blog' => $blog,
            'body' => $body,
            'open' => $open,
        ]);

        return redirect('dashboard');
    }

    public function archive()
    {
        $user_id    = Auth::id(); 
        // 今のユーザのメアドを取得
        $user_email = DB::table('users')
            ->select('email')
            ->where('id', '=', $user_id)
            ->get()->pluck('email')[0];

        $datalist = DB::table('blogs') 
            ->select('blogs.*')
            ->where('users.email', '=', $user_email)
            ->where('blogs.user_email', '=', $user_email)
            ->crossJoin('users') 
            ->whereNotNull('blogs.deleted_at')
            ->paginate(10); 

        return view('users.blogs.archive', compact('datalist'));
    }

    public function restore(Request $request)
    { 
        // リストア処理
        $id = $request->id;

        DB::table('blogs')
            ->where('id', '=', $id)
            ->update([
                'deleted_at' => null,
            ]);

        return redirect('/archive');
    }
    public function destory(Request $request)
    {
        // 物理削除
        $id =  $request->id;

        Blog::select('*')
        ->where('id', '=', $id)
        ->forceDelete();

        return redirect('/archive');
    }

    public function open()
    {
        $user_id    = Auth::id(); 
        // 今のユーザのメアドを取得
        $user_email = DB::table('users')
            ->select('email')
            ->where('id', '=', $user_id)
            ->get()->pluck('email')[0];

        $blogs = DB::table('blogs') 
            ->select('blogs.*')
            ->where('users.email', '=', $user_email)
            ->where('blogs.user_email', '=', $user_email)
            ->crossJoin('users') 
            ->whereNull('blogs.deleted_at')
            ->paginate(10); 

        return view('users.blogs.open', compact('blogs'));
    }
    
    public function change(int $id, string $open)
    {
        $open = $open === '非公開' ? true : false;

        DB::table('blogs')
            ->where('id', '=', $id)
            ->update([
                'open' => $open,
            ]);

        $user_id    = Auth::id(); 
        // 今のユーザのメアドを取得
        $user_email = DB::table('users')
            ->select('email')
            ->where('id', '=', $user_id)
            ->get()->pluck('email')[0];

        $blogs = DB::table('blogs') 
            ->select('blogs.*')
            ->where('users.email', '=', $user_email)
            ->where('blogs.user_email', '=', $user_email)
            ->crossJoin('users') 
            ->whereNull('blogs.deleted_at')
            ->paginate(10); 

        return view('users.blogs.open', compact('blogs'));
    }
    public function others()
    {
        $user_id    = Auth::id(); 
        // 今のユーザのメアドを取得
        $user_email = DB::table('users')
            ->select('email')
            ->where('id', '=', $user_id)
            ->get()->pluck('email')[0];

        $blogs = DB::table('blogs') 
            ->select('blogs.*')
            ->where('users.email', '<>', $user_email)
            ->where('blogs.user_email', '<>', $user_email)
            ->where('blogs.open', '=', true)
            ->distinct()
            ->whereNull('blogs.deleted_at')
            ->crossJoin('users') 
            ->paginate(10); 

    return view('users.blogs.others', compact('blogs'));
    }

    public function comment(Request $request)
    {
        $blogs = DB::table('blogs')
            ->select('*')
            ->where('id', '=', $request->id)
            ->get();

        $comments = DB::table('comments')
            ->select('*')
            ->where('blog_id', '=', $request->id)
            ->get();

        return view('users.blogs.comment', compact('blogs', 'comments'));
    }

    public function post(Request $request)
    {
        $user_id    = Auth::id(); 
        // 今のユーザのメアドを取得
        $user_info = DB::table('users')
            ->select('*')
            ->where('id', '=', $user_id)
            ->get();

        $user_email = $user_info->pluck('email')[0] ;
        $user_name  = $user_info->pluck('name')[0];

        DB::table('comments')->insert([
            'blog_id'    => $request->id,
            'comment'    => $request->comment,
            'user_email' => $user_email,
            'user_name'  => $user_name,
        ]);

        $blogs = DB::table('blogs')
            ->select('*')
            ->where('id', '=', $request->id)
            ->get();

        $comments = DB::table('comments')
            ->select('*')
            ->where('blog_id', '=', $request->id)
            ->get();

        return view('users.blogs.comment', compact('blogs', 'comments'));
    }

    public function warning()
    {
        return view('users.blogs.warning');
    }

    public function unsubscribe()
    {
        $user_id = Auth::id();
        $data    = User::find($user_id);
        $data->delete();
        
        return redirect('/');
    }
}
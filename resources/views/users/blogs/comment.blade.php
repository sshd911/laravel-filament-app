<x-app-layout>
    <x-slot name="header">
</x-slot> 
<div class="wrapper">
    <table class="table table-striped table-hover table-bordered text-center">
        <thead>
            <tr>
                <th scope="col">作成者</th>
                <th scope="col">タイトル</th>
                <th scope="col">本文</th>
            </tr>
        </thead>
        <tbody>
          @foreach($blogs as $blog)
          <tr>
            <td>{{ $blog->user_name }}</td>
            <td>{{ $blog->blog }}</td>
            <td>{{ $blog->body }}</td>
          </tr>
        </tbody>
      </table>
    </div>
<hr>
    <form method="GET" action="{{ route('users.blogs.post') }}">
        @method('GET')
        <table class="table table-striped table-hover table-bordered text-center">
          <thead>
            <tr>
                <th scope="col">コメント内容</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
          <input type="hidden" name='id' id='id' value="{{ $blog->id }}" required>
          <input type="hidden" id="blog_id" name="blog_id" required>  
          {{-- <input type="hidden" id='user_name' name='user_name' required> --}}
          {{-- <input type="hidden" id="user_email" name="user_email" value="{{ $blog->user_email }}" required>  --}}
          <td><input type="textarea" size="100" id="comment" name="comment" placeholder="コメントを入力" required></td>
          <td><button type="submit" class="text-white  bg-gray-400 border-0 py-2 px-4 focus:outline-none hover:bg-gray-500 rounded">送信</button></td>
        </tbody>
        </table>
      </form>
      @endforeach
      <hr>
        <table class="table table-striped table-hover table-bordered text-center">
            <thead>
                <tr>
                    <th scope="col">投稿者</th>
                    <th scope="col">コメント一覧</th>
                </tr>
            </thead>
            <tbody>
      @foreach ($comments as $comment)
      <tr>
        {{-- <td>{{ $blog->$name }}</td> --}}
        <td>{{ $comment->user_name }}</td>
        <td>{{ $comment->comment }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</x-app-layout>

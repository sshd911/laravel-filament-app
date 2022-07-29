<div class="wrapper">
  <table class="table table-striped table-hover table-bordered text-center">
    <thead>
      <tr>
        <th scope="col">タイトル</th>
        <th scope="col">本文</th>
        <th scope="col"></th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($blogs as $blog)
      <tr>
          <td>{{ $blog->blog }}</td>
          <td>{{ $blog->body }}</td>
          @php $blog->open = $blog->open ? true : '非公開' @endphp
          <td><button onclick="location.href='{{ route('users.blogs.edit',  ['id' => $blog->id, 'blog' => $blog->blog, 'body' => $blog->body, 'open' => $blog->open]) }}'" class="text-white bg-blue-400 border-0 py-2 px-4 focus:outline-none hover:bg-blue-500 rounded">編集</button></td>
          @if ($blog->blog)
          <td><button onclick="location.href='{{ route('users.blogs.delete', ['id' => $blog->id]) }}'" class="text-white bg-red-400 border-0 py-2 px-4 focus:outline-none hover:bg-red-500 rounded ">論理削除</button></td> 
          @else
          <td><button>vefrvewe</button></td>
          @endif
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@if($others)
    <div class="wrapper">
        <table class="table table-striped table-hover table-bordered text-center">
            <thead>
            <tr>
                <th scope="col">作成者</th>
                <th scope="col">タイトル</th>
                <th scope="col">本文</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
                @foreach ($others as $other)
                    <tr>
                        <td>{{ $other->user_name }}</td>
                        <td>{{ $other->blog }}</td>
                        <td>{{ $other->body }}</td>
                        <td><button onclick="location.href='{{ route('users.blogs.comment', ['id' => $other->id]) }}'" class="text-white bg-blue-400 border-0 py-2 px-4 focus:outline-none hover:bg-blue-500 rounded">コメント</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
<div class="text-gray-600 body-font pt-20">
    <div class="container px-5 py-24 mx-auto">
      <div class="xl:w-1/2 lg:w-3/4 w-full mx-auto text-center bg-gray-300 rounded">
        <div>他のユーザーの投稿はまだありません。</div>
      </div>
    </div>
</div>
@endif
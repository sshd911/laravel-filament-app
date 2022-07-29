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
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($blogs as $blog)
            <tr>
                <td>{{ $blog->user_name }}</td>
                <td>{{ $blog->blog }}</td>
                <td>{{ $blog->body }}</td>
                <td><button onclick="location.href='{{ route('users.blogs.comment', ['id' => $blog->id]) }}'" class="text-white bg-blue-400 border-0 py-2 px-4 focus:outline-none hover:bg-blue-500 rounded">コメント</button></td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $blogs->links('vendor/pagination/bootstrap-4') }}
</div>
</x-app-layout>
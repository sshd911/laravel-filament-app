<x-head-start/>
<x-app-layout>
    <x-slot name="header">
</x-slot> 
<div class="wrapper">
    <table class="table table-striped table-hover table-bordered text-center">
        <thead>
        <tr>
            <th scope="col">タイトル</th>
            <th scope="col">本文</th>
            {{-- <th scope="col">最終更新</th> --}}
            <th scope="col">公開設定</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($blogs as $blog)
            <tr>
                <td>{{ $blog->blog }}</td>
                <td>{{ $blog->body }}</td>
                {{-- <td>{{ $blog->updated_at }}</td> --}}
                <td><?= $blog->open ? '公開' : '非公開' ?></td> 
                <?php $blog->open = $blog->open ? true : '非公開' ?>
                <td><button onclick="location.href='{{ route('users.blogs.change',  ['id' => $blog->id, 'open' => $blog->open]) }}'" class="text-white bg-blue-400 border-0 py-2 px-4 focus:outline-none hover:bg-blue-500 rounded">変更</button></td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $blogs->links('vendor/pagination/bootstrap-4') }}
</div>
</x-app-layout>
<x-head-end/>
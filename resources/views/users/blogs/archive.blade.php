@if($archives)
<div class="wrapper">
    <table class="table table-striped table-hover table-bordered text-center">
            <thead>
                <tr>
                    <th scope="col">タイトル</th>
                    <th scope="col">本文</th>
                    <th scope="col">削除日</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($archives as $archive)
            <tr>
                <td>{{ $archive['blog'] }}</td>
                <td>{{ $archive['body'] }}</td>
                <td>{{ $archive['deleted_at'] }}</td>
                <form method="GET" action="{{ route('users.blogs.destory') }}">
                @method('GET')
                    <td><button name="id" type="submit" value="{{ $archive['id'] }}" class="text-white bg-red-400 border-0 py-2 px-4 focus:outline-none hover:bg-red-500 rounded">物理削除</button></td>
                </form>
                <td><button onclick="location.href='{{ route('users.blogs.restore', [ 'blog_id' => $archive['id'] ]) }}'" class="text-white bg-blue-400 border-0 py-2 px-4 focus:outline-none hover:bg-blue-500 rounded">復元</button></td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="text-gray-600 body-font pt-20">
        <div class="container px-5 py-24 mx-auto">
        <div class="xl:w-1/2 lg:w-3/4 w-full mx-auto text-center bg-gray-300 rounded">
            <div>まずはTODOを作成しましょう。</div>
        </div>
        </div>
    </div>
@endif
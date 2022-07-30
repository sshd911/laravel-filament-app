@if($blogs)
    <div class="wrapper">
        <table class="table table-striped table-hover table-bordered text-center">
            <thead>
            <tr>
                <th scope="col">タイトル</th>
                <th scope="col">本文</th>
                <th scope="col">公開設定</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($blogs as $blog)
                <tr>
                    <td>{{ $blog['blog'] }}</td>
                    <td>{{ $blog['body'] }}</td>
                    <td>@php $blog['open'] ? '公開' : '非公開' @endphp</td> 
                    @php $blog['open'] = $blog['open'] ? true : '非公開' @endphp
                    <td><button onclick="location.href='{{ route('users.blogs.change',  [ 'id' => $blog['id'], 'open' => $blog['open'] ]) }}'" class="text-white bg-blue-400 border-0 py-2 px-4 focus:outline-none hover:bg-blue-500 rounded">変更</button></td>
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
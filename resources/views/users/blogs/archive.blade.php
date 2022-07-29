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
                            <th scope="col">論理削除日</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($datalist as $data)
                    <tr>
                        <td>{{ $data->blog }}</td>
                        <td>{{ $data->body }}</td>
                        {{-- <td>{{ $data->updated_at }}</td> --}}
                        <td>{{ $data->deleted_at}}</td>
                        <form method="GET" action="{{ route('users.blogs.destory') }}">
                        @method('GET')
                            <td><button name="id" type="submit" value="{{ $data->id }}" class="text-white bg-red-400 border-0 py-2 px-4 focus:outline-none hover:bg-red-500 rounded">物理削除</button></td>
                        </form>
                        <td><button onclick="location.href='{{ route('users.blogs.restore', ['id' => $data->id]) }}'" class="text-white bg-blue-400 border-0 py-2 px-4 focus:outline-none hover:bg-blue-500 rounded">復元</button></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </x-app-layout>
<x-head-end/>
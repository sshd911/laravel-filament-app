@if ($blogs)
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
          <td>{{ $blog['blog'] }}</td>
          <td>{{ $blog['body'] }}</td>
          @php $blog['open'] = $blog['open'] ? true : '非公開' @endphp
          <form method="POST" action="{{ route('users.blogs.edit')}}">
            @method('POST')
            @csrf
            <input hidden type="number" value="{{ $blog['id'] }}">
            <input hidden type="text" value="{{ $blog['blog'] }}">
            <input hidden type="text" value="{{ $blog['body'] }}">
            <input hidden hidden type="boolean" value="{{ $blog['open'] }}">
            <td><button type="submit" class="text-white bg-blue-400 border-0 py-2 px-4 focus:outline-none hover:bg-blue-500 rounded">編集</button></td>
          </form>
          <td><button type="number" onclick="location.href='{{ route('users.blogs.delete', $blog['id']) }}'" class="text-white bg-red-400 border-0 py-2 px-4 focus:outline-none hover:bg-red-500 rounded ">論理削除</button></td> 
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@else
  <div class="text-gray-600 body-font pt-20">
    <div class="container px-5 py-24 mx-auto">
      <div class="xl:w-1/2 lg:w-3/4 w-full mx-auto text-center bg-gray-300 rounded">
        <div>新しいTODOを作成しましょう</div>
      </div>
    </div>
  </div>
@endif
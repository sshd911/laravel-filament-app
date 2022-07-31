@if($blogs)

    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
              <table class="min-w-full">
                <thead class="border-b">
                  <tr class="m-4">
                      <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">タイトル</th>
                      <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">本文</th>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">公開設定</th>
                    <th scope="col" class="text-sm font-medium text-gray-900 py-4 text-left"></th>
                  </tr>
                </thead>
                <tbody>
            @foreach ($blogs as $blog)
                  <tr class="bg-white border-b" class="hover:bg-gray-700">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $blog['blog'] }}</td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $blog['body'] }}</td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">@php echo $blog['open'] ? '公開' : '非公開' @endphp</td>
                    <td class="text-sm text-gray-900 font-light py-4 whitespace-nowrap"<button onclick="location.href='{{ route('users.blogs.change',  [ 'id' => $blog['id'], 'open' => $blog['open'] ]) }}'">変更</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
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
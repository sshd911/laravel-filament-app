<div class="flex flex-col">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <table class="min-w-full">
                    <thead class="border-b">
                        <tr class="m-4">
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">タイトル</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">本文</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 py-4 text-left"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <form method="POST" action="{{ route('users.blogs.create') }}">
                            @method('POST')
                            @csrf
                            <tr class="bg-white border-b" class="hover:bg-gray-700">
                                <input type="hidden" name='open' value="true" required>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><input type="text" name='blog' required></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><input type="text" name='body' required></td>
                                <td class="text-sm text-gray-900 font-light py-4 whitespace-nowrap"><button type="submit">新規作成</button></td>
                            </tr>
                        </form>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
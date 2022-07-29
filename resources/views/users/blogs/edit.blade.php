<div class="wrapper">
    <table class="table table-striped table-hover table-bordered text-center">
        <thead>
            <tr>
                <th scope="col">タイトル</th>
                <th scope="col">本文</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <form method="GET" action="{{ route('users.blogs.update') }}">
                @method('GET')
                <tr>
                    <input type="hidden" name='id' value="{{ $id }}" required>
                    <td><input type="text" name='blog' value="{{ $blog }}" required class="px-4 py-2"></td>
                    <td><input type="text" name='body' value="{{ $body }}" required class="px-4 py-2"></td>
                    <td><button type="submit" class="text-white  bg-blue-400 border-0 py-2 px-4 focus:outline-none hover:bg-blue-500 rounded">保存</button></td>
                </tr>
            </form>
        </tbody>
    </table>
</div>
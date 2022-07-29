<x-app-layout>
    <div x-data="{open: 2}">
        <header class="bg-white shadow">
            <div class="flex mx-auto text-center px-4 py-4 ">
                <div @click="open = 1" :class="open == 1 && 'bg-gray-500'" class="flex-1 m-2 bg-gray-300 hover:bg-gray-500 rounded">広場</div>
                <div @click="open = 2" :class="open == 2 && 'bg-gray-500'" class="flex-1 m-2 bg-gray-300 hover:bg-gray-500 rounded">自分の投稿</div>
                <div @click="open = 3" :class="open == 3 && 'bg-gray-500'" class="flex-1 m-2 bg-gray-300 hover:bg-gray-500 rounded">新規作成</div>
                <div @click="open = 4" :class="open == 4 && 'bg-gray-500'" class="flex-1 m-2 bg-gray-300 hover:bg-gray-500 rounded">公開設定</div>
                <div @click="open = 5" :class="open == 5 && 'bg-gray-500'" class="flex-1 m-2 bg-gray-300 hover:bg-gray-500 rounded">アーカイブス</div>
                <div @click="open = 6" :class="open == 6 && 'bg-gray-500'" class="flex-1 m-2 bg-gray-300 hover:bg-gray-500 rounded">退会</div>
            </div>
        </header>
        <footer>
            <div>
                <div x-show="open == 1">@include("users.blogs.others")</div>
                <div x-show="open == 2">@include("users.blogs.index")</div>
                <div x-show="open == 3">@include("users.blogs.create")</div>
                <div x-show="open == 4">@include("users.blogs.open")</div>
                <div x-show="open == 5">@include("users.blogs.archive")</div>
                <div x-show="open == 6">@include("users.blogs.warning")</div>
            </div>
        </footer>
    </div>
</x-app-layout>
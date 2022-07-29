<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Scripts -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                    <ul class="flex">
                        <li class="flex-1 mr-2">
                            <a class="text-center block border border-gray-500 rounded py-2 px-4 bg-blue-500 hover:bg-blue-700 text-white" onclick="location.href='{{ route('users.blogs.others') }}'">他のユーザ</a>
                          </li>
                        <li class="flex-1 mr-2">
                          <a class="text-center block border border-blue-400 rounded py-2 px-4 bg-blue-400 hover:bg-blue-700 text-white" href="{{ route('users.index') }}">マイページ</a>
                        </li>
                        <li class="flex-1 mr-2">
                          <a class="text-center block border border-gray-300 rounded py-2 px-4 bg-blue-500 hover:bg-blue-700 text-white" onclick="location.href='{{ route('users.blogs.create') }}'">新規作成</a>
                        </li>
                        <li class="flex-1 mr-2">
                            <a class="text-center block border border-gray-200 rounded py-2 px-4 bg-blue-400 hover:bg-blue-700 text-white" href="{{ route('users.blogs.open') }}">公開設定</a>
                          </li>
                        <li class="text-center flex-1">
                          <a class="text-center block border border-gray-100 rounded py-2 px-4 bg-blue-500 hover:bg-blue-700 text-white" href="{{ route('users.blogs.archive') }}">アーカイブス</a>
                        </li>
                        <li class="text-center flex-1">
                            <a class="text-center block border border-gray-100 rounded py-2 px-4 bg-blue-400 hover:bg-blue-700 text-white" href="{{ route('users.blogs.warning') }}">退会処理</a>
                          </li>
                      </ul>
                </div>
            </header>
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
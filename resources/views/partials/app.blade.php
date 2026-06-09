<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Internship Portal')</title>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.tiny.cloud/1/sj9g6whesejg7znyk9wjm6fm2xu5rspc8oxozeg4pss78nbc/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    @include('partials.navbar')

    <main class="container mx-auto mt-8 px-4 flex-1">
        @if (session('success'))
            <div class="mb-4 rounded-lg border border-green-400 bg-green-100 px-4 py-3 text-green-800 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 rounded-lg border border-red-400 bg-red-100 px-4 py-3 text-red-800 shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 rounded-lg border border-red-400 bg-red-100 px-4 py-3 text-red-800 shadow-sm">
                <strong class="block font-semibold">There were some problems with your input:</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-white border-t border-gray-200 py-6">
        @include('partials.footer')
    </footer>
</body>
</html>
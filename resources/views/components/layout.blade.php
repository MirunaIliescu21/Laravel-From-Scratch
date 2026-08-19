
{{--All of the props expected by our layout file--}}
@props([
    'title' => 'Laracasts'
])

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-700 p-6 max-w-xl mx-auto">
    <nav>
        <a href="/">Home</a>
        <a href="/about">About Us</a>
        <a href="/contact">Contact us</a>
    </nav>

    {{--@slot  Components can have unique HTML, and for this we use the @slot atribute. --}}
    <main>
        {{ $slot }}
    </main>

</body>
</html>

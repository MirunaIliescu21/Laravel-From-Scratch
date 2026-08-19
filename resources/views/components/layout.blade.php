
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
    <style>
        .max-w-400 {
            max-width: 400px;
            margin: auto;
        }
        .card {
            background: #e3e3e3;
            padding: 1rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <nav>
        <a href="/">Home</a>
        <a href="/about">About Us</a>
        <a href="/contact">Contact us</a>
    </nav>

{{--   @slot  Components can have unique HTML, and for this we use the @slot atribute. --}}
    <main>
        {{ $slot }}
    </main>
</body>
</html>

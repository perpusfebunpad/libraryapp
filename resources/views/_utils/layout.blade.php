<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/static/tailwind.min.css">
    <link rel="stylesheet" href="/static/my-style.css">
    <link rel="stylesheet" href="/static/flowbite.min.css">
    <script src="/static/flowbite.min.js" defer></script>
    @yield("head")
</head>
<body class="h-full @if(isset($unpad_color_set) && $unpad_color_set) bg-unpad-light @endif">
    @yield("body")
</body>
</html>
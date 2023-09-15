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
<body>
    @include("dashboard._components.navbar")
    @include("dashboard._components.sidebar")

    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-14">
        @yield("body")
        </div>
    </div>
</body>
</html>
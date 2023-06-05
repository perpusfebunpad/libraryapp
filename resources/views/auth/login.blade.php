@extends("_utils.layout")

@section("head")
<title>Login | Aplikasi Perpustakaan FEB UNPAD</title>
@endsection


@section("body")
<main class="w-full flex justify-center">
    <div class="mt-16 max-w-sm">
        <h1 class="text-3xl mb-6 text-center">Login ke Aplikasi Perpustakaan FEB UNPAD</h1>
        @include("_utils.flash")
        <form action="/auth/login" method="post">
            @csrf
            <div class="mb-6">
                <label for="npm" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your NPM/NIP</label>
                <input type="text" id="npm" name="npm" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="xxxxxxxxxxxx" value='{{ old("npm") }}' required>
                @error("npm")
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="••••••••" required>
                @error("password")
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login ke akun saya</button>
        </form>
        <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
            Belum punya akun? <a href="/auth/register" class="text-blue-700 hover:underline dark:text-blue-500">daftar sekarang</a>
        </div>
    </div>
</main>
@endsection

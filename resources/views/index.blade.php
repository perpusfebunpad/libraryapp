@extends("_utils.layout")

@section("head")
<title>Aplikasi Perpustakaan FEB UNPAD</title>
<script src="/static/datepicker.min.js"></script>
@endsection


@section("body")
@include("_utils.navbar")
<section class="bg-unpad-yellow mt-3">
    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-unpad-dark md:text-5xl lg:text-6xl dark:text-white">Database Refinitiv</h1>
        <p class="mb-8 text-lg font-normal text-unpad-dark lg:text-xl sm:px-16 lg:px-48 dark:text-gray-400">Aplikasi database refinitiv merupakan aplikasi berbasis web yang bertujuan untuk melakukan booking jadwal penggunaan perpustakaan Fakultas Ekonomi Bisnis Universitas Padjajaran</p>
        @if($nearest_close_schedule != null)
        <div class="flex p-4 mx-4 my-4 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-400 dark:border-yellow-800" role="alert">
            <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
            <div id="marquee" class="flex w-full">
                <div id="marquee-content" class="w-full">
                    Perpustakaan akan tutup pada {{ $nearest_close_schedule->start }} - {{$nearest_close_schedule->end}} dikarenakan {{ $nearest_close_schedule->reason }}
                </div>
            </div>
        </div>
        @endif  
        <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
            <a href="/schedule" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                Dapatkan Jadwal
                <svg aria-hidden="true" class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </a>
            <a href="#" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-gray-900 rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                Learn more
            </a>
        </div>
    </div>
</section>

@include("_utils.footer")

@endsection
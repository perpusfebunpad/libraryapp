@extends("_utils.layout")

@section("head")
<title>Admin Page</title>
<script src="/static/datepicker.min.js"></script>
@endsection

@section("body")
@include("_utils.navbar")
<div class="mt-5 p-10 bg-gray-50 w-full">
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Admin Database Refinitiv Perpustakaan FEB UNPAD</h1>
            @include("_utils.flash")
            <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 lg:px-48 dark:text-gray-400">Berikut ini merupakan pusat administrasi dari website Database Refinitiv</p>
            <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
                <form class="mt-3 w-full" action="/_/verify-schedule" method="post">
                    @csrf
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Verify</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        </div>
                        <input type="search" name="verification_code" id="verification_code" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Isi kode verifikasi jadwal di sini" required>
                        <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Verifikasi</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <div class="md:flex md:justify-around">
        <form class="p-3 max-w-lg w-full mt-6" action="/_/add-closing-schedule" method="post">
            <h1 class="text-xl">Tambahkan Tanggal Tutup</h1>
            <div class="mt-3">
                <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal awal tutup</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                    </div>
                    <input datepicker datepicker-format="yyyy-mm-dd" datepicker-autohide type="text" name="start_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                </div>
            </div>
            <div class="mt-3">
                <label for="time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam awal tutup</label>
                <input type="time" id="time" name="start_hour" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 flex justify-around items-center">
            </div>
            <div class="mt-3">
                <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal akhir tutup</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                    </div>
                    <input datepicker datepicker-format="yyyy-mm-dd" datepicker-autohide type="text" name="finish_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                </div>
            </div>
            <div class="mt-3">
                <label for="time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam akhir tutup</label>
                <input type="time" id="time" name="finish_hour" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 flex justify-around items-center">
            </div>            
            <div class="mt-3">
                <label for="large-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alasan tutup</label>
                <input type="text" id="large-input" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div class="mt-3">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </div>

        </form>
        <div class="p-3 max-w-lg w-full mt-6">
            <h1 class="mb-3 text-xl">Status Website</h1>
            <dl class="max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                <div class="flex flex-col pb-3">
                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Jumlah Pengguna Terdaftar</dt>
                    <dd class="text-lg font-semibold">{{ count(\App\Models\User::all()); }}</dd>
                </div>
                <div class="flex flex-col py-3">
                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Jumlah Jadwal Terdaftar</dt>
                    <dd class="text-lg font-semibold">{{ count(\App\Models\Schedule::all()); }}</dd>
                </div>
            </dl>
        </div>
    </div>
</div>

@include("_utils.footer")
@endsection
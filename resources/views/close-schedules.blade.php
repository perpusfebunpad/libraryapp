@extends("_utils.layout")

@section("head")
<title>Aplikasi Perpustakaan FEB UNPAD</title>
<script src="/static/datepicker.min.js"></script>
@endsection


@section("body")
<main class="min-h-screen">
    @include("_utils.navbar")
    <div class="flex items-center justify-center flex-col">
        <div class="px-10 sm:px-10 lg:px-15 text-lg">
            <h1 class="text-5xl mt-5 pb-2 mb-2 border-b border-1">
                Jadwal Tutup
            </h1>
            <div class="px-3">
                <p class="font-normal">
                    Perpustakaan memiliki   beberapa jadwal tutup sehingga aplikasi ini sudah didesain agar jadwal penggunaan tidak dapat dibuat untuk waktu-waktu tersebut.
                </p>
                <h3 class="text-3xl mt-3 pb-2 mb-2 border-b border-1">
                    Jadwal Reguler
                </h3>
                <ul class="space-y-1 mx-3 list-disc list-inside">
                    <li>Hari Sabtu dan Minggu perpustakaan tutup</li>
                    <li>Hari Jum'at sesi 4 perpustakaan tutup</li>
                    <li>Pada tanggal cuti bersama perpustakaan ditutup</li>
                    <li>Pembuatan jadwal hanya bisa dibuat sekali seminggu</li>
                </ul>
                <h1 class="text-3xl mt-3 pb-2 mb-4 border-b border-1">
                    Jadwal Tidak Reguler
                </h1>
                <table class="w-full mx-3 text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Awal
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Akhir
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($schedules as $cs)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $loop->iteration }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $cs->start }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $cs->end }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="/_/close-schedules/edit/{{$cs->id}}" type="button" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:focus:ring-yellow-900">Update</a>
                                <a href="/_/close-schedules/delete/{{$cs->id}}" type="button" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if(count($schedules) == 0)
                    <h1 class="text-center font-light text-gray-700 mt-1">Tidak Terdapat Jadwal Tutup Untuk Saat Ini</h1>
                @endif
            </div>
        </div>
    </div>
</main>

@include("_utils.footer")

@endsection
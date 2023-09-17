@extends("dashboard._utils.layout")
@section("head")
<title>Dashboard - Refinitiv FEB UNPAD</title>
@endsection

@section("body")

<div class="flex items-center justify-center flex-col">
    <div class="lg:px-15">
        <div class="px-10 py-28 lg:py-36 my-3 border-b border-black">
            <h3 class="text-sm md:text-md">Aplikasi Database Refinitiv FEB UNPAD</h3>
            <h1 class="text-5xl font-extrabold text-gray-600">Jadwal Tutup</h1>
        </div>
        <div class="px-3 text-lg font-light">
            <p>
                Perpustakaan memiliki beberapa jadwal tutup. Aplikasi ini sudah dirancang agar jadwal penggunaan tidak dapat dibuat untuk waktu-waktu tersebut. Berikut ini merupakan jadwal tutup reguler perpustakaan.
            </p>
            <ul class="space-y-1 mx-3 list-disc list-inside">
                <li>Hari Sabtu dan Minggu perpustakaan tutup</li>
                <li>Hari Jum'at sesi 4 perpustakaan tutup</li>
                <li>Pada tanggal cuti bersama perpustakaan ditutup</li>
                <li>Pembuatan jadwal hanya bisa dibuat sekali seminggu</li>
            </ul>
            <h1 class="mt-3 pb-2 mb-4 text-lg">
                Selain jadwal diatas <span class="font-bold">jadwal tutup irreguler</span> akan di tampilkan pada tabel berikut
            </h1>
            <table class="w-full mx-3 text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Waktu
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Alasan
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
                            {{ $cs->start }} - {{ $cs->end }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $cs->reason }}
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

@endsection
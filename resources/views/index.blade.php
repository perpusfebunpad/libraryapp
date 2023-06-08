@extends("_utils.layout", [ "unpad_color_set" => true ])

@section("head")
<title>Aplikasi Perpustakaan FEB UNPAD</title>
<script src="/static/datepicker.min.js"></script>
@endsection


@section("body")
@include("_utils.navbar", [ "sticky_navbar" => true ])
<section class="h-full flex items-center bg-image-refenitiv bg-gray-400 bg-blend-multiply">
    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-unpad-light md:text-5xl lg:text-6xl dark:text-white">Refiniv Perpustakaan FEB UNPAD</h1>
        <p class="mb-8 text-lg font-normal text-unpad-light lg:text-xl sm:px-16 lg:px-48 dark:text-gray-400">Aplikasi berbasis web untuk melakukan booking jadwal penggunaan akses ke database refinitiv milik perpustakaan Fakultas Ekonomi Bisnis Universitas Padjajaran</p>
        <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
            <a href="/schedule" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-unpad-yellow hover:bg-unpad-light hover:text-black focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                Dapatkan Jadwal
                <svg aria-hidden="true" class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </a>
            <a href="/closing-schedules" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-900 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                Jadwal Tutup
            </a>
        </div>
    </div>
</section>

<section class="bg-black text-white flex flex-col items-center justify-center ">
    <div class="my-12 w-4/5 flex">
        <div class="flex flex-col justify-center items-center">
            <div class="rounded-full h-6 w-6 bg-unpad-yellow">
                <div class="rounded-full animate-ping h-6 w-6 bg-unpad-yellow"></div>
            </div>
            <div class="h-full w-1 bg-gradient-to-b from-yellow-400 to-black"></div>
        </div>
        <div class="ml-4">
            <h1 class="text-5xl mb-3">Refinitiv?</h1>
            <p class="md:w-3/5 text-sm ">
                Refinitiv, bagian dari LSEG (London Stock Exchange Group), merupakan salah satu penyedia data dan infrastruktur pasar keuangan terbesar di dunia dengan pengguna sebanyak 400,000 dan tersedia di 190 negara di dunia. Refinitiv menjalankan lebih dari 130 data fintech, analitik, perdagangan, dan alat penilaian risiko termasuk World-Check, database intelijen risiko untuk kepatuhan undang-undang kejahatan keuangan, FXall, Eikon, sistem manajemen eksekusi REDI, Datastream untuk analisis ekonomi makro , Analisis Kuantitatif di Cloud, AutoAudit, dan Platform Data Elektron, membuat 32.000 catatan intelijen risiko setiap bulan dari sumber internal dan pihak ketiga. Lainnya, database World-Check Risk Intelligence, mengumpulkan informasi dari daftar pantauan keuangan internasional, catatan pemerintah, dan pencarian media untuk mengatasi pencucian uang. Refinitiv juga mengelola database yang menampilkan lebih dari satu juta kesepakatan merger dan akuisisi (M&A) selama lebih dari 40 tahun, mencakup transaksi keuangan perusahaan dan tabel liga perbankan investasi di seluruh pasar ekuitas, utang, pinjaman, obligasi, pembiayaan proyek, penawaran umum perdana (IPO) , usaha patungan, pembelian kembali, ekuitas swasta dan obligasi kota.
            </p>
        </div>
    </div>

    <div id="about" class="my-12 w-4/5 flex">
        <div class="mr-4 text-right flex flex-col items-end">
            <h1 class="md:w-3/5 text-5xl mb-3">Aplikasi Refintiv Perpustakaaan FEB UNPAD</h1>
            <p class="md:w-3/5 text-sm">
                Untuk menjawab kebutuhan dosen dan mahasiswa atas data-data finansial, perpustakaan FEB UNPAD menyediakan akses ke database Refinitiv. Hanya saja karena adanya keterbatasan maka diperlukan sebuah cara agar setiap orang dapat mengakses database tersebut secara adil. Website ini merupakan aplikasi berbasis web yang dibuat oleh Perpustakaan FEB UNPAD dengan tujuan untuk pembuatan jadwal pengaksesan database refinitiv karena terbatasnya akses terhadap database refinitiv sehingga diperlukan sebuah cara sehingga setiap orang dapat mengakses database refinitiv tersebut secara adil.
            </p>
        </div>
        <div class="flex flex-col justify-center items-center">
            <div class="rounded-full h-6 w-6 bg-unpad-yellow">
                <div class="rounded-full animate-ping h-6 w-6 bg-unpad-yellow"></div>
            </div>
            <div class="h-full w-1 bg-gradient-to-b from-yellow-400 to-black"></div>
        </div>
    </div>
</section>

<footer class="bg-black text-white md:flex items-center md:justify-center pt-12 p-5">
    <div class="md:hidden text-center">
        <a href="/">Perpustakaan FEB UNPAD</a> © 2023
        <hr class="my-2 border border-white border-1">
    </div>
    <ul class="md:w-1/2 flex justify-around md:justify-between">
        <li class="hidden md:block">
            <a href="/">Perpustakaan FEB UNPAD</a> © 2023
        </li>
        <li>
            <a href="https://www.google.com/maps/place/Jl.+Dipati+Ukur+No.35,+Lebakgede,+Kecamatan+Coblong,+Kota+Bandung,+Jawa+Barat+40132/@-6.8912707,107.6176363,17z/data=!3m1!4b1!4m6!3m5!1s0x2e68e65471d37115:0x2c50a2555412f592!8m2!3d-6.8912707!4d107.6176363!16s%2Fg%2F11h9h7tnss?entry=ttu">Location</a>
        </li>
        <li>
            <a href="mailto:perpustakaanfebunpad@gmail.com">Contact</a>
        </li>
        <li>
            <a href="https://unpad.ac.id/">UNPAD</a>
        </li>
        <li>
            <a href="https://feb.unpad.ac.id/">FEB</a>
        </li>
    </ul>
</footer>

@endsection
@extends("dashboard._utils.layout")
@section("head")
<title>Dashboard - Refinitiv FEB UNPAD</title>
@endsection

@section("body")
<div class="w-full flex justify-center">
    @if($user_nearest_schedule)
    <div class="max-w-md w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Jadwal Anda</h5>
        @include("_utils.flash")
        <dl class="max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
            <div class="flex flex-col pb-3">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Waktu</dt>
                <dd class="text-lg font-semibold">{{ $user_nearest_schedule->start }} - {{ $user_nearest_schedule->end }}</dd>
            </div>
            <div class="flex flex-col pt-3">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Status</dt>
                <dd class="text-lg font-semibold">
                    @if($user_nearest_schedule->active())
                    Active
                    @elseif($user_nearest_schedule->expired())
                    Expired
                    @else
                    Available
                    @endif
                </dd>
            </div>
            <div class="flex flex-col pt-3">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Teman</dt>
                <dd class="text-lg font-semibold">
                    {{ $user_nearest_schedule->friend_name !== null ? $user_nearest_schedule->friend_name . " - " : "N/A" }} {{ $user_nearest_schedule->friend_npm !== null ? $user_nearest_schedule->friend_npm : "" }}
                </dd>
            </div>
            <div class="flex flex-col pt-3">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Bukti Registrasi</dt>
                <a href="/schedule/proof" class="mt-3 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Download Bukti Registrasi</a>
            </div>
            <div class="flex flex-col py-3">
                <dt class="mb-1 text-red-500 md:text-lg dark:text-red-400">*Catatan</dt>
                <dd class="text-sm font-light text-red-500">Harap mendownload bukti registrasi dan membawa KTM untuk verifikasi di perpustakaan</dd>
            </div>
        </dl>
    </div>
    @endif
</div>

<div class="mt-3">
    <h1 class="text-xl font-bold">Jadwal-jadwal yang sudah didaftarkan</h1>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Pemilik
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tanggal
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Sesi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($schedules as $schedule)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $loop->iteration }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $schedule->owner->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ date("Y-m-d", strtotime($schedule->start)) }}
                    </td>
                    <td class="px-6 py-4">
                        {{
                            date("H:i:s", strtotime($schedule->start))
                        }} -
                        {{
                            date("H:i:s", strtotime($schedule->end))
                        }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @include("_utils.paginator")
    </div>
</div>

@endsection

@extends("_utils.layout")

@section("head")
<title>Aplikasi Perpustakaan FEB UNPAD</title>
<script src="/static/datepicker.min.js"></script>
@endsection

@section("body")
<section id="body" class="min-h-screen bg-gray-50">
    @include("_utils.navbar2")
    <main class="container mx-auto px-4 py-8">
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="/" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-amber-600">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="/" class="ml-1 text-sm font-medium text-gray-700 hover:text-amber-600 md:ml-2">Aplikasi Database Refinitiv FEB UNPAD</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Reservation</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Pendaftaran Jadwal</h1>
            <p class="mt-2 text-gray-600">Silahkan klik tombol "Reserve a Schedule" untuk melakukan reservasi</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-1">
                <!-- Quick Actions -->
                <div class="bg-white shadow-lg rounded-lg border border-gray-200 overflow-hidden">
                    <div class="p-4 border-b border-gray-100 bg-amber-50">
                        <h2 class="text-xl font-semibold text-amber-800">Quick Actions</h2>
                    </div>
                    <div class="p-4 space-y-2">
                        <a href="{{ route('user.schedules.create') }}" class="inline-block text-center w-full py-2 px-4 bg-amber-500 hover:bg-amber-600 text-white font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2">
                            Reserve a Schedule
                        </a>
                        <a href="{{ route('user.schedules.closing') }}" class="inline-block text-center w-full py-2 px-4 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2">
                            Look at Closing Schedule
                        </a>
                    </div>
                </div>

                @if($user_nearest_schedule !== null)
                <div class="mt-6 bg-white shadow-lg rounded-lg border border-gray-200 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-amber-50">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-semibold text-amber-800">Your Upcoming Schedule</h2>
                            @if($user_nearest_schedule->active())
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">Active</span>
                            @elseif($user_nearest_schedule->expired())
                            <span class="px-3 py-1 bg-green-100 text-red-800 rounded-full text-sm font-medium">Expired</span>
                            @else
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">Available</span>
                            @endif
                        </div>
                    </div>
                    <div class="p-6 space-y-4">
                        <!-- Schedule Details -->
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Time</h3>
                            <p class="mt-1 text-lg font-medium">{{ $user_nearest_schedule->start }} - {{ $user_nearest_schedule->end }}</p>
                            <div class="mt-1 h-px bg-gray-200"></div>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Friend</h3>
                            <p class="mt-1 text-lg font-medium">
                            {{ $user_nearest_schedule->friend_name !== null ? $user_nearest_schedule->friend_name . " - " : "N/A" }} {{ $user_nearest_schedule->friend_npm !== null ? $user_nearest_schedule->friend_npm : "" }}
                            </p>
                            <div class="mt-1 h-px bg-gray-200"></div>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Bukti Registrasi</h3>
                            <a href="/schedule/proof" class="block text-center mt-2 w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                Download Bukti Registrasi
                            </a>
                        </div>

                        <div class="mt-4 p-3 bg-red-50 border border-red-100 rounded-md">
                            <p class="text-red-600 text-sm">
                            <span class="font-semibold">*Catatan</span><br>
                            Harap mendownload bukti registrasi dan membawa KTM untuk verifikasi di perpustakaan
                            </p>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white shadow-lg rounded-lg border border-gray-200 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-amber-50">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-semibold text-amber-800 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                All Reserved Schedule
                            </h2>
                            <div class="flex space-x-2">
                                <select class="px-3 py-1.5 bg-white border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                                    <option>All Time</option>
                                    <option>This Month</option>
                                    <option>Last Month</option>
                                </select>
                                <button class="px-3 py-1.5 bg-amber-100 text-amber-800 rounded-md text-sm font-medium hover:bg-amber-200 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-1">
                                    Export
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Schedule Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Time
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Lokasi
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Owner
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- Current Schedule (Highlighted) -->
                                @if(count($schedules) > 0)
                                @foreach($schedules as $schedule)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ date("Y-m-d", strtotime($schedule->start)) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ date("H:i:s", strtotime($schedule->start)) }} -
                                        {{ date("H:i:s", strtotime($schedule->end)) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ ucfirst($schedule->location) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($schedule->active())
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-gray-800">
                                            Expired
                                        </span>
                                        @elseif($schedule->expired())
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            Expired
                                        </span>
                                        @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-gray-800">
                                            Available
                                        </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $schedule->owner->name }}
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <!-- Empty State -->
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-sm text-gray-500">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400 mb-3">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                            </svg>
                                            <p class="font-medium">Tidak Terdapat Jadwal Tutup Untuk Saat Ini</p>
                                            <p class="mt-1 text-gray-400">Jadwal tutup irreguler akan ditampilkan di sini ketika tersedia</p>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="px-6 py-3 flex items-center justify-between border-t border-gray-200">
                        <div class="flex-1 flex justify-between sm:hidden">
                            <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Previous
                            </button>
                            <button class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Next
                            </button>
                        </div>
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                Showing <span class="font-medium">{{ ($current_page - 1) * 10 + 1 }}</span> to <span class="font-medium">{{ $current_page * 10 }}</span> of <span class="font-medium">{{ count($schedules) }}</span> results
                                </p>
                            </div>
                            <div>
                                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">

                                    @if($current_page - 1 > 0)
                                    <a href="?page={{ $current_page - 1 }}" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                        <span class="sr-only">Previous</span>
                                        <!-- Chevron left -->
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    @endif

                                    @for($i = $first_link; $i <= $last_link; $i++)
                                    @if($i == $current_page)
                                    <a href="?page={{$i}}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-blue-50 text-sm font-medium text-amber-600 hover:bg-amber-100">
                                        1
                                    </a>
                                    @else
                                    <a href="?page={{i}} class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                        2
                                    </a>
                                    @endif
                                    @endfor

                                    @if($current_page + 1 <= $total_pages)
                                    <a href="?page={{ $current_page - 1 }}" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                        <span class="sr-only">Next</span>
                                        <!-- Chevron right -->
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    @endif
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</section>

@endsection

@extends("_utils.layout")

@section("head")
<title> {{ $user->name }} | Website Database Refinitiv Perpustakaan FEB UNPAD</title>
@endsection

@section("body")
<section id="body" class="min-h-screen bg-gray-50">
    @include("_utils.navbar2")
    <main class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column: Profile Card -->
            <div class="lg:col-span-1">
                <div class="bg-white shadow-lg rounded-lg border border-gray-200 overflow-hidden">
                    <div class="bg-amber-500 h-16 relative"></div>
                    <div class="mt-3 px-6 pb-6 relative">
                        <div class="flex justify-center">
                            <div class="h-32 w-32 rounded-full border-4 border-white bg-amber-100 flex items-center justify-center text-amber-800 text-4xl font-bold shadow-md bg-amber-50">
                                {{ $initial }}
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <h2 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h2>
                            <p class="text-gray-500 mt-1">{{ $user->npm }}</p>

                            @if($user->id == auth()->user()->id)
                            <div class="mt-4 flex justify-center space-x-2">
                                <a href="{{ route('profile.edit') }}"  class="px-4 py-2 bg-amber-500 text-white rounded-md hover:bg-amber-600 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                    Edit Profile
                                </a>
                                <a href="{{ route('password.edit') }}"class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                    Change Password
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="mt-6 bg-white shadow-lg rounded-lg border border-gray-200 overflow-hidden">
                    <div class="p-4 border-b border-gray-100 bg-amber-50">
                        <h2 class="font-semibold text-amber-800 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                            Contact Information
                        </h2>
                    </div>
                    <div class="p-4 space-y-3">
                        <div class="flex items-center">
                            <div class="w-24 text-sm font-medium text-gray-500">Email:</div>
                            <div class="flex-1 text-gray-800">{{ $user->email }}</div>
                        </div>
                        <div class="flex items-center">
                            <div class="w-24 text-sm font-medium text-gray-500">Phone:</div>
                            <div class="flex-1 text-gray-800">{{ $user->phone_number }}</div>
                        </div>
                        <div class="flex items-center">
                            <div class="w-24 text-sm font-medium text-gray-500">Status:</div>
                            <div class="flex-1 text-gray-800">{{ $user->status }}</div>
                        </div>
                        <div class="flex items-center">
                            <div class="w-24 text-sm font-medium text-gray-500">Prodi:</div>
                            <div class="flex-1 text-gray-800">{{ str_replace("_", " ", $user->departement) }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Tabs and Content -->
            <div class="lg:col-span-2">

                <!-- Library Statistics -->
                <div class="bg-white shadow-lg rounded-lg border border-gray-200 overflow-hidden">
                    <div class="p-4 border-b border-gray-100 bg-amber-50">
                        <h2 class="font-semibold text-amber-800 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                <path d="M12 20V10"></path>
                                <path d="M18 20V4"></path>
                                <path d="M6 20v-4"></path>
                            </svg>
                            Library Usage Statistics
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-blue-50 rounded-lg p-4 border border-blue-100 text-center">
                                <h4 class="text-sm font-medium text-blue-700 mb-1">You registered </h4>
                                <p class="text-3xl font-bold text-blue-800">{{ count($user->schedules->filter(fn($s) => $s->expired())) }}</p>
                                <p class="text-xs text-blue-600 mt-1">in the past</p>
                            </div>
                            <div class="bg-green-50 rounded-lg p-4 border border-green-100 text-center">
                                <h4 class="text-sm font-medium text-blue-700 mb-1">You registered </h4>
                                <p class="text-3xl font-bold text-blue-800">{{ count($user->schedules->filter(fn($s) => !$s->expired())) }}</p>
                                <p class="text-xs text-blue-600 mt-1">for the future</p>
                            </div>
                            <div class="bg-purple-50 rounded-lg p-4 border border-purple-100 text-center">
                                <h4 class="text-sm font-medium text-purple-700 mb-1">In total you have</h4>
                                <p class="text-3xl font-bold text-purple-800">{{ count($user->schedules) }}</p>
                                <p class="text-xs text-purple-600 mt-1">schedules!</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Reservations -->
                <div class="mt-6 bg-white shadow-lg rounded-lg border border-gray-200 overflow-hidden">
                    <div class="p-4 border-b border-gray-100 bg-amber-50">
                        <h2 class="font-semibold text-amber-800 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            Upcoming Reservations
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="border border-gray-200 rounded-lg overflow-hidden">
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
                                    @if(count($user->schedules) > 0)
                                    @foreach($user->schedules as $schedule)
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
                    </div>
                </div>
            </div>
        </div>
    </main>
</section>

@endsection

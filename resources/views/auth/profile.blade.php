@extends("_utils.layout")

@section("head")
<title> {{ $user->name }} | Website Database Refinitiv Perpustakaan FEB UNPAD</title>
@endsection

@section("body")
@include("_utils.navbar")
<div class="flex w-full h-full justify-center items-center">
    <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex justify-end px-4 pt-4">
            @if($user->id == auth()->user()->id && 0)
            <button id="dropdownButton" data-dropdown-toggle="dropdown" class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5" type="button">
                <span class="sr-only">Open dropdown</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path></svg>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdown" class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2" aria-labelledby="dropdownButton">
                    <li>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Edit Profile</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Change Password</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign Out</a>
                    </li>
                </ul>
            </div>
            @endif
        </div>

        <div class="flex flex-col items-center pb-10">
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $user->name }}</h5>
            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $user->npm }}</span>
            <div class="mt-3 w-5/6 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white overflow-hidden">
                <table class="w-full">
                    <tr class="border-b text-left">
                        <th class="py-2 pl-4">Email</th>
                        <td class="pr-4">{{ $user->email }}</td>
                    </tr>
                    <tr class="border-b text-left">
                        <th class="py-2 pl-4">No. Telp</th>
                        <td class="pr-4">{{ $user->phone_number }}</td>
                    </tr>
                    <tr class="border-b text-left">
                        <th class="py-2 pl-4">Status</th>
                        <td class="pr-4">{{ $user->status }}</td>
                    </tr>
                    <tr class="border-b text-left">
                        <th class="py-2 pl-4">Program Studi</th>
                        <td class="pr-4">{{ $user->departement }}</td>
                    </tr>
                    <tr class="border-b text-left">
                        <th class="py-2 pl-4">Email</th>
                        <td class="pr-4">{{ $user->email }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
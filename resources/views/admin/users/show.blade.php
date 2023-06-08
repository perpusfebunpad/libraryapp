@extends("_utils.layout")

@section("head")
<title> {{ $user->name }} | Website Database Refinitiv Perpustakaan FEB UNPAD</title>
@endsection

@section("body")
@include("_utils.navbar")
<div class="flex w-full h-full justify-center items-center">
    <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex justify-end px-4 pt-4">
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
@extends("_utils.layout")

@section("head")
<title>Update Profile</title>
@endsection

@section("body")
@include("_utils.navbar2")
<div class="mt-6 px-6 pb-6">
    <div class="border-b border-black pb-5 mb-5">
        <h1 class="text-5xl">Update Profile</h1>
    </div>
    <form action="{{ route('profile.update') }}" method="post">
        @csrf
        @method("put")
        <div class="mb-6">
            <label for="npm" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NPM/NIP</label>
            <input type="text" id="npm" name="npm" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="xxxxxxxxxxxx" value='{{ old("npm", $user->npm) }}' required>
            @error("npm")
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-6">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
            <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value='{{ old("name", $user->name) }}' required>
            @error("name")
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-6">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="example@example.com" value='{{ old("email", $user->email) }}' required>
            @error("email")
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-6">
            <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone Number</label>
            <input type="text" id="phone_number" name="phone_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="08xxxxxxxxxx" value='{{ old("phone_number", $user->phone_number) }}' required>
            @error("phone_number")
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-6">
            <label for="departement" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Departement</label>
            <select name="departement" id="departement" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option
                    @if($user->departement == "S1_AKUNTANSI")
                        selected
                    @endif
                    value="S1_AKUNTANSI">S1 - Akuntansi</option>
                <option
                    @if($user->departement == "S1_MANAJEMEN")
                        selected
                    @endif
                    value="S1_MANAJEMEN">S1 - Manajemen</option>
                <option
                    @if($user->departement == "S1_MANAJEMEN")
                        selected
                    @endif
                    value="S1_MANAJEMEN">S1 - Manajemen</option>
                <option
                    @if($user->departement == "S1_ILMU_EKONOMI")
                        selected
                    @endif
                    value="S1_ILMU_EKONOMI">S1 - Ilmu Ekonomi</option>
                <option
                    @if($user->departement == "S1_BISNIS_DIGITAL")
                        selected
                    @endif
                    value="S1_BISNIS_DIGITAL">S1 - Bisnis Digital</option>
                <option
                    @if($user->departement == "S1_AKUNTANSI_SEKTOR_PUBLIK")
                        selected
                    @endif
                    value="S1_AKUNTANSI_SEKTOR_PUBLIK">S1 - Akuntansi Sektor Publik</option>
                <option
                    @if($user->departement == "PROFESI_AKUNTANSI")
                        selected
                    @endif
                    value="PROFESI_AKUNTANSI">Profesi Akuntansi</option>
                <option
                    @if($user->departement == "S2_EKONOMI")
                        selected
                    @endif
                    value="S2_EKONOMI">S2 Ekonomi</option>
                <option
                    @if($user->departement == "S2_ILMU_EKONOMI")
                        selected
                    @endif
                    value="S2_ILMU_EKONOMI">S2 Ilmu Ekonomi</option>
                <option
                    @if($user->departement == "S2_ILMU_MANAJEMEN")
                        selected
                    @endif
                    value="S2_ILMU_MANAJEMEN">S2 Ilmu Manajemen</option>
                <option
                    @if($user->departement == "S2_MANAJEMEN")
                        selected
                    @endif
                    value="S2_MANAJEMEN">S2 Manajemen</option>
                <option
                    @if($user->departement == "S2_AKUNTANSI")
                        selected
                    @endif
                    value="S2_AKUNTANSI">S2 Akuntansi</option>
                <option
                    @if($user->departement == "S2_EKONOMI_TERAPAN")
                        selected
                    @endif
                    value="S2_EKONOMI_TERAPAN">S2 Ekonomi Terapan</option>
                <option
                    @if($user->departement == "S2_MANAJEMEN")
                        selected
                    @endif
                    value="S2_MANAJEMEN">S2 Manajemen</option>
                <option
                    @if($user->departement == "S2_MANAJEMEN_MIKRO_TERPADU")
                        selected
                    @endif
                    value="S2_MANAJEMEN_MIKRO_TERPADU">S2 Manajemen Mikro Terpadu</option>
                <option
                    @if($user->departement == "S3_EKONOMI")
                        selected
                    @endif
                    value="S3_EKONOMI">S3 Ekonomi</option>
                <option
                    @if($user->departement == "S3_MANAJEMEN")
                        selected
                    @endif
                    value="S3_MANAJEMEN">S3 Manajemen</option>
                <option
                    @if($user->departement == "S3_AKUNTANSI")
                        selected
                    @endif
                    value="S3_AKUNTANSI">S3 Akuntansi</option>
            </select>
            @error("departement")
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
    </form>
</div>
@endsection

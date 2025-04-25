<header class="bg-amber-500 text-white shadow-md">
    <div class="container mx-auto px-4 py-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="bg-white p-2 rounded-full">
                <!-- Book Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-open">
                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                </svg>
            </div>
            <h1 class="text-xl font-semibold">Perpustakaan FEB UNPAD</h1>
        </div>
        <div class="text-white hover:bg-amber-600 p-2 rounded-md">
            <!-- Menu Icon -->
            <button type="button" data-drawer-target="drawer-right-example" data-drawer-show="drawer-right-example" data-drawer-placement="right" aria-controls="drawer-right-example">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu">
                    <line x1="4" x2="20" y1="12" y2="12" />
                    <line x1="4" x2="20" y1="6" y2="6" />
                    <line x1="4" x2="20" y1="18" y2="18" />
                </svg>
            </button>
        </div>
    </div>
</header>

<div id="drawer-right-example" class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-right-label">
    <br class="mb-4"/>
    <button type="button" data-drawer-hide="drawer-right-example" aria-controls="drawer-right-example" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" >
      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
      <span class=" break-words overflow-x-hidden sr-only">Close</span>
    </button>

    <div class="py-4 overflow-y-auto">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="/" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <img src="/static/icons/home.svg" alt="Home Icon">
                    <span class=" break-words overflow-x-hidden ml-3">Home</span>
                </a>
            </li>
            @auth
            <li>
                <a href="{{ route('profile.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <img src="/static/icons/user.svg" alt="user Icon">
                    <span class=" break-words overflow-x-hidden flex-1 ml-3 whitespace-nowrap">{{ auth()->user()->name }}</span>
                </a>
            </li>

            @can("moderate")
            <li>
                <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                    <img src="/static/icons/database.svg" alt="database Icon">
                    <span class=" break-words overflow-x-hidden flex-1 ml-3 text-left whitespace-nowrap">Admin</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
                <ul id="dropdown-example" class="hidden py-2 space-y-2">
                    <li>
                        <a href="{{ route('admin.index') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('schedules.index') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Schedules</a>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Users</a>
                    </li>
                    <li>
                        <a href="{{ route('closing.index') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Close Schedules</a>
                    </li>
                </ul>
            </li>
            @endcan

            <li>
                <a href="/auth/logout" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <img src="/static/icons/log-out.svg" alt="log-out Icon">
                    <span class=" break-words overflow-x-hidden flex-1 ml-3 whitespace-nowrap">Sign Out</span>
                </a>
            </li>
            @else
            <li>
                <a href="/auth/login" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <img src="/static/icons/log-in.svg" alt="log-in Icon">
                    <span class=" break-words overflow-x-hidden flex-1 ml-3 whitespace-nowrap">Sign In</span>
                </a>
            </li>
            <li>
                <a href="/auth/register" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <img src="/static/icons/table.svg" alt="table Icon">
                    <span class=" break-words overflow-x-hidden flex-1 ml-3 whitespace-nowrap">Sign Up</span>
                </a>
            </li>
            @endauth
        </ul>
        <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
            <li>
                <a href="/" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white">
                    <img class="h-6" src="/static/icons/whatsapp.svg" alt="Whatsapp">
                    <span class=" break-words overflow-x-hidden ml-3">08123456789</span>
                </a>
            </li>
            <li>
                <a href="/" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white">
                    <img class="h-6" src="/static/icons/mail.svg" alt="Email">
                    <span class=" break-words overflow-x-hidden ml-3">perpustakaanfebunpad@gmail.com</span>
                </a>
            </li>
        </ul>
    </div>
</div>

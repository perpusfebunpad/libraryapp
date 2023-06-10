<nav class="@if(isset($sticky_navbar) && $sticky_navbar) fixed w-full bg-unpad-yellow left-0 top-0 z-49 @endif">
    <div id="real-navbar" class="sm:px-2 md:px-10 py-1 w-full flex justify-between items-center rounded-b
    @if(isset($sticky_navbar) && $sticky_navbar) 
    text-white absolute top-0
    @else
    bg-unpad-yellow text-unpad-light shadow shadow-lg
    @endif">
        <div class="flex items-center">
            <a href="https://www.unpad.ac.id/">
                <img src="/static/logo-unpad.png" class="h-12" alt="Logo UNPAD">
            </a>
            <span class="ml-2 mr-4">|</span>
            <a href="/">Refinitiv Perpustakaan FEB UNPAD</a>
        </div>
        <div class="text-center">
            <button type="button" data-drawer-target="drawer-right-example" data-drawer-show="drawer-right-example" data-drawer-placement="right" aria-controls="drawer-right-example">
                <img src="/static/icons-light/menu.svg" alt="Menu">
            </button>
        </div>
    </div>
</nav>

<div id="drawer-right-example" class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-right-label">
    <br class="mb-4"/>
    <button type="button" data-drawer-hide="drawer-right-example" aria-controls="drawer-right-example" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" >
      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
      <span class="sr-only">Close</span>
    </button>

    <div class="py-4 overflow-y-auto">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="/" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <img src="/static/icons/home.svg" alt="Home Icon">
                    <span class="ml-3">Home</span>
                </a>
            </li>
            @auth
            <li>
                <a href="/schedule" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <img src="/static/icons/clock.svg" alt="clock Icon">
                    <span class="flex-1 ml-3 whitespace-nowrap">Schedule</span>
                </a>
            </li>
            <li>
                <a href="/auth/profile" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <img src="/static/icons/user.svg" alt="user Icon">
                    <span class="flex-1 ml-3 whitespace-nowrap">{{ auth()->user()->name }}</span>
                </a>
            </li>
            
            @can("moderate")
            <li>
                <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                    <img src="/static/icons/database.svg" alt="database Icon">
                    <span class="flex-1 ml-3 text-left whitespace-nowrap">Admin</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
                <ul id="dropdown-example" class="hidden py-2 space-y-2">
                    <li>
                        <a href="/_" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Dashboard</a>
                    </li>                    
                    <li>
                        <a href="/_/schedules" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Schedules</a>
                    </li>
                    <li>
                        <a href="/_/users" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Users</a>
                    </li>
                    <li>
                        <a href="/_/close-schedules" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Close Schedules</a>
                    </li>
                </ul>
            </li>
            @endcan

            <li>
                <a href="/auth/logout" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <img src="/static/icons/log-out.svg" alt="log-out Icon">
                    <span class="flex-1 ml-3 whitespace-nowrap">Sign Out</span>
                </a>
            </li>
            @else
            <li>
                <a href="/auth/login" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <img src="/static/icons/log-in.svg" alt="log-in Icon">
                    <span class="flex-1 ml-3 whitespace-nowrap">Sign In</span>
                </a>
            </li>
            <li>
                <a href="/auth/register" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <img src="/static/icons/table.svg" alt="table Icon">
                    <span class="flex-1 ml-3 whitespace-nowrap">Sign Up</span>
                </a>
            </li>
            @endauth
        </ul>
    </div>
</div>

@if(isset($sticky_navbar) && $sticky_navbar)
<script>
    window.onload = (event) => {
        scrollTo(0, 0);
    }
    const realNavbar = document.getElementById('real-navbar');
    addEventListener("scroll", ev => {
        if(scrollY !== 0) {
            realNavbar.classList.add('bg-unpad-yellow')
        } else {
            realNavbar.classList.remove('bg-unpad-yellow')
        }
    })    
</script>
@endif
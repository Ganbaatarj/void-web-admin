<ul class="menu grow transition-all duration-300" :class="sidebarWide ? 'lg:w-60 w-16' : 'w-16'">
    <li class="menu-title border-b border-neutral-200">
        <a href="{{ route('dashboard') }}" class="mx-auto">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
        </a>
    </li>
    <li class="border-b border-neutral-200">
        <a href="/dashboard" class="flex group {{ request()->routeIs('dashboard') ? 'active font-bold' : '' }}">
            <div class="tooltip tooltip-right tooltip-primary" data-tip="Хяналтын самбар">
                <span class="material-symbols-outlined">
                    dashboard_2
                </span>
            </div>
            <span x-show="sidebarWide" class="hidden lg:block group-hover:font-bold">
                Хяналтын самбар
            </span>
        </a>
    </li>
    <li class="border-b border-neutral-200">
        <a href="/video" class="flex group {{ request()->routeIs('video') ? 'active font-bold' : '' }}">
            <div class="tooltip tooltip-right tooltip-primary" data-tip="Видеонууд (ажил)">
                <span class="material-symbols-outlined">
                    movie_info
                </span>
            </div>
            <span x-show="sidebarWide" class="hidden lg:block group-hover:font-bold">
                Видеонууд (ажил)
            </span>
        </a>
    </li>
    <li class="border-b border-neutral-200">
        <a href="/pages" class="flex group{{ request()->routeIs('pages') ? 'active font-bold' : '' }}">
            <div class="tooltip tooltip-right tooltip-primary" data-tip="Хуудасны мэдээлэл">
                <span class="material-symbols-outlined">
                    web
                </span>
            </div>
            <span x-show="sidebarWide" class="hidden lg:block group-hover:font-bold">
                Хуудасны мэдээлэл
            </span>
        </a>
    </li>
    <li class="border-b border-neutral-200">
        <a href="/category" class="flex group{{ request()->routeIs('category') ? 'active font-bold' : '' }}">
            <div class="tooltip tooltip-right tooltip-primary" data-tip="Видеоны төрөл">
                <span class="material-symbols-outlined">
                    flowchart
                </span>
            </div>
            <span x-show="sidebarWide" class="hidden lg:block group-hover:font-bold">
                Видеоны төрөл
            </span>
        </a>
    </li>
</ul>
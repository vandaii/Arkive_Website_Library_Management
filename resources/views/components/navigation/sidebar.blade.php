<div class="bg-white h-screen w-60 z-100 border-black/20">
    <ul>
        <li>
            <div class="flex items-center h-20 px-5 border-b-2 border-white/40">
                <h1 class="">Logo</h1>
            </div>
        </li>
        <li class="px-5 space-y-5 flex flex-col py-10">
            <x-sidebar-link href="{{ route('admin.index') }}" :active="request()->routeIs('admin.index')">Dashboard</x-sidebar-link>
            <x-sidebar-link href="{{ route('user-management.index') }}" :active="request()->routeIs('user-management.index')">Kelola User</x-sidebar-link>
        </li>
    </ul>
</div>

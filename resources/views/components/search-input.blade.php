<div class="relative">
    <input type="search" name="search" id="search" placeholder="Cari judul atau penulis..."
        value="{{ request('search', $search ?? '') }}"
        class="w-10/12 py-2 rounded-full pl-13 pr-4 outline-1 outline-black/50 focus:outline-(--third-color) focus:outline-2 transition-all duration-200">
    <i class="absolute top-2.5 left-4 size-5 my-auto stroke-black/50" data-lucide="search"></i>
</div>

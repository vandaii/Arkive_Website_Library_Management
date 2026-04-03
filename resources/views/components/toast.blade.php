@if (session('success') || session('error') || session('warning') || session('info'))
    <div id="toast-container" class="fixed top-20 right-5 z-[999] flex flex-col gap-3" style="pointer-events: none;">
        @if (session('success'))
            <div class="toast-item flex items-center gap-3 bg-white border border-green-200 shadow-xl rounded-xl px-5 py-4 min-w-80 max-w-96 animate-slide-in"
                style="pointer-events: auto;">
                <div class="flex items-center justify-center w-9 h-9 rounded-full bg-green-100 shrink-0">
                    <i class="size-5 text-green-600" data-lucide="check-circle"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-green-800">Berhasil</p>
                    <p class="text-xs text-green-600 mt-0.5 line-clamp-2">{{ session('success') }}</p>
                </div>
                <button onclick="this.closest('.toast-item').remove()"
                    class="text-gray-400 hover:text-gray-600 shrink-0 cursor-pointer">
                    <i class="size-4" data-lucide="x"></i>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="toast-item flex items-center gap-3 bg-white border border-red-200 shadow-xl rounded-xl px-5 py-4 min-w-80 max-w-96 animate-slide-in"
                style="pointer-events: auto;">
                <div class="flex items-center justify-center w-9 h-9 rounded-full bg-red-100 shrink-0">
                    <i class="size-5 text-red-600" data-lucide="alert-circle"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-red-800">Gagal</p>
                    <p class="text-xs text-red-600 mt-0.5 line-clamp-2">{{ session('error') }}</p>
                </div>
                <button onclick="this.closest('.toast-item').remove()"
                    class="text-gray-400 hover:text-gray-600 shrink-0 cursor-pointer">
                    <i class="size-4" data-lucide="x"></i>
                </button>
            </div>
        @endif

        @if (session('warning'))
            <div class="toast-item flex items-center gap-3 bg-white border border-yellow-200 shadow-xl rounded-xl px-5 py-4 min-w-80 max-w-96 animate-slide-in"
                style="pointer-events: auto;">
                <div class="flex items-center justify-center w-9 h-9 rounded-full bg-yellow-100 shrink-0">
                    <i class="size-5 text-yellow-600" data-lucide="alert-triangle"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-yellow-800">Peringatan</p>
                    <p class="text-xs text-yellow-600 mt-0.5 line-clamp-2">{{ session('warning') }}</p>
                </div>
                <button onclick="this.closest('.toast-item').remove()"
                    class="text-gray-400 hover:text-gray-600 shrink-0 cursor-pointer">
                    <i class="size-4" data-lucide="x"></i>
                </button>
            </div>
        @endif

        @if (session('info'))
            <div class="toast-item flex items-center gap-3 bg-white border border-blue-200 shadow-xl rounded-xl px-5 py-4 min-w-80 max-w-96 animate-slide-in"
                style="pointer-events: auto;">
                <div class="flex items-center justify-center w-9 h-9 rounded-full bg-blue-100 shrink-0">
                    <i class="size-5 text-blue-600" data-lucide="info"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-blue-800">Info</p>
                    <p class="text-xs text-blue-600 mt-0.5 line-clamp-2">{{ session('info') }}</p>
                </div>
                <button onclick="this.closest('.toast-item').remove()"
                    class="text-gray-400 hover:text-gray-600 shrink-0 cursor-pointer">
                    <i class="size-4" data-lucide="x"></i>
                </button>
            </div>
        @endif
    </div>

    <style>
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(100px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        @keyframes slideOut {
            from {
                opacity: 1;
                transform: translateX(0);
            }
            to {
                opacity: 0;
                transform: translateX(100px);
            }
        }
        .animate-slide-in {
            animation: slideIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        .animate-slide-out {
            animation: slideOut 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const toasts = document.querySelectorAll('.toast-item');
                toasts.forEach(function(toast, index) {
                    setTimeout(function() {
                        toast.classList.add('animate-slide-out');
                        toast.addEventListener('animationend', function() {
                            toast.remove();
                        });
                    }, index * 200);
                });
            }, 4000);
        });
    </script>
@endif

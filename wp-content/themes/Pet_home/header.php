<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Website mua sắm điện thoại, thiết bị công nghệ chính hãng, uy tín.">
    <meta name="robots" content="index, follow">
    <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Tùy chỉnh một số hình dạng đặc biệt trong thiết kế */
        .blob-shape {
            border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
        }
        body { background-color: #fff6ef; } /* Màu nền cam nhạt */
    </style>
    <?php wp_head(); ?>
</head>
<body <?php body_class('text-gray-800 font-sans min-h-screen'); ?>>

    <div class="bg-white py-4 px-8 flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="text-3xl font-bold text-[#8b3dff]">
            Siêu Thị Thú Cưng FSE
        </div>

        <div class="flex-1 max-w-2xl w-full relative">
            <input type="text" placeholder="Tìm kiếm sản phẩm..." class="w-full bg-gray-100 text-gray-700 rounded-full py-3 px-6 pr-16 focus:outline-none focus:ring-2 focus:ring-[#8b3dff]">
            <button class="absolute right-1 top-1 bottom-1 bg-[#8b3dff] text-white rounded-full w-10 flex items-center justify-center hover:bg-purple-700 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </button>
        </div>

        <div class="flex items-center space-x-8">
            <div class="flex items-center space-x-3 hidden lg:flex">
                <div class="text-orange-500">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <div>
                    <div class="font-bold text-sm">Giao Hàng Miễn Phí</div>
                    <div class="text-gray-400 text-xs">Phạm vi toàn quốc</div>
                </div>
            </div>
            <div class="flex items-center space-x-3 hidden lg:flex">
                <div class="text-orange-500">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <div class="font-bold text-sm">Cam Kết Chính Hãng</div>
                    <div class="text-gray-400 text-xs">Đổi trả 30 ngày</div>
                </div>
            </div>
            <button class="text-gray-600 hover:text-red-500 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
            </button>
        </div>
    </div>

    <div class="bg-white border-t border-b border-gray-100 py-3 px-8 flex justify-between items-center sticky top-0 z-50 shadow-sm">
        <nav class="flex space-x-6 text-sm font-bold text-gray-800 items-center relative z-50">
            <a href="#" class="hover:text-[#8b3dff] py-2 transition-colors">Trang Chủ</a>
            <a href="#" class="hover:text-[#8b3dff] py-2 transition-colors">Giới Thiệu</a>

            <!-- Submenu Sản phẩm -->
            <div class="relative group">
                <a href="#" class="flex items-center hover:text-[#8b3dff] py-2 transition-colors cursor-pointer">
                    Sản Phẩm
                    <svg class="w-4 h-4 ml-1 transform group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </a>
                
                <div class="absolute left-0 top-full mt-2 w-64 bg-white border border-gray-100 shadow-xl rounded-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 overflow-visible transform origin-top scale-95 group-hover:scale-100">
                    
                    <!-- Nhánh Chó -->
                    <div class="relative group/sub">
                        <a href="#" class="flex items-center justify-between px-5 py-3 text-gray-700 hover:bg-[#e0d4fc] hover:text-[#8b3dff] transition-colors border-b border-gray-50">
                            Chó
                            <svg class="w-4 h-4 -rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </a>
                        
                        <!-- Nhánh con của Chó -->
                        <div class="absolute left-full top-0 ml-1 w-56 bg-white border border-gray-100 shadow-xl rounded-xl opacity-0 invisible group-hover/sub:opacity-100 group-hover/sub:visible transition-all duration-300 overflow-hidden transform origin-left scale-95 group-hover/sub:scale-100">
                            <a href="#" class="block px-5 py-3 text-gray-700 hover:bg-[#e0d4fc] hover:text-[#8b3dff] transition-colors border-b border-gray-50">Thức Ăn Cho Chó</a>
                            <a href="#" class="block px-5 py-3 text-gray-700 hover:bg-[#e0d4fc] hover:text-[#8b3dff] transition-colors border-b border-gray-50">Đồ Chơi Cho Chó</a>
                            <a href="#" class="block px-5 py-3 text-gray-700 hover:bg-[#e0d4fc] hover:text-[#8b3dff] transition-colors border-b border-gray-50">Quần Áo Cho Chó</a>
                            <a href="#" class="block px-5 py-3 text-gray-700 hover:bg-[#e0d4fc] hover:text-[#8b3dff] transition-colors border-b border-gray-50">Sữa Tắm Cho Chó</a>
                            <a href="#" class="block px-5 py-3 text-gray-700 hover:bg-[#e0d4fc] hover:text-[#8b3dff] transition-colors border-b border-gray-50 last:border-none">Phụ Kiện Khác</a>
                        </div>
                    </div>

                    <!-- Nhánh Mèo -->
                    <div class="relative group/sub">
                        <a href="#" class="flex items-center justify-between px-5 py-3 text-gray-700 hover:bg-[#e0d4fc] hover:text-[#8b3dff] transition-colors border-b border-gray-50">
                            Mèo
                            <svg class="w-4 h-4 -rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </a>
                        
                        <div class="absolute left-full top-0 ml-1 w-56 bg-white border border-gray-100 shadow-xl rounded-xl opacity-0 invisible group-hover/sub:opacity-100 group-hover/sub:visible transition-all duration-300 overflow-hidden transform origin-left scale-95 group-hover/sub:scale-100">
                            <a href="#" class="block px-5 py-3 text-gray-700 hover:bg-[#e0d4fc] hover:text-[#8b3dff] transition-colors border-b border-gray-50">Thức Ăn Cho Mèo</a>
                            <a href="#" class="block px-5 py-3 text-gray-700 hover:bg-[#e0d4fc] hover:text-[#8b3dff] transition-colors border-b border-gray-50">Cát Vệ Sinh</a>
                            <a href="#" class="block px-5 py-3 text-gray-700 hover:bg-[#e0d4fc] hover:text-[#8b3dff] transition-colors border-b border-gray-50">Đồ Chơi, Bàn Cào</a>
                            <a href="#" class="block px-5 py-3 text-gray-700 hover:bg-[#e0d4fc] hover:text-[#8b3dff] transition-colors border-b border-gray-50 last:border-none">Phụ Kiện Khác</a>
                        </div>
                    </div>

                    <a href="#" class="block px-5 py-3 text-gray-700 hover:bg-[#e0d4fc] hover:text-[#8b3dff] transition-colors border-b border-gray-50">Chim</a>
                    <a href="#" class="block px-5 py-3 text-gray-700 hover:bg-[#e0d4fc] hover:text-[#8b3dff] transition-colors border-b border-gray-50">Cá Cảnh</a>
                    <a href="#" class="block px-5 py-3 text-gray-700 hover:bg-[#e0d4fc] hover:text-[#8b3dff] transition-colors border-b border-gray-50 last:border-none">Thú Cưng Khác</a>
                </div>
            </div>

            <!-- Dịch vụ thú cưng -->
            <div class="relative group">
                <a href="#" class="flex items-center hover:text-[#8b3dff] py-2 transition-colors cursor-pointer">
                    Dịch Vụ
                    <svg class="w-4 h-4 ml-1 transform group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </a>
                
                <div class="absolute left-0 top-full mt-2 w-56 bg-white border border-gray-100 shadow-xl rounded-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 overflow-hidden transform origin-top scale-95 group-hover:scale-100">
                    <a href="#" class="block px-5 py-3 text-gray-700 hover:bg-[#e0d4fc] hover:text-[#8b3dff] transition-colors border-b border-gray-50 last:border-none">Cắt Tỉa Lông (Grooming)</a>
                    <a href="#" class="block px-5 py-3 text-gray-700 hover:bg-[#e0d4fc] hover:text-[#8b3dff] transition-colors border-b border-gray-50 last:border-none">Chăm Sóc Sức Khỏe</a>
                    <a href="#" class="block px-5 py-3 text-gray-700 hover:bg-[#e0d4fc] hover:text-[#8b3dff] transition-colors border-b border-gray-50 last:border-none">Huấn Luyện Thú Cưng</a>
                </div>
            </div>

            <div class="relative group">
                <a href="#" class="flex items-center hover:text-[#8b3dff] py-2 transition-colors cursor-pointer">
                    Trang Khác
                    <svg class="w-4 h-4 ml-1 transform group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </a>
                
                <div class="absolute left-0 top-full mt-2 w-48 bg-white border border-gray-100 shadow-xl rounded-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 overflow-hidden transform origin-top scale-95 group-hover:scale-100">
                    <a href="#" class="block px-5 py-3 text-gray-700 hover:bg-[#e0d4fc] hover:text-[#8b3dff] transition-colors border-b border-gray-50 last:border-none">Hỏi Đáp (FAQ)</a>
                    <a href="#" class="block px-5 py-3 text-gray-700 hover:bg-[#e0d4fc] hover:text-[#8b3dff] transition-colors border-b border-gray-50 last:border-none">Đội Ngũ</a>
                    <a href="#" class="block px-5 py-3 text-gray-700 hover:bg-[#e0d4fc] hover:text-[#8b3dff] transition-colors border-b border-gray-50 last:border-none">Bộ Sưu Tập</a>
                    <a href="#" class="block px-5 py-3 text-gray-700 hover:bg-[#e0d4fc] hover:text-[#8b3dff] transition-colors border-b border-gray-50 last:border-none">Liên Hệ</a>
                </div>
            </div>

            <a href="#" class="hover:text-[#8b3dff] py-2 transition-colors">Blog Thú Cưng</a>
        </nav>
        <div class="font-bold text-sm text-gray-800">
            Hỗ trợ 24/7: <span class="text-orange-500">1800 1060</span>
        </div>
    </div>
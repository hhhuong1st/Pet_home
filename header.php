<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <div class="text-3xl font-bold text-gray-900">
            FSE Pet Shop
        </div>

        <div class="flex-1 max-w-2xl w-full relative">
            <input type="text" placeholder="Search" class="w-full bg-gray-100 text-gray-700 rounded-full py-3 px-6 pr-16 focus:outline-none">
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
                    <div class="font-bold text-sm">Free Shipping</div>
                    <div class="text-gray-400 text-xs">Details & Restrictions</div>
                </div>
            </div>
            <div class="flex items-center space-x-3 hidden lg:flex">
                <div class="text-orange-500">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <div class="font-bold text-sm">100% Satisfaction</div>
                    <div class="text-gray-400 text-xs">30 Days no hassle</div>
                </div>
            </div>
            <button class="text-gray-600 hover:text-red-500 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
            </button>
        </div>
    </div>

    <div class="bg-white border-t border-b border-gray-100 py-3 px-8 flex justify-between items-center sticky top-0 z-50">
        <nav class="flex space-x-6 text-sm font-bold text-gray-800">
            <a href="#" class="hover:text-[#8b3dff]">Home</a>
            <a href="#" class="hover:text-[#8b3dff]">About Us</a>
            <a href="#" class="hover:text-[#8b3dff]">Services</a>
            <a href="#" class="hover:text-[#8b3dff]">Page</a>
            <a href="#" class="hover:text-[#8b3dff]">Blog</a>
            <a href="#" class="hover:text-[#8b3dff]">Buy Now</a>
        </nav>
        <div class="font-bold text-sm text-gray-800">
            24/7 Support: <span class="text-orange-500">(+00) 123 456 789</span>
        </div>
    </div>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo is_single() ? wp_trim_words(get_the_excerpt(), 20) : 'Phòng khám thú y & Pet Shop. Cung cấp thức ăn, phụ kiện, dịch vụ chăm sóc thú cưng uy tín, chất lượng nhất.'; ?>">
    <meta name="robots" content="index, follow">

    <!-- Thẻ Open Graph (Chuẩn SEO Facebook, Zalo, mạng xã hội) -->
    <meta property="og:title" content="<?php wp_title('|', true, 'right'); bloginfo('name'); ?>">
    <meta property="og:description" content="Phòng khám thú y & Pet Shop - Điểm đến tin cậy cho thú cưng của bạn.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo home_url('/'); ?>">

    <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Tùy chỉnh một số hình dạng đặc biệt trong thiết kế */
        .blob-shape {
            border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
        }
        body { background-color: #fff6ef; } /* Màu nền cam nhạt */
        /* Phục hồi định dạng văn bản trong tab Mô tả sản phẩm & Bài viết */
        #tab-description h2, .hentry h2 { font-size: 1.8rem; font-weight: bold; color: #8b3dff; margin: 1.5rem 0 1rem; }
        #tab-description h3, .hentry h3 { font-size: 1.4rem; font-weight: bold; color: #ff7a21; margin: 1.2rem 0 0.8rem; }
        #tab-description ul, .hentry ul { list-style-type: disc; padding-left: 2rem; margin-bottom: 1rem; }
        #tab-description p, .hentry p { margin-bottom: 1rem; line-height: 1.7; }
        
        /* Hiệu ứng cho đường Link */
        #tab-description a, .hentry a { color: #8b3dff; text-decoration: underline; font-weight: 600; transition: color 0.3s ease; }
        #tab-description a:hover, .hentry a:hover { color: #ff7a21; }
        
        /* Chỉnh sửa giao diện Bình luận mặc định của WP */
        ol.comment-list { list-style: none; padding: 0; margin: 0; }
        ol.comment-list li.comment { border-bottom: 1px solid #f3f4f6; padding-bottom: 2rem; margin-bottom: 2rem; }
        ol.comment-list li.comment:last-child { border-bottom: none; }
        .comment-body { display: flex; flex-direction: column; }
        @media (min-width: 640px) { .comment-body { flex-direction: row; gap: 1.5rem; } }
        .comment-author.vcard { flex-shrink: 0; text-align: center; margin-bottom: 1rem; }
        .comment-author.vcard img { border-radius: 50%; width: 56px; height: 56px; border: 2px solid white; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); display: inline-block; }
        .comment-author.vcard cite { font-style: normal; font-weight: 700; color: #1f2937; display: block; margin-top: 0.5rem; }
        .comment-meta { font-size: 0.875rem; color: #6b7280; margin-bottom: 1rem; }
        .comment-meta a { color: #8b3dff; text-decoration: none; font-weight: 500; }
        .comment-content { color: #4b5563; line-height: 1.6; background: #fafafa; padding: 1.5rem; border-radius: 1.5rem; border: 1px solid #f3f4f6; position: relative; }
        .reply a { display: inline-flex; align-items: center; justify-content: center; margin-top: 1rem; font-size: 0.875rem; color: #ff7a21; font-weight: 700; background: #fff1eb; padding: 0.5rem 1rem; border-radius: 9999px; transition: all 0.2s; text-decoration: none; }
        .reply a:hover { background: #ff7a21; color: white; transform: translateY(-1px); }
        ul.children { list-style: none; padding-left: 2rem; margin-top: 2rem; border-left: 2px dashed #e5e7eb; }
    </style>
    <?php wp_head(); ?>
</head>
<body <?php body_class('text-gray-800 font-sans min-h-screen'); ?>>

<header>
    <div class="bg-white py-4 px-8 flex flex-col md:flex-row justify-between items-center gap-4">
        <a href="<?php echo home_url('/'); ?>" class="flex items-center hover:opacity-80 transition-opacity" style="height: 80px;">
            <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="Pet Shop Logo" style="height: 80px; width: auto; object-fit: contain; position: relative; z-index: 10;">
            <div style="height: 80px; display: flex; align-items: center; margin-left: -25px; margin-right: 15px;">
                <img src="<?php echo get_template_directory_uri(); ?>/images/logo_1.png" alt="Pet Home Text Logo" style="height: 250px; width: auto; max-width: none; object-fit: contain;">
            </div>
        </a>

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
            <a href="<?php echo home_url('/'); ?>" class="hover:text-[#8b3dff] py-2 transition-colors">Trang Chủ</a>
            <a href="#giothieu" class="hover:text-[#8b3dff] py-2 transition-colors">Giới Thiệu</a>

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

            <?php
            function pet_get_blog_url() {
                $posts_page_id = get_option('page_for_posts');
                if ($posts_page_id) {
                    return get_permalink($posts_page_id);
                }
                
                // create or get category 'tin-tuc' to serve as backup link
                $cat = get_term_by('slug', 'tin-tuc', 'category');
                if (!$cat) {
                    wp_insert_term('Tin tức', 'category', ['slug' => 'tin-tuc']);
                    $cat = get_term_by('slug', 'tin-tuc', 'category');
                }
                if ($cat && !is_wp_error($cat)) {
                    return get_term_link($cat);
                }
                
                return home_url('/?post_type=post');
            }
            ?>
            <a href="<?php echo esc_url(pet_get_blog_url()); ?>" class="hover:text-[#8b3dff] py-2 transition-colors">Blog Thú Cưng</a>
        </nav>
        <div class="font-bold text-sm text-gray-800">
            Hỗ trợ 24/7: <a href="tel:18001060" class="text-orange-500 hover:underline">1800 1060</a>
        </div>
    </div>
</header>
<main id="main-content">
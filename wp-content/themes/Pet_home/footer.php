</main>
<footer class="bg-[#ff7a21] text-white pt-16">
        <div class="max-w-7xl mx-auto px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 pb-12">
            
            <div class="space-y-4">
                <a href="<?php echo home_url('/'); ?>" class="flex items-center hover:opacity-80 transition-opacity pb-2">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="Pet Shop Logo" class="h-20 max-h-24 w-auto object-contain relative z-10 bg-white border-2 border-white rounded-2xl p-1.5">
                    
                </a>
                <p class="text-white/90 leading-relaxed text-sm">
                    Chúng tôi tự hào là hệ thống chăm sóc và cung cấp sản phẩm thú cưng uy tín nhất. Mang đến những sản phẩm thức ăn, đồ chơi, phụ kiện chính hãng, cùng các dịch vụ spa, grooming chất lượng cao cho thú cưng của bạn.
                </p>
            </div>

            <div>
                <h3 class="text-xl font-bold mb-6">Liên Kết Nhanh</h3>
                <ul class="space-y-3 text-white/90 text-sm">
                    <li><a href="#" class="hover:text-purple-200 transition">Giới Thiệu</a></li>
                    <li><a href="#" class="hover:text-purple-200 transition">Dịch Vụ</a></li>
                    <li><a href="#" class="hover:text-purple-200 transition">Hỏi Đáp (FAQ)</a></li>
                    <li><a href="#" class="hover:text-purple-200 transition">Blog Thú Cưng</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-xl font-bold mb-6">Liên Hệ</h3>
                <ul class="space-y-4 text-white/90 text-sm">
                    <li>123 Đường Pets, Cầu Giấy, Hà Nội</li>
                    <li>1800 1060</li>
                    <li>cskh@petshop.com</li>
                </ul>
            </div>

            <div>
                <h3 class="text-xl font-bold mb-6">Hình Ảnh Nổi Bật</h3>
                <div class="grid grid-cols-2 gap-3">
                    <img src="https://images.unsplash.com/photo-1628009368231-7bb7cfcb0def?w=150&h=100&fit=crop" class="rounded-lg object-cover w-full h-16 shadow-md" alt="Chú chó tươi vui tại siêu thị thú cưng">
                    <img src="https://images.unsplash.com/photo-1548199973-03cce0bbc87b?w=150&h=100&fit=crop" class="rounded-lg object-cover w-full h-16 shadow-md" alt="Mèo con với đồ chơi thú cưng">
                    <img src="https://images.unsplash.com/photo-1583337130417-3346a1be7dee?w=150&h=100&fit=crop" class="rounded-lg object-cover w-full h-16 shadow-md" alt="Các dòng sản phẩm chăm sóc chó mèo cao cấp">
                    <img src="https://images.unsplash.com/photo-1517849845537-4d257902454a?w=150&h=100&fit=crop" class="rounded-lg object-cover w-full h-16 shadow-md" alt="Dịch vụ spa và grooming cho thú y chuyên nghiệp">
                </div>
            </div>
        </div>

        <div class="bg-[#8b3dff] py-6 text-center font-bold text-sm">
            &copy; 2024 Pet Shop. Đã đăng ký bản quyền.
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
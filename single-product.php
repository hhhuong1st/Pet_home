<?php
/**
 * The Template for displaying all single products
 */

get_header(); ?>
<div class="container mx-auto px-4 py-8 max-w-[1200px] font-sans">
    <?php while ( have_posts() ) : the_post(); 
        global $product;
    ?>
    <!-- Breadcrumb -->
    <div class="text-[13px] text-gray-500 mb-6 flex items-center flex-wrap gap-2">
        <a href="<?php echo home_url(); ?>" class="hover:text-[#8b3dff] transition">Trang Chủ</a>
        <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <?php 
            $terms = get_the_terms($post->ID, 'product_cat');
            if ($terms && !is_wp_error($terms)) {
                echo '<a href="'.get_term_link($terms[0]).'" class="hover:text-[#8b3dff] transition">'.$terms[0]->name.'</a>';
                echo '<svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>';
            }
        ?>
        <span class="text-gray-700 font-medium"><?php the_title(); ?></span>
    </div>

    <!-- Product Container -->
    <div class="flex flex-col md:flex-row gap-10 md:gap-14 bg-white rounded-2xl md:p-8">
        
        <!-- Cột trái: Hình ảnh -->
        <div class="w-full md:w-5/12 lg:w-4/12 flex-shrink-0 relative">
            <div class="sticky top-28">
                <style>
                    /* Ép ảnh sản phẩm nguyên bản của Woo ra giữa */
                    .woocommerce-product-gallery { margin: 0 auto !important; float: none !important; width: 100% !important; text-align: center; }
                    .woocommerce-product-gallery__wrapper { display: flex; justify-content: center; width: 100%; transition: none !important; }
                    .woocommerce-product-gallery__image { width: 100%; display: flex; justify-content: center; }
                    .woocommerce-product-gallery__image img { margin: 0 auto; display: block !important; max-height: 500px; width: auto !important; object-fit: contain; }
                    .flex-viewport { direction: ltr; }
                </style>
                <div class="rounded-2xl bg-white p-2 flex justify-center items-center" style="max-height: auto; min-height: 300px;">
                    <?php 
                        // Sử dụng hook hiển thị ảnh mặc định của WooCommerce để hỗ trợ slider và zoom chính chủ
                        do_action( 'woocommerce_before_single_product_summary' );
                    ?>
                </div>
            </div>
        </div>

        <!-- Cột phải: Thông tin (Tương tự thiết kế yêu cầu) -->
        <div class="w-full md:w-7/12 lg:w-8/12 flex flex-col">
            <h1 class="text-2xl md:text-[26px] font-bold mb-3 text-[#8b3dff]" style="line-height: 1.4;">
                <?php the_title(); ?>
            </h1>
            
            <div class="flex items-center gap-2 mb-4">
                <?php 
                    $rating_count = $product->get_rating_count();
                    $review_count = $product->get_review_count();
                    $average      = $product->get_average_rating() ?: 5; // Fake 5 sao mặc định cho đẹp nếu chưa có
                ?>
                <div class="flex text-[#ff7a21] text-sm">
                    <?php for ($i=1; $i<=5; $i++) {
                        if ($i <= intval($average)) echo '<svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>';
                        else echo '<svg class="w-4 h-4 text-gray-200 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>';
                    } ?>
                </div>
                <span class="text-sm text-gray-600"><?php echo $review_count > 0 ? $review_count : '6'; ?> đánh giá</span>
            </div>

            <!-- Đoạn trích (Mô tả ngắn) -->
            <?php if ( $post->post_excerpt ) : ?>
                <div class="text-[13px] text-gray-600 leading-relaxed mb-4 border-b border-gray-100 pb-4">
                    <?php echo apply_filters('woocommerce_short_description', $post->post_excerpt); ?>
                </div>
            <?php endif; ?>

            <!-- Thương hiệu -->
            <?php 
                $brands = wc_get_product_terms($post->ID, 'pa_thuong-hieu', ['fields'=>'names']);
                $brand_name = !empty($brands) ? $brands[0] : 'Royal Canin'; // Fake demo brand
            ?>
            <div class="mb-4 text-[15px] text-gray-700 flex items-center">
                <span class="text-gray-500 mr-2 w-28">Thương hiệu:</span> 
                <span class="font-medium text-gray-800"><?php echo $brand_name; ?></span>
            </div>

            <!-- Giá -->
            <div class="text-[22px] font-bold text-gray-900 mb-6 flex items-end gap-3 mt-2">
                <?php echo $product->get_price_html(); ?>
            </div>

            <?php if ( $product->is_type( 'variable' ) ) : ?>
                <!-- Form mua hàng cho sản phẩm có biến thể -->
                <?php woocommerce_variable_add_to_cart(); ?>
            <?php else : ?>
                <!-- Form Form mua hàng cho sản phẩm đơn giản theo giao diện -->
                <form class="cart flex flex-col pt-2" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
                    
                    <!-- Giả lập UI Sizes nếu cần (Không xử lý biến thể ở backend, chỉ mockup hoặc dùng default WP) -->
                    <div class="mb-6 flex flex-col gap-3">
                        <span class="font-medium text-[15px] text-gray-800 w-28">Size: <span class="font-normal text-gray-500 ml-1">400g</span></span>
                        <div class="flex flex-wrap gap-2">
                            <button type="button" class="border-2 border-[#8b3dff] text-gray-800 rounded px-5 py-2 text-sm font-medium transition cursor-pointer">400g</button>
                            <button type="button" class="border border-gray-200 text-gray-800 rounded px-5 py-2 text-sm font-medium hover:border-[#8b3dff] hover:text-[#8b3dff] transition cursor-pointer">2kg</button>
                            <button type="button" class="border border-gray-200 text-gray-800 rounded px-5 py-2 text-sm font-medium hover:border-[#8b3dff] hover:text-[#8b3dff] transition cursor-pointer">4kg</button>
                            <button type="button" class="border border-gray-200 text-gray-800 rounded px-5 py-2 text-sm font-medium hover:border-[#8b3dff] hover:text-[#8b3dff] transition cursor-pointer">10kg</button>
                            <button type="button" class="border border-gray-200 text-gray-400 rounded px-5 py-2 text-sm font-medium cursor-not-allowed opacity-50 relative overflow-hidden group">
                                Túi Chia 1kg
                                <div class="absolute inset-0 w-full h-[1px] bg-red-400 rotate-[-15deg] group-hover:rotate-[-20deg] top-1/2 scale-150 transition-transform"></div>
                            </button>
                        </div>
                    </div>

                    <!-- Số lượng -->
                    <div class="mb-6 flex flex-col gap-3">
                        <span class="font-medium text-[15px] text-gray-800 w-28">Số Lượng:</span>
                        <div class="flex items-center border border-gray-300 rounded-full w-[120px] h-11 overflow-hidden shrink-0">
                            <button type="button" class="px-3 hover:bg-gray-100 h-full text-gray-500 w-11 minus-btn text-xl transition-colors" onclick="let input=this.nextElementSibling; if(input.value>1) { input.value--; input.dispatchEvent(new Event('change'));}">−</button>
                            <input type="number" id="quantity_<?php echo uniqid(); ?>" class="input-text qty text w-full text-center h-full border-none focus:ring-0 text-[15px] font-medium p-0" step="1" min="1" max="" name="quantity" value="1" title="Qty" size="4" placeholder="" inputmode="numeric" />
                            <button type="button" class="px-3 hover:bg-gray-100 h-full text-gray-500 w-11 plus-btn text-xl transition-colors" onclick="let input=this.previousElementSibling; input.value++; input.dispatchEvent(new Event('change'));">+</button>
                        </div>
                    </div>

                    <!-- Tóm tắt tổng tiền -->
                    <div class="mb-6">
                        <span class="font-medium text-[15px] text-gray-800">Tổng số tiền:</span>
                        <span class="font-bold text-[16px] text-gray-900 ml-2" id="total-price-preview"><?php echo wc_price($product->get_price()); ?></span>
                    </div>

                    <!-- Nút mua hàng / Yêu thích / Chia sẻ -->
                    <div class="flex items-center gap-3">
                        <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="flex-1 bg-[#8b3dff] hover:bg-[#ff7a21] text-white font-bold text-[15px] h-12 px-6 rounded-full transition-colors text-center w-full max-w-[400px] shadow-lg shadow-[#8b3dff]/30 hover:shadow-[#ff7a21]/30">
                            Thêm Vào Giỏ Hàng
                        </button>
                        
                        <button type="button" class="w-12 h-12 rounded-full border border-gray-300 flex items-center justify-center text-gray-500 hover:text-red-500 hover:border-red-500 transition-colors shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </button>
                        <button type="button" class="w-12 h-12 rounded-full border border-gray-300 flex items-center justify-center text-gray-500 hover:text-[#8b3dff] hover:border-[#8b3dff] transition-colors shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-5.368m0 5.368l5.662 3.397m-5.662-3.397l5.662-3.397m0 6.794a3 3 0 100-5.368m0 5.368a3 3 0 110-5.368"></path></svg>
                        </button>
                    </div>
                </form>
            <?php endif; ?>

            <!-- Thông tin vận chuyển -->
            <div class="mt-8 space-y-4">
                <div class="flex items-start gap-4">
                    <svg class="w-[22px] h-[22px] text-gray-700 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                    <div>
                        <div class="font-medium text-[13px] text-gray-800 flex items-center mb-1">
                            Miễn Phí Vận Chuyển 
                            <span class="bg-gray-300 text-white text-[10px] w-[14px] h-[14px] inline-flex items-center justify-center rounded-full ml-1 cursor-pointer font-bold">?</span>
                        </div>
                        <div class="text-[12px] text-gray-500">Tối đa 30K cho đơn hàng từ 500K</div>
                        <div class="text-[12px] text-gray-500 mt-1">Hoả tốc 4h trong nội thành HCM</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    <!-- Tab Mô tả -->
    <div class="mt-12 bg-white rounded-2xl p-6 md:p-10 shadow-sm border border-gray-50 mb-10" id="tab-description">
        <div class="flex items-center gap-3 mb-6 border-b border-gray-100 pb-4">
            <h2 class="text-xl md:text-[22px] font-bold text-[#8b3dff]">Mô tả sản phẩm</h2>
            <div class="h-1 flex-1 bg-gradient-to-r from-[#ffe4d1] to-transparent rounded-full ml-4 hidden md:block"></div>
        </div>
        
        <div class="text-gray-700 leading-relaxed text-[15px] max-w-full">
            <?php 
                // Xuất nội dung thô có format chữ để ngăn chặn the_content() re-render giao diện Woo mặc định cũ
                $content = $post->post_content;
                echo wpautop(do_shortcode($content)); 
            ?>
        </div>
    </div>

    <?php endwhile; ?>
</div>

<script>
    // Cập nhật giá tổng khi đổi số lượng
    document.addEventListener('DOMContentLoaded', function() {
        const qtyInputs = document.querySelectorAll('.qty');
        const priceElement = document.querySelector('#total-price-preview');
        const rawPriceValue = <?php echo $product->get_price() ? floatval($product->get_price()) : 0; ?>;
        
        <?php 
           $currency = get_woocommerce_currency_symbol();
           $format = get_woocommerce_price_format(); // eg: '%1$s%2$s' or '%2$s %1$s'
        ?>
        const curSymbol = "<?php echo $currency; ?>";

        function updatePrice() {
            if(qtyInputs.length === 0 || !priceElement) return;
            let qty = qtyInputs[0].value;
            let total = parseFloat(qty) * rawPriceValue;
            
            // Format vnđ
            let formattedTotal = new Intl.NumberFormat('vi-VN').format(total);
            
            // Re-construct woo format
            // Thay the span de cho HTML dep nhat
            priceElement.innerHTML = '<span class="woocommerce-Price-amount amount"><bdi>' + formattedTotal + '<span class="woocommerce-Price-currencySymbol"> ' + curSymbol + '</span></bdi></span>';
        }

        qtyInputs.forEach(input => {
            input.addEventListener('change', updatePrice);
        });
    });
</script>

<?php get_footer(); ?>

<?php
/**
 * Pet Shop Theme Functions
 */

// Thiết lập cấu trúc permalink mặc định là /tin-tuc/%postname%/ nếu chưa được đặt
// Lưu ý: Trong thực tế, bạn nên chỉnh trong Admin > Settings > Permalinks để ổn định nhất.
// Các tác vụ cấu hình chỉ chạy một lần khi kích hoạt theme để tối ưu tốc độ
function pet_shop_activation_logic() {
    $current_structure = get_option('permalink_structure');
    if ($current_structure !== '/tin-tuc/%postname%/') {
        update_option('permalink_structure', '/tin-tuc/%postname%/');
    }
    
    // Thiết lập YITH Wishlist
    update_option('yith_wcwl_wishlist_page_id', 0);
    
    // Ép buộc thiết lập WooCommerce
    update_option('woocommerce_enable_guest_checkout', 'yes');
    update_option('woocommerce_enable_checkout_login_reminder', 'no');
    
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'pet_shop_activation_logic');

// Hỗ trợ giao diện
function pet_shop_setup() {
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('menus');
    // Khai báo hỗ trợ WooCommerce để WordPress chịu đọc file trong folder woocommerce/
    add_theme_support('woocommerce', array(
        'thumbnail_image_width' => 600,
        'single_image_width'    => 900,
        'product_grid'          => array(
            'default_rows'    => 3,
            'min_rows'        => 1,
            'default_columns' => 4,
            'min_columns'     => 1,
            'max_columns'     => 6,
        ),
    ));
}
add_action('after_setup_theme', 'pet_shop_setup');

// Làm mới đường dẫn sản phẩm để tránh lỗi 404 hoặc không nhận danh mục
function refresh_shop_permalinks() {
    flush_rewrite_rules();
}
add_action('init', 'refresh_shop_permalinks', 99);

// Đảm bảo WooCommerce nhận diện đúng các file template trong theme
add_filter( 'woocommerce_template_loader_priority', function(){ return 99; } );

// Ép buộc WordPress sử dụng template sản phẩm nếu đường dẫn có chứa 'danh-muc-san-pham'
function force_product_cat_template($template) {
    if ( is_tax('product_cat') || strpos($_SERVER['REQUEST_URI'], 'danh-muc-san-pham') !== false ) {
        $new_template = locate_template( array( 'taxonomy-product_cat.php', 'archive-product.php' ) );
        if ( '' != $new_template ) {
            return $new_template;
        }
    }
    return $template;
}
add_filter( 'template_include', 'force_product_cat_template', 99 );

/**
 * Tự động tạo mục lục (Danh mục tóm tắt) và gán ID cho thẻ Heading trong nội dung (Bao gồm mô tả sản phẩm)
 */
function add_toc_and_ids_to_content($content) {
    if (!is_singular(array('post', 'product'))) return $content;
    
    // Tìm tất cả các thẻ H2 và H3 (thêm cờ is để khớp cả khi có ngắt dòng và không phân biệt hoa thường)
    preg_match_all('/<h([23])(.*?)>(.*?)<\/h\1>/is', $content, $matches);
    
    if (!empty($matches[3])) {
        // Tạo HTML cho mục lục
        $toc = '<div class="toc-container bg-[#fff6ef] p-6 rounded-2xl mb-8 border border-[#ff7a21]/20">';
        $toc .= '<h3 class="text-[18px] font-black text-[#ff7a21] mb-4 uppercase tracking-wider">Danh mục tóm tắt</h3>';
        $toc .= '<ul class="space-y-3 font-bold text-gray-700 list-none p-0 m-0">';
        
        foreach ($matches[3] as $index => $heading) {
            $clean_heading = strip_tags($heading);
            $slug = sanitize_title($clean_heading) . '-' . $index;
            // Dịch lề cho H3 để tạo phân cấp (H3 lùi vào so với H2)
            $padding_class = ($matches[1][$index] == '3') ? 'ml-4 font-semibold text-[15px]' : '';
            $toc .= '<li class="flex items-start gap-2 ' . $padding_class . '"><svg class="w-5 h-5 text-[#8b3dff] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg><a href="#' . $slug . '" class="hover:text-[#8b3dff] transition-colors">' . $clean_heading . '</a></li>';
        }
        $toc .= '</ul></div>';
        
        // Thêm ID vào các thẻ
        $index = 0;
        $content = preg_replace_callback('/<h([23])(.*?)>(.*?)<\/h\1>/is', function($matches) use (&$index) {
            $clean_heading = strip_tags($matches[3]);
            $slug = sanitize_title($clean_heading) . '-' . $index;
            $index++;
            return '<h' . $matches[1] . $matches[2] . ' id="' . $slug . '" style="scroll-margin-top: 100px;">' . $matches[3] . '</h' . $matches[1] . '>';
        }, $content);
        
        // Nối mục lục lên đầu đoạn nội dung
        $content = $toc . $content;
    }
    
    return $content;
}
add_filter('the_content', 'add_toc_and_ids_to_content', 20);

/**
 * TẠO SHORTCODE GIỎ HÀNG PREMIUM CHO PET SHOP
 */
function pet_shop_custom_cart_shortcode() {
    if ( ! class_exists( 'WooCommerce' ) ) {
        return '<p>Vui lòng cài đặt và kích hoạt WooCommerce.</p>';
    }

    $cart = WC()->cart;
    if ( is_null( $cart ) || ! method_exists( $cart, 'is_empty' ) ) {
        return '';
    }
    ob_start();
    ?>
    <div id="pet-shop-cart-container" class="pet-shop-cart-content py-10">
        <?php if ( $cart->is_empty() ) : ?>
            <div class="text-center py-20 bg-gray-50 rounded-[40px] border-2 border-dashed border-gray-200">
                <div class="text-7xl mb-6">🛒</div>
                <h2 class="text-2xl font-black text-gray-800 mb-4">Giỏ hàng của bạn đang trống!</h2>
                <p class="text-gray-500 mb-8 max-w-sm mx-auto">Có vẻ như bạn chưa chọn được món đồ nào cho Boss. Hãy quay lại cửa hàng để chọn lọc những sản phẩm tốt nhất nhé.</p>
                <a href="<?php echo wc_get_page_permalink( 'shop' ); ?>" class="inline-block bg-[#8b3dff] text-white font-bold py-4 px-10 rounded-full hover:bg-[#ff7a21] transition-all shadow-xl shadow-[#8b3dff]/20">Bắt Đầu Mua Sắm</a>
            </div>
        <?php else : ?>
            <div class="flex flex-col lg:flex-row gap-10">
                <!-- Danh sách sản phẩm -->
                <div class="lg:w-2/3 space-y-6">
                    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-50 flex justify-between items-center bg-gray-50/50">
                            <h3 class="font-bold text-gray-900 text-lg">Sản phẩm (<?php echo $cart->get_cart_contents_count(); ?>)</h3>
                            <button onclick="if(confirm('Xóa sạch giỏ hàng?')) window.location.href='<?php echo esc_url(wc_get_cart_url()); ?>?empty-cart=1'" class="text-xs font-bold text-gray-400 hover:text-red-500 transition-colors uppercase tracking-wider">Xóa toàn bộ</button>
                        </div>
                        <div class="divide-y divide-gray-100">
                            <?php 
                            foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) : 
                                $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                                
                                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) :
                                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                            ?>
                                <div class="p-6 flex flex-col sm:flex-row items-center gap-6 group hover:bg-gray-50/50 transition-colors">
                                    <!-- Ảnh sản phẩm -->
                                    <div class="w-24 h-24 flex-shrink-0 bg-gray-100 rounded-2xl overflow-hidden shadow-sm">
                                        <?php 
                                        $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                                        if ( ! $product_permalink ) {
                                            echo $thumbnail;
                                        } else {
                                            printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
                                        }
                                        ?>
                                    </div>

                                    <!-- Thông tin sản phẩm -->
                                    <div class="flex-grow text-center sm:text-left">
                                        <h4 class="font-bold text-gray-900 mb-1 hover:text-[#8b3dff] transition-colors">
                                            <?php 
                                            if ( ! $product_permalink ) {
                                                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                                            } else {
                                                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                                            }
                                            ?>
                                        </h4>
                                        <p class="text-[#ff7a21] font-black text-lg">
                                            <?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?>
                                        </p>
                                    </div>

                                    <!-- Số lượng -->
                                    <div class="flex items-center bg-gray-100 rounded-xl p-1 px-2 border border-gray-200">
                                        <button class="w-8 h-8 flex items-center justify-center font-bold text-gray-500 hover:text-[#8b3dff] transition-colors quantity-btn minus" data-key="<?php echo $cart_item_key; ?>" data-current="<?php echo $cart_item['quantity']; ?>">−</button>
                                        <span class="w-10 text-center font-black text-gray-900"><?php echo $cart_item['quantity']; ?></span>
                                        <button class="w-8 h-8 flex items-center justify-center font-bold text-gray-500 hover:text-[#8b3dff] transition-colors quantity-btn plus" data-key="<?php echo $cart_item_key; ?>" data-current="<?php echo $cart_item['quantity']; ?>">+</button>
                                    </div>

                                    <!-- Xóa -->
                                    <button class="p-3 text-gray-300 hover:text-red-500 transition-colors remove-cart-item" data-key="<?php echo $cart_item_key; ?>">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            <?php 
                                endif;
                            endforeach; 
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Tóm tắt đơn hàng -->
                <div class="lg:w-1/3">
                    <div class="bg-white rounded-[32px] p-8 border border-gray-100 shadow-xl sticky top-32">
                        <h3 class="text-2xl font-black text-gray-900 mb-8 flex items-center gap-2">
                            Tóm tắt đơn hàng <span class="text-[#ff7a21]">📋</span>
                        </h3>
                        
                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between text-gray-500 font-bold">
                                <span>Tạm tính:</span>
                                <span class="text-gray-900"><?php echo $cart->get_cart_subtotal(); ?></span>
                            </div>
                            <div class="flex justify-between text-gray-500 font-bold">
                                <span>Phí vận chuyển:</span>
                                <span class="text-green-500">Miễn phí 🐾</span>
                            </div>
                        </div>

                        <div class="mb-8 p-4 bg-gray-50 rounded-2xl flex gap-3">
                            <input type="text" placeholder="Mã giảm giá..." class="flex-grow bg-transparent text-sm font-bold focus:outline-none px-2 border-b-2 border-transparent focus:border-[#8b3dff] transition-all">
                            <button class="bg-[#8b3dff]/10 text-[#8b3dff] font-extrabold px-4 py-2 rounded-xl text-xs hover:bg-[#8b3dff] hover:text-white transition-all">ÁP DỤNG</button>
                        </div>

                        <div class="border-t border-dashed border-gray-200 pt-6 mb-8">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold text-gray-900">Tổng cộng:</span>
                                <span class="text-3xl font-black text-[#ff7a21]"><?php echo $cart->get_cart_total(); ?></span>
                            </div>
                        </div>

                        <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="block w-full text-center bg-[#8b3dff] text-white font-black py-5 rounded-[22px] hover:bg-[#ff7a21] transition-all shadow-xl shadow-[#8b3dff]/20 hover:shadow-[#ff7a21]/20 transform hover:-translate-y-1">
                            Tiến Hành Thanh Toán
                        </a>
                        
                        <div class="mt-6 flex items-center justify-center gap-2 text-xs text-gray-400 font-bold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            Thanh toán an toàn & bảo mật
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('gio_hang_pet_shop', 'pet_shop_custom_cart_shortcode');

/**
 * Empty cart logic
 */
add_action('init', 'pet_shop_empty_cart_action');
function pet_shop_empty_cart_action() {
    if (isset($_GET['empty-cart']) && $_GET['empty-cart'] == '1') {
        if ( class_exists( 'WooCommerce' ) ) {
            WC()->cart->empty_cart();
            wp_redirect(remove_query_arg('empty-cart'));
            exit;
        }
    }
}

/**
 * Filter to update fragments (both count and custom cart)
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'pet_shop_cart_fragments', 10, 1 );
function pet_shop_cart_fragments( $fragments ) {
    // Fragment cho số lượng ở header (luôn cập nhật)
    ob_start();
    ?>
    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full cart-count">
        <?php echo WC()->cart->get_cart_contents_count(); ?>
    </span>
    <?php
    $fragments['span.cart-count'] = ob_get_clean();

    // Fragment cho nội dung giỏ hàng (chỉ cập nhật khi ở trang giỏ hàng hoặc có yêu cầu)
    // Điều này giúp tăng tốc độ thêm vào giỏ hàng ở các trang danh sách
    if ( is_cart() || (defined('DOING_AJAX') && DOING_AJAX) ) {
        $fragments['div#pet-shop-cart-container'] = pet_shop_custom_cart_shortcode();
    }
    
    return $fragments;
}

/**
 * AJAX Update Cart Quantity Handler
 */
add_action('wp_ajax_update_cart_quantity', 'pet_shop_ajax_update_cart_quantity');
add_action('wp_ajax_nopriv_update_cart_quantity', 'pet_shop_ajax_update_cart_quantity');
function pet_shop_ajax_update_cart_quantity() {
    if (isset($_POST['cart_item_key']) && isset($_POST['quantity'])) {
        $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
        $quantity = intval($_POST['quantity']);
        
        if ($quantity > 0) {
            WC()->cart->set_quantity($cart_item_key, $quantity);
        } else {
            WC()->cart->remove_cart_item($cart_item_key);
        }
        
        WC_AJAX::get_refreshed_fragments();
    }
    wp_die();
}

/**
 * AJAX Remove Cart Item Handler
 */
add_action('wp_ajax_remove_cart_item', 'pet_shop_ajax_remove_cart_item');
add_action('wp_ajax_nopriv_remove_cart_item', 'pet_shop_ajax_remove_cart_item');
function pet_shop_ajax_remove_cart_item() {
    if (isset($_POST['cart_item_key'])) {
        $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
        WC()->cart->remove_cart_item($cart_item_key);
        WC_AJAX::get_refreshed_fragments();
    }
    wp_die();
}

/**
 * Enqueue WooCommerce scripts (AJAX)
 */
function pet_shop_enqueue_wc_scripts() {
    if ( class_exists( 'WooCommerce' ) ) {
        wp_enqueue_script( 'wc-add-to-cart' );
        wp_enqueue_script( 'wc-cart-fragments' );
    }
}
add_action( 'wp_enqueue_scripts', 'pet_shop_enqueue_wc_scripts' );

/**
 * Tối ưu hoá giỏ hàng: Vô hiệu hoá tự động làm mới Fragments trên mọi trang
 * Điều này ngăn chặn một request AJAX nặng chạy mỗi khi tải trang.
 */
function pet_shop_disable_cart_fragments_on_load() {
    if ( class_exists( 'WooCommerce' ) ) {
        wp_dequeue_script( 'wc-cart-fragments' );
    }
}
add_action( 'wp_enqueue_scripts', 'pet_shop_disable_cart_fragments_on_load', 999 );

/**
 * Xóa mục "Tệp tải xuống" trong trang My Account WooCommerce
 */
function pet_shop_remove_my_account_links( $menu_links ){
    unset( $menu_links['downloads'] );
    return $menu_links;
}
add_filter( 'woocommerce_account_menu_items', 'pet_shop_remove_my_account_links' );

/**
 * Cấu hình YITH WooCommerce Wishlist sang Tiếng Việt và bật chức năng Toggle (Nhấn lần 2 để bỏ thích)
 */
add_filter( 'yith_wcwl_button_label', function() { return 'Thêm vào yêu thích'; } );
add_filter( 'yith_wcwl_browse_wishlist_label', function() { return 'Xem danh sách yêu thích'; } );
add_filter( 'yith_wcwl_already_in_wishlist_text', function() { return 'Đã yêu thích'; } );
add_filter( 'yith_wcwl_remove_from_wishlist_label', function() { return 'Bỏ yêu thích'; } );

// Thiết lập mặc định behavior là 'remove' để nhấn lần 2 sẽ xóa khỏi danh sách
// add_action('init', 'pet_shop_set_yith_wishlist_options'); // Đã chuyển vào activation_logic để tăng tốc
function pet_shop_set_yith_wishlist_options() {
    if (get_option('yith_wcwl_after_add_to_wishlist_behaviour') !== 'remove') {
        update_option('yith_wcwl_after_add_to_wishlist_behaviour', 'remove');
    }
    if (get_option('yith_wcwl_wishlist_title') === 'My wishlist') {
        update_option('yith_wcwl_wishlist_title', 'Danh sách yêu thích');
    }
}

/**
 * Dịch toàn bộ các từ tiếng Anh còn sót lại của YITH Wishlist sang Tiếng Việt
 */
add_filter( 'gettext', 'pet_shop_translate_yith_wishlist', 999, 3 );
function pet_shop_translate_yith_wishlist( $translated, $text, $domain ) {
    if ( $domain === 'yith-woocommerce-wishlist' ) {
        switch ( $text ) {
            case 'Product name': return 'Tên sản phẩm';
            case 'Unit price': return 'Đơn giá';
            case 'Stock status': return 'Tình trạng';
            case 'In Stock': return 'Còn hàng';
            case 'Out of stock': return 'Hết hàng';
            case 'Share on:': return 'Chia sẻ lên:';
            case 'My wishlist': return 'Danh sách yêu thích';
            case '&ldquo;%1$s&rdquo; has been removed from your %2$s list!': return '&ldquo;%1$s&rdquo; đã được xóa khỏi %2$s!';
            case '&ldquo;%1$s&rdquo; has been added to your %2$s list!': return '&ldquo;%1$s&rdquo; đã được thêm vào %2$s!';
            case 'Product added!': return 'Đã thêm vào yêu thích!';
            case 'Product successfully removed.': return 'Đã xóa khỏi yêu thích.';
            case 'Remove': return 'Xóa';
            case 'Add to cart': return 'Thêm vào giỏ';
        }
    }
    return $translated;
}

/**
 * Thêm các tuỳ chọn vận chuyển động vào trang Thanh Toán
 */
add_filter( 'woocommerce_package_rates', 'pet_shop_custom_shipping_rates', 10, 2 );
function pet_shop_custom_shipping_rates( $rates, $package ) {
    // Thêm các tuỳ chọn mặc định
    $rates['flat_rate_standard'] = new WC_Shipping_Rate(
        'flat_rate_standard',
        'Giao Hàng Tiêu Chuẩn (2-3 ngày)',
        25000,
        array(),
        'flat_rate'
    );
    $rates['flat_rate_express'] = new WC_Shipping_Rate(
        'flat_rate_express',
        'Giao Hàng Hỏa Tốc (Trong 2H)',
        50000,
        array(),
        'flat_rate'
    );
    $rates['free_shipping_custom'] = new WC_Shipping_Rate(
        'free_shipping_custom',
        'Miễn Phí Vận Chuyển (Đơn từ 500k)',
        0,
        array(),
        'free_shipping'
    );
    
    // Logic miễn phí vận chuyển nếu đơn >= 500,000đ
    if ( WC()->cart->get_subtotal() >= 500000 ) {
        unset($rates['flat_rate_standard']); // Bỏ phí tiêu chuẩn
    } else {
        unset($rates['free_shipping_custom']); // Bỏ freeship nếu chưa đủ đk
    }

    return $rates;
}

/**
 * Bật phương thức Thanh toán khi nhận hàng (COD) và Xóa cache vận chuyển
 */
// add_action('init', 'pet_shop_force_checkout_settings'); // Đã chuyển vào activation_logic để tăng tốc
function pet_shop_force_checkout_settings() {
    // 1. Bật COD nếu chưa bật
    $cod_settings = get_option('woocommerce_cod_settings');
    if (empty($cod_settings) || !isset($cod_settings['enabled']) || $cod_settings['enabled'] !== 'yes') {
        $new_settings = array(
            'enabled' => 'yes',
            'title' => 'Thanh toán khi nhận hàng (COD)',
            'description' => 'Bạn sẽ thanh toán bằng tiền mặt khi nhân viên giao hàng đến.',
            'instructions' => 'Vui lòng chuẩn bị sẵn tiền mặt. Cảm ơn bạn!'
        );
        update_option('woocommerce_cod_settings', $new_settings);
    }
    
    // 2. Xóa Cache Vận chuyển để ép WooCommerce tải lại các phương thức vận chuyển mới
    if ( class_exists('WC_Cache_Helper') && isset($_GET['clear_shipping_cache']) ) {
        WC_Cache_Helper::get_transient_version( 'shipping', true );
    }
}

/**
 * Hàm hỗ trợ lấy Link Danh Mục Sản Phẩm Tự Động siêu an toàn
 */
function pet_shop_get_cat_url($slug, $name = '') {
    static $cat_url_cache = array();
    if (isset($cat_url_cache[$slug])) {
        return $cat_url_cache[$slug];
    }

    // 1. Tìm theo Slug
    $term = get_term_by('slug', $slug, 'product_cat');
    if ($term && !is_wp_error($term)) {
        $url = esc_url(get_term_link($term));
        $cat_url_cache[$slug] = $url;
        return $url;
    }
    
    // 2. Nếu không có Slug, thử tìm theo Tên (đề phòng user đổi slug)
    if (!empty($name)) {
        $term_by_name = get_term_by('name', $name, 'product_cat');
        if ($term_by_name && !is_wp_error($term_by_name)) {
            $url = esc_url(get_term_link($term_by_name));
            $cat_url_cache[$slug] = $url;
            return $url;
        }
        
        // 3. Nếu hoàn toàn chưa tồn tại, tự động tạo mới
        $new_term = wp_insert_term($name, 'product_cat', array('slug' => $slug));
        if (!is_wp_error($new_term) && isset($new_term['term_id'])) {
            // Xóa cache đường dẫn để tránh lỗi 404 Not Found
            flush_rewrite_rules(false);
            $url = esc_url(get_term_link((int)$new_term['term_id'], 'product_cat'));
            $cat_url_cache[$slug] = $url;
            return $url;
        }
    }
    
    // 4. Fallback dự phòng cuối cùng
    $url = home_url('/danh-muc-san-pham/' . $slug . '/');
    $cat_url_cache[$slug] = $url;
    return $url;
}

/**
 * Hàm hiển thị Breadcrumbs (Thanh điều hướng) chuẩn SEO + SCHEMA JSON-LD
 */
function pet_shop_breadcrumbs() {
    if (is_front_page()) return;

    $items = array();
    $items[] = array('name' => 'Trang chủ', 'url' => home_url('/'));

    if (is_shop() || is_post_type_archive('product')) {
        $items[] = array('name' => 'Cửa hàng', 'url' => get_post_type_archive_link('product'));
    } elseif (is_tax('product_cat')) {
        $term = get_queried_object();
        $items[] = array('name' => 'Cửa hàng', 'url' => get_post_type_archive_link('product'));
        $items[] = array('name' => $term->name, 'url' => get_term_link($term));
    } elseif (is_singular('product')) {
        $items[] = array('name' => 'Cửa hàng', 'url' => get_post_type_archive_link('product'));
        $terms = wp_get_post_terms(get_the_ID(), 'product_cat');
        if ($terms) {
            $items[] = array('name' => $terms[0]->name, 'url' => get_term_link($terms[0]));
        }
        $items[] = array('name' => get_the_title(), 'url' => get_permalink());
    } elseif (is_single()) {
        $cats = get_the_category();
        if ($cats) {
            $items[] = array('name' => $cats[0]->name, 'url' => get_category_link($cats[0]));
        }
        $items[] = array('name' => get_the_title(), 'url' => get_permalink());
    } elseif (is_page()) {
        $items[] = array('name' => get_the_title(), 'url' => get_permalink());
    } elseif (is_category()) {
        $items[] = array('name' => single_cat_title('', false), 'url' => get_category_link(get_queried_object_id()));
    }

    // Output HTML
    echo '<nav class="text-sm font-medium text-gray-500 mb-6 flex items-center gap-2 overflow-x-auto whitespace-nowrap pb-2 no-scrollbar" aria-label="Breadcrumb">';
    foreach ($items as $index => $item) {
        if ($index > 0) echo '<span class="text-gray-300">/</span>';
        if ($index === count($items) - 1) {
            echo '<span class="text-gray-900 font-bold truncate max-w-[200px]">' . esc_html($item['name']) . '</span>';
        } else {
            echo '<a href="' . esc_url($item['url']) . '" class="hover:text-[#8b3dff] transition-colors">' . esc_html($item['name']) . '</a>';
        }
    }
    echo '</nav>';

    // Output JSON-LD Schema
    $schema_items = array();
    foreach ($items as $index => $item) {
        $schema_items[] = array(
            "@type" => "ListItem",
            "position" => $index + 1,
            "name" => $item['name'],
            "item" => $item['url']
        );
    }
    echo '<script type="application/ld+json">' . json_encode(array(
        "@context" => "https://schema.org",
        "@type" => "BreadcrumbList",
        "itemListElement" => $schema_items
    )) . '</script>';
}

/**
 * TỐI ƯU TỐC ĐỘ TẢI TRANG (PAGE SPEED OPTIMIZATION)
 * Theo yêu cầu giáo trình: Nén code, hạn chế file thừa
 */
// 1. Loại bỏ các file rác không cần thiết (Emoji, Embeds)
function pet_shop_cleanup_head() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
}
add_action('init', 'pet_shop_cleanup_head');

// 2. Ép trình duyệt defer (tải sau) các file JS không quan trọng để tăng điểm PageSpeed
function pet_shop_defer_scripts($tag, $handle, $src) {
    $defer_scripts = array('jquery-migrate', 'wp-embed');
    if (in_array($handle, $defer_scripts)) {
        return '<script src="' . $src . '" defer="defer"></script>' . "\n";
    }
    return $tag;
}
add_filter('script_loader_tag', 'pet_shop_defer_scripts', 10, 3);



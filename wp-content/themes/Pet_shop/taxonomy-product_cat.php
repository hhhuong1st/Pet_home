<?php
/**
 * The Template for displaying product categories
 * Diagnostic: PRODUCT CAT TEMPLATE ACTIVE
 */

get_header(); 
$current_term = get_queried_object();

// Fallback: Nếu WordPress không nhận diện được term, thử lấy từ URL
if ( empty($current_term) || is_wp_error($current_term) || !isset($current_term->name) ) {
    $url_path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    $parts = explode('/', $url_path);
    $last_slug = end($parts);
    $current_term = get_term_by('slug', $last_slug, 'product_cat');
}

// Nếu vẫn không có, tạo một đối tượng giả để không bị lỗi
if ( empty($current_term) || is_wp_error($current_term) ) {
    $current_term = (object)[
        'name' => 'Danh Mục',
        'description' => 'Đang tải dữ liệu sản phẩm...',
        'term_id' => 0
    ];
}
?>

<!-- PHẦN HIỂN THỊ ĐẦU TRANG DANH MỤC -->
<div class="relative bg-[#fff6ef] py-16 md:py-24 overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none text-4xl text-center">
        <div class="absolute top-10 left-10 rotate-12">🐾</div>
        <div class="absolute bottom-10 right-10 -rotate-12">🐾</div>
    </div>
    
    <div class="max-w-7xl mx-auto px-8 text-center relative z-10">
        <div class="inline-flex items-center gap-2 bg-[#ff7a21]/10 text-[#ff7a21] px-4 py-2 rounded-full text-sm font-bold mb-6">
            <span class="w-2 h-2 bg-[#ff7a21] rounded-full animate-ping"></span>
            DANH MỤC SẢN PHẨM
        </div>
        <h1 class="text-4xl md:text-5xl font-black text-[#1f2937] mb-6">
            <?php echo esc_html($current_term->name); ?> <span class="text-[#ff7a21]">🐾</span>
        </h1>
        <div class="text-gray-500 max-w-2xl mx-auto text-lg leading-relaxed italic">
            <?php echo !empty($current_term->description) ? wp_kses_post( html_entity_decode($current_term->description, ENT_QUOTES, 'UTF-8') ) : 'Khám phá bộ sưu tập sản phẩm chất lượng cao dành cho thú cưng.'; ?>
        </div>
    </div>
</div>

<section class="max-w-7xl mx-auto px-8 py-10 min-h-screen">
    <?php pet_shop_breadcrumbs(); ?>
    <!-- Modern Horizontal Filter Bar -->
    <div class="bg-white rounded-[24px] p-4 mb-12 border border-gray-100 shadow-sm flex flex-wrap items-center justify-between gap-4">
        <div class="flex flex-wrap items-center gap-4">
            <div class="text-gray-500 font-bold ml-2">
                Tổng cộng: <span class="text-[#8b3dff]"><?php echo $wp_query->found_posts; ?></span> sản phẩm
            </div>
        </div>
        <div class="flex items-center gap-3">
            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Sắp xếp:</span>
            <select class="bg-transparent border-none text-sm font-bold text-gray-700 focus:ring-0 cursor-pointer" onchange="location = this.value;">
                <option value="?orderby=menu_order">Mặc định</option>
                <option value="?orderby=popularity">Mua nhiều nhất</option>
                <option value="?orderby=date">Mới nhất</option>
                <option value="?orderby=price">Giá thấp đến cao</option>
                <option value="?orderby=price-desc">Giá cao đến thấp</option>
            </select>
        </div>
    </div>

    <!-- Grid Sản phẩm -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                global $product; 
                // Đảm bảo đây là một sản phẩm thực thụ
                if ( ! $product && function_exists( 'wc_get_product' ) ) {
                    $product = wc_get_product( get_the_ID() );
                }
                if ( $product ) :
                ?>
                
                <div class="bg-white rounded-[32px] p-4 md:p-5 relative group transition-all duration-500 border-2 border-dashed border-gray-200 hover:border-[#8b3dff] hover:bg-[#8b3dff]/0.02 flex flex-col h-full hover:no-underline cursor-pointer" onclick="if(!event.target.closest('.atc-btn-container, .yith-custom-wrapper')) window.location.href='<?php echo esc_url( get_permalink() ); ?>';">
                    <div class="yith-custom-wrapper">
                        <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
                    </div>
                    
                    <div class="h-48 md:h-56 relative flex justify-center items-center mb-5 overflow-hidden rounded-2xl bg-[#fafafa]">
                        <div class="w-full h-full flex justify-center items-center p-4">
                            <?php 
                            if ( has_post_thumbnail() ) {
                                the_post_thumbnail('medium', ['class' => 'max-h-full object-contain group-hover:scale-110 transition-transform duration-700 ease-out']); 
                            } else {
                                echo '<img src="' . wc_placeholder_img_src() . '" alt="Placeholder" class="max-h-full object-contain group-hover:scale-110 transition-transform duration-700" />';
                            }
                            ?>
                        </div>
                        <div class="absolute inset-x-3 bottom-3 flex justify-center translate-y-12 group-hover:translate-y-0 transition-all duration-500 z-10 opacity-0 group-hover:opacity-100 atc-btn-container">
                            <?php 
                            if ( $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock() ) {
                                $atc_url = esc_url( $product->add_to_cart_url() );
                                $atc_class = 'add_to_cart_button ajax_add_to_cart';
                            } else {
                                $atc_url = get_permalink();
                                $atc_class = '';
                            }
                            ?>
                            <a href="<?php echo $atc_url; ?>" 
                               data-product_id="<?php echo get_the_ID(); ?>"
                               class="bg-[#8b3dff] text-white font-bold py-2.5 px-4 w-full rounded-2xl flex items-center justify-center gap-2 text-xs shadow-lg hover:bg-[#ff7a21] transition-all <?php echo $atc_class; ?>">
                                Thêm Vào Giỏ
                            </a>
                        </div>
                    </div>

                    <div class="px-1 flex-grow flex flex-col">
                        <h3 class="font-bold text-[15px] md:text-lg mb-4 text-gray-900 group-hover:text-[#8b3dff] transition-colors leading-snug"><?php the_title(); ?></h3>
                        <div class="mt-auto border-t border-dashed border-gray-100 pt-4 pb-2">
                            <div class="flex items-center justify-between">
                                <div class="flex flex-col text-[#111827] text-lg font-black">
                                    <?php echo $product->get_price_html(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php 
                endif;
            endwhile;
        else :
            echo '<div class="col-span-full py-20 text-center bg-gray-50 rounded-[40px] border-2 border-dashed border-gray-200">';
            echo '<p class="text-gray-500 font-bold text-xl uppercase mb-4">Danh mục này hiện chưa có sản phẩm</p>';
            echo '<p class="text-gray-400">Bạn hãy đảm bảo đã gán đúng "Danh mục sản phẩm" và nhấn Cập nhật cho sản phẩm nhé!</p>';
            echo '</div>';
        endif; ?>
    </div>
</section>

<style>
    .woocommerce-Price-amount { color: #111827 !important; font-weight: 900 !important; }
</style>

<?php get_footer(); ?>

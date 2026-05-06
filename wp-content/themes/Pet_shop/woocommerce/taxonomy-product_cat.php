<?php get_header(); ?>

<?php
$current_term = get_queried_object();
?>

<div class="bg-[#fff6ef] py-16 relative overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute top-0 left-0 w-64 h-64 bg-[#ff7a21]/5 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-[#8b3dff]/5 rounded-full translate-x-1/4 translate-y-1/4 blur-3xl"></div>
    
    <div class="max-w-7xl mx-auto px-8 relative z-10 text-center">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white text-[#ff7a21] text-sm font-bold shadow-sm mb-6 uppercase tracking-wider">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#ff7a21] opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-[#ff7a21]"></span>
            </span>
            Khám Phá Danh Mục
        </div>
        <h1 class="text-4xl md:text-6xl font-black text-[#1f2937] mb-6">
            <?php echo esc_html( $current_term->name ); ?> <span class="text-[#ff7a21]">🐾</span>
        </h1>
        <?php if ( !empty($current_term->description) ) : ?>
            <div class="text-gray-500 max-w-2xl mx-auto text-lg leading-relaxed"><?php echo html_entity_decode( $current_term->description, ENT_QUOTES, 'UTF-8' ); ?></div>
        <?php else : ?>
            <p class="text-gray-500 max-w-2xl mx-auto text-lg leading-relaxed italic">Tuyển tập những sản phẩm tốt nhất dành riêng cho thú cưng của bạn.</p>
        <?php endif; ?>
    </div>
</div>

<section class="max-w-7xl mx-auto px-8 py-16 min-h-screen">
    <div class="flex flex-col lg:flex-row gap-12">
        <!-- Sidebar Filter (Desktop only) -->
        <aside class="hidden lg:block w-72 flex-shrink-0">
            <div class="sticky top-32 space-y-8">
                <div>
                    <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <span class="w-1.5 h-6 bg-[#ff7a21] rounded-full"></span>
                        Danh Mục Khác
                    </h3>
                    <ul class="space-y-3">
                        <?php
                        $categories = get_terms([
                            'taxonomy' => 'product_cat',
                            'hide_empty' => true,
                            'number' => 10,
                            'exclude' => [$current_term->term_id]
                        ]);
                        foreach($categories as $cat) : ?>
                            <li>
                                <a href="<?php echo get_term_link($cat); ?>" class="group flex items-center justify-between text-gray-600 hover:text-[#8b3dff] transition-all py-1">
                                    <span class="font-medium group-hover:translate-x-1 transition-transform"><?php echo $cat->name; ?></span>
                                    <span class="text-xs bg-gray-100 text-gray-400 px-2 py-0.5 rounded-full group-hover:bg-[#e0d4fc] group-hover:text-[#8b3dff] transition-colors"><?php echo $cat->count; ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="bg-[#8b3dff] rounded-3xl p-8 text-white relative overflow-hidden group shadow-xl">
                    <div class="relative z-10">
                        <h4 class="text-xl font-bold mb-2">Ưu Đãi Đặc Biệt!</h4>
                        <p class="text-white/80 text-sm mb-6">Giảm ngay 10% cho đơn hàng thức ăn mảng mảng đầu tiên.</p>
                        <a href="#" class="inline-block bg-white text-[#8b3dff] font-bold px-6 py-2 rounded-full text-xs hover:bg-[#ff7a21] hover:text-white transition-all shadow-lg">NHẬN MÃ NGAY</a>
                    </div>
                    <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-white/10 rounded-full scale-0 group-hover:scale-150 transition-transform duration-700"></div>
                </div>
            </div>
        </aside>

        <!-- Product Grid -->
        <div class="flex-1">
            <!-- Toolbar -->
            <div class="flex flex-col sm:flex-row justify-between items-center mb-10 gap-4 border-b border-gray-100 pb-6">
                <div class="text-gray-500 font-medium">
                    Hiển thị <span class="text-gray-900"><?php echo $wp_query->found_posts; ?></span> sản phẩm
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-sm font-bold text-gray-400 uppercase tracking-tighter">Sắp xếp:</span>
                    <select class="bg-white border border-gray-200 text-gray-700 text-sm font-bold rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#8b3dff]/20 focus:border-[#8b3dff] cursor-pointer">
                        <option>Mặc định</option>
                        <option>Mơi nhất</option>
                        <option>Giá thấp đến cao</option>
                        <option>Giá cao đến thấp</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8">
                <?php
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        global $product; ?>
                        
                        <div class="bg-white rounded-3xl p-5 relative group transition-all duration-500 hover:shadow-[0_20px_50px_rgba(139,61,255,0.1)] border border-gray-50">
                            
                            <!-- Badges -->
                            <div class="absolute top-6 left-6 z-20 flex flex-col gap-2">
                                <span class="bg-[#ff7a21] text-white text-[10px] font-black px-3 py-1 rounded-full shadow-lg uppercase tracking-wider">HOT</span>
                            </div>

                            <div class="yith-custom-wrapper">
                                <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
                            </div>
                            
                            <div class="h-60 relative flex justify-center items-center mb-6 overflow-hidden rounded-2xl bg-[#fafafa]">
                                <a href="<?php the_permalink(); ?>" class="w-full h-full flex justify-center items-center p-6 relative z-10">
                                    <?php 
                                    if ( has_post_thumbnail() ) {
                                        the_post_thumbnail('medium', ['class' => 'max-h-full object-contain group-hover:scale-110 transition-transform duration-700 ease-out']); 
                                    } else {
                                        echo '<img src="' . wc_placeholder_img_src() . '" alt="Placeholder" class="max-h-full object-contain group-hover:scale-110 transition-transform duration-700" />';
                                    }
                                    ?>
                                </a>

                                <!-- Action bar on hover -->
                                <div class="absolute inset-x-4 bottom-4 flex justify-center translate-y-12 group-hover:translate-y-0 transition-all duration-500 z-10 opacity-0 group-hover:opacity-100">
                                    <?php 
                                    $is_complex = $product->is_type('variable') || $product->is_type('grouped') || $product->is_type('external');
                                    $atc_url = $is_complex ? get_permalink() : esc_url( add_query_arg( 'add-to-cart', get_the_ID() ) );
                                    $atc_class = $is_complex ? '' : 'ajax_add_to_cart add_to_cart_button';
                                    ?>
                                    <a href="<?php echo $atc_url; ?>" 
                                       data-product_id="<?php echo get_the_ID(); ?>" 
                                       class="w-full bg-[#8b3dff] text-white font-bold py-3 px-6 rounded-2xl flex items-center justify-center gap-2 text-sm shadow-[0_10px_20px_rgba(139,61,255,0.3)] hover:bg-[#ff7a21] hover:shadow-[0_10px_20px_rgba(255,122,33,0.3)] transition-all <?php echo $atc_class; ?>">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        Thêm Vào Giỏ
                                    </a>
                                </div>
                            </div>

                            <div class="px-2 pb-2">
                                <div class="text-xs font-bold text-[#ff7a21] uppercase tracking-widest mb-2 opacity-60">
                                    <?php echo esc_html( $current_term->name ); ?>
                                </div>
                                
                                <h3 class="font-bold text-lg mb-3 text-gray-900 line-clamp-2 h-14 group-hover:text-[#8b3dff] transition-colors leading-snug">
                                    <a href="<?php the_permalink(); ?>" class="before:absolute before:inset-0 before:z-0"><?php the_title(); ?></a>
                                </h3>

                                <div class="flex items-center justify-between border-t border-gray-50 pt-4 mt-2">
                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-400 font-bold uppercase tracking-tighter">Giá bán:</span>
                                        <span class="text-[#111827] text-xl font-black custom-price-display">
                                            <?php echo $product ? $product->get_price_html() : ''; ?>
                                        </span>
                                    </div>
                                    <div class="flex gap-0.5 text-orange-400">
                                        <?php for($i=0; $i<5; $i++): ?>
                                            <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                <?php 
                    endwhile;
                else :
                    echo '<div class="col-span-full mt-10 p-20 bg-gray-50 rounded-[40px] border-2 border-dashed border-gray-200 text-center">';
                    echo '<div class="text-6xl mb-6">🏜️</div>';
                    echo '<p class="text-gray-500 font-black text-2xl mb-4">Chưa có sản phẩm nào!</p>';
                    echo '<p class="text-gray-400 mb-8 max-w-sm mx-auto">Chúng tôi đang cập nhật các sản phẩm mới nhất vào danh mục này. Quay lại sau nhé!</p>';
                    echo '<a href="' . home_url() . '" class="inline-block bg-[#8b3dff] text-white font-bold py-4 px-10 rounded-full hover:bg-[#ff7a21] transition-all shadow-xl shadow-[#8b3dff]/20">Khám Phá Trang Chủ</a>';
                    echo '</div>';
                endif;
                ?>
            </div>

            <!-- Pagination -->
            <div class="mt-20 flex justify-center">
                <?php 
                $pagination_args = array(
                    'mid_size'  => 2,
                    'prev_text' => '<div class="flex items-center gap-2 px-6 py-3 bg-white border border-gray-100 rounded-2xl font-bold text-gray-500 hover:text-[#8b3dff] hover:border-[#8b3dff] transition-all shadow-sm"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg> Trước</div>',
                    'next_text' => '<div class="flex items-center gap-2 px-6 py-3 bg-white border border-gray-100 rounded-2xl font-bold text-gray-500 hover:text-[#8b3dff] hover:border-[#8b3dff] transition-all shadow-sm">Tiếp <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></div>',
                    'screen_reader_text' => ' '
                );
                the_posts_pagination($pagination_args);
                ?>
            </div>
        </div>
    </div>
</section>

<style>
    /* Custom CSS to polish the price display generated by WooCommerce */
    .custom-price-display .woocommerce-Price-amount {
        color: #111827 !important;
        font-weight: 900 !important;
    }
    .custom-price-display del .woocommerce-Price-amount {
        color: #9ca3af !important;
        font-size: 0.8em;
        font-weight: 500 !important;
        margin-right: 8px;
    }
    .custom-price-display ins {
        text-decoration: none;
    }
    
    /* Pagination styles */
    .pagination .nav-links {
        display: flex;
        gap: 10px;
        align-items: center;
    }
    .pagination .page-numbers:not(.prev):not(.next) {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        border: 1px solid #f3f4f6;
        border-radius: 16px;
        font-weight: 700;
        color: #6b7280;
        transition: all 0.3s;
    }
    .pagination .page-numbers.current {
        background: #8b3dff;
        border-color: #8b3dff;
        color: white;
        box-shadow: 0 10px 20px rgba(139,61,255,0.2);
    }
    .pagination .page-numbers:hover:not(.current) {
        border-color: #8b3dff;
        color: #8b3dff;
    }
</style>

<?php get_footer(); ?>

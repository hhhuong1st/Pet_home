<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 */

get_header(); ?>

<!-- PHẦN HIỂN THỊ CHO TRANG CỬA HÀNG VÀ DANH MỤC -->
<div class="relative bg-[#fff6ef] py-16 md:py-24 overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none text-4xl">
        <div class="absolute top-10 left-10 rotate-12">🐾</div>
        <div class="absolute bottom-10 right-10 -rotate-12">🐾</div>
    </div>
    
    <div class="max-w-7xl mx-auto px-8 text-center relative z-10">
        <div class="inline-flex items-center gap-2 bg-[#ff7a21]/10 text-[#ff7a21] px-4 py-2 rounded-full text-sm font-bold mb-6">
            <span class="w-2 h-2 bg-[#ff7a21] rounded-full animate-pulse"></span>
            CỬA HÀNG PET SHOP
        </div>
        <h1 class="text-4xl md:text-6xl font-black text-[#1f2937] mb-6">
            <?php woocommerce_page_title(); ?> <span class="text-[#ff7a21]">🐾</span>
        </h1>
        <p class="text-gray-500 max-w-2xl mx-auto text-lg leading-relaxed italic">Tuyển tập những sản phẩm tốt nhất dành riêng cho thú cưng của bạn.</p>
    </div>
</div>

<section class="max-w-7xl mx-auto px-8 py-16 min-h-screen">
    <!-- Modern Horizontal Filter Bar -->
    <div class="bg-white rounded-[24px] p-4 mb-12 border border-gray-100 shadow-sm flex flex-wrap items-center justify-between gap-4">
        <div class="flex flex-wrap items-center gap-4">
            <!-- Filter by Category -->
            <div class="relative group min-w-[200px]">
                <button class="w-full bg-[#fafafa] hover:bg-[#e0d4fc]/30 border border-gray-100 rounded-2xl px-5 py-3 text-sm font-bold text-gray-700 flex items-center justify-between transition-all">
                    <span>Danh mục sản phẩm</span>
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div class="absolute top-full left-0 mt-2 w-64 bg-white border border-gray-100 rounded-2xl shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50 p-3">
                    <?php
                    $product_categories = get_terms( array(
                        'taxonomy'   => 'product_cat',
                        'hide_empty' => false,
                        'parent'     => 0,
                    ) );
                    foreach ( $product_categories as $category ) : ?>
                        <a href="<?php echo get_term_link( $category ); ?>" class="block px-4 py-2.5 text-sm text-gray-600 hover:bg-[#8b3dff]/10 hover:text-[#8b3dff] rounded-xl transition-colors font-medium">
                            <?php echo $category->name; ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Filter by Price -->
            <div class="relative group min-w-[180px]">
                <button class="w-full bg-[#fafafa] hover:bg-[#e0d4fc]/30 border border-gray-100 rounded-2xl px-5 py-3 text-sm font-bold text-gray-700 flex items-center justify-between transition-all">
                    <span>Khoảng giá</span>
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div class="absolute top-full left-0 mt-2 w-56 bg-white border border-gray-100 rounded-2xl shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50 p-3">
                    <a href="?min_price=0&max_price=100000" class="block px-4 py-2.5 text-sm text-gray-600 hover:bg-[#8b3dff]/10 rounded-xl transition-colors">Dưới 100k</a>
                    <a href="?min_price=100000&max_price=500000" class="block px-4 py-2.5 text-sm text-gray-600 hover:bg-[#8b3dff]/10 rounded-xl transition-colors">100k - 500k</a>
                    <a href="?min_price=500000" class="block px-4 py-2.5 text-sm text-gray-600 hover:bg-[#8b3dff]/10 rounded-xl transition-colors">Trên 500k</a>
                </div>
            </div>
        </div>

        <!-- Sort By -->
        <div class="flex items-center gap-3">
            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Sắp xếp:</span>
            <select class="bg-transparent border-none text-sm font-bold text-gray-700 focus:ring-0 cursor-pointer" onchange="location = this.value;">
                <option value="?orderby=menu_order" <?php selected( isset($_GET['orderby']) && $_GET['orderby'] == 'menu_order' ); ?>>Mặc định</option>
                <option value="?orderby=popularity" <?php selected( isset($_GET['orderby']) && $_GET['orderby'] == 'popularity' ); ?>>Mua nhiều nhất</option>
                <option value="?orderby=date" <?php selected( isset($_GET['orderby']) && $_GET['orderby'] == 'date' ); ?>>Mới nhất</option>
                <option value="?orderby=price" <?php selected( isset($_GET['orderby']) && $_GET['orderby'] == 'price' ); ?>>Giá thấp đến cao</option>
                <option value="?orderby=price-desc" <?php selected( isset($_GET['orderby']) && $_GET['orderby'] == 'price-desc' ); ?>>Giá cao đến thấp</option>
            </select>
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                global $product; ?>
                
                <div class="bg-white rounded-[32px] p-4 md:p-5 relative group transition-all duration-500 border-2 border-dashed border-gray-200 hover:border-[#8b3dff] hover:bg-[#8b3dff]/[0.02] flex flex-col h-full hover:no-underline cursor-pointer" onclick="if(!event.target.closest('.atc-btn-container, .yith-custom-wrapper')) window.location.href='<?php echo esc_url( get_permalink() ); ?>';">
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
                        <?php 
                        $attributes = $product->get_attributes();
                        if ( !empty($attributes) ) : ?>
                            <div class="flex flex-wrap gap-1.5 mb-3">
                                <?php foreach ( $attributes as $attribute ) : 
                                    if ( $attribute->is_taxonomy() ) :
                                        $values = wc_get_product_terms( $product->get_id(), $attribute->get_name(), array( 'fields' => 'names' ) );
                                        foreach ( $values as $value ) : ?>
                                            <span class="text-[10px] bg-gray-100 text-gray-500 px-2 py-0.5 rounded-md font-bold uppercase tracking-tighter"><?php echo esc_html( $value ); ?></span>
                                        <?php endforeach;
                                    endif;
                                endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <h3 class="font-bold text-[15px] md:text-lg mb-4 text-gray-900 group-hover:text-[#8b3dff] transition-colors leading-snug"><?php the_title(); ?></h3>

                        <div class="mt-auto border-t border-dashed border-gray-100 pt-4 pb-2">
                            <div class="flex items-center justify-between">
                                <div class="flex flex-col text-[#111827] text-lg font-black custom-price-display">
                                    <?php echo $product ? $product->get_price_html() : ''; ?>
                                </div>
                                <div class="flex gap-0.5 text-orange-400">
                                    <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <span class="text-[10px] font-bold text-orange-400">5.0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endwhile;
        else :
            echo '<p class="col-span-full text-center text-gray-500 py-20 font-bold">Hiện chưa có sản phẩm nào trong mục này.</p>';
        endif; ?>
    </div>
</section>

<style>
    .custom-price-display .woocommerce-Price-amount { color: #111827 !important; font-weight: 900 !important; }
    .custom-price-display del .woocommerce-Price-amount { color: #9ca3af !important; font-size: 0.8em; font-weight: 500 !important; margin-right: 8px; }
    .custom-price-display ins { text-decoration: none; }
</style>

<?php get_footer(); ?>

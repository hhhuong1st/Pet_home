<?php get_header(); ?>

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
            Pet Shop Online
        </div>
        <h1 class="text-4xl md:text-6xl font-black text-[#1f2937] mb-6">
            <?php woocommerce_page_title(); ?> <span class="text-[#ff7a21]">🛒</span>
        </h1>
        <p class="text-gray-500 max-w-2xl mx-auto text-lg leading-relaxed">Khám phá thiên đường mua sắm dành cho thú cưng với hàng ngàn sản phẩm chất lượng cao.</p>
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
                        Danh Mục Sản Phẩm
                    </h3>
                    <ul class="space-y-3">
                        <?php
                        $categories = get_terms([
                            'taxonomy' => 'product_cat',
                            'hide_empty' => true,
                            'number' => 12
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
                        <h4 class="text-xl font-bold mb-2">Giao Hàng 2h!</h4>
                        <p class="text-white/80 text-sm mb-6">Nhận hàng ngay trong ngày tại nội thành HCM & Hà Nội.</p>
                        <a href="#" class="inline-block bg-white text-[#8b3dff] font-bold px-6 py-2 rounded-full text-xs hover:bg-[#ff7a21] hover:text-white transition-all shadow-lg">XEM CHI TIẾT</a>
                    </div>
                    <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-white/10 rounded-full scale-0 group-hover:scale-150 transition-transform duration-700"></div>
                </div>
            </div>
        </aside>

        <!-- Product Grid -->
        <div class="flex-1">
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8">
                <?php
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        global $product; ?>
                        
                        <div class="bg-white rounded-3xl p-5 relative group transition-all duration-500 hover:shadow-[0_20px_50px_rgba(139,61,255,0.1)] border border-gray-50">
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

                                <div class="absolute inset-x-4 bottom-4 flex justify-center translate-y-12 group-hover:translate-y-0 transition-all duration-500 z-10 opacity-0 group-hover:opacity-100">
                                    <?php 
                                    $is_complex = $product->is_type('variable') || $product->is_type('grouped') || $product->is_type('external');
                                    $atc_url = $is_complex ? get_permalink() : esc_url( add_query_arg( 'add-to-cart', get_the_ID() ) );
                                    $atc_class = $is_complex ? '' : 'ajax_add_to_cart add_to_cart_button';
                                    ?>
                                    <a href="<?php echo $atc_url; ?>" 
                                       data-product_id="<?php echo get_the_ID(); ?>" 
                                       class="w-full bg-[#8b3dff] text-white font-bold py-3 px-6 rounded-2xl flex items-center justify-center gap-2 text-sm shadow-[0_10px_20px_rgba(139,61,255,0.3)] hover:bg-[#ff7a21] transition-all <?php echo $atc_class; ?>">
                                        Thêm Vào Giỏ
                                    </a>
                                </div>
                            </div>

                            <div class="px-2 pb-2">
                                <h3 class="font-bold text-lg mb-3 text-gray-900 line-clamp-2 h-14 group-hover:text-[#8b3dff] transition-colors leading-snug">
                                    <a href="<?php the_permalink(); ?>" class="before:absolute before:inset-0 before:z-0"><?php the_title(); ?></a>
                                </h3>

                                <div class="flex items-center justify-between border-t border-gray-50 pt-4 mt-2">
                                    <div class="flex flex-col text-[#111827] text-xl font-black custom-price-display">
                                        <?php echo $product ? $product->get_price_html() : ''; ?>
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
                    echo '<p class="col-span-full text-center text-gray-500 py-20">Chưa có sản phẩm nào.</p>';
                endif;
                ?>
            </div>

            <div class="mt-20 flex justify-center">
                <?php 
                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => '<div class="px-6 py-3 bg-white border border-gray-100 rounded-2xl font-bold text-gray-500 hover:text-[#8b3dff] transition-all">Trước</div>',
                    'next_text' => '<div class="px-6 py-3 bg-white border border-gray-100 rounded-2xl font-bold text-gray-500 hover:text-[#8b3dff] transition-all">Tiếp</div>',
                    'screen_reader_text' => ' '
                ));
                ?>
            </div>
        </div>
    </div>
</section>

<style>
    .custom-price-display .woocommerce-Price-amount { color: #111827 !important; font-weight: 900 !important; }
    .custom-price-display del .woocommerce-Price-amount { color: #9ca3af !important; font-size: 0.8em; font-weight: 500 !important; margin-right: 8px; }
    .custom-price-display ins { text-decoration: none; }
    .pagination .page-numbers:not(.prev):not(.next) { width: 48px; height: 48px; display: flex; align-items: center; justify-content: center; background: white; border: 1px solid #f3f4f6; border-radius: 16px; font-weight: 700; color: #6b7280; margin: 0 5px; }
    .pagination .page-numbers.current { background: #8b3dff; border-color: #8b3dff; color: white; }
</style>

<?php get_footer(); ?>

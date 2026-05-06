<?php get_header(); ?>

    <section class="w-full max-w-[1920px] mx-auto">
        <div class="bg-[#ff7a21] w-full p-12 lg:p-20 flex flex-col md:flex-row items-center relative overflow-hidden">
            <div class="absolute top-10 left-10 text-white/20 text-4xl transform -rotate-12">🐾</div>
            <div class="absolute bottom-20 left-1/2 text-white/20 text-5xl transform rotate-45">🐾</div>
            <div class="absolute top-20 right-20 text-white/20 text-3xl">🐾</div>

            <div class="md:w-1/2 relative z-10 text-white space-y-6 lg:pl-10">
                <div class="inline-block bg-white text-black rounded-full px-3 py-1 text-sm font-bold flex items-center w-max shadow-sm">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/dog_cat.png" class="w-6 h-6 rounded-full mr-2 object-cover" alt="Thương hiệu thú cưng tin cậy">
                    Thú Cưng Đáng Tin Cậy
                </div>
                <h1 class="text-4xl lg:text-5xl font-extrabold leading-tight">
                    Trung Tâm Chăm Sóc <br> & Thú Y <span class="inline-block bg-pink-500 rounded-full w-10 h-10 text-center leading-10 align-middle shadow-md text-white">❤</span> Point
                </h1>
                <p class="text-white/90 leading-relaxed max-w-md">
                    Cung cấp các sản phẩm thức ăn, đồ chơi mảng phụ kiện chăm sóc thú cưng chất lượng cao cùng các dịch vụ thú y chuyên nghiệp.
                </p>
                <button class="bg-[#8b3dff] hover:bg-purple-700 text-white font-bold py-3 px-8 rounded-full transition shadow-lg hover:-translate-y-1">
                    Đặt Lịch Hẹn Ngay
                </button>
            </div>

            <div class="md:w-1/2 relative mt-10 md:mt-0 flex justify-center">
                <div class="w-80 h-80 bg-white/10 rounded-full absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 blur-2xl"></div>
                <img src="<?php echo get_template_directory_uri(); ?>/images/dog_cat.png" alt="Trung tâm dịch vụ chăm sóc thú cưng và phụ kiện động vật" class="relative z-10 w-full max-h-[500px] object-contain drop-shadow-2xl">
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-8 py-10">
        <h2 class="text-3xl font-extrabold mb-10 text-gray-800 flex items-center justify-center">
            Danh Mục Được Mua Nhiều <span class="text-pink-500 ml-2">🔥</span>
        </h2>
        <div class="flex flex-wrap justify-center items-start gap-4 md:gap-x-10 md:gap-y-8">
            <?php
            // Lấy danh mục sản phẩm
            $product_categories = get_terms(array(
                'taxonomy'   => 'product_cat',
                'hide_empty' => false,
                'parent'     => 0, // Chỉ lấy danh mục cha, không lấy danh mục con
            ));

            // Loại bỏ các danh mục "Sale" và "Thiết bị thông minh" theo yêu cầu
            if (!empty($product_categories) && !is_wp_error($product_categories)) {
                $product_categories = array_filter($product_categories, function($cat) {
                    return !in_array($cat->slug, array('sale', 'thiet-bi-thong-minh'));
                });
            }

            if (!empty($product_categories) && !is_wp_error($product_categories)) :
                foreach ($product_categories as $cat) :
                    // Lấy URL hình ảnh được upload cho danh mục trong trang Quản trị (Admin)
                    $thumbnail_id = get_term_meta($cat->term_id, 'thumbnail_id', true);
                    $image_url = wp_get_attachment_url($thumbnail_id);
                    
                    // Nếu trong admin danh mục chưa được tải ảnh lên, bỏ qua danh mục này
                    if (!$image_url) {
                        continue;
                    }
                    ?>
                    
                    <a href="<?php echo get_term_link($cat); ?>" class="flex flex-col items-center group w-20 sm:w-24 md:w-28 flex-shrink-0">
                        <div class="rounded-full w-20 h-20 sm:w-24 sm:h-24 md:w-[110px] md:h-[110px] flex justify-center items-center mb-3 transition-transform duration-300 group-hover:scale-105 shadow-sm overflow-hidden bg-white border border-gray-100">
                            <img src="<?php echo $image_url; ?>" alt="<?php echo $cat->name; ?>" class="w-full h-full object-cover">
                        </div>
                        <span class="text-xs md:text-sm font-semibold text-gray-700 text-center group-hover:text-[#ff7a21] transition-colors leading-tight">
                            <?php echo $cat->name; ?>
                        </span>
                    </a>

                <?php endforeach;
            else: ?>
                <p class="text-gray-400 text-xs text-center w-full">Chưa có danh mục nào.</p>
            <?php endif; ?>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-8 py-10">
        <h2 class="text-3xl font-extrabold mb-10 flex items-center justify-center">
            Mua Sắm Theo Thú Cưng <span class="text-orange-500 ml-2">🐾</span>
        </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 4
                );
                $loop = new WP_Query($args);
                if ($loop->have_posts()) :
                    while ($loop->have_posts()) : $loop->the_post();
                        global $product; ?>
                        
                        <div class="bg-white rounded-[32px] p-5 relative group transition-all duration-500 border-2 border-dashed border-gray-200 hover:border-[#8b3dff] hover:bg-[#8b3dff]/[0.02] flex flex-col h-full hover:no-underline">
                            
                            <div class="yith-custom-wrapper">
                                <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
                            </div>
                            
                            <div class="h-48 md:h-56 relative flex justify-center items-center mb-5 overflow-hidden rounded-2xl bg-[#fafafa]">
                                <a href="<?php the_permalink(); ?>" class="w-full h-full flex justify-center items-center p-4 relative z-10">
                                    <?php 
                                    if ( has_post_thumbnail() ) {
                                        the_post_thumbnail('medium', ['class' => 'max-h-full object-contain group-hover:scale-110 transition-transform duration-700 ease-out']); 
                                    } else {
                                        echo '<img src="' . wc_placeholder_img_src() . '" alt="Placeholder" class="max-h-full object-contain group-hover:scale-110 transition-transform duration-700" />';
                                    }
                                    ?>
                                </a>

                                <div class="absolute inset-x-3 bottom-3 flex justify-center translate-y-12 group-hover:translate-y-0 transition-all duration-500 z-10 opacity-0 group-hover:opacity-100">
                                    <?php 
                                    // Kiểm tra loại sản phẩm để quyết định URL và class thêm vào giỏ
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
                                       class="bg-[#8b3dff] text-white font-bold py-2.5 px-4 w-full rounded-2xl flex items-center justify-center gap-2 text-xs shadow-lg hover:bg-[#ff7a21] transition-all <?php echo $atc_class; ?>" 
                                       aria-label="<?php echo $product->is_type('simple') ? 'Thêm vào giỏ' : 'Xem chi tiết'; ?> <?php the_title_attribute(); ?>">
                                        Thêm Vào Giỏ
                                    </a>
                                </div>
                            </div>

                            <div class="px-1 flex-grow flex flex-col text-left">
                                <!-- Hiển thị phân loại (Attributes) -->
                                <?php 
                                    $attributes = $product->get_attributes();
                                    if ( !empty($attributes) ) : ?>
                                    <div class="flex flex-wrap gap-1.5 mb-3">
                                        <?php foreach ( $attributes as $attribute ) : 
                                            if ( $attribute->is_taxonomy() ) :
                                                $cat_values = wc_get_product_terms( $product->get_id(), $attribute->get_name(), array( 'fields' => 'names' ) );
                                                foreach ( $cat_values as $val ) : ?>
                                                    <span class="text-[10px] bg-gray-100 text-gray-500 px-2 py-0.5 rounded-md font-bold uppercase tracking-tighter"><?php echo esc_html( $val ); ?></span>
                                                <?php endforeach;
                                            endif;
                                        endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <h3 class="font-bold text-[15px] md:text-lg mb-4 text-gray-900 group-hover:text-[#8b3dff] transition-colors leading-snug">
                                    <a href="<?php the_permalink(); ?>" class="before:absolute before:inset-0 before:z-0"><?php the_title(); ?></a>
                                </h3>

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

                <?php 
                    endwhile;
                else :
                    echo '<p class="col-span-4 text-center text-gray-500">Bạn chưa có sản phẩm nào. Hãy vào Admin > Sản phẩm để đăng bài!</p>';
                endif;
                wp_reset_postdata();
                ?>
            </div>
    </section>

    <section class="max-w-7xl mx-auto px-8 py-16">
        <h2 class="text-3xl font-extrabold mb-12 flex items-center justify-center">
            Tin Tức Mới Nhất <span class="text-orange-500 ml-2">📰</span>
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-center">
            <?php
            $news_args = array( 'posts_per_page' => 3 );
            $news_query = new WP_Query( $news_args );
            if ( $news_query->have_posts() ) : while ( $news_query->have_posts() ) : $news_query->the_post(); ?>
                
                <article class="bg-white border-2 border-dashed border-gray-300 rounded-2xl p-6 relative group text-center hover:border-[#8b3dff] transition-all duration-300 cursor-pointer transform-gpu" onclick="window.location.href='<?php echo esc_url(get_permalink()); ?>';">
                    <div class="relative mb-8">
                        <div class="bg-gray-200 w-full h-56 blob-shape mx-auto shadow-inner overflow-hidden">
                            <?php if ( has_post_thumbnail() ) : 
                                the_post_thumbnail('large', ['class' => 'w-full h-full object-cover opacity-80 group-hover:opacity-100 group-hover:scale-110 transition-all duration-500', 'alt' => get_the_title()]); 
                            else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/placeholder-icon.png" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 group-hover:scale-110 transition-all duration-500" alt="Hình ảnh tin tức mặc định">
                            <?php endif; ?>
                        </div>
                        
                        <div class="absolute -bottom-5 left-1/2 transform -translate-x-1/2 bg-[#8b3dff] group-hover:bg-[#ff7a21] text-white w-12 h-12 rounded-full flex flex-col items-center justify-center font-bold text-xs shadow-lg ring-4 ring-[#fff6ef] transition-colors">
                            <span><?php echo get_the_date('M'); ?></span>
                            <span><?php echo get_the_date('d'); ?></span>
                        </div>
                    </div>
                    
                    <h3 class="font-extrabold text-xl mb-3 text-gray-900 group-hover:text-[#8b3dff] transition-colors">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    
                    <div class="flex items-center justify-center text-sm font-semibold text-[#8b3dff] group-hover:text-[#ff7a21] mb-4 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                        <?php the_author(); ?>
                    </div>
                    
                    <div class="w-16 h-px bg-gray-300 mx-auto mb-4 group-hover:bg-orange-200 transition-colors"></div>
                    
                    <p class="text-gray-500 text-sm px-4">
                        <?php echo wp_trim_words( get_the_excerpt(), 12, '...' ); ?>
                    </p>
                </article>

            <?php endwhile; wp_reset_postdata(); endif; ?>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-8 py-20 overflow-hidden">
        <div class="text-center mb-16 px-4">
            <h2 class="text-4xl font-extrabold text-[#8b3dff] mb-4" style="font-family: 'Dancing Script', cursive;">Dịch Vụ Của Chúng Tôi</h2>
            <p class="text-gray-500 max-w-2xl mx-auto text-sm md:text-base">
                Chúng tôi cung cấp các giải pháp chăm sóc toàn diện cho thú cưng của bạn với tình yêu và trách nhiệm cao nhất.
            </p>
        </div>

        <div class="flex flex-col lg:flex-row items-center justify-between gap-12 lg:gap-4">
            <!-- Cột Trái -->
            <div class="flex-1 space-y-12 md:space-y-16 order-2 lg:order-1">
                <div class="flex flex-col items-center lg:items-end text-center lg:text-right group">
                    <div class="w-16 h-16 mb-4 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/icon (1).png" alt="Sản phẩm tự nhiên" class="max-w-full max-h-full">
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Sản phẩm tự nhiên</h3>
                    <p class="text-gray-500 text-sm max-w-[280px]">Chúng tôi cung cấp các sản phẩm hoàn toàn từ tự nhiên, an toàn cho sức khỏe thú cưng.</p>
                </div>
                <div class="flex flex-col items-center lg:items-end text-center lg:text-right group">
                    <div class="w-16 h-16 mb-4 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/icon (2).png" alt="Chăm sóc thú y" class="max-w-full max-h-full">
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Chăm sóc thú y</h3>
                    <p class="text-gray-500 text-sm max-w-[280px]">Đội ngũ bác sĩ thú y giàu kinh nghiệm luôn sẵn sàng chăm sóc và điều trị tận tâm.</p>
                </div>
                <div class="flex flex-col items-center lg:items-end text-center lg:text-right group">
                    <div class="w-16 h-16 mb-4 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/icon (3).png" alt="Huấn luyện" class="max-w-full max-h-full">
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Huấn luyện</h3>
                    <p class="text-gray-500 text-sm max-w-[280px]">Các khóa huấn luyện chuyên nghiệp giúp thú cưng của bạn ngoan ngoãn và thông minh hơn.</p>
                </div>
            </div>

            <!-- Ảnh Trung Tâm -->
            <div class="flex-shrink-0 relative order-1 lg:order-2 px-4">
                <div class="w-full max-w-[320px] md:max-w-[450px] relative z-10 mx-auto">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/cho-meo-nam-giua.png" alt="Thú cưng" class="w-full h-auto drop-shadow-2xl">
                </div>
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[120%] h-[120%] bg-[#8b3dff]/5 rounded-full blur-3xl -z-0"></div>
            </div>

            <!-- Cột Phải -->
            <div class="flex-1 space-y-12 md:space-y-16 order-3 lg:order-3">
                <div class="flex flex-col items-center lg:items-start text-center lg:text-left group">
                    <div class="w-16 h-16 mb-4 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/icon (4).png" alt="Chỗ ở" class="max-w-full max-h-full">
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Chỗ ở</h3>
                    <p class="text-gray-500 text-sm max-w-[280px]">Không gian lưu trú sạch sẽ, tiện nghi và ấm áp như đang ở chính ngôi nhà của mình.</p>
                </div>
                <div class="flex flex-col items-center lg:items-start text-center lg:text-left group">
                    <div class="w-16 h-16 mb-4 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/icon (5).png" alt="Nhận nuôi" class="max-w-full max-h-full">
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Nhận nuôi</h3>
                    <p class="text-gray-500 text-sm max-w-[280px]">Kết nối những trái tim yêu động vật với những người bạn bốn chân đang cần một tổ ấm.</p>
                </div>
                <div class="flex flex-col items-center lg:items-start text-center lg:text-left group">
                    <div class="w-16 h-16 mb-4 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/icon (6).png" alt="Chăm sóc chất lượng" class="max-w-full max-h-full">
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Chăm sóc chất lượng</h3>
                    <p class="text-gray-500 text-sm max-w-[280px]">Quy trình chăm sóc tỉ mỉ đảm bảo thú cưng của bạn luôn trong trạng thái tốt nhất.</p>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
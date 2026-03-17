<?php get_header(); ?>

    <section class="flex flex-col md:flex-row w-full max-w-[1920px] mx-auto items-stretch">
        
        <div class="bg-[#8b3dff] w-full md:w-80 p-6 flex-shrink-0 flex items-center justify-center">
            <div class="bg-white rounded-2xl p-6 shadow-lg w-full">
                <h3 class="font-bold text-lg mb-4 text-gray-800">Tất Cả Danh Mục</h3>
                <div class="space-y-3">
                    <?php
                    // Lấy danh mục sản phẩm
                    $product_categories = get_terms(array(
                        'taxonomy'   => 'product_cat',
                        'hide_empty' => false,
                    ));

                    $colors = ['#fbc02d', '#29b6f6', '#ef5350', '#d84315', '#c0ca33', '#5c6bc0', '#263238'];
                    $i = 0;

                    if (!empty($product_categories) && !is_wp_error($product_categories)) :
                        foreach ($product_categories as $cat) :
                            $current_color = $colors[$i % count($colors)];
                            $i++;

                            $thumbnail_id = get_term_meta($cat->term_id, 'thumbnail_id', true);
                            $image_url = wp_get_attachment_url($thumbnail_id);
                            
                            if (!$image_url) {
                                $image_url = get_template_directory_uri() . '/images/placeholder-icon.png';
                            }
                            ?>
                            
                            <a href="<?php echo get_term_link($cat); ?>" 
                               class="flex justify-between items-center text-white px-4 py-3 rounded-full hover:scale-105 transition-transform duration-300 shadow-sm"
                               style="background-color: <?php echo $current_color; ?>;">
                                
                                <span class="flex items-center text-sm font-semibold">
                                    <span class="bg-white rounded-full w-7 h-7 flex justify-center items-center mr-2 overflow-hidden p-1">
                                        <img src="<?php echo $image_url; ?>" alt="<?php echo $cat->name; ?>" class="w-full h-full object-contain">
                                    </span> 
                                    <?php echo $cat->name; ?>
                                </span>
                                
                                <span class="bg-white rounded-full w-5 h-5 flex justify-center items-center text-xs font-bold" 
                                      style="color: <?php echo $current_color; ?>;">
                                    ›
                                </span>
                            </a>

                        <?php endforeach;
                    else: ?>
                        <p class="text-gray-400 text-xs text-center">Chưa có danh mục nào.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="bg-[#ff7a21] flex-1 p-12 lg:p-20 flex flex-col md:flex-row items-center relative overflow-hidden">
            <div class="absolute top-10 left-10 text-white/20 text-4xl transform -rotate-12">🐾</div>
            <div class="absolute bottom-20 left-1/2 text-white/20 text-5xl transform rotate-45">🐾</div>
            <div class="absolute top-20 right-20 text-white/20 text-3xl">🐾</div>

            <div class="md:w-1/2 relative z-10 text-white space-y-6">
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

    <section class="max-w-7xl mx-auto px-8 py-16">
        <h2 class="text-3xl font-extrabold mb-10 flex items-center">
            Danh Mục Thú Cưng <span class="text-orange-500 ml-2">🐾</span>
        </h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php
            function pet_get_cat_link($slug) {
                $names = [
                    'cho' => 'Chó',
                    'meo' => 'Mèo',
                    'ca' => 'Cá',
                    'chuot' => 'Chuột',
                    'chim' => 'Chim',
                    'bo-sat' => 'Bò Sát',
                    'rua' => 'Rùa',
                    'tho' => 'Thỏ'
                ];

                $term = get_term_by('slug', $slug, 'product_cat');
                if ($term && !is_wp_error($term)) {
                    return get_term_link($term);
                }
                
                $name = isset($names[$slug]) ? $names[$slug] : ucfirst($slug);
                $term_by_name = get_term_by('name', $name, 'product_cat');
                
                if ($term_by_name && !is_wp_error($term_by_name)) {
                    return get_term_link($term_by_name);
                }
                
                // Tự động tạo danh mục nếu chưa có để link không bị lỗi
                $new_term = wp_insert_term(
                    $name,
                    'product_cat',
                    array(
                        'slug' => $slug
                    )
                );
                
                if (!is_wp_error($new_term) && isset($new_term['term_id'])) {
                    return get_term_link((int)$new_term['term_id'], 'product_cat');
                }

                return home_url('/?s=&post_type=product'); // fallback link
            }
            ?>
            <a href="<?php echo pet_get_cat_link('cho'); ?>" class="bg-[#52a6ce] rounded-full p-2 pr-6 flex items-center justify-between hover:-translate-y-1 transition duration-300 cursor-pointer shadow-sm block w-full">
                <div class="flex items-center">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/category-one.png" alt="Dog" class="w-20 h-20 rounded-full object-cover border-4 border-white/20">
                    <div class="ml-4 text-white">
                        <div class="font-bold text-lg">Chó</div>
                        <div class="text-xs opacity-80">Xem Sản Phẩm</div>
                    </div>
                </div>
                <div class="bg-white text-gray-800 rounded-full w-8 h-8 flex items-center justify-center font-bold shadow-md min-w-[2rem] w-8">›</div>
            </a>
            
            <a href="<?php echo pet_get_cat_link('meo'); ?>" class="bg-[#dca449] rounded-full p-2 pr-6 flex items-center justify-between hover:-translate-y-1 transition duration-300 cursor-pointer shadow-sm block w-full">
                <div class="flex items-center">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/category-two.png" alt="Cat" class="w-20 h-20 rounded-full object-cover border-4 border-white/20">
                    <div class="ml-4 text-white">
                        <div class="font-bold text-lg">Mèo</div>
                        <div class="text-xs opacity-80">Xem Sản Phẩm</div>
                    </div>
                </div>
                <div class="bg-white text-gray-800 rounded-full w-8 h-8 flex items-center justify-center font-bold shadow-md min-w-[2rem] w-8">›</div>
            </a>

            <a href="<?php echo pet_get_cat_link('ca'); ?>" class="bg-[#1b2b22] rounded-full p-2 pr-6 flex items-center justify-between hover:-translate-y-1 transition duration-300 cursor-pointer shadow-sm block w-full">
                <div class="flex items-center">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/category-three.png" alt="Fish" class="w-20 h-20 rounded-full object-cover border-4 border-white/20">
                    <div class="ml-4 text-white">
                        <div class="font-bold text-lg">Cá</div>
                        <div class="text-xs opacity-80">Xem Sản Phẩm</div>
                    </div>
                </div>
                <div class="bg-white text-gray-800 rounded-full w-8 h-8 flex items-center justify-center font-bold shadow-md min-w-[2rem] w-8">›</div>
            </a>

            <a href="<?php echo pet_get_cat_link('chuot'); ?>" class="bg-[#c6364a] rounded-full p-2 pr-6 flex items-center justify-between hover:-translate-y-1 transition duration-300 cursor-pointer shadow-sm block w-full">
                <div class="flex items-center">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/category-four.png" alt="Mouse" class="w-20 h-20 rounded-full object-cover border-4 border-white/20">
                    <div class="ml-4 text-white">
                        <div class="font-bold text-lg">Chuột</div>
                        <div class="text-xs opacity-80">Xem Sản Phẩm</div>
                    </div>
                </div>
                <div class="bg-white text-gray-800 rounded-full w-8 h-8 flex items-center justify-center font-bold shadow-md min-w-[2rem] w-8">›</div>
            </a>

            <a href="<?php echo pet_get_cat_link('chim'); ?>" class="bg-[#4b553d] rounded-full p-2 pr-6 flex items-center justify-between hover:-translate-y-1 transition duration-300 cursor-pointer shadow-sm block w-full">
                <div class="flex items-center">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/category-five.png" alt="Birds" class="w-20 h-20 rounded-full object-cover border-4 border-white/20">
                    <div class="ml-4 text-white">
                        <div class="font-bold text-lg">Chim</div>
                        <div class="text-xs opacity-80">Xem Sản Phẩm</div>
                    </div>
                </div>
                <div class="bg-white text-gray-800 rounded-full w-8 h-8 flex items-center justify-center font-bold shadow-md min-w-[2rem] w-8">›</div>
            </a>

            <a href="<?php echo pet_get_cat_link('bo-sat'); ?>" class="bg-[#9f85ff] rounded-full p-2 pr-6 flex items-center justify-between hover:-translate-y-1 transition duration-300 cursor-pointer shadow-sm block w-full">
                <div class="flex items-center">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/category-six.png" alt="Lizards" class="w-20 h-20 rounded-full object-cover border-4 border-white/20">
                    <div class="ml-4 text-white">
                        <div class="font-bold text-lg">Bò Sát</div>
                        <div class="text-xs opacity-80">Xem Sản Phẩm</div>
                    </div>
                </div>
                <div class="bg-white text-gray-800 rounded-full w-8 h-8 flex items-center justify-center font-bold shadow-md min-w-[2rem] w-8">›</div>
            </a>

            <a href="<?php echo pet_get_cat_link('rua'); ?>" class="bg-[#d2b897] rounded-full p-2 pr-6 flex items-center justify-between hover:-translate-y-1 transition duration-300 cursor-pointer shadow-sm block w-full">
                <div class="flex items-center">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/category-seven.png" alt="Turtles" class="w-20 h-20 rounded-full object-cover border-4 border-white/20">
                    <div class="ml-4 text-white">
                        <div class="font-bold text-lg">Rùa</div>
                        <div class="text-xs opacity-80">Xem Sản Phẩm</div>
                    </div>
                </div>
                <div class="bg-white text-gray-800 rounded-full w-8 h-8 flex items-center justify-center font-bold shadow-md min-w-[2rem] w-8">›</div>
            </a>

            <a href="<?php echo pet_get_cat_link('tho'); ?>" class="bg-[#e4aeba] rounded-full p-2 pr-6 flex items-center justify-between hover:-translate-y-1 transition duration-300 cursor-pointer shadow-sm block w-full">
                <div class="flex items-center">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/category-eight.png" alt="Rabbit" class="w-20 h-20 rounded-full object-cover border-4 border-white/20">
                    <div class="ml-4 text-white">
                        <div class="font-bold text-lg">Thỏ</div>
                        <div class="text-xs opacity-80">Xem Sản Phẩm</div>
                    </div>
                </div>
                <div class="bg-white text-gray-800 rounded-full w-8 h-8 flex items-center justify-center font-bold shadow-md min-w-[2rem] w-8">›</div>
            </a>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-8 py-10">
        <h2 class="text-3xl font-extrabold mb-10 flex items-center">
            Mua Sắm Theo Thú Cưng <span class="text-orange-500 ml-2">🐾</span>
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => 4
            );
            $loop = new WP_Query($args);
            if ($loop->have_posts()) :
                while ($loop->have_posts()) : $loop->the_post();
                    global $product; ?>
                    
                    <article class="bg-white border-2 border-dashed border-gray-300 rounded-2xl p-6 relative group text-center hover:border-[#8b3dff] transition duration-300 overflow-hidden transform-gpu">
                    
                    <button class="absolute top-4 right-4 bg-gray-400 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-500 transition z-20" aria-label="Thêm vào yêu thích">♥</button>
                    
                    <div class="h-48 relative flex justify-center items-center mb-4">
                        <a href="<?php the_permalink(); ?>" class="w-full h-full flex justify-center items-center" aria-label="<?php the_title(); ?>">
                            <?php the_post_thumbnail('medium', ['class' => 'max-h-full object-contain group-hover:scale-105 transition-transform duration-300', 'alt' => get_the_title()]); ?>
                        </a>

                        <div class="absolute inset-x-0 bottom-0 flex justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 z-10 translate-y-2 group-hover:translate-y-0">
                            <a href="?add-to-cart=<?php echo get_the_ID(); ?>" class="bg-[#e0d4fc] text-[#8b3dff] font-bold py-2 px-6 rounded-full flex items-center text-sm shadow-lg hover:bg-[#8b3dff] hover:text-white transition-colors" aria-label="Thêm <?php the_title(); ?> vào giỏ">
                                Thêm Vào Giỏ
                            </a>
                        </div>
                    </div>

                    <div class="text-sm font-bold flex justify-center items-center gap-2 mt-4">
                        <span class="text-[#8b3dff] text-lg [&>del]:text-gray-400 [&>del]:text-sm [&>del]:mr-2 [&>ins]:no-underline">
                            <?php echo $product->get_price_html(); ?>
                        </span>
                    </div>

                    <h3 class="font-extrabold text-lg mt-2 text-gray-800 line-clamp-2">
                        <a href="<?php the_permalink(); ?>" class="hover:text-[#8b3dff] transition-colors"><?php the_title(); ?></a>
                    </h3>

                    <div class="text-gray-500 text-sm mt-2 line-clamp-2">
                        <?php echo apply_filters( 'woocommerce_short_description', get_the_excerpt() ); ?>
                    </div>
                </article>


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
        <h2 class="text-3xl font-extrabold mb-12 flex items-center">
            Tin Tức Mới Nhất <span class="text-orange-500 ml-2">📰</span>
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-center">
            <?php
            $news_args = array( 'posts_per_page' => 3 );
            $news_query = new WP_Query( $news_args );
            if ( $news_query->have_posts() ) : while ( $news_query->have_posts() ) : $news_query->the_post(); ?>
                
                <article class="group p-8 rounded-[40px] transition-all duration-300 hover:bg-white hover:shadow-2xl hover:shadow-gray-200/50 cursor-pointer">
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
                    
                    <h3 class="font-extrabold text-xl mb-3 text-gray-900 group-hover:text-black transition-colors">
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

<?php get_footer(); ?>
<?php get_header(); ?>

<?php
$current_term = get_queried_object();
?>

<section class="max-w-7xl mx-auto px-8 py-16 min-h-screen">
    <h1 class="text-4xl lg:text-5xl font-extrabold mb-8 flex items-center text-[#8b3dff]">
        <?php echo esc_html( $current_term->name ); ?> <span class="text-orange-500 ml-2">🐾</span>
    </h1>

    <?php if ( !empty($current_term->description) ) : ?>
        <p class="text-gray-600 mb-10 max-w-3xl text-lg leading-relaxed"><?php echo esc_html( $current_term->description ); ?></p>
    <?php endif; ?>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                global $product; ?>
                
                <div class="bg-white border-2 border-dashed border-gray-300 rounded-2xl p-6 relative group text-center hover:border-[#8b3dff] transition duration-300 overflow-hidden transform-gpu">
                    
                    <button class="absolute top-4 right-4 bg-gray-400 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-500 transition z-20">♥</button>
                    
                    <div class="h-48 relative flex justify-center items-center mb-4">
                        <a href="<?php the_permalink(); ?>" class="w-full h-full flex justify-center items-center">
                            <?php 
                            if ( has_post_thumbnail() ) {
                                the_post_thumbnail('medium', ['class' => 'max-h-full object-contain group-hover:scale-105 transition-transform duration-300']); 
                            } else {
                                echo '<img src="' . wc_placeholder_img_src() . '" alt="Placeholder" class="max-h-full object-contain group-hover:scale-105 transition-transform duration-300" />';
                            }
                            ?>
                        </a>

                        <div class="absolute inset-x-0 bottom-0 flex justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 z-10 translate-y-2 group-hover:translate-y-0">
                            <a href="?add-to-cart=<?php echo get_the_ID(); ?>" class="bg-[#e0d4fc] text-[#8b3dff] font-bold py-2 px-6 rounded-full flex items-center text-sm shadow-lg hover:bg-[#8b3dff] hover:text-white transition-colors">
                                Thêm Vào Giỏ
                            </a>
                        </div>
                    </div>

                    <div class="text-sm font-bold flex justify-center items-center gap-2 mt-4">
                        <span class="text-[#8b3dff] text-xl [&>del]:text-gray-400 [&>del]:text-sm [&>del]:mr-2 [&>ins]:no-underline">
                            <?php echo $product ? $product->get_price_html() : ''; ?>
                        </span>
                    </div>

                    <h3 class="font-extrabold text-lg mt-2 text-gray-800 line-clamp-2">
                        <a href="<?php the_permalink(); ?>" class="hover:text-[#8b3dff] transition-colors"><?php the_title(); ?></a>
                    </h3>

                    <div class="text-gray-500 text-sm mt-2 line-clamp-2">
                        <?php echo apply_filters( 'woocommerce_short_description', get_the_excerpt() ); ?>
                    </div>
                </div>

        <?php 
            endwhile;
        else :
            echo '<div class="col-span-1 sm:col-span-2 lg:col-span-4 mt-10 p-10 bg-gray-50 rounded-2xl border border-gray-200 text-center">';
            echo '<p class="text-gray-500 font-bold text-xl">Không tìm thấy sản phẩm nào trong danh mục này.</p>';
            echo '<a href="' . home_url() . '" class="inline-block mt-4 bg-[#8b3dff] text-white font-bold py-2 px-6 rounded-full hover:bg-purple-700 transition">Quay Lại Trang Chủ</a>';
            echo '</div>';
        endif;
        ?>
    </div>

    <div class="mt-12 flex justify-center">
        <?php 
        // Pagination
        the_posts_pagination( array(
            'mid_size'  => 2,
            'prev_text' => '<span class="text-[#8b3dff] font-bold px-4 py-2 border border-[#8b3dff] bg-white rounded-md hover:bg-[#8b3dff] hover:text-white transition mr-2">&laquo; Trang Trước</span>',
            'next_text' => '<span class="text-[#8b3dff] font-bold px-4 py-2 border border-[#8b3dff] bg-white rounded-md hover:bg-[#8b3dff] hover:text-white transition ml-2">Trang Sau &raquo;</span>',
            'screen_reader_text' => ' '
        ) );
        ?>
    </div>
</section>

<?php get_footer(); ?>

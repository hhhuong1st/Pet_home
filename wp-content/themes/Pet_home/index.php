<?php get_header(); ?>
<section class="max-w-7xl mx-auto px-8 py-16 min-h-screen">
    <h1 class="text-4xl lg:text-5xl font-extrabold mb-12 flex items-center text-[#8b3dff]">
        <?php 
        if ( is_category() || is_tag() || is_tax() ) {
            single_term_title(); 
        } elseif ( is_search() ) {
            echo 'Kết quả tìm kiếm: ' . get_search_query();
        } else {
            echo 'Tin Tức & Blog';
        }
        ?> <span class="text-orange-500 ml-2">📰</span>
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <article class="group p-8 rounded-[40px] transition-all duration-300 hover:bg-white hover:shadow-2xl hover:shadow-gray-200/50 cursor-pointer block bg-gray-50">
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
                
                <div class="flex items-center text-sm font-semibold text-[#8b3dff] group-hover:text-[#ff7a21] mb-4 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                    <?php the_author(); ?>
                </div>
                
                <div class="w-16 h-px bg-gray-300 mb-4 group-hover:bg-orange-200 transition-colors"></div>
                
                <p class="text-gray-500 text-sm">
                    <?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?>
                </p>
                <div class="mt-4">
                    <a href="<?php the_permalink(); ?>" class="text-[#8b3dff] font-bold text-sm hover:underline">Đọc tiếp &rarr;</a>
                </div>
            </article>
        <?php endwhile; else : ?>
            <p class="text-gray-600 col-span-full">Hiện tại chưa có bài viết nào.</p>
        <?php endif; ?>
    </div>
    
    <div class="mt-12 flex justify-center">
        <?php 
        the_posts_pagination( array(
            'mid_size'  => 2,
            'prev_text' => '<span class="text-[#8b3dff] font-bold px-4 py-2 border border-[#8b3dff] bg-white rounded-md hover:bg-[#8b3dff] hover:text-white transition mr-2">&laquo; Trước</span>',
            'next_text' => '<span class="text-[#8b3dff] font-bold px-4 py-2 border border-[#8b3dff] bg-white rounded-md hover:bg-[#8b3dff] hover:text-white transition ml-2">Sau &raquo;</span>',
            'screen_reader_text' => ' '
        ) );
        ?>
    </div>
</section>
<?php get_footer(); ?>

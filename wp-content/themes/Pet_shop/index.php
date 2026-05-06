<?php get_header(); ?>
<section class="max-w-7xl mx-auto px-8 py-16 min-h-screen">
    <div class="flex flex-col lg:flex-row gap-12">
        <!-- Main Content -->
        <div class="lg:w-2/3">
            <h1 class="text-4xl font-extrabold mb-12 text-[#8b3dff]">
                <?php 
                if ( is_category() || is_tag() || is_tax() ) {
                    single_term_title(); 
                } elseif ( is_search() ) {
                    echo 'Kết quả tìm kiếm: ' . get_search_query();
                } else {
                    echo 'Tin Tức & Blog Thú Cưng';
                }
                ?> <span class="text-orange-500 ml-2">📰</span>
            </h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <article class="bg-white border border-gray-100 shadow-sm rounded-3xl overflow-hidden group hover:shadow-xl transition-all duration-500">
                        <div class="relative h-56 overflow-hidden">
                            <?php if ( has_post_thumbnail() ) : 
                                the_post_thumbnail('large', ['class' => 'w-full h-full object-cover group-hover:scale-110 transition-all duration-700']); 
                            else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/placeholder-icon.png" class="w-full h-full object-cover" alt="Blog post placeholder">
                            <?php endif; ?>
                            <div class="absolute top-4 left-4 bg-[#8b3dff] text-white text-[11px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                                <?php echo get_the_date('d M, Y'); ?>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <h2 class="font-extrabold text-xl mb-3 text-gray-900 group-hover:text-[#ff7a21] transition-colors line-clamp-2">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <p class="text-gray-500 text-sm mb-6 line-clamp-3">
                                <?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?>
                            </p>
                            <a href="<?php the_permalink(); ?>" class="inline-flex items-center text-sm font-black text-[#8b3dff] hover:text-[#ff7a21] transition-colors gap-2">
                                ĐỌC TIẾP
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </article>
                <?php endwhile; else : ?>
                    <p class="text-gray-600 col-span-full">Hiện tại chưa có bài viết nào.</p>
                <?php endif; ?>
            </div>
            
            <div class="mt-16 flex justify-center">
                <?php 
                the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => '<span class="text-[#8b3dff] font-bold px-4 py-2 border border-[#8b3dff] bg-white rounded-md hover:bg-[#8b3dff] hover:text-white transition mr-2">&laquo; Trước</span>',
                    'next_text' => '<span class="text-[#8b3dff] font-bold px-4 py-2 border border-[#8b3dff] bg-white rounded-md hover:bg-[#8b3dff] hover:text-white transition ml-2">Sau &raquo;</span>',
                    'screen_reader_text' => ' '
                ) );
                ?>
            </div>
        </div>

        <!-- Sidebar -->
        <aside class="lg:w-1/3 space-y-12">
            <!-- Search Widget -->
            <div class="bg-gray-50 p-8 rounded-3xl border border-gray-100">
                <h3 class="text-xl font-bold mb-6 text-gray-900 flex items-center gap-2">Tìm kiếm <span class="text-xs">🔍</span></h3>
                <form role="search" method="get" action="<?php echo home_url('/'); ?>" class="relative group">
                    <input type="hidden" name="post_type" value="post">
                    <input type="text" name="s" id="sidebar-search-input" value="<?php echo get_search_query(); ?>" placeholder="Tìm bài viết..." class="w-full bg-white border border-gray-200 rounded-2xl py-3 px-5 pr-16 focus:outline-none focus:ring-2 focus:ring-[#8b3dff] transition-all">
                    
                    <!-- Nút X (Clear) tùy chỉnh -->
                    <button type="button" id="clear-sidebar-search" class="absolute right-10 top-1/2 -translate-y-1/2 text-gray-300 hover:text-red-500 transition-colors <?php echo empty(get_search_query()) ? 'hidden' : ''; ?>">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>

                    <!-- Nút Tìm kiếm -->
                    <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#8b3dff] transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </form>

                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const input = document.getElementById('sidebar-search-input');
                    const clearBtn = document.getElementById('clear-sidebar-search');
                    
                    if (input && clearBtn) {
                        input.addEventListener('input', function() {
                            if (this.value.length > 0) {
                                clearBtn.classList.remove('hidden');
                            } else {
                                clearBtn.classList.add('hidden');
                            }
                        });
                        
                        clearBtn.addEventListener('click', function() {
                            input.value = '';
                            clearBtn.classList.add('hidden');
                            input.focus();
                        });
                    }
                });
                </script>
            </div>

            <!-- Categories Widget -->
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
                <h3 class="text-xl font-bold mb-6 text-gray-900 border-b border-gray-50 pb-4">Chủ đề phổ biến</h3>
                <ul class="space-y-4">
                    <?php
                    $categories = get_categories(array('hide_empty' => true));
                    foreach($categories as $category) :
                    ?>
                        <li>
                            <a href="<?php echo get_category_link($category->term_id); ?>" class="flex justify-between items-center group">
                                <span class="text-gray-600 group-hover:text-[#8b3dff] font-bold transition-colors"><?php echo $category->name; ?></span>
                                <span class="bg-gray-100 text-gray-400 text-xs px-2 py-1 rounded-lg group-hover:bg-[#8b3dff]/10 group-hover:text-[#8b3dff] transition-all"><?php echo $category->count; ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Recent Posts Widget -->
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
                <h3 class="text-xl font-bold mb-6 text-gray-900 border-b border-gray-50 pb-4">Bài viết mới</h3>
                <div class="space-y-6">
                    <?php
                    $recent_posts = new WP_Query(array('posts_per_page' => 4, 'post__not_in' => array(get_the_ID())));
                    if ($recent_posts->have_posts()) : while ($recent_posts->have_posts()) : $recent_posts->the_post();
                    ?>
                        <div class="flex gap-4 group cursor-pointer" onclick="window.location.href='<?php the_permalink(); ?>';">
                            <div class="w-20 h-20 flex-shrink-0 rounded-2xl overflow-hidden bg-gray-100">
                                <?php if (has_post_thumbnail()) the_post_thumbnail('thumbnail', ['class' => 'w-full h-full object-cover']); ?>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-gray-800 group-hover:text-[#ff7a21] transition-colors line-clamp-2 leading-tight mb-2"><?php the_title(); ?></h4>
                                <span class="text-[11px] text-gray-400 font-bold uppercase"><?php echo get_the_date(); ?></span>
                            </div>
                        </div>
                    <?php endwhile; wp_reset_postdata(); endif; ?>
                </div>
            </div>
        </aside>
    </div>
</section>

<!-- Blog Schema -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Blog",
  "name": "Pet Shop Blog",
  "url": "<?php echo home_url('/blog'); ?>",
  "description": "Chia sẻ kinh nghiệm chăm sóc thú cưng, dinh dưỡng và huấn luyện chó mèo chuyên nghiệp."
}
</script>

<?php get_footer(); ?>


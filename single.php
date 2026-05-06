<?php get_header(); ?>
<article class="max-w-4xl mx-auto px-8 py-16 min-h-screen">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <header class="mb-10 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold text-[#8b3dff] mb-6 leading-tight"><?php the_title(); ?></h1>
            <div class="flex items-center justify-center space-x-6 text-gray-500 font-medium">
                <span class="flex items-center"><svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> <?php echo get_the_date(); ?></span>
                <span class="flex items-center"><svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg> <?php the_author(); ?></span>
            </div>
        </header>

        <?php if ( has_post_thumbnail() ) : ?>
            <div class="w-full h-80 md:h-[500px] mb-12 rounded-[40px] overflow-hidden shadow-xl border-4 border-white">
                <?php the_post_thumbnail('full', ['class' => 'w-full h-full object-cover', 'alt' => get_the_title()]); ?>
            </div>
        <?php endif; ?>

        <div class="prose prose-lg max-w-none text-gray-800 space-y-6 leading-loose [&>p]:mb-4 [&>h2]:text-2xl [&>h2]:font-bold [&>h2]:text-[#ff7a21] [&>ul]:list-disc [&>ul]:pl-6">
            <?php the_content(); ?>
        </div>

        <div class="mt-16 pt-8 border-t border-gray-200">
            <?php 
            if ( comments_open() || get_comments_number() ) {
                comments_template(); 
            }
            ?>
        </div>
    <?php endwhile; endif; ?>
</article>
<?php get_footer(); ?>

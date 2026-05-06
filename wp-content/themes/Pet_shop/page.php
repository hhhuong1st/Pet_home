<?php get_header(); ?>

<main class="max-w-7xl mx-auto px-8 py-16 min-h-screen">
    <?php pet_shop_breadcrumbs(); ?>
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            // Đây chính là cánh cửa để Elementor hiển thị giao diện
            the_content(); 
        endwhile;
    endif;
    ?>
</main>

<?php get_footer(); ?>
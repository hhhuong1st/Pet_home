<?php
include 'wp-load.php';
$cho = get_term_by('slug', 'hat-cho-cho', 'product_cat');
$meo = get_term_by('slug', 'hat-cho-meo', 'product_cat');
echo "Link Cho: " . get_term_link($cho) . "\n";
echo "Link Meo: " . get_term_link($meo) . "\n";

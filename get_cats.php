<?php
require_once('wp-load.php');
$terms = get_terms( array(
    'taxonomy' => 'product_cat',
    'hide_empty' => false,
) );
foreach ( $terms as $term ) {
    echo $term->name . ' - ' . $term->slug . "\n";
}

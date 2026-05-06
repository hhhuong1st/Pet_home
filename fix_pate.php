<?php
include 'wp-load.php';
$term = get_term_by('slug', 'pate-neo', 'product_cat');
if ($term) {
    wp_update_term($term->term_id, 'product_cat', ['slug' => 'pate-meo', 'name' => 'Pate mèo']);
    echo "Fixed slug 'pate-neo' to 'pate-meo'\n";
}

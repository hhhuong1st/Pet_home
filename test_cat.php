<?php
$c = file_get_contents("http://localhost/Pet_shop/danh-muc-san-pham/cho/");
if (strpos($c, 'window.location.href') !== false || strpos($c, '<meta http-equiv="refresh"') !== false) {
    echo "Found redirect in HTML\n";
    echo substr($c, 0, 500);
} else {
    echo "No HTML redirect found.\n";
}

<?php
$page = $_GET['page'] ?? 'home';
$pagePath = "pages/{$page}.php";

if(file_exists($pagePath)){
    include "includes/header.php";
    include $pagePath;
    include "includes/footer.php";
} else {
    echo "Halaman tidak ditemukan!";
}

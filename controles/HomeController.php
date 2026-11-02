<?php
class HomeController {
    public function index() {
        $title = 'Home - Perpustakaan Digital';
        
        ob_start();
        require __DIR__ . '/../../views/pages/home.php';
        $content = ob_get_clean();

        require __DIR__ . '/../../views/layouts/main.php';
    }
}
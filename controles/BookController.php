<?php
require_once __DIR__ . '/../middleware/AuthMiddleware.php';
require_once __DIR__ . '/../models/Book.php';
require_once __DIR__ . '/../../config/database.php';

class BookController {
    public function index() {
        // Melindungi halaman katalog agar hanya bisa diakses user yang sudah login
        AuthMiddleware::handle();

        global $pdo;
        $bookModel = new Book($pdo);
        $books = $bookModel->all();

        $title = 'Katalog Buku - Perpustakaan Digital';

        ob_start();
        require __DIR__ . '/../../views/pages/books/index.php';
        $content = ob_get_clean();

        require __DIR__ . '/../../views/layouts/main.php';
    }
}
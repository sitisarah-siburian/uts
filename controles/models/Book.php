<?php
class Book {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function all() {
        $sql = "SELECT books.*, categories.name AS category_name 
                FROM books 
                LEFT JOIN categories ON books.category_id = categories.id 
                ORDER BY books.id DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
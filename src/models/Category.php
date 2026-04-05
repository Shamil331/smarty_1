<?php
require_once __DIR__ . '/../config/database.php';

class Category {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM categories ORDER BY name");
        
        return $stmt->fetchAll();
    }
    
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = ?");
        
        $stmt->execute([$id]);
        
        return $stmt->fetch();
    }
    
    public function getWithPostsCount() {
        $sql = "SELECT c.*, COUNT(pc.post_id) as posts_count 
                FROM categories c 
                LEFT JOIN post_categories pc ON c.id = pc.category_id 
                GROUP BY c.id 
                HAVING posts_count > 0 
                ORDER BY c.name";
                
        $stmt = $this->db->query($sql);
        
        return $stmt->fetchAll();
    }
    
    public function getRecentPosts($categoryId, $limit = 3) {
        $sql = "SELECT p.* FROM posts p 
                JOIN post_categories pc ON p.id = pc.post_id 
                WHERE pc.category_id = ? 
                ORDER BY p.created_at DESC 
                LIMIT ?";
                
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$categoryId, $limit]);
        
        return $stmt->fetchAll();
    }
}

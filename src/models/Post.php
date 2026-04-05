<?php
require_once __DIR__ . '/../config/database.php';

class Post {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function getAllByCategory($categoryId, $sort = 'date', $offset = 0, $limit = 10) {
        $orderBy = ($sort === 'views') ? 'p.views DESC' : 'p.created_at DESC';
        
        $sql = "SELECT p.* FROM posts p 
                JOIN post_categories pc ON p.id = pc.post_id 
                WHERE pc.category_id = ? 
                ORDER BY {$orderBy} 
                LIMIT ? OFFSET ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$categoryId, $limit, $offset]);
        
        return $stmt->fetchAll();
    }
    
    public function getCountByCategory($categoryId) {
        $sql = "SELECT COUNT(*) as total FROM posts p 
                JOIN post_categories pc ON p.id = pc.post_id 
                WHERE pc.category_id = ?";
                
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$categoryId]);
        
        return $stmt->fetch()['total'];
    }
    
    public function getById($id) {
        $sql = "UPDATE posts SET views = views + 1 WHERE id = ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        
        $sql = "SELECT p.*, GROUP_CONCAT(c.id) as category_ids, GROUP_CONCAT(c.name) as category_names 
                FROM posts p 
                LEFT JOIN post_categories pc ON p.id = pc.post_id 
                LEFT JOIN categories c ON pc.category_id = c.id 
                WHERE p.id = ? 
                GROUP BY p.id";
                
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        
        return $stmt->fetch();
    }
    
    public function getSimilarPosts($postId, $categoryIds, $limit = 3) {
        if (empty($categoryIds)) return [];
        
        $placeholders = str_repeat('?,', count($categoryIds) - 1) . '?';
        
        $sql = "SELECT DISTINCT p.* FROM posts p 
                JOIN post_categories pc ON p.id = pc.post_id 
                WHERE pc.category_id IN ({$placeholders}) 
                AND p.id != ? 
                ORDER BY p.created_at DESC 
                LIMIT ?";
        
        $params = array_merge($categoryIds, [$postId, $limit]);
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        
        return $stmt->fetchAll();
    }
}

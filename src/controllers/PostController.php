<?php
require_once __DIR__ . '/../models/Post.php';

class PostController {
    private $smarty;
    private $postModel;
    
    public function __construct($smarty) {
        $this->smarty = $smarty;
        $this->postModel = new Post();
    }
    
    public function view($id) {
        $post = $this->postModel->getById($id);
        
        if (!$post) {
            header('HTTP/1.0 404 Not Found');
            die('Post not found');
        }
        
        $categoryIds = $post['category_ids'] ? explode(',', $post['category_ids']) : [];
        $similarPosts = $this->postModel->getSimilarPosts($id, $categoryIds, 3);
        
        $this->smarty->assign('post', $post);
        $this->smarty->assign('similarPosts', $similarPosts);
        $this->smarty->display('post.tpl');
    }
}

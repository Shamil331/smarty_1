<?php
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../models/Post.php';

class HomeController {
    private $smarty;
    private $categoryModel;
    private $postModel;
    
    public function __construct($smarty) {
        $this->smarty = $smarty;
        $this->categoryModel = new Category();
        $this->postModel = new Post();
    }
    
    public function index() {
        $categories = $this->categoryModel->getWithPostsCount();
        
        foreach ($categories as &$category) {
            $category['recent_posts'] = $this->categoryModel->getRecentPosts($category['id'], 3);
        }
        unset($category);
        
        $this->smarty->assign('categories', $categories);
        $this->smarty->display('index.tpl');
    }
}

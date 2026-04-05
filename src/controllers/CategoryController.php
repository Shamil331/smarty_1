<?php
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../models/Post.php';

class CategoryController {
    private $smarty;
    private $categoryModel;
    private $postModel;
    
    public function __construct($smarty) {
        $this->smarty = $smarty;
        $this->categoryModel = new Category();
        $this->postModel = new Post();
    }
    
    public function view($id) {
        $category = $this->categoryModel->getById($id);
        if (!$category) {
            header('HTTP/1.0 404 Not Found');
            die('Category not found');
        }
        
        $sort = $_GET['sort'] ?? 'date';
        $page = max(1, (int)($_GET['page'] ?? 1));
        $perPage = 5;
        $offset = ($page - 1) * $perPage;
        
        $totalPosts = $this->postModel->getCountByCategory($id);
        $totalPages = ceil($totalPosts / $perPage);
        
        $posts = $this->postModel->getAllByCategory($id, $sort, $offset, $perPage);
        
        $this->smarty->assign('category', $category);
        $this->smarty->assign('posts', $posts);
        $this->smarty->assign('sort', $sort);
        $this->smarty->assign('currentPage', $page);
        $this->smarty->assign('totalPages', $totalPages);
        $this->smarty->display('category.tpl');
    }
}

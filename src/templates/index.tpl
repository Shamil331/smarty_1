<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Блог - Главная</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Мой блог</h1>
        </header>
        
        <main>
            {foreach $categories as $category}
                <section class="category-section">
                    <div class="category-header">
                        <h2>{$category.name}</h2>
                        <a href="/category/{$category.id}" class="all-posts-link">Все статьи</a>
                    </div>
                    
                    <p>{$category.description}</p>
        
                    <div class="recent-posts">
                        <h3>Последние посты</h3>
                        <div class="posts-grid">
                            {foreach $category.recent_posts as $post}
                                <article class="post-card">
                                    {if $post.image}
                                        <img src="/uploads/{$post.image}" alt="{$post.title}">
                                    {/if}
                                    <h4>{$post.title}</h4>
                                    <p>{$post.description|truncate:100}</p>
                                    <div class="post-meta">
                                        <span>Просмотров: {$post.views}</span>
                                        <span>{$post.created_at|date_format:"%d.%m.%Y"}</span>
                                    </div>
                                    <a href="/post/{$post.id}" class="btn">Читать далее</a>
                                </article>
                            {/foreach}
                        </div>
                    </div>
                </section>
            {/foreach}
        </main>
    </div>
</body>
</html>

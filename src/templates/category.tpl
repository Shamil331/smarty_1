<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$category.name} - Блог</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>{$category.name}</h1>
            <p>{$category.description}</p>
            <a href="/" class="btn">На главную</a>
        </header>
        
        <div class="sorting">
            <span>Сортировать по:</span>
            <a href="?sort=date&page=1" class="btn-small {if $sort == 'date'}active{/if}">Дате</a>
            <a href="?sort=views&page=1" class="btn-small {if $sort == 'views'}active{/if}">Просмотрам</a>
        </div>
        
        <main>
            <div class="posts-list">
                {foreach $posts as $post}
                    <article class="post-item">
                        {if $post.image}
                            <img src="/uploads/{$post.image}" alt="{$post.title}" class="post-image">
                        {/if}
                        <div class="post-content">
                            <h2>{$post.title}</h2>
                            <p>{$post.description}</p>
                            <div class="post-meta">
                                <span>👁️ {$post.views} просмотров</span>
                                <span>📅 {$post.created_at|date_format:"%d.%m.%Y"}</span>
                            </div>
                            <a href="/post/{$post.id}" class="btn">Читать далее</a>
                        </div>
                    </article>
                {foreachelse}
                    <p>В этой категории пока нет статей.</p>
                {/foreach}
            </div>
            
            {if $totalPages > 1}
                <div class="pagination">
                    {for $i=1 to $totalPages}
                        <a href="?sort={$sort}&page={$i}" class="page-link {if $i == $currentPage}active{/if}">{$i}</a>
                    {/for}
                </div>
            {/if}
        </main>
    </div>
</body>
</html>

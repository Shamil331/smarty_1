<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$post.title} - Блог</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="container">
        <article class="full-post">
            <header>
                <h1>{$post.title}</h1>
                <div class="post-meta">
                    <span>👁️ {$post.views} просмотров</span>
                    <span>📅 {$post.created_at|date_format:"%d.%m.%Y"}</span>
                    {if $post.category_names}
                        <span>📁 Категории: {$post.category_names}</span>
                    {/if}
                </div>
                <a href="/" class="btn">На главную</a>
            </header>
            
            {if $post.image}
                <div class="post-image-full">
                    <img src="/uploads/{$post.image}" alt="{$post.title}">
                </div>
            {/if}
            
            <div class="post-content">
                <p><strong>{$post.description}</strong></p>
                <div class="post-text">
                    {$post.content|nl2br}
                </div>
            </div>
        </article>
        
        {if $similarPosts}
            <section class="similar-posts">
                <h2>Похожие статьи</h2>
                <div class="posts-grid">
                    {foreach $similarPosts as $similar}
                        <article class="post-card">
                            {if $similar.image}
                                <img src="/uploads/{$similar.image}" alt="{$similar.title}">
                            {/if}
                            <h3>{$similar.title}</h3>
                            <p>{$similar.description|truncate:80}</p>
                            <a href="/post/{$similar.id}" class="btn">Читать далее</a>
                        </article>
                    {/foreach}
                </div>
            </section>
        {/if}
    </div>
</body>
</html>

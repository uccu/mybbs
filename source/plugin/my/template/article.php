<!--{subtemplate header}-->
<div class="container">
    <ol class="breadcrumb">
        <li><a href="">Home</a></li>
        <li><a href="my/article/list">List</a></li>
        <li><a href="my/article/aid/{g.article.aid}">Article</a></li>
    </ol>
</div>
<div class="container">
    <blockquote class="blog_title">
        <p><strong>{g.article.title}</strong></p>
        <footer> {g.article.date}</footer>
    </blockquote>
    <div class="container">
        <!--{loop $article['passage'] $words}-->
        {$words}
        <!--{/loop}-->
    </div>  
</div>


<!--{subtemplate tool:footer}-->
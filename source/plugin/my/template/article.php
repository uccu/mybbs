<!--{subtemplate header}-->
<div class="container">
    <blockquote class="blog_title">
        <p><strong>{g.article.title}</strong></p>
        <footer> {g.article.date}</footer>
    </blockquote>
    <div class="container">
        <!--{loop $passage $words}-->
        <p>{$words}</p>
        <!--{/loop}-->
    </div>  
</div>


<!--{subtemplate tool:footer}-->
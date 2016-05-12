<!--{subtemplate header}-->
<div class="container">
    <blockquote class="blog_title">
        <p>{g.page.title}</p>
        <footer> {g.page.ctime}</footer>
    </blockquote>
    <div class="container">
        <!--{loop $passage $words}-->
        <p>{$words}</p>
        <!--{/loop}-->
    </div>  
</div>


<!--{subtemplate tool:footer}-->
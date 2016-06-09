<!--{subtemplate _header}-->
<style>
    .blog_block:hover .blog_title{border-left: 5px solid red;}
</style>
<div class="container">
    <ol class="breadcrumb" style="background:none">
        <li><a href="">Home</a></li>
        <li><a href="my/article/list">List</a></li>
    </ol>
</div>
<!--{loop $g['list'] $a}-->
<div class="container blog_block">
    <blockquote class="blog_title t">
        <a href="my/article/aid/{a.aid}"><strong>{a.title}</strong></a>
            <footer>
                {a.date}
            </footer>
    </blockquote>
    {if a.pic}
    <div class="container">
        <div class="row">
            <!--{loop $a['pic'] $k=>$p}-->
            <!--{eval if($k>2)break}-->
            <div class="col-md-3 col-sm-6 col-xs-6"><img src="t{p}" class="img-responsive" style="margin-bottom:10px"></div>
            <!--{/loop}-->
        </div>
    </div>
    {/if}
    <div class="container">
        <p>{a.summary}</p>
    </div>  
</div>
<!--{/loop}-->
<div class="container">
    <nav class="text-center">
        <ul class="pagination pageset">
            <script id="pageset">
                getPageSet({currentPage},{maxPage},'href','my/article/list/');
                j('#pageset').remove()
            </script>
        </ul>
    </nav>
</div>

<!--{subtemplate tool:footer}-->
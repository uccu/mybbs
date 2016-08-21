<!--{subtemplate adminloader:_header}-->
<table class="table table-striped tc">
    <thead>
        <tr>
            <td>PID</td>
            <td>缩略图</td>
            <td>操作</td>
        </tr>
    </thead>
    <tbody>
    <!--{loop $list $v}-->
        <tr>
            <td>{v.pid}</td>
            <td><img src="{v.path}.small.jpg" class="img-responsive center-block" style="max-height:50px;max-width:180px"></td>
            <td>
                <a href="{g.plugin}/{g.control}/updpic/{v.pid}">[修改]</a>
                <a class="indel cp" data-action="{g.plugin}/api/del_pic/{v.pid}">[删除]</a>
            </td>
        </tr>
    <!--{/loop}-->
    </tbody>
</table>
<nav>
    <ul class="pagination pageset">
        <script>
            getPageSet({currentPage},{maxPage},'href','{g.plugin}/{g.control}/piclists/'+(folder[4]?folder[4]:'0')+'/',
            '/'+(folder[6]?'/'+folder[6]:'')+
            (folder[7]?'/'+folder[7]:''));
            </script>
    </ul>
</nav>

<!--{subtemplate adminloader:_footer}-->
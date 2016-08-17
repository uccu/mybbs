<!--{subtemplate adminloader:_header}-->
<table class="table table-striped tc">
    <thead>
        <tr>
            <td>AID</td>
            <td>案例名字</td>
            <td>类型</td>
            <td>操作</td>
        </tr>
    </thead>
    <tbody>
    <!--{loop $list $v}-->
        <tr>
            <td>{v.aid}</td>
            <td>{v.name}</td>
            <td>{v.typename}</td>
            <td>修改删除</td>
        </tr>
    <!--{/loop}-->
    </tbody>
</table>
<nav>
    <ul class="pagination pageset">
        <script>
            getPageSet({currentPage},{maxPage},'href','{g.plugin}/{g.control}/lists/'+(folder[4]?'/'+folder[4]:'0')+'/',
            '/'+(folder[6]?'/'+folder[6]:'')+
            (folder[7]?'/'+folder[7]:''));
            </script>
    </ul>
</nav>

<!--{subtemplate adminloader:_footer}-->
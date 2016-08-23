<!--{subtemplate adminloader:_header}-->
<table class="table table-striped tc">
    <thead>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>
                <div class="btn-group" role="group" >
                    <a class="list-group-item btn btn-default" href="{g.plugin}/{g.control}/upsubnav/{tid}">新增案例</a>
                </div>
            </td>
        </tr>
        <tr>
            <td>AID</td>
            <td>案例名称</td>
            <td>所属分类</td>
            <td>上传时间</td>
            <td>排序</td>
            <td>操作</td>
        </tr>
    </thead>
    <tbody>
    <!--{loop $list $v}-->
        <tr>
            <td>{v.aid}</td>
            <td>{v.name}</td>
            <td>{v.typename}</td>
            <td>{v.date}</td>
            <td>{v.pos}</td>
            <td>
                <a href="{g.plugin}/{g.control}/updanli/{v.aid}">[修改]</a>
                <a href="{g.plugin}/{g.control}/updanli_{v.type}/{v.aid}">[模板]</a>
                <a href="{g.plugin}/{g.control}/piclists/{v.aid}">[图片]</a>
                <a class="indel cp" data-action="{g.plugin}/api/del_anli/{v.aid}">[删除]</a>
            </td>
        </tr>
    <!--{/loop}-->
    </tbody>
</table>
<nav>
    <ul class="pagination pageset">
        <script>
            getPageSet({currentPage},{maxPage},'href','{g.plugin}/{g.control}/lists/'+(folder[4]?folder[4]:'0')+'/',
            '/'+(folder[6]?'/'+folder[6]:'')+
            (folder[7]?'/'+folder[7]:''));
            </script>
    </ul>
</nav>

<!--{subtemplate adminloader:_footer}-->
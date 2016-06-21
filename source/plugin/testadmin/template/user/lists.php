<!--{subtemplate adminloader:_header}-->
<div class="panel panel-default">
    <div class="panel-body">
        <table class="text-center table table-striped">
            <thead>
                <tr>
                    <th class="text-center">UID</th>
                    <th class="text-center">用户名</th>
                    <th class="text-center">注册时间</th>
                    <th class="text-center">操作</th>
                </tr>
            </thead>
            <tbody>
                        <!--{loop $list $p}-->
                        <tr>
                            <td>{p.uid}</td>
                            <td>{p.nickname}</a></td>
                            <td class="changeToDate">{p.ctime}</td>
                            <td>
                                <div class="btn-group t" role="group" aria-label="opition">
                                    <a type="button" class="btn btn-info" href="{g.plugin}/{g.control}/detail/{p.uid}">详情</a>
                                    <button type="button" data-button="添加" data-title="确认添加?" data-content="<div class='form-inline'>覆盖到首页的推荐明星的第<input type='text' value='1' class='form-control text-center' size='1'>项内</div>" class="btn btn-success indel" data-action="{g.plugin}/{g.control}/del_{g.method}/{p.uid}">推荐</button>
                                    <button type="button" data-button="永久删除" data-content="删除后将不能恢复"  class="btn btn-danger indel" data-action="{g.plugin}/{g.control}/del_{g.method}/{p.uid}">删除</button>
                                </div>
                            </td>
                        </tr>
                        <!--{/loop}-->
                    </tbody>
                </table>
                <div class="text-right fr">
                    
                </div>
                <nav>
                    <ul class="pagination pageset">
                        <script>
                            getPageSet({currentPage},{maxPage},'href','{g.plugin}/{g.control}/lists/',
                            (folder[5]?'/'+folder[5]:'')+(folder[6]?'/'+folder[6]:'')+
                            (folder[7]?'/'+folder[7]:''));
                            </script>
                    </ul>
                </nav>
            </div>
        </div>

<!--{subtemplate adminloader:_footer}-->
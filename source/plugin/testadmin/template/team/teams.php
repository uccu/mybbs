<!--{subtemplate adminloader:_header}-->
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="text-center table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">TID</th>
                            <th class="text-center">名字</th>
                            <th class="text-center">创建时间</th>
                            <th class="text-center">查看团员</th>
                            <th class="text-center">查看组长</th>
                            <th class="text-center">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--{loop $list $p}-->
                        <tr>
                            <td>{p.tid}</td>
                            <td>{p.name}</td>
                            <td class="changeToDate">{p.ctime}</td>
                            <td>
                                <form method="post" action="{g.plugin}/user/lists"><input name="tid" class="dn" value="{p.tid}"><button type="submit" class="t btn btn-success">查看团员</button></form>
                            </td>
                            <td>
                                <form method="post" action="{g.plugin}/user/lists"><input name="captain" class="dn" value="1"><input name="tid" class="dn" value="{p.tid}"><button type="submit" class="t btn btn-success">查看组长</button></form>
                            </td>
                            <td>
                                <div class="btn-group t" role="group" aria-label="opition">
                                    <a type="button" class="btn btn-info" href="{g.plugin}/{g.control}/{g.method}_detail/{p.tid}">详情</a>
                                    <button type="button" data-button="删除" class="btn btn-danger indel" data-action="{g.plugin}/{g.control}/del_{g.method}/{p.tid}">删除</button>
                                </div>
                            </td>
                        </tr>
                        <!--{/loop}-->
                    </tbody>
                </table>
                <div class="text-right fr">
                    <a type="button" class="btn btn-info" href="{g.plugin}/{g.control}/{g.method}_detail/0">添加</a>
                </div>
                <nav>
                    <ul class="pagination pageset">
                        <script>
                            getPageSet({currentPage},{maxPage},'href','{g.plugin}/{g.control}/{g.method}/',
                            (folder[5]?'/'+folder[5]:'')+(folder[6]?'/'+folder[6]:'')+
                            (folder[7]?'/'+folder[7]:''));
                            </script>
                    </ul>
                </nav>
            </div>
        </div>

<!--{subtemplate adminloader:_footer}-->
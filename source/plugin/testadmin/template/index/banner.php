<!--{subtemplate adminloader:_header}-->
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="text-center table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">BID</th>
                            <th class="text-center">标题</th>
                            <th class="text-center">创建时间</th>
                            <th class="text-center">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--{loop $list $p}-->
                        <tr>
                            <td>{p.bid}</td>
                            <td>{p.title}</a></td>
                            <td class="changeToDate">{p.ctime}</td>
                            <td>
                                <div class="btn-group t" role="group" aria-label="opition">
                                    <a type="button" class="btn btn-info" href="{g.plugin}/{g.control}/{g.method}_detail/{p.bid}">详情</a>
                                    <button type="button" data-button="永久删除" data-content="删除后将不能恢复"  class="btn btn-danger indel" data-action="{g.plugin}/{g.control}/del_{g.method}/{p.bid}">删除</button>
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
                        
                    </ul>
                </nav>
            </div>
        </div>

<!--{subtemplate adminloader:_footer}-->
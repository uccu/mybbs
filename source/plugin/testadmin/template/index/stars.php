<!--{subtemplate adminloader:_header}-->
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="text-center table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">位置序号</th>
                            <th class="text-center">COSER</th>
                            <th class="text-center">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--{loop $list $p}-->
                        <tr>
                            <td>{p.sid}</td>
                            <td>{p.nickname}</a></td>
                            <td>
                                <div class="btn-group t" role="group" aria-label="opition">
                                    <a type="button" class="btn btn-info" href="{g.plugin}/{g.control}/{g.method}_detail/{p.sid}">设置封面</a>
                                    
                                </div>
                            </td>
                        </tr>
                        <!--{/loop}-->
                    </tbody>
                </table>
                <div class="text-right fr">
                    <a type="button" class="btn btn-info" href="{g.plugin}/user/search">选择用户</a>
                </div>
                <nav>
                    <ul class="pagination pageset">
                        
                    </ul>
                </nav>
            </div>
        </div>

<!--{subtemplate adminloader:_footer}-->
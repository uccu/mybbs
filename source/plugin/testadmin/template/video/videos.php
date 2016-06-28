<!--{subtemplate adminloader:_header}-->
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="text-center table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">VID</th>
                            <th class="text-center">标题</th>
                            <th class="text-center">用户</th>
                            <th class="text-center">创建时间</th>
                            <th class="text-center">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--{loop $list $p}-->
                        <tr>
                            <td>{p.vid}</td>
                            <td>{p.title}</td>
                            <td><a href="/{g.plugin}/user/lists/1/{p.uid}">{p.nickname}</a></td>
                            <td class="changeToDate">{p.ctime}</td>
                            <td>
                                <div class="btn-group t" role="group" aria-label="opition">
                                    <a type="button" class="btn btn-info" href="{g.plugin}/{g.control}/{g.method}_detail/{p.vid}">详情</a>
                                    <button type="button" data-button="删除" class="btn btn-danger indel" data-action="{g.plugin}/{g.control}/del_{g.method}/{p.vid}">删除</button>
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
                            getPageSet({currentPage},{maxPage},'href','{g.plugin}/{g.control}/{g.method}/',
                            (folder[5]?'/'+folder[5]:'')+(folder[6]?'/'+folder[6]:'')+
                            (folder[7]?'/'+folder[7]:''));
                            </script>
                    </ul>
                </nav>
            </div>
        </div>

<!--{subtemplate adminloader:_footer}-->
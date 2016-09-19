<!--{subtemplate header}-->
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="text-center table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">反馈人</th>
                            <th class="text-center">反馈时间</th>
                            <th class="text-center">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--{loop $list $p}-->
                        <tr>
                            <td>{p.fid}</td>
                            <td>{p.name}</a></td>
                            <td class="changeToDate">{p.ftime}</td>
                            <td>
                                <div class="btn-group t" role="group" aria-label="opition">
                                    <a type="button" class="btn btn-info" href="weixin/{g.control}/{g.method}/detail/{p.fid}">详情</a>
                                    <button type="button" data-button="永久删除" data-content="删除后将不能恢复"  class="btn btn-danger indel" data-action="weixin/{g.control}/del_{g.method}/{p.fid}">删除</button>
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
                            getPageSet({currentPage},{maxPage},'href','weixin/{g.control}/lists/',
                            (folder[5]?'/'+folder[5]:'')+(folder[6]?'/'+folder[6]:'')+
                            (folder[7]?'/'+folder[7]:''));
                            </script>
                    </ul>
                </nav>
            </div>
            
        </div>
        








<!--{template tool:footer}-->


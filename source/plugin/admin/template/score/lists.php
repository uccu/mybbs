<!--{subtemplate header}-->
<div class="container">
    <ol class="breadcrumb">
        <li><a href="index">Home</a></li>
        <li><a href="score">积分</a></li>
        <li><a href="score/lists">积分记录</a></li>
    </ol>
    <div class="alert_box"></div>
</div>

<div class="container">
    <div class="col-md-2">
        <div class="list-group">
            <a href="score/setting" class="list-group-item">积分设置</a>
            <a class="list-group-item active cd">积分记录</a>
        </div>
       
    </div>
    <div class="col-md-10">
        <div class="panel panel-default">
            <div class="panel-body form-inline">
                 <div class="form-group" style="margin-right:10px">
                    <label for="exampleInputName2">用户昵称：</label>
                    <input type="text" class="form-control" id="example1" placeholder="">
                </div>
                <button type="submit" class="btn btn-default search">搜索</button>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="text-center table table-striped sortable-theme-bootstrap" data-sortable>
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">用户昵称</th>
                            <th class="text-center">描述</th>
                            <th class="text-center">收入/支出</th>
                            <th class="text-center">时间</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--{loop $list $p}-->
                        <tr>
                            <td>{p.id}</td>
                            <td><a href="user/lists/1/{p.phone}">{p.nickname}</a></td>
                            <td>{p.desc}</td>
                            <td>{p.zscore}</td>
                            <td>{p.cdate}</td>
                            
                        </tr>
                        <!--{/loop}-->
                    </tbody>
                </table>
                <div class="text-right fr">
                    
                </div>
                <nav>
                    <ul class="pagination pageset">
                        
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<script>
   var goods = 'score',control = 'score';
   j('.search').click(()=>{
        var a1=j('#example1').val();
        a1=a1?a1:0;
        location = control+'/lists/1/'+a1
    });
   getPageSet({currentPage},{maxPage},'href',control+'/lists/',(folder[5]?'/'+folder[5]:'')+(folder[6]?'/'+folder[6]:''));
   
</script>
<!--{subtemplate tool:footer}-->
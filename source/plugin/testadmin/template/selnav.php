<!--{subtemplate adminloader:_header}-->

<table class="table tc">
    <tbody>
        <tr>
            <td></td>
            <td style="width:160px">
                <div class="btn-group" role="group" >
                    <a class="list-group-item btn btn-default" href="{g.plugin}/{g.control}/up_navs/{sid}">新增分类</a>
                    <!--a class="indel cp list-group-item btn btn-default" data-action="{g.plugin}/api/del_anli/">删除</a-->
                </div>
            </td>
        </tr>
    <!--{loop $list $v}-->
        <tr>
            <td><a href="{g.plugin}/{g.control}/selnav/{v.tid}" class="list-group-item">{v.name}</a></td>
            <td style="width:160px">
                <div class="btn-group" role="group" >
                    <a class="list-group-item btn btn-default" href="{g.plugin}/{g.control}/up_navt/{v.tid}">修改</a>
                    <a class="indel cp list-group-item btn btn-default" data-action="{g.plugin}/api/del_navc/{v.tid}">删除</a>
                </div>
            </td>
        </tr>
    <!--{/loop}-->
    </tbody>
</table>

<!--{subtemplate adminloader:_footer}-->
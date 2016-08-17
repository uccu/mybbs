<!--{subtemplate adminloader:_header}-->
<style>
.fsss li:hover{
    back
}
</style>
<div class="list-group">
<!--{loop $list $v}-->
  <a href="{g.plugin}/{g.control}/upsubnav/{v.tid}" class="list-group-item">{v.name}</a>
 <!--{/loop}-->
</div>

<!--{subtemplate adminloader:_footer}-->
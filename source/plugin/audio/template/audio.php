<!--{subtemplate header_c}-->
<!--{eval addcss();}-->
<!--{eval addjs();}-->
<!--{if $_GET['map']}-->
<!--{eval addjs('audio_action_'.$_GET['map']);}-->
<!--{else}-->
<!--{eval addjs('audio_action');}-->
<!--{/if}-->
<div class="pr overlay_z_index_2">
<div><input class="testin t" type="file" accept="audio/*" style="width: 500px;padding:50px" multiple="multiple" /></div>
<div class="turnning pr">
<a class="cp fz last"></a>
<a class="cp space pa"></a>
<a class="cp space2 pa dn"></a>
<a class="cp fy next"></a>
</div>
<div><p class="info"></p></div>
<div><p class="time"></p></div>
<div id="slider"></div>
</div>



<!--{subtemplate footer_c}-->
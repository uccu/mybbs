<!--{subtemplate header}-->
<!--{eval addcss();}-->
<!--{eval addjs();}-->
<div class="upload upload_font">
	<div class="sloc_type upload_f">
		<p>请选择资源形式</p>
		<input type="radio" id="sloc_torrent" value='1' name="sloc_type" checked="checked"><label for="sloc_torrent">种子</label>
		<input type="radio" id="sloc_magnet" value='2' name="sloc_type"><label for="sloc_magnet">磁力</label>
		<input type="radio" id="sloc_link" value='3' name="sloc_type"><label for="sloc_link">直连</label>
		<input type="radio" id="sloc_pan" value='4' name="sloc_type"><label for="sloc_pan">网盘</label>
	</div>
	<div class="sdtype upload_f">
		<p>请选择资源类型</p>
		<!--{loop $_G['seanime']['themefilter'] $v}-->
		<!--{if $v['pid']!=4}-->
		<input type="radio" id="sdtype_{$v['pid']}" value="{$v['pid']}" name="sdtype"><label for="sdtype_{$v['pid']}">{$v['pval']}</label>
		<!--{/if}-->
		<!--{/loop}-->
	</div>
	<div class="sname upload_f">
		<input type="text" id="sname" name="sname" placeholder="在这里输入资源名称" />
	</div>
	<div class="size upload_f">
		<input type="text" name="size" style="width: 100px;text-align:center" title="输入资源大小,种子上传后会自动获取大小"/>
		<select name="size_type" class="size_type" style="width: auto;margin-bottom:3px;border: 1px solid #eee">
			<option value='1024'>GB</option>
			<option value='1' selected="selected">MB</option>
		</select>
	</div>
	<div class="sloc">
		<div class="sloc_t sloc_torrent" sloc="sloc_torrent">
			<input type="file" style="display:none" accept="application/x-bittorrent" name="sloc"/>
			
			<button style='position:relative'>选择文件</button>
			<p style="color:#CCC;margin-top:10px;position:relative;z-index:-1">拖拽TORRENT到方框内</p>
			<p style="color:#89a;margin-top:10px;position:relative;z-index:-1"></p>
			<p class="lin"></p>
			<a class="sloc_change" sloc="sloc_torrent_url">URL上传</a>
		</div>
		<div class="sloc_t sloc_torrent_url disshow" sloc="sloc_torrent">
			<input type="text" placeholder="在这里输入torrent地址" style="width:350px" name="sloc"/>
			<button style="margin-top:10px">上传</button>
			<p class="lin"></p>
			<a class="sloc_change" sloc="sloc_torrent">本地上传</a>
		</div>
		<div class="sloc_t sloc_magnet disshow" sloc="sloc_magnet">
			<input type="text" name="sloc" placeholder="magnet:?xt=urn:btih:+32位BASE32码或40位16进制HASH码+其他信息（可选）"/>
		</div>
		<div class="sloc_t sloc_link disshow" sloc="sloc_link">
			<input type="text" name="sloc" placeholder="在这里输入资源外链地址"/>
		</div>
		<div class="sloc_t sloc_pan disshow" sloc="sloc_pan">
			<input type="text" style="width:400px" title="在这里输入网盘地址" name="sloc" placeholder="在这里输入网盘地址"/>
			<input type="text" style="width:80px" title="在这里输入网盘密码（如果有的话）" name="pw" placeholder="网盘密码"/>
		</div>
	</div>
	
</div>
<div class="upload upload_detail" style="display:none">
	<div class="aid upload_f">
		<p>出处动漫/主题的AID</p>
		<input type="text" style="width:80px;text-align:center" title="在这里输入出处动漫/主题的AID,默认69为自动分类" name="aid"/>
	</div>
	<div class="quality upload_f">
		<p>清晰度</p>
		<input type="text" style="width:80px;text-align:center" title="在这里输入清晰度" name="quality"/>
	</div>
	<div class="subtitle upload_f">
			<p>字幕组/汉化组/翻译</p>
			<input type="text" title="字幕组/汉化组/翻译（如果有的话）" name="subtitle" placeholder="字幕组/汉化组/翻译"/>
	</div>
	<div class="outlink upload_f">
			<p>来源网址</p>
			<input type="text" title="请输入http://开头或https://开头的网址（如果资源是转载的话填写）" name="outlink" placeholder="资源来源网址"/>
	</div>
	<div class="sdes upload_f">
		<p>详细信息</p>
		<textarea name="sdes" placeholder="支持[img]图片外链[/img]"></textarea>
		<ul class="sdes_info">
			<li>
				<p>图片</p>
			</li>
			<li>
				<p>预览</p>
			</li>
			<li>超链接</li>
			<li>颜文字</li>
		</ul>
	</div>
	<div class="dragpic" style="display:none">
		<div class="dragpic_b"></div>
		<input type="file" class="disshow" accept="image/*" multiple="multiple" />
		<button>选择图片</button>
		<div class='lins'>拖拽单张图片到此处</div>
		<div class='lin'></div>
	</div>







</div>
<div class="pageset">
	<button class="last" disabled="disabled">上一步</button>
    <button class="next">完善信息</button>
	<button class="send">发布</button>
</div>

<script>

</script>











<span style="position:absolute;bottom:0;right:0;color:#CCC">本页需要高版本浏览器支持！</span>
<!--{subtemplate footer}-->
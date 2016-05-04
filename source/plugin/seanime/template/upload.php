<!--{subtemplate seanime:header}-->
<style>input{max-width:none;box-shadow:none}</style>
        <!--{eval addcss('normalize',0,'user')}-->
        <!--{eval addcss('demo',0,'user')}-->
        <!--{eval addcss('component',0,'user')}-->
		<style>
			span.input.size a::after{
				content: 'GB';
				position: absolute;
				right: -40px;
				top: 8px;
				font-size: 20px;
				cursor:pointer;
			}
			.search_tags{position: absolute;box-shadow: 0 2px 2px #ccc;opacity:0}
			.search_tags ul{background:#fff;list-style-type: none;text-align: left;padding:5px;border-left: 4px solid #2accac;border-right: 4px solid #2accac}
			.search_tags li{background:#fff;padding:5px;margin:0 10px}
			.search_tags li:hover{background:brown}
			.search_tags i{font-size: 15px;line-height: 1.467}
			.search_tags li:hover i{color:#fff}
			.see ul{position:absolute;top:-20px;right:-10px;padding: 0; width: 130px;z-index:-1}
			.see ul li{cursor:pointer;list-style-type: none;float: left;width: 60px;padding: 4px;background: #ccc;transform: scale(0)}
			.see ul li:hover{background:#fc8073}
			.see ul li.selected{background:#ec7063}
			.sdtype ul li:hover{background:#516b86}
			.sdtype ul li.selected{background:#415b76}
			.outstation ul li:hover{background:#6dbdf2}
			.outstation ul li.selected{background:#5dade2}
			span.input.size a.mb::after{content: 'MB'}
			.see span:hover ul{z-index:10}
			.see span:hover ul li{transform: scale(1)}
		</style>
        
            <section class="content bgcolor-8 tc">
                <h2>Upload</h2>
                <div>
				<span class="input input--isao sname">
					<input class="input__field input__field--isao" type="text" id="input-38" />
					<label class="input__label input__label--isao" for="input-38" data-content="Resource Name">
						<span class="input__label-content input__label-content--isao">Resource Name</span>
					</label>
				</span>
				</div>
				<div class="see">
					<span class="sloc_type pr">
						<a class="t button-1 bgc-5 bgc-h5 w-100" value='1'><i>Torrent</i></a>
						<ul class="t">
							<li value='1' class="bgc-4 bgc-h4 selected"><i>Torrent</i></li>
							<!--<li value='1' class="bgc-4 bgc-h4"><i>Torrent'</i></li>-->
							<li value='2' class="bgc-4 bgc-h4"><i>Magnet</i></li>
							<li value='3' class="bgc-4 bgc-h4"><i>Link</i></li>
							<li value='4' class="bgc-4 bgc-h4"><i>NetDisk</i></li>
						</ul>
					</span>
					<span class="sdtype pr">
						<a class="t button-1 bgc-6 bgc-h6 w-100" value='58'><i>新番连载</i></a>
						<ul class="t">
							<!--{loop $sd $k=>$v}-->
							<li value='{k}' class="bgc-4 bgc-h4"><i>{v.name}</i></li>
							<!--{/loop}-->
							
						</ul>
						
					</span>
					
					<span class="outstation pr">
						<a class="t button-1 bgc-7 bgc-h7 w-100"><i outstation='0'>本站</i></a>
						<ul class="t">
							<li value='0' class="bgc-4 bgc-h4 selected"><i>本站</i></li>
							<li value='1' class="bgc-4 bgc-h4"><i>Dmhy</i></li>
							<li value='2' class="bgc-4 bgc-h4"><i>Nyaa</i></li>
							<li value='3' class="bgc-4 bgc-h4"><i>Leopard</i></li>
							<li value='99' class="bgc-4 bgc-h4"><i>other</i></li>
						</ul>
					</span>
					<a class="t button-1 bgc-1 bgc-h1 show" value="1"><i>显示</i></a>
				</div>
				
                <span class="input input--isao size" style="max-width:100px">
					<a class="t gb dn"></a><a class="t mb"></a>
					<input class="input__field input__field--isao tc" type="text" id="input-16" />
					<label class="input__label input__label--isao" for="input-16" data-content="Size">
						<span class="input__label-content input__label-content--isao">Size</span>
					</label>
				</span>
				<div class="upup">
					<div class="torrent_up">
						<span class="input input--kuro">
							<a style="position: absolute;top: 17px;left: 115px"></a>
							<input accept="application/x-bittorrent" class="input__field input__field--kuro" style="opacity:0;height:60px" type="file" id="input-18" />
							<label class="input__label input__label--kuro" for="input-18">
								<span class="input__label-content input__label-content--kuro">Torrent File</span>
							</label>
						</span>
					</div>
					<div class="torrent_url_up dn">
						<span class="input input--isao">
							<input class="input__field input__field--isao" type="text" id="input-39" />
							<label class="input__label input__label--isao" for="input-39" data-content="Torrent Url">
								<span class="input__label-content input__label-content--isao">Torrent Url</span>
							</label>
						</span>
					</div>
					<div class="magnet_up dn">
						<span class="input input--isao">
							<input class="input__field input__field--isao" type="text" id="input-39" />
							<label class="input__label input__label--isao" for="input-39" data-content="Magnet">
								<span class="input__label-content input__label-content--isao">Magnet</span>
							</label>
						</span>
					</div>
					<div class="link_up dn">
						<span class="input input--isao">
							<input class="input__field input__field--isao" type="text" id="input-39" />
							<label class="input__label input__label--isao" for="input-39" data-content="Link">
								<span class="input__label-content input__label-content--isao">Link</span>
							</label>
						</span>
					</div>
					<div class="pan_up dn">
						<span class="input input--isao" style="max-width:278px">
							<input class="input__field input__field--isao" type="text" id="input-39" />
							<label class="input__label input__label--isao" for="input-39" data-content="Net Disk">
								<span class="input__label-content input__label-content--isao">Net Disk</span>
							</label>
						</span>
						<span class="input input--isao" style="max-width:100px">
							<input class="input__field input__field--isao" type="text" id="input-39" />
							<label class="input__label input__label--isao" for="input-39" data-content="Password">
								<span class="input__label-content input__label-content--isao">Password</span>
							</label>
						</span>
					</div>
				</div>
				<div>
				<div class="theme_up pr" style="z-index:10">
					<span class="input input--isao theme">
						<input class="input__field input__field--isao" type="text" id="input-39" />
						<label class="input__label input__label--isao" for="input-39" data-content="Theme">
							<span class="input__label-content input__label-content--isao">Theme</span>
						</label>
						<div class="search_tags w-400 t"><ul></ul></div>
					</span>
				</div>
				<div class="subtitle_up">
				<span class="input input--isao subtitle">
					<input class="input__field input__field--isao" type="text" id="input-39" />
					<label class="input__label input__label--isao" for="input-39" data-content="Subtitle">
						<span class="input__label-content input__label-content--isao">Subtitle</span>
					</label>
				</span>
				</div>
				<div class="outlink_up dn">
				<span class="input input--isao outlink">
					<input class="input__field input__field--isao" type="text" id="input-39" />
					<label class="input__label input__label--isao" for="input-39" data-content="Outlink">
						<span class="input__label-content input__label-content--isao">Outlink</span>
					</label>
				</span>
				</div>
				</div>
				
				
                <div><a class="t button-1 bgc-5 bgc-h5 upload"><i>Upload</i></a></div>
            </section>
            
        <!--{eval addjs('classie',0,'user')}-->
		<!--{eval addjs()}-->
       
       <!--{subtemplate seanime:footer}-->
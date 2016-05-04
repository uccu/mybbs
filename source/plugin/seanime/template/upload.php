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
				<span class="input input--isao">
					<input class="input__field input__field--isao sname" type="text" id="input-38" />
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
							<li value='1' class="bgc-4 bgc-h4"><i>Torrent'</i></li>
							<li value='2' class="bgc-4 bgc-h4"><i>Magnet</i></li>
							<li value='3' class="bgc-4 bgc-h4"><i>Link</i></li>
							<li value='4' class="bgc-4 bgc-h4"><i>NetDisk</i></li>
						</ul>
					</span>
					<span class="sdtype pr">
						<a class="t button-1 bgc-6 bgc-h6 w-100" value='58'><i>新番连载</i></a>
						<ul class="t">
							<li value='58' class="bgc-4 bgc-h4 selected"><i>新番连载</i></li>
							<li value='82' class="bgc-4 bgc-h4"><i>完整动画</i></li>
							<li value='83' class="bgc-4 bgc-h4"><i>BDRIP</i></li>
							<li value='84' class="bgc-4 bgc-h4"><i>DVDRIP</i></li>
							<li value='57' class="bgc-4 bgc-h4"><i>OVA/SP</i></li>
							<li value='64' class="bgc-4 bgc-h4"><i>剧场版</i></li>
							<li value='67' class="bgc-4 bgc-h4"><i>音乐</i></li>
							<li value='68' class="bgc-4 bgc-h4"><i>MV/MAD</i></li>
							<li value='73' class="bgc-4 bgc-h4"><i>漫画</i></li>
							<li value='74' class="bgc-4 bgc-h4"><i>小说</i></li>
							<li value='81' class="bgc-4 bgc-h4"><i>图包</i></li>
							<li value='85' class="bgc-4 bgc-h4"><i>历年更新</i></li>
							<li value='90' class="bgc-4 bgc-h4"><i>游戏</i></li>
							<li value='91' class="bgc-4 bgc-h4"><i>RAW</i></li>
							
						</ul>
						
					</span>
					
					<span class="outstation pr">
						<a class="t button-1 bgc-7 bgc-h7 w-100"><i outstation='0'>本站</i></a>
						<ul class="t">
							<li value='0' class="bgc-4 bgc-h4 selected"><i>本站</i></li>
							<li value='1' class="bgc-4 bgc-h4"><i>Dmhy</i></li>
							<li value='2' class="bgc-4 bgc-h4"><i>Nyaa</i></li>
							<li value='3' class="bgc-4 bgc-h4"><i>Leopard</i></li>
							<li value='0' class="bgc-4 bgc-h4"><i>other</i></li>
						</ul>
					</span>
					<a class="t button-1 bgc-1 bgc-h1 show" value="1"><i>显示</i></a>
				</div>
				
                <span class="input input--isao size" style="max-width:100px">
					<a class="t gb dn"></a><a class="t mb"></a>
					<input class="input__field input__field--isao size tc" type="text" id="input-16" />
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
					<div class="Link_up dn">
						<span class="input input--isao">
							<input class="input__field input__field--isao" type="text" id="input-39" />
							<label class="input__label input__label--isao" for="input-39" data-content="Link">
								<span class="input__label-content input__label-content--isao">Link</span>
							</label>
						</span>
					</div>
					<div class="Pan_up dn">
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
				<div class="theme_up">
				<span class="input input--isao">
					<input class="input__field input__field--isao theme" type="text" id="input-39" />
					<label class="input__label input__label--isao" for="input-39" data-content="Theme">
						<span class="input__label-content input__label-content--isao">Theme</span>
					</label>
				</span>
				</div>
				<div class="subtitle_up">
				<span class="input input--isao">
					<input class="input__field input__field--isao subtitle" type="text" id="input-39" />
					<label class="input__label input__label--isao" for="input-39" data-content="Subtitle">
						<span class="input__label-content input__label-content--isao">Subtitle</span>
					</label>
				</span>
				</div>
				<div class="outlink_up dn">
				<span class="input input--isao">
					<input class="input__field input__field--isao outlink" type="text" id="input-39" />
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
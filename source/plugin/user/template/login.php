<!--{subtemplate seanime:header}-->
<style>input{max-width:none;box-shadow:none}</style>
        <!--{eval addcss('normalize')}-->
        <!--{eval addcss('demo')}-->
        <!--{eval addcss('component')}-->
        <div class="overlay" style="display: table;opacity:1;">
            <div class="overlay_box">
            <section class="content bgcolor-5" style="text-align:center">
                <h2>Login</h2>
                <span class="input input--minoru">
					<input class="input__field input__field--yoko loginname" type="text" id="input-16" />
					<label class="input__label input__label--yoko" for="input-16">
						<span class="input__label-content input__label-content--yoko">LoginName</span>
					</label>
				</span>
                <span class="input input--minoru">
					<input class="input__field input__field--yoko password" type="password" id="input-16" />
					<label class="input__label input__label--yoko" for="input-16">
						<span class="input__label-content input__label-content--yoko">Password</span>
					</label>
				</span>
                <div><a class="t button-1 bgc-5 bgc-h5 login"><i>Login</i></a></div>
            </section>
            </diu></div>
        <!--{eval addjs('classie')}-->
		<script>
			(function() {
                window.parent.location.hash="overlay-2";
				if (!String.prototype.trim) {
					(function() {
	
						var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
						String.prototype.trim = function() {
							return this.replace(rtrim, '');
						};
					})();
				}

				[].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
					if( inputEl.value.trim() !== '' ) {
						classie.add( inputEl.parentNode, 'input--filled' );
					}

					inputEl.addEventListener( 'focus', onInputFocus );
					inputEl.addEventListener( 'blur', onInputBlur );
				} );

				function onInputFocus( ev ) {
					classie.add( ev.target.parentNode, 'input--filled' );
				}

				function onInputBlur( ev ) {
					if( ev.target.value.trim() === '' ) {
						classie.remove( ev.target.parentNode, 'input--filled' );
					}
				}
                
                jq('.password').bind({keypress:function(e){if(e.which !== 13)return;jq('.login').click()}});
                jq('.login').click(function(){
					var f = {};
					f.lname = jq('.loginname').val();
					f.pwd = jq('.password').val();
					if(!f.lname || !f.pwd){alert('error');return}
					f.pwd = CryptoJS.MD5(f.pwd).toString();
                    jq.post('user/ajax/login',f,function(d){
						if(!d.code){alert(d.data);return}
						window.parent.location.hash = '';
						window.parent.location.reload(true);
					},'json')
                })
			})();
		</script>
       
       <!--{subtemplate seanime:footer}-->
document.write("<script language=javascript src='http://libs.cdnjs.net/three.js/r67/three.min.js'></script>");
jq(function(){
			var j=jQuery,scene = new THREE.Scene(),camera = new THREE.PerspectiveCamera( 75, window.innerWidth/window.innerHeight, 0.1, 1000 ),renderer = new THREE.WebGLRenderer(),geometry = new THREE.Geometry(),lines=[],meshs=[],arc = function(s,r,n){
				var sc = ((n?-s:s)-0.25)*2*Math.PI;
				return new THREE.Vector3(r*Math.cos(sc),r*Math.sin(sc),0)
			},obj = new THREE.Object3D;
			renderer.setSize( window.innerWidth, window.innerHeight )
			j('.info,body p.time').css('color','white');
			document.body.appendChild( renderer.domElement );
			j(renderer.domElement).css({position:'fixed',top:0,left:0});
			var material = new THREE.LineBasicMaterial({color: 0xffffff});
			for(var i=0;i<1024/3;i++){
				var geometry = new THREE.Geometry();
				lines[i] = new THREE.Line( geometry, material );
				obj.add( lines[i] );
			}
			
			// var objs=[];
			// for(var i = 0;i<10;i++){
				// objs[i] = obj.clone();
				// objs[i].position.z = i*10;
				// scene.add(objs[i]);
			// }
			// window.objs = objs;
			// window.material=material;
			// window.scene=scene;
			scene.add(obj);
			camera.position.z = 200;
			
			var lastTime=Date.now(),callback = function (cp,array,array2,ks,a,currentAudioTime,currentAudioLength) {
				var l = array.length;
				//camera.rotation.y += 0.01;
				//camera.rotation.z += 0.01;
				var tt = 600/parseInt(1024/3);tto = 1/parseInt(1024/3);
				for(var i=0;i<(512/3);i++){
					 if(array[i]-a.minDecibels<0){
							lines[i].geometry.vertices = [
								arc(tto*i,100+array[i]-a.minDecibels+2,1),
								arc(tto*i,100+array[i]-a.minDecibels,1)
							];
							lines[i].geometry.verticesNeedUpdate=true;
							lines[i+parseInt(512/3)].geometry.vertices = [
								arc(tto*i,100+array2[i]-a.minDecibels+2),
								arc(tto*i,100+array2[i]-a.minDecibels)
							];
							lines[i+parseInt(512/3)].geometry.verticesNeedUpdate=true;
					} else{
						
							lines[i].geometry.vertices = [
								arc(tto*i,100,1),
								arc(tto*i,100+array[i]-a.minDecibels,1)
							];
							lines[i].geometry.verticesNeedUpdate=true;
							lines[i+parseInt(512/3)].geometry.vertices = [
								arc(tto*i,100),
								arc(tto*i,100+array2[i]-a.minDecibels)
							];
							lines[i+parseInt(512/3)].geometry.verticesNeedUpdate=true;
					}
						//geometrys[i].vertices[1].setZ((array[3*i]-a.minDecibels))
				}
			
				
				renderer.render(scene, camera);
				
				
				
				
				var zhen = parseInt(1000/(Date.now()-lastTime));
				lastTime = Date.now();
				j('body p.time').html(parseInt(currentAudioTime/60).t2() + ':' + parseInt(currentAudioTime%60).t2() + ' / '+ parseInt(currentAudioLength/60).t2() + ':' + parseInt(currentAudioLength%60).t2()+' ['+zhen+']');
			};


			
			
			
		var audioApi = j('.testin').audioApi({canvas:renderer.domElement,callback:callback,info:'body p.info',endedEvent:function(){
			j('.space').click()
		}});
		audioApi.pause();
		j( "#slider" ).width(200).slider({
			min: 0,
			max: 100,
			value: 100, 
			slide: function( event, ui ) {
				audioApi.volume(ui.value/100)
			}
		});
		j('.space,.space2').bind('click',function(){
			j('.space').toggleClass('dn',0);j('.space2').toggleClass('dn',0);
			if(j('.space').hasClass('dn'))audioApi.resume();
			else audioApi.pause();
		});
		j('.last').bind('click',audioApi.last);
		j('.next').bind('click',audioApi.next);
		j('body').bind('click',function(e){
			if(Math.abs(e.clientY-j('body').height()/2)<4 && Math.abs(e.clientX - j('body').width()/2)<200 ){
				var percent = (e.clientX - j('body').width()/2 + 200)/400;
				audioApi.toByPercent(percent)
			}
		})
		j('body').bind('mousemove',function(e){
			camera.rotation.y = -(e.clientX-j('body').width()/2)/1000;
			camera.rotation.x = -(e.clientY-j('body').height()/2)/1000;
		});
		
		window.audioApi=audioApi;
})
<!--{subtemplate tool:header}-->
<style>
body{background:#f0f0f0;}
canvas{background:#fff}

</style>
<div class="container">

    <input id="i" type="file" name="picz"/>

    <script>
        j('input').change(function(){
            var file = this.files[0]; 
            if(!/image\/\w+/.test(file.type))return false; 
            var reader = new FileReader(); 
            reader.readAsDataURL(file); 
            reader.onload = function(e){
                var img = new Image();
                img.onload = function(e){
                    var cc = j('<canvas>'),c=cc[0],cxt=c.getContext("2d"),width = img.width,height = img.height;
                    if(img.width>400){
                        width = 400;height *= 400/img.width;
                    }
                    cc.attr({width:width,height:height});
                    cxt.drawImage(img,0,0,width,height);
                    j.post('my/ajax/uploadpic',{picz:c.toDataURL()},function(d){alert(d.code)},'json')
                };
                img.src = this.result;
            } 
        });
        
    </script>


</div>
<!--{subtemplate tool:footer}-->


<!--{subtemplate _header}-->
<input type="file" ><img id='img'>
<script>
var raw_base64_picz = [];
j('input').change(function(){
    var files = this.files;
    for(var k in files){
        var file =files[k];
        if(!file || !/image\/\w+/.test(file.type))continue;
        var reader=new FileReader();
        reader.readAsDataURL(file);
        reader.onload=function(e){
            var img=new Image();
            img.onload=function(e){
                var cc=j('<canvas>'),c=cc[0],cxt=c.getContext("2d"),width=img.width,height=img.height;
                if(img.width>2000){width=2000;height*=2000/img.width}
                cc.attr({width:width,height:height});
                cxt.drawImage(img,0,0,width,height);
                raw_base64_picz.push(c.toDataURL());
                if(img.width>200){width=200;height*=200/img.width}
                cc.attr({width:width,height:height});
                cxt.drawImage(img,0,0,width,height);
                j('#img')[0].src=c.toDataURL();
            };
            img.src=this.result;
            
        }
    }
})
</script>
<!--{subtemplate _footer}-->
<!--{subtemplate tool:header}-->



<input type="file" />
<script>
    j.ajax({
        url:'app/index',
        type:'post',
        data:{a:1},
        xhr:function(){
            var xhr = new XMLHttpRequest;
            xhr.onprogress = function(e){
                console.log(e);
            };
            return xhr;
        }

    })
</script>
<!--{subtemplate tool:footer}-->
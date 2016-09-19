<!--{subtemplate tool:header}-->
<!--{eval addjs('p')}-->
<style>td{border-top:none !important}</style>
 <div class="container" style="padding-top:40px">
     <form>
     <table class="table">
        <tr>
            <td style="vertical-align:middle; text-align:center;">*性别</td>
            <td style="vertical-align:middle; text-align:center;">
                <input type="text" class="form-control"  name="name">
            </td>
        </tr>
        <tr>
            <td style="vertical-align:middle; text-align:center;">*电话</td>
            <td style="vertical-align:middle; text-align:center;">
                <input type="text" class="form-control"  name="phone">
            </td>
        </tr>           
        <tr>
            <td style="vertical-align:middle; text-align:center;">年龄</td>
            <td style="vertical-align:middle; text-align:center;">
                <input type="text" class="form-control"  name="age">
            </td>
        </tr>
        <tr>
            <td style="vertical-align:middle; text-align:center;">性别</td>
            <td style="vertical-align:middle; text-align:left" class="form-inline">
                <lable><input style="margin-top:0;margin-right:5px;margin-left:5px" type="radio"   name="sex" value="1">男</label>
                <lable><input style="margin-top:0;margin-right:5px;margin-left:5px" type="radio"   name="sex" value="2">女</label>
            </td>
        </tr>
        <tr>
            <td style="vertical-align:middle; text-align:center;">留言</td>
            <td style="vertical-align:middle; text-align:center;">
                <textarea class="form-control" rows="10" name="content"></textarea>
            </td>
        </tr> 
         
     </table>
     </form>
     <div class="text-center">
         <button style="outline:0;margin-bottom:20px;width:240px;padding:15px;background:#F586A1;border-radius:100px;border:none;box-shadow:0 0 5px #777;color:#fff;font-size:18px">提交</button>
         <h4 style="margin-bottom:10px;">电话咨询请直接拨打咨询电话</h4>
         <a href="tel:4008808888"><h3 style="color:red">400-880-8888</h3></a>
     </div>
 </div>
<script>
    j('button').click(function(){
        var s = j('form').serializeArray();
        j.post('weixin/app/up',s,function(d){
            if(d.code!=200)alert(d.desc);
            else alert('提交成功');
        },'json')
    })
    
    
    
</script>


<!--{template tool:footer}-->


<?php
namespace plugin\adminloader\control;
use control;
use plugin\adminloader\control\form\input;
defined('IN_PLAY') || exit('Access Denied');
class core extends control{
	
	function _beginning(){
		
	}
	function a(){
		
		T('tool:header');
		echo '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button><h4 class="modal-title" id="myModalLabel">修改</h4></div><div class="modal-body"><form>';
		echo new input('username','用户名');
		echo $pwd = new input(array('label'=>'密码','name'=>'pwd'));
		echo $pwd2 = new input(array('label'=>'重复密码'));
		echo '</form></div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">关闭</button><button type="button" class="btn btn-primary save">保存</button></div></div></div></div>';
		echo '<script>j(".modal").modal("toggle")</script>';
		T('tool:footer');
		
	}
}


?>
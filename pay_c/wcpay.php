<?php
$postStr = file_get_contents ( 'php://input' );
$result = simplexml_load_string ( $postStr );
header('Location:/app/item/pay_c/'.$result->out_trade_no);


?>
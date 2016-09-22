<?php
$postStr = file_get_contents ( 'php://input' );
file_put_contents ( 't.txt', $postStr  );

$result = simplexml_load_string ( $postStr );
file_put_contents ( 't2.txt', serialize($result) );
header('Location:/app/item/pay_c/'.$result->out_trade_no);


?>
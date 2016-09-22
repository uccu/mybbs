<?php
$postStr = file_get_contents ( 'php://input' );
preg_match('#(98\d{20})#',$postStr,$zk);
file_put_contents ( 't2.txt', serialize($zk) );
header('Location:/app/item/pay_c/'.$zk[1]);


?>
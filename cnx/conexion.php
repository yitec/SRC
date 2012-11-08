<?php
function conectar()
{
	mysql_connect("localhost", "root", "1q2w3e");
//	mysql_connect("192.168.0.3", "sid", "mizard777");
//	mysql_connect("bdsrc.db.8845103.hostedresource.com", "bdsrc", "Q1w2e3r4");
	
	mysql_select_db("bd_src");
	
	//mysql_connect('192.168.0.2', 'root@SID-LAPTOP', '1q2w3e');
	//mysql_select_db("bd_src");
}

function desconectar()
{
	mysql_close();
}
?>
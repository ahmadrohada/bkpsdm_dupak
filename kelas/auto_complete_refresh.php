<?php
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';
Connect::getConnection();

$keyword = '%'.$_POST['keyword'].'%';
$row = mysql_query("SELECT * FROM kd_skpd WHERE sekolah LIKE '$keyword' and ( sekolah LIKE '%sd%' or sekolah LIKE '%SM%') ORDER BY kd_skpd ASC LIMIT 0, 10 ");

while ($rs = mysql_fetch_array($row)){
	// put in bold the written text
	$nama_skpd = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['sekolah']);
	// add new option
    echo '<li onclick="set_item(\''.str_replace("'", "\'", $rs['sekolah']).'\')">'.$nama_skpd.'</li>';
}
?>
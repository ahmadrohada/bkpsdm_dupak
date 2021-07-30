<?php
$kd_skpd = isset($_SESSION['kd_skpd']) ? $_SESSION['kd_skpd'] : '';
$id_pegawai = isset($_SESSION['id_pegawai']) ? $_SESSION['id_pegawai'] : '';
Connect::getConnection();
$skpd	= mysql_fetch_object(mysql_query("SELECT sekolah FROM kd_skpd WHERE kd_skpd='$kd_skpd' "));

$sekolah = isset($skpd->sekolah) ? $skpd->sekolah : 'all data';
?>
<ul id="nav">
	<li>
		<a href="home.php?page=history_pak&id=<?php echo $id_pegawai?>">HISTORY PAK</a>
    </li>

	
	<li>
        <a href="home.php?page=new_dupak&id_pegawai=<?php echo $id_pegawai?>">INPUT DUPAK</a>
    </li>


	<li>
        <a href="#">DATA</a>
        <ul>
			<li>
                <a href="home.php?page=data_dupak_guru">Data Dupak</a>
            </li>
            <li>
                <a href="home.php?page=data_pak_guru">Data PAK</a>
            </li>
			
        </ul>
    </li>
</ul>
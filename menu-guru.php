<?php
$kd_skpd = isset($_SESSION['kd_skpd']) ? $_SESSION['kd_skpd'] : '';
Connect::getConnection();
$skpd	= mysql_fetch_object(mysql_query("SELECT sekolah FROM kd_skpd WHERE kd_skpd='$kd_skpd' "));

$sekolah = isset($skpd->sekolah) ? $skpd->sekolah : 'all data';
?>
<ul id="nav">
	<li>
		<a href="#">DATA GURU</a>
        <ul>
			<li>
                <a href="home.php?page=data_guru">Lihat Data Guru</a>
            </li>
			<li>
                <a href="home.php?page=tambah_guru">Tambah Guru</a>
            </li>
        </ul>
    </li>

	
	<li>
        <a href="#">DUPAK BARU</a>
        <ul>
			<li>
                <a href="home.php?page=input_dupak">Input  Dupak Baru </a>
            </li>
			<li>
                <a href="home.php?page=kirim_dupak">Kirim Data Dupak Baru</a>
            </li>
			<li>
                <a href="home.php?page=pengantar_dupak">Data Pengantar Dupak</a>
            </li>
        </ul>
    </li>


	<li>
        <a href="#">DATA DUPAK</a>
        <ul>
			<li>
                <a href="home.php?page=data_dupak">Lihat Data Dupak</a>
            </li>
			
        </ul>
    </li>
	<li>
        <a href="#">DATA PAK</a>
        <ul>
			<li>
                <a href="home.php?page=data_pak">Lihat Data PAK</a>
            </li>
			
        </ul>
    </li>
	
	


</ul>
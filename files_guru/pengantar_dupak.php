<?php//CARI DATA SKPD$kd_skpd = isset($_SESSION['kd_skpd']) ? $_SESSION['kd_skpd'] : '';include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';$d 		= New FormatTanggal();Connect::getConnection();$skpd	= mysql_fetch_object(mysql_query("SELECT sekolah FROM kd_skpd WHERE kd_skpd='$kd_skpd' "));$sekolah = isset($skpd->sekolah) ? $skpd->sekolah : 'all data';$p=isset($_GET['aksi'])?$_GET['aksi']:null;switch($p){default:?><!--=====================================================- > **********************************************************                   TAMPIL DATA PENGANTAR
**********************************************************
<--====================================================---->	
<h3 class="page-header">
DATA SURAT PENGANTAR&nbsp;&nbsp; [ <?php echo $sekolah; ?> ]
</h3><table border="1" class="data table-hover" width="75%">
<thead>
        <tr>
			<th width="6%">No</th>
            <th width="23%">NO SURAT</th>
            <th width="24%">TANGGAL</th>			 <th width="24%">JUMLAH BERKAS</th>
			<th >AKSI</th>
        </tr>    
</thead>
<tbody>	
<?php
	$data = mysql_query("SELECT * FROM dt_dupak_pengantar WHERE kd_skpd='$kd_skpd' ");	$no = 1;while ( $r = mysql_fetch_array($data)){
?>
<tr>
	<td align="center" width="5%">
		<?php echo $no; ?>
	</td>
	<td width="">
		<?php echo $r['no_surat']; ?>
	</td>
    <td align="center">
		<?php echo $d->tgl_form($r['tgl_surat']); ?>
	</td>	 <td align="center">		<?php 		$jm = mysql_num_rows(mysql_query("SELECT no_dupak FROM dt_dupak WHERE id_pengantar = '$r[id_pengantar]' "));		echo $jm."&nbsp; berkas";		?>	</td>
	<td align="center">		<a href="?page=cetak_surat_pengantar&id_pengantar=<?php echo $r['id_pengantar']; ?>" class="aksi">CETAK</a>
	</td>
</tr>
<?php
$no = $no+1;
}
?>
</tbody>
</table>
<br>
<?phpbreak;case 'detail';Connect::getConnection();$id_pengantar = isset($_GET['id_pengantar']) ? $_GET['id_pengantar'] : '';$data = mysql_fetch_object(mysql_query("SELECT * FROM dt_dupak_pengantar WHERE id_pengantar='$id_pengantar' and kd_skpd='$kd_skpd'  "));?><div class="media_print"><?phpinclude 'cetak_pengantar.php';?></div><div style="background:#f5f4f5; margin:auto; width:76%; padding:20px; border-radius:10px;"><p align="left"><button onclick="window.print()" class="ui-state-default cetak"  >Cetak</button></p><br><hr><br><table class="" border="0" width="43%"><tr>	<td width="28%">		Nomor Surat	</td>	<td>:</td>	<td width="70%">		<?php				echo $data->no_surat;		?>	</td></tr><tr>	<td>		Tanggal Surat	</td>	<td>:</td>	<td>		<?php				echo $d->balik2($data->tgl_surat);		?>	</td></tr><tr>	<td>		Tujuan	</td>	<td>:</td>	<td>		<?php				echo $data->tujuan;		?>	</td></tr></table><br>Data DUPAK <table border="1" class="data table-hover" width="100%"><thead>        <tr>			<th width="6%">No</th>            <th width="20%">NO DUPAK</th>            <th width="10%">TANGGAL DUPAK</th>			<th width="18%">NIP</th>			<th width="25%">NAMA LENGKAP</th>			<th width="*%">GOL. RUANG/ TMT</th>        </tr>    </thead><tbody>	<?php$data = mysql_query("SELECT * FROM dt_pengantar_tu WHERE id_pengantar='$id_pengantar' ");	$no = 1;	while ( $r = mysql_fetch_array($data)){	//detail data dupak	$dupak = mysql_fetch_object(mysql_query("SELECT * FROM dt_dupak WHERE no_dupak ='$r[no_dupak]' "));?><tr>	<td align="center" width="5%">		<?php echo $no; ?>	</td>	<td width="" align="center">		<?php echo $r['no_dupak']; ?>	</td>    <td align="center">		<?php  echo $d->balik2($dupak->tgl_dupak); ?>	</td>    <td  align="center">		<?php  echo $dupak->nip_baru; ?>	</td>	 <td >		<?php  		$dtp = mysql_fetch_object(mysql_query("SELECT nama FROM dt_pegawai WHERE nip_baru ='$dupak->nip_baru' "));		echo $dtp->nama; 		?>	</td>	<td  align="center">		<?php 			echo $dupak->nama_gol.'/'.$d->balik($dupak->tmt_gol);		?>	</td></tr><?php$no = $no+1;}?></tbody></table><br><table width="100%" border="0"><tr>	<td width="68%" rowspan="4">			</td>	<td align="center">		Mengetahui,	</td></tr><tr>	<td align="center">		KEPALA SEKOLAH &nbsp;<?php echo $sekolah; ?>	</td></tr><tr>	<td height="56px">			</td></tr><tr>	<td align="center">		<?php echo "(&nbsp;".$dupak->nama_kepsek."&nbsp;)"; ?>	</td></tr></table></div><?phpbreak;}?>

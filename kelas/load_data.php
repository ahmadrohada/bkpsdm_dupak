

<?php
session_start();
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';
$d 		= New FormatTanggal();

$kd_skpd 		= isset($_SESSION['kd_skpd']) ? $_SESSION['kd_skpd'] : '';
$nama_penilai	= isset($_SESSION['nama_lengkap']) ? $_SESSION['nama_lengkap'] : '';
$op				=isset($_GET['op'])?$_GET['op']:null;
$no_dupak		=isset($_GET['no_dupak'])?$_GET['no_dupak']:null;



switch($op){



// LOAD TABEL via ajax //
case "load_tbl_diklat":
Connect::getConnection();
$diklat=mysql_query("select * from dt_dupak_diklat WHERE no_dupak='$no_dupak' ");
    echo "<thead>
            <tr>
                <th width='*%'>Nama Diklat</th>
                <th width='10%'>Waktu</th>
				<th width='10%'>AK</th>
				<th width='20%'>Aksi</th>
				<th width='10%'>Ket</th>
            </tr>
        </thead>";
  
    while($r=mysql_fetch_array($diklat)){
        echo "<tr>
                <td>".$r['nama_diklat']."</td>
                <td align='center'>".$r['jp']."</td>
				<td align='center'>".$r['ak']."</td>
				<td align='center'>
				<a href='#' value='".$r['id']."' class='aksi edit_diklat'>EDIT</a>
				<a href='#' value='".$r['id']."' class='aksi hapus_diklat'>HAPUS</a>
				</td>
				<td align='center'>".$r['keterangan']."</td>
            </tr>";
    }
break;
case "load_tbl_kolektif":
Connect::getConnection();
$kolektif=mysql_query("select * from dt_dupak_kegiatan_kolektif WHERE no_dupak='$no_dupak' ");
    echo "<thead>
            <tr>
                <th width='*%'>Nama Kegiatan Kolektif</th>
				<th width='10%'>AK</th>
				<th width='20%'>Aksi</th>
				<th width='10%'>Ket</th>
            </tr>
        </thead>";
  
    while($r=mysql_fetch_array($kolektif)){
        echo "<tr>
                <td>".$r['nama_kegiatan']."</td>
				 <td align='center'>".$r['ak']."</td>
				<td align='center'>
				<a href='#' value='".$r['id']."' class='aksi edit_kolektif'>EDIT</a>
				<a href='#' value='".$r['id']."' class='aksi hapus_kolektif'>HAPUS</a>
				</td>
				<td align='center'>".$r['keterangan']."</td>
            </tr>";
    }
break;
case "load_tbl_piki":
Connect::getConnection();
$piki=mysql_query("select * from dt_dupak_piki WHERE no_dupak='$no_dupak' ");
    echo "<thead>
            <tr>
                <th width='*%'>Judul PIKI</th>
                <th width='10%'>Tahun</th>
                <th width='10%'>AK</th>
				<th width='20%'>Aksi</th>
				<th width='10%'>Ket</th>
            </tr>
        </thead>";
  
    while($r=mysql_fetch_array($piki)){
        echo "<tr>
                <td>".$r['judul_piki']."</td>
                <td align='center'>".$r['th_piki']."</td>
                <td align='center'>".number_format($r['ak_piki'],3)."</td>
				<td align='center'>
				<a href='#' value='".$r['id']."' class='aksi edit_piki'>EDIT</a>
				<a href='#' value='".$r['id']."' class='aksi hapus_piki'>HAPUS</a>
				</td>
				<td align='center'>".$r['keterangan']."</td>
            </tr>";
    }
break;
case "v_pkb":
Connect::getConnection();
$kd_keg		=isset($_GET['kd_keg'])?$_GET['kd_keg']:'';

if ( $kd_keg <= 24) {

	$diklat=mysql_query("select * from dt_dupak_diklat WHERE no_dupak='$no_dupak' and kode_kegiatan='$kd_keg'  ");
    echo "<thead>
            <tr>
                <th width='52%'>Nama Diklat</th>
                <th width='10%'>JP</th>
                <th width='10%'>AK</th>
				 <th width='30%'>Aksi</th>
            </tr>
        </thead>";
  
    while($r=mysql_fetch_array($diklat)){
        echo "<tr>
                <td>".$r['nama_diklat']."</td>
                <td align='center'>".$r['jp']." Jam</td>
                <td align='center'>".number_format($r['ak'],3)."</td>
				<td align='center'>
				<a href='#' value='".$r['id']."' class='aksi tolak_diklat'>Tolak</a>
				<a href='#' value='".$r['id']."' class='aksi terima_diklat'>Terima</a>
				</td>
            </tr>";
    }
}else{
	$kk=mysql_query("select * from dt_dupak_kegiatan_kolektif WHERE no_dupak='$no_dupak' and kode_kegiatan='$kd_keg'");
    echo "<thead>
            <tr>
                <th width='62%'>Nama Kegiatan Kolektif</th>
                <th width='10%'>AK</th>
				 <th width='30%'>Aksi</th>
            </tr>
        </thead>";
  
    while($r=mysql_fetch_array($kk)){
        echo "<tr>
                <td>".$r['nama_kegiatan']."</td>
                <td align='center'>".number_format($r['ak'],3)."</td>
				<td align='center'>
				<a href='#' value='".$r['id']."' class='aksi tolak_kk'>Tolak</a>
				<a href='#' value='".$r['id']."' class='aksi terima_kk'>Terima</a>
				</td>
            </tr>";
	
	}
}
break;
case "v_piki":
Connect::getConnection();
$kd_keg		=isset($_GET['kd_keg'])?$_GET['kd_keg']:'';
	$piki	=	mysql_query("select * from dt_dupak_piki WHERE no_dupak='$no_dupak' and kd_kegiatan='$kd_keg'  ");
    
	
	
	echo "<thead>
            <tr>
                <th width='52%'>Judul PIKI</th>
                <th width='10%'>Tahun</th>
                <th width='10%'>AK</th>
				 <th width='30%'>Aksi</th>
            </tr>
        </thead>";
  
    while($r=mysql_fetch_array($piki)){
        echo "<tr>
                <td>".$r['judul_piki']."</td>
                <td align='center'>".$r['th_piki']."</td>
                <td align='center'>".number_format($r['ak_piki'],3)."</td>
				<td align='center'>
				<a href='#' value='".$r['id']."' class='aksi tolak_piki'>Tolak</a>
				<a href='#' value='".$r['id']."' class='aksi terima_piki'>Terima</a>
				</td>
            </tr>";
    }

break;
}
?>

<script>
$(document).ready(function () {
	
	// DIKLAT //
	$(".edit_diklat").click(function(){
	var id_diklat = $(this).attr('value');
	$.ajax({
		url:"./kelas/detail.php",
        data:"op=detail_diklat_dupak&id_diklat="+id_diklat,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					data=msg.split("|");
						$( "#edit_id_diklat").val(data[0]);
						$( "#edit_nama_diklat").val(data[5]);
						$( "#edit_penyelenggara_diklat").val(data[6]);
						$( "#edit_jp").val(data[3]);
						$( "#edit_tgl_mulai_diklat").val(data[7]);
						$( "#edit_tgl_selesai_diklat").val(data[8]);
						$( "#edit_tgl_sertifikat").val(data[9]);
						$( "#edit_no_sertifikat").val(data[10]);
						$( "#edit_kode_kegiatan").val(data[2]);
						$( "#edit_ak").val(data[4]);
						
					}
    })
	$( "#form_edit_diklat" ).dialog( "open" );	
	});

	$(".hapus_diklat").click(function(){
	var id_diklat = $(this).attr('value');
	$.ajax({
		url:"./kelas/detail.php",
        data:"op=detail_diklat_dupak&id_diklat="+id_diklat,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					data=msg.split("|");
						$( "#hapus_id_diklat").val(data[0]);
						$( "#hapus_nama_diklat").val(data[5]);
						$( "#hapus_penyelenggara_diklat").val(data[6]);
						$( "#hapus_jp").val(data[3]);
						$( "#hapus_tgl_mulai_diklat").val(data[7]);
						$( "#hapus_tgl_selesai_diklat").val(data[8]);
						$( "#hapus_tgl_sertifikat").val(data[9]);
						$( "#hapus_no_sertifikat").val(data[10]);
						$( "#hapus_kode_kegiatan").val(data[2]);
						$( "#hapus_ak").val(data[4]);
						
					}
    })
	$( "#form_hapus_diklat" ).dialog( "open" );	
	});
	
	
	$(".edit_kolektif").click(function(){

	var id_kolektif = $(this).attr('value');
	$.ajax({
		url:"./kelas/detail.php",
        data:"op=detail_kolektif_dupak&id_kolektif="+id_kolektif,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					data=msg.split("|");
						$("#edit_id_kolektif").val(data[0]);
						$("#edit_kode_kegiatan_kolektif").val(data[1]);
						$("#cb_edit_kegiatan_kolektif").val(data[2]);
						$("#cb_edit_sub_kegiatan_2").val(data[3]);	
						$("#edit_ak_kolektif").val(data[4]);
						$("#edit_nm_kegiatan_kolektif").val(data[5]);
						$("#edit_tgl_kegiatan_kolektif").val(data[6]);
					}
    })
	$( "#form_edit_kolektif" ).dialog( "open" );	
	});

	$(".hapus_kolektif").click(function(){
	var id_kolektif = $(this).attr('value');
	$.ajax({
		url:"./kelas/detail.php",
        data:"op=detail_kolektif_dupak&id_kolektif="+id_kolektif,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					data=msg.split("|");
						$("#hapus_id_kolektif").val(data[0]);
						$("#hapus_kode_kegiatan_kolektif").val(data[1]);
						$("#cb_hapus_kegiatan_kolektif").val(data[2]);
						$("#cb_hapus_sub_kegiatan_2").val(data[3]);	
						$("#hapus_ak_kolektif").val(data[4]);
						$("#hapus_nm_kegiatan_kolektif").val(data[5]);
						$("#hapus_tgl_kegiatan_kolektif").val(data[6]);
						
					}
    })
	$( "#form_hapus_kolektif" ).dialog( "open" );	
	});
	
	$(".edit_piki").click(function(){

	var id_piki = $(this).attr('value');
	$.ajax({
		url:"./kelas/detail.php",
        data:"op=detail_piki_dupak&id_piki="+id_piki,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					data=msg.split("|");
						$("#edit_id_piki").val(data[0]);
						$("#edit_judul_piki").val(data[1]);
						$("#edit_th_piki").val(data[2]);
						$("#edit_kode_kegiatan_piki_awal").val(data[3]);	
						$("#edit_ak_piki_awal").val(data[4]);
						$("#edit_ak_piki").val(data[4]);
						$("#cb_edit_kriteria_piki").val(data[5]);
						$("#sub_edit_kriteria_piki").val(data[3]);
					}
    })
	$( "#form_edit_piki" ).dialog( "open" );	
	});
	
	$(".hapus_piki").click(function(){

	var id_piki = $(this).attr('value');
	$.ajax({
		url:"./kelas/detail.php",
        data:"op=detail_piki_dupak&id_piki="+id_piki,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					data=msg.split("|");
						$("#hapus_id_piki").val(data[0]);
						$("#hapus_judul_piki").val(data[1]);
						$("#hapus_th_piki").val(data[2]);
						$("#hapus_kode_kegiatan_piki").val(data[3]);	
						$("#hapus_ak_piki").val(data[4]);
						$("#hapus_ak_piki").val(data[4]);
						$("#cb_hapus_kriteria_piki").val(data[5]);
						$("#sub_hapus_kriteria_piki").val(data[3]);
					}
    })
	$( "#form_hapus_piki" ).dialog( "open" );	
	});
	
	$(".terima_diklat").click(function(){
		var id_diklat = $(this).attr('value');
		$.ajax({
		url:"./kelas/verifikasi.php",
        data:"op=v_ket_diklat&id_diklat="+id_diklat+"&ket=diterima",
                    cache:false,
                    success:function(msg){
					//alert (msg);
					
					}
		})
		$( "#v_pkb" ).dialog( "close" );
	});
	
	$(".tolak_diklat").click(function(){
		var id_diklat = $(this).attr('value');
		$.ajax({
		url:"./kelas/verifikasi.php",
        data:"op=v_ket_diklat&id_diklat="+id_diklat+"&ket=ditolak",
                    cache:false,
                    success:function(msg){
					//alert (msg);
					
					}
		})
		$( "#v_pkb" ).dialog( "close" );
	});
	
	$(".terima_kk").click(function(){
		var id_kk = $(this).attr('value');
		$.ajax({
		url:"./kelas/verifikasi.php",
        data:"op=v_ket_kk&id_kk="+id_kk+"&ket=diterima",
                    cache:false,
                    success:function(msg){
					//alert (msg);
					
					}
		})
		$( "#v_pkb" ).dialog( "close" );
	});
	
	$(".tolak_kk").click(function(){
		var id_kk = $(this).attr('value');
		$.ajax({
		url:"./kelas/verifikasi.php",
        data:"op=v_ket_kk&id_kk="+id_kk+"&ket=ditolak",
                    cache:false,
                    success:function(msg){
					//alert (msg);
					
					}
		})
	$( "#v_pkb" ).dialog( "close" );	
	});
	
	
	$(".terima_piki").click(function(){
		var id_piki = $(this).attr('value');
		$.ajax({
		url:"./kelas/verifikasi.php",
        data:"op=v_ket_piki&id_piki="+id_piki+"&ket=diterima",
                    cache:false,
                    success:function(msg){
					//alert (msg);
					
					}
		})
		$( "#v_piki" ).dialog( "close" );
	});
	
	$(".tolak_piki").click(function(){
		var id_piki = $(this).attr('value');
		$.ajax({
		url:"./kelas/verifikasi.php",
        data:"op=v_ket_piki&id_piki="+id_piki+"&ket=ditolak",
                    cache:false,
                    success:function(msg){
					//alert (msg);
					
					}
		})
	$( "#v_piki" ).dialog( "close" );	
	});
	
	
});
</script>
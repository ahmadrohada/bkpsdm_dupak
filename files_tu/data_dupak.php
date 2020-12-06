

<script>
$(document).ready(function () {
	
	$(".hapus").click(function(){
		var id_dupak = $(this).attr('value');
		//alert(id_dupak);
		cek_step(id_dupak);
    });
	
	$(".lihat").click(function(){
		var id_dupak = $(this).attr('value');
		//alert(id_dupak);
		cek_step2(id_dupak);
    });
	
	$(".cetak").click(function(){
		var no_dupak = $(this).attr('value'); //
		
		$.ajax({
		url:"./kelas/proses.php",
		data:"op=cek_step&no_dupak="+no_dupak,
            cache:false,
            success:function(msg){
				data=msg.split("|");
				//alert(msg);
				if ( data[0] == 6 ) {
					window.location.assign("?page=cetak_data_dupak&no_dupak="+no_dupak);
				} else if ( data[0] > 6 ) {
				
				$("#dialog-form").html(
				"<center><span class='ui-icon ui-icon-alert' style='float:left; margin:0 0 10px 5px;'></span>"
				+"Data Dupak yang sudah dikirim ke TIM Pak tidak dapat dicetak</center>"
				);
	
				$("#dialog-form").dialog({
				//autoOpen: false,
				show:"clip",
				hide:"clip",
				draggable:false,
				resizable: false,
				modal: true,
				title  : 'SIPULPENPAKGURU',
				height: 170,
				width: 450,
				buttons: {
					"Tutup": function () {
						$(this).dialog('close');
					}
				}
				});
					
					
				} else if ( data[0] < 6 ) {
				
				$("#dialog-form").html(
				"<center><span class='ui-icon ui-icon-alert' style='float:left; margin:0 0 10px 5px;'></span>"
				+"Pengisian Dupak belum selesai</center>"
				);
	
				$("#dialog-form").dialog({
				//autoOpen: false,
				show:"clip",
				hide:"clip",
				draggable:false,
				resizable: false,
				modal: true,
				title  : 'SIPULPENPAKGURU',
				height: 170,
				width: 450,
				buttons: {
					"Lanjutkan Pengisian": function () {
						window.location.assign("?page=form_dupak&id_dupak="+data[4]);
						$(this).dialog('close');
				},
					"Tutup": function () {
						$(this).dialog('close');
					}
				}
				});
					
					
				}
			}
		})
		
		
		
    });
	
	//cek step untuk memastikan mana dupak yang boleh dihapus atau tidak
	//kurang dari  = 6 boleh dihapus
	
	function cek_step(id_dupak){
	$.ajax({
		url:"./kelas/proses.php",
		data:"op=cek_step&id_dupak="+id_dupak,
            cache:false,
            success:function(x){
				data=x.split("|");
				//alert(x);
				if ( data[0] <= 6 ) {
					hapus(id_dupak);
				} else {
					cegah_hapus(id_dupak);
				}
			}
	})
	}
	
	//cek step untuk memastikan mana dupak yang bisa dilihat
	
	
	function cek_step2(id_dupak){
	$.ajax({
		url:"./kelas/proses.php",
		data:"op=cek_step&id_dupak="+id_dupak,
            cache:false,
            success:function(x){
				//alert(x);
				data=x.split("|");
				if ( data[0] == 19 ) {
					//alert("lihat");
					window.location.assign("?page=detail_dupak&id_dupak="+id_dupak);
				} else {
						$("#dialog-form").html(
						"<center><span class='ui-icon ui-icon-alert' style='float:left; margin:0 0 10px 5px;'></span>"
						+"Sedang Proses Pemeriksaan Tim Penilai</center>"
						);
			
						$("#dialog-form").dialog({
						//autoOpen: false,
						show:"clip",
						hide:"clip",
						draggable:false,
						resizable: false,
						modal: true,
						title  : 'SIPULPENPAKGURU',
						height: 170,
						width: 450,
						buttons: {
							"Tutup": function () {
								$(this).dialog('close');
							}
						}
						});
				}
			}
	})
	}
	
	
	function hapus(id_dupak){
		$("#dialog-confirm").html("<center>DUPAK akan dihapus beserta data kegiatannya</center>");
		$("#dialog-confirm").dialog({
        show:"clip",
		hide:"clip",
		draggable:false,
        resizable: false,
        modal: true,
        title  : 'SIPULPENPAKGURU',
        height: 170,
        width: 450,
   
        buttons: {
				"Batal": function () {
                $(this).dialog('close');
			
				
            },
                "Hapus": function () {
				//alert(id_dupak);
				$.ajax({
					url:"./kelas/dupak.php",
					data:"op=hapus&id_dupak="+id_dupak,
						cache:false,
						success:function(msg){
						//alert(msg);
						window.location.assign("?page=data_dupak");
						}
				})
				
				
				
                $(this).dialog('close');
            }
        }
    });	
	}
	
	function cegah_hapus(id_dupak){
		$("#dialog-confirm").html("<center>DUPAK yang sudah diajukan tidak dapat dihapus</center>");
		$("#dialog-confirm").dialog({
		show:"clip",
		hide:"clip",
		draggable:false,
        resizable: false,
        modal: true,
        title  : 'SIPULPENPAKGURU',
        height: 170,
        width: 450,
        buttons: {
				"Tutup": function () {
				 $(this).dialog('close');
            }
        }
    });	
	}

});
</script>


<!--=====================================================- > 
**********************************************************
                   TAMPIL DATA DUPAK
**********************************************************
<--====================================================---->


<h3 class="page-header">
DATA DUPAK
</h3>

<table  width="100%">
<tr>
	<td align="right">
		<form action="" method="post">
		Cari dengan No DUPAK, Nip Baru  atau Nama Pegawai &nbsp;&nbsp;&nbsp;<input  type="text" name="txtcari"  size="33" maxlength="34"> 
		<input type="submit" name="cari" value="Cari">
		</form>
	</td>
</tr>
</table>
<br>
<table border="1" class="data table-hover" width="100%">
<thead>
        <tr>
			<th width="4%">No</th>
			<th width="14%">NO DUPAK</th>
			<th width="13%">NIP BARU</th>
			<th>NAMA PEGAWAI</th>
			<th width="17%">PROSES</th>
			<th width="10%">STATUS</th>
			<th width="18%">AKSI</th>
        </tr>    
</thead>
<tbody>	
<?php
$kd_skpd = isset($_SESSION['kd_skpd']) ? $_SESSION['kd_skpd'] : '';

if((!isset($_GET['hal'])) | (isset($_POST['cari'])))
	{
		$nohal = 1;
	} 
	else 
		$nohal = $_GET['hal'];

$nama_file = "data_dupak";		
$dataperhal = 20;
$offset = ($nohal - 1) * $dataperhal; //no record awal yang akan ditampilkan
$page= array(); //menampilkan data dengan pagination
$all= array(); //menampilkan data tanpa pagination


$page['limit'] = $offset.",".$dataperhal;
//PENCARIAN DATA
$_POST['cari'] = isset($_POST['cari']) ? $_POST['cari'] : '';
$_GET['cari'] = isset($_GET['cari']) ? $_GET['cari'] : '';

$page['field'] = "distinct dt_dupak.id_pegawai, dt_pegawai.nama, dt_pegawai.nip_baru,dt_dupak.id,dt_dupak.no_dupak,dt_dupak.step,dt_dupak.status_dupak";
$all['field'] = "distinct dt_dupak.id_pegawai,dt_pegawai.nama, dt_pegawai.nip_baru,dt_dupak.id,dt_dupak.no_dupak,dt_dupak.step,dt_dupak.status_dupak";


//PENCARIAN DATA
if( (isset($_POST['cari'])) | (isset($_GET['cari']))){
		if($_POST['cari']!=null){
			$txtcari=$_POST['txtcari'];
		}else
		$txtcari=$_GET['cari'];
		
		//pencarian data
		$page['jika'] = "dt_pegawai.id_pegawai = dt_dupak.id_pegawai and (dt_pegawai.nip_baru = '$txtcari' or nama LIKE '%$txtcari%' or dt_dupak.no_dupak = '$txtcari') and dt_dupak.kd_skpd='$kd_skpd'";
		$all['jika'] = "dt_pegawai.id_pegawai = dt_dupak.id_pegawai and (dt_pegawai.nip_baru = '$txtcari' or nama LIKE '%$txtcari%' or dt_dupak.no_dupak = '$txtcari') and dt_dupak.kd_skpd='$kd_skpd' ";
		
		$_SESSION['cari']= $txtcari; //menyiapkan GET cari untuk pagination
		$_SESSION['nama_file']= $nama_file;
		
} else {
		//defaul data	
		$page['jika'] = "dt_pegawai.id_pegawai = dt_dupak.id_pegawai and dt_dupak.kd_skpd='$kd_skpd'";
		$all['jika'] = "dt_pegawai.id_pegawai = dt_dupak.id_pegawai and dt_dupak.kd_skpd='$kd_skpd'";
}

	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';
	$dataPak	= 	New KelolaDataDupak();
	$hasil 		= 	$dataPak->TampilDataDupak("dt_dupak,dt_pegawai",$page);

	//mencari jumlah data yang harus ditampilkan perhalaman
	$hasil2= $dataPak->TampilDataDupak("dt_dupak,dt_pegawai",$all);
	$jumdata=0;
	foreach($hasil2 as $j){ $jumdata=$jumdata+1; }
	$jumhal = ceil($jumdata/$dataperhal);
	//penomoran data
	$no=1 + ($nohal*$dataperhal) -$dataperhal;



	foreach($hasil as $r)
	{
	
	//pencarian gelar pada data PAK
	$x = mysql_query("SELECT no_pak FROM dt_pak WHERE nip_baru='$r->nip_baru' ORDER BY tgl_pak ASC");
	$data = mysql_num_rows($x);
	//jika ditemukan data lebih dari 1
	if ( $data > 1 ) {
		while ($c = mysql_fetch_array($x)){
					$dpt = $c['no_pak'];
			}
					$pak_terakhir = mysql_fetch_object(mysql_query("SELECT * FROM dt_pak WHERE no_pak='$dpt' "));
			} else {
					$pak_terakhir = mysql_fetch_object(mysql_query("SELECT * FROM dt_pak WHERE nip_baru='$r->nip_baru' ORDER BY tgl_pak DESC"));
			}
	
	$pak_terakhir = isset($pak_terakhir->no_pak) ? $pak_terakhir->no_pak : '';
	
	$glr		=   mysql_fetch_object(mysql_query("SELECT gelar_dpn,gelar_blk FROM tb_pak_guru_pend WHERE no_pak='$pak_terakhir' "));
	$d 			= 	New FormatTanggal();	
?>
<tr>
	<td align="center">
		<?php echo $no; ?>
	</td>
	<td width="20%"  align="center">
		<?php echo $r->no_dupak; ?>
	</td>
	<td align="center">
	<?php echo $r->nip_baru; ?>
	</td>
	<td align="" >
	<?php 
		$g_blk = isset($glr->gelar_blk) ? $glr->gelar_blk : '';
		if ($g_blk == null ) 
		{ $koma = ""; } else { $koma = ", ";};
		$g_dpn = isset($glr->gelar_dpn) ? $glr->gelar_dpn : '';
		if ($g_dpn == null ) 
		{ $titik = ""; } else { $titik = ". ";};
		echo  $g_dpn.$titik.ucwords(strtolower($r->nama)).$koma.$g_blk;
	?>
	</td>
   
	<td >
	<?php
	switch($r->status_dupak)
		{
		case "level_1" : $status='Tata Usaha';
			break;
		case "level_2" : $status='Tim Penilai PAK';
			break;
		case "level_3" : $status='Sekretariat';
			break;
		case "level_4" : $status='Penandatangan';
			break;
		}
	
	
		echo $status;

	?>
	</td>
	<td >
	<?php 
	switch($r->step)
		{
		case 1 : $pg='10';
			break;
		case 2 : $pg='20';
			break;
		case 3 : $pg='40';
			break;
		case 4 : $pg='60';
			break;
		case 5 : $pg='80';
			break;
		case 6 : $pg='95';
			break;
		case 7 : $pg='0';
			break;
		case 8 : $pg='11';
			break;
		case 9 : $pg='20';
			break;
		case 10 : $pg='30';
			break;
		case 11 : $pg='40';
			break;
		case 12 : $pg='45';
			break;
		case 13 : $pg='50';
			break;
		case 14 : $pg='50';
			break;
		case 15 : $pg='70';
			break;
		case 16 : $pg='80';
			break;
		case 17 : $pg='85';
			break;
		case 18 : $pg='90';
			break;
		case 19 : $pg='0';
			break;
		case 20 : $pg='50';
			break;
		case 21 : $pg='75';
			break;
		default : $pg='100';
			break;
		}
	
	
	
	
	?>
	<div style="border:solid #7d7d7d 1px; width:100px; height:12px;">
		<img src="images/forms/progress.gif" class="progres_bar"  height="12px" width="<?php echo $pg; ?>">
	</div>
	</td>
	<td align="center">
		
		<a href="#" class="aksi cetak" value="<?php echo $r->no_dupak; ?>" >CETAK</a>
		
		
		<?php if ($r->step <= 5 ){ ?>
		<a href="?page=form_dupak&id_dupak=<?php echo $r->id; ?>" class="aksi" >LANJUT</a>
		
		<?php } else if ($r->step == 6 ){ ?>
		<a href="?page=form_dupak&id_pegawai=<?php echo $r->id_pegawai; ?>" class="aksi" >&nbsp;LIHAT&nbsp;</a>
		<?php } else  { ?>
			
		<a href="#" class="aksi lihat" value="<?php echo $r->id_dupak; ?>" > &nbsp;LIHAT&nbsp;</a>	
		<?php } ?>
		
		<a href="#" class="aksi hapus" value="<?php echo $r->id_dupak; ?>" >HAPUS</a>
		
	</td>
</tr>
<?php
$no = $no+1;
}
?>
</tbody>
</table>

<?php
include ("kelas/pagination.php"); 
?>

<?php if(!isset($_SERVER['HTTP_REFERER'])) { ?><script type="text/javascript">document.location  = "./index.php";</script><?php exit(); }  ?><script>$(document).ready(function () {$( "#load_kirim_tu" ).hide();$("#checkAll").change(function () {    $("input:checkbox").prop('checked', $(this).prop("checked"));});$("#kirim_dupak").click(function () {	var myCheckboxes = new Array();		$("input:checked").each(function() {		 myCheckboxes.push($(this).val());		});				if ( myCheckboxes[0] == undefined ) {			//alert("Pilih Data Dupak yang akan dikirim");		$("#dialog-form").html(		"<center><span class='ui-icon ui-icon-alert' style='float:left; margin:0 0 10px 5px;'></span>"		+"Pilih data yang akan dikirim ke Tim Penilai</center>"		);	    	$("#dialog-form").dialog({		//autoOpen: false,		show:"clip",		hide:"clip",		draggable:false,		resizable: false,		modal: true,		title  : 'SIPULPENPAKGURU',		height: 170,		width: 450,        buttons: {            "Tutup": function () {                $(this).dialog('close');            }        }		});							} else {			$("#dialog-form").html(	"<p style='margin:0 0 3px 5px;'>Konfirmasi Kirim Data Dupak Ke Tim Penilai </p><br>"	+"<span class='ui-icon ui-icon-info' style='float:left; margin:0 7px 10px 0;'></span>"	+"<font style='color:red;'>Pastikan Form Dupak dan Surat Pernyataan sudah dicetak, karena "	+"data yang sudah dikirim ke Tim Penilai PAK tidak bisa dicetak</font>"	);	    $("#dialog-form").dialog({		//autoOpen: false,		show:"clip",		hide:"clip",		draggable:false,        resizable: false,        modal: true,        title  : 'SIPULPENPAKGURU',        height: 220,        width: 530,        buttons: {            "Kirim": function () {                $(this).dialog('close');				kirim_ke_penilai();            },                "Batal": function () {                $(this).dialog('close');            }        }    });	}					});function kirim_ke_penilai(){			//alert();		$( "#load_kirim_tu" ).show();        var myCheckboxes = new Array();		$("input:checked").each(function() {		 myCheckboxes.push($(this).val());		});		//alert(myCheckboxes[1]);       $.ajax({		url:"./kelas/dupak.php",        data:"op=kirim_ke_penilai&no_dupak="+myCheckboxes,                    cache:false,                    success:function(msg){					//alert (msg);					$( "#load_kirim_tu" ).hide();					window.location.assign("?page=pengantar_dupak");					}		})}});</script><!--=====================================================- > **********************************************************                   TAMPIL DATA DUPAK**********************************************************<--====================================================----><h3 class="page-header">KIRIM DATA DUPAK</h3><table  width="100%"><tr>	<td align="right">		<form action="" method="post">		Cari dengan No DUPAK, Nip Baru  atau Nama Pegawai &nbsp;&nbsp;&nbsp;<input  type="text" name="txtcari"  size="33" maxlength="34"> 		<input type="submit" name="cari" value="Cari">		</form>	</td></tr></table><br><table border="1" class="data table-hover" width="100%"><thead>        <tr>			<th width="4%">No</th>			<th width="4%"></th>			<th width="14%">NO DUPAK</th>			<th width="13%">NIP BARU</th>			<th>NAMA PEGAWAI</th>			<th width="14%">GOLONGAN</th>			<th width="15%">TANGGAL INPUT DUPAK</th>        </tr>    </thead><tbody>	<?php$kd_skpd = isset($_SESSION['kd_skpd']) ? $_SESSION['kd_skpd'] : '';$_POST['cari'] = isset($_POST['cari']) ? $_POST['cari'] : '';$_GET['cari'] = isset($_GET['cari']) ? $_GET['cari'] : '';$nama_file = "data_dupak";		$all= array(); //menampilkan data tanpa pagination$all['field'] = "distinct dt_dupak.id_pegawai,dt_pegawai.nama,dt_pegawai.nip_baru,dt_pegawai.gelar_blk,dt_pegawai.gelar_dpn,dt_pegawai.gol_trakhir,dt_dupak.no_dupak,dt_dupak.step,dt_dupak.tgl_entry";//PENCARIAN DATAif( (isset($_POST['cari'])) | (isset($_GET['cari']))){		if($_POST['cari']!=null){			$txtcari=$_POST['txtcari'];		}else			$txtcari=$_GET['cari'];		$all['jika'] = "dt_pegawai.id_pegawai = dt_dupak.id_pegawai and (dt_pegawai.nip_baru = '$txtcari' or nama LIKE '%$txtcari%' or dt_dupak.no_dupak = '$txtcari') and dt_dupak.status_dupak = 'level_1' and step = '6' and dt_dupak.kd_skpd='$kd_skpd' ";		$_SESSION['cari']= $txtcari; //menyiapkan GET cari untuk pagination		$_SESSION['nama_file']= $nama_file;} else {		$all['jika'] = "dt_pegawai.id_pegawai = dt_dupak.id_pegawai and dt_dupak.status_dupak = 'level_1'  and step = '6' and dt_dupak.kd_skpd='$kd_skpd'";}	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';	$dataPak	= 	New KelolaDataDupak();	$hasil 		= 	$dataPak->TampilDataDupak("dt_dupak,dt_pegawai",$all);	//penomoran data	$no=1;	foreach($hasil as $r)	{				/** dicobian ambil dari data peg,, nanti data peg nya update oleh dupak	//pencarian gelar pada data PAK	$x = mysql_query("SELECT no_pak FROM dt_pak WHERE nip_baru='$r->nip_baru' ORDER BY tgl_pak ASC");	$data = mysql_num_rows($x);	//jika ditemukan data lebih dari 1	if ( $data > 1 ) {		while ($c = mysql_fetch_array($x)){					$dpt = $c['no_pak'];			}					$pak_terakhir = mysql_fetch_object(mysql_query("SELECT * FROM dt_pak WHERE no_pak='$dpt' "));			} else {					$pak_terakhir = mysql_fetch_object(mysql_query("SELECT * FROM dt_pak WHERE nip_baru='$r->nip_baru' ORDER BY tgl_pak DESC"));			}		$pak_terakhir = isset($pak_terakhir->no_pak) ? $pak_terakhir->no_pak : '';		$glr		=   mysql_fetch_object(mysql_query("SELECT gelar_dpn,gelar_blk FROM tb_pak_guru_pend WHERE no_pak='$pak_terakhir' "));	$d 			= 	New FormatTanggal();		$gol 		=  	mysql_fetch_object(mysql_query("SELECT nama_gol FROM tb_pak_guru_gol WHERE no_pak='$pak_terakhir' "));	**/		$d 			= 	New FormatTanggal();		?><tr>	<td align="center">		<?php echo $no; ?>	</td>	<td align="center">		<input type='checkbox' name="myCheckboxes[]" id="myCheckboxes"  value="<?php echo $r->no_dupak; ?>">	</td>	<td width="20%">		<?php echo $r->no_dupak; ?>	</td>	<td align="center">	<?php echo $r->nip_baru; ?>	</td>	<td align="" >	<?php 		$g_blk = isset($r->gelar_blk) ? $r->gelar_blk : '';		if ($g_blk == null ) 		{ $koma = ""; } else { $koma = ", ";};		$g_dpn = isset($r->gelar_dpn) ? $r->gelar_dpn : '';		if ($g_dpn == null ) 		{ $titik = ""; } else { $titik = ". ";};		echo  $g_dpn.$titik.ucwords(strtolower($r->nama)).$koma.$g_blk;	?>	</td>   <td align="center" >	<?php 		echo $r->gol_trakhir;	?>	</td>	<td align="center">	<?php 		$data	= explode(' ',$r->tgl_entry);		echo $d->balik($data[0])." &nbsp; ".$data[1];	?>	</td></tr><?php$no = $no+1;}?></tbody></table><?php if ($no > 1) { ?><table border="0" width="100%" style="margin-top:-5px;"><tr>	<td width="5%"></td>	<td width="3%" >		<img src="./images/forms/arrow_ltr.png">	</td>	<td align="left"  width="2%"  >		 <p style="margin-top:12px;"><input type="checkbox" id="checkAll" value=""/></p>	</td>	<td align="left" width="20%"  >	<button class="ui-state-default kirim" id="kirim_dupak" style="margin-top:10px;">KIRIM DATA USULAN DUPAK</button>	</td>	<td>		<img src="images/loader/load1.gif" style="margin-top:10px;" id="load_kirim_tu" />	</td>	</tr></table><?php  } ?>
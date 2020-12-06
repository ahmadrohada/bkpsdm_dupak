<?php if(!isset($_SERVER['HTTP_REFERER'])) { ?><script type="text/javascript">document.location  = "./index.php";</script><?php exit(); }  ?>

<script>
$(document).ready(function () {
	no_dupak = $("#get_no_dupak").val();

	detail_data_dupak();
	detail_kepsek_dupak();
	
	function detail_data_dupak(){
			$.ajax({
						url:"./kelas/detail.php",
                        data:"op=detail_data_dupak&no_dupak="+no_dupak,
                        cache:false,
                        success:function(msg){
							data=msg.split("|");
							//alert(msg);
							$("#no_dupak").val(data[0]);
							$("#masa_penilaian").val(data[6]+"   s.d   "+data[7]);
							$("#tanggal_dupak").val("Karawang, "+data[9]);
							$("#nama_tu").val(data[5]);
							$("#nip_tu").val("NIP. "+data[10]);
							detail_data_sekolah(data[8]);
                        }
                    })
		}
	
	function detail_data_sekolah(kd_skpd){
			$.ajax({
						url:"./kelas/detail.php",
                        data:"op=detail_data_sekolah&kd_skpd="+kd_skpd,
                        cache:false,
                        success:function(msg){
							data=msg.split("|");
							//alert(msg);
							$("#sekolah").val(data[4]);
							$("#xsekolah").val(data[4]);
							$("#alamat").val(data[6]+"    Telp."+data[7]);
							
							
                        }
                    })
		}
		
	
	function detail_kepsek_dupak(){
			$.ajax({
						url:"./kelas/detail.php",
                        data:"op=detail_dupak_kepsek&no_dupak="+no_dupak,
                        cache:false,
                        success:function(msg){
							data=msg.split("|");
							//alert(msg);
							$("#nama_kepsek").val(data[1]);
							$("#nip_kepsek").val(data[2]);
							$("#nuptk_kepsek").val(data[3]);
							$("#pgt_kepsek").val(data[4]+' / '+data[5]+' / '+data[6]);
							$("#jabatan_kepsek").val(data[7]);
							$("#unit_kerja_kepsek").val(data[8]);
							$("#ttd_kepsek").val(data[1]);
							$("#nip_ttd_kepsek").val('NIP. '+data[2]);
							
                        }
                    })
		}
	
	$.ajax({
		url:"./kelas/proses.php",
        data:"op=cari_id_pegawai_dupak&no_dupak="+no_dupak,
        cache:false,
        success:function(msg){
			x=msg.split("|");
			//alert(x[0]);
			detail_pegawai(x[0]);
        }
	})
	
	//data pribadi guru
	function detail_pegawai(id_pegawai){
	$.ajax({
		url:"./kelas/detail.php",
        data:"op=detail_data_guru&id_pegawai="+id_pegawai,
        cache:false,
        success:function(msg){
		data=msg.split("|");
			//alert(msg);
			$("#nama_guru").val(data[1]);
			$("#nip_guru").val(data[4]);
			$("#nuptk_guru").val(data[5]);
			$("#pgt_guru").val(data[26]+' / '+data[19]+' / '+data[24]);
			$("#jabatan_guru").val(data[28]);
			$("#unit_kerja_guru").val(data[21]);
        }
	})

	}
	
	detail_pbt_dupak();
	function detail_pbt_dupak(){
			$.ajax({
						url:"./kelas/detail.php",
                        data:"op=detail_pbt_dupak&no_dupak="+no_dupak,
                        cache:false,
                        success:function(msg){
							data=msg.split("|");
							//alert(msg);
							
							//apakah pengajar atau bp
							if ( data[5] == '05') {
								$("#ak_pembelajaran").val(data[08]);
								$("#ak_bimbingan").val("0.000");
							}else{
								$("#ak_pembelajaran").val("0.000");
								$("#ak_bimbingan").val(data[08]);
							}
							
							if ( data[6] != '') {
								$(".tt_1").show();
								$("#nm_tugas_tambahan_1").val(data[13]);
								$("#ak_tugas_tambahan_1").val(data[09]);
							}else{
								$(".tt_1").hide();
							}
							
							if ( data[7] != '') {
								$(".tt_2").show();
								$("#nm_tugas_tambahan_2").val(data[14]);
								$("#ak_tugas_tambahan_2").val(data[10]);
							}else{
								$(".tt_2").hide();
							}
                        }
                    })
	}
	
 });
</script>

<?php
$no_dupak = isset($_GET['no_dupak']) ? $_GET['no_dupak'] : '';
?>
 
<input type="hidden" value="<?php echo $no_dupak; ?>" id="get_no_dupak">
 
<p align="right">
<button onclick="history.go(-1)" class="ui-state-default kembali"  >Kembali</button>
<button onclick="window.print()" class="ui-state-default cetak"  >Cetak</button>
</p> 
 

<div id="printable" >
 
<table class="kop" >
<tr>
	<td rowspan="4" width="130px" height="170px" align="right" valign="top">
		<img src="images/shared/logo.png" width="120px" height="160px" >
	</td>
	<td align="center" valign="bottom">
		<FONT style="font-size:23pt; font-family:Cambria; letter-spacing:3pt;  ">PEMERINTAH KABUPATEN KARAWANG</FONT>
	</td>
</tr>
<tr>
	<td align="center" height="38px" valign="bottom">
		<FONT style=" font-size:24pt; font-weight:bold; font-family:Cambria; letter-spacing:2pt;  ">DINAS PENDIDIKAN, PEMUDA DAN OLAHRAGA</FONT>
	</td>
</tr>
<tr>
	<td align="center" height="38px" valign="bottom">
		<input type="text" style=" text-align:center; width:920px; border:none; background:transparent; font-size:19pt; color:black; font-weight:bold; font-family:Times New Roman,verdana,calibri; letter-spacing:2pt;" id="sekolah" readonly>
	</td>
</tr>
<tr>
	<td align="left">
		<input type="text" style=" text-align:center; width:920px; border:none; background:transparent; font-size:12pt; color:black; font-weight:bold; font-family:Times New Roman,verdana,calibri; letter-spacing:1pt;" id="alamat" readonly>
		
	</td>
</tr>
<tr>
	<td colspan="2" height="3px" valign="top">
		<hr class="kop_hr">
	</td>
</tr>
<tr>
	<td colspan="2" height="60px" valign="bottom" align="center">
		<FONT style=" font-size:14pt;  font-weight:bold; font-family:Times New Roman,Cambria; letter-spacing:1pt;  ">
		SURAT PERNYATAAN<br>
		MELAKSANAKAN TUGAS PEMBELAJARAN/BIMBINGAN DAN TUGAS TERTENTU
		</font>
	</td>
</tr>
<tr>
	<td colspan="2"  align="center" height="18px" valign="top">
		<FONT style=" font-size:14pt;  font-family:calibri,Times New Roman,verdana; ">
			No Dupak : 
		</font>
			<input type="text" style=" margin-left:0px; text-align:center; width:300px; border:none; font-size:13pt; color:black; font-weight:normal; font-family:isi; " id="no_dupak" readonly>
		
	</td>
</tr>

<tr>
	<td colspan="2"  align="center" height="25px" valign="top">
		<FONT style=" font-size:14pt;  font-family:calibri,Times New Roman,verdana; ">Masa Penilaian	: &nbsp;
		</font>
		<input type="text" style="  margin-left:0px; text-align:left; width:280px;  font-size:13pt; border:none; color:black; font-family:isi; " id="masa_penilaian" readonly>
	</td>
</tr>


</table>
<br>

<table class="keterangan_perorangan" border="0">
<tr>
	<td colspan="4">
		Yang bertanda tangan dibawah ini,
	</td>
</tr>
<tr>
	<td width="10%" align="right">
		
	</td>
	<td width="30%">
		Nama
	</td>
	<td width="1%" align="center">
		:
	</td>
	<td>
		<input type="text" class="field_isi" id="nama_kepsek" readonly>
	</td>
</tr>
<tr>
	<td align="right">
		
	</td>
	<td>
		NIP
	</td>
	<td align="center">
		:
	</td>
	<td>
		<input type="text" class="field_isi" id="nip_kepsek" readonly>
	</td>
</tr>
<tr>
	<td align="right">
		
	</td>
	<td>
		NUPTK
	</td>
	<td align="center">
		:
	</td>
	<td>
		<input type="text" class="field_isi" id="nuptk_kepsek" readonly>
	</td>
</tr>
<tr>
	<td align="right">
		
	</td>
	<td>
		Pangkat/Golongan.Ruang/TMT
	</td>
	<td align="center">
		:
	</td>
	<td>
		<input type="text" class="field_isi" id="pgt_kepsek" readonly>
	</td>
</tr>
<tr>
	<td align="right">
		
	</td>
	<td>
		Jabatan
	</td>
	<td align="center">
		:
	</td>
	<td>
		<input type="text" class="field_isi" id="jabatan_kepsek" readonly>
	</td>
</tr>
<tr>
	<td align="right">
		
	</td>
	<td>
		Unit Kerja
	</td>
	<td align="center">
		:
	</td>
	<td>
		<input type="text" class="field_isi" id="unit_kerja_kepsek" readonly>
	</td>
</tr>
<tr>
	<td colspan="4">
		
	</td>
</tr>
<tr>
	<td colspan="4">
		Menyatakan bahwa,
	</td>
</tr>
<tr>
	<td width="10%" align="right">
		
	</td>
	<td width="30%">
		Nama
	</td>
	<td width="1%" align="center">
		:
	</td>
	<td>
		<input type="text" class="field_isi" id="nama_guru" readonly>
	</td>
</tr>
<tr>
	<td align="right">
		
	</td>
	<td>
		NIP
	</td>
	<td align="center">
		:
	</td>
	<td>
		<input type="text" class="field_isi" id="nip_guru" readonly>
	</td>
</tr>
<tr>
	<td align="right">
		
	</td>
	<td>
		NUPTK
	</td>
	<td align="center">
		:
	</td>
	<td>
		<input type="text" class="field_isi" id="nuptk_guru" readonly>
	</td>
</tr>
<tr>
	<td align="right">
		
	</td>
	<td>
		Pangkat/Golongan.Ruang/TMT
	</td>
	<td align="center">
		:
	</td>
	<td>
		<input type="text" class="field_isi" id="pgt_guru" readonly>
	</td>
</tr>
<tr>
	<td align="right">
		
	</td>
	<td>
		Jabatan
	</td>
	<td align="center">
		:
	</td>
	<td>
		<input type="text" class="field_isi" id="jabatan_guru" readonly>
	</td>
</tr>
<tr>
	<td align="right">
		
	</td>
	<td>
		Unit Kerja
	</td>
	<td align="center">
		:
	</td>
	<td>
		<input type="text" class="field_isi" id="unit_kerja_guru" readonly>
	</td>
</tr>
</table>
<br><br>
 
<table class="keterangan_perorangan" border="0">
<tr>
	<td>
		<p  style="margin-left:-15px;">Telah melaksanakan kegiatan pembelajaran/pembimbingan dan tugas tertentu sebagai berikut</p>
	</td>
</tr>
</table>
 
 
<table class="keg_dupak">
<tr>
	<th rowspan="2">
		NO
	</th>
	<th rowspan="2" colspan="2" >
		URAIAN
	</th>
	<th colspan="2">
		HASIL PENILAIAN<br>KINERJA
	</th>
</tr>
<tr>
	<th>
		NILAI
	</th>
	<th>
		KATEGORI
	</th>
</tr>
<tr>
	<td colspan="3">
		Pembelajaran/Bimbingan dan Tugas Tertentu
	</td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td>A.</td>
	<td colspan="2">
		Melaksanakan proses pembelajaran
	</td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td  width="3%"></td>
	<td valign="top"  width="3%">-</td>
	<td  width="70%">
		Merencanakan dan melaksanakan pembelajaran, mengevaluasi dan menilai hasil pembelajaran,
		menganalisis hasil pembelajaran, melaksanakan tindak lanjut hasil penilaian
	</td>
	<td  width="10%">
		<input type="text" class="ak_cetak ak"  id="ak_pembelajaran" readonly>
	</td>
	<td  width="10%"></td>
</tr>
<tr>
	<td>B.</td>
	<td colspan="2">
		Melaksanakan proses bimbingan
	</td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td></td>
	<td valign="top">-</td>
	<td>
		Merencanakan dan melaksanakan pembimbingan, mengevaluasi dan menilai hasil bimbingan,
		menganalisis hasil bimbingan, melaksanakan tindak lanjut hasil bimbingan
	</td>
	<td>
		<input type="text" class="ak_cetak ak"  id="ak_bimbingan" readonly>
	</td>
	<td></td>
</tr>
<tr>
	<td>C.</td>
	<td colspan="2">
		Melaksanakan tugas lain yang relevan dengan fungsi sekolah/madrasah *)
	</td>
	<td></td>
	<td></td>
</tr>
<tr class="tt_1">
	<td rowspan="2"></td>
	<td valign="top">
		1.
	</td>
	<td>
		<input type="text" style="width:450px;" class="ak_cetak" id="nm_tugas_tambahan_1" readonly>
	</td>
	<td>
		<input type="text" class="ak_cetak ak"  id="ak_tugas_tambahan_1" readonly>
	</td>
	<td></td>
</tr>
<tr class="tt_2">
	<td valign="top">
		2.
	</td>
	<td>
		<input type="text" style="width:450px;" class="ak_cetak" id="nm_tugas_tambahan_2" readonly>
	</td>
	<td>
		<input type="text" class="ak_cetak ak"  id="ak_tugas_tambahan_2" readonly>
	</td>
	<td></td>
</tr>

</table>
<br>

<table class="keterangan_perorangan" border="0">
<tr>
	<td>
		<p  style="margin-left:85px; margin-right:-19px; word-break:break-all;">
		Demikian pernyataan ini dibuat dengan melampirkan hasil penilaian kinerja dan bukti fisik masing-masing 
		untuk
		</p>
		<p  style="margin-left:-12px;">
		dapat dipergunakan sebagaimana mestinya.
		</p>
	</td>
</tr>
</table>
<br>

<table class="keterangan_perorangan" border="0">
<tr>
	<td width="65%">
		
	</td>
	<td width="*%" style="padding-left:20px;">
	Karawang, 
	<?php
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';
		$d 	= New FormatTanggal();
		$tgl = date('Y-m-d');
		echo $d->balik2($tgl);
	?>
		
	</td>
</tr>
<tr>
	<td>
		
	</td>
	<td style="padding-left:20px;">
		Kepala Sekolah/Pengawas Sekolah
	</td>
</tr>
<tr height="60px">
	<td>
		
	</td>
	<td>
		
	</td>
</tr>
<tr>
	<td>
		
	</td>
	<td>
		<input type="text" style="width:300px; border:none; font-size:13pt; color:black; font-weight:normal; font-family:Arial,Sans-Serif,Times New Roman,verdana; " id="ttd_kepsek" readonly>
	</td>
</tr>
<tr>
	<td>
		
	</td>
	<td>
		<hr style="margin-left:10px; margin-top:-10px; width:240px; position:absolute;">
		<input type="text" style="margin-top:-10px; width:300px; border:none; font-size:13pt; color:black; font-weight:normal; font-family:Arial,Sans-Serif,Times New Roman,verdana; " id="nip_ttd_kepsek" readonly>
	</td>
</tr>
</table>

</div>

<script>
	$(document).ready(function () {
	$("#load_simpan_penunjang").hide();

	no_dupak = $("#no_dupak").val();
	p				=	$("#p").val();
			
	load_table_penunjang();
	load_penilai_penunjang1();
	load_penilai_penunjang2()
	
	
//fungsi pengisian table penunjang
	function load_table_penunjang() {
		no_dupak		=	$("#no_dupak").val();
		$.ajax({
			url:"./kelas/dupak.php",
			data:"op=load_penunjang&no_dupak="+no_dupak,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					data=msg.split("|");
					//alert(msg);
				$("#ak_64").val(data[0]);
					$("#f_64").val(data[1]);	
					$("#akf_64").val((data[1]*data[0]).toFixed(3));
					if ( data[1] != 0){$('.c_64').css('background','#fefeaf');}
					
					$("#ak_65").val(data[2]);
					$("#f_65").val(data[3]);	
					$("#akf_65").val((data[2]*data[3]).toFixed(3));
					if ( data[3] != 0){$('.c_65').css('background','#fefeaf');}
					
					$("#ak_66").val(data[4]);
					$("#f_66").val(data[5]);	
					$("#akf_66").val((data[4]*data[5]).toFixed(3));
					if ( data[5] != 0){$('.c_66').css('background','#fefeaf');}
					
					$("#ak_67").val(data[6]);
					$("#f_67").val(data[7]);	
					$("#akf_67").val((data[6]*data[7]).toFixed(3));
					if ( data[7] != 0){$('.c_67').css('background','#fefeaf');}
					
					$("#ak_68").val(data[8]);
					$("#f_68").val(data[9]);
					$("#akf_68").val((data[8]*data[9]).toFixed(3));
					if ( data[9] != 0){$('.c_68').css('background','#fefeaf');}
					
					$("#ak_69").val(data[10]);
					$("#f_69").val(data[11]);
					$("#akf_69").val((data[10]*data[11]).toFixed(3));
					if ( data[11] != 0){$('.c_69').css('background','#fefeaf');}
					
					$("#ak_70").val(data[12]);
					$("#f_70").val(data[13]);
					$("#akf_70").val((data[12]*data[13]).toFixed(3));
					if ( data[13] != 0){$('.c_70').css('background','#fefeaf');}
					
					$("#ak_71").val(data[14]);
					$("#f_71").val(data[15]);
					$("#akf_71").val((data[14]*data[15]).toFixed(3));
					if ( data[15] != 0){$('.c_71').css('background','#fefeaf');}
					
					$("#ak_72").val(data[16]);
					$("#f_72").val(data[17]);
					$("#akf_72").val((data[16]*data[17]).toFixed(3));
					if ( data[17] != 0){$('.c_72').css('background','#fefeaf');}
					
					$("#ak_73").val(data[18]);
					$("#f_73").val(data[19]);
					$("#akf_73").val((data[18]*data[19]).toFixed(3));
					if ( data[19] != 0){$('.c_73').css('background','#fefeaf');}
					
					$("#ak_74").val(data[20]);
					$("#f_74").val(data[21]);
					$("#akf_74").val((data[20]*data[21]).toFixed(3));
					if ( data[21] != 0){$('.c_74').css('background','#fefeaf');}
					
					$("#ak_75").val(data[22]);
					$("#f_75").val(data[23]);
					$("#akf_75").val((data[22]*data[23]).toFixed(3));
					if ( data[23] != 0){$('.c_75').css('background','#fefeaf');}
					
					$("#ak_76").val(data[24]);
					$("#f_76").val(data[25]);
					$("#akf_76").val((data[24]*data[25]).toFixed(3));
					if ( data[25] != 0){$('.c_76').css('background','#fefeaf');}
					
					$("#ak_77").val(data[26]);
					$("#f_77").val(data[27]);
					$("#akf_77").val((data[26]*data[27]).toFixed(3));
					if ( data[27] != 0){$('.c_77').css('background','#fefeaf');}
					
					$("#ak_78").val(data[28]);
					$("#f_78").val(data[29]);
					$("#akf_78").val((data[28]*data[29]).toFixed(3));
					if ( data[29] != 0){$('.c_78').css('background','#fefeaf');}
					
					$("#ak_79").val(data[30]);
					$("#f_79").val(data[31]);
					$("#akf_79").val((data[30]*data[31]).toFixed(3));
					if ( data[31] != 0){$('.c_79').css('background','#fefeaf');}
					
					$("#jm_penunjang").val((
					(data[1]*data[0])+(data[2]*data[3])+(data[4]*data[5])+
					(data[6]*data[7])+(data[8]*data[9])+(data[10]*data[11])+
					(data[12]*data[13])+(data[14]*data[15])+(data[16]*data[17])+
					(data[22]*data[23])+(data[24]*data[25])+(data[26]*data[27])+(data[28]*data[29])+
					(data[30]*data[31])+
					(data[20]*data[21])+(data[18]*data[19]) ).toFixed(3)
					
					
					
					
					);
					
					jm_p = $("#jm_pendidikan").val();
	
					
					if ($("#jm_pendidikan").val() != "0.000" ) {
							//alert(jm_p);
							$( "#f_isian_pendidikan" ).hide();
							$( "#data_pend_dupak" ).show();
					}
					
					}
		})
	}

	

	function disable_all(){
		$("#f_67").attr("disabled", true);
		$("#f_68").attr("disabled", true);
		$("#f_69").attr("disabled", true);
		$("#f_70").attr("disabled", true);
		$("#f_71").attr("disabled", true);
		$("#f_72").attr("disabled", true);
		$("#f_73").attr("disabled", true);
		$("#f_74").attr("disabled", true);
		$("#f_75").attr("disabled", true);
		$("#f_76").attr("disabled", true);
		$("#f_77").attr("disabled", true);
		$("#f_78").attr("disabled", true);
		$("#f_79").attr("disabled", true);
	}
	
	
	
	
	
	
	function load_penilai_penunjang1() {
		$.ajax({
			url:"./kelas/hasil_penilai.php",
			data:"op=penunjang1&no_dupak="+no_dupak,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					data=msg.split("|");
					$("#p1_64").html("<img src="+data[0]+">");
					$("#p1_65").html("<img src="+data[1]+">");
					$("#p1_66").html("<img src="+data[2]+">");
					$("#p1_67").html("<img src="+data[3]+">");
					$("#p1_68").html("<img src="+data[4]+">");
					$("#p1_69").html("<img src="+data[5]+">");
					$("#p1_70").html("<img src="+data[6]+">");
					$("#p1_71").html("<img src="+data[7]+">");
					$("#p1_72").html("<img src="+data[8]+">");
					$("#p1_73").html("<img src="+data[9]+">");
					$("#p1_74").html("<img src="+data[10]+">");
					$("#p1_75").html("<img src="+data[11]+">");
					$("#p1_76").html("<img src="+data[12]+">");
					$("#p1_77").html("<img src="+data[13]+">");
					$("#p1_78").html("<img src="+data[14]+">");
					$("#p1_79").html("<img src="+data[15]+">");
					
					
					
					
					}
		})
	}
	
	function load_penilai_penunjang2() {
		$.ajax({
			url:"./kelas/hasil_penilai.php",
			data:"op=penunjang2&no_dupak="+no_dupak,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					data=msg.split("|");
					$("#p2_64").html("<img src="+data[0]+">");
					$("#p2_65").html("<img src="+data[1]+">");
					$("#p2_66").html("<img src="+data[2]+">");
					$("#p2_67").html("<img src="+data[3]+">");
					$("#p2_68").html("<img src="+data[4]+">");
					$("#p2_69").html("<img src="+data[5]+">");
					$("#p2_70").html("<img src="+data[6]+">");
					$("#p2_71").html("<img src="+data[7]+">");
					$("#p2_72").html("<img src="+data[8]+">");
					$("#p2_73").html("<img src="+data[9]+">");
					$("#p2_74").html("<img src="+data[10]+">");
					$("#p2_75").html("<img src="+data[11]+">");
					$("#p2_76").html("<img src="+data[12]+">");
					$("#p2_77").html("<img src="+data[13]+">");
					$("#p2_78").html("<img src="+data[14]+">");
					$("#p2_79").html("<img src="+data[15]+">");
					
					
					
					
					}
		})
	}
	
	
	
	//pengisian penunjang
	
	$(".ak_freq").click(function(){
		//alert();
		$(this).focus().select();
		//alert($(this).val());
		
	});
	
	
	$(".ak_freq").change(function(){
		//alert("");
		if ($(this).val() == "" ){
			$(this).val("0")
		}
		update_penunjang_x();
	});
	
	$(".ak_freq").keyup(function(){
		//alert("");
		hitung_ak_penunjang();
	});
	
	
	
	
	function hitung_ak_penunjang() {
					a = $("#ak_67").val();
					b = $("#f_67").val();	
					xa = (a*b);
					$("#akf_67").val(xa.toFixed(3));
					
					c = $("#ak_68").val();
					d = $("#f_68").val();	
					xb = (c*d);
					$("#akf_68").val(xb.toFixed(3));
					
					
					
					g = $("#ak_69").val();
					h = $("#f_69").val();	
					xd = (g*h);
					$("#akf_69").val(xd.toFixed(3));
					
					i = $("#ak_70").val();
					j = $("#f_70").val();	
					xe = (i*j);
					$("#akf_70").val(xe.toFixed(3));
					
					k = $("#ak_71").val();
					l = $("#f_71").val();
					xf = (k*l);
					$("#akf_71").val(xf.toFixed(3));
					
					m = $("#ak_72").val();
					n = $("#f_72").val();	
					xg = (m*n);
					$("#akf_72").val(xg.toFixed(3));
					
					o = $("#ak_73").val();
					p = $("#f_73").val();
					xh = (o*p);
					$("#akf_73").val(xh.toFixed(3));
					
					q = $("#ak_74").val();
					r = $("#f_74").val();	
					xi = (q*r);
					$("#akf_74").val(xi.toFixed(3));
					
					s = $("#ak_75").val();
					t = $("#f_75").val();	
					xj = (s*t);
					$("#akf_75").val(xj.toFixed(3));
					
					u = $("#ak_76").val();
					v = $("#f_76").val();	
					xk = (u*v);
					$("#akf_76").val(xk.toFixed(3));
					
					w = $("#ak_77").val();
					x = $("#f_77").val();	
					xl = (w*x);
					$("#akf_77").val(xl.toFixed(3));
					
					y = $("#ak_78").val();
					z = $("#f_78").val();	
					xm = (y*z);
					$("#akf_78").val(xm.toFixed(3));
					
					aa = $("#ak_79").val();
					bb = $("#f_79").val();
					xn = 	(aa*bb);
					$("#akf_79").val(xn.toFixed(3));
					
					//data dari pend penunjang
					
					ya = parseFloat(encodeURIComponent(document.getElementById("akf_64").value));
					yb = parseFloat(encodeURIComponent(document.getElementById("akf_65").value));
					yc = parseFloat(encodeURIComponent(document.getElementById("akf_66").value));
					
					//alert(ya);
					$("#jm_penunjang").val(
					(xa+xb+xd+xe+xf+xg+xh+xi+xj+xk+xl+xm+xn+ya+yb+yc)
					.toFixed(3));
	
	}
	
	
	function update_penunjang_x(){
		$( "#load_simpan_penunjang" ).show();
			//data freq
			a	= 	$("#f_67").val();
			b	= 	$("#f_68").val();
			c	= 	$("#f_69").val();
			d	= 	$("#f_70").val();
			e	= 	$("#f_71").val();
			f	= 	$("#f_72").val();
			g	= 	$("#f_73").val();
			h	= 	$("#f_74").val();
			i	= 	$("#f_75").val();
			j	= 	$("#f_76").val();
			k	= 	$("#f_77").val();
			l	= 	$("#f_78").val();
			m	= 	$("#f_79").val();
			
			
			
			$.ajax({
			url:"./kelas/dupak.php",
			data:"op=update_penunjang&no_dupak="+no_dupak+
											"&a	=" +a+
											"&b	=" +b+
											"&c	=" +c+
											"&d	=" +d+
											"&e	=" +e+
											"&f	=" +f+
											"&g	=" +g+
											"&h	=" +h+
											"&i	=" +i+
											"&j	=" +j+
											"&k	=" +k+
											"&l	=" +l+
											"&m	=" +m,
                    cache:false,
                    success:function(msg){
					$( "#load_simpan_penunjang" ).hide();
					//alert (msg);
					 load_table_penunjang();
					}
			})
		
	}
	
	
	
	$(".kd_keg").click(function(){
		//alert();
		//$(this).focus().select();
		//alert($(this).val());
		$kd_keg = $(this).val();
		
	//cek dulu apakah kode kegiatan yang di klik ada Freq nya apa kagak
		$.ajax({
			url:"./kelas/hasil_penilai.php",
			data:"op=cek_f&no_dupak="+no_dupak+"&kd_keg="+$kd_keg,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					if ( msg == 0 ) {
						$("#dialog-confirm").html("<center>Mohon untuk menilai hanya pada kegiatan yang diajukan saja</center>");
						$("#dialog-confirm").dialog({
							show:"clip",
							hide:"clip",
							resizable: false,
							modal: true,
							title: "SIPULPENPAKGURU",
							height: 170,
							width: 450,
							buttons: {
									"Tutup": function () {
									$(this).dialog('close');
								}
							}
						});	
					}else if ( msg >= 1 ) {
						verifikasi();
						
					}
					
					}
		})
	});
	
	
	function verifikasi(){
	$("#dialog-confirm").html("<center></center>");
    $("#dialog-confirm").dialog({
    	show:"clip",
		hide:"clip",
		draggable:false,
		resizable: false,
		modal: true,
		title  : 'SIPULPENPAKGURU',
		height: 100,
		width: 220,
        buttons: {
            "   Terima   ": function () {
					$(this).dialog('close');
					$.ajax({
					url:"./kelas/verifikasi.php",
					data:"op=terima_dupak&no_dupak="+no_dupak+"&kd_keg="+$kd_keg,
                    cache:false,
                    success:function(msg){
						//alert(msg);
						load_penilai_penunjang1();
						load_penilai_penunjang2();
					}
					})
				
				},
                "   Tolak  ": function () {
					$(this).dialog('close');
					$.ajax({
					url:"./kelas/verifikasi.php",
					data:"op=tolak_dupak&no_dupak="+no_dupak+"&kd_keg="+$kd_keg,
                    cache:false,
                    success:function(msg){
						load_penilai_penunjang1();
						load_penilai_penunjang2();
					}
					})
            }
        }
    });	
	}
	
	 //SIMPAN VERIFIKASI
	$("#simpan_v_penunjang").click(function(){
	$( "#load_simpan_penunjang" ).show();
			$.ajax({
			url:"./kelas/verifikasi.php",
			data:"op=simpan_penunjang&no_dupak="+no_dupak,
                    cache:false,
                    success:function(msg){
					$( "#load_simpan_penunjang" ).hide();
					//$( "#tab_verifikasi_dupak" ).tabs( "enable", 2 );
					//$( "#tab_verifikasi_dupak" ).tabs( "option", "active", 2 );
					
					window.location.assign("?page=detail_dupak&no_dupak="+no_dupak+"&p="+p);
					}
			})
	 });
	
	$.ajax({
		url:"./kelas/proses.php",
        data:"op=cek_step&no_dupak="+no_dupak,
                cache:false,
                success:function(msg){
				//alert(msg);
				data=msg.split("|");
				$( "#progressbar" ).progressbar({value: +data[2]});
				
				if ( (data[0] >= 19) || (((data[0] >=13) && (p == 1)) || ((data[0] >=19) && (p == 2 ))  ) ){
				//if ( (data[0] >=13) && (p == 1) || (data[0] >=19) && (p == 2 ) ){
					$("#simpan_v_penunjang").hide();
					disable_all();
					$(".kd_keg").attr("disabled", true);
				}
			}
	})
 });
 </script>

 <script src="./js/custom_ajax.js"></script>

<table class="form" style="width:732px; margin-left:40px;">
<tr>
	<th rowspan="2" colspan="3" width="50%">
		UNSUR, SUB UNSUR DAN BUTIR KEGIATAN
	</th>
	<th rowspan="2" width="8%">
		Kode Komp
	</th>
	<th rowspan="2" width="10%">
		Angka Kredit
	</th>
	<th colspan="2" width="20%">
		Jumlah Usulan
	</th>
<th colspan="2" width="15%">
		Hasil Tim Penilai
	</th>
</tr>
<tr>
	<th width="5%">
		F
	</th>
	<th width="10%">
		A.K * F
	</th>
	<th width="7%">I</th>
	<th width="7%">II</th>
</tr>
<tr>
	<td colspan="3" class="isi">
		UNSUR PENUNJANG
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
	</td>
	<td  align="center">
	</td>
</tr>
<tr>
	<td width="2%" rowspan="25" valign="top" align="center">
		
	</td>
	<td colspan="2" class="isi" >
		PENUNJANG TUGAS GURU
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
	</td>
</tr>
<tr>
	<td width="2%" rowspan="5" valign="top" align="center">
		A.
	</td>
	<td>
		Memperoleh gelar/ijazah yang tidak sesuai dengan bidang yang<BR>
		diampunya:
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
</tr>
<tr>
	<td>
		1. &nbsp;Memperoleh gelar/ijazah yang tidak sesuai dengan bidang
		<p style="margin-left:19px;"> yang diampunya:</p>
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
</tr>
<tr class="c_64">
	<td style="padding-left:23px;">
		a. Doktor (S.3)
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="64">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_64">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_64">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_64">
	</td>
	<td  align="center">
		<span id="p1_64" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_64" class="nilai" ></span>
	</td>
</tr>
<tr class="c_65">
	<td style="padding-left:23px;">
		b. Pasca Sarjana (S.2)
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="65">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_65">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled onkeypress="return angka(event)" id="f_65">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_65">
	</td>
	<td  align="center">
		<span id="p1_65" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_65" class="nilai" ></span>
	</td>
</tr>
<tr class="c_66">
	<td style="padding-left:23px;">
		c. Sarjana (S.1) / Diploma IV
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="66">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_66">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled onkeypress="return angka(event)" id="f_66">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_66">
	</td>
	<td  align="center">
		<span id="p1_66" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_66" class="nilai" ></span>
	</td>
</tr>
<tr>
	<td width="2%" rowspan="13" valign="top" align="center">
		B.
	</td>
	<td>
		Melaksanakan kegiatan yang mendukung tugas guru 
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	
</tr>
<tr class="c_67">
	<td>
		a. &nbsp;Membimbing siswa dalam praktik kerja nyata 
		<p style="margin-left:19px;">/ praktik industri / ekstrakurikuler dan yang sejenisnya</p>
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="67">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_67">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" maxlength="1" onkeypress="return angka(event)" id="f_67">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_67">
	</td>
	<td  align="center">
		<span id="p1_67" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_67" class="nilai" ></span>
	</td>
</tr>
<tr>
	<td>
		b. &nbsp;Sebagai pengawas ujian penilaian dan evaluasi 
		<p style="margin-left:19px;">terhadap proses dan hasil belajar tingkat : </p>
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
</tr>
<tr class="c_68">
	<td style="padding-left:23px;">
		1) Sekolah
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="68">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_68">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" onkeypress="return angka(event)"  maxlength="1" id="f_68">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_68">
	</td>
	<td  align="center">
		<span id="p1_68" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_68" class="nilai" ></span>
	</td>
</tr>
<tr class="c_69">
	<td style="padding-left:23px;">
		2) nasional
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="69">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_69">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" onkeypress="return angka(event)"  maxlength="1" id="f_69">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_69">
	</td>
	<td  align="center">
		<span id="p1_69" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_69" class="nilai" ></span>
	</td>
</tr>
<tr>
	<td>
		c. &nbsp;Menjadi angota organisasi profesi, sebagai:
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
</tr>
<tr class="c_70">
	<td style="padding-left:23px;">
		1) Pengurus Aktif
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="70">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_70">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" onkeypress="return angka(event)"  maxlength="1" id="f_70">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_70">
	</td>
	<td  align="center">
		<span id="p1_70" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_70" class="nilai" ></span>
	</td>
</tr>
<tr class="c_71">
	<td style="padding-left:23px;">
		2) Anggota Aktif
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="71">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_71">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" onkeypress="return angka(event)"  maxlength="1" id="f_71">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_71">
	</td>
	<td  align="center">
		<span id="p1_71" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_71" class="nilai" ></span>
	</td>
</tr>
<tr>
	<td>
		d. &nbsp;Menjadi anggota kegiatan kepramukaan, sebagai:
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
</tr>
<tr class="c_72">
	<td style="padding-left:23px;">
		1) Pengurus Aktif
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="72">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_72">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" onkeypress="return angka(event)"  maxlength="1" id="f_72" >
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_72">
	</td>
	<td  align="center">
		<span id="p1_72" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_72" class="nilai" ></span>
	</td>
</tr>
<tr class="c_73">
	<td style="padding-left:23px;">
		2) Anggota Aktif
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="73">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_73">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" onkeypress="return angka(event)"  maxlength="1" id="f_73">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_73">
	</td>
	<td  align="center">
		<span id="p1_73" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_73" class="nilai" ></span>
	</td>
</tr>
<tr class="c_74">
	<td>
		e. &nbsp;Menjadi Tim Penilai Angka Kredit:
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="74">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_74">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" onkeypress="return angka(event)"  maxlength="1" id="f_74">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_74">
	</td>
	<td  align="center">
		<span id="p1_74" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_74" class="nilai" ></span>
	</td>
</tr>
<tr class="c_75">
	<td>
		f. &nbsp;Menjadi tutor / pelatih / instruktur ( per 2 jam pelajaran )
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="75">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_75">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" onkeypress="return angka(event)"  maxlength="1" id="f_75">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_75">
	</td>
	<td  align="center">
		<span id="p1_75" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_75" class="nilai" ></span>
	</td>
</tr>
<tr>
	<td width="2%" rowspan="6" valign="top" align="center">
		C.
	</td>
	<td>
		Perolehan penghargaan/tanda jasa
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
</tr>
<tr>
	<td>
		1. &nbsp;Memperoleh penghargaan / tanda jasa Satya Lancana 
		<p style="margin-left:19px;">Karya Satya</p>
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
</tr>
<tr class="c_76">
	<td style="padding-left:23px;">
		a. 30 (tiga puluh) tahun
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="76">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_76">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" onkeypress="return angka(event)"  maxlength="1" id="f_76">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_76">
	</td>
	<td  align="center">
		<span id="p1_76" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_76" class="nilai" ></span>
	</td>
</tr>
<tr class="c_77">
	<td style="padding-left:23px;">
		a. 20 (dua puluh) tahun
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="77">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_77">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" onkeypress="return angka(event)"  maxlength="1" id="f_77">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_77">
	</td>
		<td  align="center">
		<span id="p1_77" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_77" class="nilai" ></span>
	</td>
</tr>
<tr class="c_78">
	<td style="padding-left:23px;">
		a. 10 (sepuluh) tahun
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="78">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_78">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" onkeypress="return angka(event)"  maxlength="1" id="f_78">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_78">
	</td>
		<td  align="center">
		<span id="p1_78" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_78" class="nilai" ></span>
	</td>
</tr>
<tr class="c_79">
	<td>
		2. &nbsp;Memperoleh Penghargaan/tanda jasa
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="79">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_79">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" onkeypress="return angka(event)"  maxlength="1" id="f_79">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_79">
	</td>
		<td  align="center">
		<span id="p1_79" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_79" class="nilai" ></span>
	</td>
</tr>
<tr>
	<td colspan="3" class="isi" style="padding-left:58px;">
		JUMLAH UNSUR PENUNJANG
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		<input type="text" class="ak_field" id="jm_penunjang" disabled >
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
</tr>
</table>




<br>
<table style="width:732px; margin-left:40px;" border="0">
<tr>
	<td>
		<button class="ui-state-default lanjut" id="simpan_v_penunjang" >SIMPAN DATA VERIFIKASI PENUNJANG</button>
		<img src="images/loader/load1.gif" id="load_simpan_penunjang" />
	</td>
</tr>
</table>
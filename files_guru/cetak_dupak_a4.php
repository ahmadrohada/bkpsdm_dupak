<script>
$(document).ready(function () {
	no_dupak = $("#get_no_dupak").val();
	
	$.ajax({
		url:"./kelas/proses.php",
        data:"op=cari_id_pegawai_dupak&no_dupak="+no_dupak,
        cache:false,
        success:function(msg){
			x=msg.split("|");
			//alert(x[0]);
			var f = x[0];
			detail_data_guru(f);
        }
	})
	
	
	
	detail_data_dupak();
	
	
	load_table_pend();
	load_table_pbt();
	load_table_pd();
	load_table_piki();
	load_table_penunjang();
	detail_rekap_tu();
	qr_code();
	
	
	
	function qr_code(){
			$.ajax({
						url:"./kelas/proses.php",
                        data:"op=qr_code&no_dupak="+no_dupak,
                        cache:false,
                        success:function(msg){
							//alert(msg);
							$("#qr").html(msg);
                        }
                    })
		}	
	
	
		
		
		
		
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
							//$("#nama_tu").val(data[5]);
							//$("#nip_tu").val("NIP. "+data[10]);
							detail_data_sekolah(data[8]);
                        }
                    })
		}
	
	detail_kepsek_dupak()
	function detail_kepsek_dupak(){
			$.ajax({
						url:"./kelas/detail.php",
                        data:"op=detail_dupak_kepsek&no_dupak="+no_dupak,
                        cache:false,
                        success:function(msg){
							data=msg.split("|");
							//alert(msg);
							$("#ttd_kepsek").val(data[1]);
							$("#nip_ttd_kepsek").val('NIP. '+data[2]);
							
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
		
	function detail_data_guru(id_pegawai){
			$.ajax({
						url:"./kelas/detail.php",
                        data:"op=detail_data_guru&id_pegawai="+id_pegawai,
                        cache:false,
                        success:function(msg){
							data=msg.split("|");
							//alert(data[7]);
							
							if (data[0] == '1') {
								
								
								//isi field pada form_data_guru
								$("#nama").val(data[1]);
								$("#ttl").val(data[2]);
								$("#jk").val(data[3]);
								$("#nip").val(data[4]);
								$("#nuptk").val(data[5]);
								$("#no_karpeg").val(data[6]);
								
								$("#no_pak_terakhir").val(data[7]);
								$("#jenjang").val(data[8]);
								$("#gelar_dpn").val(data[9]);
								$("#gelar_blk").val(data[10]);
								$("#nama_gol").val(data[19]);
								
								$("#nama_gol_x").val(data[19]);
								$("#tmt_gol").val(data[24]);
								//alert(data[19]);
								$("#pangkat").val(data[26]);
								$("#jab_lama_guru").val(data[27]);
								$("#jab_baru_guru").val(data[28]);
								$("#pangkat_gol_tmt").val(data[26]+"/"+data[19]+"/"+data[24]);

								//mAsa Kerja
								
								$("#mk_awal_thn").val(data[50]);
								$("#mk_awal_bln").val(data[51]);
								$("#mk_baru_thn").val(data[52]);
								$("#mk_baru_bln").val(data[53]);
								
								//alert(data[21]);
								$("#kd_skpd").val(data[25]);
								$("#jenjang").val(data[12]);
								$("#jurusan").val(data[13]);
								$("#th_lulus").val(data[18]);
								$("#pend_terakhir").val(data[12]+"/"+data[13]+"/ tahun"+data[18]);
								//JAFUNG
								$("#tugas_mengajar").val(data[20]);
								$("#tmt_jafung").val(data[24]);
								$("#jenis_guru").val("");
								$("#jafung_tmt").val(data[28]+"/"+data[24]);
								//alert(data[65]);
								
								
								
								
								
							}else if (data[0] == '0') {
								$(".cari_nip").hide();
								alert ("Data Guru tidak ditemukan");
								
							}
                        }
                    })
		}
		
	
	
	
	//fungsi pengisian table pendidikan
	function load_table_pend() {
		no_dupak		=	$("#get_no_dupak").val();
		$.ajax({
			url:"./kelas/dupak.php",
			data:"op=load_pendidikan&no_dupak="+no_dupak,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					data=msg.split("|");
					//alert(msg);
					$("#ak_01").val(data[0]);
					$("#f_01").val(data[1]);	
					$("#akf_01").val((data[1]*data[0]).toFixed(3));
					
					$("#ak_01_1").val(data[2]);
					$("#f_01_1").val(data[3]);
					$("#akf_01_1").val((data[2]*data[3]).toFixed(3));
					
					$("#ak_02").val(data[4]);
					$("#f_02").val(data[5]);
					$("#akf_02").val((data[4]*data[5]).toFixed(3));
					
					$("#ak_02_1").val(data[6]);
					$("#f_02_1").val(data[7]);
					$("#akf_02_1").val((data[6]*data[7]).toFixed(3));
					
					$("#ak_03").val(data[8]);
					$("#f_03").val(data[9]);
					$("#akf_03").val((data[8]*data[9]).toFixed(3));
					
					$("#ak_03_1").val(data[10]);
					$("#f_03_1").val(data[11]);
					$("#akf_03_1").val((data[10]*data[11]).toFixed(3));
					
					$("#ak_03_2").val(data[12]);
					$("#f_03_2").val(data[13]);
					$("#akf_03_2").val((data[12]*data[13]).toFixed(3));
					
					$("#ak_03_3").val(data[14]);
					$("#f_03_3").val(data[15]);
					$("#akf_03_3").val((data[14]*data[15]).toFixed(3));
					
					$("#ak_03_3_1").val(data[16]);
					$("#f_03_3_1").val(data[17]);
					$("#akf_03_3_1").val((data[16]*data[17]).toFixed(3));
					
					$("#ak_03_3_3").val(data[18]);
					$("#f_03_3_3").val(data[19]);
					$("#akf_03_3_3").val((data[18]*data[19]).toFixed(3));
					
					$("#ak_04").val(data[20]);
					$("#f_04").val(data[21]);
					$("#akf_04").val((data[20]*data[21]).toFixed(3));
					
					$("#jm_pendidikan").val((
					(data[1]*data[0])+(data[2]*data[3])+(data[4]*data[5])+
					(data[6]*data[7])+(data[8]*data[9])+(data[10]*data[11])+
					(data[12]*data[13])+(data[14]*data[15])+(data[16]*data[17])+
					(data[20]*data[21])+(data[18]*data[19]) ).toFixed(3)
					
					);
					}
		})
	}
	
	
	//fungsi pengisian table pbt
	function load_table_pbt() {
		no_dupak		=	$("#get_no_dupak").val();
		//alert(no_dupak);
		$.ajax({
			url:"./kelas/dupak.php",
			data:"op=load_pbt&no_dupak="+no_dupak,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					data=msg.split("|");
					//alert(data[30]);
					$("#ak_05").val(data[0]);
					$("#f_05").val(data[16]);		
					$("#akf_05").val(data[0]);
					
					$("#ak_06").val(data[1]);
					$("#f_06").val(data[17]);
					$("#akf_06").val(data[1]);
					
					$("#ak_07").val(data[2]);
					$("#f_07").val(data[18]);
					$("#akf_07").val(data[2]);
					
					$("#ak_08").val(data[3]);
					$("#f_08").val(data[19]);
					$("#akf_08").val(data[3]);
					
					$("#ak_09").val(data[4]);
					$("#f_09").val(data[20]);
					$("#akf_09").val(data[4]);
					
					$("#ak_10").val(data[5]);
					$("#f_10").val(data[21]);
					$("#akf_10").val(data[5]);
					
					$("#ak_11").val(data[6]);
					$("#f_11").val(data[22]);
					$("#akf_11").val(data[6]);
					
					$("#ak_12").val(data[7]);
					$("#f_12").val(data[23]);
					$("#akf_12").val(data[7]);
					
					$("#ak_13").val(data[8]);
					$("#f_13").val(data[24]);
					$("#akf_13").val(data[8]);
					
					$("#ak_14").val(data[9]);
					$("#f_14").val(data[25]);
					$("#akf_14").val(data[9]);
					
					$("#ak_15").val(data[10]);
					$("#f_15").val(data[26]);
					$("#akf_15").val(data[10]);
					
					$("#ak_15_a").val(data[11]);
					$("#f_15_a").val(data[27]);
					$("#akf_15_a").val(data[11]);
					
					$("#ak_16").val(data[12]);
					$("#f_16").val(data[28]);
					$("#akf_16").val(data[12]);
					
					$("#ak_17").val(data[13]);
					$("#f_17").val(data[29]);
					$("#akf_17").val(data[13]);
					
					$("#ak_18").val(data[14]);
					$("#f_18").val(data[30]);
					$("#akf_18").val(data[14]);
					
					$("#jm_pbt").val(data[15]);
	
					}
		})
	}
	
	
	//fungsi pengisian table pd
	function load_table_pd() {
		no_dupak		=	$("#get_no_dupak").val();
		//alert(no_dupak);
		$.ajax({
			url:"./kelas/dupak.php",
			data:"op=load_pd&no_dupak="+no_dupak,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					data=msg.split("|");
					//alert(msg);
					
					$("#ak_19").val(data[0]);
					$("#f_19").val(data[1]);	
					$("#akf_19").val((data[1]*data[0]).toFixed(3));
					
					$("#ak_20").val(data[2]);
					$("#f_20").val(data[3]);
					$("#akf_20").val((data[2]*data[3]).toFixed(3));
					
					$("#ak_21").val(data[4]);
					$("#f_21").val(data[5]);
					$("#akf_21").val((data[4]*data[5]).toFixed(3));
					
					$("#ak_22").val(data[6]);
					$("#f_22").val(data[7]);
					$("#akf_22").val((data[6]*data[7]).toFixed(3));
					
					$("#ak_23").val(data[8]);
					$("#f_23").val(data[9]);
					$("#akf_23").val((data[8]*data[9]).toFixed(3));
					
					$("#ak_24").val(data[10]);
					$("#f_24").val(data[11]);
					$("#akf_24").val((data[10]*data[11]).toFixed(3));
					
					$("#ak_25").val(data[12]);
					$("#f_25").val(data[13]);
					$("#akf_25").val((data[12]*data[13]).toFixed(3));
	
					$("#ak_26").val(data[14]);
					$("#f_26").val(data[15]);
					$("#akf_26").val((data[14]*data[15]).toFixed(3));
					
					$("#ak_27").val(data[16]);
					$("#f_27").val(data[17]);
					$("#akf_27").val((data[16]*data[17]).toFixed(3));
					
					$("#ak_28").val(data[18]);
					$("#f_28").val(data[19]);
					$("#akf_28").val((data[18]*data[19]).toFixed(3));
					
					$("#jm_pd").val((
					(data[1]*data[0])+(data[2]*data[3])+(data[4]*data[5])+
					(data[6]*data[7])+(data[8]*data[9])+(data[10]*data[11])+
					(data[12]*data[13])+(data[14]*data[15])+(data[16]*data[17])+
					(data[18]*data[19])).toFixed(3) )
					}
		})
	}
	

	//fungsi pengisian table piki
	function load_table_piki() {
		no_dupak		=	$("#get_no_dupak").val();
		$.ajax({
			url:"./kelas/dupak.php",
			data:"op=load_piki&no_dupak="+no_dupak,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					data=msg.split("|");
					//alert(msg);
					$("#ak_29").val(data[0]);
					$("#f_29").val(data[1]);	
					$("#akf_29").val((data[1]*data[0]).toFixed(3));
					
					$("#ak_30").val(data[2]);
					$("#f_30").val(data[3]);
					$("#akf_30").val((data[2]*data[3]).toFixed(3));
					
					$("#ak_31").val(data[4]);
					$("#f_31").val(data[5]);
					$("#akf_31").val((data[4]*data[5]).toFixed(3));
					
					$("#ak_32").val(data[6]);
					$("#f_32").val(data[7]);
					$("#akf_32").val((data[6]*data[7]).toFixed(3));
					
					$("#ak_33").val(data[8]);
					$("#f_33").val(data[9]);
					$("#akf_33").val((data[8]*data[9]).toFixed(3));
					
					$("#ak_34").val(data[10]);
					$("#f_34").val(data[11]);
					$("#akf_34").val((data[10]*data[11]).toFixed(3));
					
					$("#ak_35").val(data[12]);
					$("#f_35").val(data[13]);
					$("#akf_35").val((data[12]*data[13]).toFixed(3));
					
					$("#ak_36").val(data[14]);
					$("#f_36").val(data[15]);
					$("#akf_36").val((data[14]*data[15]).toFixed(3));
					
					$("#ak_37").val(data[16]);
					$("#f_37").val(data[17]);
					$("#akf_37").val((data[16]*data[17]).toFixed(3));
					
					$("#ak_38").val(data[18]);
					$("#f_38").val(data[19]);
					$("#akf_38").val((data[18]*data[19]).toFixed(3));
					
					$("#ak_39").val(data[20]);
					$("#f_39").val(data[21]);
					$("#akf_39").val((data[20]*data[21]).toFixed(3));
					
					$("#ak_40").val(data[22]);
					$("#f_40").val(data[23]);
					$("#akf_40").val((data[22]*data[23]).toFixed(3));
					
					$("#ak_41").val(data[24]);
					$("#f_41").val(data[25]);
					$("#akf_41").val((data[24]*data[25]).toFixed(3));
					
					$("#ak_42").val(data[26]);
					$("#f_42").val(data[27]);
					$("#akf_42").val((data[26]*data[27]).toFixed(3));
					
					$("#ak_43").val(data[28]);
					$("#f_43").val(data[29]);
					$("#akf_43").val((data[28]*data[29]).toFixed(3));
					
					$("#ak_44").val(data[30]);
					$("#f_44").val(data[31]);
					$("#akf_44").val((data[30]*data[31]).toFixed(3));
					
					$("#ak_45").val(data[32]);
					$("#f_45").val(data[33]);
					$("#akf_45").val((data[32]*data[33]).toFixed(3));
					
					$("#ak_46").val(data[34]);
					$("#f_46").val(data[35]);
					$("#akf_46").val((data[34]*data[35]).toFixed(3));
					
					$("#ak_47").val(data[36]);
					$("#f_47").val(data[37]);
					$("#akf_47").val((data[36]*data[37]).toFixed(3));
					
					$("#ak_48").val(data[38]);
					$("#f_48").val(data[39]);
					$("#akf_48").val((data[38]*data[39]).toFixed(3));
					
					$("#ak_49").val(data[40]);
					$("#f_49").val(data[41]);
					$("#akf_49").val((data[40]*data[41]).toFixed(3));
					
					$("#ak_50").val(data[42]);
					$("#f_50").val(data[43]);
					$("#akf_50").val((data[42]*data[43]).toFixed(3));
					
					$("#ak_51").val(data[44]);
					$("#f_51").val(data[45]);
					$("#akf_51").val((data[44]*data[45]).toFixed(3));
					
					$("#ak_52").val(data[46]);
					$("#f_52").val(data[47]);
					$("#akf_52").val((data[46]*data[47]).toFixed(3));
					
					$("#ak_53").val(data[48]);
					$("#f_53").val(data[49]);
					$("#akf_53").val((data[48]*data[49]).toFixed(3));
					
					$("#ak_54").val(data[50]);
					$("#f_54").val(data[51]);
					$("#akf_54").val((data[50]*data[51]).toFixed(3));
					
					$("#ak_55").val(data[52]);
					$("#f_55").val(data[53]);
					$("#akf_55").val((data[52]*data[53]).toFixed(3));
					
					$("#ak_56").val(data[54]);
					$("#f_56").val(data[55]);
					$("#akf_56").val((data[54]*data[55]).toFixed(3));
					
					$("#ak_57").val(data[56]);
					$("#f_57").val(data[57]);
					$("#akf_57").val((data[56]*data[57]).toFixed(3));
					
					$("#ak_58").val(data[58]);
					$("#f_58").val(data[59]);
					$("#akf_58").val((data[58]*data[59]).toFixed(3));
					
					$("#ak_59").val(data[60]);
					$("#f_59").val(data[61]);
					$("#akf_59").val((data[60]*data[61]).toFixed(3));
					
					$("#ak_60").val(data[62]);
					$("#f_60").val(data[63]);
					$("#akf_60").val((data[62]*data[63]).toFixed(3));
					
					$("#ak_61").val(data[64]);
					$("#f_61").val(data[65]);
					$("#akf_61").val((data[64]*data[65]).toFixed(3));
					
					$("#ak_62").val(data[66]);
					$("#f_62").val(data[67]);
					$("#akf_62").val((data[66]*data[67]).toFixed(3));
					
					$("#ak_63").val(data[68]);
					$("#f_63").val(data[69]);
					$("#akf_63").val((data[68]*data[69]).toFixed(3));
					
					
					
					$("#jm_piki").val((
					(data[1]*data[0])+(data[2]*data[3])+(data[4]*data[5])+
					(data[6]*data[7])+(data[8]*data[9])+(data[10]*data[11])+
					(data[12]*data[13])+(data[14]*data[15])+(data[16]*data[17])+
					(data[18]*data[19])+(data[20]*data[21])+(data[22]*data[23])+
					(data[24]*data[25])+(data[26]*data[27])+(data[28]*data[29])+
					(data[30]*data[31])+(data[32]*data[33])+(data[34]*data[35])+
					(data[36]*data[37])+(data[38]*data[39])+(data[40]*data[41])+
					(data[42]*data[43])+(data[44]*data[45])+(data[46]*data[47])+
					(data[48]*data[49])+(data[50]*data[51])+(data[52]*data[53])+
					(data[54]*data[55])+(data[56]*data[57])+(data[58]*data[59])+
					(data[60]*data[61])+(data[62]*data[63])
					
					).toFixed(3)
					);
					
					
					}
		})
	}

	//fungsi pengisian table penunjang
	function load_table_penunjang() {
		no_dupak		=	$("#get_no_dupak").val();
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
					
					$("#ak_65").val(data[2]);
					$("#f_65").val(data[3]);	
					$("#akf_65").val((data[2]*data[3]).toFixed(3));
					
					$("#ak_66").val(data[4]);
					$("#f_66").val(data[5]);	
					$("#akf_66").val((data[4]*data[5]).toFixed(3));
					
					$("#ak_67").val(data[6]);
					$("#f_67").val(data[7]);	
					$("#akf_67").val((data[6]*data[7]).toFixed(3));
					
					$("#ak_68").val(data[8]);
					$("#f_68").val(data[9]);
					$("#akf_68").val((data[8]*data[9]).toFixed(3));
					
					$("#ak_69").val(data[10]);
					$("#f_69").val(data[11]);
					$("#akf_69").val((data[10]*data[11]).toFixed(3));
					
					$("#ak_70").val(data[12]);
					$("#f_70").val(data[13]);
					$("#akf_70").val((data[12]*data[13]).toFixed(3));
					
					$("#ak_71").val(data[14]);
					$("#f_71").val(data[15]);
					$("#akf_71").val((data[14]*data[15]).toFixed(3));
					
					$("#ak_72").val(data[16]);
					$("#f_72").val(data[17]);
					$("#akf_72").val((data[16]*data[17]).toFixed(3));
					
					$("#ak_73").val(data[18]);
					$("#f_73").val(data[19]);
					$("#akf_73").val((data[18]*data[19]).toFixed(3));
					
					$("#ak_74").val(data[20]);
					$("#f_74").val(data[21]);
					$("#akf_74").val((data[20]*data[21]).toFixed(3));
					
					$("#ak_75").val(data[22]);
					$("#f_75").val(data[23]);
					$("#akf_75").val((data[22]*data[23]).toFixed(3));
					
					$("#ak_76").val(data[24]);
					$("#f_76").val(data[25]);
					$("#akf_76").val((data[24]*data[25]).toFixed(3));
					
					$("#ak_77").val(data[26]);
					$("#f_77").val(data[27]);
					$("#akf_77").val((data[26]*data[27]).toFixed(3));
					
					$("#ak_78").val(data[28]);
					$("#f_78").val(data[29]);
					$("#akf_78").val((data[28]*data[29]).toFixed(3));
					
					$("#ak_79").val(data[30]);
					$("#f_79").val(data[31]);
					$("#akf_79").val((data[30]*data[31]).toFixed(3));
					
					$("#jm_penunjang").val((
					(data[1]*data[0])+(data[2]*data[3])+(data[4]*data[5])+
					(data[6]*data[7])+(data[8]*data[9])+(data[10]*data[11])+
					(data[12]*data[13])+(data[14]*data[15])+(data[16]*data[17])+
					(data[22]*data[23])+(data[24]*data[25])+(data[26]*data[27])+(data[28]*data[29])+
					(data[30]*data[31])+
					(data[20]*data[21])+(data[18]*data[19]) ).toFixed(3)
					
					
					
					
					);
					
					jm_p = $("#jm_pendidikan").val();
	
					
					}
		})
	}
	
	//alert(no_dupak);
	function detail_rekap_tu(){
		$.ajax({
		url:"./kelas/detail.php",
        data:"op=detail_rekap_tu&no_dupak="+no_dupak,
        cache:false,
            success:function(msg){
			data=msg.split("|");
				//Data PAK
				
				//Nilai PAK
				//alert(data[0]);
				
				$("#r_pend_lama").val(data[0]);
				$("#r_pend_baru").val(data[1]);
			
				$("#r_pend_total").val(data[2]);
				
				
				$("#r_diklat_lama").val(data[3]);
				$("#r_diklat_baru").val(data[4]);
				$("#r_diklat_total").val(data[5]);
				
				
				$("#r_pbt_lama").val(data[6]);
				$("#r_pbt_baru").val(data[7]);
				$("#r_pbt_total").val(data[8]);
				
				
				
				$("#r_pd_lama").val(data[9]);
				$("#r_pd_baru").val(data[10]);
				$("#r_pd_total").val(data[11]);
				
				
				$("#r_pi_lama").val(data[12]);
				$("#r_pi_baru").val(data[13]);
				$("#r_pi_total").val(data[14]);
				
				
				$("#r_ki_lama").val(data[15]);
				$("#r_ki_baru").val(data[16]);
				$("#r_ki_total").val(data[17]);
				
				
				$("#r_unsur_utama_lama").val(data[18]);
				$("#r_unsur_utama_baru").val(data[19]);
				$("#r_unsur_utama_total").val(data[20]);
				
				
				$("#r_sttb_tdksesuai_lama").val(data[21]);
				$("#r_sttb_tdksesuai_baru").val(data[22]);
				$("#r_sttb_tdksesuai_total").val(data[23]);
				
				
				
				$("#r_dukung_tugas_lama").val(data[24]);
				$("#r_dukung_tugas_baru").val(data[25]);
				$("#r_dukung_tugas_total").val(data[26]);
				
				
				$("#r_unsur_penunjang_lama").val(data[27]);
				$("#r_unsur_penunjang_baru").val(data[28]);
				$("#r_unsur_penunjang_total").val(data[29]);
				
				
				$("#r_ak_lama").val(data[30]);
				$("#r_ak_baru").val(data[31]);
				$("#r_ak_total").val(data[32]);
				
            }
			
        })
		}
	
	
	
	
 });
</script>

<?php
$no_dupak 		= isset($_GET['no_dupak']) ? $_GET['no_dupak'] : '';
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
		<input type="text" style=" text-align:center; width:920px; border:none; background:transparent; font-size:19pt; color:black; font-weight:bold; font-family:Times New Roman,verdana,calibri; letter-spacing:2pt;" id="sekolah">
	</td>
</tr>
<tr>
	<td align="left">
		<input type="text" style=" text-align:center; width:920px; border:none; background:transparent; font-size:12pt; color:black; font-weight:bold; font-family:Times New Roman,verdana,calibri; letter-spacing:1pt;" id="alamat">
		
	</td>
</tr>
<tr>
	<td colspan="2" height="3px" valign="top">
		<hr class="kop_hr">
	</td>
</tr>
<tr>
	<td colspan="2" height="33px" align="center" valign="bottom">
		<FONT style=" font-size:17pt; font-weight:bold; font-family:Times New Roman,verdana,calibri; letter-spacing:2pt;  ">DAFTAR USUL PENETAPAN ANGKA KREDIT</FONT>
	</td>
</tr>
<tr>
	<td colspan="2" height="25px" align="center" valign="center">
		<FONT style=" font-size:17pt; font-weight:bold; font-family:Times New Roman,verdana,calibri; letter-spacing:2pt;  ">GURU KELAS / GURU MATA PELAJARAN</FONT>
	</td>
</tr>
<tr>
	<td colspan="2" height="20px" align="center">
		<FONT style=" font-size:11pt;  font-weight:bold; font-family:arial; letter-spacing:1pt;  ">Berdasarkan PERMENNEG PAN & RB NOMOR 16 TAHUN 2009</FONT>
	</td>
</tr>
<tr>
	<td colspan="2"  align="center" height="35px" valign="top">
	<FONT style=" font-size:13pt;  font-family:calibri,Times New Roman,verdana; ">
			No Dupak : 
		</font>
			<input type="text" style=" margin-left:0px; text-align:center; width:300px; border:none; font-size:13pt; color:black; font-weight:normal; font-family:isi; " id="no_dupak" readonly>
	</td>
</tr>

<tr>
	<td colspan="2"  align="right" height="80px" valign="bottom">
		<FONT style=" font-size:13pt;  font-family:calibri,Times New Roman,verdana; ">Masa Penilaian	: &nbsp;
		</font>
		<input type="text" style="padding-right:10px;  margin-left:0px; text-align:right; width:280px;  font-size:12pt; border:none; color:black; font-family:isi; " id="masa_penilaian" readonly>
	</td>
</tr>
<tr>
	<td colspan="2" height="3px" valign="top">
		<hr class="">
	</td>
</tr>
<tr>
	<td colspan="2" height="22px" valign="center" align="center">
		<FONT style=" font-size:12pt;  font-weight:bold; font-family:arial; letter-spacing:1pt;  ">KETERANGAN PERORANGAN</font>
	</td>
</tr>
<tr>
	<td colspan="2" height="3px" valign="top">
		<hr class="">
	</td>
</tr>
</table>
 
<BR>
 
<table class="keterangan_perorangan" border="0">
<tr>
	<td width="5%" align="right">
		1.
	</td>
	<td colspan="2" width="30%">
		Nama
	</td>
	<td width="1%" align="center">
		:
	</td>
	<td>
		<input type="text" class="field_isi" id="nama">
	</td>
</tr>
<tr>
	<td align="right">
		2.
	</td>
	<td colspan="2">
		NIP
	</td>
	<td align="center">
		:
	</td>
	<td>
		<input type="text" class="field_isi" id="nip">
	</td>
</tr>
<tr>
	<td align="right">
		3.
	</td>
	<td colspan="2">
		NUPTK
	</td>
	<td align="center">
		:
	</td>
	<td>
		<input type="text" class="field_isi" id="nuptk">
	</td>
</tr>
<tr>
	<td align="right">
		4.
	</td>
	<td colspan="2">
		No Seri KARPEG
	</td>
	<td align="center">
		:
	</td>
	<td>
		<input type="text" class="field_isi" id="no_karpeg">
	</td>
</tr>
<tr>
	<td align="right">
		5.
	</td>
	<td colspan="2">
		Pangkat/Golongan.Ruang/TMT
	</td>
	<td align="center">
		:
	</td>
	<td>
		<input type="text" class="field_isi" id="pangkat_gol_tmt">
	</td>
</tr>
<tr>
	<td align="right">
		6.
	</td>
	<td colspan="2">
		Tempat Tanggal Lahir
	</td>
	<td align="center">
		:
	</td>
	<td>
		<input type="text" class="field_isi" id="ttl">
	</td>
</tr>
<tr>
	<td align="right">
		7.
	</td>
	<td colspan="2">
		Jenis Kelamin
	</td>
	<td align="center">
		:
	</td>
	<td>
		<input type="text" class="field_isi" id="jk">
	</td>
</tr>
<tr>
	<td align="right" valign="top">
		8.
	</td>
	<td colspan="2">
		Pendidikan Terakhir
	</td>
	<td align="center"  valign="top">
		:
	</td>
	<td  valign="top">
		<input type="text" class="field_isi" id="pend_terakhir">
	</td>
</tr>
<tr>
	<td align="right">
		9.
	</td>
	<td colspan="2">
		Jabatan Fungsional / TMT
	</td>
	<td align="center">
		:
	</td>
	<td>
		<input type="text" class="field_isi" id="jafung_tmt">
	</td>
</tr>
<tr>
	<td align="right" rowspan="2">
		10.
	</td>
	<td rowspan="2">
		MASA KERJA
	</td>
	<td >
		Lama
	</td>
	<td align="center">
		:
	</td>
	<td>
		<input type="text" class="field_isi" style="width:25px !important; text-align:right !important;" id="mk_awal_thn"> thn
		<input type="text" class="field_isi" style="width:25px !important; text-align:right !important;" id="mk_awal_bln"> bln
	</td>
</tr>
<tr>
	<td >
		Baru
	</td>
	<td align="center">
		:
	</td>
	<td>
		<input type="text" class="field_isi" style="width:25px !important; text-align:right !important;" id="mk_baru_thn"> thn
		<input type="text" class="field_isi" style="width:25px !important; text-align:right !important;" id="mk_baru_bln"> bln
	</td>
</tr>
<tr>
	<td align="right">
		11.
	</td>
	<td colspan="2">
		Sekolah
	</td>
	<td align="center">
		:
	</td>
	<td>
		<input type="text" class="field_isi" id="xsekolah">
	</td>
</tr>
</table>
<br><br><br><br>
 <br><br><br>
 
 
 
<table class="keg_dupak">
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
		UNSUR UTAMA
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
	<td width="2%" rowspan="14" valign="top" align="center">
		1.
	</td>
	<td colspan="2" class="isi" >
		PENDIDIKAN
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
	<td width="2%" rowspan="11" valign="top" align="center">
		A.
	</td>
	<td  >
		Mengikuti Pendidikan dan memperoleh gelar/ijazah/akta
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
	<td  style="padding-left:30px;">
		a. Doktor (S-3)
	</td>
	<td>
		01
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_01" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_01" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_01" readonly>
	</td>
	<td  align="center">
	</td>
	<td  align="center">
	</td>
</tr>
<tr>
	<td  style="padding-left:30px;">
		b. Doktor (S-3) dari Magister (S-2)
	</td>
	<td>
		01.1
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_01_1" readonly>
	</td>
	<td  align="center" >
		<input type="text" class="ak_cetak f" id="f_01_1" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_01_1" readonly>
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
</tr>
<tr>
	<td  style="padding-left:30px;">
		c. MAGISTER (S.2)
	</td>
	<td>
		02
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_02" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_02" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_02" readonly>
	</td>
	<td  align="center">
	</td>
	<td  align="center">
	</td>
</tr>
<tr>
	<td  style="padding-left:30px;">
		d. MAGISTER (S-2) dari Sarjana (S-1)
	</td>
	<td>
		02.1
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_02_1" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_02_1" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_02_1" readonly>
	</td>
	<td  align="center">
	</td>
	<td  align="center">
	</td>
</tr>
<tr>
	<td  style="padding-left:30px;">
		e. Sarjana (S-1) / Diploma IV
	</td>
	<td>
		03
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_03" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_03" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_03" readonly>
	</td>
	<td  align="center">
	</td>
	<td  align="center">
	</td>
</tr>
<tr>
	<td  style="padding-left:30px;">
		f. Sarjana (S-1) dari Sarmud / Diploma-III
	</td>
	<td>
		03.1
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_03_1" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_03_1" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_03_1" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td  style="padding-left:30px;">
		g. Sarjana (S-1) dari D-II/PGSLA/SGPLB
	</td>
	<td>
		03.2
	</td>
		<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_03_2" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_03_2" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_03_2" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td  style="padding-left:30px;">
		h. Sarjana (S-1) dari D-I/PGSLTP/SMTA
	</td>
	<td>
		03.3
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_03_3" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_03_3" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_03_3" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td  style="padding-left:30px;">
		i. Sarjana Muda/Diploma III
	</td>
	<td>
		03.3.1
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_03_3_1" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_03_3_1" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_03_3_1" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td  style="padding-left:30px;">
		j. Sarjana Muda/Diploma-III dari Diploma-II/SGPLB
	</td>
	<td>
		03.3.3
	</td>
		<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_03_3_3" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_03_3_3" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_03_3_3" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td width="2%" valign="top" align="center">
		B.
	</td>
	<td  >
		Mengikuti Pelatihan Prajabatan Fungsional bagi Guru Calon
		<p style="margin-left:0px">  Pegawai Negeri Sipil / Program Induksi</p>
	</td>
	<td>
		04
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_04" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_04" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_04" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td colspan="2" class="isi" style="padding-left:27px;">
		JUMLAH
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="jm_pendidikan" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
</table>
<br><br>

<table class="keg_dupak">
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
	<td width="2%" rowspan="5" valign="top" align="center">
		2.
	</td>
	<td colspan="2" class="isi" >
		PEMBELAJARAN/BIMBINGAN DAN TUGAS TERTENTU
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
	<td width="2%" rowspan="2" valign="top" align="center">
		A.
	</td>
	<td>
		Melaksanakan proses Pembelajaran
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
	<td  style="padding-left:26px;">
		Merencanakan dan melaksanakan pembelajaran, mengevaluasi dan menilai hasil pembelajaran, menganalisis hasil pembelajaran, 
		melaksanakan tindak lanjut hasil penilaian
	</td>
	<td>
		05
	</td>
	<td  align="center">
		PAKET
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_05" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_05" readonly>
	</td>
	<td  align="center">
	</td>
	<td  align="center">
	</td>
</tr>
<tr>
	<td width="2%" rowspan="2" valign="top" align="center">
		B.
	</td>
	<td>
		Melaksanakan proses Bimbingan
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
	<td  style="padding-left:26px;">
		Merencanakan dan melaksanakan bimbingan, mengevaluasi dan menilai hasil bimbingan, menganalisis hasil bimbingan, 
		melaksanakan tindak lanjut hasil pembimbingan
	</td>
	<td>
		06
	</td>
	<td  align="center">
		PAKET
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_06" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_06" readonly>
	</td>
	<td  align="center">
	</td>
	<td  align="center">
	</td>
</tr>
<tr>
	<td width="2%" rowspan="15" valign="top" align="center">
		
	</td>
	<td width="2%" rowspan="14" valign="top" align="center">
		C.
	</td>
	<td>
		Melaksanakan tugas lain yang relevan dengan fungsi sekolah/madrasah
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
	<td  style="padding-left:23px;">
		1. Menjadi Kepala Sekolah/Madrasah per tahun
	</td>
	<td>
		07
	</td>
	<td  align="center">
		PAKET
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_07" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_07" readonly>
	</td>
	<td  align="center">
	</td>
	<td  align="center">
	</td>
</tr>
<tr>
	<td  style="padding-left:23px;">
		2. Menjadi Wakil Kepala Sekolah/Madrasah per tahun
	</td>
	<td>
		08
	</td>
	<td  align="center">
		PAKET
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_08" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_08" readonly>
	</td>
	<td  align="center">
	</td>
	<td  align="center">
	</td>
</tr>
<tr>
	<td  style="padding-left:23px;">
		3. Menjadi ketua program keahlian/program studi  atau  
		<p style="margin-left:18px;">yang sejenisnya</p>
	</td>
	<td>
		09
	</td>
	<td  align="center">
		PAKET
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_09" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_09" readonly>
	</td>
	<td  align="center">
	</td>
	<td  align="center">
	</td>
</tr>
<tr>
	<td  style="padding-left:23px;">
		4. Menjadi Kepala Perpustakaan
	</td>
	<td>
		10
	</td>
	<td  align="center">
		PAKET
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_10" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_10" readonly>
	</td>
	<td  align="center">
	</td>
	<td  align="center">
	</td>
</tr>
<tr>
	<td  style="padding-left:23px;">
		5. Menjadi kepala laboratorium, bengkel, unit produksi 
		<p style="margin-left:18px;">atau yang sejenisnya</p>
	</td>
	<td>
		11
	</td>
	<td  align="center">
		PAKET
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_11" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_11" readonly>
	</td>
	<td  align="center">
	</td>
	<td  align="center">
	</td>
</tr>
<tr>
	<td  style="padding-left:23px;">
		6. Menjadi pembimbing khusus pada satuan pendidikan 
		<p style="margin-left:18px;">yang menyelenggarakan pendidian inklusi,
		pendidikan terpadu atau yang sejenisnya</p>
	</td>
	<td>
		12
	</td>
	<td  align="center">
		PAKET
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_12" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_12" readonly>
	</td>
	<td  align="center">
	</td>
	<td  align="center">
	</td>
</tr>
<tr>
	<td  style="padding-left:23px;">
		7. Menjadi Wali Kelas
	</td>
	<td>
		13
	</td>
	<td  align="center">
		PAKET
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_13" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_13" readonly>
	</td>
	<td  align="center">
	</td>
	<td  align="center">
	</td>
</tr>
<tr>
	<td  style="padding-left:23px;">
		8. Menyusun kurikulum pada satuan pendidikannya
	</td>
	<td>
		14
	</td>
	<td  align="center">
		PAKET
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_14" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_14" readonly>
	</td>
	<td  align="center">
	</td>
	<td  align="center">
	</td>
</tr>
<tr>
	<td  style="padding-left:23px;">
		9. Menjadi pengawas penilaian dan evaluasi terhadap  
		<p style="margin-left:18px;">proses dan hasil belajar
		.(UAS dan UKK)</p>
	</td>
	<td>
		15
	</td>
	<td  align="center">
		PAKET
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_15" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_15" readonly>
	</td>
	<td  align="center">
	</td>
	<td  align="center">
	</td>
</tr>
<tr>
	<td  style="padding-left:15px;">
		10. Membimbing guru pemula dalam program induksi
	</td>
	<td>
		15.a
	</td>
	<td  align="center">
		PAKET
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_15_a" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_15_a" readonly>
	</td>
	<td  align="center">
	</td>
	<td  align="center">
	</td>
</tr>
<tr>
	<td  style="padding-left:15px;">
		11. Membimbing siswa dalam kegiatan ekstrakurikuler
	</td>
	<td>
		16
	</td>
	<td  align="center">
		PAKET
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_16" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_16" readonly>
	</td>
	<td  align="center">
	</td>
	<td  align="center">
	</td>
</tr>
<tr>
	<td  style="padding-left:15px;">
		12. Menjadi pembimbing pada penyusunan publikasi  
		<p style="margin-left:27px;"> ilmiah dan karya inovatif</p>
	</td>
	<td>
		17
	</td>
	<td  align="center">
		PAKET
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_17" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_17" readonly>
	</td>
	<td  align="center">
	</td>
	<td  align="center">
	</td>
</tr>
<tr>
	<td  style="padding-left:15px;">
		13. Melaksanakan pembimbingan pada kelas yang  
		<p style="margin-left:27px;">menjadi tanggungjawabnya(khusus guru kelas)</p>
	</td>
	<td>
		18
	</td>
	<td  align="center">
		PAKET
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_18" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_18" readonly>
	</td>
	<td  align="center">
	</td>
	<td  align="center">
	</td>
</tr>
<tr>
	<td colspan="2" class="isi" style="padding-left:27px;">
		JUMLAH
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak" id="jm_pbt" readonly >
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
</tr>
<tr>
	<td width="2%" rowspan="15" valign="top" align="center">
		3.
	</td>
	<td colspan="2" class="isi" >
		PENGEMBANGAN KEPROFESIAN BERKELANJUTAN
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
	<td width="2%" rowspan="14" valign="top" align="center">
		A.
	</td>
	<td>
		Melaksanakan Pengembangan Diri
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
	<td  style="padding-left:26px;">
		1. Mengikuti Diklat Fungsional
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
	<td style="padding-left:44px;">
		a. Lamanya lebih dari 960 jam
	</td>
	<td>
		19
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_19" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_19" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_19" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:44px;">
		b. Lamanya antara 641 s.d 960 jam
	</td>
	<td>
		20
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_20" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_20" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_20" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:44px;">
		c. Lamanya antara 481 s.d 640 jam
	</td>
	<td>
		21
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_21" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_21" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_21" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:44px;">
		d. Lamanya antara 161 s.d 80 jam
	</td>
	<td>
		22
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_22" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_22" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_22" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>

<tr>
	<td style="padding-left:44px;">
		e. Lamanya antara 81 s.d 160 jam
	</td>
	<td>
		23
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_23" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_230" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_23" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:48px;">
		f. Lamanya antara 30 s.d 80 jam
	</td>
	<td>
		24
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_24" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_24" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_24" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td  style="padding-left:23px;">
		2. Kegiatan kolektif guru yang meningkatkan kompetensi 
			<p style="margin-left:19px">dan/atau keprofesian guru</p>
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
	<td style="padding-left:40px;">
		a. Lokakarya atau kegiatan bersama (seperti kelompok 
		<p style="margin-left:18px">kerja guru) untuk penyusunan perangkat kurikulum dan atau pembelajaran</p>
	</td>
	<td>
		25
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_25" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_25" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_25" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:40px;">
		b. Keikutsertaan pada kegiatan ilmiah (seminar, kologium  
		<p style="margin-left:18px">dan diskusi panel)</p>
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
	<td style="padding-left:55px;">
		1. Menjadi pembahas pada kegiatan ilmiah
	</td>
	<td>
		26
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_26" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_26" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_26" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:55px;">
		2. Menjadi peserta pada kegiatan ilmiah
	</td>
	<td>
		27
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_27" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_27" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_27" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
</table>
<br><br><br>


<table class="keg_dupak">
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
	<td width="2%" rowspan="2" valign="top" align="center"></td>
	<td width="2%" valign="top" align="center"></td>
	<td style="padding-left:48px;">
		c. Kegiatan kolektif lainnya yang sesuai dengan tugas dan 
		<p style="margin-left:18px">kewajiban guru</p>
	</td>
	<td>
		28
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_28" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_28" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_28" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td colspan="2" class="isi" style="padding-left:27px;">
		JUMLAH MELAKSANAKAN PENGEMBANGAN DIRI
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="jm_pd" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td width="2%" rowspan="73" valign="top" align="center">
		
	</td>
	<td width="2%" rowspan="36" valign="top" align="center">
		B.
	</td>
	<td>
		Melaksanakan Publikasi Ilmiah
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
	<td style="padding-left:23px;">
		1. Presentasi pada forum ilmiah
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
	<td style="padding-left:40px;">
		a. Menjadi pemrasaran/nara sumber pada seminar atau
		<p style="margin-left:18px"> loka karya ilmiah</p>
	</td>
	<td>
		29
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_29" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_29" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_29" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
</tr>
<tr>
	<td style="padding-left:40px;">
		b. Menjadi pemrasaran/nara sumber pada kologium atau
		<p style="margin-left:18px">diskusi ilmiah</p>
	</td>
	<td>
		30
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_30" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_30" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_30" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
</tr>
<tr>
	<td style="padding-left:23px;">
		2. Melaksanakan publikasi Ilmiah hasil penelitian atau 
		<p style="margin-left:18px"> gagasan ilmu pada bidang pendidikan formal</p>
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
	<td style="padding-left:40px;">
		a. Membuat karya tulis berupa laporan hasil penelitian pada 
		<p style="margin-left:18px;">bidang pendidikan di sekolahnya, diterbitkan/ dipublikasikan 
		dalam bentuk buku ber ISBN dan diedarkan secara 
		nasional atau telah lulus dari penilaian BNSP.</p>
	</td>
	<td>
		31
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_31" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_31" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_31" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:40px;">
		b. Membuat karya tulis berupa laporan hasil penelitian pada 
		<p style="margin-left:18px;">bidang pendidikan di sekolahnya, diterbitkan/ dipublikasikan dalam majalah/jurnal 
		ilmiah tingkat nasional yang terakreditasi</p>
	</td>
	<td>
		32
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_32" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_32" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_32" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:40px;">
		c. Membuat karya tulis berupa  laporan hasil penelitian
		<p style="margin-left:18px;">   pada bidang pendidikan di sekolahnya, diterbitkan/ dipublikasikan 
		dalam majalah/jurnal ilmiah tingkat provinsi.</p>
	</td>
	<td>
		33
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_33" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_33" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_33" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:40px;">
		d. Membuat karya tulis berupa  laporan hasil penelitian  pada
		<p style="margin-left:18px;"> bidang pendidikan di sekolahnya, diterbitkan/
		dipublikasikan 
		dalam majalah/jurnal ilmiah tingkat kabupaten/kota.</p>
	</td>
	<td>
		34
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_34" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_34" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_34" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:40px;">
		e.  Membuat karya tulis berupa laporan hasil penelitian pada 
		<p style="margin-left:18px;">bidang pendidikan di sekolahnya, 
		diseminarkan di sekolahnya, disimpan di perpustakaan.</p>
	</td>
	<td>
		35
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_35" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_35" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_35" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:40px;">
		f.  Membuat makalah berupa tinjauan ilmiah dalam bidang
		<p style="margin-left:18px;">pendidikan formal dan pembelajaran pada satuan
			pendidikannya, tidak diterbitkan, disimpan di perpustakaan.</p>
	</td>
	<td>
		36
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_36" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_36" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_36" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:40px;">
		g.  Membuat Tulisan Ilmiah Populer di bidang pendidikan
		<p style="margin-left:18px;">formal dan pembelajaran pada satuan pendidikannya.</p>
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
	<td style="padding-left:55px;">
		1) Membuat Artikel Ilmiah Populer di bidang pendidikan
			<p style="margin-left:18px;">formal dan pembelajaran pada satuan pendidikannya
			dimuat di media masa tingkat nasional</p>
	</td>
	<td>
		37
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_37" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_37" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_37" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:55px;">
		2) Membuat Artikel Ilmiah Populer di bidang pendidikan
			<p style="margin-left:18px;">formal dan pembelajaran pada satuan pendidikannya 
			dimuat di media masa tingkat provinsi (koran daerah).</p>
	</td>
	<td>
		38
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_38" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_38" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_38" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:40px;">
		h.  Membuat Artikel Ilmiah dalam bidang pendidikan formal
		<p style="margin-left:18px;">dan pembelajaran pada satuan pendidikannya.</p>
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
	<td style="padding-left:55px;">
		1) Membuat Artikel Ilmiah dalam bidang pendidikan
			<p style="margin-left:19px;">formal dan pembelajaran pada satuan pendidikannya 
			dan dimuat di jurnal tingkat nasional yang terakreditasi</p>
	</td>
	<td>
		39
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_39" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_39" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_39" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:55px;">
		2) Membuat Artikel Ilmiah dalam bidang pendidikan
			<p style="margin-left:19px;">formal dan pembelajaran pada satuan pendidikannya dan
			dimuat di jurnal tingkat nasional yang tidak terakreditasi/tingkat propvinsi.</p>
	</td>
	<td>
		40
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_40" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_40" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_40" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:50px;">
		3) Membuat Artikel Ilmiah dalam bidang pendidikan
			<p style="margin-left:19px;">formal dan pembelajaran pada satuan 
			pendidikannya dan dimuat di jurnal tingkat lokal 
			(kabupaten/kota/ sekolah/madrasah dstnya).</p>
	</td>
	<td>
		41
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_41" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_41" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_41" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:23px;">
		3. Melaksanakan publikasi buku teks pelajaran, buku
			<p style="margin-left:18px;"> pengayaan, dan pedoman Guru:</p>
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
	<td style="padding-left:40px;">
		a. Membuat buku pelajaran per tingkat/buku pendidikan per
		<p style="margin-left:18px;">judul.</p>
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
	<td style="padding-left:55px;">
		1) Buku pelajaran yang lolos penilaian oleh BSNP
	</td>
	<td>
		42
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_42" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_42" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_42" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:55px;">
		2) Buku pelajaran yang dicetak oleh penerbit dan ber
			<p style="margin-left:19px;">ISBN</p>
	</td>
	<td>
		43
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_43" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_43" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_43" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
</table>
</br></br></br>



<table class="keg_dupak">
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
	<td width="2%" rowspan="37" valign="top" align="center"></td>
	<td width="2%" rowspan="10" valign="top" align="center"></td>
	<td style="padding-left:55px;">
		3) Buku pelajaran dicetak oleh penerbit tetapi belum 
		<p style="margin-left:19px;">berISBN</p>
	</td>
	<td>
		44
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_44" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_44" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_44" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:40px;">
		b.  Membuat modul/diktat pembelajaran per semester:
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
	<td style="padding-left:55px;">
		1) Digunakan di tingkat Provinsi dengan pengesahan
		<p style="margin-left:19px;">dari Dinas Pendidikan Provinsi.</p>
	</td>
	<td>
		45
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_45" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_45" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_45" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:55px;">
		2) Digunakan di tingkat kota/kabupaten dengan
			<p style="margin-left:19px;">pengesahan dari Dinas Pendidikan Kota/Kabupaten</p>
	</td>
	<td>
		46
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_46" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_46" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_46" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:55px;">
		3) Digunakan di tingkat sekolah/madrasah setempat.
	</td>
	<td>
		47
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_47" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_47" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_47" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:40px;">
		c.  Membuat buku dalam bidang pendidikan:
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
	<td style="padding-left:55px;">
		1) Buku dalam bidang pendidikan dicetak oleh penerbit
		<p style="margin-left:19px;">dan ber-ISBN.</p>
	</td>
	<td>
		48
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_48" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_48" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_48" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:55px;">
		2) Buku dalam bidang pendidikan dicetak oleh penerbit
			<p style="margin-left:19px;">tetapi belum ber-ISBN.</p>
	</td>
	<td>
		49
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_49" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_49" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_49" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:40px;">
		d.  Membuat karya hasil terjemahan yang dinyatakan oleh
		<p style="margin-left:18px;">kepala sekolah/madrasah tiap karya.</p>
	</td>
		<td>
		50
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_50" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_50" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_50" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:40px;">
		e.  Membuat buku pedoman guru
	</td>
	<td>
		51
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_51" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_51" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_51" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td width="2%" rowspan="20" valign="top" align="center">
		C.
	</td>
	<td>
		Melaksanakan Karya Inovatif
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
	<td style="padding-left:23px;">
		1. Menemukan teknologi tepat guna
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
	<td style="padding-left:40px;">
		a. Kategori Kompleks
	</td>
	<td>
		52
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_52" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_52" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_52" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:40px;">
		b. Kategori Sederhana
	</td>
	<td>
		53
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_53" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_53" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_53" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:23px;">
		2. Menemukan / menciptakan karya seni
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

	<td style="padding-left:40px;">
		a. Kategori Kompleks
	</td>
	<td>
		54
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_54" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_54" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_54" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:40px;">
		b. Kategori Sederhana
	</td>
	<td>
		55
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_55" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_55" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_55" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:23px;">
		3. Membuat/modifikasi alat pelajaran/peraga/praktikum:
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
	<td style="padding-left:40px;">
		a. Membuat alat pelajaran judul
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
	<td style="padding-left:55px;">
		1) Kategori kompleks
	</td>
	<td>
		56
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_56" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_56" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_56" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:55px;">
		2) Kategori sederhana
	</td>
	<td>
		57
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_57" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_57" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_57" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:40px;">
		b. Membuat alat peraga:
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
	<td style="padding-left:55px;">
		1) Kategori kompleks
	</td>
	<td>
		58
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_58" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_58" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_58" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:55px;">
		2) Kategori sederhana
	</td>
	<td>
		59
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_59" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_59" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_59" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:40px;">
		c. Membuat alat praktikum:
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
	<td style="padding-left:55px;">
		1) Kategori kompleks
	</td>
	<td>
		60
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_60" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_60" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_60" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:55px;">
		2) Kategori sederhana
	</td>
	<td>
		61
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_61" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_61" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_61" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:23px;">
		4. Mengikuti Kegiatan Penyusunan, Pedoman, Soal dan
			<p style="margin-left:18px;"> sejenisnya </p>
		
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
	<td style="padding-left:40px;">
		a. Mengikuti Kegiatan Penyusunan Standar/ 
		<p style="margin-left:18px;">Pedoman/ Soal dan sejenisnya pada tingkat nasional. </p>
	</td>
	<td>
		62
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_62" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_62" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_62" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:40px;">
		b. Mengikuti Kegiatan Penyusunan Standar/ 
		<p style="margin-left:18px;">Pedoman/ Soal dan sejenisnya pada tingkat provinsi.</p>

	</td>
	<td>
		63
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_63" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_63" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_63" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td colspan="2" class="isi" style="padding-left:27px;">
		JUMLAH MELAKSANAKAN PIKI
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
	
	</td>
	<td  align="center">
		
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="jm_piki" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
		
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
		Memperoleh gelar/ijazah yang tidak sesuai dengan bidang yang
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
	<td style="padding-left:23px;">
		1. Memperoleh gelar/ijazah yang tidak sesuai dengan bidang
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
<tr>
	<td style="padding-left:40px;">
		a. Doktor (S.3)
	</td>
	<td>
		64
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_64" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_64" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_64" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:40px;">
		b. Pasca Sarjana (S.2)
	</td>
	<td>
		65
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_65" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_65" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_65" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:40px;">
		c. Sarjana (S.1) / Diploma IV
	</td>
	<td>
		66
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_66" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_66" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_66" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
</table>
<br><br><br><br>



<table class="keg_dupak">
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
	<td width="2%" rowspan="19" valign="top" align="center"></td>
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
<tr>
	<td  style="padding-left:23px;">
		a. Membimbing siswa dalam praktik kerja nyata/ praktik
		<p style="margin-left:19px;"> industri/ ekstrakurikuler dan yang sejenisnya</p>
	</td>
	<td>
		67
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_67" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_67" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_67" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:23px;">
		b. Sebagai pengawas ujian penilaian dan evaluasi terhadap
		<p style="margin-left:19px;"> proses dan hasil belajar tingkat : </p>
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
	<td style="padding-left:40px;">
		1) Sekolah
	</td>
	<td>
		68
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_68" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_68" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_68" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:40px;">
		2) nasional
	</td>
	<td>
		69
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_69" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_69" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_69" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:23px;">
		c. Menjadi angota organisasi profesi, sebagai:
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
	<td style="padding-left:40px;">
		1) Pengurus Aktif
	</td>
	<td>
		70
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_70" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_70" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_70" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:40px;">
		2) Anggota Aktif
	</td>
		<td>
		71
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_71" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_71" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_71" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:23px;">
		d. Menjadi anggota kegiatan kepramukaan, sebagai:
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
	<td style="padding-left:40px;">
		1) Pengurus Aktif
	</td>
		<td>
		72
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_72" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_72" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_72" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:40px;">
		2) Anggota Aktif
	</td>
		<td>
		73
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_73" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_73" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_73" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:23px;">
		e. Menjadi Tim Penilai Angka Kredit:
	</td>
	<td>
		74
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_74" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_74" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_74" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:25px;">
		f. Menjadi tutor / pelatih / instruktur ( per 2 jam pelajaran )
	</td>
	<td>
		75
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_75" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_75" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_75" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
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
	<td style="padding-left:23px;">
		1. Memperoleh penghargaan / tanda jasa Satya Lancana 
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
<tr>
	<td style="padding-left:40px;">
		a. 30 (tiga puluh) tahun
	</td>
	<td>
		76
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_76" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_76" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_76" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:40px;">
		a. 20 (dua puluh) tahun
	</td>
	<td>
		77
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_77" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_77" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_77" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:40px;">
		a. 10 (sepuluh) tahun
	</td>
	<td>
		78
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_78" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_78" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_78" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
<tr>
	<td style="padding-left:23px;">
		2. Memperoleh Penghargaan/tanda jasa
	</td>
	<td>
		79
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="ak_79" readonly>
	</td>
	<td  align="center">
		<input type="text" class="ak_cetak f"  id="f_79" readonly>
	</td>
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="akf_79" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
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
	<td  align="right">
		<input type="text" class="ak_cetak ak"  id="jm_penunjang" readonly>
	</td>
	<td  align="center"></td>
	<td  align="center"></td>
</tr>
</table>
<br><br><br><br>


<table class="kop" id="tabulasi">
<tr height="700px">
	<td>
	&nbsp;
	</td>
</tr>
</table>

<table class="kop" >
<tr>
	<td align="center" height="38px" valign="top">
		<FONT style=" font-size:14pt; font-weight:bold;">
		REKAPITULASI JUMLAH NILAI USULAN PENETAPAN ANGKA KREDIT
		</FONT>
	</td>
</tr>
</table>


<table class="keg_dupak">
<tr>
    <th width="*%" colspan="2" >UNSUR / SUB UNSUR</th>
	<th width="13%">LAMA</th>
	<th width="13%">BARU</th>
	<th width="13%">JUMLAH</th>
</tr>
<tr>
	<td width="3%" rowspan="9" align="center" valign="top">
		1
	</td>
	<td colspan="4" class="isi">
		UNSUR UTAMA	
	</td>
</tr>
<tr>
	<td style="padding-left:23px;">
		A. PENDIDIKAN
	</td>
	<td align="center">
		<input type="text" class="ak_cetak ak"  id="" readonly>
	</td>
	<td align="center">
		<input type="text" class="ak_cetak ak"  id="" readonly>
	</td>
	<td align="center">
		<input type="text" class="ak_cetak ak"  id="" readonly>
	</td>
</tr>
<tr>
	<td style="padding-left:53px;">
		1. PENDIDIKAN SEKOLAH
	</td>
	<td align="center">
		<input type="text" class="ak_cetak ak"  id="r_pend_lama" readonly>
	</td>
	<td align="center">
		<input type="text" class="ak_cetak ak"  id="r_pend_baru" readonly>
	</td>
	<td align="center">
		<input type="text" class="ak_cetak ak"  id="r_pend_total" readonly>
	</td>
</tr>
<tr>
	<td style="padding-left:53px;">
		2. DIKLAT PRAJABATAN
	</td>
	<td align="center">
		<input type="text" class="ak_cetak ak"  id="r_diklat_lama" readonly>
	</td>
	<td align="center">
		<input type="text" class="ak_cetak ak"  id="r_diklat_baru" readonly>
	</td>
	<td align="center">
		<input type="text" class="ak_cetak ak"  id="r_diklat_total" readonly>
	</td>
</tr>
<tr>
	<td style="padding-left:23px;">
		B. PBM
	</td>
	<td align="center">
		<input type="text" class="ak_cetak ak"  id="r_pbt_lama" readonly>
	</td>
	<td align="center">
		<input type="text" class="ak_cetak ak"  id="r_pbt_baru" readonly>
	</td>
	<td align="center">
		<input type="text" class="ak_cetak ak"  id="r_pbt_total" readonly>
	</td>
</tr>
<tr>
	<td style="padding-left:23px;">
		C. PENGEMBANGAN PROFESI BERKELANJUTAN
	</td>
	<td align="center">
		
	</td>
	<td align="center">
		
	</td>
	<td align="center">
		
	</td>
</tr>
<tr>
	<td style="padding-left:53px;">
		1. PENGEMBANGAN DIRI
	</td>
	<td align="center">
		<input type="text" class="ak_cetak ak"  id="r_pd_lama" readonly>
	</td>
	<td align="center">
		<input type="text" class="ak_cetak ak"  id="r_pd_baru" readonly>
	</td>
	<td align="center">
		<input type="text" class="ak_cetak ak"  id="r_pd_total" readonly>
	</td>
</tr>
<tr>
	<td style="padding-left:53px;">
		2. PUBLIKASI ILMIAH
	</td>
	<td align="center">
		<input type="text" class="ak_cetak ak"  id="r_pi_lama" readonly>
	</td>
	<td align="center">
		<input type="text" class="ak_cetak ak"  id="r_pi_baru" readonly>
	</td>
	<td align="center">
		<input type="text" class="ak_cetak ak"  id="r_pi_total" readonly>
	</td>
</tr>
<tr>
	<td style="padding-left:53px;">
		3. KARYA INOVATIF
	</td>
	<td align="center">
		<input type="text" class="ak_cetak ak"  id="r_ki_lama" readonly>
	</td>
	<td align="center">
		<input type="text" class="ak_cetak ak"  id="r_ki_baru" readonly>
	</td>
	<td align="center">
		<input type="text" class="ak_cetak ak"  id="r_ki_total" readonly>
	</td>
</tr>
<tr>
	<td COLSPAN="2" style="padding-left:32px;">
		JUMLAH UNSUR UTAMA
	</td>
	<td align="center">
		<input type="text" class="ak_cetak ak"  id="r_unsur_utama_lama" readonly>
	</td>
	<td align="center">
		<input type="text" class="ak_cetak ak"  id="r_unsur_utama_baru" readonly>
	</td>
	<td align="center">
		<input type="text" class="ak_cetak ak"  id="r_unsur_utama_total" readonly>
	</td>
</tr>
<tr>
	<td width="3%" rowspan="2" align="center" valign="top">
		2
	</td>
	<td colspan="4" class="isi">
		UNSUR PENUNJANG
	</td>
</tr>
<tr>
	<td style="padding-left:23px;">
		PENUNJANG TUGAS GURU
	</td>
	<td align="center">
		<input type="text" class="ak_cetak ak"  id="r_dukung_tugas_lama" readonly>
	</td>
	<td align="center">
		<input type="text" class="ak_cetak ak"  id="r_dukung_tugas_baru" readonly>
	</td>
	<td align="center">
		<input type="text" class="ak_cetak ak"  id="r_dukung_tugas_total" readonly>
	</td>
</tr>
<tr>
	<td COLSPAN="2" style="padding-left:32px;">
		JUMLAH UNSUR PENUNJANG
	</td>
	<td align="center">
		<input type="text" class="ak_cetak ak"  id="r_unsur_penunjang_lama" readonly>
	</td>
	<td align="center">
		<input type="text" class="ak_cetak ak"  id="r_unsur_penunjang_baru" readonly>
	</td>
	<td align="center">
		<input type="text" class="ak_cetak ak"  id="r_unsur_penunjang_total" readonly>
	</td>
</tr>
<tr>
	<td COLSPAN="2" style="padding-left:32px;">
		JUMLAH UNSUR UTAMA DAN PENUNJANG
	</td>
	<td align="center">
		<input type="text" class="ak_cetak ak"  id="r_ak_lama" readonly>
	</td>
	<td align="center">
		<input type="text" class="ak_cetak ak"  id="r_ak_baru" readonly>
	</td>
	<td align="center">
		<input type="text" class="ak_cetak ak"  id="r_ak_total" readonly>
	</td>
</tr>
</table>
<br><br><br>

<table  class="keg_dupak">
<tr>
	<th width="5%">
		
	</th>
	<th style="padding-left:15px;" align="left" colspan="2">
		LAMPIRAN PENDUKUNG DUPAK
	</th>
</tr>
<tr>
	<td>
		
	</td>
	<td width="68%">
		1. &nbsp;&nbsp;&nbsp; Surat pernyataan melakukan kegiatan pembelajaran/
		<p style="margin-left:39px;">pembimbingan dan tugas tertentu dan/atau tugas  lain yang 
			relevan dengan fungsi sekolah/madrasah</p><br>
		2. &nbsp;&nbsp;&nbsp; Surat pernyataan melakukan kegiatan pengembangan
		<p style="margin-left:39px;"> keprofesian berkelanjutan</p><br>
		3. &nbsp;&nbsp;&nbsp; Surat pernyataan melakukan penunjang tugas guru
	</td>
	<td>
	
	</td>
</tr>
<tr>
	<th></th>
	<th style="padding-left:15px;" align="left">
		CATATAN PEJABAT PENGUSUL
	</th>
	<th></th>
</tr>
<tr>
	<td></td>
	<td>
		<br>
		1. &nbsp;&nbsp;&nbsp; ...........................................<br><br>
		2. &nbsp;&nbsp;&nbsp; ...........................................<br><br>
		3. &nbsp;&nbsp;&nbsp; ...........................................<br><br>
		4. &nbsp;&nbsp;&nbsp; Dst
		
	</td>
	<td align='center'>
		<input type="text" class="field_isi" id="tanggal_dupak">
		
		
		
		<p style="margin:70px 0 0px;">
		<input type="text" class="field_isi" id="ttd_kepsek">
		</p>
		
		<input type="text" class="field_isi" id="nip_ttd_kepsek">
		
		
	</td>
</tr>
</table>
<br>
<table class="kop" >
<tr>
	<td>
		<span id="qr" style=" margin-left:-7px;" ></span>
	</td>
</tr>
</table>


</div>




<?php if(!isset($_SERVER['HTTP_REFERER'])) { ?><script type="text/javascript">document.location  = "./index.php";</script><?php exit(); }  ?>


<!--=====================================================- > 
**********************************************************
                  TAMPIL DATA PENGGUNA
**********************************************************
<--====================================================---->	  
<h3 class="page-header">
DATA PENGGUNA
</h3>


	<div class="toolbar">
	<a href="?page=tambah_pengguna"><button class="ui-state-default tambah"  >Tambah Pengguna</button></a>
	</div>
	<table id="table_pengguna" class="data table table-striped table-hover table-bordered table-condensed" width="100%">
		<thead>
			<tr>
				<th width="4%">NO</th>
				<th width="13%">NIP</th>
				<th width="18%">NAMA LENGKAP</th>
				<th width="3%">JK</th>
				<th width="12%">USERNAME</th>
				<th width="9%">GROUP</th>
				<th width="*%">SEKOLAH</th>
				<th width="11%">LOG TERAKHIR</th>
			</tr>  
		</thead>  
	</table>


<link href="./css/bootstrap.min.css" rel="stylesheet">
<link href="./css/datatables.min.css" rel="stylesheet">
<script src="./js/datatables.min.js"></script>

<script>
	var table = $('#table_pengguna').DataTable({
						destroy		: true,
						processing	: true,
						serverSide	: true,
						order		: [[2, 'asc']],
						lengthMenu	: [10, 25, 50, 100],
			
						ajax		: {
										url		: './kelas/table.php',
										data	: { tb: "pengguna_list" },
									},
						columnDefs	: [{ className	: "text-center", targets		: [0,3,5,7] }, 
									 ],
						"columns":	 [


											{
												data: 'id',
												orderable: false,
												"render": function(data, type, row, meta) {
													return meta.row + meta.settings._iDisplayStart + 1;
												}
											},
											{
												data: "nip_pengguna",
												name: "nip_pengguna",
												orderable: true,
											},
											{
												data: "nama_pengguna",
												name: "nama_pengguna",
												orderable: true,
												"render": function(data, type, row, meta) {
													return '<a href="?page=detail_pengguna&id='+row.id+'" class="detail_pengguna" >'+row.nama_pengguna+'</a>';
												}
											},
											{
												data: "jk",
												orderable: false,
											},
											{
												data: "username",
												orderable: true,
											},
											{
												data: "user_group",
												orderable: true,
											},
											{
												data: "sekolah",
												orderable: true,
											},
											{
												data: "last_log",
												orderable: false,
											},

									],
				});





	
	$(".detail_pengguna").click(function(){
		var id_pengguna = $(this).attr('value');
		alert();
		window.location.assign("?page=detail_pengguna&id="+id_pengguna);
	})
</script>

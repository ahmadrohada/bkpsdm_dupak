<?php



$s_nama_file = isset($_SESSION['nama_file']) ? $_SESSION['nama_file'] : '';


if ( $nama_file != $s_nama_file ) {
$_SESSION['cari'] = '';
}


if ( isset($_GET['periode']) ){
	$periode ='&periode='.$_GET['periode'];
	
}else{
	$periode = '';
	
}


if ( $_SESSION['cari'] != '' ){
	$cari_data =$_SESSION['cari'];
	
}else{
	$cari_data = '';
	
}
//echo $nama_file.$s_nama_file.$_SESSION['cari'];
// menampilkan link previous



if ($nohal > 1) echo  "<a class='pagination' href='".$_SERVER['PHP_SELF']."?page=$nama_file&hal=".($nohal-1)."".$periode."".$cari_data."'>&lt;&lt; Prev</a>";





// memunculkan nomor halaman dan linknya

$showhal = '';

for($hal = 1; $hal <= $jumhal; $hal++)


{


         if ((($hal >= $nohal - 3) && ($hal <= $nohal + 3)) || ($hal == 1) || ($hal == $jumhal)) 


         {   


            if (($showhal == 1) && ($hal != 2))  echo "..."; 


            if (($showhal != ($jumhal - 1)) && ($hal == $jumhal))  echo "...";


            if ($hal == $nohal) echo " <b class='disabled'>".$hal."</b> ";


            else echo " <a class='pagination' href='".$_SERVER['PHP_SELF']."?page=$nama_file&hal=".$hal."".$periode."".$cari_data."'>".$hal."</a> ";


            $showhal = $hal;          


         }


}





// menampilkan link next


if ($nohal < $jumhal) echo "<a class='pagination' href='".$_SERVER['PHP_SELF']."?page=$nama_file&hal=".($nohal+1)."".$cari_data."'>Next &gt;&gt;</a>";





?>
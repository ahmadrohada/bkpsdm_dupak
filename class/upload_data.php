<?php
session_start();
include_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../config/conn.php';
include_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../class/pustaka.php';
$d     = new FormatTanggal();
date_default_timezone_set('Asia/Jakarta');
$waktu = date('Y' . "-" . 'm' . "-" . 'd' . " " . 'H' . ":" . 'i' . ":" . 's');

    //TRUNCATE DULU tmp nya
    $delete = $koneksi->prepare("TRUNCATE TABLE tmp");
    $delete->execute();

    $extensionList = array("csv","application/vnd.ms-excel","application/ms-excel");
    $namafile = $_FILES['file']['name'];
	$pecah = explode(".",$namafile);
	$id_mesin = $pecah[0];
	$extensi = $pecah[1];
	
    if(in_array($extensi,$extensionList)) {
	
        //Baca file CSV
        $handle = fopen($_FILES['file']['tmp_name'], "r");
        $data = fgetcsv($handle, 1000, "\t"); //Hilangkan bagian ini, jika file CVSnya tidak ada baris header (cuma data saja).
        while (($data = fgetcsv($handle, 1000, "\t")) !== FALSE) {
        
           
            try{
                $query = $koneksi->prepare("INSERT INTO tmp  (a,b,c,d,e,f,g,h)
                                        VALUES(:a, :b, :c, :d, :e, :f, :g, :h )");
                                        
                $query->execute(array(
                                            "a" => mysql_real_escape_string($data[0]),
                                            "b" => mysql_real_escape_string($data[1]),
                                            "c" => mysql_real_escape_string($data[2]),
                                            "d" => mysql_real_escape_string($data[3]),
                                            "e" => mysql_real_escape_string($data[4]),
                                            "f" => mysql_real_escape_string($data[5]),
                                            "g" => mysql_real_escape_string($data[6]),
                                            "h" => mysql_real_escape_string($data[7])
                                            ));	
                
            
            }
            catch ( PDOException $e)
            {
                header('HTTP/1.1 400 error'); //if error
            }
    
        }
        header('HTTP/1.1 200 error');

    }else{
        header('HTTP/1.1 500 Unknown ext file'); //if error
    } 

?>
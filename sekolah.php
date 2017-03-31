<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "mhs";


mysql_connect($server, $username, $password) or die("<h1>Koneksi Mysql Error : </h1>" . mysql_error());
mysql_select_db($database) or die("<h1>Koneksi Database Error : </h1>" . mysql_error());


@$tampil = $_GET['tampil'];


switch ($tampil) {
    case "tampilkan":


        $query_tampil_sekolah = mysql_query("SELECT * FROM sekolah") or die(mysql_error());
        $data_array = array();
        while ($data = mysql_fetch_assoc($query_tampil_sekolah)) {
            $data_array[] = $data;
        }
        
        echo json_encode($data_array);
        
        break;

        /* ini buat tambah data*/
        case "insert":
        @$nama = $_GET['nama'];
        @$alamat = $_GET['alamat'];
        $query_insert_data = mysql_query("INSERT INTO sekolah (nama, alamat) VALUES('$nama', '$alamat')");
        
        if ($query_insert_data) {
            
            echo "Data Berhasil Disimpan";
        
        } else {

            echo "Error Inser sekolah " . mysql_error();
        
        }
        
        break;

    case "get_sekolah_by_id":
        /* ini Edit data dan mengirim data berdasarkan id */
        @$id = $_GET['id'];
        $query_tampil_sekolah = mysql_query("SELECT * FROM sekolah WHERE id='$id'") or die(mysql_error());
        $data_array = array();
        $data_array = mysql_fetch_assoc($query_tampil_sekolah);
        echo "[" . json_encode($data_array) . "]";
            
            break;

    case "update":
        /* ubah data */
        @$nama = $_GET['nama'];
        @$alamat = $_GET['alamat'];
        @$id = $_GET['id'];
        $query_update_sekolah = mysql_query("UPDATE sekolah SET nama='$nama', alamat='$alamat' WHERE id='$id'");
        if ($query_update_sekolah) {
            echo "Update Data Berhasil";
        } else {
            echo mysql_error();
        }
        
        break;

    case "delete":
        /* hapus data */
        @$id = $_GET['id'];
        $query_delete_sekolah = mysql_query("DELETE FROM sekolah WHERE id='$id'");
        if ($query_delete_sekolah) {
            echo "Delete Data Berhasil";
        } else {
            echo mysql_error();
        }
        break;

    default:

        break;
}
?>
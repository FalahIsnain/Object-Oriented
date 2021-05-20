<?php 
    include ('database.php');
    $db = new Database();


    $action = $_GET['action'];
    
    if ($action == "add"){
        
        $temp = $_FILES['foto']['tmp_name'];
        $foto = $_FILES['foto']['name'];
        $folder = "files/";
        move_uploaded_file($temp, $folder.$foto);

        $data = array(
            'id_unitkerja' => $unit_kerja = $_POST["unit_kerja"],
            'id_jabatan' =>$_POST["jabatan"],
            'id_pengguna' => $_POST["id"],
            'nama_pegawai' => $_POST["nama_pegawai"],
            'tempat_lahir' => $_POST["tempat_lahir"],
            'tanggal_lahir' => $_POST["tanggal_lahir"],
            'foto' => $foto
        );

        
        $db->insert_data($data);    
        header('location:index.php');
        
    }
    elseif($action == "update") {
            
        $temp = $_FILES['foto']['tmp_name'];
        $foto = $_FILES['foto']['name'];
        $folder = "files/";
        move_uploaded_file($temp, $folder.$foto);

        $data = array(
            'id_unitkerja' => $unit_kerja = $_POST["unit_kerja"],
            'id_jabatan' =>$_POST["jabatan"],
            'nama_pegawai' =>$_POST["nama_pegawai"],
            'tempat_lahir' =>$_POST["tempat_lahir"],
            'tanggal_lahir' =>$_POST["tanggal_lahir"]
            
        );

        
        if($foto != "") $data['foto'] = $foto;
        $nip = $_GET["nip"];
        
        $db->update_data($nip, $data);    
        header('location:index.php');
        
        
    }
    elseif($action == "deletepegawai"){
        $nip = $_GET["nip"];
        $db->delete_data($nip);
        header('location:index.php');
    }
    
    elseif($action == "deletejab"){
        $idjab = $_GET["idjab"];
        $db->delete_jabatan($idjab);
        header('location:jabatan.php');
    }  

    elseif($action == "deleteUK"){
        $idUK = $_GET["idUK"];
        $db->delete_UK($idUK);
        header('location:UK.php');
    }  
 
?>
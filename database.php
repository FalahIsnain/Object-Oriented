<?php
class Database
{

    var $host = "localhost";
    var $user = "root";
    var $password = "";
    var $db = "db_loginpegawai";
    var $conn = "";

    function __construct()
    {
        $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->db);
        if (mysqli_connect_errno()) {
            die("Error connecting to database: " . mysqli_connect_error());
        }
    }
    function show_data($cari)
    {
        $limit = 4;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $start = $limit * ($page - 1);
        if ($cari != "") {
            $pegawai = mysqli_query($this->conn, "SELECT * FROM  pegawai p JOIN unit_kerja u ON p.id_unitkerja = u.id_unitkerja JOIN jabatan j ON p.id_jabatan = j.id_jabatan WHERE nama_pegawai LIKE '%" . $cari . "%' LIMIT $start,$limit ");
        } else {
            $pegawai = mysqli_query($this->conn, "SELECT * FROM pegawai p JOIN unit_kerja u ON p.id_unitkerja = u.id_unitkerja JOIN jabatan j ON p.id_jabatan = j.id_jabatan LIMIT $start, $limit");
        }
        if (mysqli_num_rows($pegawai) > 0) {
            foreach ($pegawai as $row) {
                $data[] = $row;
            }
            return $data;
        } else return 0;
    }

    function show_UK()
    {
        $sql = "SELECT * FROM unit_kerja";
        $UK = mysqli_query($this->conn, $sql);
        if (mysqli_num_rows($UK) > 0) {
            foreach ($UK as $row) {
                $data[] = $row;
            }
            return $data;
        } else return 0;
    }

    function show_jabatan()
    {
        $sql = "SELECT * FROM jabatan";
        $jabatan = mysqli_query($this->conn, $sql);
        if (mysqli_num_rows($jabatan) > 0) {
            foreach ($jabatan as $row) {
                $data[] = $row;
            }
            return $data;
        } else return 0;
    }

    function insert_UK($namaUK)
    {
        $query = "INSERT INTO unit_kerja VALUES ('','$namaUK')";
        mysqli_query($this->conn, $query);
    }

    function insert_jabatan($namajab)
    {
        $query = "INSERT INTO jabatan VALUES ('','$namajab')";
        mysqli_query($this->conn, $query);
    }

    function delete_UK($idUK)
    {
        mysqli_query($this->conn, "DELETE FROM unit_kerja WHERE id_unitkerja = '$idUK'");
    }

    function delete_jabatan($idjab)
    {
        mysqli_query($this->conn, "DELETE FROM jabatan WHERE id_jabatan = '$idjab'");
    }


    function jabatan()
    {
        $jabatan = mysqli_query($this->conn, "SELECT * FROM jabatan");
        foreach ($jabatan as $row) {
            $data[] = $row;
        }
        return $data;
    }

    function unit_kerja()
    {
        $unit_kerja = mysqli_query($this->conn, "SELECT * FROM unit_kerja");
        foreach ($unit_kerja as $row) {
            $data[] = $row;
        }
        return $data;
    }

    function insert_data($data)
    {
        $col = implode(',' , array_keys($data));
        $val = "'" . implode("','", array_values($data)) . "'";
        mysqli_query($this->conn, "INSERT INTO pegawai($col) VALUES($val)");
    
    }

    function get_by_nip($nip)
    {
        $query = "SELECT * FROM pegawai where nip='$nip'";
        $pegawai = mysqli_query($this->conn, $query);
        return $pegawai->fetch_array();
    }


    function update_data($nip, $data)
    {
        $dataset = "";
        foreach ($data as $key => $val) {
            $dataset .= $key . '="' . $val . '",';
        }
        $dataset = rtrim($dataset, ',');
        mysqli_query($this->conn, "UPDATE pegawai SET $dataset WHERE nip=$nip");

        
    }


    function delete_data($nip)
    {
        mysqli_query($this->conn, "DELETE FROM pegawai WHERE nip = '$nip'");
    }

    function login($user, $pass)
    {
        $pass = sha1($pass);
        $sql = "SELECT * FROM pengguna WHERE username = '$user' AND password = '$pass'";
        $query = mysqli_query($this->conn, $sql);
        return $query->fetch_array();
    }

    function get_pages()
    {
        $limit = 4;
        $get = mysqli_fetch_array(mysqli_query($this->conn, "SELECT COUNT(*) total FROM pegawai "));
        $total = $get['total'];
        $pages = ceil($total / $limit);
        return $pages;
    }
}

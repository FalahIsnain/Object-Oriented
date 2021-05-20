<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Database Pegawai</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/f205f81ba4.js" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>


<body>

    <?php
    session_start();
    if (empty($_SESSION["username"])) {
        header("Location:login.php");
    }

    ?>

    <h3 style="margin-left: 100px; margin-top: 30px; color: blue;">Hallo , Selamat Datang <b><?= $_SESSION["nama"]; ?></h3>



    <div class="container">

        <?php
        $cari = "";
        if (isset($_GET["cari"])) {
            $cari = $_GET["cari"];
        ?>
           <p style="font-size: 18px; color: blue;"> Hasil Pencarian : <b> <?= $cari ?></b> </p>
        <?php }?>
        
        

        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-xs-5">
                            <h2>Data <b>Pegawai</b></h2> <br>
                        </div>

                        <div class="col px-md-1 mt-1">
                            <a href="form-input.php" class="btn btn-primary"><i class="material-icons">&#xE147;</i> <span>Tambah Data Pegawai</span></a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NIP</th>
                            <th>Unit Kerja</th>
                            <th>Jabatan</th>
                            <th>Nama</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Foto</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include('database.php');
                        $db = new Database();

                        $data = $db->show_data($cari);
                        $limit = 4;
                        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $start = $limit * ($page - 1);
                        ?>

                        <?php if ($data > 0) : ?>
                            <?php $no = $start + 1; ?>
                            <?php foreach ($data as $row) : ?>

                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $row['nip']; ?></td>
                                    <td><?= $row['nama_unitkerja']; ?></td>
                                    <td><?= $row['nama_jabatan']; ?></td>
                                    <td><?= $row['nama_pegawai']; ?></td>
                                    <td><?= $row['tempat_lahir']; ?></td>
                                    <td><?= $row['tanggal_lahir']; ?></td>
                                    <td><img src="<?php echo "files/" . $row['foto']; ?>" width="50"></td>
                                    <td>
                                        <a href="form-update.php?nip=<?= $row['nip']; ?>" class="settings" title="Edit" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="proses_pgw.php?action=deletepegawai&nip=<?= $row['nip']; ?>" class="delete" title="Delete" data-toggle="tooltip"><i class="fas fa-trash"></i></a>

                                    </td>



                                </tr>
                                <?php $no++; ?>


                            <?php endforeach; ?>
                        <?php else : ?>
                            <?php echo "<tr> <td colspan='7'>Data tidak ada</td></tr"; ?>
                        <?php endif; ?>

                        <nav aria-label="pagination">
                            <ul class="pagination mt-3 ">
                                <?php

                                $pages = $db -> get_pages();
                                for ($i = 1; $i <= $pages; $i++) {
                                    if ($i != $page) {
                                        echo "<li class='page-item'><a class='page-link' href='index.php?page=$i'>$i</a></li>";
                                    } else {
                                        echo "<li class='page-item active'><a class='page-link' href='#'>$i</a></li>";
                                    }
                                }
                                ?>
                            </ul>
                        </nav>


                        <form action="index.php" method="get" name="form_cari">
                            <div class="input-group mb-3 w-25 h-25 p-3">
                                <input type="text" class="form-control" placeholder="" aria-label="Recipient's username" aria-describedby="button-addon2" name="cari">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>


                        </tr>

                    </tbody>
                </table>

                <div class="btn-group">
                    <a href="#" class="btn btn-primary disabled" aria-current="page">Kelola data</a>
                    <a href="UK.php" class="btn btn-primary">Unit Kerja</a>
                    <a href="jabatan.php" class="btn btn-primary">Jabatan</a>
                    
                </div>

                <a href="logout.php" style="float: right;">
                <button type="button" class="btn btn-danger btn-sm" >Log out</button>
                </a>
            
            </div>

        </div>

    
    </div>
    

</body>

</html>
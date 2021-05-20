<?php
include ("database.php");
$db = new Database();
$nip = $_GET["nip"];
if ($nip != "") {
    $data = $db-> get_by_nip($nip);
    $jabatan = $db-> jabatan();
    $unit_kerja = $db-> unit_kerja();

}

?>

<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="validate.js"></script>
    <title>Form Update</title>

    <style>
        .container {
            position: absolute;
            top: 20%;
            left: 10%;
            border: 1px solid black;
            padding: 20px;
            border-radius: 10px;
            background: white;
        }

        body {
            background: #7F7FD5;
            background: -webkit-linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);
            background: linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);



        }
    </style>

</head>

<body>
    <div>
        <form action="proses_pgw.php?action=update&nip=<?= $nip?>" method="post" enctype="multipart/form-data" onsubmit="return fotovalid()">

            <h2 style="left: 130px; position: relative;"><br><br><b>Form Update</b></h2>

            <div class="container">
                <table>
                    <tr>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">NIP</span>
                            </div>

                            <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" name="nip" value="<?= $data['nip'] ?>" readonly class="form-control-plaintext">
                        </div>
                    </tr>

                    <tr>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Unit Kerja</label>
                            </div>
                            <select class="custom-select" id="inputGroupSelect01" name="unit_kerja">
                                <option disabled required>Choose...</option>
                                <?php
                                foreach ($unit_kerja as $row) {
                                ?>
                                    <option value="<?= $row['id_unitkerja'] ?> " <?php echo ($data['id_unitkerja'] == $row['id_unitkerja']) ? "selected" : " " ?>>
                                        <?= $row['nama_unitkerja'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                    </tr>

                    <tr>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect02">Jabatan</label>
                            </div>
                            <select class="custom-select" id="inputGroupSelect02" name="jabatan">
                                <option disabled required>Choose...</option>
                                <?php
                                foreach ($jabatan as $row) {
                                ?>
                                    <option value="<?= $row['id_jabatan'] ?>" <?php echo ($data['id_jabatan'] == $row['id_jabatan']) ? "selected" : "" ?>>
                                        <?= $row['nama_jabatan'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </tr>

                    <tr>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Nama Pegawai</span>
                            </div>
                            <?php

                            ?>

                            <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" name="nama_pegawai" value="<?= $data['nama_pegawai'] ?>" required>
                        </div>
                    </tr>

                    <tr>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Tempat Lahir</span>
                            </div>
                            <?php

                            ?>
                            <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" name="tempat_lahir" value="<?= $data['tempat_lahir'] ?>" required>
                        </div>
                    </tr>

                    <tr>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Tanggal Lahir</span>
                            </div>
                            <?php

                            ?>
                            <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="tanggal_lahir" value="<?= $data['tanggal_lahir'] ?>" required>
                        </div>
                    </tr>

                    <tr>
                        <p>Silahkan Upload Foto Ulang</p>
                        <label for="foto"> Foto :</label>
                        <input type="file" class="form-control" placeholder="" name="foto" id="foto" value="<?= $data['foto'] ?>" required>
                    </tr>

                    <tr>

                        <div class="button-group mt-4">

                            <input class="btn btn-primary mr-3" type="submit" value="Submit">
                            <input class="btn btn-primary" type="reset" value="Reset">

                            <a href="index.php">
                                <button type="button" class="btn btn-danger" style="float: right;">Kembali</button>
                            </a>

                        </div>
                    </tr>

                </table>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>


</body>

</html>
<?php
include ('database.php');
$db = new Database();
if (isset($_POST['submit'])) {
    $namaUK = $_POST["namaUK"];

    $db -> insert_UK($namaUK);
    header("Location:UK.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Unit Kerja</title>

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



        <center>
            <h2><br><br><b>UNIT KERJA</b></h2>
        </center>

        <div class="container">

            <form action="" method="post">

                <div class="input-group flex-nowrap mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="addon-wrapping">Tambah Unit Kerja</span>
                    </div>
                    <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="addon-wrapping" name="namaUK" required>
                </div>



                <div class="btn-group mb-4" role="group" aria-label="Basic example">
                    <input class="btn btn-primary mr-3" type="submit" value="Submit" name="submit">

                    <a href="index.php">
                        <button type="button" class="btn btn-danger">Kembali</button>
                    </a>

                </div>



            </form>


            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Unit Kerja</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        $data = $db -> show_UK();                       
                        $no = 1;
                        ?>
                        <?php foreach ($data as $row) : ?>
                            <td><?= $no; ?></td>
                            <td><?= $row['nama_unitkerja']; ?></td>
                            <td>
                                <a href="proses_pgw.php?action=deleteUK&idUK=<?= $row['id_unitkerja']; ?>"> hapus</a>
                            </td>
                    </tr>
                    <?php $no++; ?>
                <?php endforeach; ?>

                </tr>
                </tbody>
            </table>

        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
        </script>
</body>

</html>
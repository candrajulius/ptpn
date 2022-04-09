<!-- page content -->
<?php
$msg_type="";
if(isset($_POST['submit'])){
    $nrp = $_POST['nrp'];
    $username = addslashes($_POST['nama_karyawan']);
    $smkbk = $_POST['smkbk'];
    $mapping_competency = $_POST['maping_competency'];
    $cli = $_POST['cli'];
    $pendidikan = $_POST['pendidikan'];
    $sertifikat = $_POST['sertifikat'];
    $perjalanan_karir = $_POST['perjalanan_karir'];
    $punishment = $_POST['punishment'];
    $jumlah = $smkbk+$mapping_competency+$cli+$pendidikan+$sertifikat+$perjalanan_karir+$punishment;

    //UPLOAD IMAGE
    $ekstensi_diperbolehkan	= array('png','jpg','svg','webp');
    $nama_gambar = $_FILES['file']['name'];
    $x = explode('.', $nama_gambar);
    $ekstensi = strtolower(end($x));
    $ukuran	= $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $path = 'images/thumbnail/'.$nama_gambar;
    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        if($ukuran < 1044070000){
            move_uploaded_file($file_tmp, $path);
        }
    }

    $ceckDb = mysqli_query($connection,"SELECT * FROM karyawan WHERE nrp= $nrp");
    if(mysqli_num_rows($ceckDb) > 0){   
        $msg_type = "error";
        $msg_content = "Data sudah ada di database";
    }else{
        $insertData = mysqli_query($connection,"INSERT INTO `karyawan` (`nrp`, `nama_karyawan`, `smbk`, `mapping_competency`, `cli`, `pendidikan`, `sertifikat`,`perjalanan_karir`,`punishment`,`jumlah`,`gambar`,`tgl_ditambah`) VALUES ('$nrp', '$username', '$smkbk', '$mapping_competency', '$cli', '$pendidikan', '$sertifikat', '$perjalanan_karir','$punishment','$jumlah','$path','$date $time')");
        if($insertData == true){
            $msg_type = "success";
            $msg_content = "Data berhasil ditambahkan";
        }else{
            $msg_type = "error";
            $msg_content = "System Error";
        }
    }
}

?>


<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Tambah Karyawan</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                    <?php
                    if($msg_type == "error") {
                        echo"
                        <div class='alert alert-danger w-100'>$msg_content</div>
                        ";
                    } else if($msg_type == "success") {
                        echo"
                        <div class='alert alert-success w-100'>$msg_content</div>
                        ";
                    }
                    ?>



                        <br />
                        <form id="sumtotal" data-parsley-validate class="form-horizontal form-label-left" method="post"  enctype="multipart/form-data">

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="nrp">NRP <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input autocomplete='off'  type="number" id="nrp" name="nrp" required="required" class="form-control ">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama_karyawan">Nama Karyawan<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input autocomplete='off'  type="text" id="nama_karyawan" name="nama_karyawan" required="required" class="form-control ">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="smkbk">SMKBK<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input autocomplete='off'  type="number" id="smkbk" name= "smkbk" required="required" class="form-control" class="hitung">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="maping_competency">Mapping Competency <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input autocomplete='off'  type="number" id="maping_competency" name="maping_competency" required="required" class="form-control" class="hitung">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="cli">CLI <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input autocomplete='off'  type="number" id="cli" name="cli" required="required" class="form-control " class="hitung">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="Pendidikan">Pendidikan <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input autocomplete='off'  type="number" id="Pendidikan" name="pendidikan" required="required" class="form-control " class="hitung">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Sertifikat<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input autocomplete='off'  type="number" id="sertifikat" name="sertifikat" required="required" class="form-control " class="hitung">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Perjalanan Karir<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input autocomplete='off'  type="number" id="Perjalanan Karir" name="perjalanan_karir" required="required" class="form-control " class="hitung">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="punishment">Punishment<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input autocomplete='off'  type="number" id="punishment" name="punishment" required="required" class="form-control " class="hitung">
                                </div>
                            </div>
                            <div class="item form-group d-none">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Jumlah<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input autocomplete='off' type="hidden" name="jumlah" class="form-control" id="total" readonly value="">
                                </div>
                            </div>
                            <div class="custom-file item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="customFile">Pilih Gambar<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                <input autocomplete='off'  type="file" class="form-control" id="exampleFormControlFile1" name="file" required>
                                <small class="text-danger">Ektensi Didperbolehkan : PNG,JPG,SVG,WEBP</small>
                                </div>
                            </div>
                            <div class="ln_solid mt-3"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <button class="btn btn-primary" type="reset">Reset</button>
                                    <button type="submit" class="btn btn-success" name="submit">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
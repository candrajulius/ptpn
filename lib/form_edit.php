<!-- page content -->
<?php
$msg_type="";
if(isset($_POST['edit'])){
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
    $ekstensi_diperbolehkan	= array('png','jpg','webp','svg','jpeg');
    $nama_gambar = $_FILES['file']['name'];
    $x = explode('.', $nama_gambar);
    $ekstensi = strtolower(end($x));
    $ukuran	= $_FILES['file']['size'];
    $path = "images/thumbnail/".$nama_gambar;
    $file_tmp = $_FILES['file']['tmp_name'];
    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        if($ukuran < 10044070000){
            move_uploaded_file($file_tmp, $path);
        }       
    }
    if($nama_gambar == NULL) {
        $gambar = $_POST['gambar'];
    } else {
        $gambar = $path;
    }


    //UPLOAD Document
    $ekstensi_file_diperbolehkan	= array('doc','pdf','xls','docx');
    $nama_file = $_FILES['dokumen']['name'];
    $tipe_file = explode('.', $nama_file);
    $ekstensi_file = strtolower(end($tipe_file));
    $newFileName =preg_replace("[a-zA-Z0-9_-]", "", $nama_file);
    $ukuran_dokumen	= $_FILES['dokumen']['size'];
    $file_doc_tmp = $_FILES['dokumen']['tmp_name'];
    $path_file = 'dokumen/'.$newFileName;
    if(in_array($ekstensi_file, $ekstensi_file_diperbolehkan) === true) {
        if($ukuran_dokumen < 1044070000){
            move_uploaded_file($file_doc_tmp, $path_file);
        }
    }
    if($nama_file == NULL) {
        $postNamefile = $_POST['nama_file'];
        $postTipefile = $_POST['tipe_file'];
        $postPathfile = $_POST['path'];
    } else {
        $postNamefile = $newFileName;
        $postTipefile = $ekstensi_file;
        $postPathfile = $path_file;
    }
    $document_query = mysqli_query($connection,"SELECT * FROM dokumen where nrp_parent = '{$data['nrp']}' AND nama_file = '$postNamefile' AND tipe_file = '$postTipefile'");
    $data_document = mysqli_fetch_array($document_query);

    $insertData = mysqli_query($connection,"UPDATE `karyawan` SET `nrp` = '$nrp', `nama_karyawan` = '$username', `smbk` = '$smkbk', `mapping_competency` = '$mapping_competency', `cli` = '$cli', `pendidikan` = '$pendidikan', `sertifikat` = '$sertifikat', `perjalanan_karir` = '$perjalanan_karir', `punishment` = '$punishment',`jumlah` = '$jumlah', `gambar` = '$gambar', `tgl_diupdate` = current_timestamp() WHERE `karyawan`.`id` = $target_data");
    if(mysqli_num_rows($document_query) > 0){
    } else {
        $insert_document = mysqli_query($connection,"INSERT INTO `dokumen` (`nrp_parent`, `nama_file`, `tipe_file`, `path`, `publish`) VALUES ('$nrp', '$postNamefile', '$postTipefile', '$postPathfile', '$date');");
    }
    if($insertData == true){
        $msg_type = "success";
        $msg_content = "Data Berhasil di Edit";
    }else{
        $msg_type = "error";
        $msg_content = "Systemn Error";
    }
}
$document_query = mysqli_query($connection,"SELECT * FROM dokumen where nrp_parent = '{$data['nrp']}' ORDER BY id DESC LIMIT 1");
$data_document = mysqli_fetch_array($document_query);
?>


<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Edit Nama <?=$data['nama_karyawan'];?></h2>
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
                        <script type='text/javascript'>
                        alert('$msg_content');
                        window.location.href = '$detail_karyawan$nrp';
                        </script>
                        ";
                    }
                    ?>
                        <br />
                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post"  enctype="multipart/form-data">

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="nrp">NRP <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input autocomplete='off'  type="number" id="nrp" name="nrp" required="required" value="<?=$data['nrp']?>" class="form-control ">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama_karyawan">Nama Karyawan<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input autocomplete='off'  type="text" id="nama_karyawan" name="nama_karyawan" required="required" value="<?=$data['nama_karyawan']?>" class="form-control ">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="smkbk">SMKBK<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input autocomplete='off'  type="number" id="smkbk" name= "smkbk" required="required" value="<?=$data['smbk']?>" class="form-control ">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="maping_competency">Mapping Competency <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input autocomplete='off'  type="number" id="maping_competency" name="maping_competency" required="required" value= "<?=$data['mapping_competency']?>"class="form-control ">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="cli">CLI <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input autocomplete='off'  type="number" id="cli" name="cli" required="required" value="<?=$data['cli']?>" class="form-control ">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Pendidikan <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input autocomplete='off'  type="number" id="first-name" name="pendidikan" required="required" value="<?=$data['pendidikan']?>" class="form-control ">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Sertifikat<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input autocomplete='off'  type="number" id="first-name" name="sertifikat" required="required" value="<?=$data['sertifikat']?>" class="form-control ">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Perjalanan Karir<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input autocomplete='off'  type="number" id="first-name" name="perjalanan_karir" required="required" value="<?=$data['perjalanan_karir']?>" class="form-control ">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="punishment">Punishment<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input autocomplete='off'  type="number" id="punishment" name="punishment" required="required" value="<?=$data['punishment']?>" class="form-control ">
                                </div>
                            </div>
                            <div class="item form-group d-none">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Jumlah<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input autocomplete='off'  type="number" id="first-name" name="jumlah" required="required" value="<?=$data['jumlah']?>" class="form-control ">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="customFile">Gambar Saat Ini
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                <img src="<?=$data['gambar'];?>" width="100" class="img-thumbnail shadow">
                                </div>
                            </div>
                            <div class="custom-file item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="customFile">Ubah Gambar<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                <input type="hidden" name="gambar" value="<?=$data['gambar'];?>">
                                <input autocomplete='off'  type="file" id="exampleFormControlFile1" name="file">
                                <small class="text-danger">Ektensi Didperbolehkan : PNG,JPG,SVG,WEBP</small>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="customFile">Dokumen Terbaru
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                <?php
                                if(mysqli_num_rows($document_query) == 0) {
                                    echo "<button class='btn btn-danger' type='button'>Tidak Ada Dokumen</button>";
                                } else {
                                    echo "<a class='btn btn-secondary text-light' href='$BASE$data_document[path]'>$data_document[nama_file]</a>";
                                }
                                ?>
                                </div>
                            </div>
                            <div class="custom-file item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="customFile">Pilih Dokumen<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                <input type="hidden" name="nama_file" value="<?=$data_document['nama_file'];?>">
                                <input type="hidden" name="tipe_file" value="<?=$data_document['tipe_file'];?>">
                                <input type="hidden" name="path_file" value="<?=$data_document['path'];?>">
                                <input autocomplete='off'  type="file" class="" name="dokumen">
                                <small class="text-danger">Ektensi Didperbolehkan : DOC,PDF,XLS,DOTX</small>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <button type="submit" class="btn btn-success" name="edit">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
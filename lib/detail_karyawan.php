<!-- page content -->
<div class="right_col" role="main">
    <div class="">
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
            <h2><b><?=$data['nama_karyawan'];?></b></h2>
            <div class="clearfix"></div>
            </div>
            <div class="x_content">
            <div class="col-md-3 col-sm-3  profile_left">
                <div class="profile_img">
                <div id="crop-avatar">
                    <!-- Current avatar -->
                    <img class="img-responsive avatar-view w-100" src="<?=$data['gambar'];?>" alt="<?=$data['nama_karyawan'];?>" title="<?=$data['nama_karyawan'];?>">
                </div>
                </div>
                <h3><b><?=$data['nama_karyawan'];?></b></h3>
            </div>
            <div class="col-md-9 col-sm-9">
                <ul class="list-unstyled detail-karyawan" style="font-size:20px">
                <li><b>NRP:</b><?=$data['nrp'];?></li>
                <li><b>SMKBK:</b> <?=$data['smbk'];?></li>
                <li><b>Mapping Competency:</b> <?=$data['mapping_competency'];?></li>
                <li><b>CLI:</b> <?=$data['cli'];?></li>
                <li><b>Pendidikan:</b> <?=$data['pendidikan'];?></li>
                <li><b>Sertifikat:</b> <?=$data['sertifikat'];?></li>
                <li><b>Perjalanan Karir:</b> <?=$data['perjalanan_karir'];?></li>
                <li><b>Punishment:</b> <?=$data['punishment'];?></li>
                <li><b>Jumlah:</b> <?=$data['jumlah'];?></li>
                </ul>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
<!-- /page content -->
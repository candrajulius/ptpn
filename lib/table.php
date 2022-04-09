<!-- page content -->

<div class="right_col" role="main">
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="dashboard_graph">

        <div class="row x_title">
          <div class="col-md-5">
            <h3>Data Karyawan</h3>
          </div>
          <div class="col-md-4">
            <form class="input-group" method="get">
              <input type="text" class="form-control" placeholder="Search..." name="search">
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
              </div>
            </form>
          </div>
          <div class="col-md-3 justify-content-end">
            <a class="btn btn-secondary" href=<?=$tambah_karyawan?>><i class="fa fa-plus"></i>Tambah Karyawan</a>
          </div>
        </div>

        <div class="col-12 ">

        <?php
        if($msg_type == "error") {
            echo"
            <div class='alert alert-danger w-100'>$msg_content</div>
            ";
        } else if($msg_type == "success") {
            echo"
            <script type='text/javascript'>
            alert('$msg_content');
            window.location.href = 'index.php';
            </script>
            ";
        }
        ?>


          <table class="table table-hover table-responsive table-bordered">
            <thead class="bg-secondary text-light text-truncate">
              <tr>
                <th scope="col">No</th>
                <th scope="col">NRP</th>
                <th scope="col">Nama Karyawan</th>
                <th scope="col">SMKBK</th>
                <th scope="col">Maping Competency</th>
                <th scope="col">CLI</th>
                <th scope="col">Pendidikan</th>
                <th scope="col">Sertifikat</th>
                <th scope="col">Perjalanan Karir</th>
                <th scope="col">Punishment</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Gambar</th>
                <th scope="col">tgl_ditambah</th>
                <th scope="col">Tgl_diupdate</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              if(isset($_GET['search'])){
                $query = "SELECT * FROM karyawan WHERE nrp like '%$_GET[search]%' or nama_karyawan like '%$_GET[search]%' ORDER BY nrp ";
              }else{
                $query = "SELECT * FROM karyawan ORDER BY nrp";
              }
              $limit = 10;
              $start = 0;
              if(isset($_GET['page'])){
                $start = $_GET['page'] - 0 * $limit;
              }
              $new_query = $query." LIMIT $start,$limit";
              $new_query = mysqli_query($connection,$new_query);
              $no = 1;
              if(mysqli_num_rows($new_query) == 0) {
                echo "
                <tr>
                  <td colspan='12' class='text-center'>
                    <img src='images/search_not_found.svg' width='150'>
                    <p>Data Apapun tidak ditemukan terkait dengan keyword <b>$_GET[search]</b></p>
                  </td>
                </tr>
                ";
              }
              while ($data = mysqli_fetch_assoc($new_query)) {
              ?>
              <tr>
                <th scope="row"><?=$no;?></th>
                <td><?=$data['nrp'];?></td>
                <td><?=$data['nama_karyawan'];?></td>
                <td><?=number_format($data['smbk']);?></td>
                <td><?=number_format($data['mapping_competency']);?></td>
                <td><?=number_format($data['cli']);?></td>
                <td><?=number_format($data['pendidikan']);?></td>
                <td><?=number_format($data['sertifikat']);?></td>
                <td><?=number_format($data['perjalanan_karir']);?></td>
                <td><?=number_format($data['punishment']);?></td>
                <td><?=number_format($data['jumlah']);?></td>
                <td><img src="<?=$data['gambar'];?>" width="50"></td>
                <td><?=$data['tgl_ditambah'];?></td>
                <td><?=$data['tgl_diupdate'];?></td>
                <td class="text-truncate">
                  <a href="<?=$edit_karyawan.$data['id'];?>" class="badge badge-info p-2">Edit</a>
                  <a href="#delete-<?=$no;?>" data-toggle="modal" data-target="#delete-<?=$no;?>" class="badge badge-danger p-2">Hapus</a>
                  <a href="<?=$detail_karyawan.$data['nrp'];?>" class="badge badge-success p-2">Detail</a>
                </td>
              </tr>
              <!-- Modal -->
              <div class="modal fade" id="delete-<?=$no;?>" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Hapus</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Anda Yakin Ingin Menghapus Data Karyawan <b><?=$data['nama_karyawan'];?></b> dengan NRP <b><?=$data['nrp'];?></b>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      <a href="?id=<?=$data['id'];?>" class="btn btn-primary">Ya! Hapus</a>
                    </div>
                  </div>
                </div>
              </div>
              <?php
              $no++;
              }
              ?>
            </tbody>
          </table>
          <nav aria-label="...">
            <ul class="pagination">
              <?php
            
                if(isset($_GET['search'])){
                    $halaman = $_SERVER['PHP_SELF']."?search=".$_GET['search']."&";
                } else {
                    $halaman = $_SERVER['PHP_SELF']."?";
                }
                $query = mysqli_query($connection,$query);
                $total_records = mysqli_num_rows($query);
                if ($total_records > 0) {
                    $total_pages = ceil($total_records / $limit);
                    $aktive_page = 1;
                    if (isset($_GET['page'])) {
                        $aktive_page = $_GET['page'];
                    }
                    if($aktive_page != 1){
                        $previous = $aktive_page - 1;
                        echo "<li class='page-item'>
                        <a href= '".$halaman."?page=$previous' class='page-link'>Sebelum</a>
                      </li>";
                    }
                    for($i = 1; $i < $total_pages; $i++){
                        if($i == $aktive_page){
                            echo "<li class='page-item active'>
                            <a class='page-link' href='".$halaman."page=$i'>$i</a>
                          </li>";
                        }else{
                            echo "<li class='page-item'>
                            <a class='page-link' href='".$halaman."page=$i'>$i</a>
                          </li>";
                        }
                    }
                    if($aktive_page != $total_pages){
                        $next = $aktive_page + 1;
                        echo "<li class='page-item'>
                        <a class='page-link' href='".$halaman."page=$next'>Selanjutnya</a>
                      </li>";
                    }
                }
              ?>
            </ul>
            </nav>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>

  </div>
</div>
<!-- /page content -->
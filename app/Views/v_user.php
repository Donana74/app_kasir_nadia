<div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?= $subjudul?></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#add-data"><i class="fas fa-plus"></i> Add Data
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php

                //  use Kint\Zval\Value;

                if (session()->getFlashdata('pesan')){
                  echo '<div class="alert alert-success alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                   <h5><i class="icon fas fa-check"></i>';
                   echo session()->getFlashdata('pesan');
                   echo '</h5></div>';

                 }
                ?>

              <?php $errors = session()->getFlashdata('errors');
                if(!empty($errors)) { ?>
                  <div class="alert alert-danger alert-dismissible">
                    <h4>Periksa lagi entry Form !!</h4>
                    <ul>
                      <?php foreach ($errors as $key => $error) { ?>
                      <li><?= esc($error)?></li>
                    <?php } ?>
                      </ul>
                    </div>
                    <?php } ?>


              <table class="table table-bordered">
                    <tr class="text-center">
                        <th width="50px">No</th>
                        <th>Kode User</th>
                        <th>Nama Pengguna</th>
                        <th>Email(Username)</th>
                        <th>Password</th>
                        <th width="150px">Level</th>
                        <th width="100px">Aksi</th>
                       
                    </tr>
                    <tbody>
                    <?php $no = 1 ;
                     foreach ($user as $key => $value){?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['kode_user'] ?></td>
                            <td><?= $value['nama_user'] ?></td>
                            <td><?= $value['email'] ?></td>
                            <td><?= $value['password'] ?></td>
                            <td class="text-center"><?php
                            if ($value['level'] == 1) { ?>
                            <span class="badge bg-success">Admin</span>
                          <?php } else { ?>
                            <span class="badge bg-primary">Kasir</span>
                          <?php } ?>
                            
                            <td>
                                 <button class="btn btn-warning btn-sm btn-flat" data-toggle="modal" data-target="#edit-data<?=$value['id_user']?>"><i class="fas fa-pencil-alt"></i></button>
                                 <button class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#delete-data<?=$value['id_user']?>"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                    </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          <!-- MODAL ADD DATA-->
          <div class="modal fade" id="add-data">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Data <?= $subjudul ?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php echo form_open('User/InsertData')?>
            <div class="modal-body">
              <div class="form-group">
              <label for="">Kode User</label>
                <input name="kode_user" id="kode" class="form-control"  placeholder="Masukan Kode Anda" required>
                <label for="">Nama Pengguna</label>
                <input name="nama_user" class="form-control" placeholder="Masukan Nama Anda" required>
                <label for="">Email(Username)</label>
                <input name="email" class="form-control" placeholder="Masukan Email" required>
                <label for="">Password</label>
                <input name="password" class="form-control" placeholder="Masukan Password" required>
                <label for="">Level</label>
                <select class="form-control" name="level">
                    <option value="1">Admin</option>
                    <option value="2">Kasir</option>
                 </select>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btn-flat">Save</button>
            </div>
            <?php echo form_close()?>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

        <!--  EDIT DATA-->
        <?php foreach ($user as $key => $value) { ?>
        
        <div class="modal fade" id="edit-data<?=$value['id_user']?>">
        <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Data <?= $subjudul ?></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php echo form_open('User/UpdateData/'. $value['id_user'])?>
          <div class="modal-body">
            <div class="form-group">
            <label for="">Kode User</label>
              <input name="kode_user" class="form-control"  value="<?=$value ['kode_user']?>" >
              <label for="">Nama User</label>
              <input name="nama_user"  class="form-control" value="<?=$value ['nama_user']?>" required>
              <label for="">Email</label>
              <input name="email"  class="form-control" value="<?=$value ['email']?>"  required>
              <label for="">Password</label>
              <input name="password" class="form-control" value="<?=$value ['password']?>" required>
              <label for="">Level</label>
              <select class="form-control" name="level">
                    <option value="1" <?= $value['level'] == 1 ? 'Selected' : ''?>>Admin</option>
                    <option value="2" <?= $value['level'] == 2 ? 'Selected' : ''?>>Kasir</option>
                 </select>
            </div>
        
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-warning btn-flat">Save</button>
          </div>
          <?php echo form_close()?>
        </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <?php } ?>


        <!--  DELETE DATA-->
        <?php foreach ($user as $key => $value) { ?>
        
        <div class="modal fade" id="delete-data<?=$value['id_user']?>">
        <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Delete Data <?= $subjudul ?></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php echo form_open('User/DeleteData/'. $value['id_user'])?>
          <div class="modal-body">
            <div class="form-group">
           
            Apakah Anda Yakin menghapus <b><?= $value['nama_user']?>..?</b>
            
            </div>
        
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
            <a href = " <?= base_url('User/DeleteData/'. $value['id_user']) ?>" class= "btn btn-danger btn-flat">Delete</a>
          </div>
          <?php echo form_close()?>
        </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <?php } ?>

<script>
 fetch('<?= base_url() ?>' + 'user/getKode')
    .then(response => {
      // Check if response is successful (status code 200-299)
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      // Parse the JSON from the response
      return response.json();
    })
    .then(data => {
      kode_user.value = data.kode;
    })
    .catch(error => {
      // Handle errors
      console.error('There was a problem with the fetch operation:', error);
  });

</script>
<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
         <div class="x_title">
            <h2><?php echo $this->menu; ?> |<small><?php echo $this->fitur; ?></small></h2>
            <div class="clearfix"></div>
         </div>
         <?php cetak_flash_msg(); ?>
         <?php if (!empty($alert['message'])) { ?>
         <div class="alert alert-<?php echo $alert['class']; ?> alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            <?php echo $alert['message']; ?>
         </div>
         <?php } ?>
         <?php if ($this->fitur != 'Lihat') { ?>
         <div class="alignleft" style="padding-left: 23%;">
            <!--                    <h4>Informasi</h4>
               <ul>
                   <li>Hak Akses tidak dapat dihapus.</li>
                   <li>Beberapa Hak Akses tidak dapat diubah.</li>
               </ul>-->
         </div>
         <?php } ?>
         <div class="x_content">
            <br />
            <form  method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
               <?php 
              
               if ($this->fitur == 'Pengajuan User') { ?>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Jabatan
                  <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <select class="form-control" name="user_jabatan" id="jabatan" >
                        
                        <?php
                           foreach ($jabatan as $jabatan) {
                           ?>
                        <option value="<?php echo $jabatan->id;?>"><?php echo ucfirst($jabatan->nama) ;?></option>
                        <?php
                           }
                           ?>
                      
                        <option value="otherjabatan" >Create New</option>
                     </select>
                  </div>
               </div>
               <div class="form-group" id="OtherJabatan" style="display:none;">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" >Jabatan Baru <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" name="user_jabatan" class="form-control col-md-7 col-xs-12" >
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Status
                  <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <select class="form-control" name="user_aktif">
                       
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                      
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Hak Akses
                  <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <select class="form-control" name="user_akses">
                        <?php
                           if ($this->fitur == 'Ubah') {
                           
                           foreach ($hak_akses as $ha1) {
                           echo "<option value='$ha1->akses_nama' ";
                               if ($this->fitur == "Ubah") {
                               echo $ha1->akses_nama == $user_detail->user_akses ? 'selected' : '';
                               }
                           echo">" . strtoupper($ha1->akses_nama) . "</option>";
                           }
                           ?>
                        <?php } else { ?>
                        <?php
                           foreach ($hak_akses as $ha) {
                           ?>
                        <option value="<?php echo $ha->akses_nama;?>"><?php echo strtoupper($ha->akses_nama) ;?></option>
                        <?php
                           }
                           ?>
                        <?php } ?>
                     </select>
                  </div>
               </div>

               <?php } else if ($this->fitur == 'Lihat') { ?>
               <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-12" >Personal Number
                  </label>
                  <div class="col-md-3 col-sm-6 col-xs-12">
                     <p>: <?php echo $user_detail->user_pn; ?>
                     <p>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-12" >Email
                  </label>
                  <div class="col-md-3 col-sm-6 col-xs-12">
                     <p>: <?php echo $user_detail->user_email; ?>
                     <p>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-12" >Nama
                  </label>
                  <div class="col-md-3 col-sm-6 col-xs-12">
                     <p>: <?php echo $user_detail->user_nama; ?>
                     <p>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-12" >Nomor HP
                  </label>
                  <div class="col-md-3 col-sm-6 col-xs-12">
                     <p>: <?php echo $user_detail->user_nohp; ?>
                     <p>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-12" >Jabatan
                  </label>
                  <div class="col-md-3 col-sm-6 col-xs-12">
                     <p>: <?php echo $user_detail->jab; ?>
                     <p>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-12" >Hak Akses
                  </label>
                  <div class="col-md-3 col-sm-6 col-xs-12">
                     <p>: <?php echo $user_detail->user_akses; ?>
                     <p>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-md-3 col-sm-3 col-xs-12" >Status
                  </label>
                  <div class="col-md-3 col-sm-6 col-xs-12">
                     <p>: <?php echo ($user_detail->user_aktif == 1) ? 'Aktif' : 'Tidak Aktif' ; ?>
                     <p>
                  </div>
               </div>
               <?php
                  } else {
                  ?>
               <?php if ($this->fitur == 'Ubah') { ?>
               <input type="hidden" name="user_id" value="<?php echo $user_detail->user_id; ?>">
               <?php } ?>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" >Personal Number <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" name="user_pn" required="required" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $user_detail->user_pn; ?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" >Email <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="email" name="user_email" required="required" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $user_detail->user_email; ?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" >Nama <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" name="user_nama" required="required" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $user_detail->user_nama; ?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" >Nomor HP <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" name="user_nohp" required="required" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $user_detail->user_nohp; ?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Jabatan
                  <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <select class="form-control" name="user_type" id="jabatan" >
                       <?php
                              if ($this->fitur == 'Ubah') {
                              
                                  foreach ($jabatan as $kategori) {
                                      echo "<option value='$kategori->id' ";
                                      if ($this->fitur == "Ubah") {
                                          echo $kategori->id == $user_detail->user_type ? 'selected' : '';
                                      }
                                      echo">" . ucfirst($kategori->nama) . "</option>";
                                  }
                                  ?>
                           <?php } else { ?>
                           <?php
                              foreach ($jabatan as $kategori) {
                                  ?>
                           <option value="<?php echo $kategori->id; ?>"><?php echo ucfirst($kategori->nama); ?></option>
                           <?php
                              }
                              ?>
                           <?php } ?>
                        <option value="otherjabatan" >Create New</option>
                     </select>
                  </div>
               </div>
               <div class="form-group" id="OtherJabatan" style="display:none;">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" >Jabatan Baru <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" name="user_jabatan2" class="form-control col-md-7 col-xs-12" >
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" >Password <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="password" name="password" placeholder="Password" required="required" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo decode($user_detail->password); ?>">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Status
                  <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <select class="form-control" name="user_aktif">
                        <?php
                           if ($this->fitur == 'Ubah') {
                           ?>
                        <?php if ($user_detail->user_aktif == "1") { ?>
                        <option value="1" selected>Aktif</option>
                        <option value="0">Tidak Aktif</option>
                        <?php } ?>
                        <?php if ($user_detail->user_aktif == "0") { ?>
                        <option value="0" selected>Tidak Aktif</option>
                        <option value="1">Aktif</option>
                        <?php } ?>
                        <?php } else { ?>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                        <?php } ?>
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Hak Akses
                  <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <select class="form-control" name="user_akses">
                        <?php
                           if ($this->fitur == 'Ubah') {
                           
                           foreach ($hak_akses as $ha1) {
                           echo "<option value='$ha1->akses_nama' ";
                               if ($this->fitur == "Ubah") {
                               echo $ha1->akses_nama == $user_detail->user_akses ? 'selected' : '';
                               }
                           echo">" . strtoupper($ha1->akses_nama) . "</option>";
                           }
                           ?>
                        <?php } else { ?>
                        <?php
                           foreach ($hak_akses as $ha) {
                           ?>
                        <option value="<?php echo $ha->akses_nama;?>"><?php echo strtoupper($ha->akses_nama) ;?></option>
                        <?php
                           }
                           ?>
                        <?php } ?>
                     </select>
                  </div>
               </div>
               <?php }
                  ?>
               <div class="ln_solid">
               </div>
               <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
                     <a class="btn btn-sm bg-blue" href="<?php echo base_url($this->cname); ?>"><i class="fa fa-arrow-left"></i> Kembali</a>
                     <?php if ($this->fitur == 'Lihat') { ?>
                     <a href="<?php echo base_url($this->cname . '/action/edit/' . $user_detail->user_id); ?>" class="btn btn-sm bg-orange"><i class="fa fa-edit"></i> Ubah</a>
                     <?php } ?>
                     <?php if ($this->fitur == 'Tambah' || $this->fitur == 'Ubah' ||  $this->fitur == 'Pengajuan User' ) { ?>
                     <button type="submit" class="btn btn-sm btn-primary <?php if ($this->fitur == 'Ubah') echo 'popconfirm-update'; ?>" data-toggle='confirmation'><i class="fa fa-save"></i> Simpan</button>
                     <?php } ?>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
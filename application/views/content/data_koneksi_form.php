

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

         <script type="text/javascript">
               function Tambah() {

                  $('#tes').append('<div class="form-group" id="koneksi" ><label class="control-label col-md-2 col-sm-2 col-xs-12" id="span" ><span></span></label><div class="col-md-2 col-sm-2 col-xs-6" id="Aplikasi_To"><input type="text" name="aplikasi_to[]" id="aplikasi_to[]" placeholder="Aplikasi" class="form-control col-md-7 col-xs-12" multiple /></div>'+
                    '<div class="col-md-2 col-sm-2 col-xs-6" id="Fitur_To"><input type="text" name="fitur_to[]" id="fitur_to[]" placeholder="Fitur" class="form-control col-md-7 col-xs-12" multiple /></div>'+
                    '<div class="col-md-2 col-sm-3 col-xs-6"><button type="button" class="btn btn-round btn-danger removewew" id="wew" name="wew" onclick="cewe(event)">x</button></div></div>');
               }

              function ip(){
                $('#tambahip').append('<div class="col-md-2 col-sm-2 col-xs-6" id="IP_To"><input type="text" name="ip_to[]" id="ip_to[]" placeholder="IP xxx.xxx.xxx.xxx" class="form-control col-md-7 col-xs-12" multiple /></div>');
               }

              function cewe(aa){
                $(aa.target).closest('div [id="koneksi"]').remove();
              }

               </script>

         <div class="x_content">
            <br />
            <form  method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
               <?php 
              
               if ($this->fitur == 'Add') { ?>
               <div class="form-group">
                  <label class="control-label col-md-2 col-sm-2 col-xs-12">Aplikasi
                  <span class="required">*</span>
                  </label>
                  <div class="col-md-8 col-sm-8 col-xs-12">
                     <input type="text" name="aplikasi_from" class="form-control col-md-7 col-xs-12" >
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-2 col-sm-2 col-xs-12">Fitur
                  <span class="required">*</span>
                  </label>
                  <div class="col-md-8 col-sm-8 col-xs-12">
                     <input type="text" name="fitur_from" class="form-control col-md-7 col-xs-12" >
                  </div>
               </div>
               <div class="form-group" id="baru">
                  <label class="control-label col-md-2 col-sm-2 col-xs-12">IP
                  <span class="required">*</span>
                  </label>
                  <div class="col-md-8 col-sm-8 col-xs-12">
                     <input type="text" name="ip_from" class="form-control col-md-7 col-xs-12" >
                  </div>
               </div>
               <div class="form-group" id="baru">
                  <label class="control-label col-md-2 col-sm-2 col-xs-12">Deskripsi
                  <span>*</span>
                  </label>
                  <div class="col-md-8 col-sm-8 col-xs-12">
                     <input type="text" name="deskripsi" class="form-control col-md-7 col-xs-12" >
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-2 col-sm-2 col-xs-12"> Jenis Fitur
                  <span class="required">*</span>
                  </label>
                  <div class="col-md-8 col-sm-8 col-xs-12">
                     <select class="form-control" name="jenis_fitur_from" id="FiturFrom">
                        <option value="Database">Database</option>
                        <option value="Web Service">Web Service</option>
                        <option value="Web">Web</option>
                        <option value="Scheduller">Scheduller</option>
                     </select>
                  </div>
               </div>
               
               <div id="tes" name="tes">
               <div class="form-group" id="koneksi" style="display:none;">

                  <label class="control-label col-md-2 col-sm-2 col-xs-12" id="span" >Koneksi Ke : <span>*</span></label>
                  
                  <div class="col-md-2 col-sm-2 col-xs-6" id="Aplikasi_To">
                     <input type="text" name="aplikasi_to[]" id="aplikasi_to[]" placeholder="Aplikasi" class="form-control col-md-7 col-xs-12" multiple />
                  </div>
                  <div class="col-md-2 col-sm-2 col-xs-6" id="Fitur_To">
                     <input type="text" name="fitur_to[]" id="fitur_to[]" placeholder="Fitur" class="form-control col-md-7 col-xs-12" multiple />
                  </div>
                  <div class="col-md-2 col-sm-2 col-xs-6" id="IP_To">
                     <input type="text" name="ip_to[]" id="ip_to[]" placeholder="IP xxx.xxx.xxx.xxx" class="form-control col-md-7 col-xs-12" multiple />
                  </div>
                  <div class="col-md-2 col-sm-3 col-xs-6">
                     <button type="button" class="btn btn-round btn-primary" id="tambah" onclick="Tambah()">+</button>
                  </div>
                  
               </div>
               </div>
               <?php } elseif($this->fitur =='Lihat'){
                     
                  ?>

                           <div class="form-group">
                                <label class="col-md-2 col-sm-2 col-xs-12" >Nama Aplikasi
                                </label>
                                <div class="col-md-4 col-sm-10 col-xs-12">
                                    <p>: <?php echo $data_fitur->nama_app; ?><p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 col-xs-12" >Deskripsi Apps
                                </label>
                                <div class="col-md-4 col-sm-10 col-xs-12">
                                    <p>: <?php echo $data_fitur->des_app; ?><p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 col-xs-12" >Nama Fitur
                                </label>
                                <div class="col-md-4 col-sm-10 col-xs-12">
                                    <p>: <?php echo $data_fitur->nama_fitur; ?><p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 col-xs-12" >Tipe Fitur
                                </label>
                                <div class="col-md-4 col-sm-10 col-xs-12">
                                    <p>: <?php echo $data_fitur->tipe_fitur; ?><p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 col-xs-12" >IP Fitur
                                </label>
                                <div class="col-md-4 col-sm-10 col-xs-12">
                                    <p>: <?php echo $data_fitur->ip_fitur; ?><p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 col-xs-12" >Pengembang
                                </label>
                                <div class="col-md-4 col-sm-10 col-xs-12">
                                    <p>: <?php echo $data_fitur->pengembang; ?><p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 col-xs-12" >Programmer
                                </label>
                                <div class="col-md-4 col-sm-10 col-xs-12">
                                    <p>: <?php echo $data_fitur->programmer; ?><p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 col-xs-12" >Platform
                                </label>
                                <div class="col-md-4 col-sm-10 col-xs-12">
                                    <p>: <?php echo $data_fitur->platform; ?><p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 col-xs-12" >Tanggal Input
                                </label>
                                <div class="col-md-4 col-sm-10 col-xs-12">
                                    <p>: <?php echo $data_fitur->tgl_input; ?><p>
                                </div>
                            </div>
                            <div class="form-group">
                                </br>
                                </br>
                                <label class="col-md-2 col-sm-2 col-xs-12" >List Connection
                                </label></h2>
                                <table id="" class="table table-striped table-bordered">
                                    <thead>
                                        <tr style="background-color: grey; color:white;">
                                            <th>No</th>
                                            <th>Aplikasi</th>
                                            <th>Fitur</th>
                                            <th>Jenis Fitur</th>
                                            <th>IP</th>
                                            <th>Recent Date</th>
                                            <th width="180px">Action</th>
                                        </tr>
                                        <?php $no=1; foreach ($data_koneksi as $row) { ?>
                                        <tr>
                                            <th><?php echo $no++; ?></th>
                                            <th><?php echo $row->konekTo_app;?></th>
                                            <th><?php echo $row->konekTo_fitur;?></th>
                                            <th><?php echo $row->konekTo_tipe_fitur;?></th>
                                            <th><?php echo $row->konekTo_ip_fitur;?></th>
                                            <th><?php echo $row->tgl_input;?></th>
                                        <?php if (($this->active_privilege == "superadmin" )||($this->active_privilege == "signer" )||($this->active_privilege == "checker" )){ ?>
                                          <th>
                                              <a title='Edit' href='<?php echo base_url().'data_koneksi/action/edit_koneksi/'.$row->id_koneksi;?>' class='btn btn-circle btn-sm bg-orange'>
                                                  <i class='fa fa-edit'></i>
                                              </a>
                                              <a title='Delete' data-href='<?php echo base_url().'data_koneksi/action/delete_koneksi/'.$row->id_koneksi; ?>' class='btn btn-circle btn-sm bg-red' data-toggle='modal' data-target='.delete-modal'>
                                                <i class='fa fa-trash'></i>
                                              </a>
                                        </th>
                                        <?php }
                                          else { ?>
                                          <th></th>
                                        <?php }?>
                                        </tr>
                                        <?php }
                                        ?>
                                        </thead>
                                </table>
                            </div>

               <?php 
               } elseif($this->fitur == "Tambah Koneksi"){ ?>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-2 col-xs-12">Nama Aplikasi
                  <span class="required"></span>
                  </label>
                  <div class="col-md-4 col-sm-8 col-xs-12">
                     <input type="text" name="aplikasi_from" class="form-control col-md-7 col-xs-12" value = "<?php echo $data_fitur->nama_app; ?>" readonly >
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-2 col-xs-12">Nama Fitur
                  <span class="required"></span>
                  </label>
                  <div class="col-md-4 col-sm-8 col-xs-12">
                     <input type="text" name="fitur_from" class="form-control col-md-7 col-xs-12" value = "<?php echo $data_fitur->nama_fitur; ?>" readonly  >
                  </div>
               </div>
               <div class="form-group" id="baru">
                  <label class="control-label col-md-3 col-sm-2 col-xs-12">Alamat IP
                  <span class="required"></span>
                  </label>
                  <div class="col-md-4 col-sm-8 col-xs-12">
                     <input type="text" name="ip_from" class="form-control col-md-7 col-xs-12" value = "<?php echo $data_fitur->ip_fitur; ?>" readonly >
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-2 col-xs-12"> Tipe Fitur
                  <span class="required"></span>
                  </label>
                  <div class="col-md-4 col-sm-8 col-xs-12">
                     <input type="text" name="jenis_fitur_from" class="form-control col-md-7 col-xs-12" value = "<?php echo $data_fitur->tipe_fitur; ?>" readonly >
                  </div>
               </div>
               <div  id="div-newx">
                  <div class="form-group">
                    <!-- <input type="hidden" name="hidden" id="hidden" value="1"> -->
                    <input type="hidden" name="angka" id="angka" value="1">
                    <div id="koneksi_app">
                          
                    </div>


                  </div>
                </div>

               <!-- <div id="tes" name="tes">
                  <div class="form-group" id="koneksi" style="">

                     <label class="control-label col-md-2 col-sm-2 col-xs-12" id="span" >Koneksi Ke : <span>*</span></label>
                     
                     <div class="col-md-4 col-sm-2 col-xs-6" id="Aplikasi_To">
                        <input type="text" name="aplikasi_to[]" id="aplikasi_to[]" placeholder="Aplikasi" class="form-control col-md-7 col-xs-12" multiple />
                     </div>
                     <div class="col-md-4 col-sm-2 col-xs-6" id="Fitur_To">
                        <input type="text" name="fitur_to[]" id="fitur_to[]" placeholder="Fitur" class="form-control col-md-7 col-xs-12" multiple />
                     </div>
                     <div class="col-md-2 col-sm-2 col-xs-6" id="IP_To">
                        <input type="text" name="ip_to[]" id="ip_to[]" placeholder="IP xxx.xxx.xxx.xxx" class="form-control col-md-7 col-xs-12" multiple />
                     </div>
                     <div class="col-md-2 col-sm-3 col-xs-6">
                        <button type="button" class="btn btn-round btn-primary" id="tambah" onclick="Tambah()">+</button>
                     </div>
                     
                  </div>
               </div> -->

               <?php } elseif($this->fitur == "Edit Koneksi"){ ?>
               
               <div class="form-group">
                <h4 class="control-label col-md-5 col-sm-2 col-xs-12">DATA SEBELUMNYA</h4>  
               </div>
               

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-2 col-xs-12">Konek ke Aplikasi
                    <span class="required"></span>
                    </label>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                       <input type="text" class="form-control col-md-7 col-xs-12" value = "<?php echo $data_koneksi->konekTo_app; ?>" readonly>
                    </div>
                 </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-2 col-xs-12">Konek ke Fitur
                    <span class="required"></span>
                    </label>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                       <input type="text" class="form-control col-md-7 col-xs-12" value = "<?php echo $data_koneksi->konekTo_fitur; ?>" readonly>
                    </div>
                 </div>

                 <div class="form-group" id="baru">
                    <label class="control-label col-md-3 col-sm-2 col-xs-12">Alamat IP
                    <span class="required"></span>
                    </label>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                       <input type="text" class="form-control col-md-7 col-xs-12" value = "<?php echo $data_koneksi->konekTo_ip_fitur; ?>" readonly>
                    </div>
                 </div>

                 <div class="form-group">
                    <label class="control-label col-md-3 col-sm-2 col-xs-12"> Jenis Fitur
                    <span class="required"></span>
                    </label>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                       <input type="text" class="form-control col-md-7 col-xs-12" value = "<?php echo $data_koneksi->konekTo_tipe_fitur; ?>" readonly>
                    </div>
                 </div>
                 <hr>
                 <div class="form-group">
                  <div id="edit_koneksi_app">
                    
                  </div>
               </div>

              <?php }?>
               <div class="ln_solid">
               </div>
               <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                     <a class="btn btn-sm bg-blue" href="<?php echo base_url($this->cname); ?>"><i class="fa fa-arrow-left"></i> Kembali</a>
                     
                     <?php if ($this->fitur == 'Add' || $this->fitur =="Tambah Koneksi"|| $this->fitur == 'Ubah' ||  $this->fitur == 'Edit Koneksi') { ?>
                     <button type="submit" class="btn btn-sm btn-primary <?php if ($this->fitur == 'Ubah') echo 'popconfirm-update'; ?>" data-toggle='confirmation'><i class="fa fa-save"></i> Simpan</button>
                     <?php } ?>
                  </div>
               </div>
            </form>
         </div>


         
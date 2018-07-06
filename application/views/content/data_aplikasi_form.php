<script type="text/javascript">

function yesnoCheck(box) {
    if (document.getElementById('yesCheck').checked) {
        document.getElementById('ifYes').style.display = 'block';
    }
    else document.getElementById('ifYes').style.display = 'none';

}




</script>
<div class="row">
<div class="col-md-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo $this->aktif; ?><small><?php echo $this->fitur; ?></small></h2>
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
                                        </ul>
                                    -->
                </div>



            <?php } ?>
            <div class="x_content">
                <br />

                <form  method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                    <?php if ($this->fitur == 'Lihat') { ?>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-3 col-xs-12" >Nama Aplikasi
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input type="text" class="form-control col-md-4 col-xs-6" value="<?php echo $app_detail->nama_app; ?>" readonly> 
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-3 col-xs-12">Deskripsi Aplikasi
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <textarea class="form-control col-md-9 col-xs-6" rows="6" cols="50" readonly> <?php echo $app_detail->des_app; ?>
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-3 col-xs-12" >Jenis Aplikasi
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input type="text" class="form-control col-md-4 col-xs-6" value="<?php echo $app_detail->jenis_app; ?>" readonly> 
                            </div>
                        </div>
                    
                </div>
                </div>
                
                <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                <div class="x_title">
                    <h2><small><?php echo 'File Dokumen' ?></small></h2>
                    <div class="clearfix"></div>
                    </div>
                    <div>
                        <div class="btn-group">
                            <a href="<?php echo base_url('data_fitur/add/'.$app_detail->id_app)?>" class="btn btn-small sbold bg-green" >
                                <i class="fa fa-plus"></i> Data Fitur Baru
                            </a>
                        </div>
                               
                        <div>
                            <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="10px">No</th>
                                    <th width="150px">Nama Fitur</th>
                                    <th width="100px">Deskripsi Fitur</th>
                                    <th width="100px">Tipe Fitur</th>
                                    <th width="100px">Bagian Pengembang</th>
                                    <th>Programmer</th>
                                    <th>Tanggal Input</th>
                                    <th>Detail Version</th>
                                    <th width="120">Action</th>
                                    
                                </tr>
                            </thead>

                            <tbody>
                            <?php 
                            $i=1;
                            foreach( $fitur_detail as $row){?>
                                <tr>
                                    <td>
                                        <?php echo $i; ?>
                                    </td>
                                    <td>
                                        <?php echo $row->nama_fitur; ?>
                                    </td>

                                    <td>
                                        <?php echo $row->des_fitur; ?>
                                    </td>

                                    <td>
                                        <?php echo $row->tipe_fitur; ?>
                                    </td>

                                    <td>
                                        <?php echo $row->pengembang; ?>
                                    </td>

                                    <td>
                                        <?php echo $row->programmer; ?>
                                    </td>

                                    <td>
                                        <?php echo $row->tgl_input; ?>
                                    </td>

                                    <td>
                                        <a title='Lihat' href="<?php echo base_url().'data_fitur/action/view/'.$row->id_fitur; ?>" class='btn btn-circle btn-sm sbold bg-blue'> <i class='fa fa-folder'>  Lihat Detail</i>
                                        </a>

                                    </td>
                                    <?php if (($this->active_privilege == "superadmin" )||($this->active_privilege == "signer" )||($this->active_privilege == "checker" )){ ?>
                                    <td>
                                        <a title='Edit' href="<?php echo base_url().'data_fitur/action/edit/'.$row->id_fitur; ?>" class='btn btn-circle btn-sm bg-orange'>
                                            <i class='fa fa-edit'></i>
                                        </a> 
                                        <a title='Delete' data-href="<?php echo base_url().'data_fitur/action/delete/'.$row->id_fitur;?>" class='btn btn-circle btn-sm bg-red' data-toggle="modal" data-target=".delete-modal">
                                            <i class='fa fa-trash'></i>
                                        </a>
                                    </td>
                                    <?php }
                                    else { ?>
                                    <td></td>
                                    <?php }?>

                                </tr>
                                <?php 
                                $i++;
                                } ?>
                            </tbody>
                            </table>
                        </div>
                        
                        <?php
                    } 

                    else 
                    {
                        ?>
                        <?php if ($this->fitur == 'Ubah') { ?>
                            <input type="hidden" name="id_app" value="<?php echo $app_detail->id_app; ?>">
                        <?php } ?>

                        <!-- tambah data -->
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Nama Aplikasi <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input  type="text" name="nama_app" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $app_detail->nama_app; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Deskripsi Aplikasi <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-9 col-xs-12">
                             <textarea id="des_app" type="text" name="des_app" class="form-control col-md-7 col-xs-12"><?php if ($this->fitur == 'Ubah') echo $app_detail->des_app; ?></textarea>
                            </div>    
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-3 col-xs-12" >jenis Aplikasi <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-9 col-xs-12">
                              <select class="form-control" type="text" name="jenis_app" required="required" id="jenis_app" class="form-control col-md-7 col-xs-12">
                                  <option></option>
                                  <option value="Critical">Critical</option>
                                  <option value="High">High</option>
                                  <option value="Medium">Medium</option>
                                  <option value="Low">Low</option>
                              </select>
                          </div>
                        </div>

                        
                    <?php }
                    ?>

                                          
 

                    <div class="ln_solid">

                    </div>
                    <div class="form-group">

                        

                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" align="center">
                            <a class="btn btn-sm bg-blue" href="<?php echo base_url().'data_aplikasi/'?>" > <i class="fa fa-arrow-left"></i> Kembali</a>
                            <!-- <?php if ($this->fitur == 'Lihat') { ?>
                                
                            <?php } ?> -->
                            <?php if ($this->fitur == 'Tambah' || $this->fitur == 'Ubah') { ?>
                                <button type="submit" class="btn btn-sm btn-primary <?php if ($this->fitur == 'Ubah') echo 'popconfirm-update'; ?>" data-toggle='confirmation'><i class="fa fa-save"></i> Simpan</button>
                            <?php } ?>

                        </div>
                    </div>

                    
                </form>
            </div>

        </div>
    </div>
</div>


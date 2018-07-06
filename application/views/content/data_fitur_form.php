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


                <h2><?php echo $this->aktif; ?> | <small><?php echo $this->fitur; ?></small></h2>
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
            <div class="x_content" >
            

                <br />

                <form  method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                    <?php if ($this->fitur == 'Lihat') { ?>
                        <table style="width: 100%">
                        <tr>
                        <td>
                        <div class="x_panel">
                        <h2><small><?php echo 'Data Fitur' ?></small></h2>
                        <HR WIDTH=100% size=3>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Nama Fitur
                            </label>
                            <div class="col-md-6 col-sm-4 col-xs-12">
                                <input type="text" class="form-control col-md-6 col-xs-12" value="<?php echo $fitur_detail->nama_fitur; ?>" readonly> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12">Deskripsi Fitur
                            </label>
                            <div class="col-md-6 col-sm-4 col-xs-12">
                                <textarea class="form-control col-md-6 col-xs-12" readonly> <?php echo $fitur_detail->des_fitur; ?>
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Tipe Fitur
                            </label>
                            <div class="col-md-6 col-sm-4 col-xs-12">
                                <input type="text" class="form-control col-md-6 col-xs-12" value="<?php echo $fitur_detail->tipe_fitur; ?>" readonly> 
                            </div>
                        </div>

                         <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Bagian Pengembang
                            </label>
                            <div class="col-md-6 col-sm-4 col-xs-6">
                                <input type="text" class="form-control col-md-4 col-xs-6" value="<?php echo $fitur_detail->pengembang; ?>" readonly> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Programmer
                            </label>
                            <div class="col-md-6 col-sm-4 col-xs-6">
                                <input type="text" class="form-control col-md-4 col-xs-6" value="<?php echo $fitur_detail->programmer; ?>" readonly> 
                            </div>
                        </div>
                          
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Platform
                            </label>
                            <div class="col-md-6 col-sm-4 col-xs-6">
                                <input type="text" class="form-control col-md-4 col-xs-6" value="<?php echo $fitur_detail->platform; ?>" readonly> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Tanggal Input
                            </label>
                            <div class="col-md-6 col-sm-4 col-xs-6">
                                <input type="text" class="form-control col-md-4 col-xs-6" value="<?php echo $fitur_detail->tgl_input; ?>" readonly> 
                            </div>
                        </div>

                        
<!-- 
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >projek Dokumen
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <p>:  <a title='Dokumen' href="<?php echo $fitur_detail->dok_projek?>" class='btn btn-circle btn-sm sbold bg-blue' target="_blank">
                                    <i class='fa fa-file'> Lihat Dokumen</i>
                                </a><p>
                            </div>
                        </div> -->
                </div>
                </div>
                </div>
                </td>
                <td>

                <div class="clearfix"></div>
                <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                <div class="x_title">
                    <h2><small><?php echo 'File Dokumen' ?></small></h2>
                    <div class="clearfix"></div>
                    </div>
                        
                        <div>
                            <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="10px">No</th>
                                    <th>Versi</th>
                                    <th>Tanggal Input</th>
                                    <th>File dokumen</th>
                                    <th width="120">Action</th>
                                    
                                </tr>
                            </thead>

                            <tbody>
                            <?php 
                            $i=1;
                            foreach( $dokumen_detail as $row){?>
                                <tr>
                                    <td>
                                        <?php echo $i; ?>
                                    </td>
                                    <td>
                                        <?php echo $row->versi_a. "." . $row->versi_b .".". $row->versi_c; ?>
                                    </td>

                                    <td>
                                        <?php echo $row->tgl_input; ?>
                                    </td>

                                    <td>
                                        <a title='Dokumen' href="<?php echo $row->dok_app; ?>" class='btn btn-circle btn-sm sbold bg-blue' target='_blank'> <i class='fa fa-folder'>  Source Code</i></a>

                                        <a title='Dokumen' href="<?php echo $row->dok_how; ?>" class='btn btn-circle btn-sm sbold bg-blue' target='_blank'> <i class='fa fa-folder'>  How To</i></a>
                                    </td>

                                    <?php if (($this->active_privilege == "superadmin" )||($this->active_privilege == "signer" )||($this->active_privilege == "checker" )){ ?>
                                    <td>
                                        <a title='Edit' href="<?php echo base_url().'data_dok/action/edit/'.$row->id_doc; ?>" class='btn btn-circle btn-sm bg-orange'>
                                            <i class='fa fa-edit'></i>
                                        </a> 
                                        <a title='Delete' data-href="<?php echo base_url().'data_dok/action/delete/'.$row->id_doc;?>" class='btn btn-circle btn-sm bg-red' data-toggle="modal" data-target=".delete-modal">
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
                
                </td>
                </tr>
                </table>
                <br>
                
                        
                        <?php
                    }  

                    else 
                    {
                        ?>
                        <div class="col-md-12 col-xs-12">
                        <?php if ($this->fitur == 'Ubah') { ?>
                            <input type="hidden" name="id_fitur" value="<?php echo $fitur_detail->id_fitur; ?>">
                            <input type="hidden" name="id_app" value="<?php echo $fitur_detail->id_app; ?>">
                        <?php } ?>

                        <div class="col-md-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">

                        <!-- tambah data -->
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Nama Fitur <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input  type="text" name="nama_fitur" required="required" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $fitur_detail->nama_fitur; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Deskripsi Fitur <span>*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input  type="text" name="des_fitur" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $fitur_detail->des_fitur; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Tipe Fitur </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" type="text" name="tipe_fitur" id="tipe_fitur" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $fitur_detail->tipe_fitur; ?>">
                                    <option></option>
                                    <option value="Database">Database</option>
                                    <option value="Web">Web</option>
                                    <option value="Web Service">Web Service</option>
                                    <option value="Scheduler">Scheduler</option>
                                    <option value="Lain-lain">Lain-lain</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Bagian Pengembang </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="pengembang" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $fitur_detail->pengembang; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Programmer </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="programmer" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $fitur_detail->programmer; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >platform </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" type="text" name="platform" id="platform" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $fitur_detail->platform; ?>">
                                    <option></option>
                                    <option value="Enginex">Nginx</option>
                                    <option value="Tomcat">Tomcat</option>
                                    <option value="Apache">Apache</option>
                                    <option value="Iis">Iis</option>
                                </select>
                            </div>
                        </div>

                    <?php }
                    ?>

                                          
 

                    <div class="ln_solid">

                    </div>
                    <div class="form-group">

                        

                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" align="center">
                            <a class="btn btn-sm bg-blue" href="#" onclick="history.go(-1)";> <i class="fa fa-arrow-left"></i> Kembali</a>
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


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
                    <table style="width: 100%">
                    <tr>
                    <td>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Nama Aplikasi
                            </label>
                            <div class="col-md-7 col-sm-4 col-xs-12">
                                <input type="text" class="form-control col-md-4 col-xs-6" value="<?php echo $konf_detail->nama_app; ?>" readonly> 
                            </div>
                        </div>

                        

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12">Deskripsi Aplikasi
                            </label>
                            <div class="col-md-7 col-sm-4 col-xs-12">
                                <textarea class="form-control col-md-9 col-xs-6" readonly> <?php echo $konf_detail->des_app; ?>
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Jenis Aplikasi
                            </label>
                            <div class="col-md-7 col-sm-4 col-xs-12">
                                <input type="text" class="form-control col-md-4 col-xs-6" value="<?php echo $konf_detail->jenis_app; ?>" readonly> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Nama Fitur
                            </label>
                            <div class="col-md-7 col-sm-4 col-xs-12">
                                <input type="text" class="form-control col-md-4 col-xs-6" value="<?php echo $konf_detail->nama_fitur; ?>" readonly> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12">Deskripsi Fitur
                            </label>
                            <div class="col-md-7 col-sm-4 col-xs-12">
                                <textarea class="form-control col-md-9 col-xs-6" readonly> <?php echo $konf_detail->des_fitur; ?>
                                </textarea>
                            </div>
                        </div>
                        
                        </td>
                        <td>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Tipe Fitur
                            </label>
                            <div class="col-md-7 col-sm-4 col-xs-12">
                                <input type="text" class="form-control col-md-4 col-xs-6" value="<?php echo $konf_detail->tipe_fitur; ?>" readonly> 
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Platform
                            </label>
                            <div class="col-md-7 col-sm-4 col-xs-12">
                                <input type="text" class="form-control col-md-4 col-xs-6" value="<?php echo $konf_detail->platform; ?>" readonly> 
                            </div>
                        </div>
<!-- 
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Alamat IP 
                            </label>
                            <div class="col-md-7 col-sm-4 col-xs-12">
                                <input type="text" class="form-control col-md-4 col-xs-6" value="<?php echo $konf_detail->ip_fitur; ?>" readonly> 
                            </div>
                        </div> -->

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Bagian Pengembang
                            </label>
                            <div class="col-md-7 col-sm-4 col-xs-12">
                                <input type="text" class="form-control col-md-4 col-xs-6" value="<?php echo $konf_detail->pengembang; ?>" readonly> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Programmer
                            </label>
                            <div class="col-md-7 col-sm-4 col-xs-12">
                                <input type="text" class="form-control col-md-4 col-xs-6" value="<?php echo $konf_detail->programmer; ?>" readonly> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Tanggal Input
                            </label>
                            <div class="col-md-7 col-sm-4 col-xs-12">
                                <input type="text" class="form-control col-md-4 col-xs-6" value="<?php echo $konf_detail->tgl_input; ?>" readonly> 
                            </div>
                        </div>
                    </td>
                    </tr>
                    </table>
                    </div>
                    </div>
                
                
                        
                        <?php
                    } 

                    elseif ($this->fitur == 'Cek') { ?>
                            <input type="hidden" name="id_fitur" value="<?php echo $konf_detail->id_fitur; ?>">
                            <input type="hidden" name="id_doc" value="<?php echo $konf_detail->id_doc; ?>">
                        
                        <!-- tambah data -->
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Nama Aplikasi <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-4 col-xs-12">
                                <input type="text" name="nama_app" class="form-control col-md-4 col-xs-6" required="required" value="<?php echo $konf_detail->nama_app; ?>"> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12">Deskripsi Aplikasi <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-4 col-xs-12">
                                <textarea class="form-control col-md-9 col-xs-6" name="des_app" required="required"> <?php echo $konf_detail->des_app; ?>
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Jenis Aplikasi <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-4 col-xs-12">
                                <input type="text" name="jenis_app" class="form-control col-md-4 col-xs-6" required="required" value="<?php echo $konf_detail->jenis_app; ?>"> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Nama Fitur <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-4 col-xs-12">
                                <input type="text" name="nama_fitur" class="form-control col-md-4 col-xs-6" required="required" value="<?php echo $konf_detail->nama_fitur; ?>" > 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12">Deskripsi Fitur <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-4 col-xs-12">
                                <textarea class="form-control col-md-9 col-xs-6" name="des_fitur" required="required"> <?php echo $konf_detail->des_fitur; ?>
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Tipe Fitur <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-4 col-xs-12">
                                <input type="text" name="tipe_fitur" class="form-control col-md-4 col-xs-6" required="required" value="<?php echo $konf_detail->tipe_fitur; ?>" > 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Platform <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-4 col-xs-12">
                                <input type="text" name="platform" class="form-control col-md-4 col-xs-6" required="required" value="<?php echo $konf_detail->platform; ?>" > 
                            </div>
                        </div>
<!-- 
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Alamat IP <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-4 col-xs-12">
                                <input type="text" name="ip_fitur" class="form-control col-md-4 col-xs-6" required="required" value="0.0.0.0" > 
                            </div>
                        </div> -->

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Bagian Pengembang <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-4 col-xs-12">
                                <input type="text" name="pengembang" class="form-control col-md-4 col-xs-6" required="required" value="<?php echo $konf_detail->pengembang; ?>" > 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Programmer <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-4 col-xs-12">
                                <input type="text" name="programmer" class="form-control col-md-4 col-xs-6" required="required" value="<?php echo $konf_detail->programmer; ?>" > 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Konfirmasi Pengajuan <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" type="text" name="status" required="required" id="status" class="form-control col-md-7 col-xs-12">
                                    <option></option>
                                    <option value="dikonfirmasi">Terima Pengajuan</option>
                                    <option value="ditolak">Tolak Pengajuan</option>
                                </select>
                            </div>
                        </div>
                    <?php } ?>

                                                          
 

                    <div class="ln_solid">

                    </div>
                    <div class="form-group">

                        

                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" align="center">
                            <a class="btn btn-sm bg-blue" href="<?php echo base_url().'konfirmasi/'?>";> <i class="fa fa-arrow-left"></i> Kembali</a>
                            <!-- <?php if ($this->fitur == 'Lihat') { ?>
                                
                            <?php } ?> -->
                            <?php if ($this->fitur == 'Tambah' || $this->fitur == 'Ubah' || $this->fitur == 'Tambah1' || $this->fitur == 'Tambah2' || $this->fitur == 'Tambah3') { ?>
                                <button type="submit" class="btn btn-sm btn-primary <?php if ($this->fitur == 'Ubah') echo 'popconfirm-update'; ?>" data-toggle='confirmation'><i class="fa fa-save"></i> Simpan</button>
                            <?php } 

                            elseif ($this->fitur == 'Cek'){
                                ?>
                             <button type="submit" class="btn btn-sm btn-primary <?php if ($this->fitur == 'Cek') echo 'popconfirm-konfirm'; ?>" data-toggle='confirmation'><i class="fa fa-check"></i> Konfirmasi</button>
                             <?php } ?>

                        </div>
                    </div>

                    
                </form>
            </div>

        </div>
    </div>
</div>


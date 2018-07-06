<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo $this->menu; ?><small> |<?php echo $this->fitur; ?></small></h2>
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
                     <?php if ($this->fitur == 'Update Setting') { ?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Waktu Reminder
                            </label>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <input type="text" name="sv_value" required="required" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Update Setting') echo $sv_detail->sv_value; ?>" placeholder="dalam bulan...">
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                               Bulan
                            </div>
                        </div>

                    <?php 
                    
                    } else {

                        ?>

                      
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >SPK Nomor<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="spk_nmr" required="required" class="form-control col-md-7 col-xs-12" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Nama Projek <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="nama_projek" id="namaprojek" required="required" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Perpanjang') echo $vendor_detail->nama_projek; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Nama Vendor <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="vendor_nama" id="namavendor" equired="required" class="form-control col-md-7 col-xs-12" >
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Nilai Kontrak
                            </label>
                             <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="nilai_kontrak" required="required" class="form-control col-md-7 col-xs-12" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Tanggal Kontrak <span class="required">*</span>
                            </label>
                            <?php 
                            if($this->fitur == 'Ubah'){
                            $newdate1 = date("m/d/Y", strtotime($vendor_detail->vendor_begindate));
                            $newdate2 = date("m/d/Y", strtotime($vendor_detail->vendor_enddate));
                        }
                            
                            ?>
                          
                               <div class="control-group">
                                                    <div class="controls">
                                                        <div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">
                                                            <input type="text" name="vendor_begindate" class="form-control has-feedback-left" id="single_cal1" placeholder="Tanggal Kontrak" value="<?php if ($this->fitur == 'Ubah') echo $newdate1; ?>">
                                                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                            
                                                        </div>
                                                    </div>
                                 </div>
                            
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Tanggal Berakhir <span class="required">*</span>
                            </label>
                          
                               <div class="control-group">
                                                    <div class="controls">
                                                        <div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">
                                                            <input type="text" name="vendor_enddate" class="form-control has-feedback-left" id="single_cal2" placeholder="Tanggal Berakhir" value="<?php if ($this->fitur == 'Ubah') echo $newdate2; ?>">
                                                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                       
                                                        </div>
                                                    </div>
                                 </div>
                            
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Dokumen SPK <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" name="vendor_dokumen" required="required" class="form-control col-md-7 col-xs-12" ?>
                            </div>
                        </div>
                                     

                    <?php }
                    ?>
                    <div class="ln_solid">

                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <a class="btn btn-sm bg-blue" href="<?php echo base_url($this->cname); ?>"><i class="fa fa-arrow-left"></i> Kembali</a>
                          
                            <?php if ($this->fitur == 'Perpanjang' || $this->fitur == 'Update Setting') { ?>
                                <button type="submit" class="btn btn-sm btn-primary <?php if ($this->fitur == 'Ubah') echo 'popconfirm-update'; ?>" data-toggle='confirmation'><i class="fa fa-save"></i> Simpan</button>
                            <?php } ?>


                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

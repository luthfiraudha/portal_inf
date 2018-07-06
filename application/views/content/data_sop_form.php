<script type="text/javascript">

function yesnoCheck(box) {
    if (document.getElementById('yesCheck').checked) {
        document.getElementById('ifYes').style.display = 'block';
    }
    else document.getElementById('ifYes').style.display = 'none';

}




</script>

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
                                        </ul>
                                    -->
                </div>



            <?php } ?>
            <div class="x_content">
                <br />

                <form  method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" >
                    <?php if ($this->fitur == 'Lihat') { ?>

                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12" >Aplikasi
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <p>: <?php echo $sop_detail->nama_app; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12" >Fitur
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <p>: <?php echo $sop_detail->nama_fitur; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12" >Kategori
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <p>: <?php echo $sop_detail->sop_name; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12" >Tanggal Release
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <p>: <?php echo $sop_detail->sop_tgl; ?><p>
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12" >Pembuat (PIC)
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <p>: <?php echo $sop_detail->sop_pic; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12" >Keterangan
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <p>: <?php echo $sop_detail->sop_ket; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12" >Tanggal Berakhir
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">:
                                <a title='Dokumen' href="<?php echo $sop_detail->sop_pdf?>" class='btn btn-circle btn-sm sbold bg-blue' target="_blank">
                                    <i class='fa fa-file'>Lihat Dokumen</i>
                                </a>
                            </div>
                        </div>
                        
                        
                        <?php
                    } else {
                        ?>
                        <?php if ($this->fitur == 'Ubah') { ?>
                            <input type="hidden" name="sop_id" value="<?php echo $sop_detail->sop_id; ?>">
                        <?php } ?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Aplikasi<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="nama_app" required="required" id="namaapp" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $sop_detail->nama_app; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Fitur<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="nama_fitur" required="required" id="namafitur" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $sop_detail->nama_fitur; ?>" onkeyup="cekfitur();">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Kategori<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="sop_name" id="kategoriapp" required="required" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $sop_detail->sop_name; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Tanggal Release <span class="required">*</span>
                            </label>
                            <?php 
                            if($this->fitur == 'Ubah'){
                            $newdate1 = date("m/d/Y", strtotime($sop_detail->sop_tgl));
                            
                             }
                            
                            ?>
                          
                               <div class="control-group">
                                <div class="controls">
                                        <div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">
                                             <input type="text" name="sop_tgl" class="form-control has-feedback-left" id="single_cal1" value="<?php if ($this->fitur == 'Ubah') echo $newdate1; ?>">
                                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                            
                                        </div>
                                    </div>
                                 </div>
                            
                        </div>
                       
                      
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Nama Pembuat (PIC) <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="sop_pic" required="required" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $sop_detail->sop_pic; ?>" >
                            </div>
                        </div>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan
                             <span class="required">*</span>
                             </label>
                             <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="sop_ket">
                                   <option value="Daily Activity">Daily Activity</option>
                                   <option value="Problem">Problem</option>                                
                                   </select>
                             </div>
                        </div>
                        <?php  
                        if($this->fitur == 'Ubah'){
                            ?>
                         <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="checkbox" onclick="yesnoCheck('ifYes')" id="yesCheck" name="yesno"  /> Update file dokumen
                            </div>
                        </div>
                        <div class="form-group" id="ifYes" style="display:none;">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12" >Dokumen <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" name="sop_pdf" required="required" class="form-control col-md-7 col-xs-12" >
                            </div>
                        </div>
                         <?php
                        }else{
                        ?>    
                         <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Dokumen <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" name="sop_pdf" required="required" class="form-control col-md-7 col-xs-12" >
                            </div>
                        </div>
                        
                        <?php } ?>
                      
                                      

                    <?php }
                    ?>
                    <div class="ln_solid">

                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
                            <a class="btn btn-sm bg-blue" href="#" onclick="history.go(-1);"><i class="fa fa-arrow-left"></i> Kembali</a>
                            <?php if ($this->fitur == 'Lihat') { ?>
                                <a href="<?php echo base_url($this->cname . '/action/edit/' . $sop_detail->sop_id); ?>" class="btn btn-sm bg-orange"><i class="fa fa-edit"></i> Ubah</a>
                            <?php } ?>
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

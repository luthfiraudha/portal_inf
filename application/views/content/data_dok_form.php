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
                <h2><?php echo $this->menu; ?><small><?php echo $this->fitur; ?></small></h2>
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
                    
                    <?php
                    

                    if ($this->fitur == 'Ubah') { ?>
                            
                        <div>
                        <input  type="hidden" name="id_fitur" value="<?php echo $projek_detail->id_fitur;?>">
                        <input  type="hidden" name="id_doc" value="<?php echo $projek_detail->id_doc;?>">
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-5 col-sm-3 col-xs-12" >Versi Aplikasi <span class="required">*</span>
                            </label>
                            <div class="col-md-1 col-sm-6 col-xs-12">
                                <input  type="number" name="versi_a" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $projek_detail->versi_a;?>" numeric>
                            </div>
                            <div class="col-md-1 col-sm-6 col-xs-12">
                                <input  type="number" name="versi_b" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $projek_detail->versi_b;?>" numeric>
                            </div>
                            <div class="col-md-1 col-sm-6 col-xs-12">
                                <input  type="number" name="versi_c" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $projek_detail->versi_c;?>" numeric>
                            </div>
                        </div>

                       

                        
                        <div class="form-group">
                            <label class="control-label col-md-5 col-sm-3 col-xs-12" >
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="checkbox" onclick="yesnoCheck('ifYes')" id="yesCheck" name="yesno" > Update Dokumen
                            </div>
                        </div>
                        <div class="form-group" id="ifYes" style="display:none;">
                            <label class="control-label col-md-5 col-sm-3 col-xs-12" >Upload Dokumen (.rar) <span class="required">*</span>
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <input type="file" name="dok_app" required="required" class="form-control col-md-7 col-xs-12" ?>
                            </div>
                        </div> 
                    
                    <?php } ?>

                    <div class="ln_solid">

                    </div>
                    <div class="form-group">

                        

                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" align="center">
                            <a class="btn btn-sm bg-blue" href="#" onclick="history.go(-1)";> <i class="fa fa-arrow-left"></i> Kembali</a>
                            
                            <?php if ($this->fitur == 'Ubah') { ?>
                                <button type="submit" class="btn btn-sm btn-primary <?php if ($this->fitur == 'Ubah') echo 'popconfirm-update'; ?>" data-toggle='confirmation'><i class="fa fa-save"></i> Simpan</button>
                            <?php } ?>

                        </div>
                    </div>

                    
                </form>
            </div>

        </div>
    </div>
</div>


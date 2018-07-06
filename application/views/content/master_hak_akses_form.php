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
                    <?php if ($this->fitur == 'Lihat') { ?>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12" >Nama Hak Akses
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <p>: <?php echo $akses_detail->akses_nama; ?><p>
                            </div>
                        </div>
                        
                        
                        <?php
                    } else {
                        ?>
                        <?php if ($this->fitur == 'Ubah') { ?>
                            <input type="hidden" name="akses_id" value="<?php echo $akses_detail->akses_id; ?>">
                        <?php } ?>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Nama Akses<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="akses_nama" required="required" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $akses_detail->akses_nama; ?>">
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
                                <a href="<?php echo base_url($this->cname . '/action/edit/' . $akses_detail->akses_id); ?>" class="btn btn-sm bg-orange"><i class="fa fa-edit"></i> Ubah</a>
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

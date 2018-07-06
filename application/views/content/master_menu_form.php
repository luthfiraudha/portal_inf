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
                            <label class="col-md-3 col-sm-3 col-xs-12" >Nama
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <p>: <?php echo $menu_detail->name; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12">Link 
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <p>: <?php echo $menu_detail->link; ?> <p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12">Is Active

                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <p>: <?php echo $menu_detail->is_active == 1 ? 'Aktif' : 'Tidak Aktif'; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12">Is Parent

                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <p>: <?php echo $menu_detail->is_parent < 1 ? 'Main Menu' : 'Sub Menu'; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12">Hak Akses

                            </label>

                            <div class="col-md-3 col-sm-9 col-xs-12">
                                <p>:
                                    <?php
                                    $akses = explode("|", $menu_detail->hak_akses);
                                    for ($i = 0; $i < sizeof($akses); $i++) {
                                        ?>

                                        <?php
                                        echo $akses[$i];
                                        ?>

                                    <?php }
                                    ?>
                                </p>
                            </div>
                        </div>
                        <?php
                    } else {
                        ?>
                        <?php if ($this->fitur == 'Ubah') { ?>
                            <input type="hidden" name="id" value="<?php echo $menu_detail->id; ?>">
                        <?php } ?>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Nama <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="name" required="required" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $menu_detail->name; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Link <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="link" required="required" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $menu_detail->link; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Is Active
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="is_active">
                                    <?php
                                    if ($this->fitur == 'Ubah') {
                                        ?>
                                        <?php if ($menu_detail->is_active == "1") { ?>
                                            <option value="1">Ya</option>
                                            <option value="0">Tidak</option>
                                        
                                        <?php }elseif ($menu_detail->is_active == "0") { ?>
                                            <option value="0">Tidak</option>
                                        
                                            <option value="1">Ya</option>
                                        <?php } ?>

                                    <?php } else { ?>
                                        <option value="1">Ya</option>
                                        <option value="0">Tidak</option>
                                    <?php } ?>



                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Is Parent
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="is_parent">
                                    <option value="0">YA</option>
                                    <?php
                                    foreach ($menu as $m) {
                                        echo "<option value='$m->id' ";
                                        if ($this->fitur == "Ubah") {
                                            echo $m->id == $menu_detail->is_parent ? 'selected' : '';
                                        }
                                        echo">" . strtoupper($m->name) . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Hak Akses
                                <span class="required">*</span>
                            </label>

                            <div class="col-md-9 col-sm-9 col-xs-12">

                                <?php
                                foreach ($hak_akses as $ha) {
                                    ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="hak_akses[]" value="<?php echo $ha->akses_nama; ?>" class="flat" > <?php
                            echo $ha->akses_nama;
                                    ?>
                                        </label>
                                    </div>
                                    <?php
                                }
                                ?>
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
                                <a href="<?php echo base_url($this->cname . '/action/edit/' . $menu_detail->id); ?>" class="btn btn-sm bg-orange"><i class="fa fa-edit"></i> Ubah</a>
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

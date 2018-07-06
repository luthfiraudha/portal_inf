<script type="text/javascript">

// function yesnoCheck(box) {
//     if (document.getElementById('yesCheck').checked) {
//         document.getElementById('ifYes').style.display = 'block';
//     }
//     else document.getElementById('ifYes').style.display = 'none';

// }




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
                            <label class="col-md-3 col-sm-3 col-xs-12" >Nama Divisi
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <p>: <?php echo $perangkat_detail->nama_divisi; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12" >Nama
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <p>: <?php echo $perangkat_detail->nama; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12" >PN
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <p>: <?php echo $perangkat_detail->pn; ?><p>
                            </div>
                        </div>
                        
                        <?php
                    } else {
                        ?>
                        <?php if ($this->fitur == 'Ubah') { ?>
                            <input type="hidden" name="id" value="<?php echo  $perangkat_detail->id; ?>">
                        <?php } ?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Nama Divisi<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="nama_divisi" required="required" id="nama_divisi" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $perangkat_detail->nama_divisi; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Nama<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="nama" required="required" id="nama" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $perangkat_detail->nama; ?>" onkeyup="cekfitur();">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >PN<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="nama" required="required" id="pn" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $perangkat_detail->pn; ?>" onkeyup="cekfitur();">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Jabatan<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="nama_divisi" required="required" id="jabatan" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $perangkat_detail->jabatan; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Permohonan Perangkat<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="nama" required="required" id="permohonan_perangkat" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $perangkat_detail->nama; ?>" onkeyup="cekfitur();">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Alasan Penggunaan<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="nama" required="required" id="alasan_pengguna" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $perangkat_detail->nama; ?>" onkeyup="cekfitur();">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Baru/Replacement<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="nama_divisi" required="required" id="baru_replacement" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $perangkat_detail->nama_divisi; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Tahun Perangkat<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="nama" required="required" id="tahun" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $perangkat_detail->tahun; ?>" onkeyup="cekfitur();">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Merek Perangkat<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="nama" required="required" id="merek" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $perangkat_detail->merek; ?>" onkeyup="cekfitur();">
                            </div>
                        </div>
                        
                     
                       <!--  <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan
                             <span class="required">*</span>
                             </label>
                             <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="sop_ket">
                                   <option value="Daily Activity">Daily Activity</option>
                                   <option value="Problem">Problem</option>                                
                                   </select>
                             </div>
                        </div>
                        -->
                      
                                      

                    <?php }
                    ?>
                    <div class="ln_solid">

                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
                            <?php if ($this->fitur == 'Ubah') { ?>
                            <a class="btn btn-sm bg-blue" href="<?php echo base_url($this->cname . '/view/'. $perangkat_detail->id); ?>" ><i class="fa fa-arrow-left"></i> Kembali</a>
                            <?php } ?>
                             <?php if ($this->fitur == 'Lihat') { ?>
                            <a class="btn btn-sm bg-blue" href="<?php echo base_url($this->cname . '/index'); ?>" ><i class="fa fa-arrow-left"></i> Kembali</a>
                            <?php } ?>
                            <?php if ($this->fitur == 'Lihat') { ?>
                                <a href="<?php echo base_url($this->cname . '/action/edit/' . $perangkat_detail->id); ?>" class="btn btn-sm bg-orange"><i class="fa fa-edit"></i> Ubah</a>
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
<style>


</style>
<script>

</script>

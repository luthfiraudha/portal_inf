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

                <form  method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                    <?php if ($this->fitur == 'Lihat') { ?>
                        <div class="form-group">
                            <label class="col-md-2 col-sm-3 col-xs-12" >SPK Nomor
                            </label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <p>: <?php echo $vendor_detail->spk_nmr; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-sm-3 col-xs-12" >Nama Projek
                            </label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <p>: <?php echo $vendor_detail->nama_projek; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-sm-3 col-xs-12" >Nama Vendor
                            </label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <p>: <?php echo $vendor_detail->vendor_nama; ?><p>
                            </div>
                        </div>
                     
                        <div class="form-group">
                            <label class="col-md-2 col-sm-3 col-xs-12" >Nilai Kontrak
                            </label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <p>: <?php echo format_rupiah2($vendor_detail->nilai_kontrak); ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-sm-3 col-xs-12" >Tanggal Mulai
                            </label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <p>: <?php echo $vendor_detail->vendor_begindate; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-sm-3 col-xs-12" >Tanggal Berakhir
                            </label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <p>: <?php echo $vendor_detail->vendor_enddate; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-sm-3 col-xs-12" >Status
                            </label>
                            <div class="col-md-1 col-sm-6 col-xs-12">
                                <p>: <?php if($vendor_detail->status == 'selesai'){?>
                                <i class='btn btn-circle btn-xs bg-red'>selesai</i>
                                <?php } else{ ?>

                                <i class='btn btn-circle btn-xs bg-green'><?php echo $vendor_detail->status;?></i>
                                <?php } ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-sm-3 col-xs-12" >Vendor Dokumen
                            </label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <p>:  <a title='Dokumen' href="<?php echo $vendor_detail->vendor_dokumen?>" class='btn btn-circle btn-sm sbold bg-blue' target="_blank">
                                    <i class='fa fa-file'> </i> Lihat Dokumen
                                </a><p>
                            </div>
                        </div>
                        
                        <?php
                    } else {
                        ?>
                        <?php if ($this->fitur == 'Ubah') { ?>
                            <input type="hidden" name="vendor_id" value="<?php echo $vendor_detail->vendor_id; ?>">
                        <?php } ?>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >SPK Nomor<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input  type="text" name="spk_nmr" required="required" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $vendor_detail->spk_nmr; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Nama Projek <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="namaprojek" type="text" name="nama_projek" required="required" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $vendor_detail->nama_projek; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Nama Vendor <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="vendor_nama" required="required" id="namavendor" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $vendor_detail->vendor_nama; ?>">
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Nilai Kontrak <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="nilai_kontrak" required="required" class="form-control col-md-7 col-xs-12 numeric" value="<?php if ($this->fitur == 'Ubah') echo $vendor_detail->nilai_kontrak; ?>">
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Dokumen SPK <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" name="vendor_dokumen" required="required" class="form-control col-md-7 col-xs-12" ?>
                            </div>
                        </div>
                         <?php
                        }else{
                        ?>    
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Dokumen SPK <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" name="vendor_dokumen" required="required" class="form-control col-md-7 col-xs-12" ?>
                            </div>
                        </div>
                        <?php } ?>
                        <?php  
                        if($this->fitur == 'Ubah'){
                            ?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Status
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="status">       
                                        <option value="baru">Baru</option>    
                                        <option value="diperpanjang">Diperpanjang</option>
                                        <option value="selesai">Tidak Diperpanjang</option>
                                </select>
                            </div>
                        </div>

                        <?php
                        }
                        ?>                 

                    <?php }
                    ?>
                    <div class="ln_solid">

                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
                            <a class="btn btn-sm bg-blue" href="#"  onclick="history.go(-1);" ><i class="fa fa-arrow-left"></i> Kembali</a>
                            <?php if ($this->fitur == 'Lihat') { ?>
                                <a href="<?php echo base_url($this->cname . '/action/edit/' . $vendor_detail->vendor_id); ?>" class="btn btn-sm bg-orange"><i class="fa fa-edit"></i> Ubah</a>
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


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
                            <label class="col-md-3 col-sm-3 col-xs-12" >Kanwil/ Divisi
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <p>: <?php echo $pmslan_detail->kanwil_divisi; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12" >Kanca / Bagian
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <p>: <?php echo $pmslan_detail->kanca_bagian; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12" >jenis
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <p>: <?php echo $pmslan_detail->jenis; ?><p>
                            </div>
                        </div>
                        
                        <?php
                    } else {
                        ?>
                        <?php if ($this->fitur == 'Ubah') { ?>
                            <input type="hidden" name="id" value="<?php echo  $pmslan_detail->id; ?>">
                        <?php } ?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Kanwil/ Divisi<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="kanwil_divisi" required="required" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $pmslan_detail->kanwil_divisi; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Kanca / Bagian<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="kanca_bagian" required="required" id="namafitur" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $pmslan_detail->kanca_bagian; ?>" onkeyup="cekfitur();">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Jenis<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                 <select class="form-control" name="jenis">
                                   <option value="Recabling">Recabling</option>
                                   <option value="Relokasi Gedung Baru">Relokasi Gedung Baru</option>                                
                                   </select>
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
                            <a class="btn btn-sm bg-blue" href="<?php echo base_url($this->cname . '/view/'. $pmslan_detail->id); ?>" ><i class="fa fa-arrow-left"></i> Kembali</a>
                            <?php } ?>
                             <?php if ($this->fitur == 'Lihat') { ?>
                            <a class="btn btn-sm bg-blue" href="<?php echo base_url($this->cname . '/index'); ?>" ><i class="fa fa-arrow-left"></i> Kembali</a>
                            <?php } ?>
                            <?php if ($this->fitur == 'Lihat') { ?>
                                <a href="<?php echo base_url($this->cname . '/action/edit/' . $pmslan_detail->id); ?>" class="btn btn-sm bg-orange"><i class="fa fa-edit"></i> Ubah</a>
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
 <?php if($this->fitur != 'Tambah'){?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <!-- <h2><?php echo $this->menu;?> | <small><?php echo $this->fitur;?></small></h2> -->
                FORM SURAT PMS LAN

                <div class="clearfix"></div>
            </div>

         
            <div class="x_content">


               <!--  <div>
                    <h4>Informasi</h4>
                    <ul>
                        <li>Hak Akses tidak dapat dihapus.</li>
                        <li>Beberapa Hak Akses tidak dapat diubah.</li>
                    </ul>
                </div> -->
              
                <a href="<?php echo base_url($this->cname . '/add_surat/'.$pmslan_detail->id)?>" class="btn btn-small sbold bg-green" >
                                <i ></i> Surat
                            </a>
               
              
                <div class="row">

                <table  class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="1">NO</th>
                            <th width="" rowspan="1">JENIS SURAT</th>
                            <th width="" rowspan="1">NOMOR</th>
                            <th width="" rowspan="1">TANGGAL</th>
                            <th width="" rowspan="1">NILAI</th>
                            <th width="" rowspan="1">PROVIDER</th>
                            <th width="" rowspan="1">DETAIL</th>
                            <th width="" rowspan="1">AKSI</th>
                        </tr>
                        
                    </thead>
                   <tbody>
                    <?php 
                    $no = 1;

                    foreach($data_surat as $key){

                        if($key->status_pmslan == 1){
                        ?>

                        <tr>
                            <td><?php echo $no++;?></td>
                            <td><?php echo strtoupper($key->jenis_surat);?></td>
                            <td><?php echo $key->nomor_surat;?></td>
                            <td><?php echo $key->tanggal;?></td>
                            <td><?php echo $key->nilai?></td>
                            <td><?php echo $key->provider?></td>
                            <td  style="text-align: center;" >  <a title='Download' href='<?php echo $key->file_upload?>' class='btn btn-circle btn-sm bg-blue' target='_blank'>
                                    <i class='fa fa-download'> </i>
                                </a></td>
                            <td> <a title='Delete' data-href='<?php echo base_url().'pms_lan/action/delete_surat/'.$key->id.'/'.$key->jenis_surat; ?>' class='btn btn-circle btn-sm bg-red' data-toggle='modal' data-target='.delete-modal'>
                                    <i class='fa fa-trash'> </i>
                            </a></td>
                        </tr>
                    <?php 
                        }
                    } ?>
                    </tbody>


                </table>
                </div>


                 <a href="<?php echo base_url($this->cname . '/add_bai/'.$pmslan_detail->id)?>" class="btn btn-small sbold bg-orange" >
                 <i ></i> BAI  </a>
                
                <div class="row">

                <table id="" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="1">NO</th>
                            <th width="" rowspan="1">PIHAK BRI</th>
                            <th width="" rowspan="1">VENDOR</th>
                            <th width="" rowspan="1">TANGGAL PENGERJAAN</th>
                            <th width="" rowspan="1">KE OPI</th>
                            <th width="" rowspan="1">KE PROVIDER</th>
                            <th width="" rowspan="1">AKSI</th>

                        </tr>
                        
                    </thead>
                    <tbody>
                        <?php 
                        $nox=1;
                        if($pmslan_detail->bai_status == '1'){?>
                        <tr>
                            <td><?php echo $nox;?></td>
                            <td><?php echo $pmslan_detail->bai_bri;?></td>
                            <td><?php echo $pmslan_detail->bai_vendor;?></td>
                            <td><?php echo $pmslan_detail->bai_tgl;?></td>
                            <td><?php echo $pmslan_detail->bai_ke_inf;?></td>
                            <td><?php echo $pmslan_detail->bai_ke_provider;?></td>
                            <td> <a title='Delete' data-href='<?php echo base_url().'pms_lan/action/delete_bai/'.$pmslan_detail->id; ?>' class='btn btn-circle btn-sm bg-red' data-toggle='modal' data-target='.delete-modal'>
                                    <i class='fa fa-trash'> </i>
                            </a></td>

                        </tr>
                        <?php } ?>
                    </tbody>


                </table>
                </div>

                <a href="<?php echo base_url($this->cname . '/add_bast/'.$pmslan_detail->id)?>" class="btn btn-small sbold bg-primary" >
                                <i ></i> BAST
                </a>
                <div class="row">

                <table  class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="1">NO</th>
                            <th width="" rowspan="1">TANGGAL</th>
                            <th width="" rowspan="1">TTD</th>
                            
                        </tr>
                        
                    </thead>
                    <tbody>
                        <?php if($pmslan_detail->bast_status == '1'){?>
                        <tr>
                            <td><?php echo $pmslan_detail->bast_tgl; ?></td>
                            <td><?php echo $pmslan_detail->bast_ttd; ?></td>
                            <td> <a title='Delete' data-href='<?php echo base_url().'pms_lan/action/delete_bast/'.$pmslan_detail->id; ?>' class='btn btn-circle btn-sm bg-red' data-toggle='modal' data-target='.delete-modal'>
                                    <i class='fa fa-trash'> </i>
                            </a></td>
                        </tr>
                        <?php } ?>
                    </tbody>


                </table>
                </div>

                <a href="<?php echo base_url($this->cname . '/add_exclude/'.$pmslan_detail->id)?>" class="btn btn-small sbold bg-primary" >
                                <i ></i> EXCLUDE
                </a>
                <div class="row">

                <table  class="table table-striped table-bordered">
                    <thead>
                        <tr>
                           
                            
                            <th width="" rowspan="1">KETERANGAN EXCLUDE</th>
                            
                        </tr>
                        
                    </thead>
                    <tbody>
                        <?php if($pmslan_detail->exclude_status == '1'){?>
                        <tr>
                           
                            <td><?php echo $pmslan_detail->keterangan_exclude; ?></td>
                            <td> <a title='Delete' data-href='<?php echo base_url().'pms_lan/action/delete_exclude/'.$pmslan_detail->id; ?>' class='btn btn-circle btn-sm bg-red' data-toggle='modal' data-target='.delete-modal'>
                                    <i class='fa fa-trash'> </i>
                            </a></td>
                        </tr>
                        <?php } ?>
                    </tbody>


                </table>
                </div>


            </div>
        </div>
    </div>
</div>
  <?php } ?>

<style>


</style>
<script>

</script>

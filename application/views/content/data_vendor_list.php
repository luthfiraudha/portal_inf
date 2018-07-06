
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12" >
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo $this->menu;?> |<small><?php echo $this->fitur;?></small></h2>
                <div class="clearfix"></div>
            </div>
            <?php cetak_flash_msg();?>
            <?php if (!empty($alert['message'])) {?>
            <div class="alert alert-<?php echo $alert['class'];?> alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <?php echo $alert['message'];?>
            </div>
            <?php }
            ?>
      
            <div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="btn-group">
                            <a href="<?php echo base_url($this->cname . '/add')?>" class="btn btn-small sbold bg-green" >
                                <i class="fa fa-plus"></i> Upload Data Vendor
                            </a>
                        </div>
                        <!-- <div class="btn-group">
                            <a href="<?php echo base_url($this->cname . '/upload_file')?>" class="btn btn-small sbold" >
                                <i class="fa fa-upload"></i> Upload file
                            </a>
                        </div> -->
                    </div>
                </div>
            </div>
          
            <div class="x_content" >
                <!--                <div>
                    <h4>Informasi</h4>
                    <ul>
                        <li>Hak Akses tidak dapat dihapus.</li>
                        <li>Beberapa Hak Akses tidak dapat diubah.</li>
                    </ul>
                </div>-->
                <table id="data-vend" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="10px">No</th>
                            <th>SPK Nomor</th>
                            <th>Nama Projek</th>
                            <th>Nama Vendor</th>
                            <th width="30px">Tanggal Kontrak</th>
                            <th>Status</th>
                            <th width="120px">Nilai Kontrak</th>
                            <th>Dokumen SPK</th>
                            <?php if($this->active_privilege == "superadmin" || $this->active_privilege == "signer"){?>
                            <th width="140px">Action</th>
                            <?php } ?>
                        </tr>
                    </thead>
                   <!--  <tbody>
                        <?php
                        $start = 0;
                        foreach ($vendor as $vendor) {
                        ?>
                        <tr>
                            <td><?php echo ++$start?></td>
                            <td><?php echo $vendor->spk_nmr?></td>
                            <td><?php echo $vendor->nama_projek?></td>
                            <td><?php echo $vendor->vendor_nama?></td>
                            <td><a class="green">Mulai: <?php echo $vendor->vendor_begindate?></a>
                                </br><a class="red">Berakhir: <?php echo $vendor->vendor_enddate?></a></td>
                            
                         
                            <td><?php if($vendor->status == 'kadaluarsa'){?>
                                <i class='btn btn-circle btn-xs bg-red'>kadaluarsa</i>
                                <?php } else{ ?>

                                <i class='btn btn-circle btn-xs bg-green'><?php echo $vendor->status;?></i>
                                <?php } ?>
                            </td>
                            <td><?php echo format_rupiah2($vendor->nilai_kontrak)?></td>
                            <td> <a title='Dokumen' href="<?php echo $vendor->vendor_dokumen?>" class='btn btn-circle btn-sm sbold bg-blue' target="_blank">
                                    <i class='fa fa-file'> Lihat Dokumen</i>
                                </a></td>

                            <?php if($this->active_privilege == "superadmin" || $this->active_privilege == "signer"){?>
                            <td style="text-align:center" width="140px">
                                <a title='Lihat' href=" <?php echo base_url($this->cname . '/action/view/' . $vendor->vendor_id);?>" class='btn btn-circle btn-sm bg-green'>
                                    <i class='fa fa-folder'></i>
                                </a>
                                <a title='Edit' href=" <?php echo base_url($this->cname . '/action/edit/' . $vendor->vendor_id);?>" class='btn btn-circle btn-sm bg-blue'>
                                    <i class='fa fa-edit'></i>
                                </a>
                                <a title='Delete' data-href=" <?php echo base_url($this->cname . '/action/delete/' . $vendor->vendor_id);?>" class='btn btn-circle btn-sm bg-red' data-toggle="modal" data-target=".delete-modal">
                                    <i class='fa fa-trash'></i>
                                </a>
                            </td>
                             <?php } ?>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody> -->
                </table>
            </div>
        </div>
    </div>
</div>
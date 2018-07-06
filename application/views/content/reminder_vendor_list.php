

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo $this->menu;?> |<small><?php echo $this->fitur;?></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="<?php echo base_url($this->cname).'/update_setting';?>">Settings Reminder</a>
                          </li>
                          
                        </ul>
                      </li>
                      
                      </li>
                    </ul>
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
            

            <div class="x_content">
            

<!--                <div>
                    <h4>Informasi</h4>
                    <ul>
                        <li>Hak Akses tidak dapat dihapus.</li>
                        <li>Beberapa Hak Akses tidak dapat diubah.</li>
                    </ul>
                </div>-->

                <table id="datatable-buttons" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="10px">No</th>
                            <th>SPK Nomor</th>
                            <th>Nama Projek</th>
                            <th>Nama Vendor</th>
                            <th>Tanggal Kontrak</th>
                            <th>Tanggal Berakhir</th>
                            <!-- <th>Status</th> -->
                            <th>Nilai Kontrak</th>
                            <th>Dokumen SPK</th>
                            <th>Tempo</th>
                            <th>Action</th>

                        </tr>
                    </thead>


                    <tbody>
                        <?php
                        $start = 0;

                    foreach ($vendor as $vendor) {

                          ?>
                            <tr>
                            <td><?php echo ++$start?></td>
                            <td><?php echo $vendor->spk_nmr?></td>
                            <td><?php echo $vendor->nama_projek?></td>
                            <td><?php echo $vendor->vendor_nama?></td>
                            <td><?php echo $vendor->vendor_begindate?></td>
                            <td><?php echo $vendor->vendor_enddate?></td>
                            <!-- <td><?php if($vendor->status == 'kadaluarsa'){?>
                                <i class='btn btn-circle btn-xs bg-red'>kadaluarsa</i>
                                <?php } else{ ?>

                                <i class='btn btn-circle btn-xs bg-green'><?php echo $vendor->status;?></i>
                                <?php } ?>
                            </td> -->
                            <td><?php echo format_rupiah2($vendor->nilai_kontrak)?></td>
                            <td> <a title='Dokumen' href="<?php echo $vendor->vendor_dokumen?>" class='btn btn-circle btn-sm sbold bg-blue' target="_blank">
                                    <i class='fa fa-file'> </i> Lihat Dokumen
                                </a></td>
                                <td><?php
                                if (($vendor->tempo/30) < $sv ) {
        ?>
                                        <i class='btn btn-circle btn-xs bg-red'><?php
(int) $l = $vendor->tempo / 30;
        echo (int) $l . " bulan " . $vendor->tempo % 30 . " hari lagi";?></i>
                                    <?php } elseif (($vendor->tempo/30) < $sv) {
        ?>
                                        <i class='btn btn-circle btn-xs bg-green'><?php
(int) $l = $vendor->tempo / 30;
        echo (int) $l . " bulan " . $vendor->tempo % 30 . " hari lagi";?></i>
                                    <?php }
    ?></td>

                                <td style="text-align:center" width="140px">

                                    <a title='Extend' href=" <?php echo base_url($this->cname . '/action/add/' . $vendor->vendor_id);?>" class='btn btn-circle btn-sm btn-success'>
                                        <i>Extend</i>
                                    </a>
                                   <!-- <a title='Delete' data-href=" <?php echo base_url($this->cname . '/action/dismiss/' . $vendor->vendor_id);?>" class='btn btn-circle btn-sm btn-warning' data-toggle="modal" data-target=".dismiss-modal">
                                        <i>Dismiss</i>
                                    </a> -->

                            
                                </td>
                            </tr>
                            <?php
}
?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
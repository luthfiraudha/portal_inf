
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo $this->menu;?><small><?php echo $this->fitur;?></small></h2>

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
            <?php if ( $this->active_privilege == 'maker' || $this->active_privilege == 'checker' || $this->active_privilege == 'signer' || $this->active_privilege == 'superadmin') {?>

                <div>
                    <div class="row">
                        <div class="col-md-6">

                            <div class="btn-group">
                                <a href="<?php echo base_url($this->cname . '/add')?>" class="btn btn-small sbold bg-green" >
                                    <i class="fa fa-plus"></i> Create Ticket
                                </a>
                            </div>
                            <!-- <div class="btn-group">
                                <a href="<?php //echo base_url($this->cname . '/upload_file')?>" class="btn btn-small sbold" >
                                    <i class="fa fa-upload"></i> Upload file
                                </a>
                            </div> -->
                        </div>

                    </div>
                </div>
                
                <?php
}
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
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Shift</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Jenis Ticket</th>
                            <th>Isi</th>
                            <th>Status</th>
                            <?php if ($this->fitur == "Daftar" && (get_session("user_akses") == "superadmin")){?>
                            <th>Action</th>
                            <?php }else{ ?>
                            <th>Detail</th>
                            <?php } ?>

                        </tr>
                    </thead>


                    <tbody>
                        <?php
                        $start = 0;
                        foreach ($issue as $issue) {

                           ?>
                            <tr>
                                <td><?php echo ++$start?></td>
                                <td><?php echo $issue->tgl_input?></td>
                                <td><?php echo $issue->shift?></td>
                                <td><?php echo $issue->user_nama?></td>
                                <td><?php echo $issue->kategori_nama?></td>
                                
                                <td><?php echo $issue->type?></td>
                               
                                <td><?php 
                                $string = strip_tags($issue->isi);
                                    if (strlen($string) > 50) {
                                     // truncate string
                                $stringCut = substr($string, 0, 50);

                                 // make sure it ends in a word so assassinate doesn't become ass...
                                $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... '; 
                                }
                                echo $string;
                                ?></td>
                                <td><?php
                                if ($issue->status == "belum selesai" ) {  ?>
                                        <i class='btn btn-xs bg-red'>belum selesai</i>
                                    <?php } elseif ($issue->status == "selesai") { ?>
                                        <i class='btn btn-xs bg-green'>selesai</i>
                                    <?php }

                                ?></td>

                          

                                    <?php if ($this->fitur == 'Daftar' && $this->active_privilege == "superadmin"){?>

                                <td style="text-align:center" width="140px">
                                    <a title='Lihat' href=" <?php echo base_url($this->cname . '/action/view/' . $issue->id);?>" class='btn btn-circle btn-sm bg-green'>
                                        <i class='fa fa-folder'></i>
                                    </a>
                                    <?php if($issue->status == "selesai"){ ?>
                                  
                                     <?php }else{ ?>
                                       <a title='Edit' href=" <?php echo base_url($this->cname . '/action/edit/' . $issue->id);?>" class='btn btn-circle btn-sm bg-blue'>
                                        <i class='fa fa-edit'></i>
                                    </a>
                                     <?php } ?>
                                    <a title='Delete' data-href=" <?php echo base_url($this->cname . '/action/delete/' . $issue->id);?>" class='btn btn-circle btn-sm bg-red' data-toggle="modal" data-target=".delete-modal">
                                        <i class='fa fa-trash'></i>
                                    </a>

                                </td>

                                    <?php }elseif( (($this->active_privilege == "signer") || ($this->active_privilege == "checker") || ($this->active_privilege== "maker") )) { ?>
                                     <?php if($this->active_user == $issue->user_nama){?>
                                    <td style="text-align:center" width="140px">
                                    <a title='Lihat' href=" <?php echo base_url($this->cname . '/action/view/' . $issue->id);?>" class='btn btn-circle btn-sm bg-green'>
                                        <i class='fa fa-folder'></i>
                                    </a>

                                      <?php if($issue->status == "selesai"){ ?>
                                  
                                     <?php }else{ ?>
                                       <a title='Edit' href=" <?php echo base_url($this->cname . '/action/edit/' . $issue->id);?>" class='btn btn-circle btn-sm bg-blue'>
                                        <i class='fa fa-edit'></i>
                                    </a>
                                     <?php } ?>

                                    <a title='Delete' data-href=" <?php echo base_url($this->cname . '/action/delete/' . $issue->id);?>" class='btn btn-circle btn-sm bg-red' data-toggle="modal" data-target=".delete-modal">
                                        <i class='fa fa-trash'></i>
                                    </a>
                                     </td>

                                        <?php } else{?>

                                <td style="text-align:center" width="">
                                     <a title='Lihat' href=" <?php echo base_url($this->cname . '/action/view/' . $issue->id);?>" class='btn btn-circle btn-sm bg-green'>
                                        <i class='fa fa-folder'> <strong>view</strong></i>
                                    </a>
                                </td>
                                    <?php } ?>

                                    <?php }

                                    ?>


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
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
            <?php if (get_session("user_akses") == "superadmin") { ?>

                <div>
                    <div class="row">
                        <div class="col-md-6">

                            <div class="btn-group">
                                <a href="<?php echo base_url($this->cname . '/add') ?>" class="btn btn-small sbold bg-green" > 
                                    <i class="fa fa-plus"></i> Create New Hak Akses
                                </a>
                            </div>
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
                            <th width="80px">No</th>
                            <th>Akses Nama</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>


                    <tbody>
                        <?php
                        $start = 0;
                        foreach ($hak_akses as $hak_akses) {
                            
                            ?>
                            <tr>
                                <td><?php echo ++$start ?></td>
                                <td><?php echo $hak_akses->akses_nama ?></td>
                                <td style="text-align:center" width="140px">

                                    <a title='Lihat' href=" <?php echo base_url($this->cname . '/action/view/' . $hak_akses->akses_id); ?>" class='btn btn-circle btn-sm bg-green'>
                                        <i class='fa fa-folder'></i>
                                    </a>
                                    <a title='Edit' href=" <?php echo base_url($this->cname . '/action/edit/' . $hak_akses->akses_id); ?>" class='btn btn-circle btn-sm bg-blue'>
                                        <i class='fa fa-edit'></i>
                                    </a>

                                    <a title='Delete' data-href=" <?php echo base_url($this->cname . '/action/delete/' . $hak_akses->akses_id); ?>" class='btn btn-circle btn-sm bg-red' data-toggle="modal" data-target=".delete-modal">
                                        <i class='fa fa-trash'></i>
                                    </a>



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
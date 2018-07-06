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
                            <th width="">No</th>
                            <th>Personal Number</th>
                            <th>Email</th>
                            <th>Nama</th>
                            <th>Nomor HP</th>
                            <th>Hak Akses</th>
                            <th>Status</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>


                    <tbody>
                        <?php
                        $start = 0;
                        foreach ($user as $user) {
                            
                            ?>
                            <tr>
                                <td><?php echo ++$start ?></td>
                                <td><?php echo $user->user_pn ?></td>
                                <td><?php echo $user->user_email ?></td>
                                <td><?php echo $user->user_nama ?></td>
                                <td><?php echo $user->user_nohp ?></td>
                                <td><?php echo $user->user_akses ?></td>
                                <td><?php echo ($user->user_aktif == 1) ? 'Aktif' : 'Tidak Aktif' ?></td>
                              
                                <td style="text-align:center" width="140px">

                                    <a title='Accept' href=" <?php echo base_url($this->cname . '/action/edit/' . $user->user_id); ?>" class='btn btn-circle btn-sm btn-success'>
                                        <i>Accept</i>
                                    </a>
                              
                                    <a title='Decline' data-href=" <?php echo base_url($this->cname . '/action/delete/' . $user->user_id); ?>" class='btn btn-circle btn-sm btn-warning' data-toggle="modal" data-target=".dismiss-modal">
                                        <i>Decline</i>
                                    </a>
                                      <!--  <a title='Accept' data-href=" <?php echo base_url($this->cname . '/action/accept/' . $user->user_id); ?>" class='btn btn-circle btn-sm btn-success' data-toggle="modal" data-target=".confrim-modal">
                                        <i>Accept</i>
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
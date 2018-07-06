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
                        <div class="col-md-2">

                            <div class="btn-group">
                                <a href="<?php echo base_url($this->cname . '/add') ?>" class="btn btn-small sbold bg-green" > 
                                    <i class="fa fa-plus"></i> Create New Menu
                                </a>
                            </div>
                        </div>
                        <div class="col-md-2">

                            <div class="btn-group">
                                <a href="<?php echo base_url($this->cname . '/ordermenu') ?>" class="btn btn-small sbold bg-orange" > 
                                    <i class="fa fa-reorder"></i> Order Menu
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
                            <th>Name</th>
                            <th>Link</th>
                            <th>Aktif</th>
                            <th>Parent</th>
                            <th>Hak Akses</th>
                            <th>Action</th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php
                        $start = 0;
                        foreach ($menu as $menu) {
                            $active = $menu->is_active == 1 ? 'Aktif' : 'Tidak Aktif';
                            $parent = $menu->is_parent < 1 ? 'Main Menu' : 'Sub Menu'
                            ?>
                            <tr>
                                <td><?php echo ++$start ?></td>
                                <td><?php echo $menu->name ?></td>
                                <td><?php echo $menu->link ?></td>

                                <td><?php echo $active ?></td>
                                <td><?php echo $parent ?></td>
                                <td><?php echo strtolower($menu->hak_akses) ?></td>
                                <td style="text-align:center" width="140px">

                                    <a title='Lihat' href=" <?php echo base_url($this->cname . '/action/view/' . $menu->id); ?>" class='btn btn-circle btn-sm bg-green'>
                                        <i class='fa fa-folder'></i>
                                    </a>
                                    <a title='Edit' href=" <?php echo base_url($this->cname . '/action/edit/' . $menu->id); ?>" class='btn btn-circle btn-sm bg-blue'>
                                        <i class='fa fa-edit'></i>
                                    </a>

                                    <a title='Delete' data-href=" <?php echo base_url($this->cname . '/action/delete/' . $menu->id); ?>" class='btn btn-circle btn-sm bg-red' data-toggle="modal" data-target=".delete-modal">
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
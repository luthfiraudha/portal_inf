<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo $this->menu; ?><small><?php echo $this->fitur; ?></small></h2>
                <div class="clearfix"></div>
            </div>

            <?php cetak_flash_msg(); ?>
            <?php if (!empty($alert['message'])) { ?>
                <div class="alert alert-<?php echo $alert['class']; ?> alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    <?php echo $alert['message']; ?>
                </div>
            <?php } ?>



            <div class="alignleft" style="padding-left: 23%;">
                <!--                    <h4>Informasi</h4>
                                    <ul>
                                        <li>Hak Akses tidak dapat dihapus.</li>
                                        <li>Beberapa Hak Akses tidak dapat diubah.</li>
                                    </ul>-->
            </div>


            <div class="x_content">
                <br />

                <form  method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                    <input type="hidden" name="user_id" value="<?php echo get_session('user_id'); ?>">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Old Password
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="password" class="form-control" placeholder="Old Password" name="oldpassword" required>
                        </div>
                    </div>
                    <div class="form-group passfield">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Password
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="password" class="form-control" placeholder="Password" name="password" required>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group passfield">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Confrim Password
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="password" class="form-control" placeholder="Confrim Password" name="repassword" onkeyup="checkconfirm()" required>
                            <span class="help-block confirm">Confirm Password must be matched with Password </span>
                        </div>
                    </div>

                    <div class="ln_solid">

                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <a class="btn btn-sm bg-blue" href="<?php echo base_url($this->cname); ?>"><i class="fa fa-arrow-left"></i> Kembali</a>

                            <button type="submit" class="btn btn-sm btn-primary popconfirm-update" data-toggle='confirmation'><i class="fa fa-save"></i> Simpan</button>


                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
    function checkconfirm() {
        var pass = $('input[name=password]').val();
        var repass = $('input[name=repassword]').val();
        if (pass == repass) {
            $('.form-group.passfield').removeClass('has-error').addClass('has-success');
            $('.confirm').text('Confirm Password has matched with Password');
        } else if (pass != repass) {
            $('.form-group.passfield').removeClass('has-success').addClass('has-error');
            $('.confirm').text('Confirm Password has not matched with Password');
        }
    }
    

</script>
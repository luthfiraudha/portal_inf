<!-- Bootstrap -->
<link href="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="<?php echo base_url(); ?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<!-- iCheck -->
<link href="<?php echo base_url(); ?>assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/jquery-ui/jquery-ui.css">





<?php
foreach ($plugins as $key => $value) {
        if (file_exists(APPPATH."views/template/top_resource/{$value}.php"))
                $this->load->view('template/top_resource/'.$value);
}
?>


<!-- Custom Theme Style -->
<link href="<?php echo base_url(); ?>assets/build/css/custom.css" rel="stylesheet">
<script>

</script>
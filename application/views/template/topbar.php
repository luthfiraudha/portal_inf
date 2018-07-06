<div class="top_nav">
                    <div class="nav_menu">
                        <nav>
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>

                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <?php echo $this->active_user; ?>
                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                                        <li><a href="<?php echo base_url('dashboard/change_password');?>"> Change Password</a></li>
                                        
                                       
                                        <li><a href="<?php echo base_url('auth/logout');?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                                    </ul>
                                </li>
                                <li role="presentation" class="dropdown">
                                   <!--  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-warning"></i>
                                        <?php 
                                         $notif_vendor = 0; 

                                         if(get_session("user_akses")=='superadmin' || get_session("user_akses")=='signer')
                                         {
                                         $notif_user = 0; 
                                         }else{
                                         $notif_user = 0;
                                         }

                                         $notif_issue = 0; 

                                         $total = $notif_user+$notif_vendor+$notif_issue;
                                             ?>
                                        <span class="badge bg-red"><?php echo $total;?></span>
                                    </a> -->
                                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                                        <?php if($notif_vendor > 0){?>
                                        <li><a href="<?php echo base_url('reminder_vendor');?>"> Reminder Vendor <span class="badge bg-red right"><?php echo $notif_vendor;?></span></a></li>
                                        <?php } ?>

                                        
                                        <?php if($notif_user > 0){?>
                                        <li><a href="<?php echo base_url('pengajuan_user');?>"> Pengajuan User <span class="badge bg-red right"><?php echo $notif_user;?></span></a></li>
                                         <?php } ?>

                                         
                                         <?php if($notif_issue > 0){?>
                                        <li><a href="<?php echo base_url('reminder_issue');?>"> Reminder Issue <span class="badge bg-red right"><?php echo $notif_issue;?></span></a></li>
                                         <?php } ?>
                                       
                                        
                                    </ul>
                                </li>

                                
                            </ul>
                        </nav>
                    </div>
                </div>
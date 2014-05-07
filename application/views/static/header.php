<?php
/**
 * Please do not align this code automatically
 */
    $this->output->enable_profiler();
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<script type="text/javascript" src='/PSA/site/js/floating-1.12.js'>  
</script> 
<script type="text/javascript">  
    floatingMenu.add('cart',
        {  
            // Represents distance from left or right browser window  
            // border depending upon property used. Only one should be  
            // specified.  
//             targetLeft: 2500,  
            targetRight: 75,  
  
            // Represents distance from top or bottom browser window  
            // border depending upon property used. Only one should be  
            // specified.  
            targetTop: 100,  
//             targetBottom: 0,  
  
            // Uncomment one of those if you need centering on  
            // X- or Y- axis.  
//             centerX: true,  
            // centerY: true,  
  
            // Remove this one if you don't want snap effect  
//            snap: true  
        });  
</script>  
    <html>
        <head>
            <title>
            <?php
                // This variable is used for setting the page title dynamically
                echo $title;
            ?>
            </title>

            <meta charset="utf-8">

            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <link rel="stylesheet" type="text/css"
            	href="<?php echo base_url('css/kube.css') ?>" />
            <link rel="stylesheet" type="text/css"
            	href="<?php echo base_url('css/master.css') ?>" />

            <script type="text/javascript"
            	src="/PSA/site/js/jquery.min.js"></script>
            <script type="text/javascript"
            	src="<?php echo base_url('js/scripts.js') ?>"></script>
            <?php
            if(isset($scripts) && is_array($scripts)) {
                foreach ($scripts as $script) {
                    if(is_string($script)) { ?>
                        <script type="text/javascript"
                        src="<?php echo base_url('js/' . $script) ?>"></script><?php
                    }
                }
            } ?>

            <!--[if lt IE 9]>
                    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
                    <![endif]-->

        </head>
        <body>
            <header>
                <div id="top-bar">
                    <div id="top-bar-wrapper"><?php

                        $left_buttons = array(
                            array(
                                "title" => "Home",
                                "link" => ""
                            )
                        );
                        $right_buttons = array();

                        // Add buttons if conditions are met
                        if($this->User_model->is_logged_in()) {
                            array_push($right_buttons, array(
                                "title" => "Log out",
                                "link" => "user/logout"
                            ));
                            array_push($right_buttons, array(
                                "title" => "View profile",
                                "link" => 'user/view_profile/' . $this->User_model->get_username()
                            ));
                        } else {
                            array_push($right_buttons, array(
                                "title" => "Register",
                                "link" => "user/register"
                            ));
                            array_push($right_buttons, array(
                                "title" => "Log in",
                                "link" => "user/login"
                            ));
                        }

                        if($this->User_model->is_user()) {
                            
                            array_push($right_buttons, array(
                                "title" => "Choose a restaurant",
                                "link" => "places/select/"
                                //. $this->session->userdata('nickname')
                            ));
                        } else if ($this->User_model->is_worker()) {
                            array_push($right_buttons, array(
                                "title" => "View received orders",
                                "link" => "orders/accept"
                            ));
                        } else
                        // Check if manager
                        // This function checks if user is logged in too
                        if($this->User_model->is_manager()) {
                            array_push($right_buttons, array(
                                "title" => "Manager's panel",
                                "link" => "manager/panel"
                            ));
                        }

                        // Echo all the given arrays
                        // Left first
                        foreach ($left_buttons as $button) {
                            ?><a 
                                href="<?php echo base_url($button["link"]) ?>"
                                class="left top-menu-item"><?php 
                                echo $button["title"];
                            ?></a><?php
                        }
                        // Right one
                        foreach ($right_buttons as $button) {
                            ?><a 
                                href="<?php echo base_url($button["link"]) ?>"
                                class="right top-menu-item"><?php 
                                echo $button["title"];
                            ?></a><?php
                        } ?>
                    </div>
                </div>
            </header>

            <div id="page">
                <div id="breadcrumb" class="line-sep-bottom">
                    <?php echo set_breadcrumb();
                    ?>
                </div>

                <div class="make-some-space "></div>
                    <div id="main-content">
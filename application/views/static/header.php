<?php
/**
 * Please do not align this code automatically
 */
    $this->output->enable_profiler();
?>
<!DOCTYPE html>
<script type="text/javascript" src='/PSA/site/js/floating-1.12.js'>  
</script> 
<script type="text/javascript">  
    floatingMenu.add('cart',
        {  
            // Represents distance from left or right browser window  
            // border depending upon property used. Only one should be  
            // specified.  
//             targetLeft: 2500,  
            targetRight: 0,  
  
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
            snap: true  
        });  
</script>  
    <html>
        <head>
            <title><?php
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
            	src="http://code.jquery.com/jquery.min.js"></script>
            <script type="text/javascript"
            	src="<?php echo base_url('js/scripts.js') ?>"></script>
            
            <!--[if lt IE 9]>
                    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
                    <![endif]-->
            
        </head>
        <body>
        	<header>
        		<div id="top-bar">
        			<div id="top-bar-wrapper">
        			
        				<a href="<?php echo base_url() ?>" 
        				    class="left top-menu-item">Home</a>
        			
        				<?php
        				if ($this->User_model->is_logged_in()) {
        				    ?>
        			
        				<a href="<?php echo base_url('user/logout'); ?>"
        					class="right top-menu-item">Log out</a>
        					
        				<a href="<?php echo base_url('user/view_profile/' .
                                $this->session->userdata('nickname')); ?>"
        				    class="right top-menu-item">View profile</a>
        				
                        <a href="<?php echo base_url('places/select/' .
                                $this->session->userdata('nickname')); ?>"
                            class="right top-menu-item">Choose a restaurant</a>
                        

        				<?php 
        				} else { 
        				    ?>
        				
                        <a href="<?php echo base_url('user/register'); ?>" 
                            class="right top-menu-item">Register</a>
        				
        				<a href="<?php echo base_url('user/login'); ?>"
                            class="right top-menu-item">Log in</a>
                            
        				<?php
        				}
        				?>
        			</div>
        		</div>
        	</header>
        
        	<div id="page">
                    <div id="breadcrumb" class="line-sep-bottom">
                        <?php echo set_breadcrumb();
                        ?>
                    </div>

                    <div class="make-some-space ">

                    </div>
        		<div class="fourfifth left" id="main-content">
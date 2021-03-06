<?php $this->load->view('partials/top'); ?>

<!-- Page content -->
<div id="page-content" class="block">

    <!-- Blank Header -->
    <div class="block-header">
        <!-- If you do not want a link in the header, instead of .header-title-link you can use a div with the class .header-section -->
        <a href="" class="header-title-link">
            <h1>
                <i class="glyphicon-brush animation-expandUp"></i> <?php echo $page_title; ?><br>
				<small>A clean page to help you start!</small>
            </h1>
        </a>
    </div>

    <ul class="breadcrumb breadcrumb-top">
        <li><i class="fa fa-file-o"></i></li>
        <li>Profile</li>
        <li><a href="">Manage</a></li>
    </ul>
    <!-- END Blank Header -->

    <!-- Block -->
    <div class="block">

        <!-- Block Title -->
        <div class="block-title">
			<h2><?php echo $page_title; ?></h2>
		</div>
        <!-- END Block Title -->

        <!-- Block Content -->
        <p>

			<!-- For Yoteyote notification messages. -->
			<div id="notifications">

			</div>

			<!-- Yoteyote content id for yoteyote main.js -->
			<div id="content">

				<?php
			        if ( ! isset($view_file))
					{
		    	        $view_file = '';
		        	}

			        if ( ! isset($module))
					{
			            $module = $this->uri->segment(1);
		    	    }

			        if (($view_file != '') && ($module != ''))
					{
			            $path = $module.'/'.$view_file;
		    	        $this->load->view($path);
		        	}
					else
					{
			    		echo nl2br($page_content);
		    	    }
		        ?>

			</div>

		</p>
        <!-- END Block Content -->

    </div>
    <!-- END Block -->

</div>
<!-- END Page Content -->

<?php $this->load->view('partials/footer'); ?>

<!-- Addon Javascript code goe's here! -->

<?php $this->load->view('partials/bottom'); ?>
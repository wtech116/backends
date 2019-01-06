<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header page-header-default">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Videos</span></h4>
						</div>
						<div class="heading-elements">						
							<img src="<?php echo base_url(); ?>uploadImages/admin/title.png" alt="" style="width:70px; height:30px; margin-right:20px;">	
						</div>
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><i class="icon-home2 position-left"></i> Manage</li>
							<li>Videos</li>
							<li><?php echo $day; ?></li>
						</ul>
						<ul class="breadcrumb-elements">
							<li><a href="<?php echo base_url().'index.php/services/go_add_video'; ?>"><i class="icon-pencil4 position-left"></i> New</a></li>
							
						</ul>
						
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					<!-- Page length options -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Videos</h5>
							<?php if ($error != "") { ?>
								<div class="alert alert-primary no-border">
									<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
									<span class="text-semibold"><?php echo $error; ?></span>
						    	</div>
							<?php } ?>
							
							
						</div>

						<table class="table datatable-show-all">
							<thead>
								<tr>
									<th>No</th>
									<th>Player</th>
									<th>Name</th>
									<th>Description</th>
									<th>Url</th>
									<th style="display:none;"></th>
									<th>Price(USD)</th>
									<th class="text-center">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php 
                                	for($i = 0; $i < count($data); $i++) {
										?><tr>
										<td ><?php echo $i+1; ?></td>												
										<td>
											<video src="<?php echo $data[$i]['download']; ?>" style="width: 200px; height: 180px;" controls >HTML5 Video is required.</video>
										</td>
										<td ><?php echo $data[$i]['name']; ?></td>
										<td ><?php echo $data[$i]['description']; ?></td>
										<td ><?php echo $data[$i]['url']; ?></td>
										<th style="display:none;"></th>
										<td ><?php echo $data[$i]['price']; ?></td>
										<td><a href="<?php echo base_url().'index.php/services/delete_video/'.$data[$i]['id'].'/'.$day; ?>" class="btn btn-default" >Remove <i class="icon-cancel-circle2 position-right"></i></a></td>
										</tr>
										<?php
									} 
                            	?>
								
							</tbody>
						</table>
					</div>
					<!-- /page length options -->
				</div>
				<!-- /content area -->
			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->
</body>

</html>

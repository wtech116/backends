<link href="<?php echo base_url(); ?>assets/loader/dist/loading.min.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url(); ?>assets/loader/dist/jquery.loading.min.js"></script>

<style type="text/css">
input[type="file"] {
    display: none;
}
.custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
}
</style>

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header page-header-default">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Add Video</span></h4>
						</div>
						<div class="heading-elements">						
							<img src="<?php echo base_url(); ?>uploadImages/admin/title.png" alt="" style="width:70px; height:30px; margin-right:20px;">	
						</div>
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><i class="icon-home2 position-left"></i> Manage</li>
							<li>Add New Video</li>
						</ul>
					</div>
				</div>
					<!-- /header -->

						<?php if ($error != "") { ?>
							<div class="alert <?php if(strpos($error, 'Successfully') !== false) echo 'alert-primary'; else echo 'alert-danger'; ?> no-border">
								<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
								<span class="text-semibold"><?php echo $error; ?></span>
					    	</div>
						<?php } ?>

				<!-- Content area -->
				<div class="content">

					<!-- User profile -->
					<div class="row">
						<div class="col-lg-12">
							<div class="tabbable">
								<div class="tab-content">

									<div class="tab-pane fade active in" id="settings">

										<!-- Profile info -->
										<div class="panel panel-flat col-md-12">
											<div class="panel-heading">
												<h6 class="panel-title">Video information</h6>
												
											</div>

											<div class="panel-body">
												<form action="<?php echo base_url().'index.php/services/add_video'; ?>" method="POST">
													<div class="form-group">
														<div class="row">
															<div class="col-md-6">
																<label>Name*</label>
																<input type="text" name="name" value="<?php echo $data['name']; ?>" class="form-control" placeholder="example video" required>
																<br>
																<label>Public Url (from Google Drive)*</label>
																<input type="text" name="url" value="<?php echo $data['url']; ?>" class="form-control" placeholder="https://drive.google.com/open?id=xxx" required>
																<br>
																<label>Price*</label>
																<select name="price" data-placeholder="Select price..." class="select select2-hidden-accessible" tabindex="-1" aria-hidden="true">
																	<option></option>
																		<option value="0" <?php if($data['price'] == '0'){ ?> selected="selected" <?php } ?>>Free</option>
																		<option value="0.99" <?php if($data['price'] == '0.99'){ ?> selected="selected" <?php } ?>>0.99USD</option>
																		<option value="1.99" <?php if($data['price'] == '1.99'){ ?> selected="selected" <?php } ?>>1.99USD</option>
																		<option value="2.99" <?php if($data['price'] == '2.99'){ ?> selected="selected" <?php } ?>>2.99USD</option>
																</select>
															</div>
															<div class="col-md-6">
																<label>Description*</label>
																<textarea name="description" value="" class="form-control" rows="10" required><?php echo $data['description']; ?></textarea>
															</div>
														</div>
													</div>

							                        <div class="text-right">
							                        	<button type="submit" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i></button>
							                        </div>
												</form>
											</div>
										</div>
										<!-- /profile info -->
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /user profile -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

		</div>

	</div>
	<!-- /page container -->
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pages/form_inputs.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pages/form_select2.js"></script>
</body>
</html>

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
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Profile</span></h4>
						</div>
						<div class="heading-elements">						
							<img src="<?php echo base_url(); ?>uploadImages/admin/title.png" alt="" style="width:70px; height:30px; margin-right:20px;">	
						</div>
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><i class="icon-home2 position-left"></i> Manage</li>
							<li>Profile</li>
							
						</ul>
					</div>
				</div>
					<!-- /header -->

						<?php if ($error != "") { ?>
							<div class="alert <?php if(strpos($error, 'uccessfully') !== false) echo 'alert-primary'; else echo 'alert-danger'; ?> no-border">
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
										<div class="panel panel-flat col-md-6">
											<div class="panel-heading">
												<h6 class="panel-title">Profile information</h6>
												
											</div>

											<div class="panel-body">
												<form action="<?php echo base_url().'index.php/admin/update_admin'; ?>" method="POST">
													<div class="form-group">
														<div class="row">
															<div class="col-md-6">
																<label>Image*</label>
																<br>
																<div id="admin_photo" class="img-circle" style="width:150px; height:150px;background-position: 50% 50%; background-size:cover; background-image: url('<?php if($_SESSION['biper']['photo'] == '') {echo base_url().'uploadImages/admin/user.png';} else echo base_url().'uploadImages/admin/'.$_SESSION['biper']['photo'].'?80172489074'; ?>');"></div>
																
																<br><br>
																<label for="fileInput" class="custom-file-upload"><i class="icon-upload"></i>&nbsp; Image Upload </label>&nbsp; <label id="label_image"></label>
																<input type="file" id="fileInput" name="fileInput" accept="image/*"/>
                                            					<input type="hidden" id="photo" name="photo" value="<?php echo $_SESSION['biper']['photo']; ?>" required/>
															</div>
															
														</div>
													</div>
													<div class="form-group">
														<div class="row">
															<div class="col-md-12">
																<label>Name*</label>
																<input type="text" name="username" value="<?php echo $_SESSION['biper']['username']; ?>" class="form-control">
															</div>
															
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-12">
																<label>Email*</label>
																<input type="text" name="email" value="<?php echo $_SESSION['biper']['email']; ?>" class="form-control">
															</div>
															
														</div>
													</div>
													<div class="form-group">
														<div class="row">
															<div class="col-md-12">
																<label>Password*</label>
																<input type="text" name="password" value="<?php echo $_SESSION['biper']['password']; ?>" class="form-control">
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
	<!-- /page container -->
<script>
	$(function(){
			$("input[type=file]").on('change',function(){	    
			var filename = $(this).val().split('\\').pop();
			var fd = new FormData();
			var _this = $(this);
			if (!this.files[0]) {return;};
	        fd.append( "file", this.files[0]);
	        
	        $.ajax({
	            url: "<?php echo base_url().'index.php/admin/image_upload' ?>",
	            type: 'POST',
	            cache: false,
	            data: fd,
	            processData: false,
	            contentType: false,
	            beforeSend: function () {
	            },
	            success: function (result) { 
	            
	            	if (result != 400) {
	            		var path = "<?php echo base_url().'uploadImages/admin/'; ?>" + result;
	            		$('#admin_photo').css('background-image', "url("+path+"?"+Math.random()+")");
	            		$('#photo').val(result);
	            		$('#label_image').text(filename);
	            	} else {
	            		alert("upload failed!");
	            	}
	            },
	            complete: function (result) {
	            },
	            error: function (result) {
	            }
	        });	    
	
		});
	});
	</script>
</body>
</html>

<?php $__env->startSection('title',' Manage'); ?>
<?php $__env->startSection('content'); ?>
<div class="col-xl-9 col-lg-8  col-md-12">

	<div class="card ctm-border-radius shadow-sm grow">
		<div class="card-header">
			<h4 class="card-title mb-0 d-inline-block"><?php echo e($employee['roles']['name']); ?></h4>
		</div>
		<div class="card-body">
			<a href="javascript:void(0)" class="avatar">
												<img class="profile_img" alt="avatar image" src="<?php if($employee['profile_image']): ?> <?php echo e(url('public/profile/'.$employee['profile_image'])); ?> <?php else: ?> <?php echo e(url('public/assets/img/profiles/profile.png')); ?> <?php endif; ?>" class="img-fluid">
												<span class="profile_name"><?php echo e(substr($employee['name'], 0, 2)); ?></span>
											</a>
		</div>
	</div>
	<div class="quicklink-sidebar-menu ctm-border-radius shadow-sm grow bg-white card">
		<div class="card-body">
			<div class="list-group list-group-horizontal-lg" id="v-pills-tab" role="tablist">
				<a class=" active list-group-item" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Manage Permission</a>
				<!--<a class="list-group-item" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Manage Time Off</a>-->
				<!--<a class="list-group-item" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Manage Salaries</a>-->
				<!--<a class="list-group-item" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Manage All</a>-->
				<!--<a class="list-group-item" id="v-pills-settings-tab1" data-toggle="pill" href="#v-pills-settings1" role="tab" aria-controls="v-pills-settings1" aria-selected="false">Manage Account Settings</a>-->
			</div>
		</div>
	</div>
	<div class="card ctm-border-radius shadow-sm grow">
		<div class="card-body">
			<div class="tab-content" id="v-pills-tabContent">

				<!-- Tab1-->
				<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
					<div class="table-responsive">
						<table class="table admin-table">
							<thead>
								<tr>
									<th class="pt-0">Rule Description</th>
									<th class="pt-0">Allow</th>
									<!-- <th class="pt-0">Manage</th> -->
								</tr>
							</thead>
							<tbody>
								<?php $__currentLoopData = $side_bar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<td>
										<div>
											<h6 class="mb-0"><?php echo e($value['name']); ?></h6>
											<p class="ctm-text-sm"><?php echo e($value['description']); ?></p>
										</div>
									</td>
									<td>
										<div class="custom-control custom-switch">
											<input type="checkbox" class="custom-control-input permission" id="view<?php echo e($value['id']); ?>" data-emp_id=<?php echo e($emp_id); ?> value="<?php echo e(isset($value['sidebar_permission'])?$value['id']:$value['id']); ?>" <?php echo e(isset($value['sidebar_permission'])?'checked':''); ?>>
											<label class="custom-control-label" for="view<?php echo e($value['id']); ?>"></label>
										</div>
									</td>
									<!-- <td>
																<div class="custom-control custom-switch">
																	<input type="checkbox" class="custom-control-input permission" id="manage<?php echo e($value['id']); ?>"  data-emp_id=<?php echo e($emp_id); ?> onclick="confirm('Do you want to change the Permission?')"  value="<?php echo e(isset($value['sidebar_permission'])?$value['id']:$value['id']); ?>" <?php echo e(isset($value['sidebar_permission'])?'checked':''); ?>>
																	<label class="custom-control-label" for="manage<?php echo e($value['id']); ?>"></label>
																</div>
															</td> -->
								</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php $__currentLoopData = $other_permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<td>
										<div>
											<h6 class="mb-0"><?php echo e($value['name']); ?></h6>
											<p class="ctm-text-sm"><?php echo e($value['description']); ?> </p>
										</div>
									</td>
									<td>
										<div class="custom-control custom-switch">
											<input type="checkbox" class="custom-control-input permission" id="view<?php echo e($value['id']); ?>" data-emp_id=<?php echo e($emp_id); ?> onclick="confirm('Do you want to change the Permission?')" value="<?php echo e(isset($value['sidebar_permission'])?$value['id']:$value['id']); ?>" <?php echo e(isset($value['sidebar_permission'])?'checked':''); ?>>
											<label class="custom-control-label" for="view<?php echo e($value['id']); ?>"></label>
										</div>
									</td>
									<!-- <td>
																<div class="custom-control custom-switch">
																	<input type="checkbox" class="custom-control-input" id="switch4" checked>
																	<label class="custom-control-label" for="switch4"></label>
																</div>
															</td> -->
								</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- /Tab1-->

				<!-- Tab2-->
				<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
					<div class="table-responsive">
						<table class="table admin-table">
							<thead>
								<tr>
									<th class="pt-0">Rule Description</th>
									<th class="pt-0">Allow?</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<div>
											<h6 class="mb-0">Approve or Deny Time Off</h6>
											<p class="ctm-text-sm">Manage time off requests for anyone in their team. </p>
										</div>
									</td>
									<td>
										<div class="custom-control custom-switch">
											<input type="checkbox" class="custom-control-input" id="switch18" checked>
											<label class="custom-control-label" for="switch18"></label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div>
											<h6 class="mb-0">Book Time Off Behalf</h6>
											<span>Book time off for anyone in their team </span>
										</div>
									</td>
									<td>
										<div class="custom-control custom-switch">
											<input type="checkbox" class="custom-control-input" id="switch19" checked>
											<label class="custom-control-label" for="switch19"></label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div>
											<h6 class="mb-0">Manage Allowances</h6>
											<span>Adjust the holiday allowance for people in their team </span>
										</div>
									</td>
									<td>
										<div class="custom-control custom-switch">
											<input type="checkbox" class="custom-control-input" id="switch20" checked>
											<label class="custom-control-label" for="switch20"></label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div>
											<h6 class="mb-0">Manage Time Off settings for The Company</h6>
											<span>
												Manage custom leave types, roll over, company holidays and restricted days, the company working week, and your company holiday allowance.
											</span>
										</div>
									</td>
									<td>
										<div class="custom-control custom-switch">
											<input type="checkbox" class="custom-control-input" id="switch21" checked>
											<label class="custom-control-label" for="switch21"></label>
										</div>
									</td>
								</tr>
								<tr>
									<td class="pb-0">
										<div>
											<h6 class="mb-0">Manage Working From Home</h6>
											<p class="ctm-text-sm">
												Create, edit, or delete working from home requests for people in their team
											</p>
										</div>
									</td>
									<td class="pb-0">
										<div class="custom-control custom-switch">
											<input type="checkbox" class="custom-control-input" id="switch22" checked>
											<label class="custom-control-label" for="switch22"></label>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<!-- /Tab2 -->

				<!-- Tab3 -->
				<div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
					<div class="table-responsive">
						<table class="table admin-table">
							<thead>
								<tr>
									<th class="pt-0">Rule Description</th>
									<th class="pt-0">View</th>
									<th class="pt-0">Manage</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="pb-0">
										<div>
											<h6 class="mb-0">Salary</h6>
											<p class="ctm-text-sm">View or manage salaries </p>
										</div>
									</td>
									<td class="pb-0">
										<div class="custom-control custom-switch">
											<input type="checkbox" class="custom-control-input" id="switch23" checked>
											<label class="custom-control-label" for="switch23"></label>
										</div>
									</td>
									<td class="pb-0">
										<div class="custom-control custom-switch">
											<input type="checkbox" class="custom-control-input" id="switch24" checked>
											<label class="custom-control-label" for="switch24"></label>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<!-- /Tab3 -->

				<!-- Tab4 -->
				<div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
					<div class="table-responsive">
						<table class="table admin-table">
							<thead>
								<tr>
									<th class="pt-0">Rule Description</th>
									<th class="pt-0">Allow?</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<div>
											<h6 class="mb-0">Invite People To Their Team</h6>
											<p class="ctm-text-sm">View or manage future starters at your company that will join their team </p>
										</div>
									</td>
									<td>
										<div class="custom-control custom-switch">
											<input type="checkbox" class="custom-control-input" id="switch25" checked>
											<label class="custom-control-label" for="switch25"></label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div>
											<h6 class="mb-0">Off Board Everyone Else</h6>
											<p class="ctm-text-sm">Archive everyone else and revoke their access</p>
										</div>
									</td>
									<td>
										<div class="custom-control custom-switch">
											<input type="checkbox" class="custom-control-input" id="switch26" checked>
											<label class="custom-control-label" for="switch26"></label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div>
											<h6 class="mb-0">Manage Roles</h6>
											<p class="ctm-text-sm">Edit and assign Roles to anyone in the company</p>
										</div>
									</td>
									<td>
										<div class="custom-control custom-switch">
											<input type="checkbox" class="custom-control-input" id="switch27" checked>
											<label class="custom-control-label" for="switch27"></label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div>
											<h6 class="mb-0">Create Teams</h6>
											<p class="ctm-text-sm">Create new teams </p>
										</div>
									</td>
									<td>
										<div class="custom-control custom-switch">
											<input type="checkbox" class="custom-control-input" id="switch28" checked>
											<label class="custom-control-label" for="switch28"></label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div>
											<h6 class="mb-0">Edit Team Names</h6>
											<p class="ctm-text-sm">Can edit team name </p>
										</div>
									</td>
									<td>
										<div class="custom-control custom-switch">
											<input type="checkbox" class="custom-control-input" id="switch29" checked>
											<label class="custom-control-label" for="switch29"></label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div>
											<h6 class="mb-0">Edit Team Members</h6>
											<p class="ctm-text-sm">Can move people in or out of their team</p>
										</div>
									</td>
									<td>
										<div class="custom-control custom-switch">
											<input type="checkbox" class="custom-control-input" id="switch30" checked>
											<label class="custom-control-label" for="switch30"></label>
										</div>
									</td>
								</tr>
								<tr>
									<td class="pb-0">
										<div>
											<h6 class="mb-0">Manage Offices</h6>
											<p class="ctm-text-sm">Create and edit all offices</p>
										</div>
									</td>
									<td class="pb-0">
										<div class="custom-control custom-switch">
											<input type="checkbox" class="custom-control-input" id="switch31" checked>
											<label class="custom-control-label" for="switch31"></label>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<!-- /Tab4 -->

				<!-- Tab5 -->
				<div class="tab-pane fade" id="v-pills-settings1" role="tabpanel" aria-labelledby="v-pills-settings-tab1">
					<div class="table-responsive">
						<table class="table admin-table">
							<thead>
								<tr>
									<th class="pt-0">Rule Description</th>
									<th class="pt-0">Allow?</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<div>
											<h6 class="mb-0">Customize The Company Branding</h6>
											<p class="ctm-text-sm">Set your company name, logo, mission, and cover photo</p>
										</div>
									</td>
									<td>
										<div class="custom-control custom-switch">
											<input type="checkbox" class="custom-control-input" id="switch32" checked>
											<label class="custom-control-label" for="switch32"></label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div>
											<h6 class="mb-0">On-boarding Slides</h6>
											<p class="ctm-text-sm">
												Create, edit, and delete the slides shown to new starters when they first join .
											</p>
										</div>
									</td>
									<td>
										<div class="custom-control custom-switch">
											<input type="checkbox" class="custom-control-input" id="switch33" checked>
											<label class="custom-control-label" for="switch33"></label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div>
											<h6 class="mb-0">Manage All Company Tools</h6>
											<p class="ctm-text-sm">
												Add, update and remove tools from the company tools section
											</p>
										</div>
									</td>
									<td>
										<div class="custom-control custom-switch">
											<input type="checkbox" class="custom-control-input" id="switch34" checked>
											<label class="custom-control-label" for="switch34"></label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div>
											<h6 class="mb-0">Slack Integration</h6>
											<p class="ctm-text-sm">
												Manage the Slack integration, including automating slack accounts for new starters, and customizing notifications
											</p>
										</div>
									</td>
									<td>
										<div class="custom-control custom-switch">
											<input type="checkbox" class="custom-control-input" id="switch35" checked>
											<label class="custom-control-label" for="switch35"></label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div>
											<h6 class="mb-0">Time Off Calendar Integration</h6>
											<p class="ctm-text-sm">Ability to disable the calendar integration for everyone </p>
										</div>
									</td>
									<td>
										<div class="custom-control custom-switch">
											<input type="checkbox" class="custom-control-input" id="switch36" checked>
											<label class="custom-control-label" for="switch36"></label>
										</div>
									</td>
								</tr>
								<tr>
									<td class="pb-0">
										<div>
											<h6 class="mb-0">Manage Account Subscription</h6>
											<p class="ctm-text-sm">
												Can update card details and see all invoices
											</p>
										</div>
									</td>
									<td class="pb-0">
										<div class="custom-control custom-switch">
											<input type="checkbox" class="custom-control-input" id="switch37" checked>
											<label class="custom-control-label" for="switch37"></label>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<!-- /Tab5 -->

			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('javascript'); ?>
<script>
	$(document).ready(function() {
		$(document).on('click', '.permission', function(e) {
			if(confirm('Do you want to change the Permission?')){
			e.preventDefault();
			var sidebar_id = $(this).val();
			var emp_id = $(this).data('emp_id');
			$.ajax({
				Type: "POST",
				url: '<?php echo e(url("/update/permission")); ?>',
				dataType: 'json',
				cache: true,
				data: {
					emp_id: emp_id,
					sidebar_id: sidebar_id
				},
				success: function(response) {
					if (response.status == 400) {
						toastr.error(response.error);

					} else {
						location.reload();
						toastr.success(response.success);

					}
				}
			})
			}else{
				if($(this).is(':checked')){
					$(this).prop("checked",false);
                  }else{
					$(this).prop("checked",true);
				  }
			}
		});

	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\empisee\resources\views/viewpermission.blade.php ENDPATH**/ ?>
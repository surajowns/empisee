
<?php $__env->startSection('title','Employee Salaries'); ?>
<?php $__env->startSection('content'); ?>
<?php
$id = Auth::user()->id;
$permission = App\SidebarPermission::with(['sidebar' => function ($query) {
	$query->where('parent_id', '!=', 0)->get();
}])->where('emp_id', $id)->whereIn('sidebar_id', [24])->get()->toArray();
//    dd($permission)
?>
<div class="col-xl-9 col-lg-8  col-md-12">
	<div class="card shadow-sm ctm-border-radius grow">
		<div class="card-header d-flex align-items-center justify-content-between">
			<h4 class="card-title mb-0 d-inline-block">Employee Salaries</h4>

			<!-- <a href="#" class="btn btn-theme button-1 ctm-border-radius text-white float-right" data-toggle="modal" data-target="#add-information"><span></span> <span class="fa fa-plus"></span>Salary</a> -->
		</div>
		<div class="card-header d-flex align-items-center justify-content-between">
		<form class="input-group" action="<?php echo e(url('salary_details_report')); ?>" method="get" >
			<div class="container row">
			<div class="input-group col-sm-6">
				<select class="form-control select select_employee" id="emp_id" name="emp_id[]" multiple="multiple">
					<!--<option value="">Select Employee </option>-->
					<?php $__currentLoopData = $employee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($value['id']); ?>"> <?php echo e(strtoupper($value['name'])); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
			</div>
			
			 <div class="input-group col-sm-6">
				<button class="btn btn-theme button-1 ctm-border-radius text-white float-right" id=""><span></span> <span class="lnr lnr-paperclip"></span> Export Reports</button>
			</div>
			</div>
          </form>
		  </div>
		<div class="card-body align-center">
			<div class="tab-content" id="v-pills-tabContent">

				<div class="employee-office-table">
					<div class="table-responsive">
						<table class="table custom-table table-hover ">
							<thead>
								<tr>

									<th>Name</th>
									<th>Gross Salary</th>
									<th>Basic Salary</th>
									<th>HRA</th>
									<th>Medical Allowance</th>
									<th>Conveyance</th>
									<th>Other Allowance</th>
									<!-- <th>Mobile Expe	nses</th> -->
									<th>TDS</th>
									<th>PF</th>
									<th>ESIC</th>
									<th>Remarks</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="table_data">
								<?php $__currentLoopData = $emp_assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
                                   <?php if($value['employee']['status']==1): ?>
									<td><?php echo e($value['employee']['name']); ?></td>
									<td><?php echo e($value->emp_salary); ?></td>
									<td><?php echo e($value->basic_salary); ?></td>
									<td><?php echo e($value->hra); ?></td>
									<td><?php echo e($value->medical_allowance); ?></td>
									<td><?php echo e($value->conveyance); ?></td>
									<td><?php echo e($value->mix_allowance); ?></td>
									<!-- <td><?php echo e($value->mobile_expenses); ?></td> -->
									<td><?php echo e($value->tds); ?></td>
									<td><?php echo e($value->pf); ?></td>
									<td><?php echo e($value->esic); ?></td>
									<td><?php echo e($value->remarks); ?></td>

									<td>
										<a href="javascript:void(0);" class="btn btn-sm btn-outline-success edit_assets" data-toggle="modal" data-id="<?php echo e($value->id); ?>" data-target="#edit-information<?php echo e($value->id); ?>">
											<span class="lnr lnr-pencil"></span>Edit
										</a>
										<!-- <a href="javascript:void(0);" class="btn btn-sm btn-outline-danger delete-assets"  data-id="<?php echo e($value->id); ?>">
												<span class="lnr lnr-trash"></span>Delete
											</a> -->
									</td>
								</tr>
								<?php endif; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>

						</table>
						<?php echo e($emp_assets->links()); ?>

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- add Model -->
	<div class="modal fade" id="add-information" role="document">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<!-- Modal body -->
				<div class="modal-body style-add-modal">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title mb-3"> Employee Salary</h4>
					<form method="POST" id="company_form">
						<div class="form-group">
							<div class="input-group mb-3">
								<select class="form-control select" id="emp_id" name="emp_id">
									<option value="">Select Employee </option>
									<?php $__currentLoopData = $employee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($value->id); ?>"> <?php echo e(strtoupper($value->name)); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<input class="form-control" type="number" name="basic_salary" min="1" placeholder="Basic Salary">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<input class="form-control" type="number" name="hra" min="1" placeholder="HRA">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<input class="form-control" type="number" name="mix_allowance" min="1" placeholder="Mix Allowance">
							</div>
						</div>
						<!-- <div class="form-group">
							<div class="input-group mb-3">
								<input class="form-control" type="number" name="mobile_expenses" min="1" placeholder="Mobile Expenses">
							</div>
						</div> -->
						<div class="form-group">
							<div class="input-group mb-3">
								<input class="form-control" type="number" name="tds" min="1" placeholder="TDS">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<input class="form-control" type="number" name="pf" min="1" placeholder="PF">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<input class="form-control" type="number" name="emp_salary" min="1" placeholder="Gross Salary">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<input class="form-control" type="text" name="remarks" placeholder="Remarks">
							</div>
						</div>
						<button type="button" class="btn btn-danger text-white ctm-border-radius float-right ml-3" data-dismiss="modal">Cancel</button>
						<button type="button" type="submit" class="btn btn-theme ctm-border-radius text-white float-right button-1" id="assing_assets">Add</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- edit modal -->
	<div class="modal fade update_ajax_modal" id="add-information" role="document">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content editmodal">
				<!-- Modal body -->

			</div>
		</div>
	</div>



	<?php $__env->stopSection(); ?>
	<?php $__env->startSection('javascript'); ?>
	<script>
		$(document).ready(function() {

			$(document).on('click', '#assing_assets', function(e) {

				$.ajax({
					Type: "GET",
					url: '<?php echo e(url("emp_salary")); ?>',
					dataType: 'json',
					cache: false,
					data: $('#company_form').serialize(),
					success: function(response) {
						console.log(response);
						if (response.status == 200) {

							var html = '<tr>';
							html += '<td>' + response.last_data.employee.emp_salary + '</td>';
							html += '<td>' + response.last_data.basic_salary + '</td>';
							html += '<td>' + response.last_data.model_no + '</td>';
							html += '<td>' + response.last_data.quantity + '</td>';
							html += '<td>' + response.last_data.remarks + '</td>';
							html += '<td>' + response.last_data.allotted_date + '</td>';
							html += '<td>' + response.last_data.return_date + '</td>';
							html += '<td><a href="javascript:void(0);" class="btn btn-sm btn-outline-success edit_assets " data-toggle="modal" data-id="' + response.last_data.id + '" data-target="#edit-information' + response.last_data.id + '"><span class="lnr lnr-pencil"></span>Edit</a><a href="javascript:void(0);" class="btn btn-sm btn-outline-danger delete-assets "  data-id="' + response.last_data.id + '" ><span class="lnr lnr-trash"></span>Delete</a></td></tr>';
							$('#table_data').prepend(html);
							toastr.success(response.success);
							$('.modal-backdrop').hide();
							$('.modal').hide();
							// setTimeout(function(){ location.reload(); },1000);

						} else {
							toastr.error(response.error);
						}
					}
				})
			});

			$(document).on('click', '.update_assets', function(e) {
				var asset_id = $(this).data("asset_id");
				$.ajax({
					Type: "GET",
					url: '<?php echo e(url("update_salary")); ?>',
					dataType: 'json',
					cache: false,
					data: $('#update_form' + asset_id).serialize(),
					success: function(response) {
						console.log(response);
						if (response.status == 200) {
							toastr.success(response.success);
							$('.modal-backdrop').hide();
							$('.modal').hide();
							setTimeout(function() {
								location.reload();
							}, 1000);



						} else {
							toastr.error(response.error);
						}
					}
				})
			});


			$(document).on('click', '.edit_assets', function(e) {
				var id = $(this).data("id");
				$.ajax({
					Type: "GET",
					url: '<?php echo e(url("ModalForUpdate")); ?>',
					dataType: 'json',
					cache: false,
					data: {
						id: id
					},
					success: function(response) {
						console.log(response);
						$('.editmodal').html(response.html);
						$('.update_ajax_modal').modal('show');
					}
				})
			});

			$(document).on('click', '.delete-assets', function(e) {
				var assets_id = $(this).data("id");
				if (confirm("Do You Want to Remove The Assets")) {
					$(this).closest('tr').remove();
					$.ajax({
						Type: "GET",
						url: '<?php echo e(url("delete_assets")); ?>',
						dataType: 'json',
						cache: false,
						data: {
							assets_id: assets_id
						},
						success: function(response) {
							console.log(response);
							if (response.status == 200) {
								toastr.success(response.success);

								//   setTimeout(function(){ location.reload(); },1000);
							} else {
								toastr.error(response.error);
							}
						}
					})
				}
			});



		});
	</script>
	<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\empisee\resources\views/salary.blade.php ENDPATH**/ ?>
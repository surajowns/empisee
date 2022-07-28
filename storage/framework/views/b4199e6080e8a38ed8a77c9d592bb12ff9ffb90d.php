
<?php $__env->startSection('title','Employee Payment'); ?>
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
			<h4 class="card-title mb-0 d-inline-block">Payment Details</h4>

			<a href="#" class="btn btn-theme button-1 ctm-border-radius text-white float-right" data-toggle="modal" data-target="#add-information"><span></span> <span class="fa fa-plus"></span>Upload Salary Per Month</a>
		</div>
		<div class="card-body align-center">
			<div class="tab-content" id="v-pills-tabContent">

				<div class="employee-office-table">
					<div class="table-responsive">
						<table class="table custom-table table-hover ">
							<thead>
								<tr>

									<th>Name</th>
									<th>Net Payable</th>
									<th>Bonus</th>
									<th>Loan</th>
									<th>Leave Without Pay</th>
									<th>Other Deduction</th>
                                    <th>Month</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="table_data">
								<?php $__currentLoopData = $emp_assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>

									<td><?php echo e($value['employee']['name']); ?></td>
									<td><?php echo e($value->net_pay); ?></td>
									<td><?php echo e($value->bonus); ?></td>
									<td><?php echo e($value->loan); ?></td>
									<td><?php echo e($value->leave_without_pay); ?></td>
									<td><?php echo e($value->other_deduction); ?></td>
                                    <td><?php echo e(date('F Y',strtotime($value->month))); ?></td>

									<td>
										<a href="javascript:void(0);" class="btn btn-sm btn-outline-success edit_assets" data-toggle="modal" data-id="<?php echo e($value->id); ?>" data-target="#edit-information<?php echo e($value->id); ?>">
											<span class="lnr lnr-pencil"></span>Edit
										</a>
										<a href="<?php echo e(url('emp_salary_slip/'.$value->id)); ?>" class="btn btn-sm btn-outline-success" >
											<span class="lnr lnr-download"></span>Download
									    </a>
										<a href="<?php echo e(url('sendOnEmailemp_salary_slip/'.$value->id)); ?>" class="btn btn-sm btn-outline-success" >
											<span class="lnr lnr-upload"></span> <?php if($value->email_sent==0): ?> Send <?php else: ?> Sent <?php endif; ?>
									    </a>
										<!-- <a href="javascript:void(0);" class="btn btn-sm btn-outline-danger delete-assets"  data-id="<?php echo e($value->id); ?>">
												<span class="lnr lnr-trash"></span>Delete
											</a> -->




									</td>
								</tr>
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
								<select class="form-control" id="emp_id" name="emp_id">
									<option value="">Select Employee </option>
									<?php $__currentLoopData = $employee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($value->id); ?>"> <?php echo e(strtoupper($value->name)); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<input class="form-control" type="number" name="net_pay" min="1" placeholder="Net Payable">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<input class="form-control" type="number" name="bonus" min="1" placeholder="Bonus">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<input class="form-control" type="number" name="leave_without_pay" min="1" placeholder="Leave Without Pay">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<input class="form-control" type="number" name="loan" min="1" placeholder="Loan">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<input class="form-control" type="number" name="other_deduction" min="1" placeholder="Other Deduction">
							</div>
						</div>
                        <div class="form-group">
							<div class="input-group mb-3">
								<input class="form-control" type="date" name="month"  placeholder="Month">
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
					url: '<?php echo e(url("upload_payment")); ?>',
					dataType: 'json',
					cache: false,
					data: $('#company_form').serialize(),
					success: function(response) {
						console.log(response);
						if (response.status == 200) {
                                 var months= new  Date(response.last_data.month);
                                var monthname= months.toLocaleString('default', { month: 'long' })
								var url="<?php echo e(url('emp_salary_slip')); ?>"+'/'+response.last_data.id;
								var sendEmail="<?php echo e(url('sendOnEmailemp_salary_slip')); ?>"+'/'+response.last_data.id;	 

							var html = '<tr>';
							html += '<td>' + response.last_data.employee.name + '</td>';
							html += '<td>' + response.last_data.net_pay + '</td>';
							html += '<td>' + response.last_data.bonus + '</td>';
							html += '<td>' + response.last_data.leave_without_pay + '</td>';
							html += '<td>' + response.last_data.loan + '</td>';
							html += '<td>' + response.last_data.other_deduction + '</td>';
							html += '<td>'   + monthname +' '+months.getFullYear() + '</td>';
							html += '<td><a href="javascript:void(0);" class="btn btn-sm btn-outline-success edit_assets " data-toggle="modal" data-id="' + response.last_data.id + '" data-target="#edit-information' + response.last_data.id + '"><span class="lnr lnr-pencil"></span>Edit</a><a href="'+url+'" class="btn btn-sm btn-outline-success" ><span class="lnr lnr-download"></span>Download</a> <a href="'+sendEmail+'" class="btn btn-sm btn-outline-success" ><span class="lnr lnr-upload"></span>Send</a></td></tr>';
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
					url: '<?php echo e(url("update_payment")); ?>',
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
					url: '<?php echo e(url("update_payment_modal")); ?>',
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
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\empisee\resources\views/payment.blade.php ENDPATH**/ ?>
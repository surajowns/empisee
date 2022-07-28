
<?php $__env->startSection('title','Sales'); ?>
<?php $__env->startSection('content'); ?>
<?php
$id = Auth::user()->id;
$permission = App\SidebarPermission::with(['sidebar' => function ($query) {
	$query->where('parent_id', '!=', 0)->get();
}])->where('emp_id', $id)->whereIn('sidebar_id', [27])->get();
//    dd($permission)
?>
<div class="col-xl-9 col-lg-8  col-md-12">
	<div class="card shadow-sm ctm-border-radius grow">
		<div class="card-header d-flex align-items-center justify-content-between">
			<h4 class="card-title mb-0 d-inline-block">Sales Dashboard</h4>
			<a href='<?php echo e(url("public/sample.xlsx")); ?>' target="_blank">Download Sample Sheet</a>

			<form  method="POST" action="<?php echo e(url('import')); ?>"  enctype="multipart/form-data">
             <?php echo csrf_field(); ?>
			<div class="row">
			<input type="hidden" class="form-control" name="emp_id[]" id="emp_id" value="<?php echo e($id); ?>">
			<div class="input-group col-sm-6">
				<input type="file" name="import_file" id="import_file" required>
			</div>
			 <div class="col-sm-6">
				<button class="btn btn-theme button-1 ctm-border-radius text-white float-right" id=""><span></span> <span class="lnr lnr-paperclip"></span>Import</button>
			</div>
			</div>
          </form>		</div>
		<div class="card-header d-flex align-items-center justify-content-between">
		<form  action="<?php echo e(url('sales_export')); ?>" method="get" class="container">
			<div class="row">
			<div class="input-group col-sm-8">
		     	<input type="hidden" class="form-control" name="emp_id[]" id="emp_id" value="<?php echo e($id); ?>">
				 <div class="input-group  input-daterange">
				<input type="date" class="form-control" name="from" id="from" required>
				<div class="input-group-addon">to</div>
				<input type="date" class="form-control" name="to" id="to" required>
			</div>
			</div>
			 <div class="col-sm-4">
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
									<th>Serial No</th>
									<th>Date</th>
									<th>Company Name</th>
									<th>Contact Person</th>
									<th>Designation</th>
									<th>Contact No.</th>
									<th>Contact Email</th>
									<th>Address</th>
									<th>Remarks</th>
								</tr>
							</thead>
							<tbody id="table_data">
                                <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<td><?php echo e($loop->iteration); ?></td>
									<td><?php echo e(date('j/n/Y',strtotime($value->date))); ?></td>
									<td><?php echo e($value->company_name); ?></td>
									<td><?php echo e($value->contact_person); ?></td>
									<td><?php echo e($value->designation); ?></td>
									<td><?php echo e($value->contact_no); ?></td>
									<td><?php echo e($value->contact_email); ?></td>
									<td><?php echo e($value->address); ?></td>
									<td><?php echo e($value->remarks); ?></td>
								</tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php $__env->stopSection(); ?>
	
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\empisee\resources\views/sales.blade.php ENDPATH**/ ?>
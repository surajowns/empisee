<?php $__env->startSection('title',' Dashboard'); ?>
<?php $__env->startSection('content'); ?>
<style>
	.profile_img{
		position: absolute;
	}
	.profile_name{
		position: relative;
		top: 1px;
		font-size:17px;
		color: #fff;
		left:1px;
		font-weight: bold;
		text-transform:uppercase;
	}
	.widget-profile .profile-info-widget .booking-doc-img{background:none !important;}
</style>
<?php
$id=Auth::user()->id;
$permission=App\SidebarPermission::with(['sidebar'=>function($query){$query->where('parent_id','!=',0)->get();}])->where('emp_id',$id)->whereIn('sidebar_id',[22])->get();
//    dd($permission)
?>
<div class="col-xl-9 col-lg-8  col-md-12">
	<div class="quicklink-sidebar-menu ctm-border-radius shadow-sm bg-white card grow">
		<div class="card-body">
			<ul class="list-group list-group-horizontal-lg">
				<li class="list-group-item text-center active button-5"><a href="https://meet.google.com/?hs=197&pli=1&authuser=0" target="_blank" class="text-white">Schedule a Call</a></li>
				<!-- <li class="list-group-item text-center button-6"><button id="btn-nft-enable" onclick="initFirebaseMessagingRegistration()" class="btn btn-danger btn-xs btn-flat">Allow for Notification</button></li> -->
			</ul>
		</div>
	</div>
	<!-- Widget -->
	<div class="row">
		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
			<div class="card dash-widget ctm-border-radius shadow-sm grow">
				<div class="card-body">
					<div class="card-icon bg-primary">
						<i class="fa fa-users" aria-hidden="true"></i>
					</div>
					<div class="card-right">
						<h4 class="card-title">Total Employees</h4>
						<p class="card-text"><?php echo e(count($employee)); ?></p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-6 col-lg-6 col-sm-6 col-12">
			<div class="card dash-widget ctm-border-radius shadow-sm grow">
				<div class="card-body">
					<div class="card-icon bg-danger">
						<i class="fa fa-suitcase" aria-hidden="true"></i>
					</div>
					<div class="card-right">
						<h4 class="card-title">Total Leaves For Today</h4>
						<p class="card-text"><?php echo e(count($totalleave)); ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- / Widget -->
	<div class="accordion add-employee" id="accordion-details">
		<div class="card shadow-sm grow ctm-border-radius">
			<div class="card-header" id="headingTwo">
				<h4 class="cursor-pointer mb-0">
					<a class="coll-arrow d-block text-dark" href="javascript:void(0)" data-toggle="collapse" data-target="#employee-det">
						Today Active (<?php echo e($total_clockin); ?>) (<?php echo e(date('d-M-Y')); ?>)
					</a>
				</h4>
			</div>
			<div class="card-body p-0">
				<div id="employee-det" class="collapse show ctm-padding" aria-labelledby="headingTwo" data-parent="#accordion-details">
					<div class="row" style="overflow-y: scroll;height: 380px;">
						<div class="col-lg-12">

							<div class="card-body recent-activ">
								<div class="recent-comment"> 
									<?php if(!empty($Clockinemployee)): ?> 
									<?php $__currentLoopData = $Clockinemployee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<a href="javascript:void(0)" class="dash-card text-dark">
										<div class="dash-card-container">
											<div class="dash-card-icon text-primary">
												<i class="fa fa-toggle-on <?php echo e($value['is_clock_in']==1?'text-success':''); ?>" aria-hidden="true"></i>
											</div>
											<div class="dash-card-content">
																												<h6 class="mb-0"><?php echo e($value['emp_details']['name']); ?>&nbsp;<?php echo e(date('h:i A', strtotime($value['clock_in']))); ?>&nbsp;&nbsp;&nbsp;<?php echo e($value['comment']); ?>&nbsp;&nbsp;&nbsp; <?php if($value['clock_out']): ?><?php echo e(date('h:i A', strtotime($value['clock_out']))); ?> <?php endif; ?></h6>

											</div>
											<div class="dash-card-avatars">
												<div class="e-avatar"><img class="img-fluid" src="<?php echo e(isset($value['emp_details']['profile_image'])?url('public/profile/'.$value['emp_details']['profile_image']):url('public/assets/img/profiles/1613731537.png')); ?>" alt=""></div>
											</div>

										</div>
									</a>
									<hr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php else: ?>
									<a href="javascript:void(0)" class="dash-card text-dark">
										<div class="dash-card-container">
											<div class="dash-card-icon text-primary">
												<i class="fa fa-toggle-on" aria-hidden="true"></i>
											</div>
											<div class="dash-card-content">
												<h6 class="mb-0">No one is active today</h6>
											</div>
										</div>
									</a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>											
				</div>
			</div>
		</div>
		<div class="card shadow-sm grow ctm-border-radius">
			<div class="card-header" id="headingthree">
				<h4 class="cursor-pointer mb-0">
					<a class="coll-arrow d-block text-dark" href="javascript:void(0)" data-toggle="collapse" data-target="#employee-expense">
						Today Expense
					</a>
				</h4>
			</div>
			<div class="card-body p-0">
				<div id="employee-expense" class="collapse show ctm-padding" aria-labelledby="headingthree" data-parent="#accordion-details">
					<div class="row">
						<div class="col-lg-12">

							<div class="card-body recent-activ">
								<div class="recent-comment"> 
									<?php if(!empty($todayexpense)): ?> 

									<div class="employee-office-table">
										<div class="table-responsive">
											<table class="table custom-table mb-0">
												<thead>
													<tr>
														<th>Name</th>
														<th></th>
														<th>Expense Type</th>
														<th>Amount</th>
														<th>Vendor Name</th>
														<th>Description</th>
														<th>Invoice</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody>
													<?php $__currentLoopData = $todayexpense; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

													<tr>
														<td><?php echo e($value['employee']['name']); ?></td>
														<td><div class="dash-card-avatars">
															<div class="e-avatar"><img class="img-fluid" src="<?php echo e(isset($value['employee']['profile_image'])?url('public/profile/'.$value['employee']['profile_image']):url('public/assets/img/profiles/1613731537.png')); ?>" alt=""></div>
														</div></td>
														<td><?php echo e($value['exp_type']); ?></td>
														<td><?php echo e($value['amount']); ?></td>
														<td><?php echo e($value['vendor_name']); ?></td>
														<td><?php echo e($value['notes']); ?></td>
														<td>
															<img class="demo-trigger"  src="<?php echo e(url('public/expense/'.$value['exp_invoice'])); ?>" data-zoom="<?php echo e(url('public/expense/'.$value['exp_invoice'])); ?>" alt="" width="100">
														</td>
														<td>
															<?php if(count($permission)>0): ?>
															<?php echo e(Form::open(array('url' => '/expensestatus'))); ?>

															<input type = "hidden" name = "expense_id" value = "<?php echo e($value['id']); ?>" >
															<select name = "status_change" class="btn btn-theme ctm-border-radius text-white" data-style="btn-primary" onchange = "this.form.submit()" style="width:auto"> 
																<?php $__currentLoopData = $expensetatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
																<option  value = "<?php echo e($name->id); ?>" <?php if($name->id == $value['status']): ?><?php echo e('selected'); ?> <?php endif; ?>><?php echo e($name->name); ?></option>
																<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															</select>
															<?php echo e(Form::close()); ?> 
															<?php else: ?>
															<?php $__currentLoopData = $expensetatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<?php if($name->id == $value['status']): ?><?php echo e($name->name); ?> <?php endif; ?>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															<?php endif; ?>	
														</td>
													</tr>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</tbody>
											</table>
										</div>
									</div>
									<?php else: ?>
									<a href="javascript:void(0)" class="dash-card text-dark">
										<div class="dash-card-container">
											<div class="dash-card-icon text-primary">
												<i class="lnr lnr-printer pr-0 pb-lg-2 font-23" aria-hidden="true"></i>
											</div>
											<div class="dash-card-content">
												<h6 class="mb-0">There is no expense for today</h6>
											</div>
										</div>
									</a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>											
				</div>
			</div>
		</div>
		<div class="card shadow-sm grow ctm-border-radius">
			<div class="card-header" id="headingthree">
				<h4 class="cursor-pointer mb-0">
					<a class="coll-arrow d-block text-dark" href="javascript:void(0)" data-toggle="collapse" data-target="#employee-leave">
						Applied For Leave
					</a>
				</h4>
			</div>
			<div class="card-body p-0">
				<div id="employee-leave" class="collapse show ctm-padding" aria-labelledby="headingthree" data-parent="#accordion-details">
					<div class="row">
						<div class="col-lg-12">

							<div class="card-body recent-activ">
								<div class="recent-comment"> 
									<?php if(!empty($empleaves)): ?> 

									<div class="employee-office-table">
										<div class="table-responsive">
											<table class="table custom-table mb-0">
												<thead>
													<tr>
														<th>Employee</th>
														<th>Leave Type</th>
														<th>From</th>
														<th>To</th>
														<!-- <th>Days</th> -->
														<th>Notes</th>
														<th>Status</th>
														<th>Approved By</th>
														<!-- <th class="text-right">Action</th> -->
													</tr>
												</thead>
												<tbody>
													<?php $__currentLoopData = $empleaves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<tr>
														<td>
															<a href="javascript:void(0)" class="avatar">
																<img class="profile_img" alt="avatar image" src="<?php if($value['employee']['profile_image']): ?> <?php echo e(url('public/profile/'.$value['employee']['profile_image'])); ?> <?php else: ?> <?php echo e(url('public/assets/img/profiles/profile.png')); ?> <?php endif; ?>" class="img-fluid">
																<span class="profile_name"><?php echo e(substr($value['employee']['name'], 0, 2)); ?></span>
															</a>
															<h2><a href="javascript:void(0)"><?php echo e($value['employee']['name']); ?></a></h2>
														</td>
														<td><?php echo e($value['leavetype']['name']); ?></td>
														<td><?php echo e(date('d M Y',strtotime($value['from_date']))); ?></td>
														<td><?php echo e(date('d M Y',strtotime($value['to_date']))); ?></td>
														<?php $totaldays = (int)(date('d', strtotime($value['to_date'])) - date('d', strtotime($value['from_date']))); ?>
														<!-- <td><?php echo e($totaldays==0?1:$totaldays); ?></td> -->

														<td><?php echo e($value['leave_reason']); ?></td>
														<td class="text-danger">
															<?php if(count($permission)>0): ?>
															<?php echo e(Form::open(array('url' => '/updatestatus'))); ?>

															<input type="hidden" name="leave_id" value="<?php echo e($value['id']); ?>">
															<select name="status_change" class="btn btn-theme ctm-border-radius text-white btn-sm" data-style="btn-primary" onchange="this.form.submit()">
																<?php $__currentLoopData = $leavestatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																<option value="<?php echo e($name->id); ?>" <?php if($name->id == $value['status']): ?><?php echo e('selected'); ?> <?php endif; ?>><?php echo e($name->name); ?></option>
																<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															</select>
															<?php echo e(Form::close()); ?>

															<?php else: ?>
															<?php $__currentLoopData = $leavestatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<?php if($name->id == $value['status']): ?><?php echo e($name->name); ?> <?php endif; ?>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															<?php endif; ?>

														</td>
														<td><?php echo e($value['approved_by']); ?></td>
													</tr>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

												</tbody>
											</table>
										</div>
									</div>
									<?php else: ?>
									<a href="javascript:void(0)" class="dash-card text-dark">
										<div class="dash-card-container">
											<div class="dash-card-icon text-primary">
												<i class="fa fa-suitcase" aria-hidden="true"></i>
											</div>
											<div class="dash-card-content">
												<h6 class="mb-0">No one Applied for Leave</h6>
											</div>
										</div>
									</a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>											
				</div>
			</div>
		</div>

	</div>
	<!-- Chart -->
	<div class="row">
		<div class="col-md-6 d-flex">
			<div class="card ctm-border-radius shadow-sm flex-fill grow">
				<div class="card-header">
					<h4 class="card-title mb-0">Total Employees</h4>
				</div>
				<div class="card-body">
					<canvas id="pieChart"></canvas>
				</div>
			</div>
		</div>
		<div class="col-md-6 d-flex">
			<div class="card flex-fill today-list shadow-sm grow">
				<div class="card-header">
					<h4 class="card-title mb-0 d-inline-block">Upcoming Events</h4>
					<a href="javascript:void(0)" class="d-inline-block float-right text-primary"><i class="fa fa-suitcase"></i></a>
				</div>
				<div class="card-body recent-activ">
					<div class="recent-comment">
						<?php if(!empty($upcomingevent)>0): ?>
						<?php $__currentLoopData = $upcomingevent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<a href="javascript:void(0)" class="dash-card text-danger">
							<div class="dash-card-container">
								<div class="dash-card-icon">
									<i class="fa fa-suitcase"></i>
								</div>
								<div class="dash-card-content">
									<h6 class="mb-0"><?php echo e(date('D',strtotime($value->start))); ?>,<?php echo e(date('d M Y',strtotime($value->start))); ?> <?php echo e($value->title); ?></h6>
								</div>
							</div>
						</a>
						<hr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php else: ?>
						<a href="javascript:void(0)" class="dash-card text-danger">
							<div class="dash-card-container">
								<div class="dash-card-icon">
									<i class="fa fa-suitcase"></i>
								</div>
								<div class="dash-card-content">
									<h6 class="mb-0">No Upcomming Leaves</h6>
								</div>
							</div>
						</a>
						<hr>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- / Chart -->

	<div class="row">
		<div class="col-lg-6">
			<div class="card ctm-border-radius shadow-sm grow">
				<div class="card-header">
					<h4 class="card-title mb-0 d-inline-block">Today</h4>
					<a href="javascript:void(0)" class="d-inline-block float-right text-primary"><i class="lnr lnr-sync"></i></a>
				</div>
				<div class="card-body recent-activ">
					<div class="recent-comment"> 

						<?php if(!empty($todayevent)): ?> 
						<?php $__currentLoopData = $todayevent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<a href="javascript:void(0)" class="dash-card text-dark">
							<div class="dash-card-container">
								<div class="dash-card-icon text-primary">
									<i class="fa fa-birthday-cake" aria-hidden="true"></i>
								</div>
								<div class="dash-card-content">
									<h6 class="mb-0"> Today is <?php echo e($value['title']); ?>  </h6>
								</div>
							</div>
						</a>
						<hr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php endif; ?>

						<?php if(!empty($todaybirthday)): ?> 
						<?php $__currentLoopData = $todaybirthday; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<a href="javascript:void(0)" class="dash-card text-dark">
							<div class="dash-card-container">
								<div class="dash-card-icon text-primary">
									<i class="fa fa-birthday-cake" aria-hidden="true"></i>
								</div>
								<div class="dash-card-content">
									<h6 class="mb-0"><?php echo e($value['emp_details']['name']); ?> Birthdays Today</h6>
								</div>
								<div class="dash-card-avatars">
									<div class="e-avatar"><img class="img-fluid" src="<?php echo e(isset($value['emp_details']['profile_image'])?url('public/profile/'.$value['emp_details']['profile_image']):url('public/assets/img/profiles/1613731537.png')); ?>" alt=""></div>
								</div>

							</div>
						</a>
						<hr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php else: ?>
						<!-- <a href="javascript:void(0)" class="dash-card text-dark">
							<div class="dash-card-container">
								<div class="dash-card-icon text-primary">
									<i class="fa fa-birthday-cake" aria-hidden="true"></i>
								</div>
								<div class="dash-card-content">
									<h6 class="mb-0">No Birthdays Today</h6>
								</div>
							</div>
						</a> -->
						<?php endif; ?>

						<?php if(!empty($totalleave)): ?> 

						<?php $__currentLoopData = $totalleave; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<a href="javascript:void(0)" class="dash-card text-dark">
							<div class="dash-card-container">
								<div class="dash-card-icon text-primary">
									<i class="fa fa fa-suitcase" aria-hidden="true"></i>
								</div>
								<div class="dash-card-content">
									<h6 class="mb-0"><?php echo e($value['employee']['name']); ?>&nbsp;<?php echo e($value['leavetype']['name']); ?> &nbsp;&nbsp;Today </h6>
								</div>
								<div class="dash-card-avatars">
									<div class="e-avatar"><img class="img-fluid" src="<?php echo e(isset($value['employee']['profile_image'])?url('public/profile/'.$value['employee']['profile_image']):url('public/assets/img/profiles/1613731537.png')); ?>" alt=""></div>
								</div>
							</div>
						</a>
						<hr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php else: ?>
						<a href="javascript:void(0)" class="dash-card text-dark">
							<div class="dash-card-container">
								<div class="dash-card-icon text-primary">
									<i class="fa fa-suitcase" aria-hidden="true"></i>
								</div>
								<div class="dash-card-content">
									<h6 class="mb-0">No one on leave today</h6>
								</div>
							</div>
						</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-12 d-flex">

			<!-- Team Leads List -->
			<div class="card flex-fill team-lead shadow-sm grow">
				<div class="card-header">
					<h4 class="card-title mb-0 d-inline-block">Team Leads </h4>
					<a href="javascript:void(0)" class="dash-card float-right mb-0 text-primary">Manage Team </a>
				</div>
				<div class="card-body">
					<?php if(!empty($teamlead)): ?>
					<?php $__currentLoopData = $teamlead; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="media mb-3">
						<div class="e-avatar avatar-online mr-3 "><img class="profile_img" src="<?php if($lead->emp_details->profile_image): ?> <?php echo e(url('public/profile/'.$lead->emp_details->profile_image)); ?> <?php else: ?> <?php echo e(url('public/assets/img/profiles/profile.png')); ?> <?php endif; ?>" alt="" class="img-fluid">

							<span class="profile_name"><?php echo e(substr($lead->emp_details->name, 0, 2)); ?></span>

						</div>
						<div class="media-body">
							<h6 class="m-0"><?php echo e($lead->emp_details->name); ?></h6>
							<p class="mb-0 ctm-text-sm"><?php echo e($lead->departments->name); ?></p>
						</div>
					</div>
					<hr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php else: ?>
					<div class="media mb-3">
						<div class="e-avatar avatar-online mr-3"><img src="<?php echo e(url('public/profile/1613731537.png')); ?>" alt="" class="img-fluid"></div>
						<div class="media-body">
							<h6 class="m-0">No team leads </h6>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\empisee\resources\views/index.blade.php ENDPATH**/ ?>
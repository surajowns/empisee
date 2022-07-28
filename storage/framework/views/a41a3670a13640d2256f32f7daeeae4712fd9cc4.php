<!DOCTYPE html>
<html lang="en">

<head>

	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

	<link rel="manifest" href="<?php echo e(request()->root()); ?>/public/manifest.json">

	<!-- Favicon -->
	<link rel="icon" type="image/x-icon" href="<?php echo e(url('public/assets/img/favicon.png')); ?>">
	<!-- Linearicon Font -->
	<link rel="stylesheet" href="<?php echo e(url('public/assets/css/lnr-icon.css')); ?>">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="<?php echo e(url('public/assets/css/font-awesome.min.css')); ?>">

	<!-- Select2 CSS -->
	<link rel="stylesheet" href="<?php echo e(url('public/assets/plugins/select2/select2.min.css')); ?>">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?php echo e(url('public/assets/css/bootstrap.min.css')); ?>">

	<link rel="stylesheet" href="<?php echo e(url('public/assets/css/bootstrap-datetimepicker.min.css')); ?>">

	<!-- Linearicon Font -->
	<link rel="stylesheet" href="<?php echo e(url('public/assets/css/lnr-icon.css')); ?>">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="<?php echo e(url('public/assets/css/font-awesome.min.css')); ?>">
	<!-- Tagsinput CSS -->
	<link rel="stylesheet" href="<?php echo e(url('public/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')); ?>">
	<!-- Custom CSS -->
	<link rel="stylesheet" href="<?php echo e(url('public/assets/css/style.css')); ?>">
	<!-- Full Calander CSS -->
	<link rel="stylesheet" href="<?php echo e(url('public/assets/plugins/fullcalendar/fullcalendar.min.css')); ?>">


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
	<link rel="stylesheet" href="//cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">



	<title><?php echo $__env->yieldContent('title'); ?></title>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="<?php echo e(url('public/assets/js/html5shiv.min.js')); ?>"></script>
		<script src="<?php echo e(url('public/assets/js/respond.min.js')); ?>"></script>
		<![endif]-->


	<script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>
	<script>
		// Import the functions you need from the SDKs you need
		//   import { initializeApp } from "https://www.gstatic.com/firebasejs/9.1.0/firebase-app.js";
		// TODO: Add SDKs for Firebase products that you want to use
		// https://firebase.google.com/docs/web/setup#available-libraries

		// Your web app's Firebase configuration
		var firebaseConfig = {
			apiKey: "AIzaSyAFPw42BvAv6GFmc_cFT8XlpQuaxFAbXeU",
			authDomain: "emp-push-notification.firebaseapp.com",
			projectId: "emp-push-notification",
			storageBucket: "emp-push-notification.appspot.com",
			messagingSenderId: "1016907371044",
			appId: "1:1016907371044:web:770a6b0a49b77b3547beb1"
		};

		// Initialize Firebase
		firebase.initializeApp(firebaseConfig);
		//   const app = initializeApp(firebaseConfig);
		// Retrieve Firebase Messaging object.
		const messaging = firebase.messaging();

		function initFirebaseMessagingRegistration() {
			messaging
				.requestPermission()
				.then(function() {
					return messaging.getToken()
				})
				.then(function(token) {
					// console.log(token);

					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});

					$.ajax({
						url: '<?php echo e(url("/save-token")); ?>',
						type: 'POST',
						data: {
							token: token
						},
						dataType: 'JSON',
						success: function(response) {
							// alert('Token saved successfully.');
						},
						error: function(err) {
							console.log('User Chat Token Error' + err);
						},
					});

				}).catch(function(err) {
					console.log('User Chat Token Error' + err);
				});
		}

		messaging.onMessage(function(payload) {
			const title = payload.notification.title;
			const options = {
				body: payload.notification.body,
				icon: payload.notification.icon,
			};
			new Notification(title, options);
		});
	</script>

</head>
<style>
	.profile_img {
		position: absolute;
	}

	.profile_name {
		position: relative;
		top: 3px;
		font-size: 30px;
		color: #fff;
		left: 14px;
		font-weight: bold;
		text-transform: uppercase;
	}

	.widget-profile .profile-info-widget .booking-doc-img {
		background: none !important;
	}
</style>

<body>

	<!-- Inner wrapper -->
	<div class="inner-wrapper">

		<!-- Loader -->
		<div id="loader-wrapper">

			<div class="loader">
				<div class="dot"></div>
				<div class="dot"></div>
				<div class="dot"></div>
				<div class="dot"></div>
				<div class="dot"></div>
			</div>
		</div>

		<!-- Header -->
		<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<!-- /Header -->

		<!-- Content -->
		<div class="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xl-3 col-lg-4 col-md-12 theiaStickySidebar">
						<aside class="sidebar sidebar-user">
							<div class="row">
								<div class="col-12">
									<div class="card ctm-border-radius shadow-sm grow">
										<div class="card-body py-4">
											<div class="row">
												<div class="col-md-12 mr-auto text-left">
													<div class="custom-search input-group">
														<div class="custom-breadcrumb">
															<ol class="breadcrumb no-bg-color d-inline-block p-0 m-0 mb-2">
																<li class="breadcrumb-item d-inline-block"><a href="<?php echo e(Session::get('logRole')==1?url('/dashboard'):url('/emp_dashboard')); ?>" class="text-dark">Home</a></li>
																<li class="breadcrumb-item d-inline-block active">Dashboard</li>
															</ol>
															<h4 class="text-dark"><?php echo $__env->yieldContent('title'); ?></h4>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php if(Request::segment(1)=='dashboard' || Request::segment(1)=='emp_dashboard'): ?>
							<div class="user-card card shadow-sm bg-white text-center ctm-border-radius grow">
								<div class="user-info card-body">
									<div class="user-avatar mb-4">
										<?php if(Auth::user()->profile_image): ?>
										<img src="<?php echo e(url('public/profile/'.Auth::user()->profile_image)); ?>" alt="User Avatar" class="img-fluid rounded-circle" width="100">
										<?php else: ?>
										<img class="img-fluid rounded-circle " src="<?php echo e(url('public/assets/img/profiles/1613731537.png')); ?>" alt="<?php echo e(Auth::user()->name); ?>" width="100">
										<!-- <span class="profile_name"><?php echo e(substr(Auth::user()->name, 0, 2)); ?></span> -->
										<?php endif; ?>
									</div>
									<div class="user-details">
										<h4><b>Welcome <?php echo e(Auth::User()['name']); ?></b></h4>
										<p><?php echo e(Date('l, d F Y')); ?></p>
									</div>
								</div>
							</div>
							<?php endif; ?>
							<!-- Sidebar -->

							<?php echo $__env->make('sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
							<!-- /Sidebar -->

						</aside>
					</div>

					<?php echo $__env->yieldContent('content'); ?>

				</div>
			</div>
		</div>
		<!--/Content-->

	</div>

	<!-- Inner Wrapper -->
	<div class="sidebar-overlay" id="sidebar_overlay"></div>
	<!-- jQuery -->

	<script src="<?php echo e(url('public/assets/js/jquery-3.2.1.min.js')); ?>"></script>
	<!-- Bootstrap Core JS -->
	<script src="<?php echo e(url('public/assets/js/popper.min.js')); ?>"></script>
	<script src="<?php echo e(url('public/assets/js/bootstrap.min.js')); ?>"></script>
	<script src="<?php echo e(url('public/assets/plugins/select2/select2.min.js')); ?>"></script>
	<script src="<?php echo e(url('public/assets/plugins/select2/moment.min.js')); ?>"></script>

	<script src="<?php echo e(url('public/assets/js/bootstrap-datetimepicker.min.js')); ?>"></script>
	<script src="<?php echo e(url('public/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js')); ?>"></script>
	<script src="<?php echo e(url('public/assets/js/jquery.validate.min.js')); ?>"></script>


	<!-- Chart JS -->
	<script src="<?php echo e(url('public/assets/js/Chart.min.js')); ?>"></script>
	<script src="<?php echo e(url('public/assets/js/chart.js')); ?>"></script>
	<!-- Sticky sidebar JS -->
	<script src="<?php echo e(url('public/assets/plugins/theia-sticky-sidebar/ResizeSensor.js')); ?>"></script>
	<script src="<?php echo e(url('public/assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js')); ?>"></script>
	<!-- Custom Js -->
	<script src="<?php echo e(url('public/assets/js/script.js')); ?>"></script>
	<!--calender -->
	<script src="<?php echo e(url('public/assets/js/jquery-ui.min.js')); ?>"></script>

	<script src="<?php echo e(url('public/assets/plugins/fullcalendar/fullcalendar.min.js')); ?>"></script>
	<script src="<?php echo e(url('public/assets/plugins/fullcalendar/jquery.fullcalendar.js')); ?>"></script>

	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	<script src="//cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.ckeditor.com/4.15.1/full/ckeditor.js"></script>

	<script>
		$(document).ready(function() {
			if ('serviceWorker' in navigator) {
				navigator.serviceWorker.register('<?php echo e(url("public/firebase-messaging-sw.js")); ?>')
					.then(function(registration) {
						// console.log("Service Worker Registered");
						messaging.useServiceWorker(registration);
					});
			}
		});
	</script>

	<?php echo $__env->yieldContent('javascript'); ?>
	<script>
		$(document).ready(function() {
		    
		    	$(".select_employee").select2({
                placeholder: "Select Employees"
            });
            
			initFirebaseMessagingRegistration();
			$('.table').DataTable();

			document.addEventListener('click', function() {
				$('.employee_list').css('display', 'none');
			})
			<?php if(Session::has('success')): ?>
			toastr.success("<?php echo e(Session::get('success')); ?>");
			<?php endif; ?>
			<?php if(Session::has('error')): ?>
			toastr.error("<?php echo e(Session::get('error')); ?>");
			<?php endif; ?>

		});
	</script>
	<script>
		$(document).ready(function() {

			$(".search_employee").keyup(function() {
				var keywords = $(this).val();

				if (keywords && keywords.length > 0) {
					$.ajax({
						Type: "GET",
						url: '<?php echo e(url("search_employee")); ?>',
						dataType: 'json',
						cache: false,
						data: {
							keywords: keywords
						},
						success: function(response) {

							if (response.status == 200) {
								$('.employee_list').css('display', 'block');

								var list = '';
								$.each(response.employee_list, function(key, value) {
									list += '<li class="view_more" data-id="' + value.id + '"><div class="emp_list"><p>' + value.name + '</p><p>' + value.email + '</p></div></li>';
									list += '<hr class="mt-1 mb-1">';
								});
								$('.employee_list').html(list);
							} else {
								toastr.error(response.error);
							}
						}
					});
				} else {
					$('.employee_list').css('display', 'none');

				}
			});


			$(document).on('click', '.view_more', function() {
				var emp_id = $(this).data('id');
				$.ajax({
					Type: "GET",
					url: '<?php echo e(url("search_details")); ?>',
					dataType: 'json',
					cache: false,
					data: {
						emp_id: emp_id
					},
					success: function(response) {
						$('.modal_content').html(response.html);
						$('#view-information').modal('show');
					}
				});

			});


		});
	</script>
	<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/616a62ba86aee40a5736d85f/1fi3p3aok';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</body>

</html><?php /**PATH C:\xampp\htdocs\empisee\resources\views/master.blade.php ENDPATH**/ ?>
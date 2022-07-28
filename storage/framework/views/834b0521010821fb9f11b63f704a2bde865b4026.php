<!DOCTYPE html>
<html lang="en">

<head>

	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

	<!-- Favicon -->
	<link rel="icon" type="image/x-icon" href="<?php echo e(url('public/assets/img/favicon.png')); ?>">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?php echo e(url('public/assets/css/bootstrap.min.css')); ?>">

	<!-- Linearicon Font -->
	<link rel="stylesheet" href="<?php echo e(url('public/assets/css/lnr-icon.css')); ?>">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="<?php echo e(url('public/assets/css/font-awesome.min.css')); ?>">


	<!-- Custom CSS -->
	<link rel="stylesheet" href="<?php echo e(url('public/assets/css/style.css')); ?>">

	<title>Empisee</title>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	

</head>

<body>

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

	<!-- Main Wrapper -->
	<div class="inner-wrapper login-body">
		<div class="login-wrapper">
			<div class="container">
				<div class="loginbox shadow-sm grow">
					<div class="login-left">
						<img class="img-fluid" src="<?php echo e(url('public/assets/img/logo.png')); ?>" alt="Logo">
					</div>
					<div class="login-right">
						<div class="login-right-wrap">
							<h1>Login</h1>
							<p class="account-subtitle">Access to our dashboard</p>
							<?php if(session('failed')): ?>
							<p class="text-center text-danger"><?php echo e(session('failed')); ?></p>
							<?php endif; ?>
							<?php if(session('error')): ?>
							<p class="text-center text-danger"><?php echo e(session('error')); ?></p>
							<?php endif; ?>
							<?php if(session('success')): ?>
							<p class="text-center text-success"><?php echo e(session('success')); ?></p>
							<?php endif; ?>
							<!-- Form -->
							<form action="" method="post">
								<?php echo csrf_field(); ?>
								<div class="form-group">
									<input class="form-control" type="email" name="email" placeholder="Email" required>
								</div>
								<div class="form-group">
									<input class="form-control" type="password" id="password-field2" name="password" placeholder="Password" required>
									<span toggle="#password-field2" class="lnr lnr-eye togglePassword " id="togglePassword"></span>
									<!-- <i class="bi bi-eye-slash togglepassword" id="togglePassword"></i> -->
								</div>
								<div class="form-group">
									<button class="btn btn-theme button-1 text-white ctm-border-radius btn-block" type="submit">Login</button>
								</div>
							</form>
							<!-- /Form -->

							<div class="text-center forgotpass"><a href="forgot-password.html">Forgot Password?</a></div>
							<div class="login-or">
								<span class="or-line"></span>
								<!-- <span class="span-or">or</span> -->
							</div>

							<!-- Social Login -->
							<div class="social-login">
								<!-- <span>Login with</span> -->
								<!-- <a href="javascript:void(0)" class="facebook"><i class="fa fa-facebook"></i></a><a href="javascript:void(0)" class="google"><i class="fa fa-google"></i></a> -->
							</div>
							<!-- /Social Login -->

							<!-- <div class="text-center dont-have">Don’t have an account? <a href="register.html">Register</a></div> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Main Wrapper -->

	<!-- jQuery -->
	<script src="<?php echo e(url('public/assets/js/jquery-3.2.1.min.js')); ?>"></script>

	<!-- Bootstrap Core JS -->
	<script src="<?php echo e(url('public/assets/js/popper.min.js')); ?>"></script>
	<script src="<?php echo e(url('public/assets/js/bootstrap.min.js')); ?>"></script>

	<!-- Sticky sidebar JS -->
	<script src="<?php echo e(url('public/assets/plugins/theia-sticky-sidebar/ResizeSensor.js')); ?>"></script>
	<script src="<?php echo e(url('public/assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js')); ?>"></script>

	<!-- Custom Js -->
	<script src="<?php echo e(url('public/assets/js/script.js')); ?>"></script>
	<script>
  $(document).ready(function() {
        $(document).on('click','.togglePassword' ,function() {
         // alert('dss');
        //   $(this).toggleClass("lnr lnr-eye");
          var input = $($(this).attr("toggle"));
          if (input.attr('type') == 'password') {
            input.attr('type', 'text');
          }else{
            input.attr("type", "password");
          }
        });
      });
    </script>


</body>

</html><?php /**PATH C:\xampp\htdocs\empisee\resources\views/login.blade.php ENDPATH**/ ?>
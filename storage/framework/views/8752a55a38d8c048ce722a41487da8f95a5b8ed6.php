<?php $__env->startSection('title','Company'); ?>
<?php $__env->startSection('content'); ?>
<style>
    .text {
        color: white;
        font-size: 20px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        white-space: nowrap;
    }

    @charset  "UTF-8";

    .svg-inline--fa {
        vertical-align: -0.200em;
    }

    .rounded-social-buttons {
        text-align: center;
    }

    .rounded-social-buttons .social-button {
        display: inline-block;
        position: relative;
        cursor: pointer;
        width: 3.125rem;
        height: 3.125rem;
        border: 0.125rem solid transparent;
        padding: 0;
        text-decoration: none;
        text-align: center;
        color: #fefefe;
        font-size: 1.5625rem;
        font-weight: normal;
        /*line-height: 2em;*/
        border-radius: 1.6875rem;
        transition: all 0.5s ease;
        margin-right: 0.25rem;
        margin-bottom: 0.25rem;
    }

    .rounded-social-buttons .social-button:hover,
    .rounded-social-buttons .social-button:focus {
        -webkit-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        transform: rotate(360deg);
    }

    .rounded-social-buttons .fa-twitter,
    .fa-facebook-f,
    .fa-linkedin,
    .fa-youtube,
    .fa-instagram {
        font-size: 25px;
    }

    .rounded-social-buttons .social-button.facebook {
        background: #3b5998;
    }

    .rounded-social-buttons .social-button.facebook:hover,
    .rounded-social-buttons .social-button.facebook:focus {
        color: #3b5998;
        background: #fefefe;
        border-color: #3b5998;
    }

    .rounded-social-buttons .social-button.twitter {
        background: #55acee;
    }

    .rounded-social-buttons .social-button.twitter:hover,
    .rounded-social-buttons .social-button.twitter:focus {
        color: #55acee;
        background: #fefefe;
        border-color: #55acee;
    }

    .rounded-social-buttons .social-button.linkedin {
        background: #007bb5;
    }

    .rounded-social-buttons .social-button.linkedin:hover,
    .rounded-social-buttons .social-button.linkedin:focus {
        color: #007bb5;
        background: #fefefe;
        border-color: #007bb5;
    }

    .rounded-social-buttons .social-button.youtube {
        background: #bb0000;
    }

    .rounded-social-buttons .social-button.youtube:hover,
    .rounded-social-buttons .social-button.youtube:focus {
        color: #bb0000;
        background: #fefefe;
        border-color: #bb0000;
    }

    .rounded-social-buttons .social-button.instagram {
        background: #125688;
    }

    .rounded-social-buttons .social-button.instagram:hover,
    .rounded-social-buttons .social-button.instagram:focus {
        color: #125688;
        background: #fefefe;
        border-color: #125688;
    }
</style>

<div class="col-xl-9 col-lg-8 col-md-12">
    <div class="card shadow-sm grow ctm-border-radius">
        <div class="card-body align-center">
            <h4 class="card-title float-left mb-0 mt-2"><?php echo e(count($company)); ?> Company</h4>
            <ul class="nav nav-tabs float-right border-0 tab-list-emp">
                <li class="nav-item pl-3">
                    <div class="text-center mt-3">
                        <button class="btn btn-theme text-white ctm-border-radius button-1" data-toggle="modal" data-target="#add-information">Add Company</button>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <?php $__currentLoopData = $company; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="row">
        <div class="col-md-7 d-flex">
            <div class="card ctm-border-radius shadow-sm grow flex-fill">
                <div class="card-header">
                    <h4 class="card-title mb-0">
                        <?php echo e($value->company_name); ?>


                        <?php if($permission): ?>
                        <?php $__currentLoopData = $permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permisionvalue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($permisionvalue['sidebar_id']==7): ?>
                        <button class="float-right btn btn-theme text-white ctm-border-radius button-1" data-toggle="modal" data-target="#update-information<?php echo e($value->id); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                        <?php endif; ?>
                        <?php if($permisionvalue['sidebar_id']==8): ?>
                        <button class="float-right btn btn-theme text-white ctm-border-radius button-1  delete-company" data-delete_company="<?php echo e($value->id); ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><span class="text-primary font-weight-bold">Register Number : </span><?php echo e($value->reg_comp_no); ?></p>
                            <p><span class="text-primary font-weight-bold">Incorporation Date : </span><?php echo e($value->incorporat_date); ?></p>
                            <p><span class="text-primary font-weight-bold">VAT Number : </span><?php echo e($value->vat_number); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p>
                                <span class="text-primary font-weight-bold">Address:</span><br>

                                <?php echo e($value->register_address); ?>

                            </p>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-5 d-flex">
            <div class="card ctm-border-radius shadow-sm grow flex-fill">
                <div class="card-header">
                    <h4 class="card-title mb-0">
                        Contact
                    </h4>
                </div>
                <div class="card-body">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Contact" value="<?php echo e($value->contact_no); ?>" disabled>

                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Website Link" value="<?php echo e($value->company_url); ?>" disabled>

                    </div>
                    <div class="input-group mb-0">
                        <input type="email" class="form-control" placeholder="Mail Id" value="<?php echo e($value->email); ?>" disabled>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7 d-flex">
            <div class="card ctm-border-radius shadow-sm grow flex-fill">
                <div class="card-header">
                    <h4 class="card-title mb-0">
                        Company Address
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                <span class="text-primary font-weight-bold font-weight-bold">REGISTERED OFFICE:</span><br>
                                <?php echo e($value->register_address); ?>

                            </p>
                        </div>
                        <div class="col-md-6">
                            <p>
                                <span class="text-primary font-weight-bold font-weight-bold">CORPORATE OFFICE:</span><br>

                                <?php echo e($value->corporat_address); ?>

                            </p>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <?php if($permission): ?>
                        <?php $__currentLoopData = $permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permisionvalue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($permisionvalue['sidebar_id']==7): ?>
                        <button class="btn btn-theme text-white ctm-border-radius button-1" data-toggle="modal" data-target="#update-address<?php echo e($value->id); ?>">Update Address</button>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 d-flex">
            <div class="card ctm-border-radius shadow-sm grow flex-fill">
                <div class="card-header">
                    <h4 class="card-title mb-0">
                        Company Social Links
                    </h4>
                </div>
                <div class="card-body">
                    <div class="input-group mb-3">
                        <div class="rounded-social-buttons">
                            <a class="social-button facebook" href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook-f"></i></a>
                            <a class="social-button twitter" href="https://www.twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a class="social-button linkedin" href="https://www.linkedin.com/" target="_blank"><i class="fa fa-linkedin"></i></a>
                            <a class="social-button youtube" href="https://www.youtube.com/" target="_blank"><i class="fa fa-youtube"></i></a>
                            <a class="social-button instagram" href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7 col-sm-12 d-flex">
            <div class="card flex-fill office-card-last ctm-border-radius shadow-sm grow">
                <div class="card-header ">
                    <h4 class="card-title mb-0">Working Week <a href="javascript:void(0)" class="float-right text-primary" data-toggle="modal" data-target="#edit_week"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></h4>
                    <span class="ctm-text-sm">You have to change your company's working week</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <span class="badge custom-badge badge-primary">Mon</span>
                            <span class="badge custom-badge badge-primary">Tue</span>
                            <span class="badge custom-badge badge-primary">Wed</span>
                            <span class="badge custom-badge badge-primary">Thu</span>
                            <span class="badge custom-badge badge-primary">Fri</span>
                            <span class="badge custom-badge badge-primary">Sat</span>
                            <span class="badge custom-badge">Sun</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

</div>
<!-- New Team The Modal -->
<div class="modal fade" id="add-information" role="document">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body style-add-modal">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title mb-3">Add Company Information</h4>
                <form method="POST" id="company_form">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input class="form-control" type="text" name="company_name" placeholder="Company Name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input class="form-control" type="text" name="reg_comp_no" placeholder="Registered Company Number">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input class="form-control datetimepicker" type="text" name="incorporat_date" placeholder="Incorporation Date">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input class="form-control" type="text" name="vat_number" placeholder="GST Number">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input class="form-control" type="text" name="register_address" placeholder="Register Office Address">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input class="form-control" type="text" name="corporat_address" placeholder="Corporate Office Address">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input class="form-control" type="number" name="contact_no" placeholder="Contact Number">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input class="form-control" type="email" name="email" placeholder="Email Address">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input class="form-control" type="text" name="company_url" placeholder="Company Url">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input class="form-control" type="text" name="city" placeholder="City">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input class="form-control" type="text" name="country" placeholder="Country">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input class="form-control" type="text" name="pin_code" placeholder="Post-Code">
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger text-white ctm-border-radius float-right ml-3" data-dismiss="modal">Cancel</button>
                    <button type="button" type="submit" class="btn btn-theme ctm-border-radius text-white float-right button-1" id="create_company">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__currentLoopData = $company; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="update-information<?php echo e($value->id); ?>" role="document">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body style-add-modal">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title mb-3">Update Company Information</h4>
                <form method="POST" id="update_form<?php echo e($value->id); ?>">
                    <input type="hidden" name="id" value="<?php echo e($value->id); ?>">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input class="form-control" type="text" name="company_name" value="<?php echo e($value->company_name); ?>" placeholder="Company Name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input class="form-control" type="text" name="reg_comp_no" value="<?php echo e($value->reg_comp_no); ?>" placeholder="Registered Company Number">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input class="form-control datetimepicker" type="text" name="incorporat_date" value="<?php echo e($value->incorporat_date); ?>" placeholder="Incorporation Date">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input class="form-control" type="text" name="vat_number" value="<?php echo e($value->vat_number); ?>" placeholder="Vat Number">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input class="form-control" type="number" name="contact_no" value="<?php echo e($value->contact_no); ?>" placeholder="Contact Number">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input class="form-control" type="email" name="email" value="<?php echo e($value->email); ?>" placeholder="Email Address">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input class="form-control" type="text" name="company_url" value="<?php echo e($value->company_url); ?>" placeholder="Company Url">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input class="form-control" type="text" name="city" value="<?php echo e($value->city); ?>" placeholder="City">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input class="form-control" type="text" name="country" value="<?php echo e($value->country); ?>" placeholder="Country">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input class="form-control" type="text" name="pin_code" value="<?php echo e($value->pin_code); ?>" placeholder="Post-Code">
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger text-white ctm-border-radius float-right ml-3" data-dismiss="modal">Cancel</button>
                    <button type="button" type="submit" class="btn btn-theme ctm-border-radius text-white float-right button-1 update_company" data-company_id="<?php echo e($value->id); ?>">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__currentLoopData = $company; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="update-address<?php echo e($value->id); ?>" role="update address">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body style-add-modal">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title mb-3">Update Address</h4>
                <form method="POST" id="address_form<?php echo e($value->id); ?>">
                    <input type="hidden" name="id" value="<?php echo e($value->id); ?>">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input class="form-control" type="text" name="register_address" value="<?php echo e($value->register_address); ?>" placeholder="Register Office Address">
                        </div>
                        <div class="input-group mb-3">
                            <input class="form-control" type="text" name="corporat_address" value="<?php echo e($value->corporat_address); ?>" placeholder="Corporate Office Address">
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger text-white ctm-border-radius float-right ml-3" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-theme ctm-border-radius text-white float-right button-1 update_add" data-address_id="<?php echo e($value->id); ?>">Add</button>
                </form>

            </div>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function() {

        $(document).on('click', '#create_company', function(e) {

            $.ajax({
                Type: "GET",
                url: '<?php echo e(url("add_company")); ?>',
                dataType: 'json',
                cache: false,
                data: $('#company_form').serialize(),
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

        $(document).on('click', '.update_company', function(e) {
            var company_id = $(this).data("company_id");
            $.ajax({
                Type: "GET",
                url: '<?php echo e(url("edit_company")); ?>',
                dataType: 'json',
                cache: false,
                data: $('#update_form' + company_id).serialize(),
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


        $(document).on('click', '.update_add', function(e) {
            var address_id = $(this).data("address_id");
            $.ajax({
                Type: "GET",
                url: '<?php echo e(url("update_address")); ?>',
                dataType: 'json',
                cache: false,
                data: $('#address_form' + address_id).serialize(),
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

        $(document).on('click', '.delete-company', function(e) {
            var company_id = $(this).data("delete_company");
            if (confirm("Do You Want to Remove The Company")) {

                $.ajax({
                    Type: "GET",
                    url: '<?php echo e(url("delete_company")); ?>',
                    dataType: 'json',
                    cache: false,
                    data: {
                        company_id: company_id
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.status == 200) {
                            toastr.success(response.success);
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
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
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\empisee\resources\views/company.blade.php ENDPATH**/ ?>
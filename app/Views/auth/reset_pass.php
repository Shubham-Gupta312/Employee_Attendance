<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Marks Attendance</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/monsteradmin/" />
    <!-- Custom CSS -->
    <link href="../../dist/css/style.min.css" rel="stylesheet">
    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .has-error .help-block {
            color: #a94442;
            /* Red color for error messages */
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center"
            style="background:url(../assets/images/background/login-register.jpg) no-repeat center center; background-size: cover;">
            <div class="auth-box p-4 bg-white rounded">
                <div>
                    <div class="logo">
                        <h3 class="box-title mb-3">Reset Password</h3>
                    </div>
                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal mt-3 form-material" id="resetForm">
                                <div class="form-group mb-3 ">
                                    <div class="col-xs-12">
                                        <input class="form-control" type="password" required="" name="password"
                                            id="password" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="col-xs-12">
                                        <input class="form-control" type="password" required="" name="confirmPassword"
                                            id="confirmPassword" placeholder="Confirm Password">
                                    </div>
                                </div>
                                <div class="form-group text-center mb-3">
                                    <div class="col-xs-12">
                                        <button
                                            class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light"
                                            name="reset" id="reset" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="../assets/libs/jquery/dist/jquery.min.js "></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js "></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js "></script>
    <!-- jquery Validation Plugin -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
        $('[data-toggle="tooltip "]').tooltip();
        $(".preloader ").fadeOut();

        jQuery(document).ready(function (e) {
            $('#resetForm').bootstrapValidator({
                fields: {
                    'password': {
                        validators: {
                            notEmpty: {
                                message: "Please enter password."
                            },
                            stringLength: {
                                min: 6,
                                message: 'Password must be at least 6 characters long'
                            }
                        }
                    },
                    'confirmPassword': {
                        validators: {
                            notEmpty: {
                                message: "Please confirm password."
                            },
                            identical: {
                                field: 'password',
                                message: 'The password and its confirm are not the same'
                            }
                        }
                    }
                },
            }).on('success.form.bv', function (e) {
                // Prevent form submission
                e.preventDefault();
                // Get the form instance
                var $form = $(e.target);
                // Get the BootstrapValidator instance
                var bv = $form.data('bootstrapValidator');
                // Serialize form data
                var formData = $form.serialize();
                // Log form data to console
                console.log(formData);
                // Use AJAX to submit form data
                $.ajax({
                    url: "<?= base_url('reset_pswrd') ?>",
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        console.log(response);
                        // if (response.status === 'true') {
                        //     // Reset form inputs
                        //     $('#registerForm')[0].reset();
                        //     // Redirect to login page
                        //     window.location.href = "<?= base_url('admin/login') ?>";
                        // }
                    },
                    error: function (xhr, status, error) {
                        // Handle error
                        console.error(error);
                    }
                });
            });
        });
    </script>
</body>

</html>
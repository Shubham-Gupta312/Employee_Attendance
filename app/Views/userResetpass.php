<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marks Attendance </title>
    <link rel="stylesheet" type="text/css" href="../../dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../dist/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="../../dist/css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="../../dist/css/iofrm-theme23.css">
    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- jquery Validation Plugin -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.min.js"></script>

    <style>
        .has-error .help-block {
            color: #a94442;
            /* Red color for error messages */
        }
    </style>
</head>

<body>
    <div class="form-body">
        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">
                    <h3>Marks Attendance </h3>
                    <p>Access to the most powerfull tool in the entire design and web industry.</p>
                    <img src="../assets/images/gallery/attendance.jpg" alt="">
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <!-- <div class="website-logo-inside">
                            <a href="index.html">
                                <div class="logo">
                                    <img class="logo-size" src="images/logo-light.svg" alt="">
                                </div>
                            </a>
                        </div>-->

                        <form id="resetPassform">
                            <?php
                            // Fetch session email here
                            if (isset(session()->reset_email)) {
                                $email = session()->reset_email;
                            }
                            ?>
                            <input type="hidden" name="email" id="email" value="<?= $email ?>">
                            <div class="form-group mb-4">
                                <div class="">
                                    <input class="form-control" type="password" required="" id="password"
                                        placeholder="Password" name="password">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="">
                                    <input class="form-control" type="password" required="" id="confirmPassword"
                                        placeholder="Retype the password" name="confirmPassword">
                                </div>
                            </div>
                            
                            <div class="form">
                                <div class="error">
                                    <span><p class="error-msg"></p></span>
                                </div>
                            </div>
                            <div class="form-button">
                                <button id="submit" type="submit" name="submit" class="ibtn">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <script src="../../dist/js/jquery.min.js"></script> -->
    <script src="../../dist/js/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../dist/js/main.js"></script>

    <script>
        jQuery(document).ready(function (e) {
            $('#resetPassform').bootstrapValidator({
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
                var formData = $form.find('input[name="email"], input[name="password"]').serialize();
                // Log form data to console
                console.log(formData);
                // Use AJAX to submit form data
                $.ajax({
                    url: "<?= base_url('emp_reset_password') ?>",
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        // console.log(response);
                        if (response.status === 'true') {
                            // Redirect to login page
                            window.location.href = "<?= base_url('login') ?>";
                        }else{
                            var msg = response.message;
                            $('.error-msg').text(msg).css('color','red');
                        }
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
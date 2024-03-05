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
                    <p>Access to the most powerful tool in the entire design and web industry.</p>
                    <img src="../assets/images/gallery/attendance.jpg" alt="">
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <form id="UserLoginForm">
                            <div class="form-group mb-3">
                                <div class="">
                                    <input class="form-control" type="text" required="" id="email"
                                        placeholder="Username / Email" name="email">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="">
                                    <input class="form-control" type="password" required="" id="password"
                                        placeholder="Password" name="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="error text-danger">
                                    <p class="error-msg"></p>
                                </div>
                            </div>
                            <div class="form-button">
                                <button id="submit" type="submit" name="submit" id="submit" class="ibtn">Login</button>
                                <a href="<?= base_url('emp_reset_email') ?>">Forgot password?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        jQuery(document).ready(function (e) {
            $('#UserLoginForm').bootstrapValidator({
                fields: {
                    'email': {
                        validators: {
                            notEmpty: {
                                message: "Please enter email."
                            },
                            regexp: {
                                regexp: /^[_A-Za-zA-Z0-9-]+(\.[_A-Za-z0-9-]+)*@[A-Za-z0-9-]+(\.[a-z0-9-]+)*(\.[A-Za-z]{2,10})$/,
                                message: 'Please enter valid email id'
                            }
                        }
                    },
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
                // console.log(formData);
                $.ajax({
                    url: "<?= base_url('login') ?>",
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        // console.log(response);
                        if (response.status === 'true') {
                            // Redirect to login page
                            window.location.href = "<?= base_url() ?>";
                        } else {
                            var msg = response.message;
                            $('.error-msg').text(msg).css('color', 'red');
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
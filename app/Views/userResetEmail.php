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

                        <form id="ResetEmailform">
                            <div class="form-group mb-3">
                                <div class="">
                                    <input class="form-control" type="text" required="" id="email"
                                        placeholder="Username / Email" name="email">
                                </div>
                            </div>
                            <div class="form">
                                <div class="error">
                                    <span><strong class="error-msg"></strong></span>
                                </div>
                            </div>
                            <div class="form-button">
                                <button id="submit" type="submit" name="submit" id="submit" class="ibtn">Submit</button>
                            </div>
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
            $('#ResetEmailform').bootstrapValidator({
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
                    url: "<?= base_url('resetEmail') ?>",
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        // console.log(response);
                        if (response.status === 'true') {
                            // Redirect to login page
                            window.location.href = "<?= base_url('emp_reset_password') ?>";
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
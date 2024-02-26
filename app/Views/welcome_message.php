<?= $this->extend('inc/snippet.php'); ?>
<?= $this->section('content'); ?>
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
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <div class="row">
                <div class="table-head d-flex mt-3">
                    <div class="table-title" style="margin-right: auto;">
                        <h3>List of Employee's</h3>
                    </div>
                    <div class="table-add">
                        <button type="button" class="btn btn-outline-info add_employee" id="add_employee"><i
                                class="bi bi-person-fill-add"></i></button>
                    </div>
                </div>
                <!-- Employee Form -->
                <div class="employee-from">
                    <div class="emp_container" style="display: none;">
                        <form id="addEmployee">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <label for="name">Employee Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter Employee Name">
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <label for="email">Employee Email</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Enter Employee Email-Id">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-6 col-md-6">
                                    <label for="phone">Employee Phone No.</label>
                                    <input type="tel" class="form-control onlynumbers" id="phone" name="phone"
                                        maxlength="10" placeholder="Enter Employee Phone No.">
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <label for="address">Employee Address</label>
                                    <textarea class="form-control specialChars" placeholder="Enter Employee Address" name="address"
                                        id="address" rows="1"></textarea>
                                </div>
                            </div>
                            <button type="submit" id="save" name="save" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
                <!-- Employee Form End -->
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th scope="col">Sl. No.</th>
                            <th scope="col">Employee-Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Mobile No.</th>
                            <th scope="col">Address</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>10001</td>
                            <td>Otto</td>
                            <td>otto@mdo.com</td>
                            <td>09898797898</td>
                            <td>Xyz, abc</td>
                            <td>
                                <button class="btn btn-outline-success edit" id="edit" style="border-radius: 50%;">
                                    <i class="bi bi-check-lg"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>10002</td>
                            <td>Jacob</td>
                            <td>@fat</td>
                            <td>68368698326</td>
                            <td>Xyz, abc</td>
                            <td>
                                <button class="btn btn-outline-success edit" id="edit" style="border-radius: 50%;">
                                    <i class="bi bi-check-lg"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Row -->
        </div>
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer">
            © 2024 All Rights Reserved {Company Name}
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
</div>

<!-- jquery Validation Plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.min.js"></script>

<script>
    jQuery(document).ready(function ($) {
        $('#addEmployee').bootstrapValidator({
            fields: {
                'name': {
                    validators: {
                        notEmpty: {
                            message: "Please Enter Name"
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9\s]+$/,
                            message: 'The name can only contain letters, numbers, and spaces'
                        }
                    }
                },
                'email': {
                    validators: {
                        notEmpty: {
                            message: "Please enter email."
                        },
                        regexp: {
                            regexp: /^[_A-Za-zA-Z0-9-]+(\.[_A-Za-z0-9-]+)*@[A-Za-z0-9-]+(\.[a-z0-9-]+)*(\.[A-Za-z]{2,10})$/,
                            message: 'Please enter a valid email id'
                        }
                    }
                },
                'phone': {
                    validators: {
                        notEmpty: {
                            message: "Please Enter Employee Phone Number"
                        },
                        regexp: {
                            regexp: /^[0-9]+$/, // Only allow numeric characters
                            message: 'Please enter a valid phone number'
                        },
                        stringLength: {
                            min: 10,
                            max: 10,
                            message: 'Phone number must be exactly 10 digits'
                        }
                    }
                },
                'address': {
                    validators: {
                        notEmpty: {
                            message: "Please enter Employee Address."
                        }
                    }
                }
            }
        }).on('success.form.bv', function (e) {
            e.preventDefault();
            var $form = $(e.target);
            var formData = $form.serialize();
            console.log(formData);
            // You can perform further actions here, such as AJAX submission
        });
    });
</script>

<script>
    // only number allowed
    $(document).ready(function () {
        $('body').on('keyup', ".onlynumbers", function (event) {
            this.value = this.value.replace(/[^[0-9]]*/gi, '');
        });

        //  only alphabet, numeric & some special
        function filterOnlyAllowedCharacters(input) {
            var allowedChars = /[#,.a-zA-Z0-9\s]/g; // Define allowed characters
            return input.replace(allowedChars, ''); // Replace any character not in the allowed list with an empty string
        }

        // Event listener to apply the filtering function on keyup
        $('body').on('keyup', '.specialChars', function (event) {
            this.value = filterOnlyAllowedCharacters(this.value);
        });
        // Open Employee Add Form
        $('#add_employee').click(function (e) {
            e.preventDefault();
            console.log('clicked');
            $('.emp_container').show();
        });
    });
</script>

<?= $this->endSection() ?>
<?= $this->extend('inc/snippet.php'); ?>

<?= $this->section('content'); ?>

<style>
    .ab {
        float: left;
        width: 100%;
    }
</style>


<!-- ============================================================== -->

<!-- Preloader - style you can find in spinners.css -->

<!-- ============================================================== -->

<div class="preloader">

    <div class="lds-ripple">

        <div class="lds-pos"></div>

        <div class="lds-pos"></div>

    </div>

</div>



<div id="main-wrapper-rmvd">

    <div class="page-wrapper">

        <div class="row">


            <div class="col-md-12" style="text-align:right; margin-left:-5px;">

                <div class="btn btn-outline-success" id="downloadExcelBtn"><i class="bi bi-cloud-arrow-down"></i>

                    Download

                    Excel Report</div>

            </div>

        </div>

        <div class="container">

            <div class="row">

                <div class="col-md-3 mt-3">

                    <label>Select Employee: </label>

                    <select class="form-control" id="actionDropdown" style="width: 250px;">

                        <option value="" selected="selected">-- Select an option --</option>

                        <option value="name">According to Employee Name</option>

                        <option value="all">All Employee</option>

                    </select>

                </div>

                <div class="col-md-9 search-name" style="display: none; margin-top:25px;">

                    <div class="row" style="display: block ruby;">

                        <form id="EmployeeFilter">

                            <div class="col-md-3 ab">

                                <label class="mr-2">Employee Name </label>

                                <input class="form-control emp_name" type="text" name="name" id="name">

                            </div>

                            <div class="col-md-3 ab">

                                <label class="mr-2">From:</label>

                                <input type="date" class="form-control" name="fromDate" id="fromDate">

                            </div>

                            <div class="col-md-3 ab">

                                <label class="mr-2">To:</label>

                                <input type="date" class="form-control" name="toDate" id="toDate">

                            </div>


                            <div class="col-lg-2 ab">

                                <button class="btn btn-primary" style="margin-top:23px;"><i class="bi bi-search"></i>
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

                <div class="col-md-6 ml-3 date-fields" style="display: none; margin-top:25px;">

                    <div class="row" style="display: block ruby;">

                        <form id="ALlEmployeeFilter">

                            <div class="col-lg-4 ab">

                                <label class="mr-2">From:</label>

                                <input type="date" class="form-control" name="fromDate" id="fromDate">

                            </div>

                            <div class="col-lg-4 ab">

                                <label class="mr-2">To:</label>

                                <input type="date" class="form-control" id="toDate" name="toDate">

                            </div>

                            <div class="col-lg-4 ab">

                                <button class="btn btn-primary" style="margin-top:23px;"><i class="bi bi-search"></i>
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

            <div class="container mt-4">

                <div class="table-responsive">

                    <table class="table table-bordered mt-3" id="reports">

                        <thead>

                            <tr>

                                <th width="1%" scope="col">Sl. No.</th>

                                <th width="2%" scope="col">ID</th>

                                <th width="6%" scope="col">Name</th>

                                <th width="5%" scope="col">Email</th>

                                <th width="6%" scope="col">Mobile No.</th>

                                <th width="3%" scope="col">Date</th>

                                <th width="4%" scope="col">Attendance Time</th>

                                <th width="4%" scope="col">Longitude</th>

                                <th width="4%" scope="col">Latitude</th>

                                <th width="10%" scope="col">Address</th>

                            </tr>

                        </thead>

                        <tbody>

                        </tbody>

                    </table>
                </div>

            </div>

        </div>
    </div>

</div>
</div>





<script>

    // Fetch Employee Records

    var table = $('#reports').DataTable({

        processing: true,

        serverSide: true,

        paging: true,

        "fnCreatedRow": function (row, data, index) {

            var pageInfo = table.page.info(); // Get page information

            var currentPage = pageInfo.page; // Current page index

            var pageLength = pageInfo.length; // Number of rows per page

            var rowNumber = index + 1 + (currentPage * pageLength); // Calculate row number

            $('td', row).eq(0).html(rowNumber); // Update index colum

        },

        ajax: {

            url: "<?= base_url('admin/fetchreports') ?>",

            type: "GET"

        },

        drawCallback: function (settings) {

            // console.log('Table redrawn:', settings);

        }

    });



    $(document).ready(function () {

        // Function to handle dropdown change

        $('#actionDropdown').change(function () {

            var selectedOption = $(this).val();

            if (selectedOption === 'name') {

                $('.search-name').show();

                $('.date-fields').hide();

            } else if (selectedOption === 'all') {

                $('.search-name').hide();

                $('.date-fields').show();

            } else {

                $('.search-name').hide();

                $('.date-fields').hide();

            }

        });



        // Function to handle download button click
        $('#downloadExcelBtn').click(function (e) {
            // Implement your download functionality here
            e.preventDefault();
            // console.log('Export File action performing');
            var selectedOption = $('#actionDropdown').val();
            if (!selectedOption) {
                alert('Please select a value to download reports.');
            } else {
                // console.log('Export File action performing on this:', selectedOption, 'data');
                // Check for additional conditions based on the selected option
                if (selectedOption === 'name') {
                    var formData = $('#EmployeeFilter').serialize();
                    // console.log(formData);
                    $.ajax({
                        method: "POST",
                        url: '<?= base_url("admin/NdlExcel") ?>',
                        data: formData,
                        success: function (response) {
                            // console.log(response);
                            if (response.status == 'error') {
                                var msg = response.message;
                                alert(msg);
                            }
                            if (response.status == "success") {
                                alert('File Download Successfully!!');
                            }
                        }
                    });
                } else if (selectedOption === 'all') {
                    var formData = $('#ALlEmployeeFilter').serialize();
                    // console.log(formData);
                    $.ajax({
                        method: "POST",
                        url: '<?= base_url("admin/ExcelReport") ?>',
                        data: formData,
                        success: function (response) {
                            // console.log(response);
                            if (response.status == 'error') {
                                var msg = response.message;
                                alert(msg);
                            }
                            if (response.status == "success") {
                                alert('File Download Successfully!!');
                            }
                        }
                    });
                }
            }

        });
    });


</script>

<?= $this->endSection() ?>
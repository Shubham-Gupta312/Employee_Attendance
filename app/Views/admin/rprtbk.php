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

<div id="main-wrapper">
    <div class="page-wrapper">
        <div class="row">
            <div class="col mt-3 ml-4">
                <label>Action:</label>
                <select class="form-control" id="actionDropdown" style="width: 250px;">
                    <option value="" selected="selected">-- Select an option --</option>
                    <option value="name">According to Employee Name</option>
                    <option value="all">All Employee</option>
                </select>
            </div>
            <div class="col mt-3 ml-3 search-name" style="display: none;">
                <div class="row" style="display: block ruby;">
                    <form id="EmployeeFilter">
                        <input class="form-control emp_name" type="text" name="name" id="name"
                            placeholder="Enter the Name">
                        <div class="col-lg-3 ml-3">
                            <label class="mr-2">From:</label>
                            <input type="date" class="form-control" name="fromDate" id="fromDate">
                        </div>
                        <div class="col-lg-3 ml-3">
                            <label class="mr-2">To:</label>
                            <input type="date" class="form-control" name="toDate" id="toDate">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col mt-3 ml-3 date-fields" style="display: none;">
                <div class="row" style="display: block ruby;">
                    <form id="ALlEmployeeFilter">
                        <div class="col-lg-3 ml-3">
                            <label class="mr-2">From:</label>
                            <input type="date" class="form-control" name="fromDate" id="fromDate">
                        </div>
                        <div class="col-lg-3 ml-3">
                            <label class="mr-2">To:</label>
                            <input type="date" class="form-control" id="toDate" name="toDate">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col mt-3 ml-3">
                <div class="btn btn-outline-success" id="downloadExcelBtn"><i class="bi bi-cloud-arrow-down"></i>
                    Download
                    Excel Report</div>
            </div>
        </div>

        <div class="container mt-4">
            <table class="table table-bordered mt-3" id="reports">
                <thead>
                    <tr>
                        <th scope="col">Sl. No.</th>
                        <th scope="col">Employee-Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Mobile No.</th>
                        <th scope="col">Date</th>
                        <th scope="col">Attendance Time</th>
                        <th scope="col">Longitude</th>
                        <th scope="col">Latitude</th>
                        <th scope="col">Address</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
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

        var selectedOption = $('#actionDropdown').val();
        if (!selectedOption) {
            alert('Please select a value to download reports.');
        } else {
            console.log('Export File action performing on this:', selectedOption, 'data');
            // Check for additional conditions based on the selected option
            if (selectedOption === 'name') {
                var formData = $('#EmployeeFilter').serialize();
                $.ajax({
                    method: "POST",
                    url: "<?= base_url('admin/NdlExcel'); ?>",
                    data: formData,
                    success: function (response) {
                        console.log(response);
                    }
                });
            } else if (selectedOption === 'all') {
                var formData = $('#ALlEmployeeFilter').serialize();
                console.log(formData);
            }
        }
    // });
    });

</script>
<?= $this->endSection() ?>
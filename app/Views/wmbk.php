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
  <style>
    .ab {
      background-color: #57D38C !important;
      color: #fff !important;
    }

    .ba {
      background-color: #f8490c !important;
      color: #fff !important;
    }

    .form-holder {
      margin-left: 0px !important;
      width: 100%;
    }

    .form-holder .form-content {
      min-height: 50% !important;
    }


    .form-content .form-items {
      max-width: none !important;
    }

    .form-body {
      height: 50px !important;
    }

    .table thead th {
      background-color: #064E89;
      color: #fff;
    }

    .float-right {
      float: right !important;
      margin: 8px 9px 4px 10px;
    }

    .btn-group-lg>.btn,
    .btn-lg {
      padding: 4px 10px;
      font-size: 16px;
      line-height: 24px;
    }

    .ab:hover {
      background-color: #45f5e7 !important;
      color: #fff !important;
    }

    .modal-footer {
      justify-content: left !important;
    }

    .form-body {
      background-color: #064E89;
    }
  </style>
</head>

<body>

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5>Logout</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are You Sure?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No </button>
          <a href="<?= base_url('signout') ?>"><button type="button" class="btn btn-primary">Yes </button></a>
        </div>
      </div>
    </div>
  </div>

  <!--<div class="container">
          <button class="btn btn-success btn-lg float-right" type="submit">Submit</button>
          </div> -->

  <div class="form-body on-top-mobile">

    <button class="btn btn-success btn-lg float-right" data-toggle="modal" data-target="#exampleModal" type="submit"><i
        class="fas fa-sign-out-alt"></i> Signout </button>

  </div>

  <div class="form-body on-top-mobile">

    <div class="container-fluid">

      <div class="row">

        <div class="form-holder">

          <div class="form-content">

            <div class="form-items">
              <?php if (session()->loggedin == 'loggedin'): ?>
                <h3 style="text-align:center;">
                  Hi &#128075;,
                  <strong>
                    <?= ucfirst(session()->name); ?>
                  </strong>
                </h3>

                <?php
                // Fetch session email here
                if (isset(session()->email)) {
                  $email = session()->email;
                }
                ?>
                <p>
                  <input type="hidden" name="email" value="<?= $email ?>">
                </p>
              <?php endif ?>
              <h2 style="text-align:center;"><strong>Mark Your Attendance </strong> </h2>

              <form>

                <div class="row top-padding">
                  <div class="col-12 col-sm-12 text-center">
                    <div class="form-button">
                      <button type="submit" id="checkin" class="ibtn ab"><img src="../assets/images/gallery/in.png">
                        Click to Submit Today's Attendance </button>
                    </div>
                  </div>
                  <!-- <div class="col-12 col-sm-6">
                                   <div class="form-button">
                                <button id="submit" type="submit" class="ibtn ba"><img src="images/out.png"> Check Out </button>
                            </div>
                                </div>-->
                </div>

              </form>


              <div class="table-responsive">
                <table class="table table-striped" id="EmpDetails">
                  <thead>
                    <tr>
                      <th scope="col">Sl.No </th>
                      <th scope="col">Employee Id </th>
                      <th scope="col">Name </th>
                      <th scope="col">Mobile Number </th>
                      <th scope="col">Email Id </th>
                      <th scope="col">Date </th>
                      <th scope="col">Today's Attendance </th>
                      <th scope="col">Longitude </th>
                      <th scope="col">Latitude </th>
                      <th scope="col">Location </th>
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
  </div>

  <!-- <script src="../../dist/js/jquery.min.js"></script> -->
  <script src="../../dist/js/popper.min.js"></script>
  <script src="../../dist/js/bootstrap.min.js"></script>
  <script src="../../dist/js/main.js"></script>
  <!-- DataTables CSS -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <!-- DataTables JavaScript -->
  <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


  <script>
    $(document).ready(function () {
      $('#checkin').click(function (e) {
        e.preventDefault();
        var emp_email = $('input[name="email"]').val();

        //  Button will enable will between 10AM to 5PM
        // var currentTime = new Date();
        // var hours = currentTime.getHours();
        // console.log(hours);
        // if (hours >= 10 && hours <= 17){
        //   $('#checkin').prop('enable')
        // }

        // Attempt to get the device's current position using GPS
        navigator.geolocation.getCurrentPosition(
          function (position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;

            console.log('Latitude:', latitude);
            console.log('Longitude:', longitude);

            // Fetch address using reverse geocoding
            getAddress(latitude, longitude);
          },
          function (error) {
            console.error('Error getting location:', error);
          },
          {
            enableHighAccuracy: true, // Request high accuracy
            maximumAge: 0 // Disable caching of location data
          }
        );
        var key = "AIzaSyCeKl2Z36bDY3VKCzF2s50uK6WJcDIWdE0";
        function getAddress(latitude, longitude) {
          fetch(`https://maps.googleapis.com/maps/api/geocode/json?latlng=${latitude},${longitude}&key=${key}`)
            .then(response => response.json())
            .then(data => {
              if (data.status === 'OK') {
                var address = data.results[0].formatted_address;
                console.log('Address:', address);
              } else {
                console.error('Error: Unable to find address');
              }
            })
            .catch(error => {
              console.error('Error fetching address:', error);
            });
        }


        $.ajax({
          url: "<?= base_url('getEmpDetails') ?>",
          method: 'POST',
          data: {
            'email': emp_email
          },
          success: function (response) {
            var email_data = response.message.emp_email;
            var id_data = response.message.emp_id;
            var name_data = response.message.emp_name;
            var phone_data = response.message.emp_phone;

            // Check if Geolocation is supported by the browser
            // Attempt to get the device's current position using GPS
            navigator.geolocation.getCurrentPosition(
              function (position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                var currentDate = new Date();
                var date = currentDate.toLocaleDateString();
                var time = currentDate.toLocaleTimeString();
                console.log('Latitude:', latitude);
                console.log('Longitude:', longitude);

                // Fetch address using reverse geocoding
                getAddress(latitude, longitude);
              },
              function (error) {
                console.error('Error getting location:', error);
              },
              {
                enableHighAccuracy: true, // Request high accuracy
                maximumAge: 0 // Disable caching of location data
              }
            );
            // $.ajax({
            //   url: 'https://ipapi.co/json',
            //   method: 'GET',
            //   success: function (data) {
            //     var currentDate = new Date();
            //     var date = currentDate.toLocaleDateString();
            //     var time = currentDate.toLocaleTimeString();
            //     var city = data.city;
            //     var latitude = data.latitude;
            //     var longitude = data.longitude;

            // Make the third AJAX request inside this success callback
            $.ajax({
              url: "<?= base_url('mark_attendance') ?>",
              method: 'POST',
              data: {
                'id': id_data,
                'name': name_data,
                'email': email_data,
                'phone': phone_data,
                'date': date,
                'time': time,
                'city': city,
                'longitude': longitude,
                'latitude': latitude
              },
              success: function (response) {
                // console.log(response);
                if (response.status == 'success') {
                  table.ajax.reload(null, false);
                }
              },
              error: function (xhr, status, error) {
                console.error('Error marking attendance:', error);
              }
            });
          },
          error: function (xhr, status, error) {
            console.error('Error fetching location details:', error);
          }
        });
      },
        error: function (xhr, status, error) {
          console.error('Error fetching employee details:', error);
        }
        });
    // });
    // });

    // Get session email data
    $.ajax({
      url: "<?= base_url('getSessionEmail') ?>",
      method: 'GET',
      success: function (response) {
        // var sessionEmail = response.email;
        // console.log("session email-> ", sessionEmail);
      },
      error: function (xhr, status, error) {
        // console.error('Error fetching session email:', error);
      }
    });

    // Fetch data of user
    var table = $('#EmpDetails').DataTable({
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
        url: "<?= base_url('fetchEmployeeDetails') ?>",
        type: "GET"
      },
      drawCallback: function (settings) {
        // console.log('Table redrawn:', settings);
      }
    });
  </script>

</body>


</html>
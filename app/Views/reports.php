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
        <!-- <h1> Reports</h1> -->
        <div class="row">
            <div class="col mt-3 ml-4">
                <button class="btn btn-success">Export Excel</button>
            </div>
            <div class="col-lg-3 md-3">
                <label>From:</label>
                <input type="date" class="form-control" name="" id="">
            </div>
            <div class="col-lg-3 md-3">
                <label>To:</label>
                <input type="date" class="form-control" name="" id="">
            </div>
        </div>
        <div class="container">
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th scope="col">Sl. No.</th>
                        <th scope="col">Employee-Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Mobile No.</th>
                        <th scope="col">Date</th>
                        <th scope="col">Check-In</th>
                        <th scope="col">Check-Out</th>
                        <th scope="col">Longitude</th>
                        <th scope="col">Latitude</th>
                        <th scope="col">Location</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>EMP001</td>
                        <td>Shubham</td>
                        <td>Shubham@gmail.com</td>
                        <td>7562378894</td>
                        <td>2/27/2024</td>
                        <td>09:45 AM</td>
                        <td>06:30 PM</td>
                        <td>32.2432° N</td>
                        <td>77.1892° E</td>
                        <td>Manali</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>EMP002</td>
                        <td>Chiranjeevi</td>
                        <td>Chiranjeevi@gmail.com</td>
                        <td>6303124318</td>
                        <td>2/27/2024</td>
                        <td>09:45 AM</td>
                        <td>06:30 PM</td>
                        <td>32.2432° N</td>
                        <td>77.1892° E</td>
                        <td>Manali</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>EMP003</td>
                        <td>Sandeep</td>
                        <td>sandeep@gmail.com</td>
                        <td>6783645189</td>
                        <td>2/27/2024</td>
                        <td>08:45 AM</td>
                        <td>07:30 PM</td>
                        <td>12.9716° N</td>
                        <td>77.5946° E</td>
                        <td>banglore</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>EMP004</td>
                        <td>Sneha</td>
                        <td>sneha@gmail.com</td>
                        <td>9876645189</td>
                        <td>2/27/2024</td>
                        <td>08:45 AM</td>
                        <td>07:30 PM</td>
                        <td>15.9716° N</td>
                        <td>88.5946° E</td>
                        <td>banglore</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>EMP005</td>
                        <td>Kavana</td>
                        <td>kavana@gmail.com</td>
                        <td>7776634699</td>
                        <td>2/27/2024</td>
                        <td>10:00 AM</td>
                        <td>07:30 PM</td>
                        <td>14.2251° N</td>
                        <td>76.3980° E</td>
                        <td>chitradurga</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>EMP006</td>
                        <td>Harsha</td>
                        <td>harsha@gmail.com</td>
                        <td>76451089279</td>
                        <td>2/27/2024</td>
                        <td>09:45 AM</td>
                        <td>07:00 PM</td>
                        <td>18.9716° N</td>
                        <td>78.5946° E</td>
                        <td>banglore</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>EMP007</td>
                        <td>Gangotri</td>
                        <td>gangotri@gmail.com</td>
                        <td>8056431072</td>
                        <td>2/27/2024</td>
                        <td>09:00 AM</td>
                        <td>06:30 PM</td>
                        <td>15.9716° N</td>
                        <td>88.9946° E</td>
                        <td>banglore</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>EMP008</td>
                        <td>sharath</td>
                        <td>sharath@gmail.com</td>
                        <td>7658392019</td>
                        <td>2/27/2024</td>
                        <td>09:30 AM</td>
                        <td>06:00 PM</td>
                        <td>17.9716° N</td>
                        <td>18.5946° E</td>
                        <td>Hasan</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>EMP009</td>
                        <td>Umesh</td>
                        <td>umesh@gmail.com</td>
                        <td>7699017829</td>
                        <td>2/27/2024</td>
                        <td>10:00 AM</td>
                        <td>06:00 PM</td>
                        <td>15.9716° N</td>
                        <td>88.5946° E</td>
                        <td>banglore</td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>EMP010</td>
                        <td>Surabhi</td>
                        <td>surabhi@gmail.com</td>
                        <td>8088763827</td>
                        <td>2/27/2024</td>
                        <td>09:30 AM</td>
                        <td>06:30 PM</td>
                        <td>13.9716° N</td>
                        <td>19.5946° E</td>
                        <td>Hubli</td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td>EMP011</td>
                        <td>sampada</td>
                        <td>sampada@gmail.com</td>
                        <td>7676284910</td>
                        <td>2/27/2024</td>
                        <td>09:30 AM</td>
                        <td>06:30 PM</td>
                        <td>15.9716° N</td>
                        <td>88.5946° E</td>
                        <td>banglore</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?= $this->endSection() ?>
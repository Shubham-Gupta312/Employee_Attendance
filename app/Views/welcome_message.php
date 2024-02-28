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
    
    <style>
.ab{
  background-color:#57D38C!important;
  color:#fff!important;
}

.ba{
  background-color:#f8490c!important;
  color:#fff!important;	
}

.form-holder {
     margin-left: 0px!important; 
    width: 100%;
}

.form-holder .form-content {
    min-height:50%!important;
}


.form-content .form-items {
     max-width: none!important;
}

.form-body {
    height: 50px!important;
}

.table thead th {
    background-color: #064E89;
    color: #fff;
}

.float-right {
    float: right!important;
    margin: 8px 9px 4px 10px;
}
.btn-group-lg>.btn, .btn-lg {
    padding: 4px 10px;
    font-size: 16px;
    line-height: 24px;
}

.modal-footer {
    justify-content: left!important;
}

.form-body {
    background-color: #064E89;
}

table td, th{
    border: 1px solid #ccc;
}
    </style>
</head>
<body>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <button type="button" class="btn btn-primary">Yes </button>
      </div>
    </div>
  </div>
</div>

<!--<div class="container">
          <button class="btn btn-success btn-lg float-right" type="submit">Submit</button>
          </div> -->
          
    <div class="form-body on-top-mobile">
    
  <button class="btn btn-success btn-lg float-right"  data-toggle="modal" data-target="#exampleModal" type="submit"><i class="fas fa-sign-out-alt"></i> Signout </button>
 
       </div>
       
      <div class="form-body on-top-mobile">
          
        <div class="row">
            
            <div class="form-holder">
            
                <div class="form-content">     
               
                    <div class="form-items">
                    <h4 style="text-align:center;"><strong>Marks Attendance </strong> </h4>
                
                        <form>
                        
                        <div class="row top-padding">
                                <div class="col-12 col-sm-2 offset-4">
                                   <div class="form-button">
                                <button id="submit" type="submit" class="ibtn ab"><img src="../assets/images/gallery/in.png"> Check In </button>
                            </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                   <div class="form-button">
                                <button id="submit" type="submit" class="ibtn ba"><img src="../assets/images/gallery/out.png"> Check Out </button>
                            </div>
                                </div>
                            </div>
                
                        </form>
                
                
                      <div class="table-responsive">
                    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Sl.No </th>
      <th scope="col">Employee Id </th>
      <th scope="col">Name </th>
      <th scope="col">Mobile Number </th>
      <th scope="col">Email Id </th>
      <th scope="col">Date </th>
      <th scope="col">Check-in </th>
      <th scope="col">Check-out </th>
      <th scope="col">Longitude </th>
      <th scope="col">Latitude </th>
      <th scope="col">Address </th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>111</td>
      <td>Harsha </td>
      <td>9481100001 </td>
      <td>harsha@savithru.com </td>
      <td>27.02.24 </td>
      <td>9.30 am </td>
      <td>6.30pm </td>
      <td>1234567890 </td>
      <td>9876543210 </td>
      <td>#47, 3rd main, 3rd Cross, Basaveshwaranagar, Bangalore - 560 079 </td>
    </tr>
    
    
    <tr>
      <th scope="row">2</th>
      <td>222</td>
      <td>Ashwin </td>
      <td>9535070020 </td>
      <td>ashwin@savithru.com </td>
      <td>27.02.24 </td>
      <td>9.30 am </td>
      <td>6.30pm </td>
      <td>987654123 </td>
      <td>123456789 </td>
      <td>#48, 3rd main, 3rd Cross, Basaveshwaranagar, Bangalore - 560 079 </td>
    </tr>
    
    <tr>
      <th scope="row">3</th>
      <td>333</td>
      <td>Shumbam </td>
      <td>9489856535 </td>
      <td>harsha@savithru.com </td>
      <td>27.02.24 </td>
      <td>9.30 am </td>
      <td>6.30pm </td>
      <td>1234567890 </td>
      <td>9876543210 </td>
      <td>#43, 3rd main, 3rd Cross, Basaveshwaranagar, Bangalore - 560 079 </td>
    </tr>
   
  </tbody>
</table> </div>
                
                    </div>
                    
                    
                    

                </div>
            </div>
        </div>
    </div>
<script src="../../dist/js/jquery.min.js"></script>
<script src="../../dist/js/popper.min.js"></script>
<script src="../../dist/js/bootstrap.min.js"></script>
<script src="../../dist/js/main.js"></script>
</body>


</html>
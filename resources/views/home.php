<!DOCTYPE html>
<html lang="en">

<head>


<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>WEBINAR ON MUTUAL FUND INVESTMENT ORGANISED BY
ADITYA BIRLA SUN LIFE MUTUAL FUND</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../assets/css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
<?php 
if(empty($semid)){$semid=1;}
if(empty($vendor)){$vendor=1;}
?>

    <div class="col-xl-12 col-lg-12 col-md-12 bg-gradient-secondary text-center" style="background-color: #819F79;"> 
        <img src="../assets/img/header.png" class="img-fluid text-center mx-auto" alt="Responsive image">    
    </div>

  <div class="container">

    <!-- Outer Row -->
    
    <div class="row justify-content-center ">
     

      <div class="col-xl-12 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-1">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6  d-lg-block bg-register-image text-center ">
              <img src="../assets/img/seminar/<?php echo $detailimage ?>" class="img-fluid text-center mx-auto" alt="Responsive image">   

              </div>
              <div class="col-lg-6">
                          <!-- sign up page start-->
                          <div class="p-5">
                            <div class="text-center">
                              <h1 class="h4 text-gray-900 mb-4">Register for Webinar!</h1>
                            </div>
                            <form class="user needs-validation" novalidate action="/register" method="POST">
                              <div class="form-group">
                                
                                  <input type="text" class="form-control form-control-user" name="FirstName" id="FirstName" placeholder="First Name" required>
                                
                                <!--div class="col-sm-6">
                                  <input type="text" class="form-control form-control-user" name="LastName" id="LastName" placeholder="Last Name" >
                                </div/-->
                              </div>
                              <div class="form-group">
                                <input  class="form-control form-control-user" id="phone" name="phone"  type="tel" pattern=".{10}" required placeholder="Phone no." oninput="check(this)"  required>
                              </div>
                              <div class="form-group">
                                <input type="email" class="form-control form-control-user" name="InputEmail"  id="InputEmail" placeholder="Email Address" required>
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>

                              </div>
                              <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                  <input type="text" class="form-control form-control-user" id="city" name="city" placeholder="City" required>
                                </div>
                                <input type="hidden" class="form-control form-control-user" id="semid" name="semid" value="<?php echo $semid;?>" required>
                                <input type="hidden" class="form-control form-control-user" id="vendor" name="vendor" value='<?php echo $vendor;?>' placeholder="vendor" required>
                              </div>
                              <button class="btn btn-google btn-block" name="signupSubmit"  value="signupSubmit">Register for Webinar</button>
                              <br/>Starting in :
                        <h3> <p id="webinar"></p></h3>
                              
                              
                            </form>
                          
                            <div class="text-center">
                              <a class="small" href="/login?semid=<?php echo $semid;?>&vendor=<?php echo $vendor;?>">Already Registered? Login!</a>
                            </div>
                          </div>
                  <!-- sign up page ends-->
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
 <!-- Bootstrap core JavaScript-->
 <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../assets/js/sb-admin-2.min.js"></script>


  <script>
// Set the date we're counting down to
var countDownDate = new Date("<?php echo $Seminardate?>").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("webinar").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("webinar").innerHTML = "Webinar Done";
  }
}, 1000);
</script>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
</body>

</html>

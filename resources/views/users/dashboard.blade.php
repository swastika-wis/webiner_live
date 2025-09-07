<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Webinar Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="{{asset('/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{asset('/assets/css/sb-admin-2.css')}}" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

  

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-aditya topbar mb-4 static-top shadow">

            <img src="{{asset('/assets/img/adb.png')}}" class="img-fluid img-thumbnail" style ="width: 130px;margin-top: 55px;" alt="Responsive image">    
              <!-- Topbar Navbar -->
              <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown no-arrow">
                  <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-white-600 small">Logout </span>
                    <img class="img-profile rounded-circle" src="{{asset('/assets/img/adb.png')}}">
                  </a>
                  <!-- Dropdown - User Information -->
                  <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/logout" data-toggle="modal" data-target="#logoutModal">
                      <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                      Logout
                    </a>
                  </div>
                </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="row">

            <div class="col-lg-8">

              <!-- Default Card Example -->
              <div class="card mb-4" style="min-height:400px">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" >
                <h6 class="m-0 font-weight-bold text-primary">Webinar</h6> 
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button"  onclick="openFullscreen();" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-compress fa-sm fa-fw text-gray-black"></i>
                    </a>
                   
                  </div>
                </div>
                <div class="card-body" id="webinarscreen">

                {{-- <iframe id="bigmarker_embed_conference_room" src="https://www.bigmarker.com/conferences/e5aa5d223f94/attend_check?iframe=true&webcast=true" width="720" height="402" allowfullscreen="allowfullscreen" frameborder="0"></iframe> --}}               

                <iframe id="bigmarker_embed_conference_room" src="https://webinar.zoho.in/meeting/register/embed?sessionId=1347451395" width="720" height="402" allowfullscreen="allowfullscreen" frameborder="0"></iframe>

               

                <button id="joinWebinarBtn" class="btn btn-success">Join Webinar </button>

                  <div class="iframe-container" style="overflow: hidden; position: relative;">
                  <!--iframe allow="microphone; camera" style="border: 0; height: 100%; left: 0; position: absolute; top: 0; width: 100%;" src="https://zoom.us/wc/96348694113/join?prefer=1&un=YnJhamVzaA=="   allow="microphone; camera; fullscreen" frameborder="0"></iframe//-->
                    {{-- <img src="{{asset('/assets/img/seminar')" class="img-fluid text-center mx-auto" alt="Responsive image">    --}}
                    <!--iframe width="720" height="800" src="https://boxcast.tv/view-embed/test-fgunyacksijakhohg2u3?showTitle=0&showDescription=0&showHighlights=0&showRelated=0&showCountdown=1&market=smb&showDocuments=0&showIndex=0&showDonations=0" frameBorder="0" scrolling="auto" allowfullscreen="true" allow="autoplay; fullscreen"></iframe//-->
              </div>
              

              
                </div>
              </div>

              

            </div>
            <div class="col-lg-4">
              <!-- Basic Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Ask Your Question</h6>
                </div>
                <div class="card-body">
                <form class="user needs-validation" novalidate action="/dashboard" type="POST">
                  <div class="input-group">
                    <textarea class="form-control" aria-label="With textarea"></textarea>
                  </div>
                  <hr>
                  <button class="btn btn-google btn-block">Ask Now</button>
                </form>
              </div>
              </div>
              </div>


            </div>
              <!-- end of content /-->

             </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your KreateCommunication 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="/logout">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('/assets/js/sb-admin-2.min.js')}}"></script>
  <script>
var elem = document.getElementById("webinarscreen");
function openFullscreen() {
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.mozRequestFullScreen) { /* Firefox */
    elem.mozRequestFullScreen();
  } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) { /* IE/Edge */
    elem.msRequestFullscreen();
  }
}
</script>

<script>
  document.getElementById('joinWebinarBtn').addEventListener('click', function() {
      window.open(
          "https://webinar.zoho.in/meeting/webinar-start?key=1393371485&x-meeting-org=60046124840",
          "_blank",
          "width=1200,height=800"
      );
  });
</script>

</body>

</html>

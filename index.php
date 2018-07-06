<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v2.0.0
* @link https://coreui.io
* Copyright (c) 2018 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->

<html lang="en" ng-app="simanis">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>SIPUS</title>
    <link rel="icon" href="../other/pavicon.ico" type="image/png">

    <!-- Icons-->
    <link href="vendors/@coreui/icons/css/coreui-icons.min.css" rel="stylesheet">
    <link href="vendors/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="vendors/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
    <link href="vendors/iCheck/square/green.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" />
    <!-- Main styles for this application-->
    <link href="css/style.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link href="vendors/pace-progress/css/pace.min.css" rel="stylesheet">
  </head>
  <body ng-controller="appController" ng-init="checkCookie()" class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show" ng-cloak>
    <!-- loading -->
    <div class="wraploading">
        <div class="lds-css" style="height: 100%">
            <div class="lds-blocks" style="position: fixed;top: 50%;left: 50%;margin-top: -50px;margin-left: -100px;">
                <div style="left:38px;top:38px;animation-delay:0s"></div>
                <div style="left:80px;top:38px;animation-delay:0.1375s"></div>
                <div style="left:122px;top:38px;animation-delay:0.275s"></div>
                <div style="left:38px;top:80px;animation-delay:0.9625000000000001s"></div>
                <div style="left:122px;top:80px;animation-delay:0.41250000000000003s"></div>
                <div style="left:38px;top:122px;animation-delay:0.8250000000000001s"></div>
                <div style="left:80px;top:122px;animation-delay:0.6875s"></div>
                <div style="left:122px;top:122px;animation-delay:0.55s"></div>
            </div>
            <style type="text/css">
            .wraploading {
                height: 100%;
                top: 0;
                position: fixed;
                z-index: 99999999999;
                padding: 0;
                margin: 0;
                width: 100%;
                background-color: rgba(255, 255, 255, 1)
            }

            @keyframes lds-blocks {
                0%,
                12.5% {
                    background: #5699d2
                }
                100%,
                12.625% {
                    background: #F3A738
                }
            }

            @-webkit-keyframes lds-blocks {
                0%,
                12.5% {
                    background: #5699d2
                }
                100%,
                12.625% {
                    background: #F3A738
                }
            }

            .lds-blocks {
                position: relative;
            }

            .lds-blocks div {
                position: absolute;
                width: 40px;
                height: 40px;
                background: #F3A738;
                -webkit-animation: lds-blocks 1.1s linear infinite;
                animation: lds-blocks 1.1s linear infinite
            }

            .lds-blocks {
                width: 152px!important;
                height: 152px!important;
                -webkit-transform: translate(-76px, -76px) scale(.76) translate(76px, 76px);
                transform: translate(-76px, -76px) scale(.76) translate(76px, 76px)
            }
            </style>
        </div>
    </div>
    <!-- content -->
    <div class="app" ng-if="checkCookie()" ng-cloak>
      <header class="app-header navbar">
        <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand"  >
          <img class="navbar-brand-full img-header" src="img/logo.png" width="89" height="25" alt="CoreUI Logo">
          <b class="logo-text">SIPUS</b>
          <img class="navbar-brand-minimized img-header" src="img/logo.png" width="30" height="30" alt="CoreUI Logo">
        </a>
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
          <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="nav navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <img class="img-avatar" src="img/user.png" alt="admin@bootstrapmaster.com">
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-header text-center">
                <strong>Account</strong>
              </div>
              <a class="dropdown-item" ng-click="logout()">
                <i class="fa fa-lock"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </header>
      <div class="app-body">
        <div class="sidebar">
          <nav class="sidebar-nav" ng-if="sesrole==1">
            <ul class="nav">
              <button class="sidebar-minimizer brand-minimizer" type="button"></button>
              <li class="navbar-header text-center">
                <i class="fa fa-user-circle"></i>
                <p>{{sesnama}}</p>
              </li>
              <li class="nav-title">Menu</li>
              <li class="nav-item">
                <a class="nav-link" href="#!/user">
                  <i class="nav-icon fa fa-user"></i> User
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#!/member">
                  <i class="nav-icon fa fa-users"></i> Member
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#!/kategori">
                  <i class="nav-icon fa fa-circle-o"></i> Kategori Buku</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#!/buku">
                  <i class="nav-icon fa fa-circle-o"></i> Data Buku</a>
              </li>
<!--               <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle"  >
                  <i class="nav-icon fa fa-book"></i> Buku</a>
                <ul class="nav-dropdown-items">
                  <li class="nav-item">
                    <a class="nav-link" href="#!/kategori">
                      <i class="nav-icon fa fa-circle-o"></i> Kategori Buku</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#!/buku">
                      <i class="nav-icon fa fa-circle-o"></i> Data Buku</a>
                  </li>
                </ul>
              </li> -->
               <li class="nav-item">
                 <a class="nav-link" href="#!/peminjaman">
                   <i class="nav-icon fa fa-circle-o"></i> Peminjaman</a>
               </li>
               <li class="nav-item">
                 <a class="nav-link" href="#!/pengembalian">
                   <i class="nav-icon fa fa-circle-o"></i> Pengembalian</a>
               </li>
              
            </ul>
          </nav>
          <nav class="sidebar-nav" ng-if="sesrole==2">
            <ul class="nav">
              <button class="sidebar-minimizer brand-minimizer" type="button"></button>
              <li class="navbar-header text-center">
                <i class="fa fa-user-circle"></i>
                <p>{{sesnama}}</p>
              </li>
              <li class="nav-title">Menu</li>
              
              <li class="nav-item">
                <a class="nav-link" href="#!/member">
                  <i class="nav-icon fa fa-users"></i> Member
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#!/peminjaman">
                  <i class="nav-icon fa fa-circle-o"></i> Peminjaman</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#!/pengembalian">
                  <i class="nav-icon fa fa-circle-o"></i> Pengembalian</a>
              </li>
            </ul>
          </nav>
          
        </div>
        <!-- content -->
        <main class="main" ng-view>
          
        </main>
        <!-- end content -->
      </div>
      <footer class="app-footer">
        <div>
          <a href="https://coreui.io">CoreUI</a>
          <span>&copy; 2018 creativeLabs.</span>
        </div>
        <div class="ml-auto">
          <span>Powered by</span>
          <a href="https://coreui.io">CoreUI</a>
        </div>
      </footer>
    </div>
    <div ng-if="!checkCookie()" class="app flex-row align-items-center">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8 col-lg-5">
            <div class="card-group">
              <form class="card p-4" ng-submit="executeLogin()">
                <div class="card-body">
                  <h1>Login</h1>
                  <p class="text-muted">Sign In to your account</p>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="icon-user"></i>
                      </span>
                    </div>
                    <input ng-model="formdata.username" class="form-control" type="text" placeholder="Username">
                  </div>
                  <div class="input-group mb-4">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="icon-lock"></i>
                      </span>
                    </div>
                    <input ng-model="formdata.password" class="form-control" type="password" placeholder="Password">
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <button class="btn btn-primary px-4" type="submit">Login</button>
                    </div>
                  </div>
                </div>
              </form>
              
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- endcontent -->

    <!-- CoreUI and necessary plugins-->
    <script src="https://unpkg.com/sweetalert2@7.0.9/dist/sweetalert2.all.js"></script>
    <script src="vendors/jquery/js/jquery.min.js"></script>
    <script src="vendors/popper.js/js/popper.min.js"></script>
    <script src="vendors/iCheck/icheck.js"></script>
    <script src="vendors/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendors/pace-progress/js/pace.min.js"></script>
    <script src="vendors/perfect-scrollbar/js/perfect-scrollbar.min.js"></script>
    <script src="vendors/@coreui/coreui/js/coreui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    
    <!-- Plugins and scripts required by this view-->
    <script src="vendors/chart.js/js/Chart.min.js"></script>
    <script src="vendors/@coreui/coreui-plugin-chartjs-custom-tooltips/js/custom-tooltips.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script src="js/angular/angular.min.js"></script>
    <script src="js/angular/angular-route.min.js"></script>
    <script src="js/angular/angular-cookies.min.js"></script>
    <!-- js-coockie -->
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <script src="app/appModule.js"></script>
    <script src="app/appRoute.js"></script>
    <script src="app/appController.js"></script>
    <script src="app/appFilter.js"></script>

    <!-- controller -->
    <script src="app/component/user/userCtrl.js"></script>
    <script src="app/component/member/memberCtrl.js"></script>
    <script src="app/component/kategori/kategoriCtrl.js"></script>
    <script src="app/component/buku/bukuCtrl.js"></script>
    <script src="app/component/pinjam/pinjamCtrl.js"></script>
    <script src="app/component/kembali/kembaliCtrl.js"></script>

    <script>
      $(window).on('load',function() {
          $(".wraploading").fadeOut("slow");
      });
    </script>
  </body>
</html>
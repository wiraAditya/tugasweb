var app=angular.module("mahaapp",["ngCookies"]);
// loadScreen
var loadScreen = '<div class="wraploading"><div class="lds-css" style="height: 100%"><div class="lds-blocks" style="position: fixed;top: 50%;left: 50%;margin-top: -50px;margin-left: -100px;"><div style="left:38px;top:38px;animation-delay:0s"></div><div style="left:80px;top:38px;animation-delay:0.1375s"></div><div style="left:122px;top:38px;animation-delay:0.275s"></div><div style="left:38px;top:80px;animation-delay:0.9625000000000001s"></div><div style="left:122px;top:80px;animation-delay:0.41250000000000003s"></div><div style="left:38px;top:122px;animation-delay:0.8250000000000001s"></div><div style="left:80px;top:122px;animation-delay:0.6875s"></div><div style="left:122px;top:122px;animation-delay:0.55s"></div></div><style type="text/css">.wraploading{height:100%;top:0;position:fixed;z-index:99999999999;padding:0;margin:0;width:100%;background-color:rgba(255,255,255,.2)}@keyframes lds-blocks{0%,12.5%{background:#5699d2}100%,12.625%{background:#F3A738}}@-webkit-keyframes lds-blocks{0%,12.5%{background:#5699d2}100%,12.625%{background:#F3A738}}.lds-blocks{position:relative}.lds-blocks div{position:absolute;width:40px;height:40px;background:#F3A738;-webkit-animation:lds-blocks 1.1s linear infinite;animation:lds-blocks 1.1s linear infinite}.lds-blocks{width:152px!important;height:152px!important;-webkit-transform:translate(-76px,-76px) scale(.76) translate(76px,76px);transform:translate(-76px,-76px) scale(.76) translate(76px,76px)}</style></div></div>';

appController.$inject = ['$http', '$scope', '$rootScope', '$cookies'];

app.controller('appController', appController);
function appController($http, $scope, $rootScope, $cookies) {
	$scope.formdata={};

  //COOKIES MANAGEMENT
  //set cookie 
  $rootScope.setCookie = function () {
    var expireDate = new Date();
    expireDate.setDate(expireDate.getDate() + 30);
    $cookies.put('id', $rootScope.id, {
      'expires': expireDate
    });
    $cookies.put('username', $rootScope.username, {
      'expires': expireDate
    });
  }

  //set cookie
  $rootScope.getCookie = function (x) {
    return $cookies.get(x);
  }

  //clear cookie
  $rootScope.clearCookie = function () {
    $cookies.remove('id');
    $cookies.remove('nama');
  }

  //chek cookie
  $rootScope.checkCookie = function () {
    if ( $scope.getCookie('id') && $scope.getCookie('username')) {
      $rootScope.sessionId = $scope.getCookie('id');
      $rootScope.sessionUsername = $scope.getCookie('username');
      return true;
    } else {
      return false;
    }
    // console.log($scope.getCookie('id'));
  }
  $rootScope.executeLogin = function() {
    $("body").append('<div class="wraploading"><div class="lds-css" style="height: 100%"><div class="lds-blocks" style="position: fixed;top: 50%;left: 50%;margin-top: -50px;margin-left: -100px;"><div style="left:38px;top:38px;animation-delay:0s"></div><div style="left:80px;top:38px;animation-delay:0.1375s"></div><div style="left:122px;top:38px;animation-delay:0.275s"></div><div style="left:38px;top:80px;animation-delay:0.9625000000000001s"></div><div style="left:122px;top:80px;animation-delay:0.41250000000000003s"></div><div style="left:38px;top:122px;animation-delay:0.8250000000000001s"></div><div style="left:80px;top:122px;animation-delay:0.6875s"></div><div style="left:122px;top:122px;animation-delay:0.55s"></div></div><style type="text/css">.wraploading{height:100%;top:0;position:fixed;z-index:99999999999;padding:0;margin:0;width:100%;background-color:rgba(255,255,255,.2)}@keyframes lds-blocks{0%,12.5%{background:#5699d2}100%,12.625%{background:#F3A738}}@-webkit-keyframes lds-blocks{0%,12.5%{background:#5699d2}100%,12.625%{background:#F3A738}}.lds-blocks{position:relative}.lds-blocks div{position:absolute;width:40px;height:40px;background:#F3A738;-webkit-animation:lds-blocks 1.1s linear infinite;animation:lds-blocks 1.1s linear infinite}.lds-blocks{width:152px!important;height:152px!important;-webkit-transform:translate(-76px,-76px) scale(.76) translate(76px,76px);transform:translate(-76px,-76px) scale(.76) translate(76px,76px)}</style></div></div>');
    //sementara 
    $(".wraploading").remove();
    console.log();
    $rootScope.id = 1;
    $rootScope.username = $scope.formdata.username;
    $scope.setCookie();
    // window.location.reload();
    // $http.post('app/component/_login/login.php', {
    //     'username': $scope.username,
    //     'password': $scope.password,
    // }).then(function(response) {
    //   $(".wraploading").remove();
    //     if (response.data.success) {
    //         var idSessionUser = $rootScope.id = response.data.data.id;
    //         $rootScope.nama = response.data.data.nama;
    //         $rootScope.bidangId = response.data.data.bidangID,
    //             $rootScope.group = response.data.data.group,
    //             $scope.setCookie();
    //         window.location.href = '#!/';
    //     } else {
    //         swal(
    //             'Kesalahan',
    //             response.data.message,
    //             'error'
    //         )
    //     }
    // })
  }
}

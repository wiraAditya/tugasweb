app.controller('jenisController', function($rootScope, $scope, $http) {

    var readPHP = 'app/component/jenis/api/jenisRead.php';
    var deletePHP = 'app/component/jenis/api/jenisDelete.php';
    var actionPHP = 'app/component/jenis/api/jenisInsert.php';
    $scope.statusfilter="1";
    //read jenis
    $scope.readData = function() {
        $scope.datafilter = [];
        $http.post(readPHP, {
        }).then(function(response) {
            $scope.datajenis = response.data.jenis;
        })
    }

    //start header informasi
    $scope.startInsert = function() {
        $scope.header = "Tambahkan Jenis";
        $scope.jenisID = '';
        $scope.no = ''; 
        $scope.no = ''; 
        $scope.status = "1"; 
        $('#status').iCheck('check');
        $('input').on('ifUnchecked', function(event){
          $scope.status =0;
        });
        $('input').on('ifChecked', function(event){
          $scope.status =1;
        });
    }

    //delete informasi
    $scope.delete = function(id, info) {
        swal({
            title: 'Hapus',
            text: "Apakah anda ingin menghapus jenis ? ",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then(function(result) {
            if (result.value) {
                $("body").append(loadScreen);
                $http.post(deletePHP, {
                    'id': id,
                    'userID': $rootScope.sessionId,
                    'jenis': info ? info : '',
                }).then(function(response) {
                    $(".wraploading").remove();
                    if (response.data.success) {
                        swal(
                            'Sukses',
                            response.data.message,
                            'success',
                        );
                        $scope.readData();
                    } else {
                        swal(
                            'Error',
                            response.data.message,
                            'error',
                        )
                    }
                })
            };
        })
    }

    //clear form modal hide
    $('#modalSubmit').on('hidden.bs.modal', function() {
        $scope.header = '';
        $scope.jenis = '';
        $scope.no = '';
        $scope.status = '';
    })

    //read edit
    $scope.readEdit = function(idArrayData) {
      $scope.header = "Edit Jenis";
      var dataEdit = $scope.datafilter[idArrayData];
      $scope.jenisID = dataEdit._jenisID;
      $scope.jenis = dataEdit._jenis;
      $scope.no = dataEdit._no;
      $scope.status = dataEdit._status;
      if ($scope.status ==1) {
        $('#status').iCheck('check');
      }else{
        $('#status').iCheck('uncheck');
      }
      $('input').on('ifUnchecked', function(event){
        $scope.status =0;
      });
      $('input').on('ifChecked', function(event){
        $scope.status =1;
      });
                                    
    }


    $scope.action = function() {
        console.log($scope.status);
        $("body").append(loadScreen);

        $http.post(actionPHP, {
            'id': $scope.jenisID ? $scope.jenisID : '',   
            'jenis': $scope.jenis,
            'no': $scope.no,
            'status': $scope.status,
            'userID': 1,
        }).then(function(response) {
            $(".wraploading").remove();
            if (response.data.success) {
                swal(
                    'Sukses',
                    response.data.message,
                    'success',
                );
                $scope.readData();
                $('#modalSubmit').modal('hide');
            } else {
                swal(
                    'Gagal',
                    response.data.message,
                    'error',
                )
                swal.closeModal()
            }
        })
    }
});

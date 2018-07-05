app.controller('userCtrl', function($rootScope, $scope, $http) {

    var readPHP = 'app/component/user/api/read.php';
    var deletePHP = 'app/component/user/api/delete.php';
    var actionPHP = 'app/component/user/api/insert.php';
    $scope.statusfilter="1";
    //read jenis
    $scope.readData = function() {
        $http.post(readPHP, {
        }).then(function(response) {
            $scope.datauser = response.data.user;
        })
    }

    //start header informasi
    $scope.startInsert = function() {
        $scope.header = "Tambahkan User";
        $scope.idUser = '';
        $scope.un = ''; 
        $scope.pw = ''; 
        $scope.nama = ""; 
        $scope.alamat = ""; 
        $scope.telp = ""; 
        $scope.role = "1"; 
    }

    //delete 
    $scope.delete = function(id, info) {
        swal({
            title: 'Hapus',
            text: "Apakah anda ingin menghapus user ? ",
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
                    'id': id
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
        $scope.idUser = '';
        $scope.un = ''; 
        $scope.pw = ''; 
        $scope.nama = ""; 
        $scope.alamat = ""; 
        $scope.telp = ""; 
        $scope.role = "1";
    })

    //read edit
    $scope.readEdit = function(idArrayData) {
      $scope.header = "Edit User";
      var dataEdit = $scope.datauser.find( data => data.idUser === idArrayData );
      $scope.idUser = dataEdit.idUser;
      $scope.un = dataEdit.un; 
      $scope.pw = ""; 
      $scope.nama = dataEdit.nama; 
      $scope.alamat = dataEdit.alamat; 
      $scope.telp = dataEdit.telp; 
      $scope.role = dataEdit.role; 
    }


    $scope.action = function() {
        console.log($scope.status);
        $("body").append(loadScreen);
        $http.post(actionPHP, {
            'idUser': $scope.idUser,   
            'un': $scope.un,   
            'pw': $scope.pw,   
            'nama': $scope.nama,   
            'alamat': $scope.alamat,   
            'telp': $scope.telp,   
            'role': $scope.role 
            
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
            }
        })
    }
});

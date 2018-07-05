app.controller('memberCtrl', function($rootScope, $scope, $http) {

    var readPHP = 'app/component/member/api/read.php';
    var deletePHP = 'app/component/member/api/delete.php';
    var actionPHP = 'app/component/member/api/insert.php';
    $scope.statusfilter="1";
    //read jenis
    $scope.readData = function() {
        $http.post(readPHP, {
        }).then(function(response) {
            $scope.datamember = response.data.member;
        })
    }

    //start header informasi
    $scope.startInsert = function() {
        $scope.header = "Tambahkan Member";
        $scope.idMember = '';
        $scope.nama = ""; 
        $scope.alamat = ""; 
        $scope.noTelp = ""; 
        $scope.noKtp = ""; 
    }

    //delete 
    $scope.delete = function(id, data) {
        swal({
            title: 'Hapus',
            text: "Apakah anda ingin menghapus member "+data+" ? ",
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
        $scope.idMember = '';
        $scope.nama = ""; 
        $scope.alamat = ""; 
        $scope.noTelp = ""; 
        $scope.noKtp = ""; 
    })

    //read edit
    $scope.readEdit = function(idArrayData) {
      $scope.header = "Edit User";
      var dataEdit = $scope.datamember.find( data => data.idMember === idArrayData );
      $scope.idMember = dataEdit.idMember;
      $scope.nama = dataEdit.nama; 
      $scope.alamat = dataEdit.alamat; 
      $scope.noTelp = dataEdit.noTelp; 
      $scope.noKtp = dataEdit.noKtp; 
    }


    $scope.action = function() {
        console.log($scope.status);
        $("body").append(loadScreen);
        $http.post(actionPHP, {
            'idMember': $scope.idMember,
            'nama': $scope.nama,
            'alamat': $scope.alamat,
            'telp': $scope.noTelp,
            'noKtp': $scope.noKtp
            
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

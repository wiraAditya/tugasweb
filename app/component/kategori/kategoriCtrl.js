app.controller('kategoriCtrl', function($rootScope, $scope, $http) {

    var readPHP = 'app/component/kategori/api/read.php';
    var deletePHP = 'app/component/kategori/api/delete.php';
    var actionPHP = 'app/component/kategori/api/insert.php';
    $scope.statusfilter="1";
    //read jenis
    $scope.readData = function() {
        $http.post(readPHP, {
        }).then(function(response) {
            $scope.datakat = response.data.kategori;
        })
    }

    //start header informasi
    $scope.startInsert = function() {
        $scope.header = "Tambahkan Kategori";
        $scope.idKategori = '';
        $scope.kategori = ""; 
    }

    //delete 
    $scope.delete = function(id, data) {
        swal({
            title: 'Hapus',
            text: "Apakah anda ingin menghapus kategori "+data+" ? ",
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
        $scope.idKategori = '';
        $scope.kategori = ""; 
    })

    //read edit
    $scope.readEdit = function(idArrayData) {
      $scope.header = "Edit User";
      var dataEdit = $scope.datakat.find( data => data.idKategori === idArrayData );
        $scope.idKategori = dataEdit.idKategori;
        $scope.kategori = dataEdit.kategori; 
    }


    $scope.action = function() {
        console.log($scope.status);
        $("body").append(loadScreen);
        $http.post(actionPHP, {
            'idKategori': $scope.idKategori,
            'kategori': $scope.kategori
            
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

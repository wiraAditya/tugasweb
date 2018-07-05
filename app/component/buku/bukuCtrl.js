app.controller('bukuCtrl', function($rootScope, $scope, $http) {

    var readPHP = 'app/component/buku/api/read.php';
    var deletePHP = 'app/component/buku/api/delete.php';
    var actionPHP = 'app/component/buku/api/insert.php';
    //read jenis
    $scope.readData = function() {
        $http.post(readPHP, {
        }).then(function(response) {
            $scope.dataBuku = response.data.buku;
        })
    }
    $scope.readKat = function() {
        $http.post("app/component/kategori/api/read.php", {
        }).then(function(response) {
            $scope.dataKat = response.data.kategori;
        })
    }

    //start header informasi
    $scope.startInsert = function() {
        $scope.header = "Tambahkan Member";
        $scope.idBuku = '';
        $scope.judul = ""; 
        $scope.kategori = ""; 
        $scope.penerbit = ""; 
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
        $scope.idBuku = '';
        $scope.judul = ""; 
        $scope.kategori = ""; 
        $scope.penerbit = "";
    })

    //read edit
    $scope.readEdit = function(idArrayData) {
      $scope.header = "Edit User";
      var dataEdit = $scope.dataBuku.find( data => data.idBuku === idArrayData );
      $scope.idBuku = dataEdit.idBuku;
      $scope.judul = dataEdit.judul; 
      $scope.kategori = dataEdit.idKategori; 
      $scope.penerbit = dataEdit.penerbit; 
    }


    $scope.action = function() {
        console.log($scope.status);
        $("body").append(loadScreen);
        $http.post(actionPHP, {
            'idBuku': $scope.idBuku,
            'judul': $scope.judul,
            'idKategori': $scope.kategori,
            'penerbit': $scope.penerbit,
            
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

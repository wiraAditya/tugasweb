app.controller('pengembalianCtrl', function($rootScope, $scope, $http,$filter) {

    var readPHP = 'app/component/kembali/api/read.php';
    var deletePHP = 'app/component/kembali/api/delete.php';
    var actionPHP = 'app/component/kembali/api/insert.php';
    //read 
    $scope.readDetailTr = function (idPin) {
        var dataEditpin = $scope.datagetpin.find( data => data.idPin === idPin );
        $scope.kodepin = dataEditpin.kode;
        $scope.memberpin = dataEditpin.member;
        $scope.tglKembalipin = dataEditpin.tglKembali;
        $scope.tglPinjampin = dataEditpin.tglPinjam;
        console.log(dataEditpin);
        $scope.bukusetTable(dataEditpin.idBuku);
    }
    $scope.readPinjam = function (id="") {
        $http.post('app/component/pinjam/api/read.php', {
            'kembali':true ,
            'idPin':id
        }).then(function(response) {
            $scope.datagetpin = response.data.pinjam;
        })
    }
    $scope.readData = function() {
        $http.post(readPHP, {
        }).then(function(response) {
            $scope.dataKembali = response.data.kembali;
        })
    }
    $scope.readDataBuku = function() {
        $http.post('app/component/buku/api/read.php', {
        }).then(function(response) {
            $scope.dataBuku = response.data.buku;
        })
    }
        $scope.readDataBuku();

    $scope.bukusetTable = function (idbuku) {
      console.log(idbuku)
      $scope.datasettable=[];
      $scope.datasettable[0] = $scope.dataBuku.find( data => data.idBuku === idbuku );
    
    }
    //start header informasi
    $scope.startInsert = function() {
        $scope.readPinjam();
        $scope.header = "Tambahkan Pengembalian";
        $scope.idKembali = '';
        $scope.tglKembali = ""; 
        $scope.denda = ""; 
        $scope.idPin = ""; 
    }

    //delete 
    $scope.delete = function(id, data) {
        swal({
            title: 'Hapus',
            text: "Apakah anda ingin menghapus member ? ",
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
        $scope.idKembali = '';
        $scope.tglKembali = ""; 
        $scope.denda = ""; 
        $scope.idPin = ""; 
    })

    //read edit
    $scope.readEdit = function(idArrayData) {
        
      $scope.header = "Edit Pengembalian";
      var dataEdit = $scope.dataKembali.find( data => data.idKembali === idArrayData );
      console.log(dataEdit);
      $scope.idKembali = dataEdit.idKembali;
      $scope.tglKembali = dataEdit.tglKembali; 
      $scope.denda = dataEdit.denda; 
      $scope.idPin = dataEdit.idPin; 
      $scope.readPinjam(dataEdit.idPin);
    }


    $scope.action = function() {
        $("body").append(loadScreen);
        $http.post(actionPHP, {
            'idKembali':$scope.idKembali,
            'tglKembali':$scope.tglKembali,
            'denda':$scope.denda, 
            'idPin':$scope.idPin,
            'idUser':$rootScope.sesid
            
            
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

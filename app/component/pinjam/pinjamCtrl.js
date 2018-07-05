app.controller('pinjamCtrl', function($rootScope, $scope, $http) {

    var readPHP = 'app/component/pinjam/api/read.php';
    var deletePHP = 'app/component/pinjam/api/delete.php';
    var actionPHP = 'app/component/pinjam/api/insert.php';
    //read jenis
    $scope.readData = function() {
        $http.post(readPHP, {
        }).then(function(response) {
            $scope.datamember = response.data.member;
        })
    }
    $scope.readDataDetail = function(idPinjam) {
        $http.post('app/component/pinjam/api/readDetail.php', {
            'idPinjam':idPinjam
        }).then(function(response) {
            $scope.datamember = response.data.member;
        })
    }

    //start header informasi
    $scope.startInsert = function() {
        $scope.header = "Tambahkan Pinjam";
        $scope.idPinjam = '';
        $scope.tglPinjam = ""; 
        $scope.tglKembali = ""; 
        $scope.jaminan = ""; 
        $scope.member = "";
        $scope.bukupijam =[]; 
    }

    //delete 
    $scope.delete = function(id, data) {
        swal({
            title: 'Hapus',
            text: "Apakah anda ingin menghapus peminjaman "+data+" ? ",
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
        $scope.idPinjam = '';
        $scope.tglPinjam = ""; 
        $scope.tglKembali = ""; 
        $scope.jaminan = ""; 
        $scope.member = "";
        $scope.bukupijam =[];  
    })

    //read edit
    $scope.readEdit = function(idArrayData) {
      $scope.header = "Edit Peminjaman";
      var dataEdit = $scope.datamember.find( data => data.idMember === idArrayData );
      $scope.idPinjam =dataEdit.idPin;
      $scope.tglPinjam = dataEdit.tglPinjam;
      $scope.tglKembali = dataEdit.tglKembali;
      $scope.jaminan = dataEdit.jaminan;
      $scope.member =dataEdit.idMember;
      
      $scope.bukupijam =$scope.readDataDetail(dataEdit.idPin);
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

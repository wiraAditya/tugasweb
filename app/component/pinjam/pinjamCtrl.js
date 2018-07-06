app.controller('pinjamCtrl', function($rootScope, $scope, $http) {

    var readPHP = 'app/component/pinjam/api/read.php';
    var deletePHP = 'app/component/pinjam/api/delete.php';
    var actionPHP = 'app/component/pinjam/api/insert.php';
    //read jenis
    $scope.readData = function() {
        $http.post(readPHP, {
        }).then(function(response) {
            $scope.datapinjam = response.data.pinjam;
        })
    }
    $scope.readDataMember = function() {
        $http.post('app/component/member/api/read.php', {
        }).then(function(response) {
            $scope.dataMember = response.data.member;
        })
    }

    $scope.readDataBuku = function() {
        $http.post('app/component/buku/api/read.php', {
        }).then(function(response) {
            $scope.dataBuku = response.data.buku;
        })
    }
    $scope.bukusetTable = function (idbuku) {
      $scope.datasettable=[];
      $scope.datasettable[0] = $scope.dataBuku.find( data => data.idBuku === idbuku );
    
    }
    //start header informasi
    $scope.startInsert = function() {
        $scope.header = "Tambahkan Pinjam";
        $scope.tglPinjam = ""; 

        var date = new Date();
        $scope.kode = date.getFullYear()+""+date.getMonth()+1+""+date.getDate()+""+date.getHours()+""+date.getMinutes()+""+date.getSeconds();
        $scope.tglKembali = ""; 
        $scope.tglPinjam  = ""; 
        $scope.jaminan = ""; 
        $scope.member = "";
        $scope.idBuku = ""; 
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
        $scope.tglKembali = ""; 
        $scope.tglPinjam  = ""; 
        $scope.jaminan = ""; 
        $scope.member = "";
        $scope.idBuku = "";   
    })

    //read edit
    $scope.readEdit = function(idArrayData) {
      $scope.header = "Edit Peminjaman";
      var dataEdit = $scope.datapinjam.find( data => data.idPin === idArrayData );
      $scope.idPinjam =dataEdit.idPin;
      $scope.tglPinjam = dataEdit.tglPinjam;
      $scope.tglKembali = dataEdit.tglKembali;
      $scope.jaminan = dataEdit.jaminan;
      $scope.member =dataEdit.idMember;
      $scope.kode =dataEdit.kode;
      
      $scope.idBuku =dataEdit.idBuku;
      $scope.bukusetTable(dataEdit.idBuku);
    }

    $scope.action = function() {
        console.log($scope.status);
        $("body").append(loadScreen);
        $http.post(actionPHP, {
            'idPin':$scope.idPinjam,
            'tglPinjam':$scope.tglPinjam,
            'tglKembali':$scope.tglKembali,
            'jaminan':$scope.jaminan,
            'idMember':$scope.member,
            'kode':$scope.kode,
            'idBuku' : $scope.idBuku,
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

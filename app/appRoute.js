app.config(function ($routeProvider) {
    $routeProvider
        .when("/", {
            templateUrl: "app/component/dashboard/dashboard.html"
        })
        .when("/user", {
            templateUrl: "app/component/user/user.html",
            controller:"userCtrl"
        })
        .when("/member", {
            templateUrl: "app/component/member/member.html",
            controller:"memberCtrl"
        })
        .when("/kategori", {
            templateUrl: "app/component/kategori/kategori.html",
            controller:"kategoriCtrl"
        })
        .when("/buku", {
            templateUrl: "app/component/buku/buku.html",
            controller:"bukuCtrl"
        })
        .when("/peminjaman", {
            templateUrl: "app/component/pinjam/pinjam.html",
            controller:"pinjamCtrl"
        })
        .when("/pengembalian", {
            templateUrl: "app/component/kembali/kembali.html",
            controller:"kembaliCtrl "
        })
        .otherwise({
            redirectTo: '/',
            templateUrl: 'app/component/dashboard/dashboard.html'
        })
});
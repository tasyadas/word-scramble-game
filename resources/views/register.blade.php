<!DOCTYPE html>
<html lang="en" class="full-height">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Word Scramble Game</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('css/scrolling-nav.css')}}" rel="stylesheet">
    <link href="{{asset('css/rjcustoms.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/icofont/icofont.min.css')}}" rel="stylesheet">

    <link href="{{asset('vendor/splide/css/splide.min.css')}}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,500,500i,600,600i,700,700i|Roboto:400,400i,500,500i,700,700i&display=swap" rel="stylesheet">

    <style type="text/css">
        .full-height {height: 100% !important;}
    </style>

</head>

<body class="reg-page full-height valign-wrapper">

    <div class="valign-box">
        <div class="container">
            <div class="card no-margin">
                <div class="card-body pt-30 pr-30 pb-30 pl-30">
                    <div class="row">
                        <div class="col-md-8 valign-wrapper">
                            <div class="valign-box text-center">
                                <img src="{{ asset('img-reg.svg')}}" class="img-reg" alt="Image">
                            </div>
                        </div>
                        <div class="col-md-4 valign-wrapper">
                            <div class="valign-box">
                                <div class="text-center mb-30">
                                    <div class="h3 colo-second title-font bold lh-1">Word Scrambler</div>
                                    <div class="color-second">
                                        <span class="text-muted">Silakan isi data Anda untuk mendaftar.</span>
                                    </div>
                                </div>
                                <form class="reg-box" id="formdaftar" method="post">
                                    <div class="form-group relative-box">
                                        <i class="icofont icofont-user-alt-4"></i>
                                        <input type="text" id="nama_lengkap_daftar" name="name" class="form-control title-font medium" placeholder="Nama Lengkap">
                                    </div>
                                    <div class="form-group relative-box">
                                        <i class="icofont icofont-email"></i>
                                        <input type="text" id="email_daftar" name="email" class="form-control title-font medium" placeholder="Email">
                                    </div>
                                    <div class="form-group relative-box">
                                        <i class="icofont icofont-ui-lock"></i>
                                        <input type="password" id="password_daftar" name="password" class="form-control title-font medium" placeholder="Password">
                                    </div>
                                    <div class="text-center">
                                        <input type="submit" id="submit_daftar" name="submit_daftar" class="btn btn-main btn-reg" value="Daftar">
                                    </div>
                                </form>

                                <br>
                                <div id="loading_daftar">Loading...</div>

                                <br>
                                <div id="keterangan"></div>

                                <div class="mt-30 text-center colo-second">
                                    Sudah punya akun? <a href="{{ url('/') }}" class="color-main">Login</a>.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/splide/js/splide.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Plugin JavaScript -->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom JavaScript for this theme -->
    <script src="{{asset('js/scrolling-nav.js')}}"></script>

    <!-- Ajax for regist new user -->
    <script>
        $(document).ready(function() {
            $('#formdaftar').submit(function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                daftar();
            });
        });

        function daftar() {
            visible('loading_daftar',1);
            gagal(0);
            sukses(0);
            $.ajax({
                url: "{{env('MIX_APP_URL')}}/api/auth/register",
                method: "POST",
                data: $('#formdaftar').serialize(),
                dataType: "json",
                success: function(pesan) {
                    if( parseInt(pesan.response_code) == "00" ) {
                        sukses(1,pesan.teks);
                        $("#nama_lengkap_daftar").val('');
                        $("#email_daftar").val('');
                        $("#password_daftar").val('');
                        window.location.href = "{{ url('/') }}"
                    }
                    else if( parseInt(pesan.status) == 0 ) {
                        gagal(1,pesan.teks);
                    }
                    visible('loading_daftar',0);
                }
            });
        }

        function visible(seleksi,status) {
            if(status) $('#'+seleksi).css('visibility','visible');
            else $('#'+seleksi).css('visibility','hidden');
        }

        function gagal(status,teks) {
            visible('keterangan',status);
            if(teks) $('#keterangan').html(teks);
            $('#keterangan').removeClass('sukses').addClass('gagal');
        }

        function sukses(status,teks) {
            visible('keterangan',status);
            if(teks) $('#keterangan').html(teks);
            $('#keterangan').removeClass('gagal').addClass('sukses');
        }
    </script>

</body>

</html>

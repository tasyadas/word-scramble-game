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
                            <img src="{{ asset('img-login.svg')}}" class="img-reg img-login" alt="Image">
                        </div>
                    </div>
                    <div class="col-md-4 valign-wrapper">
                        <div class="valign-box">
                            <div class="text-center mb-15">
                                <div class="h3 colo-second title-font bold lh-1">Word Scrambler</div>
                                <div class="color-second">
                                    <span class="text-muted">Silakan Login.</span>
                                </div>
                            </div>
                            <form class="reg-box" id="formlogin" method="post">
                                <div class="form-group relative-box">
                                    <i class="icofont icofont-envelope"></i>
                                    <input type="text" id="email_login" name="email" class="form-control" placeholder="Email">
                                </div>
                                <div class="form-group relative-box">
                                    <i class="icofont icofont-ui-lock"></i>
                                    <input type="password" id="password_login" name="password" class="form-control" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                <label class="custom-control-label text-small" style="padding-top:2px;" for="customCheck1">Ingat saya</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-main btn-reg"><i class="icofont-login"></i> Login</button>
                                </div>
                            </form>
                            <div class="text-center mt-30">
                                Belum punya akun? <a href="{{url('/register')}}" class="colcor-main">Daftar</a>
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

<!-- Ajax for user login -->
<script>
    $(document).ready(function() {
        $('#formlogin').submit(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            login();
        });

    });

    function login() {
        visible('check',1);
        gagal(0);
        $.ajax({
            url: "{{env('MIX_APP_URL')}}/api/auth/login",
            method: "POST",
            data: $('#formlogin').serialize(),
            dataType: "json",
            success: function(pesan) {
                if( parseInt(pesan.token) !== undefined) {
                    document.cookie = `cookie=${pesan.token}`
                    const cookieValue = document.cookie
                        .split('; ')
                        .find(row => row.startsWith('cookie'))
                        .split('=')[1];
                    checkRedirect(cookieValue);
                }
                else {
                    gagal(1,pesan.teks);
                }
                visible('loading_daftar',0);
            }
        });
    }

    function checkRedirect(token) {
        console.log(token)
        $.ajax({
            url: "{{ env('MIX_APP_URL') }}/api/user",
            type: 'GET',
            // Fetch the stored token from localStorage and set in the header
            headers: {"Authorization": 'Bearer ' + token}
        }).then((result) => {
            if (result.role.name === 'admin') {
                window.location.href = "{{ url('/admin') }}"
            } else {
                window.location.href = "{{ url('/home') }}"
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
</script>

</body>

</html>

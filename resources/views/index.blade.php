<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{asset('css/style_2.css')}}">

    <title>Word Scramble Game</title>
</head>
<body>
<div class="container">
    <header>
        <div class="user">
            <img src="{{asset('minion.png')}}" alt="image user">
            <p id="user-name"></p>
        </div>
        <div class="score">
            <p id="user-score">SCORE: </p>
        </div>
        <div class="menu">
            <button type="submit" id="logout">LOGOUT</button>
        </div>
    </header>
    <section class="section1">
        <div>
            <p>Scrambled Word :</p>
        </div>
        <div class="word-rounded">
        </div>
        <form id="answered" method="post">
            <input type="text" id="jawaban" name="answer" class="form-control" autocomplete="off">
            <input type="hidden" name="word_id" id="word_id">
            <div class="action">
                <button type="submit">Submit</button>
            </div>
        </form>
    </section>
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
    const cookieValue = document.cookie
                        .split('; ')
                        .find(row => row.startsWith('cookie'))
                        .split('=')[1];

    $(document).ready(function() {
        user();
        fetchSoal();
        $('#logout').click(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                    "Authorization": 'Bearer ' + cookieValue
                }
            });
            logout();
        });

        $('#answered').submit(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                    "Authorization": 'Bearer ' + cookieValue
                }
            });
            answer();
        });

    });

    function answer() {
        $.ajax({
            url: "{{env('MIX_APP_URL')}}/api/word/answer-question",
            method: "POST",
            data: $('#answered').serialize(),
            dataType: "json",
            success: function(result) {
                if( parseInt(result) !== undefined ) {
                    $("#jawaban").val('');
                    fetchSoal();
                    user()
                }
            }
        });
    }

    function user() {
        $.ajax({
            url: "{{ env('MIX_APP_URL') }}/api/user",
            type: 'GET',
            // Fetch the stored token from localStorage and set in the header
            headers: {"Authorization": 'Bearer ' + cookieValue}
        }).then((result) => {
            $('#user-name').text(result.name);
            $('#user-score').text(`SCORE: ${result.score}`);
        });
    }

    function fetchSoal() {
        $.ajax({
            url: "{{ env('MIX_APP_URL') }}/api/word/show-question",
            type: 'GET',
            // Fetch the stored token from localStorage and set in the header
            headers: {"Authorization": 'Bearer ' + cookieValue}
        }).then((result) => {
            let soal = result.question
            let splittedSoal = soal.toUpperCase().split('')
            let long = 0
            $('.word-rounded').empty();

            while (long < splittedSoal.length) {
                let now = splittedSoal[long]
                $('.word-rounded').append(
                    $(`<div class="word1"><p>${now}</p></div>`)
                );
                long++
            }

            $('#word_id').val(result.word_id);
        });
    }

    function logout() {
        $.ajax({
            url: "{{ env('MIX_APP_URL') }}/api/auth/logout",
            type: 'POST',
            // Fetch the stored token from localStorage and set in the header
            headers: {"Authorization": 'Bearer ' + cookieValue}
        }).then((result) => {
            window.location.href = "{{ url('/') }}"
        });
    }
</script>

</body>
</html>

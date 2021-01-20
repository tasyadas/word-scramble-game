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
        <div class="menu">
            <button type="submit" id="logout">LOGOUT</button>
        </div>
    </header>
    <section class="section1">
        <div>
            <p>Player History :</p>
        </div>
    </section>
    <section>
        <table id="example" class="table-sm table-striped table-bordered thead-light" style="width:60%">
            <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Score</th>
            </tr>
            </thead>
            <tbody id="dataTable">
            </tbody>
            <tfoot>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Score</th>
            </tr>
            </tfoot>
        </table>
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
        scoreTable();
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

    });

    function user() {
        $.ajax({
            url: "{{ env('MIX_APP_URL') }}/api/user",
            type: 'GET',
            // Fetch the stored token from localStorage and set in the header
            headers: {"Authorization": 'Bearer ' + cookieValue}
        }).then((result) => {
            $('#user-name').text(`Admin ${result.name}`);
        });
    }

    function scoreTable() {
        $.ajax({
            url: "{{ env('MIX_APP_URL') }}/api/history",
            type: 'GET',
            // Fetch the stored token from localStorage and set in the header
            headers: {"Authorization": 'Bearer ' + cookieValue}
        }).then((result) => {
            let long = 0
            while (long < result.length) {
                let now = result[long]
                $('#dataTable').append(
                    $(`<tr>
                        <td>${long+1}</td>
                        <td>${now.name}</td>
                        <td>${now.email}</td>
                        <td>${now.score}</td>
                      </tr>`)
                );
                long++
            }
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

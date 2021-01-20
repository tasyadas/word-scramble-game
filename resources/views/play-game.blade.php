<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="app.js" defer></script>
    <title>{{ 'Word Scramble Game' }}</title>
  </head>
  <body class="background">

    <!-- Button trigger modal -->
  <button type="button" class=" btn btn-outline-light ml-3 mt-3 mb-4 btn-sm " data-toggle="modal"
  data-target="#exampleModal">
      About
</button>

  <!-- Modal -->
  <div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content background text-light">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">About</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-lead h5">
word-scrambler.
        <br>
source : <a class="link-color" href="https://github.com/Super-DLT/word-scrambler" target="blank">Word-scrambler</a>
        <br>code by
<a class="link-color" href="https://github.com/Super-DLT" target="blank">Behnam Sheykhe.</a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-light btn-block" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>


  <div class="container text-center">
    <div class="message text-light h5 my-3"></div>
    <input type="text" class="hidden"> <br>
    <button id="btn" class="btn btn-bg btn-light my-5 start">Start</button>
  </div>

    <!-- Jquery -->
    <script src="{{ asset('asset/js/jquery-3.3.1.js') }}"></script>
    <script src="{{ asset('asset/js/validasi-edit-participant.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js" integrity="sha384-BOsAfwzjNJHrJ8cZidOg56tcQWfp6y72vEJ8xQ9w6Quywb24iOsW913URv1IS4GD" crossorigin="anonymous"></script>


  </body>
</html>

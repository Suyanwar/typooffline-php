@extends('layouts.app')
@section('content')
    <div class="container">
        <textarea id='txtbox' name='text-checker' wrap='SOFT' tabindex='0' dir='ltr' spellcheck='false' autocapitalize='off' autocomplete='off' autocorrect='off' placeholder="Ketik atau paste teks kamu" style='font-weight:200; width: 100%;'></textarea>
    </div>
    <img id='text-loader' src="{{asset('images/search.png')}}" alt='search' style="display: block; margin-left: auto; margin-right: auto; margin-top: 20px; margin-bottom: 0px;"> 
    <div class="container">
        <textarea id='textres' name='text-checker' wrap='SOFT' tabindex='0' dir='ltr' spellcheck='false' autocapitalize='off' autocomplete='off' autocorrect='off' placeholder="Hasil Disini" style='font-weight:200; width: 100%;'></textarea>
        <br><br>
    </div>
    <script>
        $("#text-loader").on('click', function(){
            if ($("#txtbox").val() != '' && $("#txtbox").val().length > 1) {
                var input = $("#txtbox").val();
                console.log(input);
                $.ajax({
                    type:"POST",
                    url:"{{url('/checkKata')}}",
                    data : {
                        "_token": "{{ csrf_token() }}",
                        "word": input
                    },
                    success: function(data) {
                        console.log(data);
                        $("#textres").text("");
                        $("#textres").text(data);
                    }
                });
            }
        });
    </script>
@endsection
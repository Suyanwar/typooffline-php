@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
<div class="container">
    <br><br>
    <div class="row">
        <div class="col-md-8" style="margin:0 auto;">
            <form method="post" action="{{url('/checkDoc')}}" enctype="multipart/form-data" class="dropzone" id="dropzone">
                @csrf
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    Dropzone.options.dropzone =
    {
        maxFilesize: 1,
        renameFile: function(file) {
            var dt = new Date();
            var time = dt.getTime();
        return time+file.name;
        },
        acceptedFiles: ".pdf,.docx,.doc",
        timeout: 5000,
        accept: function(file, done) {
            done();
        },
        init: function() {
            this.on("addedfile", function() {
                if (this.files[1]!=null){
                    this.removeFile(this.files[0]);
                }
            });
        },
        success: function(file, response) 
        {
            window.location.href = response;
            this.removeFile(this.files[0]);
        },
        error: function(file, response)
        {
        return false;
        }
    };
</script>
@endsection
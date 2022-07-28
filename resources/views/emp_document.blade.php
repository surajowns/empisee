@extends('master')
@section('title',' Employee Document')
@section('content')
<div class="col-xl-9 col-lg-8  col-md-12">
    @include('profile_header')
    <div class="card ctm-border-radius shadow-sm grow">
        <div class="card-header">
            <h4 class="card-title doc d-inline-block mb-0">Documents({{$employee['name']}})</h4>
            <a href="javascript:void(0)" class="float-right doc-fold text-primary d-inline-block text-info" data-toggle="modal" data-target="#add-document">Add Document</a>
        </div>
        <div class="card-body doc-boby">
            @if(!empty($document))
            @foreach($document as $value)
            <div class="card shadow-none">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-title text-primary mb-0 col-6">{{$value['doc_name']}}</h5>
                        </div>
                        <div class="col-6">
                            <a class="col-6 float-right " href="{{url('public/document/'.$value['document'])}}" download>Download</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="document-up">
                                <embed src="{{url('public/document/'.$value['document'])}}" type="application/pdf" width="100%" height="600" />

                                <span class="float-right text-primary" data-toggle="modal" data-target="#update-document{{$value['id']}}">Edit</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>

<div class="sidebar-overlay" id="sidebar_overlay"></div>

<!-- Add a Key Date Modal-->
<div class="modal fade" id="add-document">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title mb-3">Add Document</h4>
                <form method="POST" enctype="multipart/form-data" id="document-upload">
                    <input type="hidden" name="csrf-token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input class="form-control date-enter" type="text" name="doc_name" placeholder="Document Name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input class="form-control date-enter" type="file" name="document" required>
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger ctm-border-radius float-right ml-3" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-theme text-white ctm-border-radius float-right button-1">Add Document</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- New Team The Modal -->
@if(!empty($document))
@foreach($document as $value)
<div class="modal fade" id="update-document{{$value['id']}}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title mb-3">Edit {{$value['doc_name']}}</h4>

                <form method="POST" enctype="multipart/form-data" id="document-update">
                    <input type="hidden" name="csrf-token" value="{{csrf_token()}}">
                    <input type="hidden" name="id" value="{{$value['id']}}" id="">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input class="form-control date-enter" type="text" name="doc_name" value="{{$value['doc_name']}}" placeholder="Document Name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input class="form-control date-enter" type="file" name="document" value="{{$value['document']}}" placeholder="Document">
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger ctm-border-radius float-right ml-3" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-theme text-white ctm-border-radius float-right button-1">Update Document</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endif

@endsection
@section('javascript')
<script>
    $(document).ready(function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('input[name="csrf-token"]').val()
            }
        });
        $(document).on('submit', '#document-upload', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            // alert(formData);
            $.ajax({
                type: 'POST',
                url: "{{url('upload_document')}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    this.reset();
                    if (data.status == 200) {
                        toastr.success(data.success);
                        $('.modal-backdrop').hide();
                        $('.modal').hide();
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        toastr.error(data.error);

                    }
                },
            });
        });

        $(document).on('submit', '#document-update', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{url('update_document')}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    this.reset();
                    if (data.status == 200) {
                        toastr.success(data.success);
                        $('.modal-backdrop').hide();
                        $('.modal').hide();
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        toastr.error(data.error);
                    }
                },
            });
        });





    });
</script>
@stop
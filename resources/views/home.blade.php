@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-8">

            @include('layouts.components.msg')


        <div class="card">
            <div class="card-header">Upload New File</div>  
            <div class="card-body">
                <form action="{{ route('uploadfile') }}" enctype="multipart/form-data" method="post">
                @csrf
                    <div class="form-group">
                        <input type="file" name="file" id="">
                        <span class="help-block text-danger">{{$errors->first('file')}}</span>
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <textarea name="title" id="caption" class="form-control"></textarea>
                        <span class="help-block text-danger">{{$errors->first('title')}}</span>

                    </div>
                    <button class="btn btn-primary">Upload</button>
                </form>                    
            </div>
        </div>
        
    </div> 
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-8">

            @include('layouts.components.msg')


        <div class="card">
            <div class="card-header">Download the File</div>  
            <div class="card-body">
                <form action="{{ route('findFile') }}" enctype="multipart/form-data" method="post">
                @csrf
                    
                    <div class="form-group">
                        <label for="title">Title & Image Name</label>
                        <textarea name="title" id="caption" class="form-control"></textarea>
                        <span class="help-block text-danger">{{$errors->first('title')}}</span>
                    </div>

                    <button class="btn btn-primary">Download</button>
                </form>                    
            </div>
        </div>
        
    </div> 
    </div>
</div>
@endsection
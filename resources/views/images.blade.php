@extends('layouts.app')

@section('content')
<div class="container">
            @include('layouts.components.msg')


    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All Images</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                                                        <th>#</th>

                            <th>Image</th>
                            <th>Caption</th>
                            <th>Image Name</th>
                            <th>Size</th>
                            <th>Uploaded</th>
                        </tr>
                        @foreach ($images as $image)
                            <tr>

                            <td>{{ $image->id }}</td>
                            <td><img width="100px" src="{{$image->url}}"></td>
                            <td>{{$image->title}}</td>
                            <td>{{$image->name}}</td>
                            <td>{{$image->size_in_kb}} KB</td>
                            <td>{{$image->uploaded_time}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">S3 Images</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Image Name</th>
                            <th>Delete</th>
                         </tr>
                        @foreach ($s3array as $key => $image)
                            <tr>                             
                            <td>{{$key}}</td>

                            <td><img width="100px" src="{{$image['url']}}"></td>
                             <td>{{$image['name']}}</td>
                             <td>
                                 <form action="{{ route('deleteByPath') }}" enctype="multipart/form-data" method="post">
                                    @csrf
                                    
                                     <input type="hidden" name="path" value="{{$image['path']}}">

                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                             </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
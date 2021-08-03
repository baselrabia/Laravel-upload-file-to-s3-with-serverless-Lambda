@extends('layouts.app')

@section('content')
<div class="container">
            @include('layouts.components.msg')


   

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
                                 <form action="{{ route('deleteFile') }}" enctype="multipart/form-data" method="post">
                                    @csrf
                                    
                                     <input type="hidden" name="title" value="{{$image['name']}}">

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
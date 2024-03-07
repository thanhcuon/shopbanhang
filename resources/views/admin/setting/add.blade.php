<!-- resources/views/child.blade.php -->

@extends('layout.admin')

@section('title')
    <title>Setting Add</title>
@endsection
@section('css')



    <style>
        .alert-danger{
            margin-top: 10px;
            padding: 3px 5px;
        }

    </style>
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('partials.content-header', ['name'=>'Setting','key'=>'Add'])

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <form action="{{route('settings.store').'?type='.request()->type}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label  class="form-label">Config Key</label>
                                <input type="text" name="config_key" value="{{ old('config_key')}}" class="form-control @error('config_key') is-invalid @enderror" id="exampleInputEmail1"  placeholder="Nhập Config Key">

                                @error('config_key')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            @if(request()->type === 'Text')
                                 <div class="mb-3">
                                    <label  class="form-label">Config Value</label>
                                    <input type="text" name="config_value" value="{{ old('config_value')}}" class="form-control @error('config_value') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập Config Value">
                                     @error('config_value')
                                     <div class="alert alert-danger">{{ $message }}</div>
                                     @enderror
                                </div>
                            @elseif(request()->type === 'Textarea')
                                <div class="mb-3">
                                    <label  class="form-label">Config Value</label>
                                    <textarea  name="config_value" class="form-control @error('config_value') is-invalid @enderror" id="exampleInputEmail1" rows="5" placeholder="Nhập Config Value">{{ old('config_value')}}</textarea>
                                    @error('config_value')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>


                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection



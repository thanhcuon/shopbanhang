<!-- resources/views/child.blade.php -->

@extends('layout.admin')

@section('title')
    <title>Setting</title>
@endsection

@section('content')

    <div class="content-wrapper">

        @include('partials.content-header', ['name'=>'Setting', 'key'=>'List'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="btn-group float-right">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Add Settings
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{route('settings.create').'?type=Text'}}">Text</a>
                                <a class="dropdown-item" href="{{route('settings.create').'?type=Textarea'}}">TextArea</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <table class="table caption-top">
                            <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">ID</th>
                                <th scope="col">Config Key</th>
                                <th scope="col">Config value</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $count = 1; ?>
                            @foreach($settings as $setting)
                                <tr>
                                    <td>{{$count}}</td>
                                    <th scope="row">{{$setting->id}}</th>
                                    <td colspan="row">{{$setting->config_key}}</td>
                                    <td colspan="row">{{$setting->config_value}}</td>
                                    <td>
                                        <a href="{{route('settings.edit',['id'=>$setting->id]).'?type='.$setting->type}}" class="btn btn-default">Edit</a>
                                        <a href="" data-url="{{route('settings.delete',['id'=>$setting->id])}}" class="btn btn-danger action_delete">Delete</a>
                                    </td>
                                </tr>
                                    <?php $count++; ?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <div class="custom-pagination">
                            {{ $settings->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>


@endsection
@section('js')
    <script src="{{asset('admin/vendors/select2/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('admin/vendors/SweetAlert/sweetalert2@11.js')}}"></script>

    <script>

        function actionDelete(event){
            event.preventDefault();
            let urlRequest = $(this).data('url');
            let that =$(this);
            Swal.fire({
                title: 'Bạn có chắc?',
                text: "Muốn xóa sản phẩm này không!",
                icon: 'Cảnh Báo',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'GET',
                        url: urlRequest,
                        success: function (data){
                            if (data.code == 200){
                                that.parent().parent().remove();
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                            }
                        },
                        error: function () {

                        }
                    });


                }
            })
        }
        $(function (){
            $(document).on('click','.action_delete', actionDelete);
        })
    </script>

@endsection


@extends('layouts.app')

@section('content')
 <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-hrader"> Import Excel</div>
                <div class="card-body">
                    @if(Session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status')}}
                        </div>
                    @endif
                    @if(isset($errors) && $errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                            {{$error}}
                            @endforeach
                        </div>
                    @endif

                    @if(session()->has('failures'))
                    <table class="table table-danger">
                        <tr>
                            <th>Row</th>
                            <th>Attribute</th>
                            <th>Error</th>
                        </tr>
                        @foreach(session()->get('failures') as $validation)
                            <tr>
                                <td>{{$validation->row()}}</td>
                                <td>{{$validation->attribute()}}</td>
                                <td>
                                    <ul>
                                        @foreach($validation->errors() as $e)
                                            <li>{{$e}}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    @endif
                    You are loggind in!
                    <form action="users/import" method="post"  enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type ="file" name="file">
                            <button type ="submit" class="btm btn-primary">Import</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>

    </div>

 </div>


@endsection
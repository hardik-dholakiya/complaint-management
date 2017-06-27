@extends('admin.layout.auth')
@section('title')
    Admin user List
@endsection
@section('header-include')
    <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <style>
        .form-group {
            padding-bottom: 30px;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">List Admin User
                <a class="btn btn-primary" href="{{route('add-admin')}}" style="margin-left: 85%">
                    <span class="glyphicon glyphicon-plus"></span>
                </a>
                <form class="form-horizontal" role="form" method="POST" action="{{ route('search-admin')}}">
                    {{ csrf_field() }}
                    <br>
                    <div class="row">
                        <div class="col-md-5 col-lg-offset-7">
                            <div class="input-group" style="width: 96%; ">
                                <input type="search" class="form-control"
                                       placeholder="Search by First Name,Last Name,Email,Flat No.,Block No."
                                       name="search" id="search"/>
                                <div class="input-group-btn">
                                    <button class="btn btn-primary" type="submit">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            @if ($errors->has('message'))
                <div class="alert alert-success alert-dismissable fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success ! </strong> {{ $errors->first('message')}}.
                </div>
            @endif
            <div class="panel-body">
                @if(count($user_list)<=0)
                    <h3 align="center"> No have any Admin !!</h3>
                @endif
                <div class="table-responsive ">
                    <table id="mytable" class="table table-bordred table-striped">
                        <thead>
                        <th><input type="checkbox" id="checkall"/></th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Flat No.</th>
                        <th>Block No.</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        </thead>
                        <tbody>

                        @foreach($user_list as $user_id=>$user_detail)
                            <tr>
                                <td><input type="checkbox" class="checkthis"/></td>
                                <td>{{$user_detail->first_name}}</td>
                                <td>{{$user_detail->last_name}}</td>
                                <td>{{$user_detail->address}}</td>
                                <td>{{$user_detail->email}}</td>
                                <td>{{$user_detail->flat_no}}</td>
                                <td>{{$user_detail->block_no}}</td>
                                <td>
                                    <p data-placement="top" data-toggle="tooltip" title="Edit">
                                        <button class="btn btn-primary btn-xs" data-title="Edit"
                                                data-toggle="modal"
                                                data-target="#edit-{{$user_detail->id}}"><span
                                                    class="glyphicon glyphicon-pencil"></span>
                                        </button>
                                    </p>
                                </td>
                                <td>
                                    <p data-placement="top" data-toggle="tooltip" title="Delete">
                                        <button class="btn btn-danger btn-xs" id="btnDelete" data-title="Delete"
                                                data-toggle="modal" data-target="#delete-{{$user_detail->id}}"><span
                                                    class="glyphicon glyphicon-trash"></span></button>
                                    </p>
                                </td>
                                <div class="modal fade" id="edit-{{$user_detail->id}}" tabindex="-1" role="dialog"
                                     aria-labelledby="edit" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true"><span
                                                            class="glyphicon glyphicon-remove"
                                                            aria-hidden="true"></span></button>
                                                <h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-horizontal" role="form" method="POST"
                                                      action="{{ route('edit-admin') }}">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id" value="{{$user_detail->id}}">
                                                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                                        <label for="first_name" class="col-md-3 control-label">First
                                                            Name</label>
                                                        <div class="col-md-8">
                                                            <input id="first_name" type="text" class="form-control"
                                                                   name="first_name"
                                                                   value="{{$user_detail->first_name}}" required
                                                                   autofocus>
                                                            @if ($errors->has('first_name'))
                                                                <span class="help-block">
                                                            <strong>{{ $errors->first('first_name') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                                        <label for="last_name" class="col-md-3 control-label">Last
                                                            Name</label>
                                                        <div class="col-md-8">
                                                            <input id="last_name" type="text" class="form-control"
                                                                   name="last_name"
                                                                   value="{{ $user_detail->last_name }}"
                                                                   required autofocus>
                                                            @if ($errors->has('last_name'))
                                                                <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                        <label for="email" class="col-md-3 control-label">E-Mail
                                                            Address</label>

                                                        <div class="col-md-8">
                                                            <input id="email" type="email" class="form-control"
                                                                   name="email" value="{{ $user_detail->email}}"
                                                                   required>
                                                            @if ($errors->has('email'))
                                                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group{{ $errors->has('flat_no') ? ' has-error' : '' }}">
                                                        <label for="flat_no" class="col-md-3 control-label">Flat
                                                            No.</label>
                                                        <div class="col-md-8">
                                                            <input id="flat_no" type="text" class="form-control"
                                                                   name="flat_no" value="{{ $user_detail->flat_no }}"
                                                                   required
                                                                   autofocus>
                                                            @if ($errors->has('flat_no'))
                                                                <span class="help-block">
                                        <strong>{{ $errors->first('flat_no') }}</strong>
                                    </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group{{ $errors->has('block_no') ? ' has-error' : '' }}">
                                                        <label for="block_no" class="col-md-3 control-label">Block
                                                            No.</label>
                                                        <div class="col-md-8">
                                                            <select id="block_no" class="form-control" name="block_no"
                                                                    required autofocus>
                                                                <option value="A">A</option>
                                                                <option value="B">B</option>
                                                                <option value="C">C</option>
                                                                <option value="D">D</option>
                                                                <option value="E">E</option>
                                                                <option value="F">F</option>
                                                            </select>

                                                            @if ($errors->has('block_no'))
                                                                <span class="help-block">
                                        <strong>{{ $errors->first('block_no') }}</strong>
                                    </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                                        <label for="address"
                                                               class="col-md-3 control-label">Address</label>
                                                        <div class="col-md-8">
                                                            <textarea id="address" class="form-control" name="address"
                                                                      required
                                                                      autofocus>{{ $user_detail->address }}</textarea>
                                                            @if ($errors->has('address'))
                                                                <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <hr>
                                                    <div>
                                                        <button type="submit" class="btn btn-primary btn-lg"
                                                                style="width: 100%;"><span
                                                                    class="glyphicon glyphicon-ok-sign"></span> Update
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <div class="modal fade" id="delete-{{$user_detail->id}}" tabindex="-1" role="dialog"
                                     aria-labelledby="edit" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true"><span
                                                            class="glyphicon glyphicon-remove"
                                                            aria-hidden="true"></span></button>
                                                <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
                                            </div>
                                            <form class="form-horizontal" role="form" method="POST"
                                                  action="{{ route('delete-admin') }}">
                                                <div class="modal-body">
                                                    <div class="alert alert-danger"><span
                                                                class="glyphicon glyphicon-warning-sign"></span> Are you
                                                        sure you want to delete this user Record?
                                                    </div>
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="user_id" value="{{$user_detail->id}}">

                                                </div>
                                                <div class="modal-footer ">
                                                    <button type="submit" class="btn btn-success"><span
                                                                class="glyphicon glyphicon-ok-sign"></span> Yes
                                                    </button>
                                                    <button type="button" class="btn btn-default"
                                                            data-dismiss="modal"><span
                                                                class="glyphicon glyphicon-remove"></span> No
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{--
                    <div class="clearfix"></div>

                                        <ul class="pagination pull-right">
                                            <li class="disabled"><a href="#"><span class="glyphicon glyphicon-chevron-left"></span></a>
                                            </li>
                                            <li class="active"><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">4</a></li>
                                            <li><a href="#">5</a></li>
                                            <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span></a></li>
                                        </ul>

        </div>
        --}}
            </div>
        </div>
@endsection

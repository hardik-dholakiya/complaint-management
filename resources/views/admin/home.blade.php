@extends('admin.layout.auth')
@section('title')
Home
@endsection
@section('content')
    @if ($errors->has('message'))
        <div class="alert alert-success alert-dismissable fade in col-lg-offset-1">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success ! </strong> {{ $errors->first('message')}}.
        </div>
    @endif
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">Dashboard</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-lg-offset-1 ">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">{{$total_complaints}}</div>
                                        <div>Total Complaints!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{route('complaints-list')}}">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">{{$total_user}}</div>
                                        <div>Total User!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{route('user-list')}}">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">{{$total_admin}}</div>
                                        <div>Total Admin!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{route('admin-list')}}">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

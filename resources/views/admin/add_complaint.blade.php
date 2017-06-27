@extends('admin.layout.auth')

@section('title')
    Add Complaint
    @endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Create Complaint</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('store-complaints') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('complaint_subject') ? ' has-error' : '' }}">
                                <label for="complaint_subject" class="col-md-2 control-label">Complaint Subject</label>
                                <div class="col-md-10">
                                    <input type="text" id="complaint_subject" class="form-control" name="complaint_subject" value="{{ old('complaint_subject') }}" required autofocus>
                                    @if ($errors->has('complaint_subject'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('complaint_subject') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('complaint_text') ? ' has-error' : '' }}">
                                <label for="complaint_text" class="col-md-2 control-label">Complaint Detail</label>
                                <div class="col-md-10">
                                    <textarea id="complaint_text" class="form-control" name="complaint_text" rows="7" required autofocus>{{ old('complaint_text') }}</textarea>
                                    @if ($errors->has('complaint_text'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('complaint_text') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                    <button type="reset" class="btn btn-primary">
                                        Reset
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

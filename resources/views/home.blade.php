@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">List Complaint</div>
                @if ($errors->has('message'))
                    <div class="alert alert-success alert-dismissable fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success ! </strong> {{ $errors->first('message')}}.
                    </div>
                @endif
                <div class="panel-body">

                    <div id="complaint">
                        <h4>Title</h4>
                        <p>Long Text Long Text Long Text  Long Text  Long Text  Long Text  Long Text Long Text  </p>
                        <div align="right">time</div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

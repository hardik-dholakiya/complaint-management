@extends('admin.layout.auth')
@section('title')
    Complaint List
@endsection
@section('header-include')
    <style>
        .comment-link {
            margin-left: -20px;
        }

        .comment-link img {
            height: 20px;
        }

        /**comment reply*/
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .comment-section {
            list-style: none;
            max-width: 1000px;
            width: 100%;
            margin: 50px auto;
            padding: 10px;
            font: normal 13px sans-serif;
        }

        .comment {
            display: flex;
            border-radius: 3px;
            flex-wrap: wrap;
        }

        .comment.user-comment {
            color: #808080;
        }

        /* User and time info */
        .comment.user-comment .info {
            text-align: right;
        }

        .comment .info a { /* User name */
            display: block;
            text-decoration: none;
            color: #656c71;
            font-weight: bold;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
            padding: 10px 0 3px 0;
        }

        .comment .info span { /* Time */
            font-size: 11px;
            color: #9ca7af;
        }

        /* The user avatar */
        .comment.user-comment .avatar {
            padding: 10px 10px 0 3px;
        }

        .comment .avatar img {
            border-radius: 50px;
        }

        /* The comment text */
        .comment p {
            line-height: 1.5;
            padding: 18px 22px;
            width: 80%;
            border-radius: 20px;
            position: relative;
            word-wrap: break-word;
        }

        .comment.user-comment p {
            background-color: #f3f3f3;
        }

        .user-comment p:after {
            content: '';
            position: absolute;
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background-color: #ffffff;
            border: 2px solid #f3f3f3;
            left: -8px;
            top: 18px;
        }

        .panel-info {
            border-radius: 10px;
        }

        .reply-link {
            margin-left: 86%;
        }

        /* Comment form */
        .write-new {
            margin: 20px auto;
            width: 70%;
        }

        .write-new textarea {
            color: #444;
            font: inherit;
            outline: 0;
            border-radius: 3px;
            border: 1px solid #cecece;
            background-color: #fefefe;
            box-shadow: 1px 2px 1px 0 rgba(0, 0, 0, 0.06);
            overflow: auto;
            width: 100%;
            min-height: 80px;
            padding: 15px 20px;
        }

        .write-new img {
            border-radius: 50%;
            margin-top: 15px;
        }

        .write-new button {
            float: right;
            background-color: #87bae1;
            box-shadow: 1px 2px 1px 0 rgba(0, 0, 0, 0.12);
            border-radius: 2px;
            border: 0;
            color: #ffffff;
            font-weight: bold;
            cursor: pointer;
            padding: 10px 25px;
            margin-top: 18px;
        }

        .description {
            margin: 10px 0px 0px 14px;
        }

        /* end comment reply*/
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".response-div").hide();
            $(".response").click(function () {
                /*
                 $(".response-div").hide();
                 */
                var cid = $(this).data("cid");
                $("#response-div-" + cid).fadeToggle("slow");
            });
        });
    </script>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">List Complaint
                        <a href="{{route('add-complain')}}" style="margin-left: 90%"><span
                                    class="glyphicon glyphicon-plus"></span></a>
                    </div>
                    @if ($errors->has('message'))
                        <div class="alert alert-success alert-dismissable fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success ! </strong> {{ $errors->first('message')}}.
                        </div>
                    @endif
                    <div class="panel-body">
                        @if(count($complaint_list)<=0)
                            <h3 align="center"> No Complaint post ...</h3>
                        @endif
                        @foreach($complaint_list as $complaint_id=>$complaint_detail)
                            <div id="complaint">
                                <div align="center" class="well" style="padding: 5px; font-size: 24px;">
                                    <h4>{{$complaint_detail['complaint_subject']}}</h4>
                                </div>
                                <p>{{$complaint_detail['complaint_text']}}</p>
                                <div align="left"><b><i>
                                           Post By {{$complaint_detail['user']->first_name." ".$complaint_detail['user']->last_name}}
                                       </i></b></div>
                                <div align="right">
                                    {{ time_ago($complaint_detail['created_at'])}}
                                </div>
                                <a href="javascript:;" class="response btn btn-default"
                                   id="response-{{$complaint_detail->complaints_id}}"
                                   data-cid="{{$complaint_detail->complaints_id}}">See Response</a>
                                <div id="response-div-{{$complaint_detail->complaints_id}}" class="response-div">
                                    {{--response && reply--}}
                                    <div style="margin: 10px 0px 10px 50px;">
                                        <ul class="comment-section">
                                            @foreach($complaint_detail->responses as $key=>$response_detail)
                                                @if($response_detail->is_response==1)
                                                    <li class="comment user-comment">
                                                        <div class="info">
                                                            <a href="http://localhost-ast-23/Laravel%20Project/Laravel_blog/public/show-user-profile/19">
                                                                {{$response_detail->admin->first_name." ".$response_detail->admin->last_name}}
                                                            </a>
                                                            <span>{{ time_ago($response_detail->created_at)}}</span>
                                                        </div>
                                                        <a href="http://localhost-ast-23/Laravel%20Project/Laravel_blog/public/show-user-profile/19"
                                                           class="avatar"><img
                                                                    src="http://localhost-ast-23/Laravel%20Project/Laravel_blog/public/image/user-1.png"
                                                                    onerror="this.src='http://localhost-ast-23/Laravel%20Project/Laravel_blog/public/image/user-icon.png'"
                                                                    height="30px" title="Hardik" width="35"
                                                                    alt="Profile Avatar"></a>
                                                        <p>{{$response_detail->response_text}}
                                                    </li>
                                                @endif
                                                @if($response_detail->is_response==0)
                                                    <li class="comment user-comment" style="margin-left: 135px; height: 66px">
                                                        <div class="info" align="right"><a href="#">{{$response_detail->user['first_name']." ".$response_detail->user['last_name']}}</a>
                                                            <span>{{ time_ago($response_detail->created_at)}}</span>
                                                        </div>
                                                        <img src="http://localhost-ast-23/Laravel%20Project/Laravel_blog/public/image/user-1.png"
                                                                    onerror="this.src='http://localhost-ast-23/Laravel%20Project/Laravel_blog/public/image/user-icon.png'"
                                                                    title="Hardik" width="35" height="50px" alt="Hardik"></a>
                                                        <p style="background-color: rgb(226, 248, 255);"> {{$response_detail->response_text}}</p>
                                                    </li>
                                                @endif
                                            @endforeach
                                            <li class="write-new">
                                                <h4>Response</h4>
                                                <form name="comment_form" action="{{route('store-response')}}"
                                                      method="post">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="complaint_id"
                                                           value="{{$complaint_detail->complaints_id}}">
                                                    <input type="hidden" name="user_id" value="{{Auth::guard('admin')->user()->id}}">
                                                    <textarea name="response_text" rows="3" cols="85"
                                                              required placeholder="Write your comment here"></textarea>
                                                    <div>
                                                        <button name="comment_submit"
                                                                type="submit">Post Comment
                                                        </button>
                                                    </div>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    {{--end comment && reply--}}
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<?php
function time_ago($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

?>
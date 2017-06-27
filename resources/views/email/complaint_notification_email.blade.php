<div>
    <div align="center">
        <h2>
            {{ config('app.name') }}
        </h2>
    </div>
    <div>
        Hello !
    </div>
    <h3 align="center">Subject:- {{$complaint['complaint_subject']}} </h3>
    <div>
        Dear Mr Admin
    </div>
    <p style="margin-left: 10px">
        {{$complaint['complaint_text']}}
    </p>
    <button class="btn btn-primary" type="button" href="{{$complaint['link']}}">Go to Complaint</button>
    <div align="right">
        <p>Thanking You,</p>
        <p>Yours Sincerely</p>
        {{$complaint['user_name']}}
    </div>
    <p align="center">
        If you’re having trouble clicking the Go to Complaint button, copy and paste the URL below
        into your web browser: {{$complaint['link']}}
    </p>
</div>

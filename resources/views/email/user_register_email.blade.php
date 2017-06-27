<html>
<body>
<div align="center">
    <div style="max-width: 680px; min-width: 500px; border: 2px solid #e3e3e3; border-radius:5px; margin-top: 20px">
        <div>
            <img src="http://apps.srilankajeddahconsulate.com/complaints/assets/default/images/logo.png" width="250" alt="Complaints Management System" border="0"  />
        </div>
        <div  style="background-color: #fbfcfd; border-top: thick double #cccccc; text-align: left;">
            <div style="margin: 30px;">
                <p>
                    Dear {{$data->first_name." ". $data->last_name}},<br> <br>
                    Welcome to Complaints Management System!<br> <br>
                    Here are your details:<br><br>
                </p>
                <table style="text-align: left;">
                    <tr>
                        <th>Name</th>
                        <td>: {{$data->first_name." ". $data->last_name}} </td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>: {{$data->email}} </td>
                    </tr>
                    <tr>
                        <th>Password</th>
                        <td>: {{$data->password}}</td>
                    </tr>
                    @endif
                    <tr>
                        <th>flat No</th>
                        <td>: {{$data->flat_no}}</td>
                    </tr>
                    <tr>
                        <th>block No</th>
                        <td>: {{$data->block_no}}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>: {{$data->address}}</td>
                    </tr>

                </table>
                <br>  <br>

                Here is the link to access your area:<a class="btn-primary" href='{{url('/')."/home"}}' target="_blank">Go to Login</a><br><br>
                Please Contact CMS team if you have any questions<br><br>
                Once again, thank you!!!<br><br>

                <div style="text-align: Right;">
                    With warm regards,<br>
                    Complaints Management System Team
                </div>
            </div>
        </div>
    </div>
</div>
<center>2017 © CMS. ALL Rights Reserved.</center>
</body>
</html>

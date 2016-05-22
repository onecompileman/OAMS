<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/addons/css/bootstrap.css"/>
    <style>
        table td,th{
            color:#000000;
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container-fluid">
         <div class="row">
                            <center><img src="/sys_files/img/nu.png" alt="" height="70" width="70"/></center>
                            <center><h4><b>NATIONAL UNIVERSITY</b></h4></center>
                            <center>
                                <h5><b>551 M. F. Jhocson St. Sampaloc, Manila 1008</b></h5>
                                </center>
                            <center><h5>Athletics Department</h5></center>
                    </div>
                    <div class="row">
                    <div class="col-xs-offset-1">
                        <h5><b>Date: </b>{{date('m/d/Y')}}</h5>
                    </div>
                    </div>
                    <br/>
                    <center><h2><span class="glyphicon glyphicon-user"></span>&nbsp; A T H L E T E ' S &nbsp; L I S T</h2></center>
                    <hr style="border: 1px solid black;"/>
                    <div class="row">
                    <div class="col-lg-12">
                    <table class="table table-borded" width="100%">
                            @if(isset($_GET['sport']))
                                 <thead>
                                    <tr >
                                    <th colspan="5">
                                     <center><h5><img src="/addons/icons/{{$_GET['sport']}}.png" alt="" height="35" width="35"/><b>{{ucwords($_GET['sport'])}}</b></h5></center>
                                      </th>
                                      </tr>
                                     <tr style="font-size: 13px;"><th>Student ID</th><th>Name</th><th>Team Type</th><th>College</th><th>Contact No.</th></tr>
                                 </thead>

                                  <tbody>
                                        @foreach($athleteData as $data)
                                           @if($data->sport == $_GET['sport'])
                                               <tr style="font-size: 12px;"><td>{{$data->student_id}}</td><td>{{strtoupper($data->last_name)}}, {{strtoupper($data->given_name)}} {{strtoupper($data->middle_name)}}</td><td>{{$data->team_type}}</td><td>{{$data->college_department}}</td><td>{{$data->contact_number}}</td></tr>
                                          @endif
                                           @endforeach
                                         </tbody>
                            @else
                            @foreach($sportList as $sport)
                                <thead>
                                    <tr style="position:relative; padding-bottom: -20px;padding-top: -20px">
                                      <th colspan="5">
                                        <center><h5><img src="/addons/icons/{{$sport->sport_name}}.png" alt="" height="35" width="35"/><b>{{ucwords($sport->sport_name)}}</b></h5></center>
                                      </th>
                                      </tr>
                                      <tr style="font-size: 13px;"><th>Student ID</th><th>Name</th><th>Team Type</th><th>College</th><th>Contact No.</th></tr>
                                </thead>
                                 <tbody>
                                @foreach($athleteData as $data)
                                        @if($data->sport == $sport->sport_name)
                                        <tr style="font-size: 12px;"><td>{{$data->student_id}}</td><td>{{strtoupper($data->last_name)}}, {{strtoupper($data->given_name)}} {{strtoupper($data->middle_name)}}</td><td>{{$data->team_type}}</td><td>{{$data->college_department}}</td><td>{{$data->contact_number}}</td></tr>
                                        @endif
                                @endforeach
                                 </tbody>
                             @endforeach
                            @endif
                    </table>
                    </div>
</div>
    </div>
</body>
</html>
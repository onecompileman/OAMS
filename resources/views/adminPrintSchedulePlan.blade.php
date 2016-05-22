<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/addons/css/bootstrap.css"/>
        <style>
            h1{
                transition: 0.5s linear;
            }
            h1:hover{
                transform: scale(1.1);
                color: red;
            }
        </style>
    </head>
    <body onload="window.print()">
        <div class="container-fluid">
            <div class="row">
             <div class="row">
                                <center><img src="/sys_files/img/nu.png" alt="" height="70" width="70"/></center>
                                <center><h4><b>NATIONAL UNIVERSITY</b></h4></center>
                                   <center>
                                                                <h5><b>551 M. F. Jhocson St. Sampaloc, Manila 1008</b></h5>
                                                                </center>
                                <center><h5>Athletics Department</h5></center>
                        </div>
                        <br/><br/>
            @if(count($schedule) > 0)
                <table class="table table-bordered" cellpadding="0" width="100%">
                    <thead>
                        <tr style="background-color: black;color:#ffffff;">
                            <th colspan="4"><center>National University Athletics Schedule Season {{$schedule[0]->season}}</center></th>
                            </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4"><center>{{($schedule[0]->semester == "both")? "1st and 2nd Semester ":$schedule[0]->semester}} AY {{date_format(date_create($schedule[0]->startDate),'Y')}}-{{(intval(date_format(date_create($schedule[0]->startDate),'Y'))+1)}}</center></td>
                            </tr>
                            <tr>
                                <td><center>TEAM</center></td>
                                <td><center>Days</center></td>
                                <td>TIME</td>
                                <td>VENUE</td>
                                </tr>
                                @foreach($sched as $s)
                                    <tr>
                                        <td>
                                            <center>{{$s->team_name}}</center>
                                            </td>
                                            @if($s->days == null)
                                                <td colspan="3"><center>Schedule haven't set yet...</center></td>
                                            @else
                                            <td>
                                            <center>{{$s->day}}</center>
                                            </td><td>
                                            <center>{{date_format(date_create($s->timeRangeFrom),'h:i A')}}-{{date_format(date_create($s->timeRangeTo),'h:i A')}}</center>
                                            </td><td>
                                            <center>{{$s->venue_name}}</center>
                                            </td>
                                            @endif
                                    </tr>
                                @endforeach
                    </tbody>
                </table>
                </div>
                @else
                    <div class="row">
                        <center><h1 style="font-size: 80px"><b><span class="glyphicon glyphicon-ban-circle"></span></b></h1></center>
                        <center>
                            <h4>No Schedule Exists!</h4>
                            </center>
                    </div>
                @endif

        </div>
    </body>
</html>
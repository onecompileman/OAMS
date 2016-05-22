<!DOCTYPE html>
<html><head>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="/addons/css/bootstrap.css" />
       <style media="print">
            tr{
            background-color: #0080ff;
            }
       </style>
</head>
    <body onload="window.print();">
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
            </div>
            <div class="row">
                    <table class="table table-border">
                        <thead><tr><th colspan="4"><center><h2>Upcoming Game Schedule List</h2></center></th></tr></thead>
                        <thead><tr><th>Opposing Team</th><th>Date</th><th>Time</th><th>Venue</th></tr></thead>
                        @if(isset($_GET['team']))
                                @foreach($teamList as $team)
                                @if($team->id == $_GET['team'])
                                                     <thead>
                                                                                        <tr style="position:relative; padding-bottom: -20px;padding-top: -20px">
                                                                                          <th colspan="5">
                                                                                            <center><h5><img src="/addons/icons/{{$team->sport_name}}.png" alt="" height="35" width="35"/><b>{{ucwords($team->team_name)}}</b></h5></center>
                                                                                          </th>
                                                                                          </tr>
                                                                                    </thead>

                                                    <tbody>
                                                        <?php $ctr = 0; ?>
                                                        @foreach($gameScheduleList as $game)
                                                            @if($game->team_id == $_GET['team'])
                                                            <?php $ctr++; ?>
                                                            <tr>
                                                                <td>$game->opposingTeam</td><td>{{$game->dateOfGame}}</td><td>{{$game->timeOfGame}}</td><td>{{$game->venueName}}</td>
                                                            </tr>
                                                            @endif
                                                        @endforeach
                                                        @if($ctr == 0)
                                                            <tr>
                                                                <td colspan="4"><center>
                                                                    <h5>No game schedule has been set..</h5>
                                                                    </center></td>
                                                                </tr>
                                                        @endif
                                                    </tbody>
                                                    @endif
                                                    @endforeach
                        @else
                        @foreach($teamList as $team)
                         <thead>
                                                            <tr style="position:relative; padding-bottom: -20px;padding-top: -20px">
                                                              <th colspan="5">
                                                                <center><h5><img src="/addons/icons/{{$team->sport_name}}.png" alt="" height="35" width="35"/><b>{{ucwords($team->team_name)}}</b></h5></center>
                                                              </th>
                                                              </tr>
                                                        </thead>

                        <tbody>
                            <?php $ctr = 0; ?>
                            @foreach($gameScheduleList as $game)
                                @if($game->team_id == $team->id)
                                <?php $ctr++; ?>
                                <tr>
                                    <td>$game->opposingTeam</td><td>{{$game->dateOfGame}}</td><td>{{$game->timeOfGame}}</td><td>{{$game->venueName}}</td>
                                </tr>
                                @endif
                            @endforeach
                            @if($ctr == 0)
                                <tr>
                                    <td colspan="4"><center>
                                        <h5>No game schedule has been set..</h5>
                                        </center></td>
                                    </tr>
                            @endif
                        </tbody>
                        @endforeach
                                            @endif

                    </table>
            </div>
        </div>
    </body>
    </html>
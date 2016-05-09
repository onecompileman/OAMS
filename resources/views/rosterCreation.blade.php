@extends('coach')
@section('css')
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>amCharts examples</title>
    <script src="/addons/amcharts/amcharts.js" type="text/javascript"></script>
    <script src="/addons/amcharts/radar.js" type="text/javascript"></script>

    <script>
        var chart;

        var chartData = [
            {
                "direction": "Versatiliy",
                "value": 1
            },
            {
                "direction": "Initiator",
                "value": 1
            },
            {
                "direction": "Pure Facilitator",
                "value": 1
            },
            {
                "direction": "Distributor",
                "value": 1
            },
            {
                "direction": "Scorer",
                "value": 1
            }
        ];
        $(document).ready(function(){
            $('.menu').children('li').removeClass('active');
            $('.menu').children('li:nth-child(3)').addClass('active');
            $('.close').click(function(){
                if(confirm('Are You Sure'))
                    $('#modal').toggle();
            });
            $('.athlete').click(function(e){
                   var tooltip=document.createElement('div');
                   tooltip.className="tooltip";
                   var tool=document.getElementsByClassName('tool')[0];
                   tool.style.left=(e.pageX-230).toString()+'px';
                   tool.style.top=(e.pageY-55).toString()+'px';
                   var options=document.createElement('ul');
                   options.className='options';
                   options.style.position='relative';
                   options.style.left='-10%';
                   options.style.width='100%';
                   if($(this).attr('src')=="/addons/icons/69.png"){
                    var list1 = document.createElement('li');
                    list1.innerHTML='<span class="glyphicon glyphicon-plus"></span>Add Athlete';
                    list1.className='add';
                    options.appendChild(list1);

                    var list6 = document.createElement('li');
                    list6.innerHTML='Choose Best Athlete';
                    list6.className='best';
                    options.appendChild(list6);
                   }else{
                        var list2=document.createElement('li');
                        list.innerHTML='<span class="glyphicon glyphicon-stats"></span>View Athlete\'s Profile';
                        list2.className='profile';
                        var list3=document.createElement('li');
                        list3.innerHTML='<span class="glyphicon glyphicon-user"></span>View Athlete\'s Stats';
                        list3.className='stats';
                        var list4=document.createElement('li');
                        list4.innerHTML='<span class="glyphicon glyphicon-edit"></span>Change Athlete';
                        list4.className='change';
                        var list5=document.createElement('li');
                        list5.innerHTML='<span class="glyphicon glyphicon-remove"></span>Remove Athlete';
                        list5.className='remove';
                        options.appendChild(list5);
                        options.appendChild(list2);
                        options.appendChild(list3);
                        options.appendChild(list4);

                   }
                   tooltip.appendChild(options);
                   tool.innerHTML="";
                   $('.tool').toggle();
                   document.getElementsByClassName('tool')[0].innerHTML=tooltip.innerHTML;
                    $('.add').click(function(){
                          $('#modal').toggle();

                                                                   $.post('',{data:'add'},function(html){
                                                                       $('#modal').children('.panel').toggle();
                                                                   });
                                                               });
            });
            $('.tool').mouseleave(function(){
                                   $('.tool').toggle();
            });


        });

        AmCharts.ready(function () {
            // RADAR CHART
            chart = new AmCharts.AmRadarChart();
            chart.dataProvider = chartData;
            chart.categoryField = "direction";
            chart.startDuration = 1;

            // TITLE
            chart.addTitle("Prevailing winds", 15);

            // VALUE AXIS
            var valueAxis = new AmCharts.ValueAxis();
            valueAxis.gridType = "circles";
            valueAxis.fillAlpha = 0.05;
            valueAxis.fillColor = "#000000";
            valueAxis.axisAlpha = 0.2;
            valueAxis.gridAlpha = 0;
            valueAxis.fontWeight = "bold";
            valueAxis.minimum = 0;
            valueAxis.maximum=1;
            chart.addValueAxis(valueAxis);

            // GRAPH
            var graph = new AmCharts.AmGraph();
            graph.lineColor = "#f7ce42";
            graph.fillAlphas = 0.4;
            graph.bullet = "round";
            graph.valueField = "value";
            graph.balloonText = "[[category]]: [[value]]";
            chart.addGraph(graph);

            // GUIDES
            // blue fill
          /*  var guide = new AmCharts.Guide();
            guide.angle = 225;
            guide.tickLength = 0;
            guide.toAngle = 315;
            guide.value = 0;
            guide.toValue = 14;
            guide.fillColor = "#0066CC";
            guide.fillAlpha = 0.6;
            valueAxis.addGuide(guide);
*/
         /*   // red fill
            guide = new AmCharts.Guide();
            guide.angle = 45;
            guide.tickLength = 0;
            guide.toAngle = 135;
            guide.value = 0;
            guide.toValue = 14;
            guide.fillColor = "#CC3333";
            guide.fillAlpha = 0.6;
            valueAxis.addGuide(guide);*/
             chart.write("chartdiv");
        });

    </script>
    <style>
        .close{
            position: relative;
            top: 6%;
        }
        #modal{
            background-color: rgba(0,0,0,0.7);
            position: absolute;
            z-index: 100;
            top: 0;
            left: 0;
            width: 100%;
            height: 200%;
            background-size: cover;
            display: none;
        }
        #modal .panel{
            position: relative;
            width: 50%;
            left: 35%;
            top: 20%;
        }
        .options li{
            margin-top: 4%;
            cursor: pointer;
            transition: linear .3s;
        }
       .options{
        width: 100%;
       }
        .options li:hover{
            background-color: #005599;
            color:white;
        }
        .tool{
            display: none;
           position: absolute;
           z-index: 100;
           width: 17%;
           border-radius: 3%;
           height: 7%;
           background-color: white;
           box-shadow: 0 0 6px rgba(0,0,0,0.6);

        }
        .options{
        list-style: none;
        }
        .athlete{
            cursor: pointer;
            position: relative;
            background-color: rgb(255,255,255);
            box-shadow:0 0 6px rgba(0,0,0,0.5);
            margin-right: 2%;
            width: 17%;
            height: 10%;
            transition: linear .5s;
            border-radius: 3%;
        }
        .rosBack{
            /*background: url('/addons/img/tactile_noise.png');*/
        }
        .btn{
            position: relative;
            margin-right: 5%;
            box-shadow: 0 0 7px rgba(0,0,0,0.6);
        }
        .athlete:hover{
            transform: scale(1.05);
            box-shadow:0 0 6px rgba(34,207,246,0.6);
        }
        .a li:hover{
            background-color: #0088bb;
            color:white;
        }
        .a li,a{
            transition: linear 0.5s;
            text-decoration: none;
        }
    </style>
@stop
@section('contents')
    {{--<div id="chartdiv" style="width:600px; height:400px;"></div>
--}}
<div class="tool">
asdas
</div>
    <div class="panel panel-primary main">
        <div class="panel-heading">
            <center><h4><img src="/addons/icons/22.png" height="40px" width="40px">Roster</h4></center>
        </div>

        <div class="panel-body">
        <br/>
            <center>
                    <div class="dropdown" style="position: relative;margin-right:5%;display: inline-block;">
                      <button class="btn btn-primary" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Automatically Select Roster
                        <span class="caret"></span>
                      </button>
                      <ul class="a dropdown-menu" aria-labelledby="dLabel">
                           <a href="">
                               <li>Defense</li>
                               </a><a href="">
                               <li>Offense</li>
                               </a><a href="">
                               <li>Defense & Offense</li>
                               </a>
                      </ul>
                    </div>
                    <div class="btn btn-info" style="display:inline-block;"><span class="glyphicon glyphicon-print"></span>&nbsp;&nbsp;&nbsp;Print Roster List</div>
                   <div class="btn btn-success">Roster Capability</div>
                    {!!Form::open(['method'=>'post','url'=>'/OAMS/coach/resetRoster','style'=>'display:inline-block;'])!!}
                        {!!Form::token()!!}
                          <button name="submit" type="submit" class="btn btn-warning" style="display: inline-block;"><span class="glyphicon glyphicon-refresh"></span>&nbsp;&nbsp;&nbsp;Reset Roster</button>
                    {!!Form::close()!!}

                   </center>

                    <br/><br/><br/>
           <div class="panel-group">
               <?php $r=['Main','Bench 1','Bench 2']; ?>
             @for($ndx=0,$row=0;$row<3;$row++)
               <div class="panel panel-primary">
                   <div class="panel-heading">
                   <h4>{{$r[$row]}}</h4>
                   </div>
                   <div class="panel-body">
                <div class="row well rosBack">
                    @for(;$ndx<5*($row+1);$ndx++)
                        <?php $img=""; ?>
                        @if(count($athleteData[$ndx])==0)
                           <?php $img="/addons/icons/69.png"; ?>
                        @else
                            <?php $img="/sys_files/img/profile_pic/user/".$athleteData[$ndx][0]->profile_pic; ?>
                        @endif
                        <img class="athlete" src="{{$img}}" alt="">
                    @endfor
                </div></div></div>
                 @endfor
            </div>
        </div>
    </div>
@stop
@section('popup')
   <div id="modal">
        <div class="btn btn-danger close">X</div>
        <div class="panel panel-primary">
              <div class="panel-heading">
                        <h4>Please Wait</h4>
                        </div>
            <div class="panel-body">
                    <div class="progress">
                      <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                        <span class="sr-only"></span>
                      </div>
                    </div>
            </div>

            </div>
   </div>
@stop
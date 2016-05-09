@extends('coach')
@section('css')
<link rel="stylesheet" type="text/css" href="/addons/css/jquery.dataTables.css">

<script>
    $(document).ready(function(){
            var athletesID=[@for($ndx=0;$ndx<(count($athletesInCoach)-1);$ndx++)
                        '{{$athletesInCoach[$ndx]->id}}',
            @endfor
           '{{$athletesInCoach[count($athletesInCoach)-1]->id}}'];
           var ID;
             $.ajaxSetup({
                	headers: {
                		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                	        }
                });

                $('#search').keypress(function(){
                $.post("{{route('athleteSearch')}}",{search:$(this).val()},function(html){
                    $('#table').html(html);
                })
                });

                function indexOf($id){
                        var index=0;
                        for(var ndx=0;ndx<athletesID.length;ndx++)
                            index=(athletesID[ndx]==$id)? ndx:index;
                        return index;
                }

                function getAthlete(id){
                          $.post('{{route('athleteView')}}',{id:id},function(html){
                                                      var img=html.split('-')[0];
                                                      var name=html.split('-')[1];
                                                      var address=html.split('-')[2];
                                                      var age=html.split('-')[3];
                                                      var play=html.split('-')[4];
                                                      var team=html.split('-')[5];
                                                      var since=html.split('-')[6];
                                                      var uaap=html.split('-')[7];
                                                      var uaapStats=html.split('-')[8];
                                                      $('#modal2').children('.panel').children('.panel-body').children('.container-fluid').children('.row:nth-child(1)').children('div').children('img').attr('src','/sys_files/img/profile_pic/user/'+img);
                                                      $('#modal2').children('.panel').children('.panel-body').children('.container-fluid').children('.row:nth-child(2)').children('div').children('div').html(name);
                                                      $('#modal2').children('.panel').children('.panel-body').children('.container-fluid').children('.row:nth-child(3)').children('div').children('div').html(address);
                                                      $('#modal2').children('.panel').children('.panel-body').children('.container-fluid').children('.row:nth-child(4)').children('div').children('div').html(age);
                                                      $('#modal2').children('.panel').children('.panel-body').children('.container-fluid').children('.row:nth-child(5)').children('div').children('div').html(play);
                                                      $('#modal2').children('.panel').children('.panel-body').children('.container-fluid').children('.row:nth-child(6)').children('div').children('div').html(team);
                                                      $('#modal2').children('.panel').children('.panel-body').children('.container-fluid').children('.row:nth-child(7)').children('div').children('div').html(since);
                                                     var ndx=5,star="";
                                                      for(;ndx>uaap;ndx--) star+='<span style="position:relative;margin-left:4px;font-size:16px;font-weight:bold;color:yellow;" class="glyphicon glyphicon-star-empty"></span>';
                                                      for(;ndx>=1;ndx--) star+='<span style="position:relative;margin-left:4px;font-size:16px;font-weight:bold;color:yellow;" class="glyphicon glyphicon-star"></span>';
                                                      var ss=(uaapStats=='Has Stats')? '<div class="btn btn-primary stats">View Stats</div>':uaapStats;
                                                      $('#modal2').children('.panel').children('.panel-body').children('.container-fluid').children('.row:nth-child(8)').children('div').children('div').html(star);
                                                      $('#modal2').children('.panel').children('.panel-body').children('.container-fluid').children('.row:nth-child(9)').children('div').children('div').html(ss);

                                               });
                }
                $('.prev').click(function(){
                      var id=$(this).attr('id');
                      var next,prev;
                      next=(indexOf(id)==(athletesID.length-1))? parseInt(id):(athletesID[indexOf(id)+1]);
                      prev=(indexOf(id)==0)? parseInt(id):(athletesID[indexOf(id)-1]);
                      $('.prev').attr('id',prev);
                      $('.next').attr('id',next);
                      getAthlete(id);
                      ID=id;
                });
                $('.next').click(function(){
                       var id=$(this).attr('id');
                       var next,prev;
                       next=(indexOf(id)==(athletesID.length-1))? parseInt(id):(athletesID[indexOf(id)+1]);
                       prev=(indexOf(id)==0)? parseInt(id):(athletesID[indexOf(id)-1]);
                       $('.prev').attr('id',prev);
                       $('.next').attr('id',next);
                       getAthlete(id);
                       ID=id;
                });
                $('tbody').children('tr,[role="row"],.even,.odd').children('td:nth-last-child(1n+3)').click(function(){
                        $(document).scrollTop(0);
                        $('#modal2').animate({opacity:1},1000).css('display','inline-block');
                       var id= $(this).parent('tr').children('td').children('.update').attr('name').toString().substring(6);
                       var next,prev;
                       next=(indexOf(id)==(athletesID.length-1))? parseInt(id):(athletesID[parseInt(id)+1]);
                       prev=(indexOf(id)==0)? parseInt(id):(athletesID[parseInt(id)-1]);
                       $('.prev').attr('id',prev);
                       $('.next').attr('id',next);
                        getAthlete(id);
                        ID=id;
                       /*if($(this).parent('tr').html()==$('tbody').children('tr:first-child').html()){
                            next=$(this).parent('tr').next().children('td').children('.update').attr('name').toString().substring(6);
                            prev='false'
                        }
                       else if($(this).parent('tr').html()==$('tbody').children('tr:last-child').html()){
                            prev=$(this).parent('tr').prev().children('td').children('.update').attr('name').toString().substring(6);
                            next='false';
                        }
                       else{
                             next=$(this).parent('tr').next().children('td').children('.update').attr('name').toString().substring(6);
                             prev=$(this).parent('tr').prev().children('td').children('.update').attr('name').toString().substring(6);
                        }*/

                        $(document).bind('scroll',function(e){
                                   $(this).scrollTop(0);
                               });
                });
            $('.delete').click(function(e){
            e.preventDefault();
            $('#modal').css('display','inline').css('opacity','1');
            $('#id').val($(this).attr('name').split("Delete")[1]);
       });

       $('.close').click(function(){
          $('#modal2').animate({opacity:0},500,function(){
                $(this).css('display','none');
          });
          $(document).unbind('scroll');
       });
       $('#no').click(function(e){
            $('#modal').css('display','none').css('opacity','0');

       });
       $('#sanction').click(function(){
        $('#modal3').children('.panel').children('.panel-body').children('form').children('input[type="hidden"]').val(ID);
        $('#modal3').toggle();
       });
       $('#cancelSanc').click(function(){
        $('#modal3').toggle();
       });
          var inc=0;
               setInterval(function(){
                    inc++;
                    if(inc==3)
                        $('.success-message').toggle();
               },1000);
       });

</script>
<script type="text/javascript" language="javascript" class="init">

$(document).ready(function() {
	$('#table').DataTable( {
		"pagingType": "numbers"
	} );

             $('input[type="search"]').addClass('form-control').addClass('search');
                $('select').addClass('form-control').addClass('entry');
                //$('.paginate_button').addClass('btn').addClass('btn-primary');

} );

	</script>

<style>
.success-message{
    background-color: white;
    box-shadow: 0 0 6px rgba(0,0,0,0.6);
    padding: 10px;
    border-radius: 10px;
    z-index: 1000;
    position:absolute;
    top: 20%;
    left: 30%;
}
.success-message h3{
    color:green;
    text-align: center;
}
.p{
display: inline;
margin-left: 2px;
}
#modal2 .panel h3{
    text-align: center;
    color: #ffffff;
}
#modal2 .panel .panel-body div{
    position:relative;
    margin-top: 1%;
}
#modal2 .panel-body img{
    box-shadow:0 0 6px rgba(0,0,0,0.5);
}
#modal2 .panel{
        top: 7%;
        position: relative;
        left: 33%;
       width: 50%;
}
#modal2{
    position: absolute;
    top: 0;
    left:0;
    opacity: 0;
    height: 160%;
    width:100%;
    background-color: rgba(0,0,0,0.6);
    display: none;
}
.page{
position: relative;
text-align: center;
margin-left: -10%;
}

#modal{
    background-color:rgba(0,0,0,0.6);
    position: absolute;
    top:-2%;
    left:-4%;
    height: 100%;
    width: 105%;
    padding: 15% 30%;
    transition: 1s linear;
    opacity: 0;
    display: none;
    z-index: 11;
}

#table tbody tr{
    transition: linear 0.5s;
}
#table tbody tr:hover{
    background-color: rgba(37,207,246,0.5);
}
.current{
    background-color: #005599;
}
.search{
        position:relative;
        width: 60%;
        display: inline;
    }
  .header{
  color: #ffffff;
    background-color: #0088cc;
  }
  #modal3{
    background-color: rgba(0,0,0,0.6);
    position: absolute;
    top: 0;
    left: 0;
    height: 160%;
    width: 100%;
    display: none;
  }
  #modal3 .panel{
     position:relative;
     left: 40%;
     top: 10%;
     width: 40%;
  }
  #modal2 .container-fluid div div{
    display: inline-block;
  }
  .prev{
       position: absolute;
       top: 30%;
       left: 20%;
       height: 200%;
       width: 20%;
  }
  .prev span{
        transition: linear 0.5s;
        font-size: 100px;
  }
  .prev:hover span{
    color:white;
  }

  .next{
         position: absolute;
         top: 30%;
         left: 90%;
         height: 200%;
         width: 20%;
    }
    .next span{
          transition: linear 0.5s;
          font-size: 100px;
    }
    .next:hover span{
      color:white;
    }
     #modal2 .close{
    position: relative;
    top: 7%;
  }
  tbody tr{
    cursor:pointer;
  }
.entry {
        position:relative;
        width: 40%;
        display: inline;
    }

</style>

@stop
@section('contents')

<form class="form" method="post" action="{{route('addAthlete')}}">
<input type="hidden" id="id" name="id">
<div id="modal">
    <div id="popup" class="panel panel-primary">
        <div class="panel-heading">
        <h3 style="color:white;text-align: center;"><span style="color:red;" class="glyphicon glyphicon-alert"></span>
                                        Confirmation</h3>
       </div>
        <div class="panel-body">
           <center><p><h2>Are You Sure?</h2></p>
            <br>
            <input id="yes" type="submit" formaction="{{$_SERVER['PHP_SELF']}}" class="btn btn-primary" value="YES">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div class="btn btn-warning" id="no">NO</div>
            </center>
        </div>
    </div>
</div>
@if(Session::has('message'))
<div class="success-message">
    <h3>{{Session::get('message')}}</h3>
</div>
@endif
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h4 class="panel-title" style="color:white;text-align: center;">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse0">
            <img src="/addons/icons/6.png" height="50" width="50"> Team({{$teamName[0]->team_name}})</a>
      </h4>
    </div>
    <div id="collapse0" class="panel-collapse collapse in">

      <div class="panel-body">


<a href="{{route('addAthlete')}}"><div class="btn btn-primary"> <b>+</b> Add New Athlete</div></a>
<br><br/><br/>
      {{--<form method="post" action="">
      <div class="container">
        <div class="row">
        <div class="col-sm-7">
        <input class="form-control" type="search" name="search" id="search" placeholder="Name Of Athlete">
        </div>
        <div class="col-sm-2">
        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>
        </div>
        </div>
      </div>
      </form>--}}
<!-- -->
<table id="table" class="table table-responsive">
<thead>
<tr class="header">

<th>Profile Picture</th>
<th>Student ID</th>
<th>Name </th>

<th>Address</th>
<th>Contact Number</th>
<th>Update</th>
<th>Delete</th>
</tr>
</thead>


<tbody>
<form method="post" action="{{route('deleteAthlete')}}">
@foreach($athletesInCoach as $athletes)

<tr>
    <td><center><img src="/sys_files/img/profile_pic/user/{{$athletes->profile_pic}}" width="50px" height="50px"></center></td>
    <td>{{$athletes->student_id}}</td>
    <td>{{$athletes->given_name}} {{$athletes->middle_name}}. {{$athletes->last_name}}.</td>
    <td>{{$athletes->home_address}}</td>
    <td>{{$athletes->contact_number}}</td>
    <td><input class="btn btn-success update" type="submit" name="Update{{$athletes->id}}" value="Update"></td>
    <td><input class="btn btn-warning delete" type="submit" name="Delete{{$athletes->id}}" value="Delete"></td>
    </tr>
@endforeach
</form>
    </tbody>

</table>


<!-- -->
</div>
</div>
</div>
<br/><br/>


</form>
@stop
@section('popup')
    <div id="modal2">
            <div class="prev"><span class="glyphicon glyphicon-chevron-left"></span></div>
            <div class="next"><span class="glyphicon glyphicon-chevron-right"></span></div>
            <div class="btn btn-danger close">X</div>
               <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3>Athlete's Profile</h3>
                        </div>
                        <div class="panel-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <img src="" alt="" height="100px" width="100px"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8 col-sm-offset-2"><b>Name:</b><div></div> </div>
                                        </div><div class="row">
                                        <div class="col-sm-8 col-sm-offset-2"><b>Address:</b><div></div> </div>
                                        </div><div class="row">
                                        <div class="col-sm-8 col-sm-offset-2"><b>Age:</b><div></div></div>
                                        </div><div class="row">
                                        <div class="col-sm-8 col-sm-offset-2"><b>Playing Status:</b><div></div></div>
                                        </div><div class="row">
                                        <div class="col-sm-8 col-sm-offset-2"><b>Team Type:</b><div></div></div>
                                        </div><div class="row">
                                        <div class="col-sm-8 col-sm-offset-2"><b>Athlete since:</b><div></div></div>
                                        </div><div class="row">
                                        <div class="col-sm-8 col-sm-offset-2"><b>UAAP playing years:</b><div></div></div>
                                        </div><div class="row">
                                        <div class="col-sm-8 col-sm-offset-2"><b>UAAP statistics:</b><div></div></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-2 col-sm-offset-5">
                                            <div id="sanction" class="btn btn-danger">Send Saction</div>
                                            </div>
                                            <div class="col-sm-2 col-sm-offset-1">
                                            <div id="update" class="btn btn-primary">Update Profile</div>
                                            </div>
                                            </div>
                                </div>
                        </div>
               </div>
    </div>
    <div id="modal3">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h4>SANCTION</h4>
                    </div>
                  <div class="panel-body">
                        <form class="form-group" action="{{route('sendSanction')}}" method="post">
                            <input type="hidden" name="athlete_id"/>
                            Sanction Type: <select class="form-control" name="sanction_type"><option value="School">School</option><option value="Personal">Personal</option><option value="Game">Game</option></select><br>
                            Remarks: <textarea class="form-control" name="remarks" id="" cols="40" rows="10"></textarea>
                            <input type="submit" style="position: relative;display: inline;width: 30%;margin-left: 3%;" class="form-control btn btn-primary" value="Send Sanction"/>
                            <div id="cancelSanc" style="position: relative;display: inline;width: 30%;margin-left: 3%;" class="btn btn-warning form-control">Cancel</div>
                        </form>
                  </div>
            </div>
    </div>
@stop
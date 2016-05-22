@extends('staff')
@section('css')
<script type="text/javascript" language="javascript" src="/addons/js/jquery.dataTables.js"></script>
<script src="/addons/js/jquery.dataTables.bootstrap.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/addons/css/jquery.dataTables.bootstrap.css">
<link rel="stylesheet" type="text/css" href="/addons/css/jquery.dataTables.css">
     <script src="/addons/js/bootstrap.js"></script>

<style>
#inbox,#out{
    display: none;
}
#send{
    display: block;
}
@if(isset($_GET['type']))
@if($_GET['type'] == "inbox")
#inbox{
    display: block;
}
#send,#out{
    display: none;
}
@else
#out{
    display: block;
}
#send,#inbox{
    display: none;
}
@endif
@else
#send{
    display: block;
}
#inbox,#out{
    display: none;
}
@endif
#sendH,#inboxH,#outboxH{
    border-radius: 3px;
    padding-left: 10px;
    padding-right: 10px;
    padding-top: 5px;
    padding-bottom: 5px;
    transition: 0.3s linear;
    position: relative;
    margin-top: -8%;
    margin-bottom: -8%;
}
#sendH:hover{
    transform: scale(1.1);
}
#inboxH:hover{
    transform: scale(1.1);
}
#outboxH:hover{
    transform: scale(1.1);
}
.select{
        background-color: #22cff6;
}
ul .users{
  margin-left: 2%;
  margin-right: 2%;
  cursor: pointer;
  transition: 0.5s linear;
  padding: 4px;
  border-radius: 3px;
}
#s  .userss{
    background-color: #003f54;
    padding:3px 1px 0 3px;
    border-radius: 3px;
    color:white;
    display: inline-block;
}
#res:focus{
    border: none;
}
.users:hover{
    background-color: #003f54;
}
</style>
<script type="text/javascript">
@if(isset($user))
                           var userId=[@for($x=0;$x<(count($user)-1);$x++)
                                                  "{{$user[$x]->id}}",
                                              @endfor
                                              "{{$user[(count($user)-1)]->id}}"
                                  ];
                                  var userName=[@for($x=0;$x<(count($user)-1);$x++)
                                                                        "{{$user[$x]->userName}}",
                                                                    @endfor
                                                                    "{{$user[(count($user)-1)]->userName}}"];
        @endif
function deletes(ht){
      var str=$('#toU').val().toString();
      var tr = str.replace(ht.id.toString(),"");
      $('#toU').val(tr);
      ht.parentNode.remove();
}
 function users(ht){
     $('#s').append('<div class="userss" style="display: inline-block;">'+ht.innerHTML+'<label style="cursor: pointer;" class="rem" onclick="deletes(this)" id="'+ht.id+'">x</label></div>');
     $('#ss').css('z-index',100);
     $('#userList').html('');
     $('#ss').text('Send To');
     $('#ss').css('color','#ababab');
    $('#toU').val($('#toU').val()+' '+ht.id);

    }
    $(document).ready(function(){



                                                //$('#s').html('<li>asdhjasd</li>');

                                                 $('#ss').keyup(function(){
                                                        var toBeAdded = "";
                                                        $('#userList').html('');
                                                        if($(this).text().toString().length > 2){
                                                            for(var ndx  = 0; ndx < userName.length; ndx++)
                                                                   if(userName[ndx].toLowerCase().indexOf($(this).text().toString().toLowerCase())!=-1 && $('#s').html().toString().indexOf(userName[ndx])==-1)
                                                                        toBeAdded += '<li class="users" onclick="users(this)" id="'+userId[ndx]+'">'+userName[ndx]+'</li>';
                                                                   $('#userList').html(toBeAdded);
                                                        }

                                                        if($(this).text() == ""){$(this).text('Send To');
                                                            $(this).css('color','#ababab');
                                                        }

                                                    }).focus(function(){
                                                        if($(this).text() == "Send To"){
                                                            $(this).text('');
                                                                            $(this).css('color','#000000');
                                                            }
                                                    }).keydown(function(){
                                                              if($(this).text() == "Send To"){
                                                              $(this).text('');
                                                              $(this).css('color','#000000');
                                                              }
                                                    });
            $('#seend').click(function(){
                $('#scom').text("");
                $('#mcom').text("");
                if($('#mes').val().toString().trim() == "")
                    $('#mcom').text("Message can't be empty! ");
                if($('#toU').val().toString().trim() == "")
                    $('#scom').text("Please select a sender!");
                if($('#mes').val().toString().trim() != "" && $('#toU').val().toString().trim() != "")
                    $('#sendForm').submit();
            });
    });

</script>
@stop
@section('contents')
<!-- Trigger the modal with a button -->

            <!-- Modal -->
            <div id="viewMessage" class="modal fade" role="dialog">
            <br/><br/><br/><br/><br/><br/><br/><br/><br/>
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <center> <h4 class="modal-title" style="color: #3498db;"><b><span class="glyphicon glyphicon-envelope"></span></b>&nbsp; M E S S A G E  &nbsp; O U T B O X</h4></center>
                  </div>
                  <div class="modal-body">
                    <br/>
                     <h5 id="moda"><b>Sent:  </b></h5>
                    <br/>
                    <h5 id="more"><b>To: </b></h5>
                    <br/>
                    <h5 id="mome"><b>Message: </b></h5>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>

              </div>
            </div>
 <div class="row">
         <div style="background-color: #3498db;padding-top: 0.22%;padding-bottom: 0.22%;width: 105%;margin-left: -1%;margin-top: -1.3%;">
             <center><h3 style="color: #ffffff;"><b>M E S S A G E</b></h3></center>
         </div>
 </div>
 <br/>
 @if(Session::has('success'))
 <div class="alert bg-success">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <b>{{Session::get('success')}}</b>
 </div>
 @endif


<div class="row" >
<br/>
       <div class="col-xs-3" style="margin-top: 1.8%;margin-left: 2%;margin-right: 2%;">
      <div class="well" style="background-color: white;">
       @if(isset($_GET['type']))
       @if($_GET['type'] == "inbox")

      <h5 id="sendH" style="cursor: pointer;"><b><span class="glyphicon glyphicon-send"></span></b>&nbsp; Send Message</h5>
                             <hr/>
                 <h5 id="inboxH" style="cursor: pointer;" class="select"><b><span class="glyphicon glyphicon-inbox"></span></b>&nbsp; Inbox</h5>
              <hr/>
                 <h5 id="outboxH" style="cursor: pointer;"><b><span class="glyphicon glyphicon-upload"></span></b>&nbsp; Outbox</h5>
       @else
             <h5 id="sendH" style="cursor: pointer;"><b><span class="glyphicon glyphicon-send"></span></b>&nbsp; Send Message</h5>
              <hr/>
                        <h5 id="inboxH" style="cursor: pointer;"><b><span class="glyphicon glyphicon-inbox"></span></b>&nbsp; Inbox</h5>
              <hr/>
                        <h5 id="outboxH" style="cursor: pointer;" class="select"><b><span class="glyphicon glyphicon-upload"></span></b>&nbsp; Outbox</h5>
       @endif
       @else
             <h5 id="sendH" style="cursor: pointer;" class="select"><b><span class="glyphicon glyphicon-send"></span></b>&nbsp; Send Message</h5>
              <hr/>
                        <h5 id="inboxH" style="cursor: pointer;"><b><span class="glyphicon glyphicon-inbox"></span></b>&nbsp; Inbox</h5>
              <hr/>
                        <h5 id="outboxH" style="cursor: pointer;"><b><span class="glyphicon glyphicon-upload"></span></b>&nbsp; Outbox</h5>
       @endif

       </div>
       </div>

       <br/>
       <div class="col-xs-8 well" id="send" style="background-color: white;">
             <form class="form-group" action="{{route('adminSendMessage')}}" method="post" id="sendForm">
                <input type="hidden" name="toU" id="toU"/>
                <input type="hidden" name="fromU" value="{{$_SESSION['id']}}"/>
                <div class="dropdown">
                <div class="form-control"  id="s" data-trigger="keyup" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" color:#ababab ; "><div id="ss" contenteditable="true" style="display: inline-block;margin-right: 5%;">Send To</div></div><br/>
                    <ul id="userList" class="dropdown-menu" style="position: relative;margin-top: -2%;">

                    </ul>
                </div>
                <h5 style="color:red;" id="scom"></h5>
                <textarea class="form-control" name="messages" id="mes" cols="30" rows="10" placeholder="Your Message Here"></textarea>
                <h5 style="color:red;" id="mcom"></h5>
                <br/>
                <hr style="border: 1px solid white;"/>
                <br/>
                <div>
                <div class="btn btn-success" id="seend" style="display: inline;margin-left: 50%;"><b><span class="glyphicon glyphicon-send"></span></b>&nbsp; Send</div>
                <div class="btn btn-warning " style="display: inline;margin-left: 3%;">
                  <span class=" glyphicon glyphicon-repeat" ></span>
                  <input type="reset" style="background-color: transparent;border: none;" id="res">
                </div>
                </div>
             </form>
       </div>
       <div class="col-xs-8 well" id="inbox" style="background-color:white;margin-left: 3%;">
               <div class="row">
               <table id="messageTableI" class="table table-hover" cellspacing="0" width="100%">
               <thead style="background-color: #0b2644;color:white;display: none;">
                                   <tr><th>Date</th><th>From</th><th>Message</th><th></th><th></th></tr>

               </thead>
                    <tbody>
                       @if(isset($messageIn))
                        @if(count($messageIn)>0)
                            @foreach($messageIn as $m)
                                 <tr class="outMess" style="cursor: pointer;" id="{{$m->id}}" data-toggle="modal" data-target="#viewMessage">
                                                                               <td><img src="{{$m->img}}" alt="" height="70" width="70" class="img-circle"/></td>
                                                                              <td>{{date_format(date_create($m->created_at),'M d,Y')}}</td>
                                                                              <td><b>{{$m->name}}</b></td>
                                                                              <td>@if($m->type == 'coach')<div class="label label-success">{{$m->type}}</div>@elseif($m->type == 'athlete')<div class="label label-primary">{{$m->type}}</div>@else<div class="label label-warning">{{$m->type}}</div>@endif</td>
                                                                              <td id="{{$m->messages,0,20}}">{{substr($m->messages,0,20)}}...</td>
                                                                           </tr>
                            @endforeach
                        @else

                        @endif
                        @endif
                    </tbody>
               </table>
               </div>
       </div>

       <div class="col-xs-8 well" id="out" style="margin-left: 3%;background-color: white;">
        <div class="row">
            <table id="messageTableO" class="table table-hover" cellspacing="0" width="100%">
            <thead style="background-color: #0b2644;color:white;display: none;">
                   <tr><th></th><th></th><th></th><th></th><th></th></tr>
            </thead>
                                <tbody>

                                   @if(isset($messageOut))
                                    @if(count($messageOut)>0)
                                        @foreach($messageOut as $m)
                                             <tr class="outMess" style="cursor: pointer;" id="{{$m->id}}" data-toggle="modal" data-target="#viewMessage">
                                                 <td><img src="{{$m->img}}" alt="" height="70" width="70" class="img-circle"/></td>
                                                <td>{{date_format(date_create($m->created_at),'M d,Y')}}</td>
                                                <td><b>{{$m->name}}</b></td>
                                                <td>@if($m->type == 'coach')<div class="label label-success">{{$m->type}}</div>@elseif($m->type == 'athlete')<div class="label label-primary">{{$m->type}}</div>@else<div class="label label-warning">{{$m->type}}</div>@endif</td>
                                                <td id="{{$m->messages,0,20}}">{{substr($m->messages,0,20)}}...</td>
                                             </tr>
                                        @endforeach
                                    @else

                                    @endif
                                    @endif
                                </tbody>
                           </table>
                           </div>
       </div>
</div>
<script type="text/javascript" >
        $(document).ready(function(){
               $('#messageTab').addClass('clicked');
                function unTriggerTabs(){
                                    $('#inboxH').removeClass('select');
                                    $('#outboxH').removeClass('select');
                                    $('#sendH').removeClass('select');
                                    $('#send').css('display','none');
                                    $('#inbox').css('display','none');
                                    $('#out').css('display','none');

                              }
                              $('#sendH').click(function(){
                                   unTriggerTabs();
                                   $(this).addClass('select');
                                   $('#send').css('display','block');
                              });
                               $('#inboxH').click(function(){
                                                   unTriggerTabs();
                                                  $(this).addClass('select');
                                                  $('#inbox').css('display','block');
                                             });
                               $('#outboxH').click(function(){
                                                   unTriggerTabs();
                                                                 $(this).addClass('select');
                                                                 $('#out').css('display','block');
                                                            });
               $('#messageTableI').DataTable();
               $('#messageTableO').DataTable();
                $('#messageTableO_length').hide();
                $('#messageTableI_length').hide();
               $('.outMess').click(function(){
                    $('#more').html('<b>To :</b>'+$(this).children('td:nth-child(3)').text());
                    $('#moda').html('<b>Sent: </b>'+$(this).children('td:nth-child(2)').text());
                    $('#mome').html('<b>Message: </b>'+$(this).children('td:nth-child(5)').attr('id'));
               });
        });
</script>
@stop
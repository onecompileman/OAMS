@extends('staff')
@section('css')
<script type="text/javascript" language="javascript" src="/addons/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="/addons/css/jquery.dataTables.bootstrap.css">
<link rel="stylesheet" type="text/css" href="/addons/css/jquery.dataTables.css">
    <link href="/addons/css/custom-styles.css" rel="stylesheet" />

     <script src="/addons/js/bootstrap.js"></script>
     <style>
           .cont{
            cursor: pointer;
           }
           .posC{
            cursor:pointer;
           }
           .selection{
            transition: 0.7s linear;
           }
           .faqrow{
            cursor: pointer;
           }
           .panel-body{
            background-color: white;
           }
          /* body{
                background-color: #303e3e;
           }*/
           h2{
          color:white;
          position: relative;
           }

           .selection{
           cursor: pointer;
           }
     </style>
    <script>
            $(document).ready(function(){
                $('.nav').children('li:nth-child(7)').addClass('active');

            });
    </script>
@stop
@section('contents')
<!-- Trigger the modal with a button -->

            <!-- Modal -->
            <div id="contactModal" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <center><h4 class="modal-title" style="color:#22cff6;"><b><span class="glyphicon glyphicon-envelope"></span></b>&nbsp; M E S S A G E</h4></center>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" id="contactID">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-8"><b style="display: inline-block;">Date Sended: </b><h5 style="display: inline-block;" id="date"></h5></div>
                        </div>
                        <div class="row">
                                                    <div class="col-sm-8"><b style="display: inline-block;">Sender: </b><h5 style="display: inline-block;" id="sender"></h5></div>
                                                </div>
                        <div class="row">
                                                    <div class="col-sm-8"><b style="display: inline-block;">Contact No: </b><h5 style="display: inline-block;" id="email"></h5></div>
                                                </div>
                                                                        <div class="row">
                                                                                                    <div class="col-sm-8"><b style="display: inline-block;">Email: </b><h5 style="display: inline-block;" id="contactno"></h5></div>
                                                                                                </div>
                         <div class="row">
                             <div class="col-sm-4"><h5><b>Message: </b></h5></div>
                             <div class="col-sm-12"><textarea class="form-control" readonly name="" id="message" cols="30" rows="10"></textarea></div>
                             </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal"><b><span class="glyphicon glyphicon-ban-circle"></span></b> &nbsp;Close</button>
                    <button id="reply" class="btn btn-info"><b><span class="glyphicon glyphicon-send"></span></b>&nbsp; Reply</button>
                  </div>
                </div>

              </div>
            </div>
            <!-- Trigger the modal with a button -->

                        <!-- Modal -->
                        <div id="postModal" class="modal fade" role="dialog">
                        <br/><br/><br/><br/>
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Modal Header</h4>
                              </div>
                              <div class="modal-body">
                                <p>Some text in the modal.</p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>

                          </div>
                        </div>
                        <!-- Trigger the modal with a button -->

                                    <!-- Modal -->
                                    <div id="faqModal" class="modal fade" role="dialog">
                                      <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <center><h4 class="modal-title" style="color:#22cff6;"><b><span class="glyphicon glyphicon-question-sign"></span></b>&nbsp; F A Q</h4></center>
                                          </div>
                                          <form class="form-group" id="faqForm" action="" method="post">
                                          <div class="modal-body">
                                          <input type="hidden" name="id" id="faqID"/>
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-sm-4"><h5><b>Question:</b></h5></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-10"><textarea class="form-control" name="question" id="question" cols="30" rows="5"></textarea></div>
                                                </div>   <div class="row">
                                                    <div class="col-sm-4"><h5><b>Answer:</b></h5></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-10"><textarea class="form-control" name="answer" id="answer" cols="30" rows="5"></textarea></div>
                                                </div>
                                            </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="reset" id="resetF" class="btn btn-warning" ><b><span class="glyphicon glyphicon-repeat"></span></b>&nbsp; Reset</button>
                                            <button type="submit" id="addF" class="btn btn-info"><b>+</b>&nbsp; Add</button>
                                            <button type="button" id="deleteF" data-toggle="modal" data-target="#faqDel" class="btn btn-danger"><b><span class="glyphicon glyphicon-trash"></span></b>&nbsp; Delete</button>
                                            <button type="submit" id="updateF" class="btn btn-info"><b><span class="glyphicon glyphicon-send"></span></b>&nbsp; Update</button>

                                          </div>
                                          </form>
                                        </div>

                                      </div>
                                    </div>
                                    <!-- Trigger the modal with a button -->

                                                <!-- Modal -->
                                                <div id="faqDel" class="modal fade" role="dialog">
                                                  <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <center><h4 class="modal-title"><b><span class="glyphicon glyphicon-question-sign"></span></b>&nbsp; C O N F I R M A T I O N</h4></center>
                                                      </div>
                                                      <form action="{{route('adminDeleteFaq')}}" method="post">
                                                      <div class="modal-body">
                                                        <h4><b>Are you sure to delete this FAQ?</b></h4>
                                                        <input type="hidden" name="id" id="faqdID"/>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-warning" data-dismiss="modal"><b><span class="glyphicon glyphicon-ban-circle"></span></b>&nbsp; Cancel</button>
                                                        <button class="btn btn-danger"><b><span class="glyphicon glyphicon-trash"></span></b>&nbsp; Delete</button>
                                                      </div>
                                                      </form>
                                                    </div>

                                                  </div>
                                                </div>
    <div class="row">
            <div style="background-color: #3498db;padding-top: 0.22%;padding-bottom: 0.22%;width: 105%;margin-left: -1%;margin-top: -1.3%;">

                <center><h3 style="color: #ffffff;position:relative;margin-top: 15px;"><b>C M S &nbsp;&nbsp; </b></h3></center>
             <br/>
            </div>

        </div>

        <br/>
        @if(Session::has('success'))
            <div class="alert bg-success">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <b>{{Session::get('success')}}</b>
            </div>
        @endif
    <div class="row">
    <br/><br/>
    <div class="col-sm-4 selection">
    <div class="panel panel-primary text-center no-boder bg-color-green">
                                <div class="panel-body"  >
                                    <h1 style="font-size: 100px;"><span class="glyphicon glyphicon-envelope" style="color:#5cb85c;"></span></h1>
                                    <h2 style="color:#5cb85c;">{{count($contactMessage)}}</h2>
                                </div>
                                <div class="panel-footer back-footer-green">
                                    <h4 style="color:white;">Messages From Guests</h4>

                                </div>
                            </div>
                            </div>
                            <div class="col-sm-4 selection">
                                <div class="panel panel-primary text-center no-boder bg-color-green">
                                                            <div class="panel-body"  >
                                                                <h1 style="font-size: 100px;"><span class="glyphicon glyphicon-file" style="color:#4cb1cf;"></span></h1>
                                                                <h2 style="color:#4cb1cf;">{{count($postList)}}</h2>
                                                            </div>
                                                            <div class="panel-footer back-footer-blue" >
                                                                <h4 style="color:white;">Post</h4>

                                                            </div>
                                                        </div>
                                                        </div>
                                                        <div class="col-sm-4 selection" >
                                                                                                                                                                                                              <div class="panel panel-primary text-center no-boder bg-color-red">
                                                                                                                                                                                                                                          <div class="panel-body"  >
                                                                                                                                                                                                                                              <h1 style="font-size: 100px;"><span class="glyphicon glyphicon-question-sign" style="color:#f0433d;"></span></h1>
                                                                                                                                                                                                                                              <h2 style="color:#f0433d">{{count($faqList)}}</h2>
                                                                                                                                                                                                                                          </div>
                                                                                                                                                                                                                                          <div class="panel-footer back-footer-red" >
                                                                                                                                                                                                                                              <h4 style="color:white;">FAQ(Frequently Asked Question)</h4>

                                                                                                                                                                                                                                          </div>
                                                                                                                                                                                                                                      </div>
                                                                                                                                                                                                                                      </div>
                                                                                                                                                                                                                                       <div class="col-sm-4 selection">
                                                                                                                                                                                                                                                                                                                              <div class="panel panel-primary text-center no-boder ">
                                                                                                                                                                                                                                                                                                                                                          <div class="panel-body"  >
                                                                                                                                                                                                                                                                                                                                                              <h1 style="font-size: 100px;"><span class="glyphicon glyphicon-dashboard" style="color:#f0ad4e;"></span></h1>
                                                                                                                                                                                                                                                                                                                                                              <h2 style="color:#f0ad4e;">8,457</h2>
                                                                                                                                                                                                                                                                                                                                                          </div>
                                                                                                                                                                                                                                                                                                                                                          <div class="panel-footer back-footer-brown" >
                                                                                                                                                                                                                                                                                                                                                              <h4 style="color:white;">Game Standing</h4>

                                                                                                                                                                                                                                                                                                                                                          </div>
                                                                                                                                                                                                                                                                                                                                                      </div>
                                                                                                                                                                                                                                                                                                                                                      </div>
                                                                                                                                                                                                                                                                                                                                                       <div class="col-sm-4 selection">
                                                                                                                                                                                                                                                                                                                                                                                                                                              <div class="panel panel-primary text-center no-boder bg-color-red">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <div class="panel-body"  >
                                                                                                                                                                                                                                                                                                                                                                                                                                                                              <h1 style="font-size: 100px;"><span class="glyphicon glyphicon-road" style="color:#005599;"></span></h1>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                              <h2 style="color:#005599">8,457</h2>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                          </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <div class="panel-footer" style="background-color: #005599;color:white;">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                              <h4 style="color:white;">Achievements</h4>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                          </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                      </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                      </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                       <a href="/" target="_blank" class="col-sm-4 selection">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      <div class="panel panel-primary text-center no-boder bg-color-green">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  <div class="panel-body"  >
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      <h1 style="font-size: 100px;"><span class="glyphicon glyphicon-eye-open" style="color:#68217a;"></span></h1>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      <h2 style="color:#68217a;">{{$pageViews}}</h2>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  <div class="panel-footer" style="background-color: #68217a;color:white;">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     <h4 style="color:white;">Page Views</h4>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              </div>
</a>
    <div class="col-sm-12 tables" id="messages" style="margin-left: 0;margin-right: 0;">

    <div class="panel panel-teal">
    					<div class="panel-heading dark-overlay" style="background-color: #147578;">   <center><b><h2><span class="glyphicon glyphicon-envelope" ></span>&nbsp;&nbsp;&nbsp;Messages From Guests</h2></b></center>
<br/></div>
    					<div class="panel-body">
                            <div class="row">
                                    <table class="table-hover" id="contact">
                                            <thead><tr style="color:black;">
                                                <th>Date Sended</th>
                                                <th>Sender</th>
                                                <th>Message</th>
                                                <th>Contact NO</th>
                                                <th>Email</th>
                                                </tr></thead>
                                                <tbody  style="color:black;">
                                                @foreach($contactMessage as $message)
                                                    <tr class="cont" data-toggle="modal" data-target="#contactModal" style="color:black;">
                                                        <td>{{date_format(date_create($message->created_at),'Y-m-d')}}</td>
                                                        <td>{{$message->sender}}</td>
                                                        <td><div>{{substr($message->message,0,20)}}...</div><div style="display: none;">{{$message->message}}</div></td>
                                                        <td>{{$message->contactno}}</td>
                                                        <td>{{$message->email}}</td>

                                                        </tr>
                                                        @endforeach
                                                </tbody>
                                    </table>
                                    </div>
    					</div>
    				</div>


    </div><div class="col-sm-12 tables" style="margin-left: 0;margin-right: 0;" id="posts">
 <br/>
    <div class="panel panel-teal">
    					<div class="panel-heading dark-overlay" style="background-color: #147578;">               <center><b><h2><span class="glyphicon glyphicon-file" ></span>&nbsp;&nbsp;&nbsp;Posts</h2></b></center>
<br/></div>
    					<div class="panel-body">
    					 <div class="btn btn-success" style="background-color: #0b2644;"><b>+</b>&nbsp; Add post</div>
                                                                        <hr/>
                                                            <div class="row">
                                                            <table class="table-hover table-bordered" id="post">
                                                                <thead><tr style="color:black;">
                                                                    <th>Date</th>
                                                                    <th>Author</th>
                                                                    <th>Title</th>
                                                                    <th>Contents</th>
                                                                    </tr></thead>
                                                                    <tbody  style="color:black;">
                                                                    @foreach($postList as $post)
                                                                    <tr data-toggle="modal" data-target="#postModal" class="posC" style="color:black;">
                                                                        <td>{{date_format(date_create($post->created_at),'M d, Y')}}</td>
                                                                        <td><b>{!!$post->author!!}</b></td>
                                                                        <td>{{$post->title}}</td>
                                                                        <td>{{substr($post->article,0,15)}}...</td>
                                                                        </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                            </table>
                                                            </div>
                            </div>
    					</div>
    				</div>

    <div class="col-sm-8 tables" id="faqs" >
    <div class="panel panel-teal">
    					<div class="panel-heading dark-overlay" style="background-color: #147578;">                       <center><b><h2><span class="glyphicon glyphicon-question-sign" ></span>&nbsp;&nbsp;&nbsp;F A Q</h2></b></center>
<br/></div>
    					<div class="panel-body" style="background-color: white;">
                              <div class="btn btn-success" id="addfaq" data-toggle="modal" data-target="#faqModal" style="background-color: #0b2644;"><b>+</b>&nbsp; Add FAQ</div>
                                                   <hr/>
                                                   <div class="row">
                                                    <table class="table-hover table-bordered" id="faq">
                                                        <thead><tr style="color:black;">
                                                            <th>Date</th>
                                                            <th>Question</th>
                                                            <th>Answer</th>
                                                            </tr></thead>
                                                            <tbody  style="color:black;">
                                                            @foreach($faqList as $faq)
                                                                <tr class="faqrow" data-toggle="modal" data-target="#faqModal">
                                                                    <td>{{date_format(date_create($faq->created_at),'Y-m-d')}}<div style="display: none;">{{$faq->id}}</div></td>
                                                                    <td><div>{{substr($faq->question,0,10)}}..</div><div style="display: none;">{{$faq->question}}</div></td>
                                                                    <td>
                                                                        <div>{{substr($faq->answer,0,10)}}..</div><div style="display: none;">{{$faq->answer}}</div>
                                                                    </td>
                                                                    </tr>
                                                                    @endforeach
                                                            </tbody>
                                                                            </table></div>
    					</div>
    				</div>


    </div><div class="col-sm-6 tables">
         <div class="panel panel-teal">
            					<div class="panel-heading dark-overlay" style="background-color: #147578;">                                                  <center><b><h2><span class="glyphicon glyphicon-dashboard" ></span>&nbsp;&nbsp;&nbsp;Game Standing</h2></b></center>

     <br/>   </div>
            					<div class="panel-body" style="background-color: white;">

            					</div>
            				</div>
    </div>
        <div class="col-sm-10 col-sm-offset-1 tables" >
             <div class="panel panel-teal">
                					<div class="panel-heading dark-overlay" style="background-color: #147578;">      <center><b><h2><span class="glyphicon glyphicon-dashboard" ></span>&nbsp;&nbsp;&nbsp;Achievements</h2></b></center>
            <br/></div>
                					<div class="panel-body" style="background-color: white;">
                					</div>
                					</div>

</div>
</div>
        <script class="init">
            function toggleSelect(){
              $('.selection').fadeToggle('fast');
                                  $('.tables').hide();
            }
            var m=0,p=0,f=0;
            function toggleVar(){
                m = (m == 1)? 0:m+1;
                p = (p == 1)? 0:p+1;
                f = (f == 1)? 0:f+1;

            }
            $(document).ready(function(){
                $('#contact').DataTable();
                $('#post').DataTable();
                $('#faq').DataTable();
                $('#faq_length').hide();
                $('.tables').hide();
                $('.selection').click(function(){
                if($(this).html().toString().indexOf("Page")==-1){
                    toggleSelect();
                    $(this).fadeToggle('fast');
                    if($(this).html().toString().indexOf('Message')!=-1 && m==0){ $('#messages').show();}
                    else if($(this).html().toString().indexOf('Post')!=-1 && p==0){ $('#posts').show();}
                    else if($(this).html().toString().indexOf('FAQ')!=-1 && f==0){ $('#faqs').show();}
                    toggleVar();
                    }
                });
                $('#addfaq').click(function(){
                    $('#addF').show();
                    $('#resetF').show();
                    $('#deleteF').hide();
                    $('#updateF').hide();
                    $('#faqForm').attr('action','{{route('adminAddFaq')}}');
                    $('#question').val('');
                    $('#answer').val('');
                });
                $('.faqrow').click(function(){
                    $('#addF').hide();
                    $('#resetF').hide();
                    $('#deleteF').show();
                    $('#updateF').show();
                    $('#faqForm').attr('action','{{route('adminUpdateFaq')}}');
                    $('#question').val($(this).children('td:nth-child(2)').children('div:nth-child(2)').html());
                    $('#answer').val($(this).children('td:nth-child(3)').children('div:nth-child(2)').html());
                    $('#faqID').val($(this).children('td:first-child').children('div:first-child').html());
                });
                $('#deleteF').click(function(){
                    $('#faqdID').val($('#faqID'));
                });
                $('#faq_filter').hide();
                $('#contact_length').hide();
                $('#post_length').hide();
                $('.cont').click(function(){
                    $('#date').html($(this).children('td:nth-child(1)').html());
                    $('#sender').html($(this).children('td:nth-child(2)').html());
                    $('#email').html($(this).children('td:nth-child(4)').html());
                    $('#contactno').html($(this).children('td:nth-child(5)').html());
                    $('#message').val($(this).children('td:nth-child(3)').children('div:nth-child(2)').html());
                });
            });
        </script>
@stop
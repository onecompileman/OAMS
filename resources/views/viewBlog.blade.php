@extends('coach')
@section('css')<script src="/addons/js/jquery.form.js"></script>
        <?php if(!isset($_SESSION)) session_start(); ?>
    <style>
    .err li{
        color:red;
        list-style: none;
    }
        .success-message{
        position: absolute;
        z-index: 10;
        top:300px;
        left: 30%;
            background-color: white;
            box-shadow: 0px 0px 10px 10px rgba(0,0,0,0.6);
            border-radius: 5px;
            padding: 10px;
            color:green;
            @if(Session::has('Added'))
                display: inline-block;
            @else
                display: none;
            @endif
        }
        #modal{
            position: absolute;
            top: 0;
            left: 0;
            margin-left: 10%;
            width:90%;
            height: 120%;
            background-color: rgba(0,0,0,0.6);
            z-index: 10;
            @if(Session::has('Error'))
                 display: inline-block;
                 opacity:1;
            @else
            display: none;
            opacity:0;
            @endif
        }
        #modal .panel{
            position: relative;
            margin-left: 15%;
        }
        #modal div{
            z-index: 11;
        }
    </style>
   <script>
        $(document).ready(function(){
        $.ajaxSetup({
               	headers: {
               		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               	        }
               });
               var x=1;
        $('#update').click(function(){
               $('#modal').css('display','inline').animate({'opacity':'1'},800);
                                $('#type').val('add');
                                $('.row').children('h4').html('Update');
                                $('#sub').val('Update');
                                $('input[name="ID"]').val($(this).val());


            $.post('{{route('viewUpdateBlog')}}',{id:$(this).val()},function(html){

                   var blogDetails=html.split('<br>');
                   var type=['Article','Achievement','News'];
                   document.getElementsByName('title')[0].value=blogDetails[0];
                   document.getElementsByName('v_link')[0].value = blogDetails[1];

                   document.getElementsByName('article')[0].value=blogDetails[3];

                   document.getElementsByName('type')[0].selectedIndex=type.indexOf(blogDetails[4]);
            });
        });


             /* $('#sub').click(function(){
              var data = new FormData();
               jQuery.each(jQuery('input[name="figure"]')[0].files, function(i, file) {
                   data.append('file-'+i, file);
               });
                    $.post("",{data:data}{title:$('input[name="title"]').val(),figure:$('input[name="figure"]').val(),article:$('textarea[name="article"]').val(),type:$('select[name="type"]').val(),typeOfR:$('#type').val()},function(html){
                              var check=true;
                                if(check&=(html=='Added')){
                                    $('.success-message').toggle();
                                    $('.success').html("Added Sucessfully");
                                    }
                                 else
                                    $('.err').html(html);
                                 if(check){


               });*/
                setInterval(function(){
                                                                                      x++;
                                                                                      if(x==3)
                                                                                          $('.success-message').animate({opacity:'0'},1000);



                                                                                      if(x==4)
                                                                                       $('.success-message').toggle() ;

                                                                                  },1000);

               $('#t').change(function(){
                    if($('#t').val()=='News')
                        $('#news').html('Url: <input class="form-control" type="url" name="link">');
               });
               $('.close').click(function(){
                    $('#modal').animate({'opacity':'0'},800,function(){$(this).css('display','none')});
               });
               $('.vAdd').click(function(){
                    $('#modal').css('display','inline').animate({'opacity':'1'},800);
                    $('#type').val('add');
                    $('.row').children('h4').html('add');
                    $('#sub').val('Add');
               });
            $('.menu').children('li').removeClass('active');
            document.getElementsByClassName('menu')[0].getElementsByTagName('li')[5].className='active';

        });
   </script>
@stop
@section('contents')

    <span class=""></span>
    <div class="panel panel-primary">
        <div class="panel-heading"><h4 style="color:white;text-align: center;"><span class="glyphicon glyphicon-blackboard"></span>Blogs You Have Created</h4></div>
        <div class="panel-body">
            <div class="btn btn-success vAdd"><span class="glyphicon glyphicon-upload"></span>Add new Post</div>
            <table class="table table-bordered">
                <tr class="btn-primary"><td>Title</td><td>Type</td><td>Date Created</td><td>View</td><td>Update</td></tr>
                @foreach($blogList as $blog)
                    <tr>
                        <td>{{$blog->title}}</td><td>{{$blog->type}}</td><td>{{$blog->created_at->format('F d,Y')}}</td>
                        <td><a href="/blog/{{$blog->title}}" target="_blank"><button class="btn btn-info">View</button></a></td>
                        <td><button class="btn btn-warning" id="update" value="{{$blog->id}}">Update</button></td>
                    </tr>
                @endforeach
            </table>
            <div class="pages">
            <center>
            @for($x=1;$x<(($count/8)+(($count%8==0)? 0:1));$x++)
            <a href="/OAMS/coach/Blog/{{$x}}"><div class="btn btn-primary" @if($x==$page)style="background-color:#2b579a;"@endif>{{$x}}</div></a>

            @endfor
            </center>
            </div>
            <center><h5>There are {{$count}} posts posted in your behalf</h5></center>
        </div>
    </div>
@stop
@section('popup')
<div id="modal">
<div class="container">
<br/><br/><br/>
<div class="row">
    <div class="btn btn-danger close">X</div>
    </div>
    <br/><br/>
    <div class="row">
    <div class="panel panel-primary">
        <div class="panel-heading"><center><h4 style="color:white;"><span class="glyphicon glyphicon-blackboard"> Post</h4></center></div>
        <div class="panel-body">
            <div class="put">
                <form class="form-group" id="form" action="{{route('addBlog')}}" method="post" enctype="multipart/form-data">
                    Title:<input class="form-control" type="text" name="title">
                    <input type="hidden" name="MAX_FILE_SIZE" value="2500000">
                    <input type="hidden" id="ID" name="ID"/>
                    Figure:<input class="form-control" type="file" name="figure">
                    Video Link:<input class="form-control" type="url" name="v_link">
                    Type:<select id="t" name="type" class="form-control">
                           <option>Article</option>
                           <option>Achievement</option>
                           <option>News</option>
                    </select>
                    <div id="news"></div>
                    Article:<textarea class="form-control" name="article"></textarea>
                    <input type="hidden" name="typeOfR" id="type">
                    <input type="submit" name="submit" class="btn btn-info" id="sub" value="update">

                </form>
            </div>
               <ul class="err">
                    @if(Session::has('Error'))
                           @foreach(Session::get('Error')[0] as $err)
                                <li>{{$err}}</li>
                           @endforeach
                    @endif
               </ul>
        </div>
        </div>
        </div>
      </div>
</div>
       <center> <div class="success-message">
        <h3 class="success">
            @if(Session::has('Added'))
                {{Session::get('Added')[0]}}
            @endif
        </h3>
        </div></center>

@stop
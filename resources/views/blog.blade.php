@extends('template')
<!DOCTYPE>
<html>
<head>
 <link rel="stylesheet" type="text/css" href="/addons/css/bootstrap.css">
 <style>
        .post{
                    background-color:rgba(255,255,255,0.7);
                    position: relative;
                    padding: 30px;
                    margin-bottom: -100px;
                }
        .author{
        text-align: center;
        position: relative;
           padding:15px;
        }

        .content{
            overflow-x: hidden;
            overflow-y: scroll;
            height: 300px;
                }
        .header{
        background-color: #005599;
        width: 100%;
        padding-top: 3px;
        padding-bottom: 3px;
        color:#ffce42;
        text-align: center;
        margin-bottom: 10px;
        }
        .carousel-inner{
        height: 280px;
        }
        #footer{
        height: 35px;
        }
.header2{
background-color: #005599;
    padding-top: 3px;
        padding-bottom: 3px;
        width: 50%;
          color:#ffce42;
                text-align: center;
                margin-bottom: 10px;
}
#figure{
box-shadow: 0 0 3px 3px rgba(0,0,0,0.6);
}
 </style>
</head>
<body>

    @section('contents')
    <br/><br/>
    <div class="row" style="padding-bottom: 2%;padding-top: 2%;background-color:#3498db; ">
        <div class="title">
              <center> <h2 style="color:white;"><b>P O S T S</b></h2> </center>
        </div>
    </div>
    <div class="row">
    <div class="col-md-10 col-md-offset-1">
           @foreach($blogCon as $blog)
                         <div class="post">
                         <center> <h1 class="postHead"><b>{{$blog->title}}</b></h1></center>
                          <br><br>
                          <img id="figure" height="200px" width="100%" src="{{$blog->figure}}">
                          <br><br><br><br>
                            <h4>{{$blog->created_at->format('F d,Y')}}</h4>
                           <hr>
                          <p >
                              {{$blog->article}}
                          </p>
                           <br/><br/><br/>
                           <hr>
                           <div class="author">
                           <center><img src="{{$uploaderInfo[0]->profile_pic}}" height="75" width="75" class="img-responsive"/></center>
                           <h4><b>Author</b>: {{$uploaderInfo[0]->firstname}} {{ucfirst($uploaderInfo[0]->middlename)}}. {{$uploaderInfo[0]->surname}}</h4>
                            </div>
                         </div>
                         <br><br><br><br><br>
                         @endforeach
        </div>
        </div>
    @stop


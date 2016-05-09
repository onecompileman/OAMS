@extends('coach')
@section('css')
    <style> .err li{
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
            color:green;\
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
            height: 100%;
            background-color: rgba(0,0,0,0.7);
            z-index: 10;
            opacity:0;
            display: none;
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
            $('.menu').children('li').removeClass('active');
            document.getElementsByClassName('menu')[0].getElementsByTagName('li')[3].className='active';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#getStats').click(function(){
                $('#modal').css('display','inline').animate({'opacity':'1'},500);
                $.post('{{route('playerStatsScrap')}}',{data:'haha'},function(html){
                    $('.panel-body').html(html);
                });
            });
            $('#close').click(function(){
                if(confirm('Are You Sure?'))
               $('#modal').animate({'opacity':'0'},500).css('display','inline');
            });
        });

    </script>
@stop
@section('contents')
    <center>
    @if($count==0)
        <h4>No records of Statistics Yet!</h4>
        <div class="btn btn-primary" id="getStats"><span class="glyphicon glyphicon-download-alt"></span>Get Statistics</div>
         <div id="con"></div>
         @else
    @endif
        </center>
@stop
@section('popup')
    <div id="modal">
        <div class="container">
            <div class="haha" style="position: absolute; margin-top:7%; margin-left: 90%;">
                <div class="btn btn-danger" id="close">X</div>
            </div>
            <br><br><br><br><br><br><br><br><br>
            <div class="col-sm-8 col-sm-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4><span class="glyphicon glyphicon-refresh"></span>Please Wait</h4>
                </div>
                <div class="panel-body">
                    <h5>Getting Data from UAAP, Please Wait{{$haha}}</h5>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                            <span class="sr-only">100% Complete</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </div>
    </div>
@stop
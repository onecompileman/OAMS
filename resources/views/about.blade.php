@extends('template')
@section('addons')
<style>
    .shade{
        opacity: 0;
        transition:1s linear;
    }
    .shade:hover{
        opacity: 1;
    }
    .on{
        background-color: #213978;
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
          $('.nav').children('li').removeClass('on');
          $('.nav').children('li:nth-child(4)').addClass('on');
    });
</script>
@stop
@section('contents')
<br/><br/>
     <div class="row" style="padding-bottom: 2%;padding-top: 2%;background-color:#3498db; ">
                  <div class="title">
                        <center> <h2 style="color:white;"><b>A B O U T &nbsp;&nbsp;U S</b></h2> </center>
                  </div>
              </div>
              <div class="row">
                    <img height="400px" width="100%" src="/sys_files/img/homescreen/about/back.jpg">
                    <div class="shade" style="position: absolute;top:155px;height: 400px;width: 120%;background-color: rgba(0,0,0,0.35);">
                            <br/><br/><br/><br/><br/><br/>
                            <div class="col-sm-offset-3">
                            <h1 style="color:white;text-shadow: 0 0 5px #000000;"><b>W E &nbsp; M A K E &nbsp; D I F F E R E N C E</b></h1>
                            </div>
                    </div>
              </div>
                <img src="/sys_files/img/homescreen/about/back2.jpg" style="height: 620px;  width: 100%;position: absolute;z-index:-10;">
              <div class="row panel" style="background-color: rgba(255,255,255,0.8)">

                    <div class="cont" >
                    <center><h2><b>N a t i o n a l &nbsp;&nbsp; U n i v e r s i t y</b></h2></center>
                    <br/>
                    <div class="col-sm-offset-3 col-sm-7">
                    <h3><b>M i s s i o n</b></h3>
                    <p style="font-size: 20px;">
                        National University provides relevant, innovative and accessible education and other development programs to :<br/><br> a.) Its students, by developing them in to moral, spiritual and responsible students <br/> b.) Its employees by enhancing their competencies and providing them rewarding work environment <br/> c.) Its alumni by cultivating in them a sense of pride and commitment to their alma matter <br/> d.)Its community by contributing to uplift of the various aspects of life of its members
                        <br/> e.) Its industry partners and employers by providing them with graduates who will positively contribute to their growth and development
                    </p>
                    <br><br/>
                    <h3><b>V i s i o n</b></h3>
                    <p style="font-size: 20px;">
                        National University characterized by its cultural heritage of Dynamic Filipinism, envision itself as a leading educational institution committed to nation building.
                    </p>
                    </div>
                    </div>
              </div>
              <div class="row panel" style="background-color: #68217a;margin-top: -20px;margin-bottom: 0px;">
                   <center> <h3 style="color:white;"><span class="glyphicon glyphicon-comment" style="color:#22cff6; "></span><b>F A Q</b> (Frequently Asked Questions)</h3></center>
              </div>
@stop

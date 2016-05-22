@extends('staff')
@section('css')
<script type="text/javascript" language="javascript" src="/addons/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="/addons/css/jquery.dataTables.bootstrap.css">
<link rel="stylesheet" type="text/css" href="/addons/css/jquery.dataTables.css">
    <link href="/addons/css/custom-styles.css" rel="stylesheet" />
     <script src="/addons/js/bootstrap.js"></script>
     <script>
        $(document).ready(function(){
            $('#activity').DataTable({
                info:false
            });
            $('#activity_length').hide();
        });
     </script>
@stop
@section('contents')
<div class="row">
            <div style="background-color: #3498db;padding-top: 0.22%;padding-bottom: 0.22%;width: 105%;margin-left: -1%;margin-top: -1.3%;">

                <center><h3 style="color: #ffffff;position:relative;margin-top: 15px;"><b>A C T I V I T Y &nbsp;&nbsp; L O G</b></h3></center>
             <br/>
            </div>

        </div>

        <br/>
        <div class="col-sm-12 well" style="background-color: #ffffff;">
            <table id="activity" class="table table-hover">
                <thead><tr style="display: none;"><th></th><th></th><th></th><th></th></tr></thead>
                <tbody>
                @foreach($logreportList as $log)

                    <tr>
                        <td>@if(strcasecmp($log->model,'faq') == 0)<span style="color:#f0433d;font-size: 50px;margin-left: 5%;margin-right: 5%;" class="glyphicon glyphicon-question-sign"></span> @endif</td>
                        <td ><center>
                            <b>{{$log->action}}</b>
                                                                           </center></td>
                        <td><label class="label label-default badge" for="" style="padding-top: 10px;padding-bottom: 10px;position: relative;margin:10px 10px;">{{$log->created_at}}</label></td>
                        <td style="padding-top: 20px;">
                            <div class="btn btn-primary" ><span class="glyphicon glyphicon-refresh" style="color: #ff0000;"></span>&nbsp;Rollback</div>
                        </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
@stop
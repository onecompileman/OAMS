@extends('template')
@section('addons')
<style>
.on{
    background-color: #213978;
}
</style>
<script type="text/javascript">
    $(document).ready(function(){
          $('.nav').children('li').removeClass('on');
          $('.nav').children('li:nth-child(5)').addClass('on');
    });
</script>
@stop
@section('contents')
    <br/><br/>
     <div class="row" style="padding-bottom: 2%;padding-top: 2%;background-color:#3498db; ">
                  <div class="title">
                        <center> <h2 style="color:white;"><b>C O N T A C T  &nbsp;&nbsp; U S</b></h2> </center>
                  </div>
              </div>
               @if(Session::has('success'))
                <div class="alert alert-success">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <h3>{{Session::get('success')}}</h3>
                </div>
               @endif
              <div class="row">
              <br/>
              <div class="col-sm-6 col-sm-offset-1">
              <div class="row">
              <form style="padding: 2%;box-shadow: 0 0 3px 3px rgba(0,0,0,0.3);" class="form-group panel" action="{{route('sendContact')}}" method="post">
              <center><h2>Contact Info</h2></center>
                <hr><br/><br/>

                   <input type="text" class="form-control" name="sender" placeholder="Your Name" value="{{old('sender')}}">
                   <br/>
                      <input type="tel" class="form-control" name="contactno" placeholder="Your Contact No." value="{{old('contactno')}}">
                      <br/>
                      <input type="email" class="form-control" name="email" placeholder="Your Email" value="{{old('email')}}">
                      <br/>
                      <textarea placeholder="Your Message Here.." name="message" rows="10" class="form-control" >{{old('message')}}</textarea>
                      <br/>
                        <div style="display: inline;" class="col-sm-offset-4">
                      <input type="reset" class="btn btn-danger" value="Reset">
                        </div>
                         <div style="display: inline;" class="col-sm-offset-1">
                                              <input type="submit" class="btn btn-primary" value="Send">
                                     </div>
                                     <ul style="list-style: none;">
                                     @if(Session::has('errors'))

                                        @foreach(Session::get('errors') as $err)
                                            <li style="color:red;">{{$err}}</li>
                                        @endforeach
                                     @endif
                                     </ul>
              </form>
              </div>
              </div>
              <div class="col-sm-4 col-sm-offset-1 " style="padding: 2%;">
               <center> <h3><b>Our Contact Information</b></h3></center><br/><br/>
               <center><img src="/sys_files/img/homescreen/contact/nu.jpg" class="img-rounded" style="box-shadow: 0px 0px 4px 4px rgba(0,0,0,0.2);"></center>
                <div class="row">
                <br/>

                    <div class="col-sm-5">
                    <h5><b>Address: </b></h5>
                        <p style="font-family:Courier;font-weight: bold;">551 M.F. Jhocson Street, Sampaloc Manila</p>
                    </div>

                    <div class="col-sm-6">
                          <h5><b>Mobile: </b> 0909101911s</h5>
                              <h5><b>Telephone: </b> 0909101911</h5>
                                  <h5><b>Fax: </b> 0909101911s</h5>
                                      <h5><b>Email: </b> stephen.vinuya@gmail.com</h5>
                    </div>
                </div>
              </div>
              </div>

@stop
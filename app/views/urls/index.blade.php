@extends('layout.master')
@section('content')
<div class="text-center">
  <h1>Url.to</h1>
  <span>Shorten your link</span>
  {{Form::open(['id' => 'url-form'])}}
  <div class="form-group">
    {{Form::label('to', '', ['class' => 'hide'])}}
    {{Form::text('to', '', ['placeholder' => 'your link here', 'class' => 'form-control input-lg'])}}
  </div>
  <!-- {{Form::submit('Shorten!', ['class' => 'btn btn-success btn-lg'])}} -->
  <div id="name">
    <h4>Last {{count($urls)}} URL(s):</h4>
    @foreach($urls as $url)
    <p>
      <a href="{{$url->to}}">http://url.to/{{$url->from}}</a> <small>({{$url->moment}})</small>
    </p>
    @endforeach
  </div>
</div>
@if (null !== Session::get('any'))
<script charset="utf-8">
  $(function(){
    var notification = new NotificationFx({
      message : '<span class="icon icon-megaphone"></span><p>Sorry. Can\'t find url http://url.to/'+{{Session::get('any')}}+'</p>',
      layout : 'bar',
      effect : 'slidetop',
      type : 'error',
      onClose : function() {
        // bttn.disabled = false;
      }
    });
    notification.show();
  })
</script>
@endif
@stop

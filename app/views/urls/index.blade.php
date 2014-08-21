@extends('layout.master')

@section('content')
<div class="text-center">
  <h1><a href="{{url('/')}}">Url.to</a></h1>
  <span>Shorten your link</span>
  {{Form::open(['id' => 'url-form', 'class' => 'simform'])}}
    <div class="form-group simform-inner">
      <ol class="questions">
        <li>
        {{Form::label('to', '', ['class' => 'hide'])}}
        {{Form::text('to', '', ['placeholder' => 'your link here'])}}
        
        </li>
      </ol>
      <button class="submit" type="submit">Send answers</button>
      <div class="controls">
        <button class="next"></button>
        <div class="progress"></div>
        <span class="number">
          <span class="number-current"></span>
          <span class="number-total"></span>
        </span>
        <span class="error-message"></span>
      </div><!-- / controls -->
    </div>
    <span class="final-message"></span>
  {{Form::close()}}
  <!-- {{Form::submit('Shorten!', ['class' => 'btn btn-success btn-lg'])}} -->
  <div class="last-urls">
    <h4>Last <span class="urls-count">{{count($urls)}}</span> URL(s):</h4>
    @foreach($urls as $url)
    <p>
      <a href="{{$url->to}}">http://url.to/{{$url->from}}</a> <small>({{$url->created_at->diffForHumans()}})</small>
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

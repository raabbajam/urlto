<?php

use Illuminate\Support\ServiceProvider;

class momentProviders extends ServiceProvider {
  public function register()
  {
    $this->app->bind('Moment', function ()
    {
      return new Moment();
    })
  }
}

<?php namespace App;

class App extends \Illuminate\Foundation\Application
{
    public function publicPath()
{
    return $this->basePath.DIRECTORY_SEPARATOR.'..';
}
}
<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Failed;
use Illuminate\Http\Request;

class HandleFailedLogin
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle(Failed $event)
    {
        if (!$this->request->is('login') && !$this->request->is('register') && !$this->request->is('password/*')) {
            $this->request->session()->put('url.intended', $this->request->url());
            $this->request->session()->flash('message', 'Please log in to access this page.');
        }
    }
}

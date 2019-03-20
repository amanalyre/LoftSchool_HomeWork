<?php

namespace controllers;

class AdminRegistrationController extends Controller
{
    public function index()
    {
        $this->renderView('adminRegistration');
        $this->status = true;
    }
}
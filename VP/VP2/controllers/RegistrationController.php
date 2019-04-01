<?php

namespace controllers;

class RegistrationController extends Controller
{
    public function index()
    {
        $this->renderView('registration');
        $this->status = true;
    }
}
<?php
class NotFoundController extends Controller
{
    public function index()
    {
        $this->view('error/404', []);
    }
}

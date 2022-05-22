<?php
class HomeController extends Controller
{
    public function index()
    {
        $test = new MVCTest();

        $data = ['test' => $test->test()];

        $this->loadTemplate('home', $data);
    }
}

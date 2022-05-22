<?php
class Controller
{

  public function view($viewName, $viewdata = [])
  {
    extract($viewdata);
    require 'views/' . $viewName . '.php';
  }

  /** 
   * Template view/template.php receives $data and $viewdata
   */
  public function loadTemplate($viewName, $viewdata = [])
  {
    require 'views/template.php';
  }

  public function loadTemplateInView($viewName, $viewdata = [])
  {
    extract($viewdata);
    require 'views/' . $viewName . '.php';
  }
}

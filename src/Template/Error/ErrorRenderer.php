<?
App::uses('ExceptionRenderer', 'Error');

class MyExceptionRenderer extends ExceptionRenderer {

  protected function _outputMessage($template) {
    $this->controller->layout = 'error';
    parent::_outputMessage($template);
  }

}
?>s
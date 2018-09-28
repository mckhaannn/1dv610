<?php

namespace view;

class LayoutView {
  

  private function response() {
    if($this->lc->registerStatus()) {
      return $this->lc->returnToLogin();
    } else {
      return $this->lc->renderResponse();
    }
  }
  
  public function render($isLoggedIn, \controller\LoginController $lc, \view\DateTimeView $dtv) {
    $this->lc = $lc;  
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          ' . $lc->registerLink() . '
          ' . $this->renderIsLoggedIn($isLoggedIn) . '
          <div class="container">
              ' . $this->response() . '
              ' . $dtv->show() . '
          </div>
         </body>
      </html>
    ';
  }
  
  private function renderIsLoggedIn($isLoggedIn) {
    if ($isLoggedIn) {
      return '<h2>Logged in</h2>';
    }
    else {
      return '<h2>Not logged in</h2>';
    }
  }
}

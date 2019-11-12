<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    private $_welcomeMsg = "";

    public function __construct() {
      $this->_welcomeMsg = "==============================================================" .
                           "<br>" .
                           "Clicky Dungeon Microservice - v.1.0" .
                           "<br>" .
                           "Author: Yudiman Kwanmas" .
                           "<br>" .
                           "Last Modified Date: 30/09/2019" .
                           "<br>";
                           

      if(app('db')->connection()->getDatabaseName()) {
        $this->_welcomeMsg .= "Connected to database: ". app('db')->connection()->getDatabaseName();
      } else {
        $this->_welcomeMsg .= "Not connected to a database";
      }                     

      $this->_welcomeMsg .= "<br>" .
                            "==============================================================";
    }

    public function _constructResponse($_payload, $_type) {
      $__response = array( 
        'code' => 200,
        $_type => $_payload
      );

      return $__response;
    }

    public function _returnZeroRow($_type) {
      $__response = array( 
        'code' => 200,
        'type' => $_type,
        'message' => 'zero row returned'
      );

      return $__response;
    }

    public function _throw404Response() {
      $__response = array( 
        'code' => 404,
        'message' => 'not found'
      );

      return $__response;
    }

    public function _showWelcomeMessage() {
      echo $this->_welcomeMsg;
    }

    public static function _showWelcomeMessageForMiddleware() {
      $__welcomeMsg = $this->_welcomeMsg .
                      "<br>" .
                      "Status Code : 401 - Unauthorized";

      return $__welcomeMsg;
    }
}

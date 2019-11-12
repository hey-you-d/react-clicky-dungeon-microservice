<?php
    namespace App\Http\Controllers;

    use App\Enemies;

    class EnemiesController extends Controller {
      private $_dbTableHandler = null;

      public function __construct() {
        parent::__construct();

        $this->_dbTableHandler = new Enemies;
      }

      /************************************************************************
       * Get JSON Response
       ************************************************************************/
      public function _getResponse() {
        // get the property uniqueID from the url attribute ( ?p=<uniqueID> )
        if ( isset($_GET["p"]) ) {
          if ( !is_null($_GET["p"]) || trim($_GET["p"]) !== "" ) {
            if (trim($_GET["p"]) === "all") {
              $__searchResult = $this->_getAllEnemies();
            } else {
              $__searchResult = $this->_getSingleEnemy($_GET["p"]);
            }
          } else {
            return $this->_throw404Response();
          }

          if (count($__searchResult) > 0) {
             $__response = $this->_constructResponse($__searchResult, "enemies");
          } else {
             $__response = $this->_returnZeroRow("enemies");
          }

          return response()->json($__response, $__response['code']);
        } else {
          return $this->_throw404Response();
        }
      }

      // to be called in AreasController
      public function _getDbRow($_id) {
        return $this->_getSingleEnemy($_id);
      }

      /************************************************************************
       * Get SQL Queries
       ************************************************************************/
      private function _getAllEnemies() {
        $_sqlQuery = " SELECT * FROM " . $this->_dbTableHandler->getDbTableName() .
                     " WHERE 1";

        return app('db')->select($_sqlQuery);
      }
      
      private function _getSingleEnemy($_id) {
        $_sqlQuery = " SELECT * FROM " . $this->_dbTableHandler->getDbTableName() .
                     " WHERE id = '" . $_id . "'";

        return app('db')->select($_sqlQuery);
      }
    }

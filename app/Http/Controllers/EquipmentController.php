<?php
    namespace App\Http\Controllers;

    use App\Equipment;

    class EquipmentController extends Controller {
      private $_dbTableHandler = null;

      public function __construct() {
        parent::__construct();

        $this->_dbTableHandler = new Equipment;
      }

      /************************************************************************
       * Get JSON Response
       ************************************************************************/
      public function _getResponse() {
        // get the property uniqueID from the url attribute ( ?p=<uniqueID> )
        if ( isset($_GET["p"]) ) {
          if ( !is_null($_GET["p"]) || trim($_GET["p"]) !== "" ) {
            if (trim($_GET["p"]) === "all") {
              $__searchResult = $this->_getAllEquipment();
            } else {
              $__searchResult = $this->_getSingleEquipment($_GET["p"]);
            }
          } else {
            return $this->_throw404Response();
          }

          if (count($__searchResult) > 0) {
             $__response = $this->_constructResponse($__searchResult, "equipment");
          } else {
             $__response = $this->_returnZeroRow("equipment");
          }

          return response()->json($__response, $__response['code']);
        } else {
          return $this->_throw404Response();
        }
      }

      // to be called in AreasController
      public function _getDbRow($_id) {
        return $this->_getSingleEquipment($_id);
      }

      /************************************************************************
       * Get SQL Queries
       ************************************************************************/
      private function _getAllEquipment() {
        $_sqlQuery = " SELECT * FROM " . $this->_dbTableHandler->getDbTableName() .
                     " WHERE 1";

        return app('db')->select($_sqlQuery);
      }

      private function _getSingleEquipment($_id) {
        $_sqlQuery = " SELECT * FROM " . $this->_dbTableHandler->getDbTableName() .
                     " WHERE id = '" . $_id . "'";

        return app('db')->select($_sqlQuery);
      }
    }

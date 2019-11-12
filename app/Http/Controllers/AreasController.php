<?php
    namespace App\Http\Controllers;

    use App\Areas;
    use App\Http\Controllers\DoorsController;
    use App\Http\Controllers\EnemiesController;
    use App\Http\Controllers\EquipmentController;
    use App\Http\Controllers\ItemsController;

    class AreasController extends Controller {
      private $_dbTableHandler = null;
      private $_doorsController = null;

      public function __construct() {
        parent::__construct();

        $this->_dbTableHandler = new Areas;

        $this->_doorsController = new DoorsController;
        $this->_enemiesController = new EnemiesController;
        $this->_equipmentController = new EquipmentController;
        $this->_itemsController = new ItemsController;
      }

      /************************************************************************
       * Get JSON Response
       ************************************************************************/
      public function _getResponse() {
        // get the property uniqueID from the url attribute ( ?p=<uniqueID> )
        if ( isset($_GET["p"]) ) {
          if ( !is_null($_GET["p"]) || trim($_GET["p"]) !== "" ) {
            if (trim($_GET["p"]) === "all") {
              $__searchResult = $this->_getAllAreas();
            } else {
              $__searchResult = $this->_getSingleArea($_GET["p"]);
            }
          } else {
            return $this->_throw404Response();
          }

          if (count($__searchResult) > 0) {
             $__response = $this->_constructResponse($__searchResult, "areas");
          } else {
             $__response = $this->_returnZeroRow("areas");
          }

          return response()->json($__response, $__response['code']);
        } else {
          return $this->_throw404Response();
        }
      }

      public function _getCustomisedResponse() {
        // get the property uniqueID from the url attribute ( ?p=<uniqueID> )
        if ( isset($_GET["p"]) ) {
          if ( !is_null($_GET["p"]) || trim($_GET["p"]) !== "" ) {
            $__searchResult = $this->_getSingleArea($_GET["p"]);
          } else {
            return $this->_throw404Response();
          }

          if (count($__searchResult) > 0) {                       
            //echo 'enemies<br/><br/>';
            // get the area_enemies' id array - the area_enemies mysql db column is of type JSON
            $__areaEnemiesIdArray = json_decode($__searchResult[0]->area_enemies);
            // get the detail of each enemy in the $__areaEnemiesIdArray & construct the output
            // in nested format
            $__areaEnemiesNestedArrayOutput = [];
            if (count($__areaEnemiesIdArray) > 0) {
              for ($__i=0; $__i<count($__areaEnemiesIdArray); $__i++) {
                array_push(
                  $__areaEnemiesNestedArrayOutput,
                  json_decode(
                    json_encode($this->_enemiesController->_getDbRow($__areaEnemiesIdArray[$__i])[0]), 
                    true
                  )
                );   
              }
            }
            //var_dump($__areaEnemiesNestedArrayOutput);
            //echo '<br/><br/>';

            //echo 'doors<br/><br/>';
            // get the area_doors' id array - the area_doors mysql db column is of type JSON
            $__areaDoorsIdArray = json_decode($__searchResult[0]->area_doors);
            // get the detail of each door in the $__areaDoorsIdArray & construct the output
            // in nested array format
            $__areaDoorsNestedArrayOutput = [];
            if (count($__areaDoorsIdArray) > 0) {
              for ($__i=0; $__i<count($__areaDoorsIdArray); $__i++) {
                array_push(
                  $__areaDoorsNestedArrayOutput,
                  json_decode(
                    json_encode($this->_doorsController->_getDbRow($__areaDoorsIdArray[$__i])[0]), 
                    true
                  )
                );   
              }
            }
            //var_dump($__areaDoorsNestedArrayOutput);
            //echo '<br/><br/>';

            //echo 'equipment<br/><br/>';
            // get the area_equipments' id array - the area_equipments mysql db column is of type JSON
            $__areaEquipmentIdArray = json_decode($__searchResult[0]->area_equipments);
            // get the detail of each equipment in the $__areaEquipmentIdArray & construct the output
            // in nested array format
            $__areaEquipmentNestedArrayOutput = [];
            if (count($__areaEquipmentIdArray) > 0) {
              for ($__i=0; $__i<count($__areaEquipmentIdArray); $__i++) {
                array_push(
                  $__areaEquipmentNestedArrayOutput,
                  json_decode(
                    json_encode($this->_equipmentController->_getDbRow($__areaEquipmentIdArray[$__i])[0]), 
                    true
                  )
                );   
              }
            }
            //var_dump($__areaEquipmentNestedArrayOutput);
            //echo '<br/><br/>';  

            //echo 'items<br/><br/>';
            // get the area_items' id array - the area_items mysql db column is of type JSON
            $__areaItemsIdArray = json_decode($__searchResult[0]->area_items);
            // get the detail of each equipment in the $__areaItemsIdArray & construct the output
            // in nested array format
            $__areaItemsNestedArrayOutput = [];
            if (count($__areaItemsIdArray) > 0) {
              for ($__i=0; $__i<count($__areaItemsIdArray); $__i++) {
                array_push(
                  $__areaItemsNestedArrayOutput,
                  // json_decode : 2nd arg = true -> 1st arg is an array
                  json_decode(
                    json_encode($this->_itemsController->_getDbRow($__areaItemsIdArray[$__i])[0]), 
                    true
                  )
                ); 
              }
            }  
            //var_dump($__areaItemsNestedArrayOutput);
            //echo '<br/><br/>';

            //echo 'Consolidated Response<br/><br/>';
            $__response = 
              array( 
                'code' => 200,
                'area' => array ( 
                  'id' => $__searchResult[0]->id,
                  'nextAreaId' => $__searchResult[0]->next_area_id,
                  'areaMap' => $__searchResult[0]->area_map,
                  'areaEnemies' => $__areaEnemiesNestedArrayOutput,
                  'areaItems' => $__areaItemsNestedArrayOutput,
                  'areaEquipments' => $__areaEquipmentNestedArrayOutput,
                  'areaDoors' => $__areaDoorsNestedArrayOutput
                ) 
              );

            //echo '<br/><br/>';      
          } else {
             $__response = $this->_returnZeroRow("areas");
          }
          
          return response()->json($__response, $__response['code']);
        } else {
          return $this->_throw404Response();
        }
      }

      /************************************************************************
       * Get SQL Queries
       ************************************************************************/
      private function _getAllAreas() {
        $_sqlQuery = " SELECT * FROM " . $this->_dbTableHandler->getDbTableName() .
                     " WHERE 1";

        return app('db')->select($_sqlQuery);
      }
      private function _getSingleArea($_id) {
        $_sqlQuery = " SELECT * FROM " . $this->_dbTableHandler->getDbTableName() .
                     " WHERE id = '" . $_id . "'";

        return app('db')->select($_sqlQuery);
      }
    }

<?php
    namespace App;

    use Illuminate\Database\Eloquent\Model;

    /* Model - Areas */
    class Areas extends Model {
        // DB TABLE NAME
        public $table = 'areas';
        // PK LABEL
        public $primaryKey = 'id';
        // Let eloquent auto-populates the 'created_at' & 'updated_at' columns
        public $timestamps = true;
        const CREATED_AT = 'created_at';
        const UPDATED_AT = 'updated_at';
        protected $fillable = array();

        public function __construct() {
            $this->fillable = array($this->primaryKey, 'next_area_id', 'area_map', 'area_enemies', 'area_items', 'area_equipments', 'area_doors');
        }

        public function getDbTableName() {
            return $this->table;
        }
    }

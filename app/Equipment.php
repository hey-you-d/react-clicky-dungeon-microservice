<?php
    namespace App;

    use Illuminate\Database\Eloquent\Model;

    /* Model - Equipments */
    class Equipment extends Model {
        // DB TABLE NAME
        public $table = 'equipment';
        // PK LABEL
        public $primaryKey = 'id';
        // Let eloquent auto-populates the 'created_at' & 'updated_at' columns
        public $timestamps = true;
        const CREATED_AT = 'created_at';
        const UPDATED_AT = 'updated_at';
        protected $fillable = array();

        public function __construct() {
            $this->fillable = array($this->primaryKey, 'name', 'type', 'img', 'points');
        }

        public function getDbTableName() {
            return $this->table;
        }
    }

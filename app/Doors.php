<?php
    namespace App;

    use Illuminate\Database\Eloquent\Model;

    /* Model - Doors */
    class Doors extends Model {
        // DB TABLE NAME
        public $table = 'doors';
        // PK LABEL
        public $primaryKey = 'db_id';
        // Let eloquent auto-populates the 'created_at' & 'updated_at' columns
        public $timestamps = true;
        const CREATED_AT = 'created_at';
        const UPDATED_AT = 'updated_at';
        protected $fillable = array();

        public function __construct() {
            $this->fillable = array($this->primaryKey, 'id', 'img');
        }

        public function getDbTableName() {
            return $this->table;
        }
    }

<?php
    namespace App;

    use Illuminate\Database\Eloquent\Model;

    /* Model - Enemies */
    class Enemies extends Model {
        // DB TABLE NAME
        public $table = 'enemies';
        // PK LABEL
        public $primaryKey = 'id';
        // Let eloquent auto-populates the 'created_at' & 'updated_at' columns
        public $timestamps = true;
        const CREATED_AT = 'created_at';
        const UPDATED_AT = 'updated_at';
        protected $fillable = array();

        public function __construct() {
            $this->fillable = array($this->primaryKey, 'name', 'img', 'level', 'hp', 'attack_range', 'loot_options', 'gained_exp');
        }

        public function getDbTableName() {
            return $this->table;
        }
    }

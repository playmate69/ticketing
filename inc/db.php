<?php

namespace app;

class DB extends Connection {

    private static $DB;
    private static $Response;
    private $conn;
    private $sql;
    private $types;
    private $binds;
    private $status;
    private $rows;
    private $result;
    private $error;
    private $queries = [];
    
    private function __construct($services) {
        foreach($services as $key => $service) self::${$key} = $service;
    }

    /**
     * Create new DB object
     */
    public static function create(array $services = []) {
        isset(self::$DB) ?: self::$DB = new DB($services);
        return self::$DB;
    }

    /**
    * Return param types string
    */
    private static function paramTypes(array $params = []) {
        $types = "";
        foreach($params as $param) {        
            if(is_int($param)) {
                $types .= 'i';              //integer
            } elseif (is_float($param)) {
                $types .= 'd';              //double
            } elseif (is_string($param)) {
                $types .= 's';              //string
            } else {
                $types .= 'b';              //blob and unknown
            }
        }
        return $types;
    }

    public function queries( int $index = 0) {
        return isset( $this->queries[ $index - 1 ] ) ? $this->queries[ $index - 1 ] : false;
    }

    /**
    * Check if given array is associative or not
    */
    public static function isAssoc(array $arr){
        if (array() === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    /**
    * Query
    */
    public function query(array $args) 
    {

        $required = ["sql"];
        
        foreach($required as $key) if(!isset($args[$key])) self::$Response::http([
            "code" => 500,
            "response" => [
                "status" => 500,
                "error" => "Missing required query fields"
            ]
        ], true);

        $this->sql    = $args["sql"];
        $this->types  = isset($args["binds"]) ? self::paramTypes($args["binds"]) : false;
        $this->binds  = isset($args["binds"]) ? $args["binds"] : [];
        $this->status = false;
        $this->rows   = 0;
        $this->result = [];
        $this->error  = false;

        try {

            $this->conn = isset($args["conn"]) ? $args["conn"] : parent::open();

            parent::ping($this->conn);

            $stmt = $this->conn->prepare($this->sql);
            $stmt->execute($this->binds);

            if(isset($args["options"]["return"]) && $args["options"]["return"]) {
                $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                $this->rows = count($data);
                if($data) {
                    $this->result = (isset($args["options"]["array"]) && $args["options"]["array"]) ? $data : $data[0];

                    if( !self::isAssoc( $this->result ) ) {                      
                        foreach( $this->result as $i => $obj ) {
                            foreach( $obj as $key => $value ) {
                                if( $value === "true" ) {
                                    $this->result[$i][$key] = true;
                                } elseif ( $value === "false") {
                                    $this->result[$i][$key] = false;
                                }
                            }
                        }
                    } else {
                        foreach( $this->result as $key => $value ) {
                            if( $value === "true" ) {
                                $this->result[$key] = true;
                            } elseif ( $value === "false") {
                                $this->result[$key] = false;
                            }
                        }
                    }
                }
            }

            if(isset($args["options"]["close"]) && $args["options"]["close"]) {
                parent::close($this->conn);
                $this->conn = false;
            }

            array_push($this->queries, array(
                "status" => $this->status,
                "conn"   => $this->conn,
                "rows"   => $this->rows,
                "result" => $this->result
            ));

            return self::$DB;
        } catch( \PDOException $e) {
            self::$Response::http([
                "code" => 500,
                "response" => [
                    "status" => 500,
                    "error" => $e->getMessage() 
                ]
            ], true);
        }
    }

}
<?php

namespace app;

class DB {

    private $host = 'localhost';
    private $user = 'user';
    private $pass = 'user';
    private $db   = "tickets";

    private $conn;
    private $sql;
    private $types;
    private $binds;
    private $status;
    private $rows;
    private $result;
    private $error;
    private $queries = [];
    
    private function __construct() {}

    private static function open() {
        $conn = new \PDO("mysql:host=".$this->host.";dbname=".$this->db, $this->user, $this->pass);
        return !$conn ? new \Exception([
            'code' => 500,
            'error' => 'Database unreachable'
        ]) : $conn;
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
    public function go(string $sql, array $options) 
    {

        try {
            $this->conn = isset($options["conn"]) ? $options["conn"] : self::open();
        } catch (\Exception $e) {
            echo json_encode($e) && die();
        }



        $this->sql    = $sql;
        $this->types  = isset($options["binds"]) ? self::paramTypes($options["binds"]) : false;
        $this->binds  = isset($options["binds"]) ? $options["binds"] : [];
        $this->status = false;
        $this->rows   = 0;
        $this->result = false;
        $this->error  = false;

        try {

            $stmt = $this->conn->prepare($this->sql);
            $stmt->execute($this->binds);

            if(isset($options["options"]["return"]) && $options["options"]["return"]) {
                $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                $this->rows = count($data);
                if($data) {
                    $this->result = (isset($options["options"]["array"]) && $options["options"]["array"]) ? $data : $data[0];

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

            if(isset($options["options"]["close"]) && $options["options"]["close"]) {
                $this->conn = null;
            }

            array_push($this->queries, array(
                "status" => $this->status,
                "conn"   => $this->conn,
                "rows"   => $this->rows,
                "result" => $this->result
            ));

            return $this;
        } catch( \PDOException $e) {
            throw new \Exception( $e->getMessage() );
        }
    }

}
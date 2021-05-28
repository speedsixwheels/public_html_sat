<?php


class dbmysqli{
    var $mysqli,$error,$numrows,$insertid;
    function __construct($conn) {
        if(isset($conn['port'])) {
            $this->mysqli = @new mysqli($conn['servername'] . ':' . $conn[ 'port'], $conn['username'], $conn['password'], $conn['database']);
        }
        else{
            $this->mysqli = @new mysqli($conn['servername'], $conn['username'], $conn['password'], $conn['database']);
        }

        if ($this->mysqli->connect_errno) {
            $this->pre("Connection Error [" . $this->mysqli->connect_errno . "]: "  . $conn['database'] );
            die();
        }
    }


    function query($sql){
        $res = @$this->mysqli->query($sql);
        if (!$res) {
            $this->error = $this->mysqli->error;
            $this->errorno = $this->mysqli->errno;

        }
        $this->numrows = $this->mysqli->affected_rows;
        $this->insertid = $this->mysqli->insert_id;
        $this->query = $sql;
    }

    function get_results($sql){
        $res = @$this->mysqli->query($sql);

        if (!$res) {
            $this->error = $this->mysqli->error;
            $this->errorno = $this->mysqli->errno;
        }

        $this->numrows = $res->num_rows;
        $this->numrows = $this->mysqli->affected_rows;

        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $rows[] = $row;
            }
            return $this->utf8_array_converter($rows);
        }
    }

    function get_results_by_key($sql,$clave){


        $res = @$this->mysqli->query($sql);

        if (!$res) {
            $this->error = $this->mysqli->error;
        }

        $this->numrows = $res->num_rows;

        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $rows[$row[$clave]] = $row;
            }
            return $this->utf8_array_converter($rows);
        }
    }

    public function getRows($table,$conditions = array()){
        $sql = 'SELECT ';
        $sql .= array_key_exists("select",$conditions)?$conditions['select']:'*';
        $sql .= ' FROM '.$table;
        if(array_key_exists("where",$conditions)){
            $sql .= ' WHERE ';
            $i = 0;
            foreach($conditions['where'] as $key => $value){
                $pre = ($i > 0)?' AND ':'';
                $sql .= $pre.$key." = '".$value."'";
                $i++;
            }
        }

        if(array_key_exists("order_by",$conditions)){
            $sql .= ' ORDER BY '.$conditions['order_by'];
        }

        if(array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
            $sql .= ' LIMIT '.$conditions['start'].','.$conditions['limit'];
        }elseif(!array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
            $sql .= ' LIMIT '.$conditions['limit'];
        }

        $result = $this->mysqli->query($sql);


        $this->query = $sql;



        if(array_key_exists("return_type",$conditions) && $conditions['return_type'] != 'all'){
            switch($conditions['return_type']){
                case 'count':
                    $data = $this->mysqli->affected_rows;
                    break;
                case 'single':
                    $data = $result->fetch_assoc();

                    break;
                default:
                    $data = '';
            }
        }else{
            if($this->mysqli->affected_rows > 0){
                while($row = $result->fetch_assoc()){
                    $data[] = $row;
                }
            }
        }

        $this->numrows = $this->mysqli->affected_rows;
        return !empty($data)?$data:false;
    }

    function insert($table,$data){
        if(!empty($data) && is_array($data)){
            $columns = '';
            $values  = '';
            $i = 0;

            foreach($data as $key=>$val){
                $pre = ($i > 0)?', ':'';
                $columns .= $pre.$key;
                $values  .= $pre."'".$val."'";
                $i++;
            }
            $query = "INSERT INTO ".$table." (".$columns.") VALUES (".$values.")";
            $this->query = $query;

            $insert = $this->mysqli->query($query);
            $this->numrows = $this->mysqli->affected_rows;

            return $insert?$this->insert_id:false;
        }else{
            return false;
        }
    }


    function update($table,$data,$conditions){
        if(!empty($data) && is_array($data)){
            $colvalSet = '';
            $whereSql = '';
            $i = 0;

            foreach($data as $key=>$val){
                $pre = ($i > 0)?', ':'';
                $colvalSet .= $pre.$key."='".$val."'";
                $i++;
            }
            if(!empty($conditions)&& is_array($conditions)){
                $whereSql .= ' WHERE ';
                $i = 0;
                foreach($conditions as $key => $value){
                    $pre = ($i > 0)?' AND ':'';
                    $whereSql .= $pre.$key." = '".$value."'";
                    $i++;
                }
            }
            $query = "UPDATE ".$table." SET ".$colvalSet.$whereSql;
            $this->query = $query;
            $update = $this->mysqli->query($query);
            $this->numrows = $this->mysqli->affected_rows;

            return $update?$this->affected_rows:false;
        }else{
            return false;
        }
    }


    function delete($table,$conditions){
        $whereSql = '';
        if(!empty($conditions)&& is_array($conditions)){
            $whereSql .= ' WHERE ';
            $i = 0;
            foreach($conditions as $key => $value){
                $pre = ($i > 0)?' AND ':'';
                $whereSql .= $pre.$key." = '".$value."'";
                $i++;
            }
        }
        $query = "DELETE FROM ".$table.$whereSql;
        $delete = $this->mysqli->query($query);
        $this->numrows = $this->mysqli->affected_rows;

        return $delete?true:false;
    }



    function get_numrows(){
        return $this->numrows;
    }

    function get_error(){
        echo $this->error;
    }

    function get_errorno(){
        $error = explode(" ",$this->errorno);
        echo $error[1];
    }

    function  get_last_id(){
        return $this->insertid;
    }


    function table_exists($table){
        $res = @$this->mysqli->query("SELECT 1 FROM $table");
        if(isset($res->num_rows)) {
            return $res->num_rows > 0 ? true : false;
        } else return false;
    }

    function utf8_encode($item){
        $item = utf8_encode($item);
        return $item;
    }

    function utf8_decode($item){
        $item = utf8_decode($item);
        return $item;
    }

    function utf8_array_converter($array){
        array_walk_recursive($array, function(&$item, $key){
            if(!mb_detect_encoding($item, 'utf-8', true)){
                $item = utf8_encode($item);
            }
        });

        return $array;
    }


    /*
    function escape_params($params){
        $items = array();
        foreach($params as $key=>$value){
            $items[$key] = addslashes($value);
        }
        return $items;
    }*/

    function real_escape_string($item){
        return $this->mysqli->real_escape_string($item);
    }



    function close(){
        mysqli_close($this->mysqli);
    }


    function pre($item){
        echo "<pre>";
        print_r(($item));
        echo "</pre>";
    }
}
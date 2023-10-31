<?php

/*
 * dbconnect method
 * connect to database using PDO
 * @return $con
 */
function dbconnect()
{
    global $config;
    $con = new PDO("mysql:host=".$config['database']['host'].";dbname=".$config['database']['dbname']."", $config['database']['username'], $config['database']['password']);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $con;
}

/*
 *  dbcheck method
 *  check data from table
 *  @param string $table, array $condition
 *  @return bool $count
 */
function dbcheck($table, $condition = [])
{    
    $cond = '';
    
    if (!empty($condition)) {
        $i = 1;
        
        foreach ($condition as $key => $value) {
            if ($i == 1) {
                $cond .= $key." = ".dbconnect()->quote($value); 
            } else {
                $cond .= " AND ".$key." = ".dbconnect()->quote($value);
            }
            
            $i++;
        }
    }
    
    $check = dbconnect()->prepare("SELECT COUNT(*) FROM ".$table." WHERE ".$cond);
    $check->execute();
    $count = $check->fetchColumn();
    
    return $count;
}

/*
 *  dbget method
 *  get all data from table
 *  @param string $table, array $clause, array $condition
 *  @return array $result
 */
function dbget($table, $clause = [], $condition = [])
{
    $cond = '';
    $query = "SELECT * FROM ".$table;
    
    if (array_key_exists('sort', $clause) && array_key_exists('order', $clause)) {
        $query = "SELECT * FROM ".$table." ORDER BY ".$clause['sort']." ".$clause['order'];
    }    
    
    if (!empty($condition)) {
        $i = 1;
        
        foreach ($condition as $c) {
            if ($i == 1) {
                $cond .= $c; 
            } else {
                $cond .= " AND ".$c;
            }
            
            $i++;
        }
        
        $query = "SELECT * FROM ".$table." WHERE ".$cond;
        
        if (array_key_exists('sort', $clause) && array_key_exists('order', $clause)) {
            $query = "SELECT * FROM ".$table." WHERE ".$cond." ORDER BY ".$clause['sort']." ".$clause['order'];
        }
    }
    
    if (array_key_exists('limit', $clause)) {
        if (is_numeric($clause['limit'])) {
            $query .= " LIMIT ".$clause['limit'];
        }
    }
    
    $data = dbconnect()->prepare($query);
    $data->execute();
    
    $data_temp = [];
    
    while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
        $data_temp[] = $row;
    }
    
    $result = $data_temp;
    
    /* if (count($data_temp) == 1) {
        $single_data = [];
        
        foreach($data_temp as $value) {
            $single_data += $value;
        }
        
        $result = $single_data;
    } */
    
    return $result;
}

/*
 *  dbinsert method
 *  insert data to table
 *  @param string $table, array $data
 *  @return bool $inserted
 */
function dbinsert($table, $data)
{
    $data_temp = '';
    $inserted = 0;
    
    if (!empty($data)) {
        $i = 1;
        
        foreach ($data as $key => $value) {
            if ($i == 1) {
                $data_temp .= $key." = ".dbconnect()->quote($value);
            } else {
                $data_temp .= ", ".$key." = ".dbconnect()->quote($value);
            }
            
            $i++;
        }
    }

    if (!empty($data_temp)) {
        $query = dbconnect()->prepare("INSERT INTO ".$table." SET ".$data_temp);
        $query->execute();
        $inserted = $query->rowCount();
    }
    
    return $inserted;
}

/*
 *  dbinsertMany method
 *  insert data to table
 *  @param string $table, array $data
 *  @return bool $inserted
 */
function dbinsertMany($table, $column, $data)
{
    $column_temp = '';
    $data_temp = '';
    $inserted = 0;
    
    if (!empty($column)) {
        $i = 1;
        $column_temp .= '(';
        
        foreach ($column as $key => $value) {            
            if ($i == 1) {
                $column_temp .= $value;
            } else {
                $column_temp .= ', '.$value;
            }
            
            $i++;
        }
        
        $column_temp .= ')';
    }
    
    if (!empty($data)) {
        $i = 1;
        $total = count($data);
        
        foreach ($data as $key => $value) {                
            $data_temp .= '(';
            
            foreach ($value as $key => $index) {
                if ($key == max(array_keys($value))) {
                    $data_temp .= "'".$index."'";
                } else {
                    $data_temp .= "'".$index."', ";
                }
            }
            
            $data_temp .= ')';

            if ($total > $i) {
                $data_temp .= ', ';
            }
            
            $i++;
        }
    }
    
    if (!empty($column_temp) && !empty($data_temp)) {
        $query = dbconnect()->prepare("INSERT INTO ".$table." ".$column_temp." VALUES ".$data_temp);
        $query->execute();
        $inserted = $query->rowCount();
    }
    
    return $inserted;
}

/*
 *  dbupdate method
 *  update data to table
 *  @param string $table, array $condition, array $data
 *  @return bool $updated
 */
function dbupdate($table, $condition, $data)
{
    $cond = '';
    $data_temp = '';
    $updated = 0;
    
    if (!empty($condition)) {
        $i = 1;
        
        foreach ($condition as $key => $value) {
            if ($i == 1) {
                $cond .= $key." = ".dbconnect()->quote($value); 
            } else {
                $cond .= " AND ".$key." = ".dbconnect()->quote($value);
            }
            
            $i++;
        }
    }
    
    if (!empty($data)) {
        $i = 1;
        
        foreach ($data as $key => $value) {
            if ($i == 1) {
                if ($value == '') {
                    $data_temp .= $key." = 'NULL'";
                } else {
                    $data_temp .= $key." = ".dbconnect()->quote($value); 
                }
            } else {
                if ($value == '') {
                    $data_temp .= ", ".$key." = 'NULL'";
                } else {
                    $data_temp .= ", ".$key." = ".dbconnect()->quote($value);
                }
            }
            
            $i++;
        }
    }

    if (!empty($data_temp) && !empty($cond)) {
        $query = dbconnect()->prepare("UPDATE ".$table." SET ".$data_temp." WHERE ".$cond);
        
        if ($query->execute()) {
            $updated = 1;
        }
        
        //$updated = $query->execute();
    }

    return $updated;
}

/*
 *  dbdelete method
 *  delete data from table
 *  @param string $table, array $condition
 *  @return bool $deleted
 */
function dbdelete($table, $condition)
{
    $cond = '';
    
    if (!empty($condition)) {
        $i = 1;
        
        foreach ($condition as $key => $value) {
            if ($i == 1) {
                $cond .= $key." = ".dbconnect()->quote($value); 
            } else {
                $cond .= " AND ".$key." = ".dbconnect()->quote($value);
            }
            
            $i++;
        }
    }

    $query = dbconnect()->prepare("DELETE FROM ".$table." WHERE ".$cond);
    $query->execute();
    
    $deleted = $query->rowCount();

    return $deleted;
}

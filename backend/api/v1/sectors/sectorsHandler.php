<?php

    include_once '../configuracion.php';
    
/*!
 * \brief      Handler for sectors.
 * \details    It has every function to interact with the sectors in the database (Create, read, update, delete)
 * \param      $id       (INT)    1 unique id for each sector
 * \param      $sectorsName       (VARCHAR)   Sectors being offered (gastronomics, cloth, etc)
 * \param      $moreUsed       (INT)   How many times where used (for statistics)
 */
class sectors
{
    
/*!
* \brief    PDO instance for the database
*/
    private $base;


    /*!
* \brief    (INT) 1 unique id for each sector
*/
    private $id;

/*!
* \brief    (VARCHAR)Sectors being offered (gastronomics, cloth, etc)
*/
    private $sectorsName;

/*!
* \brief    (INT)How many times where used (for statistics)
*/
    private $moreUsed;


/*!
* \brief    Sets id for the caller instance.
* \details  The value received as a param is added to the id property of the instance of this class.
* \param $var    (INT) id I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_id($var) {
        $success=true;
        $this->id=$var;
        return $success;
    }



/*!
* \brief    Sets sectorsName for the caller instance.
* \details  The value received as a param is added to the sectorsName property of the instance of this class.
* \param $var    (VARCHAR) sectorsName I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_sectorsName($var) {
        $success=true;
        $this->sectorsName=$var;
        return $success;
    }



/*!
* \brief    Sets moreUsed for the caller instance.
* \details  The value received as a param is added to the moreUsed property of the instance of this class.
* \param $var    (INT) moreUsed I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_moreUsed($var) {
        $success=true;
        $this->moreUsed=$var;
        return $success;
    }



/*!
* \brief    Gets id for the caller instance.
* \details  The id property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->id  (INT) returns the id already set in the instance of this class.
*/
    public function get_id() {
        return($this->id);
    }



/*!
* \brief    Gets sectorsName for the caller instance.
* \details  The sectorsName property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->sectorsName  (VARCHAR) returns the sectorsName already set in the instance of this class.
*/
    public function get_sectorsName() {
        return($this->sectorsName);
    }



/*!
* \brief    Gets moreUsed for the caller instance.
* \details  The moreUsed property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->moreUsed  (INT) returns the moreUsed already set in the instance of this class.
*/
    public function get_moreUsed() {
        return($this->moreUsed);
    }



/*!
* \brief    Constructor function.
* \details  Turns on the Database and connect it.
* \param    (void) non param needed.
* \return   error  (void) Nothing is return really but if there is an error a message will be printed
*/
    public function __construct() {
        try
        {
            $this->base = new PDO('mysql:host=localhost; dbname='.DBNAME,DBUSER,DBPASSWD);
            $this->base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->base->exec('SET CHARACTER SET utf8');
        }
        catch (Exception $e) 
        {
            $success['success'] = false;
            $success['msg'] = $e->getMessage();
            echo json_encode($success);
        }
    }



/*!
* \brief    Add new data to the table.
* \details  Using PDO, htmlentities and addslashes, we insert the data contained in the instance of the callee class.
* \param    (void) non param needed.
* \return   $success  (bool) true if it has added the value, false in any other case.
*/
    public function insert() {
        //SQL query for insertion of the data saved in this instance
        $query='insert into sectors (id,sectorsName,moreUsed) values (?,?,?)';
        $result= $this->base->prepare($query);

       $this->id =       htmlentities(addslashes($this->id));
       $this->sectorsName =       htmlentities(addslashes($this->sectorsName));
       $this->moreUsed =       htmlentities(addslashes($this->moreUsed));

        $success = $result->execute(array($this->id,$this->sectorsName,$this->moreUsed)); 

        $result ->closeCursor();
            
        // I send success to handle mistakes
        return $success;
    
    }
    


/*!
* \brief    Update all column features by id.
* \details  Using PDO, htmlentities and addslashes, we update the data contained in the instance of the callee class.
* \param $id    identifier used to find rows to change.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateAllById($Id) {
        //SQL query for updating
        $query='update sectors set sectorsName=?, moreUsed=? where id=?';
        $result= $this->base->prepare($query);

       $this->sectorsName =       htmlentities(addslashes($this->sectorsName));
       $this->moreUsed =       htmlentities(addslashes($this->moreUsed));

        $success = $result->execute(array($this->sectorsName,$this->moreUsed, $this->id)); 

        $result ->closeCursor();
            
        // I send success to handle mistakes
        return $success;
    
    }
    


/*!
* \brief    Update sectorsName by id.
* \details  Using PDO, htmlentities and addslashes, we update the sectorsName contained in the instance of the callee class.
* \param $id    identifier of the table we want to change sectorsName.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateSectorsNameById($id) {
        //SQL query for updating
        $query='update sectors set sectorsName=? where id=?'; 

        $resultado= $this->base->prepare($query);
        $this->sectorsName =          htmlentities(addslashes($this->sectorsName));
        $this->id =                   htmlentities(addslashes($id));
        
        $success = $resultado->execute(array($this->sectorsName, $this->id));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Update moreUsed by id.
* \details  Using PDO, htmlentities and addslashes, we update the moreUsed contained in the instance of the callee class.
* \param $id    identifier of the table we want to change moreUsed.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateMoreUsedById($id) {
        //SQL query for updating
        $query='update sectors set moreUsed=? where id=?'; 

        $resultado= $this->base->prepare($query);
        $this->moreUsed =          htmlentities(addslashes($this->moreUsed));
        $this->id =                   htmlentities(addslashes($id));
        
        $success = $resultado->execute(array($this->moreUsed, $this->id));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Update moreUsed by sectorsName.
* \details  Using PDO, htmlentities and addslashes, we update the moreUsed contained in the instance of the callee class.
* \param $sectorsName    identifier of the table we want to change moreUsed.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateMoreUsedBySectorsName($sectorsName) {
        //SQL query for updating
        $query='update sectors set moreUsed=? where sectorsName=?'; 

        $resultado= $this->base->prepare($query);
        $this->moreUsed =          htmlentities(addslashes($this->moreUsed));
        $this->sectorsName =                   htmlentities(addslashes($sectorsName));
        
        $success = $resultado->execute(array($this->moreUsed, $this->sectorsName));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Gets all the rows from the database 
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \return   $row  (array) all pairs of -id-sectorsName-moreUsed in the database.
*/    
    public function readAll() {
        $query='select * from sectors where 1';
        $result= $this->base->prepare($query);
        
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$sectors) {
                $sectors['id'] = stripslashes(html_entity_decode($sectors['id'])); 
                $sectors['sectorsName'] = stripslashes(html_entity_decode($sectors['sectorsName'])); 
                $sectors['moreUsed'] = stripslashes(html_entity_decode($sectors['moreUsed'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where id equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    id.
* \return   $row  (array) all pairs of -id-sectorsName-moreUsed in the database.
*/    
    public function readId($id) {
        $query='select * from sectors where id=:id';
        $result= $this->base->prepare($query);
        
        $id=htmlentities(addslashes($id));
        $result->BindValue(':id',$id);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$sectors) {
                $sectors['id'] = stripslashes(html_entity_decode($sectors['id'])); 
                $sectors['sectorsName'] = stripslashes(html_entity_decode($sectors['sectorsName'])); 
                $sectors['moreUsed'] = stripslashes(html_entity_decode($sectors['moreUsed'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where sectorsName equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    sectorsName.
* \return   $row  (array) all pairs of -id-sectorsName-moreUsed in the database.
*/    
    public function readSectorsName($sectorsName) {
        $query='select * from sectors where sectorsName=:sectorsName';
        $result= $this->base->prepare($query);
        
        $sectorsName=htmlentities(addslashes($sectorsName));
        $result->BindValue(':sectorsName',$sectorsName);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$sectors) {
                $sectors['id'] = stripslashes(html_entity_decode($sectors['id'])); 
                $sectors['sectorsName'] = stripslashes(html_entity_decode($sectors['sectorsName'])); 
                $sectors['moreUsed'] = stripslashes(html_entity_decode($sectors['moreUsed'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where moreUsed equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    moreUsed.
* \return   $row  (array) all pairs of -id-sectorsName-moreUsed in the database.
*/    
    public function readMoreUsed($moreUsed) {
        $query='select * from sectors where moreUsed=:moreUsed';
        $result= $this->base->prepare($query);
        
        $moreUsed=htmlentities(addslashes($moreUsed));
        $result->BindValue(':moreUsed',$moreUsed);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$sectors) {
                $sectors['id'] = stripslashes(html_entity_decode($sectors['id'])); 
                $sectors['sectorsName'] = stripslashes(html_entity_decode($sectors['sectorsName'])); 
                $sectors['moreUsed'] = stripslashes(html_entity_decode($sectors['moreUsed'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Deletes all rows in the database
* \details  By sql query using PDO, we delete all.
* \param all    Identifier of what we want to erase from the database.
* \return   $success  (bool) true if it has deleted the row, false in any other case.
*/
    public function deleteAll() {
        $query='delete from sectors where 1';
        $result= $this->base->prepare($query);
        $success = $result->execute();
        $result ->closeCursor();
        return $success;
    }



/*!
* \brief    Deletes rows in the database by id
* \details  By sql query using PDO, we delete all the results where the id matches.
* \param id    Identifier of what we want to erase from the database.
* \return   $success  (bool) true if it has deleted the row, false in any other case.
*/
    public function deleteById($id) {
        $query='delete from sectors where id=:id';
        $result= $this->base->prepare($query);
        $id=htmlentities(addslashes($id));
        $result->BindValue(':id',$id);

        $success = $result->execute();
        $result ->closeCursor();
        return $success;
    }



/*!
 * \brief    Login verifier.
 * \details  Send sectorsName and moreUsed to the database and verify if the sectorsName exists. If so, check if the moreUsed matches. 
 * \param    $sectorsName The sectorsName to login.
 * \param    $moreUsed (string) The password of the user to login.
 * \return   False (bool) Returns false if the name does not exist or password does not match.
 * \return   $row (array) Returns the row if the password matches.
*/
    public function login($sectorsName, $moreUsed)
    {
        $query = 'select * from sectors where sectorsName=?';
        $result = $this->base->prepare($query);
        $result->execute(array($sectorsName));
        $row = $result->fetchAll(PDO::FETCH_ASSOC);
        $result->closeCursor();
        if ($row) {
            $verifypass = password_verify($moreUsed, $row[0]['moreUsed']);
            if ($verifypass) {
                return $row[0];
            } else {
                return false;
            }
        }
        return $row;
    } 


    
}

?>
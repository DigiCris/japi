
<?php

include_once 'sectorsHandler.php';

/*!
* \brief      Create a new sectors row.
* \details    Insert a new sectors an it's information in the database. Some fields might encrypt.
*\param      $id (INT)  1 unique id for each sector
*\param      $sectorsName (VARCHAR) Sectors being offered (gastronomics, cloth, etc)
*\param      $moreUsed (INT) How many times where used (for statistics) 
* \return $success['response'] (array) An array with the established sectors fields.
** ['id'] (INT) The established id.
** ['sectorsName'] (VARCHAR) The established sectorsName.
** ['moreUsed'] (INT) The established moreUsed.
* \return $success['success'] (bool) Returns true if the new sectors row was inserted, false if not.
* \return $success['msg'] (string) Returns a message explaining the status of the execution.
** \return • 'sectors uploaded' -> When the execution was succesful, the new sectors row was uploaded in the database.
** \return • 'This sectors could not be uploaded. Try again later.' -> When the insert failed, it could be because it couldn't connect to the database.
*/
function setAll($id=null, $sectorsName=null, $moreUsed=null) {
    $register = new sectors();

        $register->set_id($id);
        $register->set_sectorsName($sectorsName);
        $register->set_moreUsed($moreUsed);
        $success['response'] = $register->insert();
        if($success['response'] == false) {
            $success['success'] = false;
            $success['msg'] = 'This sectors could not be uploaded. Try again later.';
        }else {
            // I prepare the inserted data (encrypted) to show
            $data = array ( 
              'id' => $register->get_id(),
              'sectorsName' => $register->get_sectorsName(),
              'moreUsed' => $register->get_moreUsed()
            );
            $success['response'] = $data;
            $success['success'] = true;
            $success['msg'] = 'sectors uploaded';
        }
    
    return $success;
}

?>

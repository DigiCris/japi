
<?php

include_once 'sectorsHandler.php';
/*!
* \brief       Read all that matches id in sectors
* \details     Search in the database sectors that matches id and returns them in an array.
* \param       (INT) id searching table by matching it.
* \return     $success['response'][N] (array) Returns the sectorss, where 'N' that indicates the position of the array to which the information about each sectors belongs.
     ** ['id']       (INT)    1 unique id for each sector
     ** ['sectorsName']       (VARCHAR)   Sectors being offered (gastronomics, cloth, etc)
     ** ['moreUsed']       (INT)   How many times where used (for statistics)
* \return      $success['success'] (bool) Returns true if the request was succesful, false if not.
* \return      $success['msg'] (string) Returns a message explaining the status of the execution.
* * \return • 'sectorss fetched.' -> When was able to read all the sectorss in the database.
* * \return • 'We could not fetch the sectorss.' -> When there are no sectorss loaded in the database or it could not be connected to it.
*/
function getById($id) {
    $register = new sectors();
    $success['response'] = $register->readId($id);

    if($success['response']) {
        $success['success'] = true;
        $success['msg'] = 'sectorss fetched.';
    }else {
        $success['success'] = false;
        $success['msg'] = 'We could not fetch the sectorss.';
    }
    return $success;
}
    
?>
    
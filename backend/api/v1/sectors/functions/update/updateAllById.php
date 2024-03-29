<?php

include_once 'sectorsHandler.php';

/*!
* \brief        Update all row information.
* \details      Update the information of sectors table, searching it by id.
* \param      $id       (INT)    Identifier of the sectors to update.  1 unique id for each sector
* \param      $sectorsName     (VARCHAR)  sectorsName to update. Sectors being offered (gastronomics, cloth, etc)
* \param      $moreUsed     (INT)  moreUsed to update. How many times where used (for statistics)
* \return      $success['response'] (array) An array with the updated fields of the sectors.
     ** ['id']        (INT)   autoincremental .
     ** ['sectorsName']        (VARCHAR)   .
     ** ['moreUsed']        (INT)   .
* \return      $success['success'] (bool) Returns true if the sectors was updated, false if not.
* \return      $success['msg'] (string) Returns a message explaining the status of the execution.
    * \return •    'sectors updated' -> When the execution was succesful, the sectors has been updated.
    * \return •    'We could not update. Try again later.' -> When the update failed, it could be because it couldn't connect to the database.
    * \return •    'We could not find the id you are trying to update.' -> When the sectors's field id does not exist or it is not found in the database.
*/

function updateAllById($id, $sectorsName, $moreUsed) {
    $register = new sectors();

    $success['response'] = $register->readId($id);

    if($success['response']['id'] == $id) {
        
        $register->set_id($id);
        $register->set_sectorsName($sectorsName);
        $register->set_moreUsed($moreUsed);

        $success['response'] = $register->updateAllById($id);
        $success['response'] = $register->readId($id);
        if($success['response']['sectorsName'] == $sectorsName and $success['response']['id'] == $id) {
            // I prepare the inserted data (encrypted) to show
            $data = array (
               'id' => $id,
               'sectorsName' => $register->get_sectorsName(),
               'moreUsed' => $register->get_moreUsed()
            );
            $success['response'] = $data;
            $success['success'] = true;
            $success['msg'] = 'sectors updated';
        }else {
            $success['success'] = false;
            $success['msg'] = 'We could not update. Try again later.';
        }
    }else {
        $success['success'] = false;
        $success['msg'] = 'We could not find the id you are trying to update.';
    }
    return $success;
}
    
?>    
    
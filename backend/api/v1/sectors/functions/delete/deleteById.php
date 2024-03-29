
<?php

include_once 'sectorsHandler.php';

/*!
* \brief       delete all that matches id in sectors
* \details     Search in the database sectors that matches id and delete it if it exists.
* \param       (INT) id The identifier of the row/rows in the sectors table to delete.
* \return    $success['response'] (bool) Returns true if the row/rows was/were deleted, false if not.
* \return    $success['success'] (bool) Returns true if the request was succesful, false if not.
* \return    $success['msg'] (string) Returns a message explaining the status of the execution.
** \return • 'sectors deleted.' -> When was able to delete the sectors row/rows.
** \return • 'It was not possible to erase the sectors row/rows requested. Try again later.' -> When it fails to delete the row.
** \return • 'This sectors did not exist.' -> When the sectors id was not found or did not exist. 
*/
function deleteById($id) {
    $register = new sectors();
    $exists = $register->readId($id);

    if(count($exists) > 0) {
        $success['response'] = $register->deleteById($id);
        $exists = $register->readId($id);
        if(count($exists) > 0) {
            $success['success'] = false;
            $success['msg'] = 'It was not possible to erase the sectors row/rows requested. Try again later.';
        }else {
            $success['success'] = true;
            $success['msg'] = 'sectors deleted.';
        }
    }else {
        $success['success'] = false;
        $success['msg'] = 'This sectors did not exists.';
    }
    return $success;
}
        
?>
    
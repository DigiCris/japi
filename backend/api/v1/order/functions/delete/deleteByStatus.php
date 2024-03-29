
<?php

include_once 'orderHandler.php';

/*!
* \brief       delete all that matches Status in order
* \details     Search in the database order that matches Status and delete it if it exists.
* \param       (VARCHAR) Status The identifier of the row/rows in the order table to delete.
* \return    $success['response'] (bool) Returns true if the row/rows was/were deleted, false if not.
* \return    $success['success'] (bool) Returns true if the request was succesful, false if not.
* \return    $success['msg'] (string) Returns a message explaining the status of the execution.
** \return • 'order deleted.' -> When was able to delete the order row/rows.
** \return • 'It was not possible to erase the order row/rows requested. Try again later.' -> When it fails to delete the row.
** \return • 'This order did not exist.' -> When the order Status was not found or did not exist. 
*/
function deleteByStatus($Status) {
    $register = new order();
    $exists = $register->readStatus($Status);

    if(count($exists) > 0) {
        $success['response'] = $register->deleteByStatus($Status);
        $exists = $register->readStatus($Status);
        if(count($exists) > 0) {
            $success['success'] = false;
            $success['msg'] = 'It was not possible to erase the order row/rows requested. Try again later.';
        }else {
            $success['success'] = true;
            $success['msg'] = 'order deleted.';
        }
    }else {
        $success['success'] = false;
        $success['msg'] = 'This order did not exists.';
    }
    return $success;
}
        
?>
    
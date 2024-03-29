
<?php 

include_once 'sectorsHandler.php';

debug ('i am updateLink.php <br>');

/*!
* \brief    Update sectorsName by id inside a row in the databse.
* \details  Defines a new sectorsName in the database of sectors stored in the database, which is searched by id.
* \param    $id The field of the sectors table that I want to use to search.
* \param    $sectorsName The value in sectors table that I want to update.
* \return   $success  (array) Returns an array with different success states.
*/

function updateSectorsNameById($id, $sectorsName) {
    debug ('i am in updateIdBySectorsName');

    $information = new sectors();
    $success['response'] = $information->readId($id);
    $success['response'] = $success['response'][0];

    if($success['response']['id'] == $id) {
        $information->set_sectorsName($sectorsName);
        $success['response'] = $information->updateSectorsNameById($id);
        $success['response'] = $information->readId($id);
        $success['response'] = $success['response'][0];
        if($success['response']['sectorsName'] == $sectorsName) {
            $success['success'] = true;
            $success['msg'] = 'Updated.';
        }else {
            $success['success'] = false;
            $success['msg'] = 'We could not update. Try again later.'; 
        }
    }
    else {
        $success['success'] = false;
        $success['msg'] = 'We could not find the id you are trying to update.';
    }

    return $success;
}

?>    
    

<?php 

include_once 'sectorsHandler.php';

debug ('i am updateLink.php <br>');

/*!
* \brief    Update moreUsed by sectorsName inside a row in the databse.
* \details  Defines a new moreUsed in the database of sectors stored in the database, which is searched by sectorsName.
* \param    $sectorsName The field of the sectors table that I want to use to search.
* \param    $moreUsed The value in sectors table that I want to update.
* \return   $success  (array) Returns an array with different success states.
*/

function updateMoreUsedBySectorsName($sectorsName, $moreUsed) {
    debug ('i am in updateSectorsNameByMoreUsed');

    $information = new sectors();
    $success['response'] = $information->readSectorsName($sectorsName);
    $success['response'] = $success['response'][0];

    if($success['response']['sectorsName'] == $sectorsName) {
        $information->set_moreUsed($moreUsed);
        $success['response'] = $information->updateMoreUsedBySectorsName($sectorsName);
        $success['response'] = $information->readSectorsName($sectorsName);
        $success['response'] = $success['response'][0];
        if($success['response']['moreUsed'] == $moreUsed) {
            $success['success'] = true;
            $success['msg'] = 'Updated.';
        }else {
            $success['success'] = false;
            $success['msg'] = 'We could not update. Try again later.'; 
        }
    }
    else {
        $success['success'] = false;
        $success['msg'] = 'We could not find the sectorsName you are trying to update.';
    }

    return $success;
}

?>    
    
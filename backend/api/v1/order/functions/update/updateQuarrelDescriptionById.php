
<?php 

include_once 'orderHandler.php';

debug ('i am updateLink.php <br>');

/*!
* \brief    Update quarrelDescription by id inside a row in the databse.
* \details  Defines a new quarrelDescription in the database of order stored in the database, which is searched by id.
* \param    $id The field of the order table that I want to use to search.
* \param    $quarrelDescription The value in order table that I want to update.
* \return   $success  (array) Returns an array with different success states.
*/

function updateQuarrelDescriptionById($id, $quarrelDescription) {
    debug ('i am in updateIdByQuarrelDescription');

    $information = new order();
    $success['response'] = $information->readId($id);
    $success['response'] = $success['response'][0];

    if($success['response']['id'] == $id) {
        $information->set_quarrelDescription($quarrelDescription);
        $success['response'] = $information->updateQuarrelDescriptionById($id);
        $success['response'] = $information->readId($id);
        $success['response'] = $success['response'][0];
        if($success['response']['quarrelDescription'] == $quarrelDescription) {
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
    
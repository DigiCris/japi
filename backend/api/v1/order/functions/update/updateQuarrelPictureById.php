
<?php 

include_once 'orderHandler.php';

debug ('i am updateLink.php <br>');

/*!
* \brief    Update quarrelPicture by id inside a row in the databse.
* \details  Defines a new quarrelPicture in the database of order stored in the database, which is searched by id.
* \param    $id The field of the order table that I want to use to search.
* \param    $quarrelPicture The value in order table that I want to update.
* \return   $success  (array) Returns an array with different success states.
*/

function updateQuarrelPictureById($id, $quarrelPicture) {
    debug ('i am in updateIdByQuarrelPicture');

    $information = new order();
    $success['response'] = $information->readId($id);
    $success['response'] = $success['response'][0];

    if($success['response']['id'] == $id) {
        $information->set_quarrelPicture($quarrelPicture);
        $success['response'] = $information->updateQuarrelPictureById($id);
        $success['response'] = $information->readId($id);
        $success['response'] = $success['response'][0];
        if($success['response']['quarrelPicture'] == $quarrelPicture) {
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
    
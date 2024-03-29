
<?php 

include_once 'orderHandler.php';

debug ('i am updateLink.php <br>');

/*!
* \brief    Update reviewLevel by id inside a row in the databse.
* \details  Defines a new reviewLevel in the database of order stored in the database, which is searched by id.
* \param    $id The field of the order table that I want to use to search.
* \param    $reviewLevel The value in order table that I want to update.
* \return   $success  (array) Returns an array with different success states.
*/

function updateReviewLevelById($id, $reviewLevel) {
    debug ('i am in updateIdByReviewLevel');

    $information = new order();
    $success['response'] = $information->readId($id);
    $success['response'] = $success['response'][0];

    if($success['response']['id'] == $id) {
        $information->set_reviewLevel($reviewLevel);
        $success['response'] = $information->updateReviewLevelById($id);
        $success['response'] = $information->readId($id);
        $success['response'] = $success['response'][0];
        if($success['response']['reviewLevel'] == $reviewLevel) {
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
    
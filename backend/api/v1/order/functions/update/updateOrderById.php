
<?php 

include_once 'orderHandler.php';

debug ('i am updateLink.php <br>');

/*!
* \brief    Update order by id inside a row in the databse.
* \details  Defines a new order in the database of order stored in the database, which is searched by id.
* \param    $id The field of the order table that I want to use to search.
* \param    $order The value in order table that I want to update.
* \return   $success  (array) Returns an array with different success states.
*/

function updateOrderById($id, $order) {
    debug ('i am in updateIdByOrder');

    $information = new order();
    $success['response'] = $information->readId($id);
    $success['response'] = $success['response'][0];

    if($success['response']['id'] == $id) {
        $information->set_order($order);
        $success['response'] = $information->updateOrderById($id);
        $success['response'] = $information->readId($id);
        $success['response'] = $success['response'][0];
        if($success['response']['order'] == $order) {
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
    
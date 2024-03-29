
<?php 

include_once 'orderHandler.php';

debug ('i am updateLink.php <br>');

/*!
* \brief    Update shop by shopId inside a row in the databse.
* \details  Defines a new shop in the database of order stored in the database, which is searched by shopId.
* \param    $shopId The field of the order table that I want to use to search.
* \param    $shop The value in order table that I want to update.
* \return   $success  (array) Returns an array with different success states.
*/

function updateShopByShopId($shopId, $shop) {
    debug ('i am in updateShopIdByShop');

    $information = new order();
    $success['response'] = $information->readShopId($shopId);
    $success['response'] = $success['response'][0];

    if($success['response']['shopId'] == $shopId) {
        $information->set_shop($shop);
        $success['response'] = $information->updateShopByShopId($shopId);
        $success['response'] = $information->readShopId($shopId);
        $success['response'] = $success['response'][0];
        if($success['response']['shop'] == $shop) {
            $success['success'] = true;
            $success['msg'] = 'Updated.';
        }else {
            $success['success'] = false;
            $success['msg'] = 'We could not update. Try again later.'; 
        }
    }
    else {
        $success['success'] = false;
        $success['msg'] = 'We could not find the shopId you are trying to update.';
    }

    return $success;
}

?>    
    
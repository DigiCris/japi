<?php

include_once 'orderHandler.php';

/*!
* \brief        Update all row information.
* \details      Update the information of order table, searching it by id.
* \param      $id       (INT)    Identifier of the order to update.  1 unique id for each order
* \param      $shop     (VARCHAR)  shop to update. Shoping name
* \param      $shopId     (INT)  shopId to update. Shopping identifier
* \param      $order     (VARCHAR)  order to update. What people asked for
* \param      $shipDate     (DATE)  shipDate to update. when people ordered it
* \param      $Status     (VARCHAR)  Status to update. If it's delivered or not
* \param      $price     (VARCHAR)  price to update. total price of the order
* \param      $pickAddress     (VARCHAR)  pickAddress to update. shopping location
* \param      $deliveryAddress     (VARCHAR)  deliveryAddress to update. users location
* \param      $quarrelDescription     (VARCHAR)  quarrelDescription to update. Description if there was a problem
* \param      $quarrelPicture     (VARCHAR)  quarrelPicture to update. base64 picture if there was a problem
* \param      $reviewDescription     (VARCHAR)  reviewDescription to update. user's comments for shop reputation
* \param      $reviewLevel     (INT)  reviewLevel to update. How many stars users gave
* \param      $deliveryId     (INT)  deliveryId to update. Id of the delivery guy
* \param      $deliveryMoney     (VARCHAR)  deliveryMoney to update. How much of price goes to delivery
* \param      $userId     (INT)  userId to update. Id of the user that ordered
* \return      $success['response'] (array) An array with the updated fields of the order.
     ** ['id']        (INT)   autoincremental .
     ** ['shop']        (VARCHAR)   .
     ** ['shopId']        (INT)   .
     ** ['order']        (VARCHAR)   .
     ** ['shipDate']        (DATE)   .
     ** ['Status']        (VARCHAR)   .
     ** ['price']        (VARCHAR)   .
     ** ['pickAddress']        (VARCHAR)   .
     ** ['deliveryAddress']        (VARCHAR)   .
     ** ['quarrelDescription']        (VARCHAR)   .
     ** ['quarrelPicture']        (VARCHAR)   .
     ** ['reviewDescription']        (VARCHAR)   .
     ** ['reviewLevel']        (INT)   .
     ** ['deliveryId']        (INT)   .
     ** ['deliveryMoney']        (VARCHAR)   .
     ** ['userId']        (INT)   .
* \return      $success['success'] (bool) Returns true if the order was updated, false if not.
* \return      $success['msg'] (string) Returns a message explaining the status of the execution.
    * \return •    'order updated' -> When the execution was succesful, the order has been updated.
    * \return •    'We could not update. Try again later.' -> When the update failed, it could be because it couldn't connect to the database.
    * \return •    'We could not find the id you are trying to update.' -> When the order's field id does not exist or it is not found in the database.
*/

function updateAllById($id, $shop, $shopId, $order, $shipDate, $Status, $price, $pickAddress, $deliveryAddress, $quarrelDescription, $quarrelPicture, $reviewDescription, $reviewLevel, $deliveryId, $deliveryMoney, $userId) {
    $register = new order();

    $success['response'] = $register->readId($id);

    //echo "id==id ( ".$success['response']['id']." => ".$id." )";

    if($id == $id) {
        
        //$register->set_id($id);
        $register->set_shop($shop);
        $register->set_shopId($shopId);
        $register->set_order($order);
        $register->set_shipDate($shipDate);
        $register->set_Status($Status);
        $register->set_price($price);
        $register->set_pickAddress($pickAddress);
        $register->set_deliveryAddress($deliveryAddress);
        $register->set_quarrelDescription($quarrelDescription);
        $register->set_quarrelPicture($quarrelPicture);
        $register->set_reviewDescription($reviewDescription);
        $register->set_reviewLevel($reviewLevel);
        $register->set_deliveryId($deliveryId);
        $register->set_deliveryMoney($deliveryMoney);
        $register->set_userId($userId);

        $success['response'] = $register->updateAllById($id);
        $success['response'] = $register->readId($id);
        if($success['response']['shipDate'] == $shipDate and $success['response']['id'] == $id) {
            // I prepare the inserted data (encrypted) to show
            $data = array (
               'id' => $id,
               'shop' => $register->get_shop(),
               'shopId' => $register->get_shopId(),
               'order' => $register->get_order(),
               'shipDate' => $register->get_shipDate(),
               'Status' => $register->get_Status(),
               'price' => $register->get_price(),
               'pickAddress' => $register->get_pickAddress(),
               'deliveryAddress' => $register->get_deliveryAddress(),
               'quarrelDescription' => $register->get_quarrelDescription(),
               'quarrelPicture' => $register->get_quarrelPicture(),
               'reviewDescription' => $register->get_reviewDescription(),
               'reviewLevel' => $register->get_reviewLevel(),
               'deliveryId' => $register->get_deliveryId(),
               'deliveryMoney' => $register->get_deliveryMoney(),
               'userId' => $register->get_userId()
            );
            $success['response'] = $data;
            $success['success'] = true;
            $success['msg'] = 'order updated';
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
    
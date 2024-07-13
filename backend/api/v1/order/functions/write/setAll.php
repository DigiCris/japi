
<?php

include_once 'orderHandler.php';

/*!
* \brief      Create a new order row.
* \details    Insert a new order an it's information in the database. Some fields might encrypt.
*\param      $id (INT)  1 unique id for each order
*\param      $shop (VARCHAR) Shoping name
*\param      $shopId (INT) Shopping identifier
*\param      $order (VARCHAR) What people asked for
*\param      $shipDate (DATE) when people ordered it
*\param      $Status (VARCHAR) If it's delivered or not
*\param      $price (VARCHAR) total price of the order
*\param      $pickAddress (VARCHAR) shopping location
*\param      $deliveryAddress (VARCHAR) users location
*\param      $quarrelDescription (VARCHAR) Description if there was a problem
*\param      $quarrelPicture (VARCHAR) base64 picture if there was a problem
*\param      $reviewDescription (VARCHAR) user's comments for shop reputation
*\param      $reviewLevel (INT) How many stars users gave
*\param      $deliveryId (INT) Id of the delivery guy
*\param      $deliveryMoney (VARCHAR) How much of price goes to delivery
*\param      $userId (INT) Id of the user that ordered 
* \return $success['response'] (array) An array with the established order fields.
** ['id'] (INT) The established id.
** ['shop'] (VARCHAR) The established shop.
** ['shopId'] (INT) The established shopId.
** ['order'] (VARCHAR) The established order.
** ['shipDate'] (DATE) The established shipDate.
** ['Status'] (VARCHAR) The established Status.
** ['price'] (VARCHAR) The established price.
** ['pickAddress'] (VARCHAR) The established pickAddress.
** ['deliveryAddress'] (VARCHAR) The established deliveryAddress.
** ['quarrelDescription'] (VARCHAR) The established quarrelDescription.
** ['quarrelPicture'] (VARCHAR) The established quarrelPicture.
** ['reviewDescription'] (VARCHAR) The established reviewDescription.
** ['reviewLevel'] (INT) The established reviewLevel.
** ['deliveryId'] (INT) The established deliveryId.
** ['deliveryMoney'] (VARCHAR) The established deliveryMoney.
** ['userId'] (INT) The established userId.
* \return $success['success'] (bool) Returns true if the new order row was inserted, false if not.
* \return $success['msg'] (string) Returns a message explaining the status of the execution.
** \return • 'order uploaded' -> When the execution was succesful, the new order row was uploaded in the database.
** \return • 'This order could not be uploaded. Try again later.' -> When the insert failed, it could be because it couldn't connect to the database.
*/
function setAll($id=null, $shop=null, $shopId=null, $order=null, $shipDate=null, $Status=null, $price=null, $pickAddress=null, $deliveryAddress=null, $quarrelDescription=null, $quarrelPicture=null, $reviewDescription=null, $reviewLevel=null, $deliveryId=null, $deliveryMoney=null, $userId=null) {

    $register = new order();
    
        $register->set_id($id);
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

        $success['response'] = $register->insert();

        debug('after insert<br>');
        //exit();

        if($success['response'] == false) {
            $success['success'] = false;
            $success['msg'] = 'This order could not be uploaded. Try again later.';
        }else {
            // I prepare the inserted data (encrypted) to show
            $data = array ( 
              'id' => $register->get_id(),
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
            $success['msg'] = 'order uploaded';
        }
    
    return $success;
}

?>

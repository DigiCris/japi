
    <?php

    include_once '../configuracion.php';
    include_once '../lib.php';

    debug('I am order <br>');
    setPostWhenMissing();
    debug($_POST);

    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            if(!isset($_POST['method'])) {
                $result['success']=false; // I write the error directly in the result
                $result['msg']='no post method especified';
            }else {
                $result = postFunctions($_POST);
            }
            $result=json_encode($result);
            echo $result;
            break;
        
        case 'GET':
            if(!isset($_GET['method'])) {
                $result['success']=false; // I write the error directly in the result
                $result['msg']='no get method especified';
            }else {
                $result = getFunctions($_GET);
            }
            $result=json_encode($result);
            echo $result;
            break;

        default:
            $result['success']=false;
            $result['msg']='Invalid REQUEST_METHOD (GET or POST)';
            $result = json_encode($result);
            echo $result;
            break;
    }
    
/*!
* \brief    Endpoints of the get method.
* \details  It has a switch that reads the get method, which connects to the corresponding endpoint.
* \param $get['method'] (string) Specifies the method that connects to the corresponding get endpoints.
*    'getAll' -> Read all order
*    'getById' -> Read order by id.
*    'getByShop' -> Read order by shop.
*    'getByShopId' -> Read order by shopId.
*    'getByOrder' -> Read order by order.
*    'getByShipDate' -> Read order by shipDate.
*    'getByStatus' -> Read order by Status.
*    'getByPrice' -> Read order by price.
*    'getByPickAddress' -> Read order by pickAddress.
*    'getByDeliveryAddress' -> Read order by deliveryAddress.
*    'getByQuarrelDescription' -> Read order by quarrelDescription.
*    'getByQuarrelPicture' -> Read order by quarrelPicture.
*    'getByReviewDescription' -> Read order by reviewDescription.
*    'getByReviewLevel' -> Read order by reviewLevel.
*    'getByDeliveryId' -> Read order by deliveryId.
*    'getByDeliveryMoney' -> Read order by deliveryMoney.
*    'getByUserId' -> Read order by userId.
* \param $get['id'] searching variable of the order table to read (in method getById).
* \param $get['shop'] searching variable of the order table to read (in method getByShop).
* \param $get['shopId'] searching variable of the order table to read (in method getByShopId).
* \param $get['order'] searching variable of the order table to read (in method getByOrder).
* \param $get['shipDate'] searching variable of the order table to read (in method getByShipDate).
* \param $get['Status'] searching variable of the order table to read (in method getByStatus).
* \param $get['price'] searching variable of the order table to read (in method getByPrice).
* \param $get['pickAddress'] searching variable of the order table to read (in method getByPickAddress).
* \param $get['deliveryAddress'] searching variable of the order table to read (in method getByDeliveryAddress).
* \param $get['quarrelDescription'] searching variable of the order table to read (in method getByQuarrelDescription).
* \param $get['quarrelPicture'] searching variable of the order table to read (in method getByQuarrelPicture).
* \param $get['reviewDescription'] searching variable of the order table to read (in method getByReviewDescription).
* \param $get['reviewLevel'] searching variable of the order table to read (in method getByReviewLevel).
* \param $get['deliveryId'] searching variable of the order table to read (in method getByDeliveryId).
* \param $get['deliveryMoney'] searching variable of the order table to read (in method getByDeliveryMoney).
* \param $get['userId'] searching variable of the order table to read (in method getByUserId).
* \return $result['response'] (array) An array with the requested information of order table.
    * ['id'] (INT)  1 unique id for each order (Special carachteristic => autoincremental ).
    * ['shop'] (VARCHAR) Shoping name (Special carachteristic => ).
    * ['shopId'] (INT) Shopping identifier (Special carachteristic => ).
    * ['order'] (VARCHAR) What people asked for (Special carachteristic => ).
    * ['shipDate'] (DATE) when people ordered it (Special carachteristic => ).
    * ['Status'] (VARCHAR) If it's delivered or not (Special carachteristic => ).
    * ['price'] (VARCHAR) total price of the order (Special carachteristic => ).
    * ['pickAddress'] (VARCHAR) shopping location (Special carachteristic => ).
    * ['deliveryAddress'] (VARCHAR) users location (Special carachteristic => ).
    * ['quarrelDescription'] (VARCHAR) Description if there was a problem (Special carachteristic => ).
    * ['quarrelPicture'] (VARCHAR) base64 picture if there was a problem (Special carachteristic => ).
    * ['reviewDescription'] (VARCHAR) user's comments for shop reputation (Special carachteristic => ).
    * ['reviewLevel'] (INT) How many stars users gave (Special carachteristic => ).
    * ['deliveryId'] (INT) Id of the delivery guy (Special carachteristic => ).
    * ['deliveryMoney'] (VARCHAR) How much of price goes to delivery (Special carachteristic => ).
    * ['userId'] (INT) Id of the user that ordered (Special carachteristic => ).
* \return $result['success'] (bool) Returns true if the request was succesful, false if not.
* \return $result['msg'] (string) Returns a message explaining the status of the execution.
*   'order fetched' -> When was able to read the fetched order.
*   'No id selected to read.' -> When id is missing (in method getById).
*   'No shop selected to read.' -> When shop is missing (in method getByShop).
*   'No shopId selected to read.' -> When shopId is missing (in method getByShopId).
*   'No order selected to read.' -> When order is missing (in method getByOrder).
*   'No shipDate selected to read.' -> When shipDate is missing (in method getByShipDate).
*   'No Status selected to read.' -> When Status is missing (in method getByStatus).
*   'No price selected to read.' -> When price is missing (in method getByPrice).
*   'No pickAddress selected to read.' -> When pickAddress is missing (in method getByPickAddress).
*   'No deliveryAddress selected to read.' -> When deliveryAddress is missing (in method getByDeliveryAddress).
*   'No quarrelDescription selected to read.' -> When quarrelDescription is missing (in method getByQuarrelDescription).
*   'No quarrelPicture selected to read.' -> When quarrelPicture is missing (in method getByQuarrelPicture).
*   'No reviewDescription selected to read.' -> When reviewDescription is missing (in method getByReviewDescription).
*   'No reviewLevel selected to read.' -> When reviewLevel is missing (in method getByReviewLevel).
*   'No deliveryId selected to read.' -> When deliveryId is missing (in method getByDeliveryId).
*   'No deliveryMoney selected to read.' -> When deliveryMoney is missing (in method getByDeliveryMoney).
*   'No userId selected to read.' -> When userId is missing (in method getByUserId).
*   'No valid get case selected' -> When a method that does not exist is selected (in the default of the switch). 
*/
function getFunctions($get) {
    debug($get['method']);
    switch ($get['method']) {
        
        case 'getAll':
            include_once 'functions/read/getAll.php';
            $result = getAll();
            debug('getAll');
            break;
            
        case 'getById':
            include_once 'functions/read/getById.php';
            if(!isset($get['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id selected to read.';
                break;
            }
            $result = getById($get['id']);
            debug('getById');
            break;
            
        case 'getByShop':
            include_once 'functions/read/getByShop.php';
            if(!isset($get['shop'])) {
                $result['success'] = false;
                $result['msg'] = 'No shop selected to read.';
                break;
            }
            $result = getByShop($get['shop']);
            debug('getByShop');
            break;
            
        case 'getByShopId':
            include_once 'functions/read/getByShopId.php';
            if(!isset($get['shopId'])) {
                $result['success'] = false;
                $result['msg'] = 'No shopId selected to read.';
                break;
            }
            $result = getByShopId($get['shopId']);
            debug('getByShopId');
            break;
            
        case 'getByOrder':
            include_once 'functions/read/getByOrder.php';
            if(!isset($get['order'])) {
                $result['success'] = false;
                $result['msg'] = 'No order selected to read.';
                break;
            }
            $result = getByOrder($get['order']);
            debug('getByOrder');
            break;
            
        case 'getByShipDate':
            include_once 'functions/read/getByShipDate.php';
            if(!isset($get['shipDate'])) {
                $result['success'] = false;
                $result['msg'] = 'No shipDate selected to read.';
                break;
            }
            $result = getByShipDate($get['shipDate']);
            debug('getByShipDate');
            break;
            
        case 'getByStatus':
            include_once 'functions/read/getByStatus.php';
            if(!isset($get['Status'])) {
                $result['success'] = false;
                $result['msg'] = 'No Status selected to read.';
                break;
            }
            $result = getByStatus($get['Status']);
            debug('getByStatus');
            break;
            
        case 'getByPrice':
            include_once 'functions/read/getByPrice.php';
            if(!isset($get['price'])) {
                $result['success'] = false;
                $result['msg'] = 'No price selected to read.';
                break;
            }
            $result = getByPrice($get['price']);
            debug('getByPrice');
            break;
            
        case 'getByPickAddress':
            include_once 'functions/read/getByPickAddress.php';
            if(!isset($get['pickAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No pickAddress selected to read.';
                break;
            }
            $result = getByPickAddress($get['pickAddress']);
            debug('getByPickAddress');
            break;
            
        case 'getByDeliveryAddress':
            include_once 'functions/read/getByDeliveryAddress.php';
            if(!isset($get['deliveryAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryAddress selected to read.';
                break;
            }
            $result = getByDeliveryAddress($get['deliveryAddress']);
            debug('getByDeliveryAddress');
            break;
            
        case 'getByQuarrelDescription':
            include_once 'functions/read/getByQuarrelDescription.php';
            if(!isset($get['quarrelDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelDescription selected to read.';
                break;
            }
            $result = getByQuarrelDescription($get['quarrelDescription']);
            debug('getByQuarrelDescription');
            break;
            
        case 'getByQuarrelPicture':
            include_once 'functions/read/getByQuarrelPicture.php';
            if(!isset($get['quarrelPicture'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelPicture selected to read.';
                break;
            }
            $result = getByQuarrelPicture($get['quarrelPicture']);
            debug('getByQuarrelPicture');
            break;
            
        case 'getByReviewDescription':
            include_once 'functions/read/getByReviewDescription.php';
            if(!isset($get['reviewDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewDescription selected to read.';
                break;
            }
            $result = getByReviewDescription($get['reviewDescription']);
            debug('getByReviewDescription');
            break;
            
        case 'getByReviewLevel':
            include_once 'functions/read/getByReviewLevel.php';
            if(!isset($get['reviewLevel'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewLevel selected to read.';
                break;
            }
            $result = getByReviewLevel($get['reviewLevel']);
            debug('getByReviewLevel');
            break;
            
        case 'getByDeliveryId':
            include_once 'functions/read/getByDeliveryId.php';
            if(!isset($get['deliveryId'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryId selected to read.';
                break;
            }
            $result = getByDeliveryId($get['deliveryId']);
            debug('getByDeliveryId');
            break;
            
        case 'getByDeliveryMoney':
            include_once 'functions/read/getByDeliveryMoney.php';
            if(!isset($get['deliveryMoney'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryMoney selected to read.';
                break;
            }
            $result = getByDeliveryMoney($get['deliveryMoney']);
            debug('getByDeliveryMoney');
            break;
            
        case 'getByUserId':
            include_once 'functions/read/getByUserId.php';
            if(!isset($get['userId'])) {
                $result['success'] = false;
                $result['msg'] = 'No userId selected to read.';
                break;
            }
            $result = getByUserId($get['userId']);
            debug('getByUserId');
            break;
            
        default:
            $result['success']=false;
            $result['msg']='No valid get case selected';
            break;
    }
    return $result;
        
}
        

/*!
* \brief    Endpoints of the post method.
* \details  It has a switch that reads the post method, which connects to the corresponding endpoint (set, delete or update).
* \param $post['method'] (string) Specifies the method that connects to the corresponding post endpoints. 
*    'setAll' -> Insert a new row in order
*    'deleteAll' -> delete all table in order
*    'deleteById' -> delete all that matches id in order
*    'deleteByShop' -> delete all that matches shop in order
*    'deleteByShopId' -> delete all that matches shopId in order
*    'deleteByOrder' -> delete all that matches order in order
*    'deleteByShipDate' -> delete all that matches shipDate in order
*    'deleteByStatus' -> delete all that matches Status in order
*    'deleteByPrice' -> delete all that matches price in order
*    'deleteByPickAddress' -> delete all that matches pickAddress in order
*    'deleteByDeliveryAddress' -> delete all that matches deliveryAddress in order
*    'deleteByQuarrelDescription' -> delete all that matches quarrelDescription in order
*    'deleteByQuarrelPicture' -> delete all that matches quarrelPicture in order
*    'deleteByReviewDescription' -> delete all that matches reviewDescription in order
*    'deleteByReviewLevel' -> delete all that matches reviewLevel in order
*    'deleteByDeliveryId' -> delete all that matches deliveryId in order
*    'deleteByDeliveryMoney' -> delete all that matches deliveryMoney in order
*    'deleteByUserId' -> delete all that matches userId in order
*    'updateAllById' -> Updates all that matches id in order
*    'updateAllByShop' -> Updates all that matches shop in order
*    'updateAllByShopId' -> Updates all that matches shopId in order
*    'updateAllByOrder' -> Updates all that matches order in order
*    'updateAllByShipDate' -> Updates all that matches shipDate in order
*    'updateAllByStatus' -> Updates all that matches Status in order
*    'updateAllByPrice' -> Updates all that matches price in order
*    'updateAllByPickAddress' -> Updates all that matches pickAddress in order
*    'updateAllByDeliveryAddress' -> Updates all that matches deliveryAddress in order
*    'updateAllByQuarrelDescription' -> Updates all that matches quarrelDescription in order
*    'updateAllByQuarrelPicture' -> Updates all that matches quarrelPicture in order
*    'updateAllByReviewDescription' -> Updates all that matches reviewDescription in order
*    'updateAllByReviewLevel' -> Updates all that matches reviewLevel in order
*    'updateAllByDeliveryId' -> Updates all that matches deliveryId in order
*    'updateAllByDeliveryMoney' -> Updates all that matches deliveryMoney in order
*    'updateAllByUserId' -> Updates all that matches userId in order
*    'updateShopById' -> Updates shop that matches id in order
*    'updateShopByShopId' -> Updates shop that matches shopId in order
*    'updateShopByOrder' -> Updates shop that matches order in order
*    'updateShopByShipDate' -> Updates shop that matches shipDate in order
*    'updateShopByStatus' -> Updates shop that matches Status in order
*    'updateShopByPrice' -> Updates shop that matches price in order
*    'updateShopByPickAddress' -> Updates shop that matches pickAddress in order
*    'updateShopByDeliveryAddress' -> Updates shop that matches deliveryAddress in order
*    'updateShopByQuarrelDescription' -> Updates shop that matches quarrelDescription in order
*    'updateShopByQuarrelPicture' -> Updates shop that matches quarrelPicture in order
*    'updateShopByReviewDescription' -> Updates shop that matches reviewDescription in order
*    'updateShopByReviewLevel' -> Updates shop that matches reviewLevel in order
*    'updateShopByDeliveryId' -> Updates shop that matches deliveryId in order
*    'updateShopByDeliveryMoney' -> Updates shop that matches deliveryMoney in order
*    'updateShopByUserId' -> Updates shop that matches userId in order
*    'updateShopIdById' -> Updates shopId that matches id in order
*    'updateShopIdByShop' -> Updates shopId that matches shop in order
*    'updateShopIdByOrder' -> Updates shopId that matches order in order
*    'updateShopIdByShipDate' -> Updates shopId that matches shipDate in order
*    'updateShopIdByStatus' -> Updates shopId that matches Status in order
*    'updateShopIdByPrice' -> Updates shopId that matches price in order
*    'updateShopIdByPickAddress' -> Updates shopId that matches pickAddress in order
*    'updateShopIdByDeliveryAddress' -> Updates shopId that matches deliveryAddress in order
*    'updateShopIdByQuarrelDescription' -> Updates shopId that matches quarrelDescription in order
*    'updateShopIdByQuarrelPicture' -> Updates shopId that matches quarrelPicture in order
*    'updateShopIdByReviewDescription' -> Updates shopId that matches reviewDescription in order
*    'updateShopIdByReviewLevel' -> Updates shopId that matches reviewLevel in order
*    'updateShopIdByDeliveryId' -> Updates shopId that matches deliveryId in order
*    'updateShopIdByDeliveryMoney' -> Updates shopId that matches deliveryMoney in order
*    'updateShopIdByUserId' -> Updates shopId that matches userId in order
*    'updateOrderById' -> Updates order that matches id in order
*    'updateOrderByShop' -> Updates order that matches shop in order
*    'updateOrderByShopId' -> Updates order that matches shopId in order
*    'updateOrderByShipDate' -> Updates order that matches shipDate in order
*    'updateOrderByStatus' -> Updates order that matches Status in order
*    'updateOrderByPrice' -> Updates order that matches price in order
*    'updateOrderByPickAddress' -> Updates order that matches pickAddress in order
*    'updateOrderByDeliveryAddress' -> Updates order that matches deliveryAddress in order
*    'updateOrderByQuarrelDescription' -> Updates order that matches quarrelDescription in order
*    'updateOrderByQuarrelPicture' -> Updates order that matches quarrelPicture in order
*    'updateOrderByReviewDescription' -> Updates order that matches reviewDescription in order
*    'updateOrderByReviewLevel' -> Updates order that matches reviewLevel in order
*    'updateOrderByDeliveryId' -> Updates order that matches deliveryId in order
*    'updateOrderByDeliveryMoney' -> Updates order that matches deliveryMoney in order
*    'updateOrderByUserId' -> Updates order that matches userId in order
*    'updateShipDateById' -> Updates shipDate that matches id in order
*    'updateShipDateByShop' -> Updates shipDate that matches shop in order
*    'updateShipDateByShopId' -> Updates shipDate that matches shopId in order
*    'updateShipDateByOrder' -> Updates shipDate that matches order in order
*    'updateShipDateByStatus' -> Updates shipDate that matches Status in order
*    'updateShipDateByPrice' -> Updates shipDate that matches price in order
*    'updateShipDateByPickAddress' -> Updates shipDate that matches pickAddress in order
*    'updateShipDateByDeliveryAddress' -> Updates shipDate that matches deliveryAddress in order
*    'updateShipDateByQuarrelDescription' -> Updates shipDate that matches quarrelDescription in order
*    'updateShipDateByQuarrelPicture' -> Updates shipDate that matches quarrelPicture in order
*    'updateShipDateByReviewDescription' -> Updates shipDate that matches reviewDescription in order
*    'updateShipDateByReviewLevel' -> Updates shipDate that matches reviewLevel in order
*    'updateShipDateByDeliveryId' -> Updates shipDate that matches deliveryId in order
*    'updateShipDateByDeliveryMoney' -> Updates shipDate that matches deliveryMoney in order
*    'updateShipDateByUserId' -> Updates shipDate that matches userId in order
*    'updateStatusById' -> Updates Status that matches id in order
*    'updateStatusByShop' -> Updates Status that matches shop in order
*    'updateStatusByShopId' -> Updates Status that matches shopId in order
*    'updateStatusByOrder' -> Updates Status that matches order in order
*    'updateStatusByShipDate' -> Updates Status that matches shipDate in order
*    'updateStatusByPrice' -> Updates Status that matches price in order
*    'updateStatusByPickAddress' -> Updates Status that matches pickAddress in order
*    'updateStatusByDeliveryAddress' -> Updates Status that matches deliveryAddress in order
*    'updateStatusByQuarrelDescription' -> Updates Status that matches quarrelDescription in order
*    'updateStatusByQuarrelPicture' -> Updates Status that matches quarrelPicture in order
*    'updateStatusByReviewDescription' -> Updates Status that matches reviewDescription in order
*    'updateStatusByReviewLevel' -> Updates Status that matches reviewLevel in order
*    'updateStatusByDeliveryId' -> Updates Status that matches deliveryId in order
*    'updateStatusByDeliveryMoney' -> Updates Status that matches deliveryMoney in order
*    'updateStatusByUserId' -> Updates Status that matches userId in order
*    'updatePriceById' -> Updates price that matches id in order
*    'updatePriceByShop' -> Updates price that matches shop in order
*    'updatePriceByShopId' -> Updates price that matches shopId in order
*    'updatePriceByOrder' -> Updates price that matches order in order
*    'updatePriceByShipDate' -> Updates price that matches shipDate in order
*    'updatePriceByStatus' -> Updates price that matches Status in order
*    'updatePriceByPickAddress' -> Updates price that matches pickAddress in order
*    'updatePriceByDeliveryAddress' -> Updates price that matches deliveryAddress in order
*    'updatePriceByQuarrelDescription' -> Updates price that matches quarrelDescription in order
*    'updatePriceByQuarrelPicture' -> Updates price that matches quarrelPicture in order
*    'updatePriceByReviewDescription' -> Updates price that matches reviewDescription in order
*    'updatePriceByReviewLevel' -> Updates price that matches reviewLevel in order
*    'updatePriceByDeliveryId' -> Updates price that matches deliveryId in order
*    'updatePriceByDeliveryMoney' -> Updates price that matches deliveryMoney in order
*    'updatePriceByUserId' -> Updates price that matches userId in order
*    'updatePickAddressById' -> Updates pickAddress that matches id in order
*    'updatePickAddressByShop' -> Updates pickAddress that matches shop in order
*    'updatePickAddressByShopId' -> Updates pickAddress that matches shopId in order
*    'updatePickAddressByOrder' -> Updates pickAddress that matches order in order
*    'updatePickAddressByShipDate' -> Updates pickAddress that matches shipDate in order
*    'updatePickAddressByStatus' -> Updates pickAddress that matches Status in order
*    'updatePickAddressByPrice' -> Updates pickAddress that matches price in order
*    'updatePickAddressByDeliveryAddress' -> Updates pickAddress that matches deliveryAddress in order
*    'updatePickAddressByQuarrelDescription' -> Updates pickAddress that matches quarrelDescription in order
*    'updatePickAddressByQuarrelPicture' -> Updates pickAddress that matches quarrelPicture in order
*    'updatePickAddressByReviewDescription' -> Updates pickAddress that matches reviewDescription in order
*    'updatePickAddressByReviewLevel' -> Updates pickAddress that matches reviewLevel in order
*    'updatePickAddressByDeliveryId' -> Updates pickAddress that matches deliveryId in order
*    'updatePickAddressByDeliveryMoney' -> Updates pickAddress that matches deliveryMoney in order
*    'updatePickAddressByUserId' -> Updates pickAddress that matches userId in order
*    'updateDeliveryAddressById' -> Updates deliveryAddress that matches id in order
*    'updateDeliveryAddressByShop' -> Updates deliveryAddress that matches shop in order
*    'updateDeliveryAddressByShopId' -> Updates deliveryAddress that matches shopId in order
*    'updateDeliveryAddressByOrder' -> Updates deliveryAddress that matches order in order
*    'updateDeliveryAddressByShipDate' -> Updates deliveryAddress that matches shipDate in order
*    'updateDeliveryAddressByStatus' -> Updates deliveryAddress that matches Status in order
*    'updateDeliveryAddressByPrice' -> Updates deliveryAddress that matches price in order
*    'updateDeliveryAddressByPickAddress' -> Updates deliveryAddress that matches pickAddress in order
*    'updateDeliveryAddressByQuarrelDescription' -> Updates deliveryAddress that matches quarrelDescription in order
*    'updateDeliveryAddressByQuarrelPicture' -> Updates deliveryAddress that matches quarrelPicture in order
*    'updateDeliveryAddressByReviewDescription' -> Updates deliveryAddress that matches reviewDescription in order
*    'updateDeliveryAddressByReviewLevel' -> Updates deliveryAddress that matches reviewLevel in order
*    'updateDeliveryAddressByDeliveryId' -> Updates deliveryAddress that matches deliveryId in order
*    'updateDeliveryAddressByDeliveryMoney' -> Updates deliveryAddress that matches deliveryMoney in order
*    'updateDeliveryAddressByUserId' -> Updates deliveryAddress that matches userId in order
*    'updateQuarrelDescriptionById' -> Updates quarrelDescription that matches id in order
*    'updateQuarrelDescriptionByShop' -> Updates quarrelDescription that matches shop in order
*    'updateQuarrelDescriptionByShopId' -> Updates quarrelDescription that matches shopId in order
*    'updateQuarrelDescriptionByOrder' -> Updates quarrelDescription that matches order in order
*    'updateQuarrelDescriptionByShipDate' -> Updates quarrelDescription that matches shipDate in order
*    'updateQuarrelDescriptionByStatus' -> Updates quarrelDescription that matches Status in order
*    'updateQuarrelDescriptionByPrice' -> Updates quarrelDescription that matches price in order
*    'updateQuarrelDescriptionByPickAddress' -> Updates quarrelDescription that matches pickAddress in order
*    'updateQuarrelDescriptionByDeliveryAddress' -> Updates quarrelDescription that matches deliveryAddress in order
*    'updateQuarrelDescriptionByQuarrelPicture' -> Updates quarrelDescription that matches quarrelPicture in order
*    'updateQuarrelDescriptionByReviewDescription' -> Updates quarrelDescription that matches reviewDescription in order
*    'updateQuarrelDescriptionByReviewLevel' -> Updates quarrelDescription that matches reviewLevel in order
*    'updateQuarrelDescriptionByDeliveryId' -> Updates quarrelDescription that matches deliveryId in order
*    'updateQuarrelDescriptionByDeliveryMoney' -> Updates quarrelDescription that matches deliveryMoney in order
*    'updateQuarrelDescriptionByUserId' -> Updates quarrelDescription that matches userId in order
*    'updateQuarrelPictureById' -> Updates quarrelPicture that matches id in order
*    'updateQuarrelPictureByShop' -> Updates quarrelPicture that matches shop in order
*    'updateQuarrelPictureByShopId' -> Updates quarrelPicture that matches shopId in order
*    'updateQuarrelPictureByOrder' -> Updates quarrelPicture that matches order in order
*    'updateQuarrelPictureByShipDate' -> Updates quarrelPicture that matches shipDate in order
*    'updateQuarrelPictureByStatus' -> Updates quarrelPicture that matches Status in order
*    'updateQuarrelPictureByPrice' -> Updates quarrelPicture that matches price in order
*    'updateQuarrelPictureByPickAddress' -> Updates quarrelPicture that matches pickAddress in order
*    'updateQuarrelPictureByDeliveryAddress' -> Updates quarrelPicture that matches deliveryAddress in order
*    'updateQuarrelPictureByQuarrelDescription' -> Updates quarrelPicture that matches quarrelDescription in order
*    'updateQuarrelPictureByReviewDescription' -> Updates quarrelPicture that matches reviewDescription in order
*    'updateQuarrelPictureByReviewLevel' -> Updates quarrelPicture that matches reviewLevel in order
*    'updateQuarrelPictureByDeliveryId' -> Updates quarrelPicture that matches deliveryId in order
*    'updateQuarrelPictureByDeliveryMoney' -> Updates quarrelPicture that matches deliveryMoney in order
*    'updateQuarrelPictureByUserId' -> Updates quarrelPicture that matches userId in order
*    'updateReviewDescriptionById' -> Updates reviewDescription that matches id in order
*    'updateReviewDescriptionByShop' -> Updates reviewDescription that matches shop in order
*    'updateReviewDescriptionByShopId' -> Updates reviewDescription that matches shopId in order
*    'updateReviewDescriptionByOrder' -> Updates reviewDescription that matches order in order
*    'updateReviewDescriptionByShipDate' -> Updates reviewDescription that matches shipDate in order
*    'updateReviewDescriptionByStatus' -> Updates reviewDescription that matches Status in order
*    'updateReviewDescriptionByPrice' -> Updates reviewDescription that matches price in order
*    'updateReviewDescriptionByPickAddress' -> Updates reviewDescription that matches pickAddress in order
*    'updateReviewDescriptionByDeliveryAddress' -> Updates reviewDescription that matches deliveryAddress in order
*    'updateReviewDescriptionByQuarrelDescription' -> Updates reviewDescription that matches quarrelDescription in order
*    'updateReviewDescriptionByQuarrelPicture' -> Updates reviewDescription that matches quarrelPicture in order
*    'updateReviewDescriptionByReviewLevel' -> Updates reviewDescription that matches reviewLevel in order
*    'updateReviewDescriptionByDeliveryId' -> Updates reviewDescription that matches deliveryId in order
*    'updateReviewDescriptionByDeliveryMoney' -> Updates reviewDescription that matches deliveryMoney in order
*    'updateReviewDescriptionByUserId' -> Updates reviewDescription that matches userId in order
*    'updateReviewLevelById' -> Updates reviewLevel that matches id in order
*    'updateReviewLevelByShop' -> Updates reviewLevel that matches shop in order
*    'updateReviewLevelByShopId' -> Updates reviewLevel that matches shopId in order
*    'updateReviewLevelByOrder' -> Updates reviewLevel that matches order in order
*    'updateReviewLevelByShipDate' -> Updates reviewLevel that matches shipDate in order
*    'updateReviewLevelByStatus' -> Updates reviewLevel that matches Status in order
*    'updateReviewLevelByPrice' -> Updates reviewLevel that matches price in order
*    'updateReviewLevelByPickAddress' -> Updates reviewLevel that matches pickAddress in order
*    'updateReviewLevelByDeliveryAddress' -> Updates reviewLevel that matches deliveryAddress in order
*    'updateReviewLevelByQuarrelDescription' -> Updates reviewLevel that matches quarrelDescription in order
*    'updateReviewLevelByQuarrelPicture' -> Updates reviewLevel that matches quarrelPicture in order
*    'updateReviewLevelByReviewDescription' -> Updates reviewLevel that matches reviewDescription in order
*    'updateReviewLevelByDeliveryId' -> Updates reviewLevel that matches deliveryId in order
*    'updateReviewLevelByDeliveryMoney' -> Updates reviewLevel that matches deliveryMoney in order
*    'updateReviewLevelByUserId' -> Updates reviewLevel that matches userId in order
*    'updateDeliveryIdById' -> Updates deliveryId that matches id in order
*    'updateDeliveryIdByShop' -> Updates deliveryId that matches shop in order
*    'updateDeliveryIdByShopId' -> Updates deliveryId that matches shopId in order
*    'updateDeliveryIdByOrder' -> Updates deliveryId that matches order in order
*    'updateDeliveryIdByShipDate' -> Updates deliveryId that matches shipDate in order
*    'updateDeliveryIdByStatus' -> Updates deliveryId that matches Status in order
*    'updateDeliveryIdByPrice' -> Updates deliveryId that matches price in order
*    'updateDeliveryIdByPickAddress' -> Updates deliveryId that matches pickAddress in order
*    'updateDeliveryIdByDeliveryAddress' -> Updates deliveryId that matches deliveryAddress in order
*    'updateDeliveryIdByQuarrelDescription' -> Updates deliveryId that matches quarrelDescription in order
*    'updateDeliveryIdByQuarrelPicture' -> Updates deliveryId that matches quarrelPicture in order
*    'updateDeliveryIdByReviewDescription' -> Updates deliveryId that matches reviewDescription in order
*    'updateDeliveryIdByReviewLevel' -> Updates deliveryId that matches reviewLevel in order
*    'updateDeliveryIdByDeliveryMoney' -> Updates deliveryId that matches deliveryMoney in order
*    'updateDeliveryIdByUserId' -> Updates deliveryId that matches userId in order
*    'updateDeliveryMoneyById' -> Updates deliveryMoney that matches id in order
*    'updateDeliveryMoneyByShop' -> Updates deliveryMoney that matches shop in order
*    'updateDeliveryMoneyByShopId' -> Updates deliveryMoney that matches shopId in order
*    'updateDeliveryMoneyByOrder' -> Updates deliveryMoney that matches order in order
*    'updateDeliveryMoneyByShipDate' -> Updates deliveryMoney that matches shipDate in order
*    'updateDeliveryMoneyByStatus' -> Updates deliveryMoney that matches Status in order
*    'updateDeliveryMoneyByPrice' -> Updates deliveryMoney that matches price in order
*    'updateDeliveryMoneyByPickAddress' -> Updates deliveryMoney that matches pickAddress in order
*    'updateDeliveryMoneyByDeliveryAddress' -> Updates deliveryMoney that matches deliveryAddress in order
*    'updateDeliveryMoneyByQuarrelDescription' -> Updates deliveryMoney that matches quarrelDescription in order
*    'updateDeliveryMoneyByQuarrelPicture' -> Updates deliveryMoney that matches quarrelPicture in order
*    'updateDeliveryMoneyByReviewDescription' -> Updates deliveryMoney that matches reviewDescription in order
*    'updateDeliveryMoneyByReviewLevel' -> Updates deliveryMoney that matches reviewLevel in order
*    'updateDeliveryMoneyByDeliveryId' -> Updates deliveryMoney that matches deliveryId in order
*    'updateDeliveryMoneyByUserId' -> Updates deliveryMoney that matches userId in order
*    'updateUserIdById' -> Updates userId that matches id in order
*    'updateUserIdByShop' -> Updates userId that matches shop in order
*    'updateUserIdByShopId' -> Updates userId that matches shopId in order
*    'updateUserIdByOrder' -> Updates userId that matches order in order
*    'updateUserIdByShipDate' -> Updates userId that matches shipDate in order
*    'updateUserIdByStatus' -> Updates userId that matches Status in order
*    'updateUserIdByPrice' -> Updates userId that matches price in order
*    'updateUserIdByPickAddress' -> Updates userId that matches pickAddress in order
*    'updateUserIdByDeliveryAddress' -> Updates userId that matches deliveryAddress in order
*    'updateUserIdByQuarrelDescription' -> Updates userId that matches quarrelDescription in order
*    'updateUserIdByQuarrelPicture' -> Updates userId that matches quarrelPicture in order
*    'updateUserIdByReviewDescription' -> Updates userId that matches reviewDescription in order
*    'updateUserIdByReviewLevel' -> Updates userId that matches reviewLevel in order
*    'updateUserIdByDeliveryId' -> Updates userId that matches deliveryId in order
*    'updateUserIdByDeliveryMoney' -> Updates userId that matches deliveryMoney in order
* \param $post['id'] (INT)  1 unique id for each order
* \param $post['shop'] (VARCHAR) Shoping name
* \param $post['shopId'] (INT) Shopping identifier
* \param $post['order'] (VARCHAR) What people asked for
* \param $post['shipDate'] (DATE) when people ordered it
* \param $post['Status'] (VARCHAR) If it's delivered or not
* \param $post['price'] (VARCHAR) total price of the order
* \param $post['pickAddress'] (VARCHAR) shopping location
* \param $post['deliveryAddress'] (VARCHAR) users location
* \param $post['quarrelDescription'] (VARCHAR) Description if there was a problem
* \param $post['quarrelPicture'] (VARCHAR) base64 picture if there was a problem
* \param $post['reviewDescription'] (VARCHAR) user's comments for shop reputation
* \param $post['reviewLevel'] (INT) How many stars users gave
* \param $post['deliveryId'] (INT) Id of the delivery guy
* \param $post['deliveryMoney'] (VARCHAR) How much of price goes to delivery
* \param $post['userId'] (INT) Id of the user that ordered
* \return $result['response'] (array) An array with the requested order information.
*    ['id'] (INT)  1 unique id for each order
*    ['shop'] (VARCHAR) Shoping name
*    ['shopId'] (INT) Shopping identifier
*    ['order'] (VARCHAR) What people asked for
*    ['shipDate'] (DATE) when people ordered it
*    ['Status'] (VARCHAR) If it's delivered or not
*    ['price'] (VARCHAR) total price of the order
*    ['pickAddress'] (VARCHAR) shopping location
*    ['deliveryAddress'] (VARCHAR) users location
*    ['quarrelDescription'] (VARCHAR) Description if there was a problem
*    ['quarrelPicture'] (VARCHAR) base64 picture if there was a problem
*    ['reviewDescription'] (VARCHAR) user's comments for shop reputation
*    ['reviewLevel'] (INT) How many stars users gave
*    ['deliveryId'] (INT) Id of the delivery guy
*    ['deliveryMoney'] (VARCHAR) How much of price goes to delivery
*    ['userId'] (INT) Id of the user that ordered
* \return $result['success'] (bool) Returns true if the request was succesful, false if not.
* \return $result['msg'] (string) Returns a message explaining the status of the execution.
*   'order uploaded.' -> When the execution was successful, the order information was uploaded in the database.
*   'This order could not be uploaded. Try again later.' -> When the call fails, it could be because it couldn't connect to the database. 
*   'This order row is already in the database.' -> When trying to insert something that already exists inside the database.
*   'Updated' -> When the updateing execution was successful, the order information was updated in the database.
*   'We couldn't update. Try again later' -> When the update fails, it could be because it couldn't connect to the database. 
*   'We couldn't find what you are trying to update.' -> When the information of order you want to update does not exist or it is not found in the database.
*   'order row deleted' -> When was able to delete the fetched order row/rows.
*   'It was not possible to erase the order. Try again later' -> When it fails to eliminate the order row/rows.
*   'Thisorder row did not exist.' -> When the order row was not found or did not exist.
*   'No id/shop/shopId/order/shipDate/Status/price/pickAddress/deliveryAddress/quarrelDescription/quarrelPicture/reviewDescription/reviewLevel/deliveryId/deliveryMoney/userId/ to set.' -> When one of the required parameters is missing.
*   'No selection to delete.' -> When $post['selection'] is missing (in method deleteBySelection).
*   'No selection to update.' -> When $post['selection'] is missing (in method update...BySelection).
*   'No valid case selected' -> When a method that does not exist is selected (in the default of the switch). 
*/  
function postFunctions($post) {
    switch ($post['method']) {
        
        case 'setAll':
            debug('I am inside the post method setAll <br>');
            include_once 'functions/write/setAll.php';
            $result = setAll($post['id'], $post['shop'], $post['shopId'], $post['order'], $post['shipDate'], $post['Status'], $post['price'], $post['pickAddress'], $post['deliveryAddress'], $post['quarrelDescription'], $post['quarrelPicture'], $post['reviewDescription'], $post['reviewLevel'], $post['deliveryId'], $post['deliveryMoney'], $post['userId']);
            break;
        
        case 'deleteAll':
            debug('I am inside the post method deleteAll <br>');
            include_once 'functions/delete/deleteAll.php';
            $result = deleteAll();
            break;
        
        case 'deleteById':
            debug('I am inside the post method deleteById <br>');
            include_once 'functions/delete/deleteById.php';
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to delete.';
                break;
            }
            $result = deleteById($post['id']);
            break;
        
        case 'deleteByShop':
            debug('I am inside the post method deleteByShop <br>');
            include_once 'functions/delete/deleteByShop.php';
            if(!isset($post['shop'])) {
                $result['success'] = false;
                $result['msg'] = 'No shop to delete.';
                break;
            }
            $result = deleteByShop($post['shop']);
            break;
        
        case 'deleteByShopId':
            debug('I am inside the post method deleteByShopId <br>');
            include_once 'functions/delete/deleteByShopId.php';
            if(!isset($post['shopId'])) {
                $result['success'] = false;
                $result['msg'] = 'No shopId to delete.';
                break;
            }
            $result = deleteByShopId($post['shopId']);
            break;
        
        case 'deleteByOrder':
            debug('I am inside the post method deleteByOrder <br>');
            include_once 'functions/delete/deleteByOrder.php';
            if(!isset($post['order'])) {
                $result['success'] = false;
                $result['msg'] = 'No order to delete.';
                break;
            }
            $result = deleteByOrder($post['order']);
            break;
        
        case 'deleteByShipDate':
            debug('I am inside the post method deleteByShipDate <br>');
            include_once 'functions/delete/deleteByShipDate.php';
            if(!isset($post['shipDate'])) {
                $result['success'] = false;
                $result['msg'] = 'No shipDate to delete.';
                break;
            }
            $result = deleteByShipDate($post['shipDate']);
            break;
        
        case 'deleteByStatus':
            debug('I am inside the post method deleteByStatus <br>');
            include_once 'functions/delete/deleteByStatus.php';
            if(!isset($post['Status'])) {
                $result['success'] = false;
                $result['msg'] = 'No Status to delete.';
                break;
            }
            $result = deleteByStatus($post['Status']);
            break;
        
        case 'deleteByPrice':
            debug('I am inside the post method deleteByPrice <br>');
            include_once 'functions/delete/deleteByPrice.php';
            if(!isset($post['price'])) {
                $result['success'] = false;
                $result['msg'] = 'No price to delete.';
                break;
            }
            $result = deleteByPrice($post['price']);
            break;
        
        case 'deleteByPickAddress':
            debug('I am inside the post method deleteByPickAddress <br>');
            include_once 'functions/delete/deleteByPickAddress.php';
            if(!isset($post['pickAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No pickAddress to delete.';
                break;
            }
            $result = deleteByPickAddress($post['pickAddress']);
            break;
        
        case 'deleteByDeliveryAddress':
            debug('I am inside the post method deleteByDeliveryAddress <br>');
            include_once 'functions/delete/deleteByDeliveryAddress.php';
            if(!isset($post['deliveryAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryAddress to delete.';
                break;
            }
            $result = deleteByDeliveryAddress($post['deliveryAddress']);
            break;
        
        case 'deleteByQuarrelDescription':
            debug('I am inside the post method deleteByQuarrelDescription <br>');
            include_once 'functions/delete/deleteByQuarrelDescription.php';
            if(!isset($post['quarrelDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelDescription to delete.';
                break;
            }
            $result = deleteByQuarrelDescription($post['quarrelDescription']);
            break;
        
        case 'deleteByQuarrelPicture':
            debug('I am inside the post method deleteByQuarrelPicture <br>');
            include_once 'functions/delete/deleteByQuarrelPicture.php';
            if(!isset($post['quarrelPicture'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelPicture to delete.';
                break;
            }
            $result = deleteByQuarrelPicture($post['quarrelPicture']);
            break;
        
        case 'deleteByReviewDescription':
            debug('I am inside the post method deleteByReviewDescription <br>');
            include_once 'functions/delete/deleteByReviewDescription.php';
            if(!isset($post['reviewDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewDescription to delete.';
                break;
            }
            $result = deleteByReviewDescription($post['reviewDescription']);
            break;
        
        case 'deleteByReviewLevel':
            debug('I am inside the post method deleteByReviewLevel <br>');
            include_once 'functions/delete/deleteByReviewLevel.php';
            if(!isset($post['reviewLevel'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewLevel to delete.';
                break;
            }
            $result = deleteByReviewLevel($post['reviewLevel']);
            break;
        
        case 'deleteByDeliveryId':
            debug('I am inside the post method deleteByDeliveryId <br>');
            include_once 'functions/delete/deleteByDeliveryId.php';
            if(!isset($post['deliveryId'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryId to delete.';
                break;
            }
            $result = deleteByDeliveryId($post['deliveryId']);
            break;
        
        case 'deleteByDeliveryMoney':
            debug('I am inside the post method deleteByDeliveryMoney <br>');
            include_once 'functions/delete/deleteByDeliveryMoney.php';
            if(!isset($post['deliveryMoney'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryMoney to delete.';
                break;
            }
            $result = deleteByDeliveryMoney($post['deliveryMoney']);
            break;
        
        case 'deleteByUserId':
            debug('I am inside the post method deleteByUserId <br>');
            include_once 'functions/delete/deleteByUserId.php';
            if(!isset($post['userId'])) {
                $result['success'] = false;
                $result['msg'] = 'No userId to delete.';
                break;
            }
            $result = deleteByUserId($post['userId']);
            break;
        
        case 'updateAllById':
            debug('I am inside the post method updateAllById <br>');
            include_once 'functions/update/updateAllById.php';
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updateAllById($post['id'], $post['shop'], $post['shopId'], $post['order'], $post['shipDate'], $post['Status'], $post['price'], $post['pickAddress'], $post['deliveryAddress'], $post['quarrelDescription'], $post['quarrelPicture'], $post['reviewDescription'], $post['reviewLevel'], $post['deliveryId'], $post['deliveryMoney'], $post['userId']);
            break;
        
        case 'updateAllByShop':
            debug('I am inside the post method updateAllByShop <br>');
            include_once 'functions/update/updateAllByShop.php';
            if(!isset($post['shop'])) {
                $result['success'] = false;
                $result['msg'] = 'No shop to update.';
                break;
            }
            $result = updateAllByShop($post['id'], $post['shop'], $post['shopId'], $post['order'], $post['shipDate'], $post['Status'], $post['price'], $post['pickAddress'], $post['deliveryAddress'], $post['quarrelDescription'], $post['quarrelPicture'], $post['reviewDescription'], $post['reviewLevel'], $post['deliveryId'], $post['deliveryMoney'], $post['userId']);
            break;
        
        case 'updateAllByShopId':
            debug('I am inside the post method updateAllByShopId <br>');
            include_once 'functions/update/updateAllByShopId.php';
            if(!isset($post['shopId'])) {
                $result['success'] = false;
                $result['msg'] = 'No shopId to update.';
                break;
            }
            $result = updateAllByShopId($post['id'], $post['shop'], $post['shopId'], $post['order'], $post['shipDate'], $post['Status'], $post['price'], $post['pickAddress'], $post['deliveryAddress'], $post['quarrelDescription'], $post['quarrelPicture'], $post['reviewDescription'], $post['reviewLevel'], $post['deliveryId'], $post['deliveryMoney'], $post['userId']);
            break;
        
        case 'updateAllByOrder':
            debug('I am inside the post method updateAllByOrder <br>');
            include_once 'functions/update/updateAllByOrder.php';
            if(!isset($post['order'])) {
                $result['success'] = false;
                $result['msg'] = 'No order to update.';
                break;
            }
            $result = updateAllByOrder($post['id'], $post['shop'], $post['shopId'], $post['order'], $post['shipDate'], $post['Status'], $post['price'], $post['pickAddress'], $post['deliveryAddress'], $post['quarrelDescription'], $post['quarrelPicture'], $post['reviewDescription'], $post['reviewLevel'], $post['deliveryId'], $post['deliveryMoney'], $post['userId']);
            break;
        
        case 'updateAllByShipDate':
            debug('I am inside the post method updateAllByShipDate <br>');
            include_once 'functions/update/updateAllByShipDate.php';
            if(!isset($post['shipDate'])) {
                $result['success'] = false;
                $result['msg'] = 'No shipDate to update.';
                break;
            }
            $result = updateAllByShipDate($post['id'], $post['shop'], $post['shopId'], $post['order'], $post['shipDate'], $post['Status'], $post['price'], $post['pickAddress'], $post['deliveryAddress'], $post['quarrelDescription'], $post['quarrelPicture'], $post['reviewDescription'], $post['reviewLevel'], $post['deliveryId'], $post['deliveryMoney'], $post['userId']);
            break;
        
        case 'updateAllByStatus':
            debug('I am inside the post method updateAllByStatus <br>');
            include_once 'functions/update/updateAllByStatus.php';
            if(!isset($post['Status'])) {
                $result['success'] = false;
                $result['msg'] = 'No Status to update.';
                break;
            }
            $result = updateAllByStatus($post['id'], $post['shop'], $post['shopId'], $post['order'], $post['shipDate'], $post['Status'], $post['price'], $post['pickAddress'], $post['deliveryAddress'], $post['quarrelDescription'], $post['quarrelPicture'], $post['reviewDescription'], $post['reviewLevel'], $post['deliveryId'], $post['deliveryMoney'], $post['userId']);
            break;
        
        case 'updateAllByPrice':
            debug('I am inside the post method updateAllByPrice <br>');
            include_once 'functions/update/updateAllByPrice.php';
            if(!isset($post['price'])) {
                $result['success'] = false;
                $result['msg'] = 'No price to update.';
                break;
            }
            $result = updateAllByPrice($post['id'], $post['shop'], $post['shopId'], $post['order'], $post['shipDate'], $post['Status'], $post['price'], $post['pickAddress'], $post['deliveryAddress'], $post['quarrelDescription'], $post['quarrelPicture'], $post['reviewDescription'], $post['reviewLevel'], $post['deliveryId'], $post['deliveryMoney'], $post['userId']);
            break;
        
        case 'updateAllByPickAddress':
            debug('I am inside the post method updateAllByPickAddress <br>');
            include_once 'functions/update/updateAllByPickAddress.php';
            if(!isset($post['pickAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No pickAddress to update.';
                break;
            }
            $result = updateAllByPickAddress($post['id'], $post['shop'], $post['shopId'], $post['order'], $post['shipDate'], $post['Status'], $post['price'], $post['pickAddress'], $post['deliveryAddress'], $post['quarrelDescription'], $post['quarrelPicture'], $post['reviewDescription'], $post['reviewLevel'], $post['deliveryId'], $post['deliveryMoney'], $post['userId']);
            break;
        
        case 'updateAllByDeliveryAddress':
            debug('I am inside the post method updateAllByDeliveryAddress <br>');
            include_once 'functions/update/updateAllByDeliveryAddress.php';
            if(!isset($post['deliveryAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryAddress to update.';
                break;
            }
            $result = updateAllByDeliveryAddress($post['id'], $post['shop'], $post['shopId'], $post['order'], $post['shipDate'], $post['Status'], $post['price'], $post['pickAddress'], $post['deliveryAddress'], $post['quarrelDescription'], $post['quarrelPicture'], $post['reviewDescription'], $post['reviewLevel'], $post['deliveryId'], $post['deliveryMoney'], $post['userId']);
            break;
        
        case 'updateAllByQuarrelDescription':
            debug('I am inside the post method updateAllByQuarrelDescription <br>');
            include_once 'functions/update/updateAllByQuarrelDescription.php';
            if(!isset($post['quarrelDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelDescription to update.';
                break;
            }
            $result = updateAllByQuarrelDescription($post['id'], $post['shop'], $post['shopId'], $post['order'], $post['shipDate'], $post['Status'], $post['price'], $post['pickAddress'], $post['deliveryAddress'], $post['quarrelDescription'], $post['quarrelPicture'], $post['reviewDescription'], $post['reviewLevel'], $post['deliveryId'], $post['deliveryMoney'], $post['userId']);
            break;
        
        case 'updateAllByQuarrelPicture':
            debug('I am inside the post method updateAllByQuarrelPicture <br>');
            include_once 'functions/update/updateAllByQuarrelPicture.php';
            if(!isset($post['quarrelPicture'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelPicture to update.';
                break;
            }
            $result = updateAllByQuarrelPicture($post['id'], $post['shop'], $post['shopId'], $post['order'], $post['shipDate'], $post['Status'], $post['price'], $post['pickAddress'], $post['deliveryAddress'], $post['quarrelDescription'], $post['quarrelPicture'], $post['reviewDescription'], $post['reviewLevel'], $post['deliveryId'], $post['deliveryMoney'], $post['userId']);
            break;
        
        case 'updateAllByReviewDescription':
            debug('I am inside the post method updateAllByReviewDescription <br>');
            include_once 'functions/update/updateAllByReviewDescription.php';
            if(!isset($post['reviewDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewDescription to update.';
                break;
            }
            $result = updateAllByReviewDescription($post['id'], $post['shop'], $post['shopId'], $post['order'], $post['shipDate'], $post['Status'], $post['price'], $post['pickAddress'], $post['deliveryAddress'], $post['quarrelDescription'], $post['quarrelPicture'], $post['reviewDescription'], $post['reviewLevel'], $post['deliveryId'], $post['deliveryMoney'], $post['userId']);
            break;
        
        case 'updateAllByReviewLevel':
            debug('I am inside the post method updateAllByReviewLevel <br>');
            include_once 'functions/update/updateAllByReviewLevel.php';
            if(!isset($post['reviewLevel'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewLevel to update.';
                break;
            }
            $result = updateAllByReviewLevel($post['id'], $post['shop'], $post['shopId'], $post['order'], $post['shipDate'], $post['Status'], $post['price'], $post['pickAddress'], $post['deliveryAddress'], $post['quarrelDescription'], $post['quarrelPicture'], $post['reviewDescription'], $post['reviewLevel'], $post['deliveryId'], $post['deliveryMoney'], $post['userId']);
            break;
        
        case 'updateAllByDeliveryId':
            debug('I am inside the post method updateAllByDeliveryId <br>');
            include_once 'functions/update/updateAllByDeliveryId.php';
            if(!isset($post['deliveryId'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryId to update.';
                break;
            }
            $result = updateAllByDeliveryId($post['id'], $post['shop'], $post['shopId'], $post['order'], $post['shipDate'], $post['Status'], $post['price'], $post['pickAddress'], $post['deliveryAddress'], $post['quarrelDescription'], $post['quarrelPicture'], $post['reviewDescription'], $post['reviewLevel'], $post['deliveryId'], $post['deliveryMoney'], $post['userId']);
            break;
        
        case 'updateAllByDeliveryMoney':
            debug('I am inside the post method updateAllByDeliveryMoney <br>');
            include_once 'functions/update/updateAllByDeliveryMoney.php';
            if(!isset($post['deliveryMoney'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryMoney to update.';
                break;
            }
            $result = updateAllByDeliveryMoney($post['id'], $post['shop'], $post['shopId'], $post['order'], $post['shipDate'], $post['Status'], $post['price'], $post['pickAddress'], $post['deliveryAddress'], $post['quarrelDescription'], $post['quarrelPicture'], $post['reviewDescription'], $post['reviewLevel'], $post['deliveryId'], $post['deliveryMoney'], $post['userId']);
            break;
        
        case 'updateAllByUserId':
            debug('I am inside the post method updateAllByUserId <br>');
            include_once 'functions/update/updateAllByUserId.php';
            if(!isset($post['userId'])) {
                $result['success'] = false;
                $result['msg'] = 'No userId to update.';
                break;
            }
            $result = updateAllByUserId($post['id'], $post['shop'], $post['shopId'], $post['order'], $post['shipDate'], $post['Status'], $post['price'], $post['pickAddress'], $post['deliveryAddress'], $post['quarrelDescription'], $post['quarrelPicture'], $post['reviewDescription'], $post['reviewLevel'], $post['deliveryId'], $post['deliveryMoney'], $post['userId']);
            break;
        
        case 'updateShopById':
            debug('I am inside the post method updateShopById <br>');
            include_once 'functions/update/updateShopById.php';
            if(!isset($post['shop'])) {
                $result['success'] = false;
                $result['msg'] = 'No shop to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updateShopById($post['id'],$post['shop']);
            break;
        
        case 'updateShopByShopId':
            debug('I am inside the post method updateShopByShopId <br>');
            include_once 'functions/update/updateShopByShopId.php';
            if(!isset($post['shop'])) {
                $result['success'] = false;
                $result['msg'] = 'No shop to update.';
                break;
            }
            if(!isset($post['shopId'])) {
                $result['success'] = false;
                $result['msg'] = 'No shopId to update.';
                break;
            }
            $result = updateShopByShopId($post['shopId'],$post['shop']);
            break;
        
        case 'updateShopByOrder':
            debug('I am inside the post method updateShopByOrder <br>');
            include_once 'functions/update/updateShopByOrder.php';
            if(!isset($post['shop'])) {
                $result['success'] = false;
                $result['msg'] = 'No shop to update.';
                break;
            }
            if(!isset($post['order'])) {
                $result['success'] = false;
                $result['msg'] = 'No order to update.';
                break;
            }
            $result = updateShopByOrder($post['order'],$post['shop']);
            break;
        
        case 'updateShopByShipDate':
            debug('I am inside the post method updateShopByShipDate <br>');
            include_once 'functions/update/updateShopByShipDate.php';
            if(!isset($post['shop'])) {
                $result['success'] = false;
                $result['msg'] = 'No shop to update.';
                break;
            }
            if(!isset($post['shipDate'])) {
                $result['success'] = false;
                $result['msg'] = 'No shipDate to update.';
                break;
            }
            $result = updateShopByShipDate($post['shipDate'],$post['shop']);
            break;
        
        case 'updateShopByStatus':
            debug('I am inside the post method updateShopByStatus <br>');
            include_once 'functions/update/updateShopByStatus.php';
            if(!isset($post['shop'])) {
                $result['success'] = false;
                $result['msg'] = 'No shop to update.';
                break;
            }
            if(!isset($post['Status'])) {
                $result['success'] = false;
                $result['msg'] = 'No Status to update.';
                break;
            }
            $result = updateShopByStatus($post['Status'],$post['shop']);
            break;
        
        case 'updateShopByPrice':
            debug('I am inside the post method updateShopByPrice <br>');
            include_once 'functions/update/updateShopByPrice.php';
            if(!isset($post['shop'])) {
                $result['success'] = false;
                $result['msg'] = 'No shop to update.';
                break;
            }
            if(!isset($post['price'])) {
                $result['success'] = false;
                $result['msg'] = 'No price to update.';
                break;
            }
            $result = updateShopByPrice($post['price'],$post['shop']);
            break;
        
        case 'updateShopByPickAddress':
            debug('I am inside the post method updateShopByPickAddress <br>');
            include_once 'functions/update/updateShopByPickAddress.php';
            if(!isset($post['shop'])) {
                $result['success'] = false;
                $result['msg'] = 'No shop to update.';
                break;
            }
            if(!isset($post['pickAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No pickAddress to update.';
                break;
            }
            $result = updateShopByPickAddress($post['pickAddress'],$post['shop']);
            break;
        
        case 'updateShopByDeliveryAddress':
            debug('I am inside the post method updateShopByDeliveryAddress <br>');
            include_once 'functions/update/updateShopByDeliveryAddress.php';
            if(!isset($post['shop'])) {
                $result['success'] = false;
                $result['msg'] = 'No shop to update.';
                break;
            }
            if(!isset($post['deliveryAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryAddress to update.';
                break;
            }
            $result = updateShopByDeliveryAddress($post['deliveryAddress'],$post['shop']);
            break;
        
        case 'updateShopByQuarrelDescription':
            debug('I am inside the post method updateShopByQuarrelDescription <br>');
            include_once 'functions/update/updateShopByQuarrelDescription.php';
            if(!isset($post['shop'])) {
                $result['success'] = false;
                $result['msg'] = 'No shop to update.';
                break;
            }
            if(!isset($post['quarrelDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelDescription to update.';
                break;
            }
            $result = updateShopByQuarrelDescription($post['quarrelDescription'],$post['shop']);
            break;
        
        case 'updateShopByQuarrelPicture':
            debug('I am inside the post method updateShopByQuarrelPicture <br>');
            include_once 'functions/update/updateShopByQuarrelPicture.php';
            if(!isset($post['shop'])) {
                $result['success'] = false;
                $result['msg'] = 'No shop to update.';
                break;
            }
            if(!isset($post['quarrelPicture'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelPicture to update.';
                break;
            }
            $result = updateShopByQuarrelPicture($post['quarrelPicture'],$post['shop']);
            break;
        
        case 'updateShopByReviewDescription':
            debug('I am inside the post method updateShopByReviewDescription <br>');
            include_once 'functions/update/updateShopByReviewDescription.php';
            if(!isset($post['shop'])) {
                $result['success'] = false;
                $result['msg'] = 'No shop to update.';
                break;
            }
            if(!isset($post['reviewDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewDescription to update.';
                break;
            }
            $result = updateShopByReviewDescription($post['reviewDescription'],$post['shop']);
            break;
        
        case 'updateShopByReviewLevel':
            debug('I am inside the post method updateShopByReviewLevel <br>');
            include_once 'functions/update/updateShopByReviewLevel.php';
            if(!isset($post['shop'])) {
                $result['success'] = false;
                $result['msg'] = 'No shop to update.';
                break;
            }
            if(!isset($post['reviewLevel'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewLevel to update.';
                break;
            }
            $result = updateShopByReviewLevel($post['reviewLevel'],$post['shop']);
            break;
        
        case 'updateShopByDeliveryId':
            debug('I am inside the post method updateShopByDeliveryId <br>');
            include_once 'functions/update/updateShopByDeliveryId.php';
            if(!isset($post['shop'])) {
                $result['success'] = false;
                $result['msg'] = 'No shop to update.';
                break;
            }
            if(!isset($post['deliveryId'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryId to update.';
                break;
            }
            $result = updateShopByDeliveryId($post['deliveryId'],$post['shop']);
            break;
        
        case 'updateShopByDeliveryMoney':
            debug('I am inside the post method updateShopByDeliveryMoney <br>');
            include_once 'functions/update/updateShopByDeliveryMoney.php';
            if(!isset($post['shop'])) {
                $result['success'] = false;
                $result['msg'] = 'No shop to update.';
                break;
            }
            if(!isset($post['deliveryMoney'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryMoney to update.';
                break;
            }
            $result = updateShopByDeliveryMoney($post['deliveryMoney'],$post['shop']);
            break;
        
        case 'updateShopByUserId':
            debug('I am inside the post method updateShopByUserId <br>');
            include_once 'functions/update/updateShopByUserId.php';
            if(!isset($post['shop'])) {
                $result['success'] = false;
                $result['msg'] = 'No shop to update.';
                break;
            }
            if(!isset($post['userId'])) {
                $result['success'] = false;
                $result['msg'] = 'No userId to update.';
                break;
            }
            $result = updateShopByUserId($post['userId'],$post['shop']);
            break;
        
        case 'updateShopIdById':
            debug('I am inside the post method updateShopIdById <br>');
            include_once 'functions/update/updateShopIdById.php';
            if(!isset($post['shopId'])) {
                $result['success'] = false;
                $result['msg'] = 'No shopId to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updateShopIdById($post['id'],$post['shopId']);
            break;
        
        case 'updateShopIdByShop':
            debug('I am inside the post method updateShopIdByShop <br>');
            include_once 'functions/update/updateShopIdByShop.php';
            if(!isset($post['shopId'])) {
                $result['success'] = false;
                $result['msg'] = 'No shopId to update.';
                break;
            }
            if(!isset($post['shop'])) {
                $result['success'] = false;
                $result['msg'] = 'No shop to update.';
                break;
            }
            $result = updateShopIdByShop($post['shop'],$post['shopId']);
            break;
        
        case 'updateShopIdByOrder':
            debug('I am inside the post method updateShopIdByOrder <br>');
            include_once 'functions/update/updateShopIdByOrder.php';
            if(!isset($post['shopId'])) {
                $result['success'] = false;
                $result['msg'] = 'No shopId to update.';
                break;
            }
            if(!isset($post['order'])) {
                $result['success'] = false;
                $result['msg'] = 'No order to update.';
                break;
            }
            $result = updateShopIdByOrder($post['order'],$post['shopId']);
            break;
        
        case 'updateShopIdByShipDate':
            debug('I am inside the post method updateShopIdByShipDate <br>');
            include_once 'functions/update/updateShopIdByShipDate.php';
            if(!isset($post['shopId'])) {
                $result['success'] = false;
                $result['msg'] = 'No shopId to update.';
                break;
            }
            if(!isset($post['shipDate'])) {
                $result['success'] = false;
                $result['msg'] = 'No shipDate to update.';
                break;
            }
            $result = updateShopIdByShipDate($post['shipDate'],$post['shopId']);
            break;
        
        case 'updateShopIdByStatus':
            debug('I am inside the post method updateShopIdByStatus <br>');
            include_once 'functions/update/updateShopIdByStatus.php';
            if(!isset($post['shopId'])) {
                $result['success'] = false;
                $result['msg'] = 'No shopId to update.';
                break;
            }
            if(!isset($post['Status'])) {
                $result['success'] = false;
                $result['msg'] = 'No Status to update.';
                break;
            }
            $result = updateShopIdByStatus($post['Status'],$post['shopId']);
            break;
        
        case 'updateShopIdByPrice':
            debug('I am inside the post method updateShopIdByPrice <br>');
            include_once 'functions/update/updateShopIdByPrice.php';
            if(!isset($post['shopId'])) {
                $result['success'] = false;
                $result['msg'] = 'No shopId to update.';
                break;
            }
            if(!isset($post['price'])) {
                $result['success'] = false;
                $result['msg'] = 'No price to update.';
                break;
            }
            $result = updateShopIdByPrice($post['price'],$post['shopId']);
            break;
        
        case 'updateShopIdByPickAddress':
            debug('I am inside the post method updateShopIdByPickAddress <br>');
            include_once 'functions/update/updateShopIdByPickAddress.php';
            if(!isset($post['shopId'])) {
                $result['success'] = false;
                $result['msg'] = 'No shopId to update.';
                break;
            }
            if(!isset($post['pickAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No pickAddress to update.';
                break;
            }
            $result = updateShopIdByPickAddress($post['pickAddress'],$post['shopId']);
            break;
        
        case 'updateShopIdByDeliveryAddress':
            debug('I am inside the post method updateShopIdByDeliveryAddress <br>');
            include_once 'functions/update/updateShopIdByDeliveryAddress.php';
            if(!isset($post['shopId'])) {
                $result['success'] = false;
                $result['msg'] = 'No shopId to update.';
                break;
            }
            if(!isset($post['deliveryAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryAddress to update.';
                break;
            }
            $result = updateShopIdByDeliveryAddress($post['deliveryAddress'],$post['shopId']);
            break;
        
        case 'updateShopIdByQuarrelDescription':
            debug('I am inside the post method updateShopIdByQuarrelDescription <br>');
            include_once 'functions/update/updateShopIdByQuarrelDescription.php';
            if(!isset($post['shopId'])) {
                $result['success'] = false;
                $result['msg'] = 'No shopId to update.';
                break;
            }
            if(!isset($post['quarrelDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelDescription to update.';
                break;
            }
            $result = updateShopIdByQuarrelDescription($post['quarrelDescription'],$post['shopId']);
            break;
        
        case 'updateShopIdByQuarrelPicture':
            debug('I am inside the post method updateShopIdByQuarrelPicture <br>');
            include_once 'functions/update/updateShopIdByQuarrelPicture.php';
            if(!isset($post['shopId'])) {
                $result['success'] = false;
                $result['msg'] = 'No shopId to update.';
                break;
            }
            if(!isset($post['quarrelPicture'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelPicture to update.';
                break;
            }
            $result = updateShopIdByQuarrelPicture($post['quarrelPicture'],$post['shopId']);
            break;
        
        case 'updateShopIdByReviewDescription':
            debug('I am inside the post method updateShopIdByReviewDescription <br>');
            include_once 'functions/update/updateShopIdByReviewDescription.php';
            if(!isset($post['shopId'])) {
                $result['success'] = false;
                $result['msg'] = 'No shopId to update.';
                break;
            }
            if(!isset($post['reviewDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewDescription to update.';
                break;
            }
            $result = updateShopIdByReviewDescription($post['reviewDescription'],$post['shopId']);
            break;
        
        case 'updateShopIdByReviewLevel':
            debug('I am inside the post method updateShopIdByReviewLevel <br>');
            include_once 'functions/update/updateShopIdByReviewLevel.php';
            if(!isset($post['shopId'])) {
                $result['success'] = false;
                $result['msg'] = 'No shopId to update.';
                break;
            }
            if(!isset($post['reviewLevel'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewLevel to update.';
                break;
            }
            $result = updateShopIdByReviewLevel($post['reviewLevel'],$post['shopId']);
            break;
        
        case 'updateShopIdByDeliveryId':
            debug('I am inside the post method updateShopIdByDeliveryId <br>');
            include_once 'functions/update/updateShopIdByDeliveryId.php';
            if(!isset($post['shopId'])) {
                $result['success'] = false;
                $result['msg'] = 'No shopId to update.';
                break;
            }
            if(!isset($post['deliveryId'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryId to update.';
                break;
            }
            $result = updateShopIdByDeliveryId($post['deliveryId'],$post['shopId']);
            break;
        
        case 'updateShopIdByDeliveryMoney':
            debug('I am inside the post method updateShopIdByDeliveryMoney <br>');
            include_once 'functions/update/updateShopIdByDeliveryMoney.php';
            if(!isset($post['shopId'])) {
                $result['success'] = false;
                $result['msg'] = 'No shopId to update.';
                break;
            }
            if(!isset($post['deliveryMoney'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryMoney to update.';
                break;
            }
            $result = updateShopIdByDeliveryMoney($post['deliveryMoney'],$post['shopId']);
            break;
        
        case 'updateShopIdByUserId':
            debug('I am inside the post method updateShopIdByUserId <br>');
            include_once 'functions/update/updateShopIdByUserId.php';
            if(!isset($post['shopId'])) {
                $result['success'] = false;
                $result['msg'] = 'No shopId to update.';
                break;
            }
            if(!isset($post['userId'])) {
                $result['success'] = false;
                $result['msg'] = 'No userId to update.';
                break;
            }
            $result = updateShopIdByUserId($post['userId'],$post['shopId']);
            break;
        
        case 'updateOrderById':
            debug('I am inside the post method updateOrderById <br>');
            include_once 'functions/update/updateOrderById.php';
            if(!isset($post['order'])) {
                $result['success'] = false;
                $result['msg'] = 'No order to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updateOrderById($post['id'],$post['order']);
            break;
        
        case 'updateOrderByShop':
            debug('I am inside the post method updateOrderByShop <br>');
            include_once 'functions/update/updateOrderByShop.php';
            if(!isset($post['order'])) {
                $result['success'] = false;
                $result['msg'] = 'No order to update.';
                break;
            }
            if(!isset($post['shop'])) {
                $result['success'] = false;
                $result['msg'] = 'No shop to update.';
                break;
            }
            $result = updateOrderByShop($post['shop'],$post['order']);
            break;
        
        case 'updateOrderByShopId':
            debug('I am inside the post method updateOrderByShopId <br>');
            include_once 'functions/update/updateOrderByShopId.php';
            if(!isset($post['order'])) {
                $result['success'] = false;
                $result['msg'] = 'No order to update.';
                break;
            }
            if(!isset($post['shopId'])) {
                $result['success'] = false;
                $result['msg'] = 'No shopId to update.';
                break;
            }
            $result = updateOrderByShopId($post['shopId'],$post['order']);
            break;
        
        case 'updateOrderByShipDate':
            debug('I am inside the post method updateOrderByShipDate <br>');
            include_once 'functions/update/updateOrderByShipDate.php';
            if(!isset($post['order'])) {
                $result['success'] = false;
                $result['msg'] = 'No order to update.';
                break;
            }
            if(!isset($post['shipDate'])) {
                $result['success'] = false;
                $result['msg'] = 'No shipDate to update.';
                break;
            }
            $result = updateOrderByShipDate($post['shipDate'],$post['order']);
            break;
        
        case 'updateOrderByStatus':
            debug('I am inside the post method updateOrderByStatus <br>');
            include_once 'functions/update/updateOrderByStatus.php';
            if(!isset($post['order'])) {
                $result['success'] = false;
                $result['msg'] = 'No order to update.';
                break;
            }
            if(!isset($post['Status'])) {
                $result['success'] = false;
                $result['msg'] = 'No Status to update.';
                break;
            }
            $result = updateOrderByStatus($post['Status'],$post['order']);
            break;
        
        case 'updateOrderByPrice':
            debug('I am inside the post method updateOrderByPrice <br>');
            include_once 'functions/update/updateOrderByPrice.php';
            if(!isset($post['order'])) {
                $result['success'] = false;
                $result['msg'] = 'No order to update.';
                break;
            }
            if(!isset($post['price'])) {
                $result['success'] = false;
                $result['msg'] = 'No price to update.';
                break;
            }
            $result = updateOrderByPrice($post['price'],$post['order']);
            break;
        
        case 'updateOrderByPickAddress':
            debug('I am inside the post method updateOrderByPickAddress <br>');
            include_once 'functions/update/updateOrderByPickAddress.php';
            if(!isset($post['order'])) {
                $result['success'] = false;
                $result['msg'] = 'No order to update.';
                break;
            }
            if(!isset($post['pickAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No pickAddress to update.';
                break;
            }
            $result = updateOrderByPickAddress($post['pickAddress'],$post['order']);
            break;
        
        case 'updateOrderByDeliveryAddress':
            debug('I am inside the post method updateOrderByDeliveryAddress <br>');
            include_once 'functions/update/updateOrderByDeliveryAddress.php';
            if(!isset($post['order'])) {
                $result['success'] = false;
                $result['msg'] = 'No order to update.';
                break;
            }
            if(!isset($post['deliveryAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryAddress to update.';
                break;
            }
            $result = updateOrderByDeliveryAddress($post['deliveryAddress'],$post['order']);
            break;
        
        case 'updateOrderByQuarrelDescription':
            debug('I am inside the post method updateOrderByQuarrelDescription <br>');
            include_once 'functions/update/updateOrderByQuarrelDescription.php';
            if(!isset($post['order'])) {
                $result['success'] = false;
                $result['msg'] = 'No order to update.';
                break;
            }
            if(!isset($post['quarrelDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelDescription to update.';
                break;
            }
            $result = updateOrderByQuarrelDescription($post['quarrelDescription'],$post['order']);
            break;
        
        case 'updateOrderByQuarrelPicture':
            debug('I am inside the post method updateOrderByQuarrelPicture <br>');
            include_once 'functions/update/updateOrderByQuarrelPicture.php';
            if(!isset($post['order'])) {
                $result['success'] = false;
                $result['msg'] = 'No order to update.';
                break;
            }
            if(!isset($post['quarrelPicture'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelPicture to update.';
                break;
            }
            $result = updateOrderByQuarrelPicture($post['quarrelPicture'],$post['order']);
            break;
        
        case 'updateOrderByReviewDescription':
            debug('I am inside the post method updateOrderByReviewDescription <br>');
            include_once 'functions/update/updateOrderByReviewDescription.php';
            if(!isset($post['order'])) {
                $result['success'] = false;
                $result['msg'] = 'No order to update.';
                break;
            }
            if(!isset($post['reviewDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewDescription to update.';
                break;
            }
            $result = updateOrderByReviewDescription($post['reviewDescription'],$post['order']);
            break;
        
        case 'updateOrderByReviewLevel':
            debug('I am inside the post method updateOrderByReviewLevel <br>');
            include_once 'functions/update/updateOrderByReviewLevel.php';
            if(!isset($post['order'])) {
                $result['success'] = false;
                $result['msg'] = 'No order to update.';
                break;
            }
            if(!isset($post['reviewLevel'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewLevel to update.';
                break;
            }
            $result = updateOrderByReviewLevel($post['reviewLevel'],$post['order']);
            break;
        
        case 'updateOrderByDeliveryId':
            debug('I am inside the post method updateOrderByDeliveryId <br>');
            include_once 'functions/update/updateOrderByDeliveryId.php';
            if(!isset($post['order'])) {
                $result['success'] = false;
                $result['msg'] = 'No order to update.';
                break;
            }
            if(!isset($post['deliveryId'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryId to update.';
                break;
            }
            $result = updateOrderByDeliveryId($post['deliveryId'],$post['order']);
            break;
        
        case 'updateOrderByDeliveryMoney':
            debug('I am inside the post method updateOrderByDeliveryMoney <br>');
            include_once 'functions/update/updateOrderByDeliveryMoney.php';
            if(!isset($post['order'])) {
                $result['success'] = false;
                $result['msg'] = 'No order to update.';
                break;
            }
            if(!isset($post['deliveryMoney'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryMoney to update.';
                break;
            }
            $result = updateOrderByDeliveryMoney($post['deliveryMoney'],$post['order']);
            break;
        
        case 'updateOrderByUserId':
            debug('I am inside the post method updateOrderByUserId <br>');
            include_once 'functions/update/updateOrderByUserId.php';
            if(!isset($post['order'])) {
                $result['success'] = false;
                $result['msg'] = 'No order to update.';
                break;
            }
            if(!isset($post['userId'])) {
                $result['success'] = false;
                $result['msg'] = 'No userId to update.';
                break;
            }
            $result = updateOrderByUserId($post['userId'],$post['order']);
            break;
        
        case 'updateShipDateById':
            debug('I am inside the post method updateShipDateById <br>');
            include_once 'functions/update/updateShipDateById.php';
            if(!isset($post['shipDate'])) {
                $result['success'] = false;
                $result['msg'] = 'No shipDate to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updateShipDateById($post['id'],$post['shipDate']);
            break;
        
        case 'updateShipDateByShop':
            debug('I am inside the post method updateShipDateByShop <br>');
            include_once 'functions/update/updateShipDateByShop.php';
            if(!isset($post['shipDate'])) {
                $result['success'] = false;
                $result['msg'] = 'No shipDate to update.';
                break;
            }
            if(!isset($post['shop'])) {
                $result['success'] = false;
                $result['msg'] = 'No shop to update.';
                break;
            }
            $result = updateShipDateByShop($post['shop'],$post['shipDate']);
            break;
        
        case 'updateShipDateByShopId':
            debug('I am inside the post method updateShipDateByShopId <br>');
            include_once 'functions/update/updateShipDateByShopId.php';
            if(!isset($post['shipDate'])) {
                $result['success'] = false;
                $result['msg'] = 'No shipDate to update.';
                break;
            }
            if(!isset($post['shopId'])) {
                $result['success'] = false;
                $result['msg'] = 'No shopId to update.';
                break;
            }
            $result = updateShipDateByShopId($post['shopId'],$post['shipDate']);
            break;
        
        case 'updateShipDateByOrder':
            debug('I am inside the post method updateShipDateByOrder <br>');
            include_once 'functions/update/updateShipDateByOrder.php';
            if(!isset($post['shipDate'])) {
                $result['success'] = false;
                $result['msg'] = 'No shipDate to update.';
                break;
            }
            if(!isset($post['order'])) {
                $result['success'] = false;
                $result['msg'] = 'No order to update.';
                break;
            }
            $result = updateShipDateByOrder($post['order'],$post['shipDate']);
            break;
        
        case 'updateShipDateByStatus':
            debug('I am inside the post method updateShipDateByStatus <br>');
            include_once 'functions/update/updateShipDateByStatus.php';
            if(!isset($post['shipDate'])) {
                $result['success'] = false;
                $result['msg'] = 'No shipDate to update.';
                break;
            }
            if(!isset($post['Status'])) {
                $result['success'] = false;
                $result['msg'] = 'No Status to update.';
                break;
            }
            $result = updateShipDateByStatus($post['Status'],$post['shipDate']);
            break;
        
        case 'updateShipDateByPrice':
            debug('I am inside the post method updateShipDateByPrice <br>');
            include_once 'functions/update/updateShipDateByPrice.php';
            if(!isset($post['shipDate'])) {
                $result['success'] = false;
                $result['msg'] = 'No shipDate to update.';
                break;
            }
            if(!isset($post['price'])) {
                $result['success'] = false;
                $result['msg'] = 'No price to update.';
                break;
            }
            $result = updateShipDateByPrice($post['price'],$post['shipDate']);
            break;
        
        case 'updateShipDateByPickAddress':
            debug('I am inside the post method updateShipDateByPickAddress <br>');
            include_once 'functions/update/updateShipDateByPickAddress.php';
            if(!isset($post['shipDate'])) {
                $result['success'] = false;
                $result['msg'] = 'No shipDate to update.';
                break;
            }
            if(!isset($post['pickAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No pickAddress to update.';
                break;
            }
            $result = updateShipDateByPickAddress($post['pickAddress'],$post['shipDate']);
            break;
        
        case 'updateShipDateByDeliveryAddress':
            debug('I am inside the post method updateShipDateByDeliveryAddress <br>');
            include_once 'functions/update/updateShipDateByDeliveryAddress.php';
            if(!isset($post['shipDate'])) {
                $result['success'] = false;
                $result['msg'] = 'No shipDate to update.';
                break;
            }
            if(!isset($post['deliveryAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryAddress to update.';
                break;
            }
            $result = updateShipDateByDeliveryAddress($post['deliveryAddress'],$post['shipDate']);
            break;
        
        case 'updateShipDateByQuarrelDescription':
            debug('I am inside the post method updateShipDateByQuarrelDescription <br>');
            include_once 'functions/update/updateShipDateByQuarrelDescription.php';
            if(!isset($post['shipDate'])) {
                $result['success'] = false;
                $result['msg'] = 'No shipDate to update.';
                break;
            }
            if(!isset($post['quarrelDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelDescription to update.';
                break;
            }
            $result = updateShipDateByQuarrelDescription($post['quarrelDescription'],$post['shipDate']);
            break;
        
        case 'updateShipDateByQuarrelPicture':
            debug('I am inside the post method updateShipDateByQuarrelPicture <br>');
            include_once 'functions/update/updateShipDateByQuarrelPicture.php';
            if(!isset($post['shipDate'])) {
                $result['success'] = false;
                $result['msg'] = 'No shipDate to update.';
                break;
            }
            if(!isset($post['quarrelPicture'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelPicture to update.';
                break;
            }
            $result = updateShipDateByQuarrelPicture($post['quarrelPicture'],$post['shipDate']);
            break;
        
        case 'updateShipDateByReviewDescription':
            debug('I am inside the post method updateShipDateByReviewDescription <br>');
            include_once 'functions/update/updateShipDateByReviewDescription.php';
            if(!isset($post['shipDate'])) {
                $result['success'] = false;
                $result['msg'] = 'No shipDate to update.';
                break;
            }
            if(!isset($post['reviewDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewDescription to update.';
                break;
            }
            $result = updateShipDateByReviewDescription($post['reviewDescription'],$post['shipDate']);
            break;
        
        case 'updateShipDateByReviewLevel':
            debug('I am inside the post method updateShipDateByReviewLevel <br>');
            include_once 'functions/update/updateShipDateByReviewLevel.php';
            if(!isset($post['shipDate'])) {
                $result['success'] = false;
                $result['msg'] = 'No shipDate to update.';
                break;
            }
            if(!isset($post['reviewLevel'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewLevel to update.';
                break;
            }
            $result = updateShipDateByReviewLevel($post['reviewLevel'],$post['shipDate']);
            break;
        
        case 'updateShipDateByDeliveryId':
            debug('I am inside the post method updateShipDateByDeliveryId <br>');
            include_once 'functions/update/updateShipDateByDeliveryId.php';
            if(!isset($post['shipDate'])) {
                $result['success'] = false;
                $result['msg'] = 'No shipDate to update.';
                break;
            }
            if(!isset($post['deliveryId'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryId to update.';
                break;
            }
            $result = updateShipDateByDeliveryId($post['deliveryId'],$post['shipDate']);
            break;
        
        case 'updateShipDateByDeliveryMoney':
            debug('I am inside the post method updateShipDateByDeliveryMoney <br>');
            include_once 'functions/update/updateShipDateByDeliveryMoney.php';
            if(!isset($post['shipDate'])) {
                $result['success'] = false;
                $result['msg'] = 'No shipDate to update.';
                break;
            }
            if(!isset($post['deliveryMoney'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryMoney to update.';
                break;
            }
            $result = updateShipDateByDeliveryMoney($post['deliveryMoney'],$post['shipDate']);
            break;
        
        case 'updateShipDateByUserId':
            debug('I am inside the post method updateShipDateByUserId <br>');
            include_once 'functions/update/updateShipDateByUserId.php';
            if(!isset($post['shipDate'])) {
                $result['success'] = false;
                $result['msg'] = 'No shipDate to update.';
                break;
            }
            if(!isset($post['userId'])) {
                $result['success'] = false;
                $result['msg'] = 'No userId to update.';
                break;
            }
            $result = updateShipDateByUserId($post['userId'],$post['shipDate']);
            break;
        
        case 'updateStatusById':
            debug('I am inside the post method updateStatusById <br>');
            include_once 'functions/update/updateStatusById.php';
            if(!isset($post['Status'])) {
                $result['success'] = false;
                $result['msg'] = 'No Status to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updateStatusById($post['id'],$post['Status']);
            break;
        
        case 'updateStatusByShop':
            debug('I am inside the post method updateStatusByShop <br>');
            include_once 'functions/update/updateStatusByShop.php';
            if(!isset($post['Status'])) {
                $result['success'] = false;
                $result['msg'] = 'No Status to update.';
                break;
            }
            if(!isset($post['shop'])) {
                $result['success'] = false;
                $result['msg'] = 'No shop to update.';
                break;
            }
            $result = updateStatusByShop($post['shop'],$post['Status']);
            break;
        
        case 'updateStatusByShopId':
            debug('I am inside the post method updateStatusByShopId <br>');
            include_once 'functions/update/updateStatusByShopId.php';
            if(!isset($post['Status'])) {
                $result['success'] = false;
                $result['msg'] = 'No Status to update.';
                break;
            }
            if(!isset($post['shopId'])) {
                $result['success'] = false;
                $result['msg'] = 'No shopId to update.';
                break;
            }
            $result = updateStatusByShopId($post['shopId'],$post['Status']);
            break;
        
        case 'updateStatusByOrder':
            debug('I am inside the post method updateStatusByOrder <br>');
            include_once 'functions/update/updateStatusByOrder.php';
            if(!isset($post['Status'])) {
                $result['success'] = false;
                $result['msg'] = 'No Status to update.';
                break;
            }
            if(!isset($post['order'])) {
                $result['success'] = false;
                $result['msg'] = 'No order to update.';
                break;
            }
            $result = updateStatusByOrder($post['order'],$post['Status']);
            break;
        
        case 'updateStatusByShipDate':
            debug('I am inside the post method updateStatusByShipDate <br>');
            include_once 'functions/update/updateStatusByShipDate.php';
            if(!isset($post['Status'])) {
                $result['success'] = false;
                $result['msg'] = 'No Status to update.';
                break;
            }
            if(!isset($post['shipDate'])) {
                $result['success'] = false;
                $result['msg'] = 'No shipDate to update.';
                break;
            }
            $result = updateStatusByShipDate($post['shipDate'],$post['Status']);
            break;
        
        case 'updateStatusByPrice':
            debug('I am inside the post method updateStatusByPrice <br>');
            include_once 'functions/update/updateStatusByPrice.php';
            if(!isset($post['Status'])) {
                $result['success'] = false;
                $result['msg'] = 'No Status to update.';
                break;
            }
            if(!isset($post['price'])) {
                $result['success'] = false;
                $result['msg'] = 'No price to update.';
                break;
            }
            $result = updateStatusByPrice($post['price'],$post['Status']);
            break;
        
        case 'updateStatusByPickAddress':
            debug('I am inside the post method updateStatusByPickAddress <br>');
            include_once 'functions/update/updateStatusByPickAddress.php';
            if(!isset($post['Status'])) {
                $result['success'] = false;
                $result['msg'] = 'No Status to update.';
                break;
            }
            if(!isset($post['pickAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No pickAddress to update.';
                break;
            }
            $result = updateStatusByPickAddress($post['pickAddress'],$post['Status']);
            break;
        
        case 'updateStatusByDeliveryAddress':
            debug('I am inside the post method updateStatusByDeliveryAddress <br>');
            include_once 'functions/update/updateStatusByDeliveryAddress.php';
            if(!isset($post['Status'])) {
                $result['success'] = false;
                $result['msg'] = 'No Status to update.';
                break;
            }
            if(!isset($post['deliveryAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryAddress to update.';
                break;
            }
            $result = updateStatusByDeliveryAddress($post['deliveryAddress'],$post['Status']);
            break;
        
        case 'updateStatusByQuarrelDescription':
            debug('I am inside the post method updateStatusByQuarrelDescription <br>');
            include_once 'functions/update/updateStatusByQuarrelDescription.php';
            if(!isset($post['Status'])) {
                $result['success'] = false;
                $result['msg'] = 'No Status to update.';
                break;
            }
            if(!isset($post['quarrelDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelDescription to update.';
                break;
            }
            $result = updateStatusByQuarrelDescription($post['quarrelDescription'],$post['Status']);
            break;
        
        case 'updateStatusByQuarrelPicture':
            debug('I am inside the post method updateStatusByQuarrelPicture <br>');
            include_once 'functions/update/updateStatusByQuarrelPicture.php';
            if(!isset($post['Status'])) {
                $result['success'] = false;
                $result['msg'] = 'No Status to update.';
                break;
            }
            if(!isset($post['quarrelPicture'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelPicture to update.';
                break;
            }
            $result = updateStatusByQuarrelPicture($post['quarrelPicture'],$post['Status']);
            break;
        
        case 'updateStatusByReviewDescription':
            debug('I am inside the post method updateStatusByReviewDescription <br>');
            include_once 'functions/update/updateStatusByReviewDescription.php';
            if(!isset($post['Status'])) {
                $result['success'] = false;
                $result['msg'] = 'No Status to update.';
                break;
            }
            if(!isset($post['reviewDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewDescription to update.';
                break;
            }
            $result = updateStatusByReviewDescription($post['reviewDescription'],$post['Status']);
            break;
        
        case 'updateStatusByReviewLevel':
            debug('I am inside the post method updateStatusByReviewLevel <br>');
            include_once 'functions/update/updateStatusByReviewLevel.php';
            if(!isset($post['Status'])) {
                $result['success'] = false;
                $result['msg'] = 'No Status to update.';
                break;
            }
            if(!isset($post['reviewLevel'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewLevel to update.';
                break;
            }
            $result = updateStatusByReviewLevel($post['reviewLevel'],$post['Status']);
            break;
        
        case 'updateStatusByDeliveryId':
            debug('I am inside the post method updateStatusByDeliveryId <br>');
            include_once 'functions/update/updateStatusByDeliveryId.php';
            if(!isset($post['Status'])) {
                $result['success'] = false;
                $result['msg'] = 'No Status to update.';
                break;
            }
            if(!isset($post['deliveryId'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryId to update.';
                break;
            }
            $result = updateStatusByDeliveryId($post['deliveryId'],$post['Status']);
            break;
        
        case 'updateStatusByDeliveryMoney':
            debug('I am inside the post method updateStatusByDeliveryMoney <br>');
            include_once 'functions/update/updateStatusByDeliveryMoney.php';
            if(!isset($post['Status'])) {
                $result['success'] = false;
                $result['msg'] = 'No Status to update.';
                break;
            }
            if(!isset($post['deliveryMoney'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryMoney to update.';
                break;
            }
            $result = updateStatusByDeliveryMoney($post['deliveryMoney'],$post['Status']);
            break;
        
        case 'updateStatusByUserId':
            debug('I am inside the post method updateStatusByUserId <br>');
            include_once 'functions/update/updateStatusByUserId.php';
            if(!isset($post['Status'])) {
                $result['success'] = false;
                $result['msg'] = 'No Status to update.';
                break;
            }
            if(!isset($post['userId'])) {
                $result['success'] = false;
                $result['msg'] = 'No userId to update.';
                break;
            }
            $result = updateStatusByUserId($post['userId'],$post['Status']);
            break;
        
        case 'updatePriceById':
            debug('I am inside the post method updatePriceById <br>');
            include_once 'functions/update/updatePriceById.php';
            if(!isset($post['price'])) {
                $result['success'] = false;
                $result['msg'] = 'No price to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updatePriceById($post['id'],$post['price']);
            break;
        
        case 'updatePriceByShop':
            debug('I am inside the post method updatePriceByShop <br>');
            include_once 'functions/update/updatePriceByShop.php';
            if(!isset($post['price'])) {
                $result['success'] = false;
                $result['msg'] = 'No price to update.';
                break;
            }
            if(!isset($post['shop'])) {
                $result['success'] = false;
                $result['msg'] = 'No shop to update.';
                break;
            }
            $result = updatePriceByShop($post['shop'],$post['price']);
            break;
        
        case 'updatePriceByShopId':
            debug('I am inside the post method updatePriceByShopId <br>');
            include_once 'functions/update/updatePriceByShopId.php';
            if(!isset($post['price'])) {
                $result['success'] = false;
                $result['msg'] = 'No price to update.';
                break;
            }
            if(!isset($post['shopId'])) {
                $result['success'] = false;
                $result['msg'] = 'No shopId to update.';
                break;
            }
            $result = updatePriceByShopId($post['shopId'],$post['price']);
            break;
        
        case 'updatePriceByOrder':
            debug('I am inside the post method updatePriceByOrder <br>');
            include_once 'functions/update/updatePriceByOrder.php';
            if(!isset($post['price'])) {
                $result['success'] = false;
                $result['msg'] = 'No price to update.';
                break;
            }
            if(!isset($post['order'])) {
                $result['success'] = false;
                $result['msg'] = 'No order to update.';
                break;
            }
            $result = updatePriceByOrder($post['order'],$post['price']);
            break;
        
        case 'updatePriceByShipDate':
            debug('I am inside the post method updatePriceByShipDate <br>');
            include_once 'functions/update/updatePriceByShipDate.php';
            if(!isset($post['price'])) {
                $result['success'] = false;
                $result['msg'] = 'No price to update.';
                break;
            }
            if(!isset($post['shipDate'])) {
                $result['success'] = false;
                $result['msg'] = 'No shipDate to update.';
                break;
            }
            $result = updatePriceByShipDate($post['shipDate'],$post['price']);
            break;
        
        case 'updatePriceByStatus':
            debug('I am inside the post method updatePriceByStatus <br>');
            include_once 'functions/update/updatePriceByStatus.php';
            if(!isset($post['price'])) {
                $result['success'] = false;
                $result['msg'] = 'No price to update.';
                break;
            }
            if(!isset($post['Status'])) {
                $result['success'] = false;
                $result['msg'] = 'No Status to update.';
                break;
            }
            $result = updatePriceByStatus($post['Status'],$post['price']);
            break;
        
        case 'updatePriceByPickAddress':
            debug('I am inside the post method updatePriceByPickAddress <br>');
            include_once 'functions/update/updatePriceByPickAddress.php';
            if(!isset($post['price'])) {
                $result['success'] = false;
                $result['msg'] = 'No price to update.';
                break;
            }
            if(!isset($post['pickAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No pickAddress to update.';
                break;
            }
            $result = updatePriceByPickAddress($post['pickAddress'],$post['price']);
            break;
        
        case 'updatePriceByDeliveryAddress':
            debug('I am inside the post method updatePriceByDeliveryAddress <br>');
            include_once 'functions/update/updatePriceByDeliveryAddress.php';
            if(!isset($post['price'])) {
                $result['success'] = false;
                $result['msg'] = 'No price to update.';
                break;
            }
            if(!isset($post['deliveryAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryAddress to update.';
                break;
            }
            $result = updatePriceByDeliveryAddress($post['deliveryAddress'],$post['price']);
            break;
        
        case 'updatePriceByQuarrelDescription':
            debug('I am inside the post method updatePriceByQuarrelDescription <br>');
            include_once 'functions/update/updatePriceByQuarrelDescription.php';
            if(!isset($post['price'])) {
                $result['success'] = false;
                $result['msg'] = 'No price to update.';
                break;
            }
            if(!isset($post['quarrelDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelDescription to update.';
                break;
            }
            $result = updatePriceByQuarrelDescription($post['quarrelDescription'],$post['price']);
            break;
        
        case 'updatePriceByQuarrelPicture':
            debug('I am inside the post method updatePriceByQuarrelPicture <br>');
            include_once 'functions/update/updatePriceByQuarrelPicture.php';
            if(!isset($post['price'])) {
                $result['success'] = false;
                $result['msg'] = 'No price to update.';
                break;
            }
            if(!isset($post['quarrelPicture'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelPicture to update.';
                break;
            }
            $result = updatePriceByQuarrelPicture($post['quarrelPicture'],$post['price']);
            break;
        
        case 'updatePriceByReviewDescription':
            debug('I am inside the post method updatePriceByReviewDescription <br>');
            include_once 'functions/update/updatePriceByReviewDescription.php';
            if(!isset($post['price'])) {
                $result['success'] = false;
                $result['msg'] = 'No price to update.';
                break;
            }
            if(!isset($post['reviewDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewDescription to update.';
                break;
            }
            $result = updatePriceByReviewDescription($post['reviewDescription'],$post['price']);
            break;
        
        case 'updatePriceByReviewLevel':
            debug('I am inside the post method updatePriceByReviewLevel <br>');
            include_once 'functions/update/updatePriceByReviewLevel.php';
            if(!isset($post['price'])) {
                $result['success'] = false;
                $result['msg'] = 'No price to update.';
                break;
            }
            if(!isset($post['reviewLevel'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewLevel to update.';
                break;
            }
            $result = updatePriceByReviewLevel($post['reviewLevel'],$post['price']);
            break;
        
        case 'updatePriceByDeliveryId':
            debug('I am inside the post method updatePriceByDeliveryId <br>');
            include_once 'functions/update/updatePriceByDeliveryId.php';
            if(!isset($post['price'])) {
                $result['success'] = false;
                $result['msg'] = 'No price to update.';
                break;
            }
            if(!isset($post['deliveryId'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryId to update.';
                break;
            }
            $result = updatePriceByDeliveryId($post['deliveryId'],$post['price']);
            break;
        
        case 'updatePriceByDeliveryMoney':
            debug('I am inside the post method updatePriceByDeliveryMoney <br>');
            include_once 'functions/update/updatePriceByDeliveryMoney.php';
            if(!isset($post['price'])) {
                $result['success'] = false;
                $result['msg'] = 'No price to update.';
                break;
            }
            if(!isset($post['deliveryMoney'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryMoney to update.';
                break;
            }
            $result = updatePriceByDeliveryMoney($post['deliveryMoney'],$post['price']);
            break;
        
        case 'updatePriceByUserId':
            debug('I am inside the post method updatePriceByUserId <br>');
            include_once 'functions/update/updatePriceByUserId.php';
            if(!isset($post['price'])) {
                $result['success'] = false;
                $result['msg'] = 'No price to update.';
                break;
            }
            if(!isset($post['userId'])) {
                $result['success'] = false;
                $result['msg'] = 'No userId to update.';
                break;
            }
            $result = updatePriceByUserId($post['userId'],$post['price']);
            break;
        
        case 'updatePickAddressById':
            debug('I am inside the post method updatePickAddressById <br>');
            include_once 'functions/update/updatePickAddressById.php';
            if(!isset($post['pickAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No pickAddress to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updatePickAddressById($post['id'],$post['pickAddress']);
            break;
        
        case 'updatePickAddressByShop':
            debug('I am inside the post method updatePickAddressByShop <br>');
            include_once 'functions/update/updatePickAddressByShop.php';
            if(!isset($post['pickAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No pickAddress to update.';
                break;
            }
            if(!isset($post['shop'])) {
                $result['success'] = false;
                $result['msg'] = 'No shop to update.';
                break;
            }
            $result = updatePickAddressByShop($post['shop'],$post['pickAddress']);
            break;
        
        case 'updatePickAddressByShopId':
            debug('I am inside the post method updatePickAddressByShopId <br>');
            include_once 'functions/update/updatePickAddressByShopId.php';
            if(!isset($post['pickAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No pickAddress to update.';
                break;
            }
            if(!isset($post['shopId'])) {
                $result['success'] = false;
                $result['msg'] = 'No shopId to update.';
                break;
            }
            $result = updatePickAddressByShopId($post['shopId'],$post['pickAddress']);
            break;
        
        case 'updatePickAddressByOrder':
            debug('I am inside the post method updatePickAddressByOrder <br>');
            include_once 'functions/update/updatePickAddressByOrder.php';
            if(!isset($post['pickAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No pickAddress to update.';
                break;
            }
            if(!isset($post['order'])) {
                $result['success'] = false;
                $result['msg'] = 'No order to update.';
                break;
            }
            $result = updatePickAddressByOrder($post['order'],$post['pickAddress']);
            break;
        
        case 'updatePickAddressByShipDate':
            debug('I am inside the post method updatePickAddressByShipDate <br>');
            include_once 'functions/update/updatePickAddressByShipDate.php';
            if(!isset($post['pickAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No pickAddress to update.';
                break;
            }
            if(!isset($post['shipDate'])) {
                $result['success'] = false;
                $result['msg'] = 'No shipDate to update.';
                break;
            }
            $result = updatePickAddressByShipDate($post['shipDate'],$post['pickAddress']);
            break;
        
        case 'updatePickAddressByStatus':
            debug('I am inside the post method updatePickAddressByStatus <br>');
            include_once 'functions/update/updatePickAddressByStatus.php';
            if(!isset($post['pickAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No pickAddress to update.';
                break;
            }
            if(!isset($post['Status'])) {
                $result['success'] = false;
                $result['msg'] = 'No Status to update.';
                break;
            }
            $result = updatePickAddressByStatus($post['Status'],$post['pickAddress']);
            break;
        
        case 'updatePickAddressByPrice':
            debug('I am inside the post method updatePickAddressByPrice <br>');
            include_once 'functions/update/updatePickAddressByPrice.php';
            if(!isset($post['pickAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No pickAddress to update.';
                break;
            }
            if(!isset($post['price'])) {
                $result['success'] = false;
                $result['msg'] = 'No price to update.';
                break;
            }
            $result = updatePickAddressByPrice($post['price'],$post['pickAddress']);
            break;
        
        case 'updatePickAddressByDeliveryAddress':
            debug('I am inside the post method updatePickAddressByDeliveryAddress <br>');
            include_once 'functions/update/updatePickAddressByDeliveryAddress.php';
            if(!isset($post['pickAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No pickAddress to update.';
                break;
            }
            if(!isset($post['deliveryAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryAddress to update.';
                break;
            }
            $result = updatePickAddressByDeliveryAddress($post['deliveryAddress'],$post['pickAddress']);
            break;
        
        case 'updatePickAddressByQuarrelDescription':
            debug('I am inside the post method updatePickAddressByQuarrelDescription <br>');
            include_once 'functions/update/updatePickAddressByQuarrelDescription.php';
            if(!isset($post['pickAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No pickAddress to update.';
                break;
            }
            if(!isset($post['quarrelDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelDescription to update.';
                break;
            }
            $result = updatePickAddressByQuarrelDescription($post['quarrelDescription'],$post['pickAddress']);
            break;
        
        case 'updatePickAddressByQuarrelPicture':
            debug('I am inside the post method updatePickAddressByQuarrelPicture <br>');
            include_once 'functions/update/updatePickAddressByQuarrelPicture.php';
            if(!isset($post['pickAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No pickAddress to update.';
                break;
            }
            if(!isset($post['quarrelPicture'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelPicture to update.';
                break;
            }
            $result = updatePickAddressByQuarrelPicture($post['quarrelPicture'],$post['pickAddress']);
            break;
        
        case 'updatePickAddressByReviewDescription':
            debug('I am inside the post method updatePickAddressByReviewDescription <br>');
            include_once 'functions/update/updatePickAddressByReviewDescription.php';
            if(!isset($post['pickAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No pickAddress to update.';
                break;
            }
            if(!isset($post['reviewDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewDescription to update.';
                break;
            }
            $result = updatePickAddressByReviewDescription($post['reviewDescription'],$post['pickAddress']);
            break;
        
        case 'updatePickAddressByReviewLevel':
            debug('I am inside the post method updatePickAddressByReviewLevel <br>');
            include_once 'functions/update/updatePickAddressByReviewLevel.php';
            if(!isset($post['pickAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No pickAddress to update.';
                break;
            }
            if(!isset($post['reviewLevel'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewLevel to update.';
                break;
            }
            $result = updatePickAddressByReviewLevel($post['reviewLevel'],$post['pickAddress']);
            break;
        
        case 'updatePickAddressByDeliveryId':
            debug('I am inside the post method updatePickAddressByDeliveryId <br>');
            include_once 'functions/update/updatePickAddressByDeliveryId.php';
            if(!isset($post['pickAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No pickAddress to update.';
                break;
            }
            if(!isset($post['deliveryId'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryId to update.';
                break;
            }
            $result = updatePickAddressByDeliveryId($post['deliveryId'],$post['pickAddress']);
            break;
        
        case 'updatePickAddressByDeliveryMoney':
            debug('I am inside the post method updatePickAddressByDeliveryMoney <br>');
            include_once 'functions/update/updatePickAddressByDeliveryMoney.php';
            if(!isset($post['pickAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No pickAddress to update.';
                break;
            }
            if(!isset($post['deliveryMoney'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryMoney to update.';
                break;
            }
            $result = updatePickAddressByDeliveryMoney($post['deliveryMoney'],$post['pickAddress']);
            break;
        
        case 'updatePickAddressByUserId':
            debug('I am inside the post method updatePickAddressByUserId <br>');
            include_once 'functions/update/updatePickAddressByUserId.php';
            if(!isset($post['pickAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No pickAddress to update.';
                break;
            }
            if(!isset($post['userId'])) {
                $result['success'] = false;
                $result['msg'] = 'No userId to update.';
                break;
            }
            $result = updatePickAddressByUserId($post['userId'],$post['pickAddress']);
            break;
        
        case 'updateDeliveryAddressById':
            debug('I am inside the post method updateDeliveryAddressById <br>');
            include_once 'functions/update/updateDeliveryAddressById.php';
            if(!isset($post['deliveryAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryAddress to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updateDeliveryAddressById($post['id'],$post['deliveryAddress']);
            break;
        
        case 'updateDeliveryAddressByShop':
            debug('I am inside the post method updateDeliveryAddressByShop <br>');
            include_once 'functions/update/updateDeliveryAddressByShop.php';
            if(!isset($post['deliveryAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryAddress to update.';
                break;
            }
            if(!isset($post['shop'])) {
                $result['success'] = false;
                $result['msg'] = 'No shop to update.';
                break;
            }
            $result = updateDeliveryAddressByShop($post['shop'],$post['deliveryAddress']);
            break;
        
        case 'updateDeliveryAddressByShopId':
            debug('I am inside the post method updateDeliveryAddressByShopId <br>');
            include_once 'functions/update/updateDeliveryAddressByShopId.php';
            if(!isset($post['deliveryAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryAddress to update.';
                break;
            }
            if(!isset($post['shopId'])) {
                $result['success'] = false;
                $result['msg'] = 'No shopId to update.';
                break;
            }
            $result = updateDeliveryAddressByShopId($post['shopId'],$post['deliveryAddress']);
            break;
        
        case 'updateDeliveryAddressByOrder':
            debug('I am inside the post method updateDeliveryAddressByOrder <br>');
            include_once 'functions/update/updateDeliveryAddressByOrder.php';
            if(!isset($post['deliveryAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryAddress to update.';
                break;
            }
            if(!isset($post['order'])) {
                $result['success'] = false;
                $result['msg'] = 'No order to update.';
                break;
            }
            $result = updateDeliveryAddressByOrder($post['order'],$post['deliveryAddress']);
            break;
        
        case 'updateDeliveryAddressByShipDate':
            debug('I am inside the post method updateDeliveryAddressByShipDate <br>');
            include_once 'functions/update/updateDeliveryAddressByShipDate.php';
            if(!isset($post['deliveryAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryAddress to update.';
                break;
            }
            if(!isset($post['shipDate'])) {
                $result['success'] = false;
                $result['msg'] = 'No shipDate to update.';
                break;
            }
            $result = updateDeliveryAddressByShipDate($post['shipDate'],$post['deliveryAddress']);
            break;
        
        case 'updateDeliveryAddressByStatus':
            debug('I am inside the post method updateDeliveryAddressByStatus <br>');
            include_once 'functions/update/updateDeliveryAddressByStatus.php';
            if(!isset($post['deliveryAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryAddress to update.';
                break;
            }
            if(!isset($post['Status'])) {
                $result['success'] = false;
                $result['msg'] = 'No Status to update.';
                break;
            }
            $result = updateDeliveryAddressByStatus($post['Status'],$post['deliveryAddress']);
            break;
        
        case 'updateDeliveryAddressByPrice':
            debug('I am inside the post method updateDeliveryAddressByPrice <br>');
            include_once 'functions/update/updateDeliveryAddressByPrice.php';
            if(!isset($post['deliveryAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryAddress to update.';
                break;
            }
            if(!isset($post['price'])) {
                $result['success'] = false;
                $result['msg'] = 'No price to update.';
                break;
            }
            $result = updateDeliveryAddressByPrice($post['price'],$post['deliveryAddress']);
            break;
        
        case 'updateDeliveryAddressByPickAddress':
            debug('I am inside the post method updateDeliveryAddressByPickAddress <br>');
            include_once 'functions/update/updateDeliveryAddressByPickAddress.php';
            if(!isset($post['deliveryAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryAddress to update.';
                break;
            }
            if(!isset($post['pickAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No pickAddress to update.';
                break;
            }
            $result = updateDeliveryAddressByPickAddress($post['pickAddress'],$post['deliveryAddress']);
            break;
        
        case 'updateDeliveryAddressByQuarrelDescription':
            debug('I am inside the post method updateDeliveryAddressByQuarrelDescription <br>');
            include_once 'functions/update/updateDeliveryAddressByQuarrelDescription.php';
            if(!isset($post['deliveryAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryAddress to update.';
                break;
            }
            if(!isset($post['quarrelDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelDescription to update.';
                break;
            }
            $result = updateDeliveryAddressByQuarrelDescription($post['quarrelDescription'],$post['deliveryAddress']);
            break;
        
        case 'updateDeliveryAddressByQuarrelPicture':
            debug('I am inside the post method updateDeliveryAddressByQuarrelPicture <br>');
            include_once 'functions/update/updateDeliveryAddressByQuarrelPicture.php';
            if(!isset($post['deliveryAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryAddress to update.';
                break;
            }
            if(!isset($post['quarrelPicture'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelPicture to update.';
                break;
            }
            $result = updateDeliveryAddressByQuarrelPicture($post['quarrelPicture'],$post['deliveryAddress']);
            break;
        
        case 'updateDeliveryAddressByReviewDescription':
            debug('I am inside the post method updateDeliveryAddressByReviewDescription <br>');
            include_once 'functions/update/updateDeliveryAddressByReviewDescription.php';
            if(!isset($post['deliveryAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryAddress to update.';
                break;
            }
            if(!isset($post['reviewDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewDescription to update.';
                break;
            }
            $result = updateDeliveryAddressByReviewDescription($post['reviewDescription'],$post['deliveryAddress']);
            break;
        
        case 'updateDeliveryAddressByReviewLevel':
            debug('I am inside the post method updateDeliveryAddressByReviewLevel <br>');
            include_once 'functions/update/updateDeliveryAddressByReviewLevel.php';
            if(!isset($post['deliveryAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryAddress to update.';
                break;
            }
            if(!isset($post['reviewLevel'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewLevel to update.';
                break;
            }
            $result = updateDeliveryAddressByReviewLevel($post['reviewLevel'],$post['deliveryAddress']);
            break;
        
        case 'updateDeliveryAddressByDeliveryId':
            debug('I am inside the post method updateDeliveryAddressByDeliveryId <br>');
            include_once 'functions/update/updateDeliveryAddressByDeliveryId.php';
            if(!isset($post['deliveryAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryAddress to update.';
                break;
            }
            if(!isset($post['deliveryId'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryId to update.';
                break;
            }
            $result = updateDeliveryAddressByDeliveryId($post['deliveryId'],$post['deliveryAddress']);
            break;
        
        case 'updateDeliveryAddressByDeliveryMoney':
            debug('I am inside the post method updateDeliveryAddressByDeliveryMoney <br>');
            include_once 'functions/update/updateDeliveryAddressByDeliveryMoney.php';
            if(!isset($post['deliveryAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryAddress to update.';
                break;
            }
            if(!isset($post['deliveryMoney'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryMoney to update.';
                break;
            }
            $result = updateDeliveryAddressByDeliveryMoney($post['deliveryMoney'],$post['deliveryAddress']);
            break;
        
        case 'updateDeliveryAddressByUserId':
            debug('I am inside the post method updateDeliveryAddressByUserId <br>');
            include_once 'functions/update/updateDeliveryAddressByUserId.php';
            if(!isset($post['deliveryAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryAddress to update.';
                break;
            }
            if(!isset($post['userId'])) {
                $result['success'] = false;
                $result['msg'] = 'No userId to update.';
                break;
            }
            $result = updateDeliveryAddressByUserId($post['userId'],$post['deliveryAddress']);
            break;
        
        case 'updateQuarrelDescriptionById':
            debug('I am inside the post method updateQuarrelDescriptionById <br>');
            include_once 'functions/update/updateQuarrelDescriptionById.php';
            if(!isset($post['quarrelDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelDescription to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updateQuarrelDescriptionById($post['id'],$post['quarrelDescription']);
            break;
        
        case 'updateQuarrelDescriptionByShop':
            debug('I am inside the post method updateQuarrelDescriptionByShop <br>');
            include_once 'functions/update/updateQuarrelDescriptionByShop.php';
            if(!isset($post['quarrelDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelDescription to update.';
                break;
            }
            if(!isset($post['shop'])) {
                $result['success'] = false;
                $result['msg'] = 'No shop to update.';
                break;
            }
            $result = updateQuarrelDescriptionByShop($post['shop'],$post['quarrelDescription']);
            break;
        
        case 'updateQuarrelDescriptionByShopId':
            debug('I am inside the post method updateQuarrelDescriptionByShopId <br>');
            include_once 'functions/update/updateQuarrelDescriptionByShopId.php';
            if(!isset($post['quarrelDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelDescription to update.';
                break;
            }
            if(!isset($post['shopId'])) {
                $result['success'] = false;
                $result['msg'] = 'No shopId to update.';
                break;
            }
            $result = updateQuarrelDescriptionByShopId($post['shopId'],$post['quarrelDescription']);
            break;
        
        case 'updateQuarrelDescriptionByOrder':
            debug('I am inside the post method updateQuarrelDescriptionByOrder <br>');
            include_once 'functions/update/updateQuarrelDescriptionByOrder.php';
            if(!isset($post['quarrelDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelDescription to update.';
                break;
            }
            if(!isset($post['order'])) {
                $result['success'] = false;
                $result['msg'] = 'No order to update.';
                break;
            }
            $result = updateQuarrelDescriptionByOrder($post['order'],$post['quarrelDescription']);
            break;
        
        case 'updateQuarrelDescriptionByShipDate':
            debug('I am inside the post method updateQuarrelDescriptionByShipDate <br>');
            include_once 'functions/update/updateQuarrelDescriptionByShipDate.php';
            if(!isset($post['quarrelDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelDescription to update.';
                break;
            }
            if(!isset($post['shipDate'])) {
                $result['success'] = false;
                $result['msg'] = 'No shipDate to update.';
                break;
            }
            $result = updateQuarrelDescriptionByShipDate($post['shipDate'],$post['quarrelDescription']);
            break;
        
        case 'updateQuarrelDescriptionByStatus':
            debug('I am inside the post method updateQuarrelDescriptionByStatus <br>');
            include_once 'functions/update/updateQuarrelDescriptionByStatus.php';
            if(!isset($post['quarrelDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelDescription to update.';
                break;
            }
            if(!isset($post['Status'])) {
                $result['success'] = false;
                $result['msg'] = 'No Status to update.';
                break;
            }
            $result = updateQuarrelDescriptionByStatus($post['Status'],$post['quarrelDescription']);
            break;
        
        case 'updateQuarrelDescriptionByPrice':
            debug('I am inside the post method updateQuarrelDescriptionByPrice <br>');
            include_once 'functions/update/updateQuarrelDescriptionByPrice.php';
            if(!isset($post['quarrelDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelDescription to update.';
                break;
            }
            if(!isset($post['price'])) {
                $result['success'] = false;
                $result['msg'] = 'No price to update.';
                break;
            }
            $result = updateQuarrelDescriptionByPrice($post['price'],$post['quarrelDescription']);
            break;
        
        case 'updateQuarrelDescriptionByPickAddress':
            debug('I am inside the post method updateQuarrelDescriptionByPickAddress <br>');
            include_once 'functions/update/updateQuarrelDescriptionByPickAddress.php';
            if(!isset($post['quarrelDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelDescription to update.';
                break;
            }
            if(!isset($post['pickAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No pickAddress to update.';
                break;
            }
            $result = updateQuarrelDescriptionByPickAddress($post['pickAddress'],$post['quarrelDescription']);
            break;
        
        case 'updateQuarrelDescriptionByDeliveryAddress':
            debug('I am inside the post method updateQuarrelDescriptionByDeliveryAddress <br>');
            include_once 'functions/update/updateQuarrelDescriptionByDeliveryAddress.php';
            if(!isset($post['quarrelDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelDescription to update.';
                break;
            }
            if(!isset($post['deliveryAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryAddress to update.';
                break;
            }
            $result = updateQuarrelDescriptionByDeliveryAddress($post['deliveryAddress'],$post['quarrelDescription']);
            break;
        
        case 'updateQuarrelDescriptionByQuarrelPicture':
            debug('I am inside the post method updateQuarrelDescriptionByQuarrelPicture <br>');
            include_once 'functions/update/updateQuarrelDescriptionByQuarrelPicture.php';
            if(!isset($post['quarrelDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelDescription to update.';
                break;
            }
            if(!isset($post['quarrelPicture'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelPicture to update.';
                break;
            }
            $result = updateQuarrelDescriptionByQuarrelPicture($post['quarrelPicture'],$post['quarrelDescription']);
            break;
        
        case 'updateQuarrelDescriptionByReviewDescription':
            debug('I am inside the post method updateQuarrelDescriptionByReviewDescription <br>');
            include_once 'functions/update/updateQuarrelDescriptionByReviewDescription.php';
            if(!isset($post['quarrelDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelDescription to update.';
                break;
            }
            if(!isset($post['reviewDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewDescription to update.';
                break;
            }
            $result = updateQuarrelDescriptionByReviewDescription($post['reviewDescription'],$post['quarrelDescription']);
            break;
        
        case 'updateQuarrelDescriptionByReviewLevel':
            debug('I am inside the post method updateQuarrelDescriptionByReviewLevel <br>');
            include_once 'functions/update/updateQuarrelDescriptionByReviewLevel.php';
            if(!isset($post['quarrelDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelDescription to update.';
                break;
            }
            if(!isset($post['reviewLevel'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewLevel to update.';
                break;
            }
            $result = updateQuarrelDescriptionByReviewLevel($post['reviewLevel'],$post['quarrelDescription']);
            break;
        
        case 'updateQuarrelDescriptionByDeliveryId':
            debug('I am inside the post method updateQuarrelDescriptionByDeliveryId <br>');
            include_once 'functions/update/updateQuarrelDescriptionByDeliveryId.php';
            if(!isset($post['quarrelDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelDescription to update.';
                break;
            }
            if(!isset($post['deliveryId'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryId to update.';
                break;
            }
            $result = updateQuarrelDescriptionByDeliveryId($post['deliveryId'],$post['quarrelDescription']);
            break;
        
        case 'updateQuarrelDescriptionByDeliveryMoney':
            debug('I am inside the post method updateQuarrelDescriptionByDeliveryMoney <br>');
            include_once 'functions/update/updateQuarrelDescriptionByDeliveryMoney.php';
            if(!isset($post['quarrelDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelDescription to update.';
                break;
            }
            if(!isset($post['deliveryMoney'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryMoney to update.';
                break;
            }
            $result = updateQuarrelDescriptionByDeliveryMoney($post['deliveryMoney'],$post['quarrelDescription']);
            break;
        
        case 'updateQuarrelDescriptionByUserId':
            debug('I am inside the post method updateQuarrelDescriptionByUserId <br>');
            include_once 'functions/update/updateQuarrelDescriptionByUserId.php';
            if(!isset($post['quarrelDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelDescription to update.';
                break;
            }
            if(!isset($post['userId'])) {
                $result['success'] = false;
                $result['msg'] = 'No userId to update.';
                break;
            }
            $result = updateQuarrelDescriptionByUserId($post['userId'],$post['quarrelDescription']);
            break;
        
        case 'updateQuarrelPictureById':
            debug('I am inside the post method updateQuarrelPictureById <br>');
            include_once 'functions/update/updateQuarrelPictureById.php';
            if(!isset($post['quarrelPicture'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelPicture to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updateQuarrelPictureById($post['id'],$post['quarrelPicture']);
            break;
        
        case 'updateQuarrelPictureByShop':
            debug('I am inside the post method updateQuarrelPictureByShop <br>');
            include_once 'functions/update/updateQuarrelPictureByShop.php';
            if(!isset($post['quarrelPicture'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelPicture to update.';
                break;
            }
            if(!isset($post['shop'])) {
                $result['success'] = false;
                $result['msg'] = 'No shop to update.';
                break;
            }
            $result = updateQuarrelPictureByShop($post['shop'],$post['quarrelPicture']);
            break;
        
        case 'updateQuarrelPictureByShopId':
            debug('I am inside the post method updateQuarrelPictureByShopId <br>');
            include_once 'functions/update/updateQuarrelPictureByShopId.php';
            if(!isset($post['quarrelPicture'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelPicture to update.';
                break;
            }
            if(!isset($post['shopId'])) {
                $result['success'] = false;
                $result['msg'] = 'No shopId to update.';
                break;
            }
            $result = updateQuarrelPictureByShopId($post['shopId'],$post['quarrelPicture']);
            break;
        
        case 'updateQuarrelPictureByOrder':
            debug('I am inside the post method updateQuarrelPictureByOrder <br>');
            include_once 'functions/update/updateQuarrelPictureByOrder.php';
            if(!isset($post['quarrelPicture'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelPicture to update.';
                break;
            }
            if(!isset($post['order'])) {
                $result['success'] = false;
                $result['msg'] = 'No order to update.';
                break;
            }
            $result = updateQuarrelPictureByOrder($post['order'],$post['quarrelPicture']);
            break;
        
        case 'updateQuarrelPictureByShipDate':
            debug('I am inside the post method updateQuarrelPictureByShipDate <br>');
            include_once 'functions/update/updateQuarrelPictureByShipDate.php';
            if(!isset($post['quarrelPicture'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelPicture to update.';
                break;
            }
            if(!isset($post['shipDate'])) {
                $result['success'] = false;
                $result['msg'] = 'No shipDate to update.';
                break;
            }
            $result = updateQuarrelPictureByShipDate($post['shipDate'],$post['quarrelPicture']);
            break;
        
        case 'updateQuarrelPictureByStatus':
            debug('I am inside the post method updateQuarrelPictureByStatus <br>');
            include_once 'functions/update/updateQuarrelPictureByStatus.php';
            if(!isset($post['quarrelPicture'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelPicture to update.';
                break;
            }
            if(!isset($post['Status'])) {
                $result['success'] = false;
                $result['msg'] = 'No Status to update.';
                break;
            }
            $result = updateQuarrelPictureByStatus($post['Status'],$post['quarrelPicture']);
            break;
        
        case 'updateQuarrelPictureByPrice':
            debug('I am inside the post method updateQuarrelPictureByPrice <br>');
            include_once 'functions/update/updateQuarrelPictureByPrice.php';
            if(!isset($post['quarrelPicture'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelPicture to update.';
                break;
            }
            if(!isset($post['price'])) {
                $result['success'] = false;
                $result['msg'] = 'No price to update.';
                break;
            }
            $result = updateQuarrelPictureByPrice($post['price'],$post['quarrelPicture']);
            break;
        
        case 'updateQuarrelPictureByPickAddress':
            debug('I am inside the post method updateQuarrelPictureByPickAddress <br>');
            include_once 'functions/update/updateQuarrelPictureByPickAddress.php';
            if(!isset($post['quarrelPicture'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelPicture to update.';
                break;
            }
            if(!isset($post['pickAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No pickAddress to update.';
                break;
            }
            $result = updateQuarrelPictureByPickAddress($post['pickAddress'],$post['quarrelPicture']);
            break;
        
        case 'updateQuarrelPictureByDeliveryAddress':
            debug('I am inside the post method updateQuarrelPictureByDeliveryAddress <br>');
            include_once 'functions/update/updateQuarrelPictureByDeliveryAddress.php';
            if(!isset($post['quarrelPicture'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelPicture to update.';
                break;
            }
            if(!isset($post['deliveryAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryAddress to update.';
                break;
            }
            $result = updateQuarrelPictureByDeliveryAddress($post['deliveryAddress'],$post['quarrelPicture']);
            break;
        
        case 'updateQuarrelPictureByQuarrelDescription':
            debug('I am inside the post method updateQuarrelPictureByQuarrelDescription <br>');
            include_once 'functions/update/updateQuarrelPictureByQuarrelDescription.php';
            if(!isset($post['quarrelPicture'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelPicture to update.';
                break;
            }
            if(!isset($post['quarrelDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelDescription to update.';
                break;
            }
            $result = updateQuarrelPictureByQuarrelDescription($post['quarrelDescription'],$post['quarrelPicture']);
            break;
        
        case 'updateQuarrelPictureByReviewDescription':
            debug('I am inside the post method updateQuarrelPictureByReviewDescription <br>');
            include_once 'functions/update/updateQuarrelPictureByReviewDescription.php';
            if(!isset($post['quarrelPicture'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelPicture to update.';
                break;
            }
            if(!isset($post['reviewDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewDescription to update.';
                break;
            }
            $result = updateQuarrelPictureByReviewDescription($post['reviewDescription'],$post['quarrelPicture']);
            break;
        
        case 'updateQuarrelPictureByReviewLevel':
            debug('I am inside the post method updateQuarrelPictureByReviewLevel <br>');
            include_once 'functions/update/updateQuarrelPictureByReviewLevel.php';
            if(!isset($post['quarrelPicture'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelPicture to update.';
                break;
            }
            if(!isset($post['reviewLevel'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewLevel to update.';
                break;
            }
            $result = updateQuarrelPictureByReviewLevel($post['reviewLevel'],$post['quarrelPicture']);
            break;
        
        case 'updateQuarrelPictureByDeliveryId':
            debug('I am inside the post method updateQuarrelPictureByDeliveryId <br>');
            include_once 'functions/update/updateQuarrelPictureByDeliveryId.php';
            if(!isset($post['quarrelPicture'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelPicture to update.';
                break;
            }
            if(!isset($post['deliveryId'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryId to update.';
                break;
            }
            $result = updateQuarrelPictureByDeliveryId($post['deliveryId'],$post['quarrelPicture']);
            break;
        
        case 'updateQuarrelPictureByDeliveryMoney':
            debug('I am inside the post method updateQuarrelPictureByDeliveryMoney <br>');
            include_once 'functions/update/updateQuarrelPictureByDeliveryMoney.php';
            if(!isset($post['quarrelPicture'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelPicture to update.';
                break;
            }
            if(!isset($post['deliveryMoney'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryMoney to update.';
                break;
            }
            $result = updateQuarrelPictureByDeliveryMoney($post['deliveryMoney'],$post['quarrelPicture']);
            break;
        
        case 'updateQuarrelPictureByUserId':
            debug('I am inside the post method updateQuarrelPictureByUserId <br>');
            include_once 'functions/update/updateQuarrelPictureByUserId.php';
            if(!isset($post['quarrelPicture'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelPicture to update.';
                break;
            }
            if(!isset($post['userId'])) {
                $result['success'] = false;
                $result['msg'] = 'No userId to update.';
                break;
            }
            $result = updateQuarrelPictureByUserId($post['userId'],$post['quarrelPicture']);
            break;
        
        case 'updateReviewDescriptionById':
            debug('I am inside the post method updateReviewDescriptionById <br>');
            include_once 'functions/update/updateReviewDescriptionById.php';
            if(!isset($post['reviewDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewDescription to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updateReviewDescriptionById($post['id'],$post['reviewDescription']);
            break;
        
        case 'updateReviewDescriptionByShop':
            debug('I am inside the post method updateReviewDescriptionByShop <br>');
            include_once 'functions/update/updateReviewDescriptionByShop.php';
            if(!isset($post['reviewDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewDescription to update.';
                break;
            }
            if(!isset($post['shop'])) {
                $result['success'] = false;
                $result['msg'] = 'No shop to update.';
                break;
            }
            $result = updateReviewDescriptionByShop($post['shop'],$post['reviewDescription']);
            break;
        
        case 'updateReviewDescriptionByShopId':
            debug('I am inside the post method updateReviewDescriptionByShopId <br>');
            include_once 'functions/update/updateReviewDescriptionByShopId.php';
            if(!isset($post['reviewDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewDescription to update.';
                break;
            }
            if(!isset($post['shopId'])) {
                $result['success'] = false;
                $result['msg'] = 'No shopId to update.';
                break;
            }
            $result = updateReviewDescriptionByShopId($post['shopId'],$post['reviewDescription']);
            break;
        
        case 'updateReviewDescriptionByOrder':
            debug('I am inside the post method updateReviewDescriptionByOrder <br>');
            include_once 'functions/update/updateReviewDescriptionByOrder.php';
            if(!isset($post['reviewDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewDescription to update.';
                break;
            }
            if(!isset($post['order'])) {
                $result['success'] = false;
                $result['msg'] = 'No order to update.';
                break;
            }
            $result = updateReviewDescriptionByOrder($post['order'],$post['reviewDescription']);
            break;
        
        case 'updateReviewDescriptionByShipDate':
            debug('I am inside the post method updateReviewDescriptionByShipDate <br>');
            include_once 'functions/update/updateReviewDescriptionByShipDate.php';
            if(!isset($post['reviewDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewDescription to update.';
                break;
            }
            if(!isset($post['shipDate'])) {
                $result['success'] = false;
                $result['msg'] = 'No shipDate to update.';
                break;
            }
            $result = updateReviewDescriptionByShipDate($post['shipDate'],$post['reviewDescription']);
            break;
        
        case 'updateReviewDescriptionByStatus':
            debug('I am inside the post method updateReviewDescriptionByStatus <br>');
            include_once 'functions/update/updateReviewDescriptionByStatus.php';
            if(!isset($post['reviewDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewDescription to update.';
                break;
            }
            if(!isset($post['Status'])) {
                $result['success'] = false;
                $result['msg'] = 'No Status to update.';
                break;
            }
            $result = updateReviewDescriptionByStatus($post['Status'],$post['reviewDescription']);
            break;
        
        case 'updateReviewDescriptionByPrice':
            debug('I am inside the post method updateReviewDescriptionByPrice <br>');
            include_once 'functions/update/updateReviewDescriptionByPrice.php';
            if(!isset($post['reviewDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewDescription to update.';
                break;
            }
            if(!isset($post['price'])) {
                $result['success'] = false;
                $result['msg'] = 'No price to update.';
                break;
            }
            $result = updateReviewDescriptionByPrice($post['price'],$post['reviewDescription']);
            break;
        
        case 'updateReviewDescriptionByPickAddress':
            debug('I am inside the post method updateReviewDescriptionByPickAddress <br>');
            include_once 'functions/update/updateReviewDescriptionByPickAddress.php';
            if(!isset($post['reviewDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewDescription to update.';
                break;
            }
            if(!isset($post['pickAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No pickAddress to update.';
                break;
            }
            $result = updateReviewDescriptionByPickAddress($post['pickAddress'],$post['reviewDescription']);
            break;
        
        case 'updateReviewDescriptionByDeliveryAddress':
            debug('I am inside the post method updateReviewDescriptionByDeliveryAddress <br>');
            include_once 'functions/update/updateReviewDescriptionByDeliveryAddress.php';
            if(!isset($post['reviewDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewDescription to update.';
                break;
            }
            if(!isset($post['deliveryAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryAddress to update.';
                break;
            }
            $result = updateReviewDescriptionByDeliveryAddress($post['deliveryAddress'],$post['reviewDescription']);
            break;
        
        case 'updateReviewDescriptionByQuarrelDescription':
            debug('I am inside the post method updateReviewDescriptionByQuarrelDescription <br>');
            include_once 'functions/update/updateReviewDescriptionByQuarrelDescription.php';
            if(!isset($post['reviewDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewDescription to update.';
                break;
            }
            if(!isset($post['quarrelDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelDescription to update.';
                break;
            }
            $result = updateReviewDescriptionByQuarrelDescription($post['quarrelDescription'],$post['reviewDescription']);
            break;
        
        case 'updateReviewDescriptionByQuarrelPicture':
            debug('I am inside the post method updateReviewDescriptionByQuarrelPicture <br>');
            include_once 'functions/update/updateReviewDescriptionByQuarrelPicture.php';
            if(!isset($post['reviewDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewDescription to update.';
                break;
            }
            if(!isset($post['quarrelPicture'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelPicture to update.';
                break;
            }
            $result = updateReviewDescriptionByQuarrelPicture($post['quarrelPicture'],$post['reviewDescription']);
            break;
        
        case 'updateReviewDescriptionByReviewLevel':
            debug('I am inside the post method updateReviewDescriptionByReviewLevel <br>');
            include_once 'functions/update/updateReviewDescriptionByReviewLevel.php';
            if(!isset($post['reviewDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewDescription to update.';
                break;
            }
            if(!isset($post['reviewLevel'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewLevel to update.';
                break;
            }
            $result = updateReviewDescriptionByReviewLevel($post['reviewLevel'],$post['reviewDescription']);
            break;
        
        case 'updateReviewDescriptionByDeliveryId':
            debug('I am inside the post method updateReviewDescriptionByDeliveryId <br>');
            include_once 'functions/update/updateReviewDescriptionByDeliveryId.php';
            if(!isset($post['reviewDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewDescription to update.';
                break;
            }
            if(!isset($post['deliveryId'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryId to update.';
                break;
            }
            $result = updateReviewDescriptionByDeliveryId($post['deliveryId'],$post['reviewDescription']);
            break;
        
        case 'updateReviewDescriptionByDeliveryMoney':
            debug('I am inside the post method updateReviewDescriptionByDeliveryMoney <br>');
            include_once 'functions/update/updateReviewDescriptionByDeliveryMoney.php';
            if(!isset($post['reviewDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewDescription to update.';
                break;
            }
            if(!isset($post['deliveryMoney'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryMoney to update.';
                break;
            }
            $result = updateReviewDescriptionByDeliveryMoney($post['deliveryMoney'],$post['reviewDescription']);
            break;
        
        case 'updateReviewDescriptionByUserId':
            debug('I am inside the post method updateReviewDescriptionByUserId <br>');
            include_once 'functions/update/updateReviewDescriptionByUserId.php';
            if(!isset($post['reviewDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewDescription to update.';
                break;
            }
            if(!isset($post['userId'])) {
                $result['success'] = false;
                $result['msg'] = 'No userId to update.';
                break;
            }
            $result = updateReviewDescriptionByUserId($post['userId'],$post['reviewDescription']);
            break;
        
        case 'updateReviewLevelById':
            debug('I am inside the post method updateReviewLevelById <br>');
            include_once 'functions/update/updateReviewLevelById.php';
            if(!isset($post['reviewLevel'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewLevel to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updateReviewLevelById($post['id'],$post['reviewLevel']);
            break;
        
        case 'updateReviewLevelByShop':
            debug('I am inside the post method updateReviewLevelByShop <br>');
            include_once 'functions/update/updateReviewLevelByShop.php';
            if(!isset($post['reviewLevel'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewLevel to update.';
                break;
            }
            if(!isset($post['shop'])) {
                $result['success'] = false;
                $result['msg'] = 'No shop to update.';
                break;
            }
            $result = updateReviewLevelByShop($post['shop'],$post['reviewLevel']);
            break;
        
        case 'updateReviewLevelByShopId':
            debug('I am inside the post method updateReviewLevelByShopId <br>');
            include_once 'functions/update/updateReviewLevelByShopId.php';
            if(!isset($post['reviewLevel'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewLevel to update.';
                break;
            }
            if(!isset($post['shopId'])) {
                $result['success'] = false;
                $result['msg'] = 'No shopId to update.';
                break;
            }
            $result = updateReviewLevelByShopId($post['shopId'],$post['reviewLevel']);
            break;
        
        case 'updateReviewLevelByOrder':
            debug('I am inside the post method updateReviewLevelByOrder <br>');
            include_once 'functions/update/updateReviewLevelByOrder.php';
            if(!isset($post['reviewLevel'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewLevel to update.';
                break;
            }
            if(!isset($post['order'])) {
                $result['success'] = false;
                $result['msg'] = 'No order to update.';
                break;
            }
            $result = updateReviewLevelByOrder($post['order'],$post['reviewLevel']);
            break;
        
        case 'updateReviewLevelByShipDate':
            debug('I am inside the post method updateReviewLevelByShipDate <br>');
            include_once 'functions/update/updateReviewLevelByShipDate.php';
            if(!isset($post['reviewLevel'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewLevel to update.';
                break;
            }
            if(!isset($post['shipDate'])) {
                $result['success'] = false;
                $result['msg'] = 'No shipDate to update.';
                break;
            }
            $result = updateReviewLevelByShipDate($post['shipDate'],$post['reviewLevel']);
            break;
        
        case 'updateReviewLevelByStatus':
            debug('I am inside the post method updateReviewLevelByStatus <br>');
            include_once 'functions/update/updateReviewLevelByStatus.php';
            if(!isset($post['reviewLevel'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewLevel to update.';
                break;
            }
            if(!isset($post['Status'])) {
                $result['success'] = false;
                $result['msg'] = 'No Status to update.';
                break;
            }
            $result = updateReviewLevelByStatus($post['Status'],$post['reviewLevel']);
            break;
        
        case 'updateReviewLevelByPrice':
            debug('I am inside the post method updateReviewLevelByPrice <br>');
            include_once 'functions/update/updateReviewLevelByPrice.php';
            if(!isset($post['reviewLevel'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewLevel to update.';
                break;
            }
            if(!isset($post['price'])) {
                $result['success'] = false;
                $result['msg'] = 'No price to update.';
                break;
            }
            $result = updateReviewLevelByPrice($post['price'],$post['reviewLevel']);
            break;
        
        case 'updateReviewLevelByPickAddress':
            debug('I am inside the post method updateReviewLevelByPickAddress <br>');
            include_once 'functions/update/updateReviewLevelByPickAddress.php';
            if(!isset($post['reviewLevel'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewLevel to update.';
                break;
            }
            if(!isset($post['pickAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No pickAddress to update.';
                break;
            }
            $result = updateReviewLevelByPickAddress($post['pickAddress'],$post['reviewLevel']);
            break;
        
        case 'updateReviewLevelByDeliveryAddress':
            debug('I am inside the post method updateReviewLevelByDeliveryAddress <br>');
            include_once 'functions/update/updateReviewLevelByDeliveryAddress.php';
            if(!isset($post['reviewLevel'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewLevel to update.';
                break;
            }
            if(!isset($post['deliveryAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryAddress to update.';
                break;
            }
            $result = updateReviewLevelByDeliveryAddress($post['deliveryAddress'],$post['reviewLevel']);
            break;
        
        case 'updateReviewLevelByQuarrelDescription':
            debug('I am inside the post method updateReviewLevelByQuarrelDescription <br>');
            include_once 'functions/update/updateReviewLevelByQuarrelDescription.php';
            if(!isset($post['reviewLevel'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewLevel to update.';
                break;
            }
            if(!isset($post['quarrelDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelDescription to update.';
                break;
            }
            $result = updateReviewLevelByQuarrelDescription($post['quarrelDescription'],$post['reviewLevel']);
            break;
        
        case 'updateReviewLevelByQuarrelPicture':
            debug('I am inside the post method updateReviewLevelByQuarrelPicture <br>');
            include_once 'functions/update/updateReviewLevelByQuarrelPicture.php';
            if(!isset($post['reviewLevel'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewLevel to update.';
                break;
            }
            if(!isset($post['quarrelPicture'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelPicture to update.';
                break;
            }
            $result = updateReviewLevelByQuarrelPicture($post['quarrelPicture'],$post['reviewLevel']);
            break;
        
        case 'updateReviewLevelByReviewDescription':
            debug('I am inside the post method updateReviewLevelByReviewDescription <br>');
            include_once 'functions/update/updateReviewLevelByReviewDescription.php';
            if(!isset($post['reviewLevel'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewLevel to update.';
                break;
            }
            if(!isset($post['reviewDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewDescription to update.';
                break;
            }
            $result = updateReviewLevelByReviewDescription($post['reviewDescription'],$post['reviewLevel']);
            break;
        
        case 'updateReviewLevelByDeliveryId':
            debug('I am inside the post method updateReviewLevelByDeliveryId <br>');
            include_once 'functions/update/updateReviewLevelByDeliveryId.php';
            if(!isset($post['reviewLevel'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewLevel to update.';
                break;
            }
            if(!isset($post['deliveryId'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryId to update.';
                break;
            }
            $result = updateReviewLevelByDeliveryId($post['deliveryId'],$post['reviewLevel']);
            break;
        
        case 'updateReviewLevelByDeliveryMoney':
            debug('I am inside the post method updateReviewLevelByDeliveryMoney <br>');
            include_once 'functions/update/updateReviewLevelByDeliveryMoney.php';
            if(!isset($post['reviewLevel'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewLevel to update.';
                break;
            }
            if(!isset($post['deliveryMoney'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryMoney to update.';
                break;
            }
            $result = updateReviewLevelByDeliveryMoney($post['deliveryMoney'],$post['reviewLevel']);
            break;
        
        case 'updateReviewLevelByUserId':
            debug('I am inside the post method updateReviewLevelByUserId <br>');
            include_once 'functions/update/updateReviewLevelByUserId.php';
            if(!isset($post['reviewLevel'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewLevel to update.';
                break;
            }
            if(!isset($post['userId'])) {
                $result['success'] = false;
                $result['msg'] = 'No userId to update.';
                break;
            }
            $result = updateReviewLevelByUserId($post['userId'],$post['reviewLevel']);
            break;
        
        case 'updateDeliveryIdById':
            debug('I am inside the post method updateDeliveryIdById <br>');
            include_once 'functions/update/updateDeliveryIdById.php';
            if(!isset($post['deliveryId'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryId to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updateDeliveryIdById($post['id'],$post['deliveryId']);
            break;
        
        case 'updateDeliveryIdByShop':
            debug('I am inside the post method updateDeliveryIdByShop <br>');
            include_once 'functions/update/updateDeliveryIdByShop.php';
            if(!isset($post['deliveryId'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryId to update.';
                break;
            }
            if(!isset($post['shop'])) {
                $result['success'] = false;
                $result['msg'] = 'No shop to update.';
                break;
            }
            $result = updateDeliveryIdByShop($post['shop'],$post['deliveryId']);
            break;
        
        case 'updateDeliveryIdByShopId':
            debug('I am inside the post method updateDeliveryIdByShopId <br>');
            include_once 'functions/update/updateDeliveryIdByShopId.php';
            if(!isset($post['deliveryId'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryId to update.';
                break;
            }
            if(!isset($post['shopId'])) {
                $result['success'] = false;
                $result['msg'] = 'No shopId to update.';
                break;
            }
            $result = updateDeliveryIdByShopId($post['shopId'],$post['deliveryId']);
            break;
        
        case 'updateDeliveryIdByOrder':
            debug('I am inside the post method updateDeliveryIdByOrder <br>');
            include_once 'functions/update/updateDeliveryIdByOrder.php';
            if(!isset($post['deliveryId'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryId to update.';
                break;
            }
            if(!isset($post['order'])) {
                $result['success'] = false;
                $result['msg'] = 'No order to update.';
                break;
            }
            $result = updateDeliveryIdByOrder($post['order'],$post['deliveryId']);
            break;
        
        case 'updateDeliveryIdByShipDate':
            debug('I am inside the post method updateDeliveryIdByShipDate <br>');
            include_once 'functions/update/updateDeliveryIdByShipDate.php';
            if(!isset($post['deliveryId'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryId to update.';
                break;
            }
            if(!isset($post['shipDate'])) {
                $result['success'] = false;
                $result['msg'] = 'No shipDate to update.';
                break;
            }
            $result = updateDeliveryIdByShipDate($post['shipDate'],$post['deliveryId']);
            break;
        
        case 'updateDeliveryIdByStatus':
            debug('I am inside the post method updateDeliveryIdByStatus <br>');
            include_once 'functions/update/updateDeliveryIdByStatus.php';
            if(!isset($post['deliveryId'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryId to update.';
                break;
            }
            if(!isset($post['Status'])) {
                $result['success'] = false;
                $result['msg'] = 'No Status to update.';
                break;
            }
            $result = updateDeliveryIdByStatus($post['Status'],$post['deliveryId']);
            break;
        
        case 'updateDeliveryIdByPrice':
            debug('I am inside the post method updateDeliveryIdByPrice <br>');
            include_once 'functions/update/updateDeliveryIdByPrice.php';
            if(!isset($post['deliveryId'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryId to update.';
                break;
            }
            if(!isset($post['price'])) {
                $result['success'] = false;
                $result['msg'] = 'No price to update.';
                break;
            }
            $result = updateDeliveryIdByPrice($post['price'],$post['deliveryId']);
            break;
        
        case 'updateDeliveryIdByPickAddress':
            debug('I am inside the post method updateDeliveryIdByPickAddress <br>');
            include_once 'functions/update/updateDeliveryIdByPickAddress.php';
            if(!isset($post['deliveryId'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryId to update.';
                break;
            }
            if(!isset($post['pickAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No pickAddress to update.';
                break;
            }
            $result = updateDeliveryIdByPickAddress($post['pickAddress'],$post['deliveryId']);
            break;
        
        case 'updateDeliveryIdByDeliveryAddress':
            debug('I am inside the post method updateDeliveryIdByDeliveryAddress <br>');
            include_once 'functions/update/updateDeliveryIdByDeliveryAddress.php';
            if(!isset($post['deliveryId'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryId to update.';
                break;
            }
            if(!isset($post['deliveryAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryAddress to update.';
                break;
            }
            $result = updateDeliveryIdByDeliveryAddress($post['deliveryAddress'],$post['deliveryId']);
            break;
        
        case 'updateDeliveryIdByQuarrelDescription':
            debug('I am inside the post method updateDeliveryIdByQuarrelDescription <br>');
            include_once 'functions/update/updateDeliveryIdByQuarrelDescription.php';
            if(!isset($post['deliveryId'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryId to update.';
                break;
            }
            if(!isset($post['quarrelDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelDescription to update.';
                break;
            }
            $result = updateDeliveryIdByQuarrelDescription($post['quarrelDescription'],$post['deliveryId']);
            break;
        
        case 'updateDeliveryIdByQuarrelPicture':
            debug('I am inside the post method updateDeliveryIdByQuarrelPicture <br>');
            include_once 'functions/update/updateDeliveryIdByQuarrelPicture.php';
            if(!isset($post['deliveryId'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryId to update.';
                break;
            }
            if(!isset($post['quarrelPicture'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelPicture to update.';
                break;
            }
            $result = updateDeliveryIdByQuarrelPicture($post['quarrelPicture'],$post['deliveryId']);
            break;
        
        case 'updateDeliveryIdByReviewDescription':
            debug('I am inside the post method updateDeliveryIdByReviewDescription <br>');
            include_once 'functions/update/updateDeliveryIdByReviewDescription.php';
            if(!isset($post['deliveryId'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryId to update.';
                break;
            }
            if(!isset($post['reviewDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewDescription to update.';
                break;
            }
            $result = updateDeliveryIdByReviewDescription($post['reviewDescription'],$post['deliveryId']);
            break;
        
        case 'updateDeliveryIdByReviewLevel':
            debug('I am inside the post method updateDeliveryIdByReviewLevel <br>');
            include_once 'functions/update/updateDeliveryIdByReviewLevel.php';
            if(!isset($post['deliveryId'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryId to update.';
                break;
            }
            if(!isset($post['reviewLevel'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewLevel to update.';
                break;
            }
            $result = updateDeliveryIdByReviewLevel($post['reviewLevel'],$post['deliveryId']);
            break;
        
        case 'updateDeliveryIdByDeliveryMoney':
            debug('I am inside the post method updateDeliveryIdByDeliveryMoney <br>');
            include_once 'functions/update/updateDeliveryIdByDeliveryMoney.php';
            if(!isset($post['deliveryId'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryId to update.';
                break;
            }
            if(!isset($post['deliveryMoney'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryMoney to update.';
                break;
            }
            $result = updateDeliveryIdByDeliveryMoney($post['deliveryMoney'],$post['deliveryId']);
            break;
        
        case 'updateDeliveryIdByUserId':
            debug('I am inside the post method updateDeliveryIdByUserId <br>');
            include_once 'functions/update/updateDeliveryIdByUserId.php';
            if(!isset($post['deliveryId'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryId to update.';
                break;
            }
            if(!isset($post['userId'])) {
                $result['success'] = false;
                $result['msg'] = 'No userId to update.';
                break;
            }
            $result = updateDeliveryIdByUserId($post['userId'],$post['deliveryId']);
            break;
        
        case 'updateDeliveryMoneyById':
            debug('I am inside the post method updateDeliveryMoneyById <br>');
            include_once 'functions/update/updateDeliveryMoneyById.php';
            if(!isset($post['deliveryMoney'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryMoney to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updateDeliveryMoneyById($post['id'],$post['deliveryMoney']);
            break;
        
        case 'updateDeliveryMoneyByShop':
            debug('I am inside the post method updateDeliveryMoneyByShop <br>');
            include_once 'functions/update/updateDeliveryMoneyByShop.php';
            if(!isset($post['deliveryMoney'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryMoney to update.';
                break;
            }
            if(!isset($post['shop'])) {
                $result['success'] = false;
                $result['msg'] = 'No shop to update.';
                break;
            }
            $result = updateDeliveryMoneyByShop($post['shop'],$post['deliveryMoney']);
            break;
        
        case 'updateDeliveryMoneyByShopId':
            debug('I am inside the post method updateDeliveryMoneyByShopId <br>');
            include_once 'functions/update/updateDeliveryMoneyByShopId.php';
            if(!isset($post['deliveryMoney'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryMoney to update.';
                break;
            }
            if(!isset($post['shopId'])) {
                $result['success'] = false;
                $result['msg'] = 'No shopId to update.';
                break;
            }
            $result = updateDeliveryMoneyByShopId($post['shopId'],$post['deliveryMoney']);
            break;
        
        case 'updateDeliveryMoneyByOrder':
            debug('I am inside the post method updateDeliveryMoneyByOrder <br>');
            include_once 'functions/update/updateDeliveryMoneyByOrder.php';
            if(!isset($post['deliveryMoney'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryMoney to update.';
                break;
            }
            if(!isset($post['order'])) {
                $result['success'] = false;
                $result['msg'] = 'No order to update.';
                break;
            }
            $result = updateDeliveryMoneyByOrder($post['order'],$post['deliveryMoney']);
            break;
        
        case 'updateDeliveryMoneyByShipDate':
            debug('I am inside the post method updateDeliveryMoneyByShipDate <br>');
            include_once 'functions/update/updateDeliveryMoneyByShipDate.php';
            if(!isset($post['deliveryMoney'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryMoney to update.';
                break;
            }
            if(!isset($post['shipDate'])) {
                $result['success'] = false;
                $result['msg'] = 'No shipDate to update.';
                break;
            }
            $result = updateDeliveryMoneyByShipDate($post['shipDate'],$post['deliveryMoney']);
            break;
        
        case 'updateDeliveryMoneyByStatus':
            debug('I am inside the post method updateDeliveryMoneyByStatus <br>');
            include_once 'functions/update/updateDeliveryMoneyByStatus.php';
            if(!isset($post['deliveryMoney'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryMoney to update.';
                break;
            }
            if(!isset($post['Status'])) {
                $result['success'] = false;
                $result['msg'] = 'No Status to update.';
                break;
            }
            $result = updateDeliveryMoneyByStatus($post['Status'],$post['deliveryMoney']);
            break;
        
        case 'updateDeliveryMoneyByPrice':
            debug('I am inside the post method updateDeliveryMoneyByPrice <br>');
            include_once 'functions/update/updateDeliveryMoneyByPrice.php';
            if(!isset($post['deliveryMoney'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryMoney to update.';
                break;
            }
            if(!isset($post['price'])) {
                $result['success'] = false;
                $result['msg'] = 'No price to update.';
                break;
            }
            $result = updateDeliveryMoneyByPrice($post['price'],$post['deliveryMoney']);
            break;
        
        case 'updateDeliveryMoneyByPickAddress':
            debug('I am inside the post method updateDeliveryMoneyByPickAddress <br>');
            include_once 'functions/update/updateDeliveryMoneyByPickAddress.php';
            if(!isset($post['deliveryMoney'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryMoney to update.';
                break;
            }
            if(!isset($post['pickAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No pickAddress to update.';
                break;
            }
            $result = updateDeliveryMoneyByPickAddress($post['pickAddress'],$post['deliveryMoney']);
            break;
        
        case 'updateDeliveryMoneyByDeliveryAddress':
            debug('I am inside the post method updateDeliveryMoneyByDeliveryAddress <br>');
            include_once 'functions/update/updateDeliveryMoneyByDeliveryAddress.php';
            if(!isset($post['deliveryMoney'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryMoney to update.';
                break;
            }
            if(!isset($post['deliveryAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryAddress to update.';
                break;
            }
            $result = updateDeliveryMoneyByDeliveryAddress($post['deliveryAddress'],$post['deliveryMoney']);
            break;
        
        case 'updateDeliveryMoneyByQuarrelDescription':
            debug('I am inside the post method updateDeliveryMoneyByQuarrelDescription <br>');
            include_once 'functions/update/updateDeliveryMoneyByQuarrelDescription.php';
            if(!isset($post['deliveryMoney'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryMoney to update.';
                break;
            }
            if(!isset($post['quarrelDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelDescription to update.';
                break;
            }
            $result = updateDeliveryMoneyByQuarrelDescription($post['quarrelDescription'],$post['deliveryMoney']);
            break;
        
        case 'updateDeliveryMoneyByQuarrelPicture':
            debug('I am inside the post method updateDeliveryMoneyByQuarrelPicture <br>');
            include_once 'functions/update/updateDeliveryMoneyByQuarrelPicture.php';
            if(!isset($post['deliveryMoney'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryMoney to update.';
                break;
            }
            if(!isset($post['quarrelPicture'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelPicture to update.';
                break;
            }
            $result = updateDeliveryMoneyByQuarrelPicture($post['quarrelPicture'],$post['deliveryMoney']);
            break;
        
        case 'updateDeliveryMoneyByReviewDescription':
            debug('I am inside the post method updateDeliveryMoneyByReviewDescription <br>');
            include_once 'functions/update/updateDeliveryMoneyByReviewDescription.php';
            if(!isset($post['deliveryMoney'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryMoney to update.';
                break;
            }
            if(!isset($post['reviewDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewDescription to update.';
                break;
            }
            $result = updateDeliveryMoneyByReviewDescription($post['reviewDescription'],$post['deliveryMoney']);
            break;
        
        case 'updateDeliveryMoneyByReviewLevel':
            debug('I am inside the post method updateDeliveryMoneyByReviewLevel <br>');
            include_once 'functions/update/updateDeliveryMoneyByReviewLevel.php';
            if(!isset($post['deliveryMoney'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryMoney to update.';
                break;
            }
            if(!isset($post['reviewLevel'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewLevel to update.';
                break;
            }
            $result = updateDeliveryMoneyByReviewLevel($post['reviewLevel'],$post['deliveryMoney']);
            break;
        
        case 'updateDeliveryMoneyByDeliveryId':
            debug('I am inside the post method updateDeliveryMoneyByDeliveryId <br>');
            include_once 'functions/update/updateDeliveryMoneyByDeliveryId.php';
            if(!isset($post['deliveryMoney'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryMoney to update.';
                break;
            }
            if(!isset($post['deliveryId'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryId to update.';
                break;
            }
            $result = updateDeliveryMoneyByDeliveryId($post['deliveryId'],$post['deliveryMoney']);
            break;
        
        case 'updateDeliveryMoneyByUserId':
            debug('I am inside the post method updateDeliveryMoneyByUserId <br>');
            include_once 'functions/update/updateDeliveryMoneyByUserId.php';
            if(!isset($post['deliveryMoney'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryMoney to update.';
                break;
            }
            if(!isset($post['userId'])) {
                $result['success'] = false;
                $result['msg'] = 'No userId to update.';
                break;
            }
            $result = updateDeliveryMoneyByUserId($post['userId'],$post['deliveryMoney']);
            break;
        
        case 'updateUserIdById':
            debug('I am inside the post method updateUserIdById <br>');
            include_once 'functions/update/updateUserIdById.php';
            if(!isset($post['userId'])) {
                $result['success'] = false;
                $result['msg'] = 'No userId to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updateUserIdById($post['id'],$post['userId']);
            break;
        
        case 'updateUserIdByShop':
            debug('I am inside the post method updateUserIdByShop <br>');
            include_once 'functions/update/updateUserIdByShop.php';
            if(!isset($post['userId'])) {
                $result['success'] = false;
                $result['msg'] = 'No userId to update.';
                break;
            }
            if(!isset($post['shop'])) {
                $result['success'] = false;
                $result['msg'] = 'No shop to update.';
                break;
            }
            $result = updateUserIdByShop($post['shop'],$post['userId']);
            break;
        
        case 'updateUserIdByShopId':
            debug('I am inside the post method updateUserIdByShopId <br>');
            include_once 'functions/update/updateUserIdByShopId.php';
            if(!isset($post['userId'])) {
                $result['success'] = false;
                $result['msg'] = 'No userId to update.';
                break;
            }
            if(!isset($post['shopId'])) {
                $result['success'] = false;
                $result['msg'] = 'No shopId to update.';
                break;
            }
            $result = updateUserIdByShopId($post['shopId'],$post['userId']);
            break;
        
        case 'updateUserIdByOrder':
            debug('I am inside the post method updateUserIdByOrder <br>');
            include_once 'functions/update/updateUserIdByOrder.php';
            if(!isset($post['userId'])) {
                $result['success'] = false;
                $result['msg'] = 'No userId to update.';
                break;
            }
            if(!isset($post['order'])) {
                $result['success'] = false;
                $result['msg'] = 'No order to update.';
                break;
            }
            $result = updateUserIdByOrder($post['order'],$post['userId']);
            break;
        
        case 'updateUserIdByShipDate':
            debug('I am inside the post method updateUserIdByShipDate <br>');
            include_once 'functions/update/updateUserIdByShipDate.php';
            if(!isset($post['userId'])) {
                $result['success'] = false;
                $result['msg'] = 'No userId to update.';
                break;
            }
            if(!isset($post['shipDate'])) {
                $result['success'] = false;
                $result['msg'] = 'No shipDate to update.';
                break;
            }
            $result = updateUserIdByShipDate($post['shipDate'],$post['userId']);
            break;
        
        case 'updateUserIdByStatus':
            debug('I am inside the post method updateUserIdByStatus <br>');
            include_once 'functions/update/updateUserIdByStatus.php';
            if(!isset($post['userId'])) {
                $result['success'] = false;
                $result['msg'] = 'No userId to update.';
                break;
            }
            if(!isset($post['Status'])) {
                $result['success'] = false;
                $result['msg'] = 'No Status to update.';
                break;
            }
            $result = updateUserIdByStatus($post['Status'],$post['userId']);
            break;
        
        case 'updateUserIdByPrice':
            debug('I am inside the post method updateUserIdByPrice <br>');
            include_once 'functions/update/updateUserIdByPrice.php';
            if(!isset($post['userId'])) {
                $result['success'] = false;
                $result['msg'] = 'No userId to update.';
                break;
            }
            if(!isset($post['price'])) {
                $result['success'] = false;
                $result['msg'] = 'No price to update.';
                break;
            }
            $result = updateUserIdByPrice($post['price'],$post['userId']);
            break;
        
        case 'updateUserIdByPickAddress':
            debug('I am inside the post method updateUserIdByPickAddress <br>');
            include_once 'functions/update/updateUserIdByPickAddress.php';
            if(!isset($post['userId'])) {
                $result['success'] = false;
                $result['msg'] = 'No userId to update.';
                break;
            }
            if(!isset($post['pickAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No pickAddress to update.';
                break;
            }
            $result = updateUserIdByPickAddress($post['pickAddress'],$post['userId']);
            break;
        
        case 'updateUserIdByDeliveryAddress':
            debug('I am inside the post method updateUserIdByDeliveryAddress <br>');
            include_once 'functions/update/updateUserIdByDeliveryAddress.php';
            if(!isset($post['userId'])) {
                $result['success'] = false;
                $result['msg'] = 'No userId to update.';
                break;
            }
            if(!isset($post['deliveryAddress'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryAddress to update.';
                break;
            }
            $result = updateUserIdByDeliveryAddress($post['deliveryAddress'],$post['userId']);
            break;
        
        case 'updateUserIdByQuarrelDescription':
            debug('I am inside the post method updateUserIdByQuarrelDescription <br>');
            include_once 'functions/update/updateUserIdByQuarrelDescription.php';
            if(!isset($post['userId'])) {
                $result['success'] = false;
                $result['msg'] = 'No userId to update.';
                break;
            }
            if(!isset($post['quarrelDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelDescription to update.';
                break;
            }
            $result = updateUserIdByQuarrelDescription($post['quarrelDescription'],$post['userId']);
            break;
        
        case 'updateUserIdByQuarrelPicture':
            debug('I am inside the post method updateUserIdByQuarrelPicture <br>');
            include_once 'functions/update/updateUserIdByQuarrelPicture.php';
            if(!isset($post['userId'])) {
                $result['success'] = false;
                $result['msg'] = 'No userId to update.';
                break;
            }
            if(!isset($post['quarrelPicture'])) {
                $result['success'] = false;
                $result['msg'] = 'No quarrelPicture to update.';
                break;
            }
            $result = updateUserIdByQuarrelPicture($post['quarrelPicture'],$post['userId']);
            break;
        
        case 'updateUserIdByReviewDescription':
            debug('I am inside the post method updateUserIdByReviewDescription <br>');
            include_once 'functions/update/updateUserIdByReviewDescription.php';
            if(!isset($post['userId'])) {
                $result['success'] = false;
                $result['msg'] = 'No userId to update.';
                break;
            }
            if(!isset($post['reviewDescription'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewDescription to update.';
                break;
            }
            $result = updateUserIdByReviewDescription($post['reviewDescription'],$post['userId']);
            break;
        
        case 'updateUserIdByReviewLevel':
            debug('I am inside the post method updateUserIdByReviewLevel <br>');
            include_once 'functions/update/updateUserIdByReviewLevel.php';
            if(!isset($post['userId'])) {
                $result['success'] = false;
                $result['msg'] = 'No userId to update.';
                break;
            }
            if(!isset($post['reviewLevel'])) {
                $result['success'] = false;
                $result['msg'] = 'No reviewLevel to update.';
                break;
            }
            $result = updateUserIdByReviewLevel($post['reviewLevel'],$post['userId']);
            break;
        
        case 'updateUserIdByDeliveryId':
            debug('I am inside the post method updateUserIdByDeliveryId <br>');
            include_once 'functions/update/updateUserIdByDeliveryId.php';
            if(!isset($post['userId'])) {
                $result['success'] = false;
                $result['msg'] = 'No userId to update.';
                break;
            }
            if(!isset($post['deliveryId'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryId to update.';
                break;
            }
            $result = updateUserIdByDeliveryId($post['deliveryId'],$post['userId']);
            break;
        
        case 'updateUserIdByDeliveryMoney':
            debug('I am inside the post method updateUserIdByDeliveryMoney <br>');
            include_once 'functions/update/updateUserIdByDeliveryMoney.php';
            if(!isset($post['userId'])) {
                $result['success'] = false;
                $result['msg'] = 'No userId to update.';
                break;
            }
            if(!isset($post['deliveryMoney'])) {
                $result['success'] = false;
                $result['msg'] = 'No deliveryMoney to update.';
                break;
            }
            $result = updateUserIdByDeliveryMoney($post['deliveryMoney'],$post['userId']);
            break;
        
        default:
            $result['success']=false;
            $result['msg']='No valid case selected';
            break;
    }
    return $result;
}

?>
    
<?php

    include_once '../configuracion.php';
    
/*!
 * \brief      Handler for order.
 * \details    It has every function to interact with the `order` in the database (Create, read, update, delete)
 * \param      $id       (INT)    1 unique id for each order
 * \param      $shop       (VARCHAR)   Shoping name
 * \param      $shopId       (INT)   Shopping identifier
 * \param      $order       (VARCHAR)   What people asked for
 * \param      $shipDate       (DATE)   when people ordered it
 * \param      $Status       (VARCHAR)   If it's delivered or not
 * \param      $price       (VARCHAR)   total price of the order
 * \param      $pickAddress       (VARCHAR)   shopping location
 * \param      $deliveryAddress       (VARCHAR)   users location
 * \param      $quarrelDescription       (VARCHAR)   Description if there was a problem
 * \param      $quarrelPicture       (VARCHAR)   base64 picture if there was a problem
 * \param      $reviewDescription       (VARCHAR)   user's comments for shop reputation
 * \param      $reviewLevel       (INT)   How many stars users gave
 * \param      $deliveryId       (INT)   Id of the delivery guy
 * \param      $deliveryMoney       (VARCHAR)   How much of price goes to delivery
 * \param      $userId       (INT)   Id of the user that ordered
 */
class order
{
    
/*!
* \brief    PDO instance for the database
*/
    private $base;


    /*!
* \brief    (INT) 1 unique id for each order
*/
    private $id;

/*!
* \brief    (VARCHAR)Shoping name
*/
    private $shop;

/*!
* \brief    (INT)Shopping identifier
*/
    private $shopId;

/*!
* \brief    (VARCHAR)What people asked for
*/
    private $order;

/*!
* \brief    (DATE)when people ordered it
*/
    private $shipDate;

/*!
* \brief    (VARCHAR)If it's delivered or not
*/
    private $Status;

/*!
* \brief    (VARCHAR)total price of the order
*/
    private $price;

/*!
* \brief    (VARCHAR)shopping location
*/
    private $pickAddress;

/*!
* \brief    (VARCHAR)users location
*/
    private $deliveryAddress;

/*!
* \brief    (VARCHAR)Description if there was a problem
*/
    private $quarrelDescription;

/*!
* \brief    (VARCHAR)base64 picture if there was a problem
*/
    private $quarrelPicture;

/*!
* \brief    (VARCHAR)user's comments for shop reputation
*/
    private $reviewDescription;

/*!
* \brief    (INT)How many stars users gave
*/
    private $reviewLevel;

/*!
* \brief    (INT)Id of the delivery guy
*/
    private $deliveryId;

/*!
* \brief    (VARCHAR)How much of price goes to delivery
*/
    private $deliveryMoney;

/*!
* \brief    (INT)Id of the user that ordered
*/
    private $userId;


/*!
* \brief    Sets id for the caller instance.
* \details  The value received as a param is added to the id property of the instance of this class.
* \param $var    (INT) id I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_id($var) {
        $success=true;
        $this->id=$var;
        return $success;
    }



/*!
* \brief    Sets shop for the caller instance.
* \details  The value received as a param is added to the shop property of the instance of this class.
* \param $var    (VARCHAR) shop I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_shop($var) {
        $success=true;
        $this->shop=$var;
        return $success;
    }



/*!
* \brief    Sets shopId for the caller instance.
* \details  The value received as a param is added to the shopId property of the instance of this class.
* \param $var    (INT) shopId I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_shopId($var) {
        $success=true;
        $this->shopId=$var;
        return $success;
    }



/*!
* \brief    Sets `order` for the caller instance.
* \details  The value received as a param is added to the `order` property of the instance of this class.
* \param $var    (VARCHAR) `order` I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_order($var) {
        $success=true;
        $this->order=$var;
        return $success;
    }



/*!
* \brief    Sets shipDate for the caller instance.
* \details  The value received as a param is added to the shipDate property of the instance of this class.
* \param $var    (DATE) shipDate I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_shipDate($var) {
        $success=true;
        $this->shipDate=$var;
        return $success;
    }



/*!
* \brief    Sets Status for the caller instance.
* \details  The value received as a param is added to the Status property of the instance of this class.
* \param $var    (VARCHAR) Status I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_Status($var) {
        $success=true;
        $this->Status=$var;
        return $success;
    }



/*!
* \brief    Sets price for the caller instance.
* \details  The value received as a param is added to the price property of the instance of this class.
* \param $var    (VARCHAR) price I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_price($var) {
        $success=true;
        $this->price=$var;
        return $success;
    }



/*!
* \brief    Sets pickAddress for the caller instance.
* \details  The value received as a param is added to the pickAddress property of the instance of this class.
* \param $var    (VARCHAR) pickAddress I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_pickAddress($var) {
        $success=true;
        $this->pickAddress=$var;
        return $success;
    }



/*!
* \brief    Sets deliveryAddress for the caller instance.
* \details  The value received as a param is added to the deliveryAddress property of the instance of this class.
* \param $var    (VARCHAR) deliveryAddress I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_deliveryAddress($var) {
        $success=true;
        $this->deliveryAddress=$var;
        return $success;
    }



/*!
* \brief    Sets quarrelDescription for the caller instance.
* \details  The value received as a param is added to the quarrelDescription property of the instance of this class.
* \param $var    (VARCHAR) quarrelDescription I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_quarrelDescription($var) {
        $success=true;
        $this->quarrelDescription=$var;
        return $success;
    }



/*!
* \brief    Sets quarrelPicture for the caller instance.
* \details  The value received as a param is added to the quarrelPicture property of the instance of this class.
* \param $var    (VARCHAR) quarrelPicture I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_quarrelPicture($var) {
        $success=true;
        $this->quarrelPicture=$var;
        return $success;
    }



/*!
* \brief    Sets reviewDescription for the caller instance.
* \details  The value received as a param is added to the reviewDescription property of the instance of this class.
* \param $var    (VARCHAR) reviewDescription I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_reviewDescription($var) {
        $success=true;
        $this->reviewDescription=$var;
        return $success;
    }



/*!
* \brief    Sets reviewLevel for the caller instance.
* \details  The value received as a param is added to the reviewLevel property of the instance of this class.
* \param $var    (INT) reviewLevel I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_reviewLevel($var) {
        $success=true;
        $this->reviewLevel=$var;
        return $success;
    }



/*!
* \brief    Sets deliveryId for the caller instance.
* \details  The value received as a param is added to the deliveryId property of the instance of this class.
* \param $var    (INT) deliveryId I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_deliveryId($var) {
        $success=true;
        $this->deliveryId=$var;
        return $success;
    }



/*!
* \brief    Sets deliveryMoney for the caller instance.
* \details  The value received as a param is added to the deliveryMoney property of the instance of this class.
* \param $var    (VARCHAR) deliveryMoney I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_deliveryMoney($var) {
        $success=true;
        $this->deliveryMoney=$var;
        return $success;
    }



/*!
* \brief    Sets userId for the caller instance.
* \details  The value received as a param is added to the userId property of the instance of this class.
* \param $var    (INT) userId I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_userId($var) {
        $success=true;
        $this->userId=$var;
        return $success;
    }



/*!
* \brief    Gets id for the caller instance.
* \details  The id property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->id  (INT) returns the id already set in the instance of this class.
*/
    public function get_id() {
        return($this->id);
    }



/*!
* \brief    Gets shop for the caller instance.
* \details  The shop property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->shop  (VARCHAR) returns the shop already set in the instance of this class.
*/
    public function get_shop() {
        return($this->shop);
    }



/*!
* \brief    Gets shopId for the caller instance.
* \details  The shopId property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->shopId  (INT) returns the shopId already set in the instance of this class.
*/
    public function get_shopId() {
        return($this->shopId);
    }



/*!
* \brief    Gets `order` for the caller instance.
* \details  The `order` property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->order  (VARCHAR) returns the `order` already set in the instance of this class.
*/
    public function get_order() {
        return($this->order);
    }



/*!
* \brief    Gets shipDate for the caller instance.
* \details  The shipDate property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->shipDate  (DATE) returns the shipDate already set in the instance of this class.
*/
    public function get_shipDate() {
        return($this->shipDate);
    }



/*!
* \brief    Gets Status for the caller instance.
* \details  The Status property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->Status  (VARCHAR) returns the Status already set in the instance of this class.
*/
    public function get_Status() {
        return($this->Status);
    }



/*!
* \brief    Gets price for the caller instance.
* \details  The price property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->price  (VARCHAR) returns the price already set in the instance of this class.
*/
    public function get_price() {
        return($this->price);
    }



/*!
* \brief    Gets pickAddress for the caller instance.
* \details  The pickAddress property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->pickAddress  (VARCHAR) returns the pickAddress already set in the instance of this class.
*/
    public function get_pickAddress() {
        return($this->pickAddress);
    }



/*!
* \brief    Gets deliveryAddress for the caller instance.
* \details  The deliveryAddress property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->deliveryAddress  (VARCHAR) returns the deliveryAddress already set in the instance of this class.
*/
    public function get_deliveryAddress() {
        return($this->deliveryAddress);
    }



/*!
* \brief    Gets quarrelDescription for the caller instance.
* \details  The quarrelDescription property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->quarrelDescription  (VARCHAR) returns the quarrelDescription already set in the instance of this class.
*/
    public function get_quarrelDescription() {
        return($this->quarrelDescription);
    }



/*!
* \brief    Gets quarrelPicture for the caller instance.
* \details  The quarrelPicture property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->quarrelPicture  (VARCHAR) returns the quarrelPicture already set in the instance of this class.
*/
    public function get_quarrelPicture() {
        return($this->quarrelPicture);
    }



/*!
* \brief    Gets reviewDescription for the caller instance.
* \details  The reviewDescription property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->reviewDescription  (VARCHAR) returns the reviewDescription already set in the instance of this class.
*/
    public function get_reviewDescription() {
        return($this->reviewDescription);
    }



/*!
* \brief    Gets reviewLevel for the caller instance.
* \details  The reviewLevel property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->reviewLevel  (INT) returns the reviewLevel already set in the instance of this class.
*/
    public function get_reviewLevel() {
        return($this->reviewLevel);
    }



/*!
* \brief    Gets deliveryId for the caller instance.
* \details  The deliveryId property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->deliveryId  (INT) returns the deliveryId already set in the instance of this class.
*/
    public function get_deliveryId() {
        return($this->deliveryId);
    }



/*!
* \brief    Gets deliveryMoney for the caller instance.
* \details  The deliveryMoney property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->deliveryMoney  (VARCHAR) returns the deliveryMoney already set in the instance of this class.
*/
    public function get_deliveryMoney() {
        return($this->deliveryMoney);
    }



/*!
* \brief    Gets userId for the caller instance.
* \details  The userId property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->userId  (INT) returns the userId already set in the instance of this class.
*/
    public function get_userId() {
        return($this->userId);
    }



/*!
* \brief    Constructor function.
* \details  Turns on the Database and connect it.
* \param    (void) non param needed.
* \return   error  (void) Nothing is return really but if there is an error a message will be printed
*/
    public function __construct() {
        try
        {
            $this->base = new PDO('mysql:host=localhost; dbname='.DBNAME,DBUSER,DBPASSWD);
            $this->base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->base->exec('SET CHARACTER SET utf8');
        }
        catch (Exception $e) 
        {
            $success['success'] = false;
            $success['msg'] = $e->getMessage();
            echo json_encode($success);
        }
    }



/*!
* \brief    Add new data to the table.
* \details  Using PDO, htmlentities and addslashes, we insert the data contained in the instance of the callee class.
* \param    (void) non param needed.
* \return   $success  (bool) true if it has added the value, false in any other case.
*/
    public function insert() {
        debug('in insert<br>');
        //SQL query for insertion of the data saved in this instance

        $query = 'INSERT INTO `order` (shop, shopId, `order`, shipDate, `Status`, price, pickAddress, deliveryAddress, quarrelDescription, quarrelPicture, reviewDescription, reviewLevel, deliveryId, deliveryMoney, userId) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

        $result= $this->base->prepare($query);

       //$this->id =       htmlentities(addslashes($this->id));
       $this->shop =       htmlentities(addslashes($this->shop));
       $this->shopId =       htmlentities(addslashes($this->shopId));
       $this->order =       htmlentities(addslashes($this->order));
       $this->shipDate =       htmlentities(addslashes($this->shipDate));
       $this->Status =       htmlentities(addslashes($this->Status));
       $this->price =       htmlentities(addslashes($this->price));
       $this->pickAddress =       htmlentities(addslashes($this->pickAddress));
       $this->deliveryAddress =       htmlentities(addslashes($this->deliveryAddress));
       $this->quarrelDescription =       htmlentities(addslashes($this->quarrelDescription));
       $this->quarrelPicture =       htmlentities(addslashes($this->quarrelPicture));
       $this->reviewDescription =       htmlentities(addslashes($this->reviewDescription));
       $this->reviewLevel =       htmlentities(addslashes($this->reviewLevel));
       $this->deliveryId =       htmlentities(addslashes($this->deliveryId));
       $this->deliveryMoney =       htmlentities(addslashes($this->deliveryMoney));
       $this->userId =       htmlentities(addslashes($this->userId));


        $success = $result->execute(array($this->shop,$this->shopId,$this->order,$this->shipDate,$this->Status,$this->price,$this->pickAddress,$this->deliveryAddress,$this->quarrelDescription,$this->quarrelPicture,$this->reviewDescription,$this->reviewLevel,$this->deliveryId,$this->deliveryMoney,$this->userId)); 

        $result ->closeCursor();
            
        // I send success to handle mistakes
        return $success;
    
    }
    


/*!
* \brief    Update all column features by id.
* \details  Using PDO, htmlentities and addslashes, we update the data contained in the instance of the callee class.
* \param $id    identifier used to find rows to change.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
public function updateAllById($Id) {
    //SQL query for updating
    $query = 'update `order` set shop=?, shopId=?, `order`=?, shipDate=?, Status=?, price=?, pickAddress=?, deliveryAddress=?, quarrelDescription=?, quarrelPicture=?, reviewDescription=?, reviewLevel=?, deliveryId=?, deliveryMoney=?, userId=? where id=?';
    $result = $this->base->prepare($query);

    $this->shop = htmlentities(addslashes($this->shop));
    $this->shopId = htmlentities(addslashes($this->shopId));
    $this->order = htmlentities(addslashes($this->order));
    $this->shipDate = htmlentities(addslashes($this->shipDate));
    $this->Status = htmlentities(addslashes($this->Status));
    $this->price = htmlentities(addslashes($this->price));
    $this->pickAddress = htmlentities(addslashes($this->pickAddress));
    $this->deliveryAddress = htmlentities(addslashes($this->deliveryAddress));
    $this->quarrelDescription = htmlentities(addslashes($this->quarrelDescription));
    $this->quarrelPicture = htmlentities(addslashes($this->quarrelPicture));
    $this->reviewDescription = htmlentities(addslashes($this->reviewDescription));
    $this->reviewLevel = htmlentities(addslashes($this->reviewLevel));
    $this->deliveryId = htmlentities(addslashes($this->deliveryId));
    $this->deliveryMoney = htmlentities(addslashes($this->deliveryMoney));
    $this->userId = htmlentities(addslashes($this->userId));

    $success = $result->execute(array($this->shop, $this->shopId, $this->order, $this->shipDate, $this->Status, $this->price, $this->pickAddress, $this->deliveryAddress, $this->quarrelDescription, $this->quarrelPicture, $this->reviewDescription, $this->reviewLevel, $this->deliveryId, $this->deliveryMoney, $this->userId, $Id));

    $result->closeCursor();

    // I send success to handle mistakes
    return $success;
}    


/*!
* \brief    Update shop by shopId.
* \details  Using PDO, htmlentities and addslashes, we update the shop contained in the instance of the callee class.
* \param $shopId    identifier of the table we want to change shop.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateShopByShopId($shopId) {
        //SQL query for updating
        $query='update `order` set shop=? where shopId=?'; 

        $resultado= $this->base->prepare($query);
        $this->shop =          htmlentities(addslashes($this->shop));
        $this->shopId =                   htmlentities(addslashes($shopId));
        
        $success = $resultado->execute(array($this->shop, $this->shopId));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Update `order` by id.
* \details  Using PDO, htmlentities and addslashes, we update the `order` contained in the instance of the callee class.
* \param $id    identifier of the table we want to change order.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateOrderById($id) {
        //SQL query for updating
        $query='update `order` set order=? where id=?'; 

        $resultado= $this->base->prepare($query);
        $this->order =          htmlentities(addslashes($this->order));
        $this->id =                   htmlentities(addslashes($id));
        
        $success = $resultado->execute(array($this->order, $this->id));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Update Status by id.
* \details  Using PDO, htmlentities and addslashes, we update the Status contained in the instance of the callee class.
* \param $id    identifier of the table we want to change Status.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateStatusById($id) {
        //SQL query for updating
        $query='update `order` set Status=? where id=?'; 

        $resultado= $this->base->prepare($query);
        $this->Status =          htmlentities(addslashes($this->Status));
        $this->id =                   htmlentities(addslashes($id));
        
        $success = $resultado->execute(array($this->Status, $this->id));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Update price by id.
* \details  Using PDO, htmlentities and addslashes, we update the price contained in the instance of the callee class.
* \param $id    identifier of the table we want to change price.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updatePriceById($id) {
        //SQL query for updating
        $query='update `order` set price=? where id=?'; 

        $resultado= $this->base->prepare($query);
        $this->price =          htmlentities(addslashes($this->price));
        $this->id =                   htmlentities(addslashes($id));
        
        $success = $resultado->execute(array($this->price, $this->id));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Update pickAddress by id.
* \details  Using PDO, htmlentities and addslashes, we update the pickAddress contained in the instance of the callee class.
* \param $id    identifier of the table we want to change pickAddress.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updatePickAddressById($id) {
        //SQL query for updating
        $query='update `order` set pickAddress=? where id=?'; 

        $resultado= $this->base->prepare($query);
        $this->pickAddress =          htmlentities(addslashes($this->pickAddress));
        $this->id =                   htmlentities(addslashes($id));
        
        $success = $resultado->execute(array($this->pickAddress, $this->id));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Update deliveryAddress by id.
* \details  Using PDO, htmlentities and addslashes, we update the deliveryAddress contained in the instance of the callee class.
* \param $id    identifier of the table we want to change deliveryAddress.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateDeliveryAddressById($id) {
        //SQL query for updating
        $query='update `order` set deliveryAddress=? where id=?'; 

        $resultado= $this->base->prepare($query);
        $this->deliveryAddress =          htmlentities(addslashes($this->deliveryAddress));
        $this->id =                   htmlentities(addslashes($id));
        
        $success = $resultado->execute(array($this->deliveryAddress, $this->id));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Update quarrelDescription by id.
* \details  Using PDO, htmlentities and addslashes, we update the quarrelDescription contained in the instance of the callee class.
* \param $id    identifier of the table we want to change quarrelDescription.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateQuarrelDescriptionById($id) {
        //SQL query for updating
        $query='update `order` set quarrelDescription=? where id=?'; 

        $resultado= $this->base->prepare($query);
        $this->quarrelDescription =          htmlentities(addslashes($this->quarrelDescription));
        $this->id =                   htmlentities(addslashes($id));
        
        $success = $resultado->execute(array($this->quarrelDescription, $this->id));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Update quarrelPicture by id.
* \details  Using PDO, htmlentities and addslashes, we update the quarrelPicture contained in the instance of the callee class.
* \param $id    identifier of the table we want to change quarrelPicture.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateQuarrelPictureById($id) {
        //SQL query for updating
        $query='update `order` set quarrelPicture=? where id=?'; 

        $resultado= $this->base->prepare($query);
        $this->quarrelPicture =          htmlentities(addslashes($this->quarrelPicture));
        $this->id =                   htmlentities(addslashes($id));
        
        $success = $resultado->execute(array($this->quarrelPicture, $this->id));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Update reviewDescription by id.
* \details  Using PDO, htmlentities and addslashes, we update the reviewDescription contained in the instance of the callee class.
* \param $id    identifier of the table we want to change reviewDescription.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateReviewDescriptionById($id) {
        //SQL query for updating
        $query='update `order` set reviewDescription=? where id=?'; 

        $resultado= $this->base->prepare($query);
        $this->reviewDescription =          htmlentities(addslashes($this->reviewDescription));
        $this->id =                   htmlentities(addslashes($id));
        
        $success = $resultado->execute(array($this->reviewDescription, $this->id));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Update reviewLevel by id.
* \details  Using PDO, htmlentities and addslashes, we update the reviewLevel contained in the instance of the callee class.
* \param $id    identifier of the table we want to change reviewLevel.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateReviewLevelById($id) {
        //SQL query for updating
        $query='update `order` set reviewLevel=? where id=?'; 

        $resultado= $this->base->prepare($query);
        $this->reviewLevel =          htmlentities(addslashes($this->reviewLevel));
        $this->id =                   htmlentities(addslashes($id));
        
        $success = $resultado->execute(array($this->reviewLevel, $this->id));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Update deliveryId by id.
* \details  Using PDO, htmlentities and addslashes, we update the deliveryId contained in the instance of the callee class.
* \param $id    identifier of the table we want to change deliveryId.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateDeliveryIdById($id) {
        //SQL query for updating
        $query='update `order` set deliveryId=? where id=?'; 

        $resultado= $this->base->prepare($query);
        $this->deliveryId =          htmlentities(addslashes($this->deliveryId));
        $this->id =                   htmlentities(addslashes($id));
        
        $success = $resultado->execute(array($this->deliveryId, $this->id));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Update deliveryMoney by id.
* \details  Using PDO, htmlentities and addslashes, we update the deliveryMoney contained in the instance of the callee class.
* \param $id    identifier of the table we want to change deliveryMoney.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateDeliveryMoneyById($id) {
        //SQL query for updating
        $query='update `order` set deliveryMoney=? where id=?'; 

        $resultado= $this->base->prepare($query);
        $this->deliveryMoney =          htmlentities(addslashes($this->deliveryMoney));
        $this->id =                   htmlentities(addslashes($id));
        
        $success = $resultado->execute(array($this->deliveryMoney, $this->id));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Update userId by id.
* \details  Using PDO, htmlentities and addslashes, we update the userId contained in the instance of the callee class.
* \param $id    identifier of the table we want to change userId.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateUserIdById($id) {
        //SQL query for updating
        $query='update `order` set userId=? where id=?'; 

        $resultado= $this->base->prepare($query);
        $this->userId =          htmlentities(addslashes($this->userId));
        $this->id =                   htmlentities(addslashes($id));
        
        $success = $resultado->execute(array($this->userId, $this->id));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Gets all the rows from the database 
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \return   $row  (array) all pairs of -id-shop-shopId-order-shipDate-Status-price-pickAddress-deliveryAddress-quarrelDescription-quarrelPicture-reviewDescription-reviewLevel-deliveryId-deliveryMoney-userId in the database.
*/    
    public function readAll() {
        $query='select * from `order` where 1';
        $result= $this->base->prepare($query);
        
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$order) {
                $order['id'] = stripslashes(html_entity_decode($order['id'])); 
                $order['shop'] = stripslashes(html_entity_decode($order['shop'])); 
                $order['shopId'] = stripslashes(html_entity_decode($order['shopId'])); 
                $order['order'] = stripslashes(html_entity_decode($order['order'])); 
                $order['shipDate'] = stripslashes(html_entity_decode($order['shipDate'])); 
                $order['Status'] = stripslashes(html_entity_decode($order['Status'])); 
                $order['price'] = stripslashes(html_entity_decode($order['price'])); 
                $order['pickAddress'] = stripslashes(html_entity_decode($order['pickAddress'])); 
                $order['deliveryAddress'] = stripslashes(html_entity_decode($order['deliveryAddress'])); 
                $order['quarrelDescription'] = stripslashes(html_entity_decode($order['quarrelDescription'])); 
                $order['quarrelPicture'] = stripslashes(html_entity_decode($order['quarrelPicture'])); 
                $order['reviewDescription'] = stripslashes(html_entity_decode($order['reviewDescription'])); 
                $order['reviewLevel'] = stripslashes(html_entity_decode($order['reviewLevel'])); 
                $order['deliveryId'] = stripslashes(html_entity_decode($order['deliveryId'])); 
                $order['deliveryMoney'] = stripslashes(html_entity_decode($order['deliveryMoney'])); 
                $order['userId'] = stripslashes(html_entity_decode($order['userId'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where id equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    id.
* \return   $row  (array) all pairs of -id-shop-shopId-order-shipDate-Status-price-pickAddress-deliveryAddress-quarrelDescription-quarrelPicture-reviewDescription-reviewLevel-deliveryId-deliveryMoney-userId in the database.
*/    
    public function readId($id) {
        $query='select * from `order` where id=:id';
        $result= $this->base->prepare($query);
        
        $id=htmlentities(addslashes($id));
        $result->BindValue(':id',$id);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$order) {
                $order['id'] = stripslashes(html_entity_decode($order['id'])); 
                $order['shop'] = stripslashes(html_entity_decode($order['shop'])); 
                $order['shopId'] = stripslashes(html_entity_decode($order['shopId'])); 
                $order['order'] = stripslashes(html_entity_decode($order['order'])); 
                $order['shipDate'] = stripslashes(html_entity_decode($order['shipDate'])); 
                $order['Status'] = stripslashes(html_entity_decode($order['Status'])); 
                $order['price'] = stripslashes(html_entity_decode($order['price'])); 
                $order['pickAddress'] = stripslashes(html_entity_decode($order['pickAddress'])); 
                $order['deliveryAddress'] = stripslashes(html_entity_decode($order['deliveryAddress'])); 
                $order['quarrelDescription'] = stripslashes(html_entity_decode($order['quarrelDescription'])); 
                $order['quarrelPicture'] = stripslashes(html_entity_decode($order['quarrelPicture'])); 
                $order['reviewDescription'] = stripslashes(html_entity_decode($order['reviewDescription'])); 
                $order['reviewLevel'] = stripslashes(html_entity_decode($order['reviewLevel'])); 
                $order['deliveryId'] = stripslashes(html_entity_decode($order['deliveryId'])); 
                $order['deliveryMoney'] = stripslashes(html_entity_decode($order['deliveryMoney'])); 
                $order['userId'] = stripslashes(html_entity_decode($order['userId'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where shop equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    shop.
* \return   $row  (array) all pairs of -id-shop-shopId-order-shipDate-Status-price-pickAddress-deliveryAddress-quarrelDescription-quarrelPicture-reviewDescription-reviewLevel-deliveryId-deliveryMoney-userId in the database.
*/    
    public function readShop($shop) {
        $query='select * from `order` where shop=:shop';
        $result= $this->base->prepare($query);
        
        $shop=htmlentities(addslashes($shop));
        $result->BindValue(':shop',$shop);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$order) {
                $order['id'] = stripslashes(html_entity_decode($order['id'])); 
                $order['shop'] = stripslashes(html_entity_decode($order['shop'])); 
                $order['shopId'] = stripslashes(html_entity_decode($order['shopId'])); 
                $order['order'] = stripslashes(html_entity_decode($order['order'])); 
                $order['shipDate'] = stripslashes(html_entity_decode($order['shipDate'])); 
                $order['Status'] = stripslashes(html_entity_decode($order['Status'])); 
                $order['price'] = stripslashes(html_entity_decode($order['price'])); 
                $order['pickAddress'] = stripslashes(html_entity_decode($order['pickAddress'])); 
                $order['deliveryAddress'] = stripslashes(html_entity_decode($order['deliveryAddress'])); 
                $order['quarrelDescription'] = stripslashes(html_entity_decode($order['quarrelDescription'])); 
                $order['quarrelPicture'] = stripslashes(html_entity_decode($order['quarrelPicture'])); 
                $order['reviewDescription'] = stripslashes(html_entity_decode($order['reviewDescription'])); 
                $order['reviewLevel'] = stripslashes(html_entity_decode($order['reviewLevel'])); 
                $order['deliveryId'] = stripslashes(html_entity_decode($order['deliveryId'])); 
                $order['deliveryMoney'] = stripslashes(html_entity_decode($order['deliveryMoney'])); 
                $order['userId'] = stripslashes(html_entity_decode($order['userId'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where shopId equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    shopId.
* \return   $row  (array) all pairs of -id-shop-shopId-order-shipDate-Status-price-pickAddress-deliveryAddress-quarrelDescription-quarrelPicture-reviewDescription-reviewLevel-deliveryId-deliveryMoney-userId in the database.
*/    
    public function readShopId($shopId) {
        $query='select * from `order` where shopId=:shopId';
        $result= $this->base->prepare($query);
        
        $shopId=htmlentities(addslashes($shopId));
        $result->BindValue(':shopId',$shopId);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$order) {
                $order['id'] = stripslashes(html_entity_decode($order['id'])); 
                $order['shop'] = stripslashes(html_entity_decode($order['shop'])); 
                $order['shopId'] = stripslashes(html_entity_decode($order['shopId'])); 
                $order['order'] = stripslashes(html_entity_decode($order['order'])); 
                $order['shipDate'] = stripslashes(html_entity_decode($order['shipDate'])); 
                $order['Status'] = stripslashes(html_entity_decode($order['Status'])); 
                $order['price'] = stripslashes(html_entity_decode($order['price'])); 
                $order['pickAddress'] = stripslashes(html_entity_decode($order['pickAddress'])); 
                $order['deliveryAddress'] = stripslashes(html_entity_decode($order['deliveryAddress'])); 
                $order['quarrelDescription'] = stripslashes(html_entity_decode($order['quarrelDescription'])); 
                $order['quarrelPicture'] = stripslashes(html_entity_decode($order['quarrelPicture'])); 
                $order['reviewDescription'] = stripslashes(html_entity_decode($order['reviewDescription'])); 
                $order['reviewLevel'] = stripslashes(html_entity_decode($order['reviewLevel'])); 
                $order['deliveryId'] = stripslashes(html_entity_decode($order['deliveryId'])); 
                $order['deliveryMoney'] = stripslashes(html_entity_decode($order['deliveryMoney'])); 
                $order['userId'] = stripslashes(html_entity_decode($order['userId'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where `order` equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    order.
* \return   $row  (array) all pairs of -id-shop-shopId-order-shipDate-Status-price-pickAddress-deliveryAddress-quarrelDescription-quarrelPicture-reviewDescription-reviewLevel-deliveryId-deliveryMoney-userId in the database.
*/    
    public function readOrder($order) {
        $query='select * from `order` where order=:order';
        $result= $this->base->prepare($query);
        
        $order=htmlentities(addslashes($order));
        $result->BindValue(':order',$order);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$order) {
                $order['id'] = stripslashes(html_entity_decode($order['id'])); 
                $order['shop'] = stripslashes(html_entity_decode($order['shop'])); 
                $order['shopId'] = stripslashes(html_entity_decode($order['shopId'])); 
                $order['order'] = stripslashes(html_entity_decode($order['order'])); 
                $order['shipDate'] = stripslashes(html_entity_decode($order['shipDate'])); 
                $order['Status'] = stripslashes(html_entity_decode($order['Status'])); 
                $order['price'] = stripslashes(html_entity_decode($order['price'])); 
                $order['pickAddress'] = stripslashes(html_entity_decode($order['pickAddress'])); 
                $order['deliveryAddress'] = stripslashes(html_entity_decode($order['deliveryAddress'])); 
                $order['quarrelDescription'] = stripslashes(html_entity_decode($order['quarrelDescription'])); 
                $order['quarrelPicture'] = stripslashes(html_entity_decode($order['quarrelPicture'])); 
                $order['reviewDescription'] = stripslashes(html_entity_decode($order['reviewDescription'])); 
                $order['reviewLevel'] = stripslashes(html_entity_decode($order['reviewLevel'])); 
                $order['deliveryId'] = stripslashes(html_entity_decode($order['deliveryId'])); 
                $order['deliveryMoney'] = stripslashes(html_entity_decode($order['deliveryMoney'])); 
                $order['userId'] = stripslashes(html_entity_decode($order['userId'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where shipDate equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    shipDate.
* \return   $row  (array) all pairs of -id-shop-shopId-order-shipDate-Status-price-pickAddress-deliveryAddress-quarrelDescription-quarrelPicture-reviewDescription-reviewLevel-deliveryId-deliveryMoney-userId in the database.
*/    
    public function readShipDate($shipDate) {
        $query='select * from `order` where shipDate=:shipDate';
        $result= $this->base->prepare($query);
        
        $shipDate=htmlentities(addslashes($shipDate));
        $result->BindValue(':shipDate',$shipDate);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$order) {
                $order['id'] = stripslashes(html_entity_decode($order['id'])); 
                $order['shop'] = stripslashes(html_entity_decode($order['shop'])); 
                $order['shopId'] = stripslashes(html_entity_decode($order['shopId'])); 
                $order['order'] = stripslashes(html_entity_decode($order['order'])); 
                $order['shipDate'] = stripslashes(html_entity_decode($order['shipDate'])); 
                $order['Status'] = stripslashes(html_entity_decode($order['Status'])); 
                $order['price'] = stripslashes(html_entity_decode($order['price'])); 
                $order['pickAddress'] = stripslashes(html_entity_decode($order['pickAddress'])); 
                $order['deliveryAddress'] = stripslashes(html_entity_decode($order['deliveryAddress'])); 
                $order['quarrelDescription'] = stripslashes(html_entity_decode($order['quarrelDescription'])); 
                $order['quarrelPicture'] = stripslashes(html_entity_decode($order['quarrelPicture'])); 
                $order['reviewDescription'] = stripslashes(html_entity_decode($order['reviewDescription'])); 
                $order['reviewLevel'] = stripslashes(html_entity_decode($order['reviewLevel'])); 
                $order['deliveryId'] = stripslashes(html_entity_decode($order['deliveryId'])); 
                $order['deliveryMoney'] = stripslashes(html_entity_decode($order['deliveryMoney'])); 
                $order['userId'] = stripslashes(html_entity_decode($order['userId'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where Status equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    Status.
* \return   $row  (array) all pairs of -id-shop-shopId-order-shipDate-Status-price-pickAddress-deliveryAddress-quarrelDescription-quarrelPicture-reviewDescription-reviewLevel-deliveryId-deliveryMoney-userId in the database.
*/    
    public function readStatus($Status) {
        $query='select * from `order` where Status=:Status';
        $result= $this->base->prepare($query);
        
        $Status=htmlentities(addslashes($Status));
        $result->BindValue(':Status',$Status);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$order) {
                $order['id'] = stripslashes(html_entity_decode($order['id'])); 
                $order['shop'] = stripslashes(html_entity_decode($order['shop'])); 
                $order['shopId'] = stripslashes(html_entity_decode($order['shopId'])); 
                $order['order'] = stripslashes(html_entity_decode($order['order'])); 
                $order['shipDate'] = stripslashes(html_entity_decode($order['shipDate'])); 
                $order['Status'] = stripslashes(html_entity_decode($order['Status'])); 
                $order['price'] = stripslashes(html_entity_decode($order['price'])); 
                $order['pickAddress'] = stripslashes(html_entity_decode($order['pickAddress'])); 
                $order['deliveryAddress'] = stripslashes(html_entity_decode($order['deliveryAddress'])); 
                $order['quarrelDescription'] = stripslashes(html_entity_decode($order['quarrelDescription'])); 
                $order['quarrelPicture'] = stripslashes(html_entity_decode($order['quarrelPicture'])); 
                $order['reviewDescription'] = stripslashes(html_entity_decode($order['reviewDescription'])); 
                $order['reviewLevel'] = stripslashes(html_entity_decode($order['reviewLevel'])); 
                $order['deliveryId'] = stripslashes(html_entity_decode($order['deliveryId'])); 
                $order['deliveryMoney'] = stripslashes(html_entity_decode($order['deliveryMoney'])); 
                $order['userId'] = stripslashes(html_entity_decode($order['userId'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where price equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    price.
* \return   $row  (array) all pairs of -id-shop-shopId-order-shipDate-Status-price-pickAddress-deliveryAddress-quarrelDescription-quarrelPicture-reviewDescription-reviewLevel-deliveryId-deliveryMoney-userId in the database.
*/    
    public function readPrice($price) {
        $query='select * from `order` where price=:price';
        $result= $this->base->prepare($query);
        
        $price=htmlentities(addslashes($price));
        $result->BindValue(':price',$price);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$order) {
                $order['id'] = stripslashes(html_entity_decode($order['id'])); 
                $order['shop'] = stripslashes(html_entity_decode($order['shop'])); 
                $order['shopId'] = stripslashes(html_entity_decode($order['shopId'])); 
                $order['order'] = stripslashes(html_entity_decode($order['order'])); 
                $order['shipDate'] = stripslashes(html_entity_decode($order['shipDate'])); 
                $order['Status'] = stripslashes(html_entity_decode($order['Status'])); 
                $order['price'] = stripslashes(html_entity_decode($order['price'])); 
                $order['pickAddress'] = stripslashes(html_entity_decode($order['pickAddress'])); 
                $order['deliveryAddress'] = stripslashes(html_entity_decode($order['deliveryAddress'])); 
                $order['quarrelDescription'] = stripslashes(html_entity_decode($order['quarrelDescription'])); 
                $order['quarrelPicture'] = stripslashes(html_entity_decode($order['quarrelPicture'])); 
                $order['reviewDescription'] = stripslashes(html_entity_decode($order['reviewDescription'])); 
                $order['reviewLevel'] = stripslashes(html_entity_decode($order['reviewLevel'])); 
                $order['deliveryId'] = stripslashes(html_entity_decode($order['deliveryId'])); 
                $order['deliveryMoney'] = stripslashes(html_entity_decode($order['deliveryMoney'])); 
                $order['userId'] = stripslashes(html_entity_decode($order['userId'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where pickAddress equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    pickAddress.
* \return   $row  (array) all pairs of -id-shop-shopId-order-shipDate-Status-price-pickAddress-deliveryAddress-quarrelDescription-quarrelPicture-reviewDescription-reviewLevel-deliveryId-deliveryMoney-userId in the database.
*/    
    public function readPickAddress($pickAddress) {
        $query='select * from `order` where pickAddress=:pickAddress';
        $result= $this->base->prepare($query);
        
        $pickAddress=htmlentities(addslashes($pickAddress));
        $result->BindValue(':pickAddress',$pickAddress);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$order) {
                $order['id'] = stripslashes(html_entity_decode($order['id'])); 
                $order['shop'] = stripslashes(html_entity_decode($order['shop'])); 
                $order['shopId'] = stripslashes(html_entity_decode($order['shopId'])); 
                $order['order'] = stripslashes(html_entity_decode($order['order'])); 
                $order['shipDate'] = stripslashes(html_entity_decode($order['shipDate'])); 
                $order['Status'] = stripslashes(html_entity_decode($order['Status'])); 
                $order['price'] = stripslashes(html_entity_decode($order['price'])); 
                $order['pickAddress'] = stripslashes(html_entity_decode($order['pickAddress'])); 
                $order['deliveryAddress'] = stripslashes(html_entity_decode($order['deliveryAddress'])); 
                $order['quarrelDescription'] = stripslashes(html_entity_decode($order['quarrelDescription'])); 
                $order['quarrelPicture'] = stripslashes(html_entity_decode($order['quarrelPicture'])); 
                $order['reviewDescription'] = stripslashes(html_entity_decode($order['reviewDescription'])); 
                $order['reviewLevel'] = stripslashes(html_entity_decode($order['reviewLevel'])); 
                $order['deliveryId'] = stripslashes(html_entity_decode($order['deliveryId'])); 
                $order['deliveryMoney'] = stripslashes(html_entity_decode($order['deliveryMoney'])); 
                $order['userId'] = stripslashes(html_entity_decode($order['userId'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where deliveryAddress equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    deliveryAddress.
* \return   $row  (array) all pairs of -id-shop-shopId-order-shipDate-Status-price-pickAddress-deliveryAddress-quarrelDescription-quarrelPicture-reviewDescription-reviewLevel-deliveryId-deliveryMoney-userId in the database.
*/    
    public function readDeliveryAddress($deliveryAddress) {
        $query='select * from `order` where deliveryAddress=:deliveryAddress';
        $result= $this->base->prepare($query);
        
        $deliveryAddress=htmlentities(addslashes($deliveryAddress));
        $result->BindValue(':deliveryAddress',$deliveryAddress);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$order) {
                $order['id'] = stripslashes(html_entity_decode($order['id'])); 
                $order['shop'] = stripslashes(html_entity_decode($order['shop'])); 
                $order['shopId'] = stripslashes(html_entity_decode($order['shopId'])); 
                $order['order'] = stripslashes(html_entity_decode($order['order'])); 
                $order['shipDate'] = stripslashes(html_entity_decode($order['shipDate'])); 
                $order['Status'] = stripslashes(html_entity_decode($order['Status'])); 
                $order['price'] = stripslashes(html_entity_decode($order['price'])); 
                $order['pickAddress'] = stripslashes(html_entity_decode($order['pickAddress'])); 
                $order['deliveryAddress'] = stripslashes(html_entity_decode($order['deliveryAddress'])); 
                $order['quarrelDescription'] = stripslashes(html_entity_decode($order['quarrelDescription'])); 
                $order['quarrelPicture'] = stripslashes(html_entity_decode($order['quarrelPicture'])); 
                $order['reviewDescription'] = stripslashes(html_entity_decode($order['reviewDescription'])); 
                $order['reviewLevel'] = stripslashes(html_entity_decode($order['reviewLevel'])); 
                $order['deliveryId'] = stripslashes(html_entity_decode($order['deliveryId'])); 
                $order['deliveryMoney'] = stripslashes(html_entity_decode($order['deliveryMoney'])); 
                $order['userId'] = stripslashes(html_entity_decode($order['userId'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where quarrelDescription equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    quarrelDescription.
* \return   $row  (array) all pairs of -id-shop-shopId-order-shipDate-Status-price-pickAddress-deliveryAddress-quarrelDescription-quarrelPicture-reviewDescription-reviewLevel-deliveryId-deliveryMoney-userId in the database.
*/    
    public function readQuarrelDescription($quarrelDescription) {
        $query='select * from `order` where quarrelDescription=:quarrelDescription';
        $result= $this->base->prepare($query);
        
        $quarrelDescription=htmlentities(addslashes($quarrelDescription));
        $result->BindValue(':quarrelDescription',$quarrelDescription);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$order) {
                $order['id'] = stripslashes(html_entity_decode($order['id'])); 
                $order['shop'] = stripslashes(html_entity_decode($order['shop'])); 
                $order['shopId'] = stripslashes(html_entity_decode($order['shopId'])); 
                $order['order'] = stripslashes(html_entity_decode($order['order'])); 
                $order['shipDate'] = stripslashes(html_entity_decode($order['shipDate'])); 
                $order['Status'] = stripslashes(html_entity_decode($order['Status'])); 
                $order['price'] = stripslashes(html_entity_decode($order['price'])); 
                $order['pickAddress'] = stripslashes(html_entity_decode($order['pickAddress'])); 
                $order['deliveryAddress'] = stripslashes(html_entity_decode($order['deliveryAddress'])); 
                $order['quarrelDescription'] = stripslashes(html_entity_decode($order['quarrelDescription'])); 
                $order['quarrelPicture'] = stripslashes(html_entity_decode($order['quarrelPicture'])); 
                $order['reviewDescription'] = stripslashes(html_entity_decode($order['reviewDescription'])); 
                $order['reviewLevel'] = stripslashes(html_entity_decode($order['reviewLevel'])); 
                $order['deliveryId'] = stripslashes(html_entity_decode($order['deliveryId'])); 
                $order['deliveryMoney'] = stripslashes(html_entity_decode($order['deliveryMoney'])); 
                $order['userId'] = stripslashes(html_entity_decode($order['userId'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where quarrelPicture equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    quarrelPicture.
* \return   $row  (array) all pairs of -id-shop-shopId-order-shipDate-Status-price-pickAddress-deliveryAddress-quarrelDescription-quarrelPicture-reviewDescription-reviewLevel-deliveryId-deliveryMoney-userId in the database.
*/    
    public function readQuarrelPicture($quarrelPicture) {
        $query='select * from `order` where quarrelPicture=:quarrelPicture';
        $result= $this->base->prepare($query);
        
        $quarrelPicture=htmlentities(addslashes($quarrelPicture));
        $result->BindValue(':quarrelPicture',$quarrelPicture);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$order) {
                $order['id'] = stripslashes(html_entity_decode($order['id'])); 
                $order['shop'] = stripslashes(html_entity_decode($order['shop'])); 
                $order['shopId'] = stripslashes(html_entity_decode($order['shopId'])); 
                $order['order'] = stripslashes(html_entity_decode($order['order'])); 
                $order['shipDate'] = stripslashes(html_entity_decode($order['shipDate'])); 
                $order['Status'] = stripslashes(html_entity_decode($order['Status'])); 
                $order['price'] = stripslashes(html_entity_decode($order['price'])); 
                $order['pickAddress'] = stripslashes(html_entity_decode($order['pickAddress'])); 
                $order['deliveryAddress'] = stripslashes(html_entity_decode($order['deliveryAddress'])); 
                $order['quarrelDescription'] = stripslashes(html_entity_decode($order['quarrelDescription'])); 
                $order['quarrelPicture'] = stripslashes(html_entity_decode($order['quarrelPicture'])); 
                $order['reviewDescription'] = stripslashes(html_entity_decode($order['reviewDescription'])); 
                $order['reviewLevel'] = stripslashes(html_entity_decode($order['reviewLevel'])); 
                $order['deliveryId'] = stripslashes(html_entity_decode($order['deliveryId'])); 
                $order['deliveryMoney'] = stripslashes(html_entity_decode($order['deliveryMoney'])); 
                $order['userId'] = stripslashes(html_entity_decode($order['userId'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where reviewDescription equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    reviewDescription.
* \return   $row  (array) all pairs of -id-shop-shopId-order-shipDate-Status-price-pickAddress-deliveryAddress-quarrelDescription-quarrelPicture-reviewDescription-reviewLevel-deliveryId-deliveryMoney-userId in the database.
*/    
    public function readReviewDescription($reviewDescription) {
        $query='select * from `order` where reviewDescription=:reviewDescription';
        $result= $this->base->prepare($query);
        
        $reviewDescription=htmlentities(addslashes($reviewDescription));
        $result->BindValue(':reviewDescription',$reviewDescription);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$order) {
                $order['id'] = stripslashes(html_entity_decode($order['id'])); 
                $order['shop'] = stripslashes(html_entity_decode($order['shop'])); 
                $order['shopId'] = stripslashes(html_entity_decode($order['shopId'])); 
                $order['order'] = stripslashes(html_entity_decode($order['order'])); 
                $order['shipDate'] = stripslashes(html_entity_decode($order['shipDate'])); 
                $order['Status'] = stripslashes(html_entity_decode($order['Status'])); 
                $order['price'] = stripslashes(html_entity_decode($order['price'])); 
                $order['pickAddress'] = stripslashes(html_entity_decode($order['pickAddress'])); 
                $order['deliveryAddress'] = stripslashes(html_entity_decode($order['deliveryAddress'])); 
                $order['quarrelDescription'] = stripslashes(html_entity_decode($order['quarrelDescription'])); 
                $order['quarrelPicture'] = stripslashes(html_entity_decode($order['quarrelPicture'])); 
                $order['reviewDescription'] = stripslashes(html_entity_decode($order['reviewDescription'])); 
                $order['reviewLevel'] = stripslashes(html_entity_decode($order['reviewLevel'])); 
                $order['deliveryId'] = stripslashes(html_entity_decode($order['deliveryId'])); 
                $order['deliveryMoney'] = stripslashes(html_entity_decode($order['deliveryMoney'])); 
                $order['userId'] = stripslashes(html_entity_decode($order['userId'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where reviewLevel equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    reviewLevel.
* \return   $row  (array) all pairs of -id-shop-shopId-order-shipDate-Status-price-pickAddress-deliveryAddress-quarrelDescription-quarrelPicture-reviewDescription-reviewLevel-deliveryId-deliveryMoney-userId in the database.
*/    
    public function readReviewLevel($reviewLevel) {
        $query='select * from `order` where reviewLevel=:reviewLevel';
        $result= $this->base->prepare($query);
        
        $reviewLevel=htmlentities(addslashes($reviewLevel));
        $result->BindValue(':reviewLevel',$reviewLevel);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$order) {
                $order['id'] = stripslashes(html_entity_decode($order['id'])); 
                $order['shop'] = stripslashes(html_entity_decode($order['shop'])); 
                $order['shopId'] = stripslashes(html_entity_decode($order['shopId'])); 
                $order['order'] = stripslashes(html_entity_decode($order['order'])); 
                $order['shipDate'] = stripslashes(html_entity_decode($order['shipDate'])); 
                $order['Status'] = stripslashes(html_entity_decode($order['Status'])); 
                $order['price'] = stripslashes(html_entity_decode($order['price'])); 
                $order['pickAddress'] = stripslashes(html_entity_decode($order['pickAddress'])); 
                $order['deliveryAddress'] = stripslashes(html_entity_decode($order['deliveryAddress'])); 
                $order['quarrelDescription'] = stripslashes(html_entity_decode($order['quarrelDescription'])); 
                $order['quarrelPicture'] = stripslashes(html_entity_decode($order['quarrelPicture'])); 
                $order['reviewDescription'] = stripslashes(html_entity_decode($order['reviewDescription'])); 
                $order['reviewLevel'] = stripslashes(html_entity_decode($order['reviewLevel'])); 
                $order['deliveryId'] = stripslashes(html_entity_decode($order['deliveryId'])); 
                $order['deliveryMoney'] = stripslashes(html_entity_decode($order['deliveryMoney'])); 
                $order['userId'] = stripslashes(html_entity_decode($order['userId'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where deliveryId equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    deliveryId.
* \return   $row  (array) all pairs of -id-shop-shopId-order-shipDate-Status-price-pickAddress-deliveryAddress-quarrelDescription-quarrelPicture-reviewDescription-reviewLevel-deliveryId-deliveryMoney-userId in the database.
*/    
    public function readDeliveryId($deliveryId) {
        $query='select * from `order` where deliveryId=:deliveryId';
        $result= $this->base->prepare($query);
        
        $deliveryId=htmlentities(addslashes($deliveryId));
        $result->BindValue(':deliveryId',$deliveryId);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$order) {
                $order['id'] = stripslashes(html_entity_decode($order['id'])); 
                $order['shop'] = stripslashes(html_entity_decode($order['shop'])); 
                $order['shopId'] = stripslashes(html_entity_decode($order['shopId'])); 
                $order['order'] = stripslashes(html_entity_decode($order['order'])); 
                $order['shipDate'] = stripslashes(html_entity_decode($order['shipDate'])); 
                $order['Status'] = stripslashes(html_entity_decode($order['Status'])); 
                $order['price'] = stripslashes(html_entity_decode($order['price'])); 
                $order['pickAddress'] = stripslashes(html_entity_decode($order['pickAddress'])); 
                $order['deliveryAddress'] = stripslashes(html_entity_decode($order['deliveryAddress'])); 
                $order['quarrelDescription'] = stripslashes(html_entity_decode($order['quarrelDescription'])); 
                $order['quarrelPicture'] = stripslashes(html_entity_decode($order['quarrelPicture'])); 
                $order['reviewDescription'] = stripslashes(html_entity_decode($order['reviewDescription'])); 
                $order['reviewLevel'] = stripslashes(html_entity_decode($order['reviewLevel'])); 
                $order['deliveryId'] = stripslashes(html_entity_decode($order['deliveryId'])); 
                $order['deliveryMoney'] = stripslashes(html_entity_decode($order['deliveryMoney'])); 
                $order['userId'] = stripslashes(html_entity_decode($order['userId'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where deliveryMoney equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    deliveryMoney.
* \return   $row  (array) all pairs of -id-shop-shopId-order-shipDate-Status-price-pickAddress-deliveryAddress-quarrelDescription-quarrelPicture-reviewDescription-reviewLevel-deliveryId-deliveryMoney-userId in the database.
*/    
    public function readDeliveryMoney($deliveryMoney) {
        $query='select * from `order` where deliveryMoney=:deliveryMoney';
        $result= $this->base->prepare($query);
        
        $deliveryMoney=htmlentities(addslashes($deliveryMoney));
        $result->BindValue(':deliveryMoney',$deliveryMoney);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$order) {
                $order['id'] = stripslashes(html_entity_decode($order['id'])); 
                $order['shop'] = stripslashes(html_entity_decode($order['shop'])); 
                $order['shopId'] = stripslashes(html_entity_decode($order['shopId'])); 
                $order['order'] = stripslashes(html_entity_decode($order['order'])); 
                $order['shipDate'] = stripslashes(html_entity_decode($order['shipDate'])); 
                $order['Status'] = stripslashes(html_entity_decode($order['Status'])); 
                $order['price'] = stripslashes(html_entity_decode($order['price'])); 
                $order['pickAddress'] = stripslashes(html_entity_decode($order['pickAddress'])); 
                $order['deliveryAddress'] = stripslashes(html_entity_decode($order['deliveryAddress'])); 
                $order['quarrelDescription'] = stripslashes(html_entity_decode($order['quarrelDescription'])); 
                $order['quarrelPicture'] = stripslashes(html_entity_decode($order['quarrelPicture'])); 
                $order['reviewDescription'] = stripslashes(html_entity_decode($order['reviewDescription'])); 
                $order['reviewLevel'] = stripslashes(html_entity_decode($order['reviewLevel'])); 
                $order['deliveryId'] = stripslashes(html_entity_decode($order['deliveryId'])); 
                $order['deliveryMoney'] = stripslashes(html_entity_decode($order['deliveryMoney'])); 
                $order['userId'] = stripslashes(html_entity_decode($order['userId'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where userId equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    userId.
* \return   $row  (array) all pairs of -id-shop-shopId-order-shipDate-Status-price-pickAddress-deliveryAddress-quarrelDescription-quarrelPicture-reviewDescription-reviewLevel-deliveryId-deliveryMoney-userId in the database.
*/    
    public function readUserId($userId) {
        $query='select * from `order` where userId=:userId';
        $result= $this->base->prepare($query);
        
        $userId=htmlentities(addslashes($userId));
        $result->BindValue(':userId',$userId);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$order) {
                $order['id'] = stripslashes(html_entity_decode($order['id'])); 
                $order['shop'] = stripslashes(html_entity_decode($order['shop'])); 
                $order['shopId'] = stripslashes(html_entity_decode($order['shopId'])); 
                $order['order'] = stripslashes(html_entity_decode($order['order'])); 
                $order['shipDate'] = stripslashes(html_entity_decode($order['shipDate'])); 
                $order['Status'] = stripslashes(html_entity_decode($order['Status'])); 
                $order['price'] = stripslashes(html_entity_decode($order['price'])); 
                $order['pickAddress'] = stripslashes(html_entity_decode($order['pickAddress'])); 
                $order['deliveryAddress'] = stripslashes(html_entity_decode($order['deliveryAddress'])); 
                $order['quarrelDescription'] = stripslashes(html_entity_decode($order['quarrelDescription'])); 
                $order['quarrelPicture'] = stripslashes(html_entity_decode($order['quarrelPicture'])); 
                $order['reviewDescription'] = stripslashes(html_entity_decode($order['reviewDescription'])); 
                $order['reviewLevel'] = stripslashes(html_entity_decode($order['reviewLevel'])); 
                $order['deliveryId'] = stripslashes(html_entity_decode($order['deliveryId'])); 
                $order['deliveryMoney'] = stripslashes(html_entity_decode($order['deliveryMoney'])); 
                $order['userId'] = stripslashes(html_entity_decode($order['userId'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Deletes all rows in the database
* \details  By sql query using PDO, we delete all.
* \param all    Identifier of what we want to erase from the database.
* \return   $success  (bool) true if it has deleted the row, false in any other case.
*/
    public function deleteAll() {
        $query='delete from `order` where 1';
        $result= $this->base->prepare($query);
        $success = $result->execute();
        $result ->closeCursor();
        return $success;
    }



/*!
* \brief    Deletes rows in the database by id
* \details  By sql query using PDO, we delete all the results where the id matches.
* \param id    Identifier of what we want to erase from the database.
* \return   $success  (bool) true if it has deleted the row, false in any other case.
*/
    public function deleteById($id) {
        $query='delete from `order` where id=:id';
        $result= $this->base->prepare($query);
        $id=htmlentities(addslashes($id));
        $result->BindValue(':id',$id);

        $success = $result->execute();
        $result ->closeCursor();
        return $success;
    }



/*!
* \brief    Deletes rows in the database by shop
* \details  By sql query using PDO, we delete all the results where the shop matches.
* \param shop    Identifier of what we want to erase from the database.
* \return   $success  (bool) true if it has deleted the row, false in any other case.
*/
    public function deleteByShop($shop) {
        $query='delete from `order` where shop=:shop';
        $result= $this->base->prepare($query);
        $shop=htmlentities(addslashes($shop));
        $result->BindValue(':shop',$shop);

        $success = $result->execute();
        $result ->closeCursor();
        return $success;
    }



/*!
* \brief    Deletes rows in the database by shopId
* \details  By sql query using PDO, we delete all the results where the shopId matches.
* \param shopId    Identifier of what we want to erase from the database.
* \return   $success  (bool) true if it has deleted the row, false in any other case.
*/
    public function deleteByShopId($shopId) {
        $query='delete from `order` where shopId=:shopId';
        $result= $this->base->prepare($query);
        $shopId=htmlentities(addslashes($shopId));
        $result->BindValue(':shopId',$shopId);

        $success = $result->execute();
        $result ->closeCursor();
        return $success;
    }



/*!
* \brief    Deletes rows in the database by Status
* \details  By sql query using PDO, we delete all the results where the Status matches.
* \param Status    Identifier of what we want to erase from the database.
* \return   $success  (bool) true if it has deleted the row, false in any other case.
*/
    public function deleteByStatus($Status) {
        $query='delete from `order` where Status=:Status';
        $result= $this->base->prepare($query);
        $Status=htmlentities(addslashes($Status));
        $result->BindValue(':Status',$Status);

        $success = $result->execute();
        $result ->closeCursor();
        return $success;
    }



/*!
* \brief    Deletes rows in the database by userId
* \details  By sql query using PDO, we delete all the results where the userId matches.
* \param userId    Identifier of what we want to erase from the database.
* \return   $success  (bool) true if it has deleted the row, false in any other case.
*/
    public function deleteByUserId($userId) {
        $query='delete from `order` where userId=:userId';
        $result= $this->base->prepare($query);
        $userId=htmlentities(addslashes($userId));
        $result->BindValue(':userId',$userId);

        $success = $result->execute();
        $result ->closeCursor();
        return $success;
    }




    
}

?>
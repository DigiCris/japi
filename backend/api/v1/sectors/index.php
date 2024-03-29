
    <?php

    include_once '../configuracion.php';
    include_once '../lib.php';

    debug('I am sectors <br>');
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
*    'getAll' -> Read all sectors
*    'getById' -> Read sectors by id.
*    'getBySectorsName' -> Read sectors by sectorsName.
*    'getByMoreUsed' -> Read sectors by moreUsed.
* \param $get['id'] searching variable of the sectors table to read (in method getById).
* \param $get['sectorsName'] searching variable of the sectors table to read (in method getBySectorsName).
* \param $get['moreUsed'] searching variable of the sectors table to read (in method getByMoreUsed).
* \return $result['response'] (array) An array with the requested information of sectors table.
    * ['id'] (INT)  1 unique id for each sector (Special carachteristic => autoincremental ).
    * ['sectorsName'] (VARCHAR) Sectors being offered (gastronomics, cloth, etc) (Special carachteristic => ).
    * ['moreUsed'] (INT) How many times where used (for statistics) (Special carachteristic => ).
* \return $result['success'] (bool) Returns true if the request was succesful, false if not.
* \return $result['msg'] (string) Returns a message explaining the status of the execution.
*   'sectors fetched' -> When was able to read the fetched sectors.
*   'No id selected to read.' -> When id is missing (in method getById).
*   'No sectorsName selected to read.' -> When sectorsName is missing (in method getBySectorsName).
*   'No moreUsed selected to read.' -> When moreUsed is missing (in method getByMoreUsed).
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
            
        case 'getBySectorsName':
            include_once 'functions/read/getBySectorsName.php';
            if(!isset($get['sectorsName'])) {
                $result['success'] = false;
                $result['msg'] = 'No sectorsName selected to read.';
                break;
            }
            $result = getBySectorsName($get['sectorsName']);
            debug('getBySectorsName');
            break;
            
        case 'getByMoreUsed':
            include_once 'functions/read/getByMoreUsed.php';
            if(!isset($get['moreUsed'])) {
                $result['success'] = false;
                $result['msg'] = 'No moreUsed selected to read.';
                break;
            }
            $result = getByMoreUsed($get['moreUsed']);
            debug('getByMoreUsed');
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
*    'setAll' -> Insert a new row in sectors
*    'deleteAll' -> delete all table in sectors
*    'deleteById' -> delete all that matches id in sectors
*    'deleteBySectorsName' -> delete all that matches sectorsName in sectors
*    'deleteByMoreUsed' -> delete all that matches moreUsed in sectors
*    'updateAllById' -> Updates all that matches id in sectors
*    'updateAllBySectorsName' -> Updates all that matches sectorsName in sectors
*    'updateAllByMoreUsed' -> Updates all that matches moreUsed in sectors
*    'updateSectorsNameById' -> Updates sectorsName that matches id in sectors
*    'updateSectorsNameByMoreUsed' -> Updates sectorsName that matches moreUsed in sectors
*    'updateMoreUsedById' -> Updates moreUsed that matches id in sectors
*    'updateMoreUsedBySectorsName' -> Updates moreUsed that matches sectorsName in sectors
* \param $post['id'] (INT)  1 unique id for each sector
* \param $post['sectorsName'] (VARCHAR) Sectors being offered (gastronomics, cloth, etc)
* \param $post['moreUsed'] (INT) How many times where used (for statistics)
* \return $result['response'] (array) An array with the requested sectors information.
*    ['id'] (INT)  1 unique id for each sector
*    ['sectorsName'] (VARCHAR) Sectors being offered (gastronomics, cloth, etc)
*    ['moreUsed'] (INT) How many times where used (for statistics)
* \return $result['success'] (bool) Returns true if the request was succesful, false if not.
* \return $result['msg'] (string) Returns a message explaining the status of the execution.
*   'sectors uploaded.' -> When the execution was successful, the sectors information was uploaded in the database.
*   'This sectors could not be uploaded. Try again later.' -> When the call fails, it could be because it couldn't connect to the database. 
*   'This sectors row is already in the database.' -> When trying to insert something that already exists inside the database.
*   'Updated' -> When the updateing execution was successful, the sectors information was updated in the database.
*   'We couldn't update. Try again later' -> When the update fails, it could be because it couldn't connect to the database. 
*   'We couldn't find what you are trying to update.' -> When the information of sectors you want to update does not exist or it is not found in the database.
*   'sectors row deleted' -> When was able to delete the fetched sectors row/rows.
*   'It was not possible to erase the sectors. Try again later' -> When it fails to eliminate the sectors row/rows.
*   'Thissectors row did not exist.' -> When the sectors row was not found or did not exist.
*   'No id/sectorsName/moreUsed/ to set.' -> When one of the required parameters is missing.
*   'No selection to delete.' -> When $post['selection'] is missing (in method deleteBySelection).
*   'No selection to update.' -> When $post['selection'] is missing (in method update...BySelection).
*   'No valid case selected' -> When a method that does not exist is selected (in the default of the switch). 
*/  
function postFunctions($post) {
    switch ($post['method']) {
        
        case 'setAll':
            debug('I am inside the post method setAll <br>');
            include_once 'functions/write/setAll.php';
            $result = setAll($post['id'], $post['sectorsName'], $post['moreUsed']);
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
        
        case 'deleteBySectorsName':
            debug('I am inside the post method deleteBySectorsName <br>');
            include_once 'functions/delete/deleteBySectorsName.php';
            if(!isset($post['sectorsName'])) {
                $result['success'] = false;
                $result['msg'] = 'No sectorsName to delete.';
                break;
            }
            $result = deleteBySectorsName($post['sectorsName']);
            break;
        
        case 'deleteByMoreUsed':
            debug('I am inside the post method deleteByMoreUsed <br>');
            include_once 'functions/delete/deleteByMoreUsed.php';
            if(!isset($post['moreUsed'])) {
                $result['success'] = false;
                $result['msg'] = 'No moreUsed to delete.';
                break;
            }
            $result = deleteByMoreUsed($post['moreUsed']);
            break;
        
        case 'updateAllById':
            debug('I am inside the post method updateAllById <br>');
            include_once 'functions/update/updateAllById.php';
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updateAllById($post['id'], $post['sectorsName'], $post['moreUsed']);
            break;
        
        case 'updateAllBySectorsName':
            debug('I am inside the post method updateAllBySectorsName <br>');
            include_once 'functions/update/updateAllBySectorsName.php';
            if(!isset($post['sectorsName'])) {
                $result['success'] = false;
                $result['msg'] = 'No sectorsName to update.';
                break;
            }
            $result = updateAllBySectorsName($post['id'], $post['sectorsName'], $post['moreUsed']);
            break;
        
        case 'updateAllByMoreUsed':
            debug('I am inside the post method updateAllByMoreUsed <br>');
            include_once 'functions/update/updateAllByMoreUsed.php';
            if(!isset($post['moreUsed'])) {
                $result['success'] = false;
                $result['msg'] = 'No moreUsed to update.';
                break;
            }
            $result = updateAllByMoreUsed($post['id'], $post['sectorsName'], $post['moreUsed']);
            break;
        
        case 'updateSectorsNameById':
            debug('I am inside the post method updateSectorsNameById <br>');
            include_once 'functions/update/updateSectorsNameById.php';
            if(!isset($post['sectorsName'])) {
                $result['success'] = false;
                $result['msg'] = 'No sectorsName to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updateSectorsNameById($post['id'],$post['sectorsName']);
            break;
        
        case 'updateSectorsNameByMoreUsed':
            debug('I am inside the post method updateSectorsNameByMoreUsed <br>');
            include_once 'functions/update/updateSectorsNameByMoreUsed.php';
            if(!isset($post['sectorsName'])) {
                $result['success'] = false;
                $result['msg'] = 'No sectorsName to update.';
                break;
            }
            if(!isset($post['moreUsed'])) {
                $result['success'] = false;
                $result['msg'] = 'No moreUsed to update.';
                break;
            }
            $result = updateSectorsNameByMoreUsed($post['moreUsed'],$post['sectorsName']);
            break;
        
        case 'updateMoreUsedById':
            debug('I am inside the post method updateMoreUsedById <br>');
            include_once 'functions/update/updateMoreUsedById.php';
            if(!isset($post['moreUsed'])) {
                $result['success'] = false;
                $result['msg'] = 'No moreUsed to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updateMoreUsedById($post['id'],$post['moreUsed']);
            break;
        
        case 'updateMoreUsedBySectorsName':
            debug('I am inside the post method updateMoreUsedBySectorsName <br>');
            include_once 'functions/update/updateMoreUsedBySectorsName.php';
            if(!isset($post['moreUsed'])) {
                $result['success'] = false;
                $result['msg'] = 'No moreUsed to update.';
                break;
            }
            if(!isset($post['sectorsName'])) {
                $result['success'] = false;
                $result['msg'] = 'No sectorsName to update.';
                break;
            }
            $result = updateMoreUsedBySectorsName($post['sectorsName'],$post['moreUsed']);
            break;
        
        default:
            $result['success']=false;
            $result['msg']='No valid case selected';
            break;
    }
    return $result;
}

?>
    
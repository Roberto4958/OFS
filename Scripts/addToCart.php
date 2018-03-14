<?php

require_once 'loginInfo.php';
error_reporting(0); 
class response{}

//checks if POST values are set 
if(!$_POST || !isset($_POST['itemid']) || !isset($_POST['userid']) || !isset($_POST['countyid'])) $myObj->success = false;

else {
    $userID = $_POST['userid'];
    $itemID = $_POST['itemid'];
    $countyID = $_POST['countyid']; 
    
    $response = new response;

    $conn = new mysqli($hn, $un, $pw, $db);
    if (!$conn->connect_error){ //connected to db succesfully 
        $sql = "select itemId from cart where userID = $userID and itemID = $itemID";
        $result = $conn->query($sql);
        $response->success = true; //adds success atribute to the response object
        
        //checks if user already added item to cart 
        if ($result->num_rows < 1 ){ //Not in cart
            if(addToCart($conn, $userID, $itemID, $countyID)){
                $response->status = 'is added to cart !';
            } else  $response->success = false;

        }
        //already in the cart
        else {
            if(increaseAmountInCart($conn, $userID, $itemID, $countyID)){
                $response->status = 'is incremented to cart !';
            } else  $response->success = false;
        }
        $result->close();
        $conn->close();
        
    }else $response->success = false;
}


    echo json_encode($response);

    
    //---------------function -------------------------
    
    //@desc: adds a new row to the the cart table in the db
    //@Param: $conn - connection to the database 
    //@param: $userID - int: users id 
    //@param: $itemID - int: id of food item
    //@param: $itemID - int: id of county 
    function addToCart($conn, $userID, $itemID, $countyID){
        $sql = "insert into cart(itemID, amount, userID, countyID) values($itemID, 1, $userID, $countyID)";
        if($conn->query($sql)){
            return true;
        }else return false;
    }

    //@desc: increments the amount of food item into the database
    //@Param: $conn - connection to the database 
    //@param: $userID - int: users id 
    //@param: $itemID - int: id of food item
    //@param: $itemID - int: id of county 
    function increaseAmountInCart($conn, $userID, $itemID, $countyID){
        $sql = "update cart set amount = amount+1  where userID =$userID and itemID = $itemID";
        if($conn->query($sql)){
            return true;
        }else return false;
    }

?>
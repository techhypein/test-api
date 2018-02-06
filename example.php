<?php

include 'class.reseller.php'; // Include Class File
$Reseller = new reseller(); // Initiate the Function


/**
 * ORDER ADD
 * Syntax: $RESELLER->ORDER(LINK,TYPE,AMOUNT);
 */

$Response = $Reseller->order("http://instagram.com/username",'ig_followers','100');
if($Response->status == 'ok') // Status OK ! Necessary Fields Passed
{
    if($Response->order != '')
    {
        $OrderID = $Response->order; // This is the Order ID from Reseller! Use it or Save it to Database to check the status Later!
        echo "Your Order was Inserted! The ID is : $OrderID";
        echo "<br>";
    }
}
else // Status FAIL ! Something is Missing or not right!
{
    if($Response == null)
    {
        echo "Cannot Connect to Reseller! Probably Web-Site or Down or API URL not Reachable";
        echo "<br>";
        // All Went good ,but no response from our server, please try again later
    }
    
    else
    {
       //Something Went wrong! Check the Full Error List on :   http://www.SmmHelps.com/private.php?page=panel&view=api
       $ErrorMessage = $Response->message;
       echo "Failed to Insert Order! Error : $ErrorMessage";
       echo "<br>";
    } 
}


/**
 * ORDER STATUS
 * Syntax: $RESELLER->STATUS(ID);
 */
 
$ResponseStatus = $Reseller->status('12313131');
if($ResponseStatus->status == "ok")
{
    $Status = $ResponseStatus->order_status;
    echo "Order Status is : $Status";
    echo "<br>";
    // To see the full output uncomment the lines
    // var_dump($ResponseStatus);
    // echo "<br>";
    
}
else
{
    // Failed!
    $ErrorMessage = $ResponseStatus->message;
    echo "Failed to Search Order ! Error : $ErrorMessage";
    echo "<br>";
}
 
?>
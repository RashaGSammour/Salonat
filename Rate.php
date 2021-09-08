<?php
require_once "DBController.php";

class Rate extends DBController
{

    function getAllPost()
    {
        $query = "SELECT * FROM menus_items";
        
        $postResult = $this->getDBResult($query);
        return $postResult;
    }

    function getMemberCartItem($user_id)
    {
        $query = "SELECT menus_items.*, users.id as user_id,users.name FROM menus_items, users WHERE 
            menus_items.user_id = users.id AND menus_items.user_id = ?";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $user_id
            )
        );
        
        $cartResult = $this->getDBResult($query, $params);
        return $cartResult;
    }

    function updateRatingCount($rating, $id)
    {
        $query = "UPDATE menus_items SET  rating = ? WHERE id= ?";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $rating
            ),
            array(
                "param_type" => "i",
                "param_value" => $id
            )
        );
        
        $this->updateDB($query, $params);
    }
}

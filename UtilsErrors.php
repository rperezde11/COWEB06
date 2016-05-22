<?php

class UtilsErrors {
    
    private static $errors = array(
        
        400   => array(
                        "title" => "Bad Request",
                        "message" => "This response means that server could not understand the request due to invalid syntax"
                    ),
        401   => array(
                        "title" => "Unauthorized",
                        "message" => "Authentication is needed to get requested response. This is similar to 403, but in this case, authentication is possible"
                    ),
        403   => array(
                        "title" => "Forbidden",
                        "message" => "Client does not have access rights to the content so server is rejecting to give proper response"
                    ),
        404   => array(
                        "title" => "Not Found",
                        "message" => "Server can not find requested resource. This response code probably is most famous one due to its frequency to occur in web"
                    ),
        500   => array(
                        "title" => "Internal Server Error",
                        "message" => "The server has encountered a situation it doesn't know how to handle"
                    ),
        "NAE" => array(
                        "title"   => "XXX",
                        "message" => "In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu"
                    )
    );
    
    // Returns the error
    public static function getError($num)
    {    
        $existsOffset = isset(self::$errors[$num]);
        
        $res = ($existsOffset) ? self::$errors[$num] : null;
        
        if($res === null or !$existsOffset)
            return self::$errors["NAE"];
        
        return $res;
    }
    
}
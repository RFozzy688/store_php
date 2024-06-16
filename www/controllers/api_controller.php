<?php
include_once "controller_base.php";

class ApiController extends BaseController
{
    public function do_get() 
    {
        global $action, $id;

        switch ($action) {
            case 'shop' : switch($id) {
                case 'product' : return $this->shop_product();
                case 'order' : return $this->shop_order();
                case 'customer' : return $this->shop_customer();
            }
        }

        $this->send_json(null, 404, 'path not released');
    }

    // /api/shop/product -- create shop tables
    private function shop_product()
    {
        $db = $this->get_db_or_exit();

        $query = "CREATE TABLE IF NOT EXISTS `shop_products` (
            `id`          INT	PRIMARY KEY AUTO_INCREMENT,
            `name`	      TEXT NOT NULL,
            `description` TEXT NOT NULL,
            `price`       DECIMAL(10,2) NOT NULL,
            `img_url`	  TEXT
            ) ENGINE = InnoDB, DEFAULT CHARSET = utf8mb4";

        try 
        {
            $db->query($query);
        }
        catch(PDOException $ex) 
        {
            $this->log_error(
                __CLASS__ . 
                ' ' . __LINE__ . 
                ' ' . $ex->getMessage() .
                ' ' . $query);
            
            $this->send_json(null, 503, 'Internal error. See server logs.');
        }

        $this->send_json('Table `shop_products` create');
    }

    private function shop_customer()
    {
        $db = $this->get_db_or_exit();

        $query = "CREATE TABLE IF NOT EXISTS `shop_customers` (
            `id`	    INT	PRIMARY KEY AUTO_INCREMENT,
            `name`	    TEXT NOT NULL,
            `last_name`	TEXT NOT NULL,
            `address`   TEXT NOT NULL,
            `phone`     DECIMAL(10,2) NOT NULL
            ) ENGINE = InnoDB, DEFAULT CHARSET = utf8mb4";

        try 
        {
            $db->query($query);
        }
        catch(PDOException $ex) 
        {
            $this->log_error(
                __CLASS__ . 
                ' ' . __LINE__ . 
                ' ' . $ex->getMessage() .
                ' ' . $query);
            
            $this->send_json(null, 503, 'Internal error. See server logs.');
        }

        $this->send_json('Table `shop_customers` create');
    }

    private function shop_order()
    {
        $db = $this->get_db_or_exit();

        $query = "CREATE TABLE IF NOT EXISTS `shop_orders` (
            `id`	      INT	PRIMARY KEY AUTO_INCREMENT,
            `product_id`  INT,
            `customer_id` INT,
            `date`        DATE
            ) ENGINE = InnoDB, DEFAULT CHARSET = utf8mb4";

        try 
        {
            $db->query($query);
        }
        catch(PDOException $ex) 
        {
            $this->log_error(
                __CLASS__ . 
                ' ' . __LINE__ . 
                ' ' . $ex->getMessage() .
                ' ' . $query);
            
            $this->send_json(null, 503, 'Internal error. See server logs.');
        }

        $this->send_json('Table `shop_orders` create');
    }
}
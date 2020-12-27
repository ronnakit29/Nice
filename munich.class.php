<?php

namespace RCode\Resource;

class Munich
{
    private $conn;

    public function __construct($conn)
    {
        session_start();
        $this->conn = $conn;
    }
    public function login($username, $password)
    {
        # ฟังชั่นการเข้าสู่ระบบ...
        $password = hash("sha256", $password);
        $login = $this->conn->prepare("SELECT m_user FROM tbl_member WHERE m_user = ? AND m_pass = ?");
        $login->execute([$username, $password]);
        if ($login->rowCount() == 1) {
            $fetch = $login->fetchObject();
            $_SESSION["login"] = $fetch->m_user;
            return true;
        } else {
            return false;
        }
    }
    public function getProfile()
    {
        #เรียกดูโปรไฟล์หลัง Login
        if (isset($_SESSION["login"])) {
            $profile = $this->conn->prepare("SELECT * FROM tbl_member WHERE m_user = ?");
            if ($profile->execute([$_SESSION["login"]])) {
                if ($profile->rowCount() == 1) {
                    return $profile->fetchObject();
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function logout()
    {
        #ฟังชั่นการออกจากระบบ
        $_SESSION["login"] = "";
        session_destroy();
        return true;
    }
    public function register($username, $password, $name, $surname, $sex, $email)
    {
        # ฟังชั่นการสมัครสมาชิก...
        $password = hash("sha256", $password);
        $check = $this->conn->prepare("SELECT m_user FROM tbl_member WHERE m_user = ?");
        $check->execute([$username]);
        if ($check->rowCount() == 0) {
            $register = $this->conn->prepare("INSERT INTO tbl_member(m_user,m_pass,m_name,m_surname,m_sex,m_email) VALUES(?,?,?,?,?,?)");
            if ($register->execute([$username, $password, $name, $surname, $sex, $email])) return true;
            else return false;
        } else {
            return false;
        }
    }
    public function product($id)
    {
        #เรียกดูสินค้า
        $product = $this->conn->prepare("SELECT * FROM tbl_product WHERE p_id = ?");
        $product->execute([$id]);
        if ($product->rowCount() > 0) {
            return $product->fetchObject();
        } else {
            return false;
        }
    }
    public function addcart($p_id, $qty)
    {
        #เพิ่มสินค้าลงตะกร้า
        $check = $this->conn->prepare("SELECT * FROM tbl_cart WHERE m_user = ? AND p_id = ?");
        $check->execute([$this->getProfile()->m_user, $p_id]);
        if ($check->rowCount() > 0) {
            $update = $this->conn->prepare("UPDATE tbl_cart SET cart_qty = cart_qty + ? WHERE m_user = ? AND p_id = ?");
            $update->execute([$qty, $this->getProfile()->m_user, $p_id]);
        } else {
            $addcart = $this->conn->prepare("INSERT INTO tbl_cart(m_user,p_id,cart_qty) VALUES(?,?,?)");
            $addcart->execute([$this->getProfile()->m_user, $p_id, $qty]);
        }
        $sumall = $this->conn->prepare("SELECT SUM(cart_qty) AS numCart FROM tbl_cart WHERE m_user = ?");
        $sumall->execute([$this->getProfile()->m_user]);
        $fetch = $sumall->fetchObject();
        return $fetch->numCart;
    }
    public function numOfCart()
    {
        $sumall = $this->conn->prepare("SELECT SUM(cart_qty) AS numCart FROM tbl_cart WHERE m_user = ?");
        $sumall->execute([$this->getProfile()->m_user]);
        $fetch = $sumall->fetchObject();
        return $fetch->numCart != "" ? $fetch->numCart : 0;
    }
    public function priceOfCart()
    {
        $mycart = $this->myCart();
        $total = 0;
        while ($row = $mycart->fetchObject()) {
            $total = $total + ($row->cart_qty * $row->price);
        }
        return $total;
    }
    public function myCart()
    {
        $mycart = $this->conn->prepare("SELECT tbl_cart.cart_id,tbl_cart.m_user,tbl_product.p_name,tbl_product.p_id,tbl_product.p_img,tbl_product.price,tbl_cart.cart_qty FROM tbl_cart INNER JOIN tbl_product WHERE tbl_cart.m_user = ? AND tbl_cart.p_id = tbl_product.p_id");
        $mycart->execute([$this->getProfile()->m_user]);
        return $mycart;
    }
    public function changeCart($cartID, $qty)
    {
        # แก้ไขตะกร้า
        $change = $this->conn->prepare("UPDATE tbl_cart SET cart_qty = ? WHERE cart_id = ? AND m_user = ?");
        return $change->execute([$qty, $cartID, $this->getProfile()->m_user]);
    }
    public function deleteCart($cartID)
    {
        # ลบสินค้าทั้งหมดในตะกร้า
        $delete = $this->conn->prepare("DELETE FROM tbl_cart WHERE cart_id = ?");
        return $delete->execute([$cartID]);
    }
    public function payment($order_sync_id, $price)
    {
        #จ่ายตัง

        $check = $this->conn->prepare("SELECT * FROM tbl_order WHERE m_user = ? AND order_payment_status = 0");
        $check->execute([$this->getProfile()->m_user]);
        if ($check->rowCount() > 0) {
            return false;
        } else {
            $mycart = $this->myCart();
            while ($fetch = $mycart->fetchObject()) {
                $move_to_order = $this->conn->prepare("INSERT INTO tbl_order_product_list(sync_order_id,p_id,odp_qty) VALUES (?,?,?)");
                $move_to_order->execute([$order_sync_id, $fetch->p_id, $fetch->cart_qty]);
            }

            $payment = $this->conn->prepare("INSERT INTO tbl_order(m_user,p_list,order_price,order_payment_status) VALUES(?,?,?,?)");
            if ($payment->execute([$this->getProfile()->m_user, $order_sync_id, $price, 0])) {
                $clear_cart = $this->conn->prepare("DELETE FROM tbl_cart WHERE m_user = ?");
                if ($clear_cart->execute([$this->getProfile()->m_user])) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }
    public function Order($key)
    {
        $order = $this->conn->prepare("SELECT * FROM tbl_order WHERE p_list = ?");
        $order->execute([$key]);
        $result["order"] = $order->fetchObject();
        $orderList = $this->conn->prepare("SELECT * FROM tbl_order_product_list INNER JOIN tbl_product WHERE tbl_order_product_list.sync_order_id = ? AND tbl_order_product_list.p_id = tbl_product.p_id");
        $orderList->execute([$key]);
        $result["order_list"] = $orderList;
        return $result;
    }
}

<?php

namespace App\Controller\Store;

use App\API\Products;

class CartController
{
    public string $cart_session;

    public function __construct()
    {
        $this->cart_session = CART_SESSION;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION[$this->cart_session])) {
            $_SESSION[$this->cart_session] = [];
        }
    }

    public function cart()
    {
        $home = new HomeController();
        $home->layout();

    }

    /**
     * Add new item to cart or increase quantity if exists
     * @throws \JsonException
     */
    public function addItem(): void
    {
        $productId = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $qty = 1;
        if (isset($_POST['qty']) && $_POST['qty'] > 0) {
            $qty = $_POST['qty'];
        }
        $image = $_POST['image'];
        if (isset($_SESSION[$this->cart_session][$productId])) {
            $_SESSION[$this->cart_session][$productId]['qty'] += $qty;
        } else {
            $_SESSION[$this->cart_session][$productId] = [
                'product_id' => $productId,
                'name' => $name,
                'price' => $price,
                'qty' => $qty,
                'image' => $image
            ];
        }
        $params = [
            "success" => true,
            "cartCount" => $this->countItems(),
//            "items" => $this->getItems(),
//            "total" => $this->getTotal(),

        ];
        if ($_POST['action'] === 'buy') {
            $params['redirect'] = BASE_PATH . 'cart';
        }
        echo json_encode($params, JSON_THROW_ON_ERROR);
    }

    /**
     * Update item quantity
     * @throws \JsonException
     */
    public function updateQty(): void
    {
        $productId = $_POST['id'];
        $qty = $_POST['qty'];
        if (isset($_SESSION[$this->cart_session][$productId])) {
            if ($qty <= 0) {
                $this->removeItem();
            } else {
                $_SESSION[$this->cart_session][$productId]['qty'] = $qty;
            }
        }
        $item = $_SESSION[$this->cart_session][$productId];
        echo json_encode([
            "success" => true,
            "cartCount" => $this->countItems(),
            "itemCost" => number_format($item['qty'] * $item['price'], 2),
            'total' => number_format($this->getTotal(), 2),
        ], JSON_THROW_ON_ERROR);
    }

    /**
     * Remove an item from cart
     * @throws \JsonException
     */
    public function removeItem(): void
    {
        $productId = $_POST['id'];
        if (isset($_SESSION[$this->cart_session][$productId])) {
            unset($_SESSION[$this->cart_session][$productId]);
        }
        echo json_encode([
            "success" => true,
            "cartCount" => $this->countItems(),
            'total' => number_format($this->getTotal(), 2),
        ], JSON_THROW_ON_ERROR);
    }

    /**
     * Clear entire cart
     */
    public function clearCart(): void
    {
        $_SESSION[$this->cart_session] = [];
    }

    /**
     * Get all items in cart
     */
    public function getItems(): array
    {
        return $_SESSION[$this->cart_session];
    }

    /**
     * Calculate total price
     */
    public function getTotal(): float
    {
        $total = 0;
        foreach ($this->getItems() as $item) {
            $total += $item['price'] * $item['qty'];
        }
        return $total;
    }

    /**
     * Count all items (sum of quantities)
     */
    public function countItems(): int
    {
        $count = 0;
        foreach ($this->getItems() as $item) {
            $count += $item['qty'];
        }
        return $count;
    }


}
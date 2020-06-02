<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    protected $entity;

    public function __construct(Order $order)
    {
        $this->entity = $order;
    }

    public function createNewOrder(string $identify, float $total, string $status, int $tenantId, string $comment = '', $clientId = '', $tableId = '')
    {
        $data = [
            'tenant_id' => $tenantId,
            'identify' => $identify,
            'total' => $total,
            'status' => $status,
            'comment' => $comment,
        ];
        if ($clientId) {
            $data['client_id'] = $clientId;
        }
        if ($tableId) {
            $data['table_id'] = $tableId;
        }
        $order = $this->entity->create($data);

        return $order;
    }

    public function getOrderByIdentify(string $identify)
    {
        return $this->entity->where('identify', $identify)->first();
    }

    public function registerProductsOrder(int $orderId, array $products)
    {
        $orderProducts = [];

        $order = $this->entity->find($orderId);
        $orderProducts = [];
        foreach ($products as $product) {
            $orderProducts[$product['id']] = [
                'qty' => $product['qty'],
                'price' => $product['price']
            ];
        }
        $order->products()->attach($orderProducts);
    }

    public function getOrdersByClientId(int $idClient)
    {
        $orders = $this->entity->where('client_id', $idClient)->paginate();

        return $orders;
    }
}

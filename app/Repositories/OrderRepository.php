<?php

namespace App\Repositories;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Payment;
use App\Models\PaymentStatus;
use App\Models\Product;
use App\Repositories\Interfaces\IOrderRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class OrderRepository extends Repository implements IOrderRepository
{
    public function model()
    {
        return Order::class;
    }

    public function insert($data)
    {
        DB::beginTransaction();

        try {
            $paymentStatus = PaymentStatus::where('name', 'Waiting for approval')->firstOrFail();

            $price = 0;
            $productIds = [];

            foreach ($data['products'] as $productData) {
                $product = Product::findOrFail($productData['id']); 
                $price += $product->price;
                $productIds[$product->id] = ['amount' => $productData['amount'] ?? 1];
            }

            $payment = Payment::create([
                'payment_status_id' => $paymentStatus->id,
                'proof' => 'https://placehold.co/600x400?text=payment+proof+sisfrete', 
            ]);

            $order = $this->model->create([
                'customer_id' => $data['customer_id'],
                'payment_id'  => $payment->id,
                'price'       => $price,
            ]);

            $order->products()->attach($productIds);

            DB::commit();

            return $order;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function edit($id, $data)
    {
        DB::beginTransaction();

        try {
            $order = $this->model->with('products')->findOrFail($id);

            $price = 0;
            $productIds = [];

            foreach ($data['products'] as $productData) {
                $product = Product::findOrFail($productData['id']);
                $price += $product->price * ($productData['amount'] ?? 1);
                $productIds[$product->id] = ['amount' => $productData['amount'] ?? 1];
            }

            $order->products()->sync($productIds);

            $order->update([
                'price' => $price,
                'customer_id' => $order->customer_id,
            ]);

            DB::commit();

            return $order;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="Order",
 *     type="object",
 *     title="Order",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="customer", type="string", example="John Doe"),
 *     @OA\Property(
 *         property="payment",
 *         type="object",
 *         @OA\Property(property="status", type="string", example="Waiting for approval"),
 *         @OA\Property(property="proof", type="string", example="https://placehold.co/600x400?text=payment+proof+sisfrete")
 *     ),
 *     @OA\Property(property="price", type="number", format="float", example=1234.56),
 *     @OA\Property(
 *         property="products",
 *         type="array",
 *         @OA\Items(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=7),
 *             @OA\Property(property="name", type="string", example="Headphones"),
 *             @OA\Property(property="price", type="number", format="float", example=299.99),
 *             @OA\Property(property="amount", type="integer", example=2)
 *         )
 *     )
 * )
 */
class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'customer' => $this->customer->name,
            'payment' => [
                'status' => $this->payment->paymentStatus->name,
                'proof' => $this->payment->proof
            ],
            'price' => number_format($this->price, 2, '.', ''),
            'products' => $this->products->map(fn($product) => [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'amount' => $product->pivot->amount,
            ]),
        ];
    }
}

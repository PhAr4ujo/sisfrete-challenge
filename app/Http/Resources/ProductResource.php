<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="Product",
 *     type="object",
 *     title="Product",
 *     description="Product resource",
 *     @OA\Property(property="id", type="integer", example=7),
 *     @OA\Property(property="name", type="string", example="Headphones"),
 *     @OA\Property(property="description", type="string", example="Noise cancelling"),
 *     @OA\Property(property="price", type="number", format="float", example=299.99),
 *     @OA\Property(
 *         property="productTypes",
 *         type="array",
 *         description="List of product types associated with this product",
 *         @OA\Items(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="name", type="string", example="Electronics")
 *         )
 *     )
 * )
 */
class ProductResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'productTypes' => $this->productTypes->map(fn($productType) => [
                'id' => $productType->id,
                'name' => $productType->name,
            ]),
        ];
    }
}

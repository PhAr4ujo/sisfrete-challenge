<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\Interfaces\IProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct(protected IProductService $iProductService) {
    }
    
    /**
     * @OA\Get(
     *     path="/api/products",
     *     tags={"Products"},
     *     summary="Get a list of products with filters and pagination",
     *     description="Returns a paginated list of products. You can filter by name, description, price (with operator), and product types.",
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Filter products by name",
     *         required=false,
     *         @OA\Schema(type="string", example="Headphones")
     *     ),
     *     @OA\Parameter(
     *         name="description",
     *         in="query",
     *         description="Filter products by description",
     *         required=false,
     *         @OA\Schema(type="string", example="Noise cancelling")
     *     ),
     *     @OA\Parameter(
     *         name="price",
     *         in="query",
     *         description="Filter products by price",
     *         required=false,
     *         @OA\Schema(type="number", format="float", example=999.99)
     *     ),
     *     @OA\Parameter(
     *         name="operator",
     *         in="query",
     *         description="Operator for price comparison (e.g., =, <, >, <=, >=)",
     *         required=false,
     *         @OA\Schema(type="string", example="<=")
     *     ),
     *     @OA\Parameter(
     *         name="product_type[]",
     *         in="query",
     *         description="Filter products by one or multiple product types",
     *         required=false,
     *         @OA\Schema(type="array", @OA\Items(type="string"), example={"Electronics","Clothing"})
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number for pagination",
     *         required=false,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Number of items per page",
     *         required=false,
     *         @OA\Schema(type="integer", example=15)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Paginated list of products",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="current_page", type="integer", example=1),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/Product")
     *             ),
     *             @OA\Property(property="first_page_url", type="string", example="http://127.0.0.1:8000/api/products?page=1"),
     *             @OA\Property(property="last_page", type="integer", example=3),
     *             @OA\Property(property="last_page_url", type="string", example="http://127.0.0.1:8000/api/products?page=3"),
     *             @OA\Property(property="links", type="array", @OA\Items(type="object")),
     *             @OA\Property(property="next_page_url", type="string", nullable=true, example=null),
     *             @OA\Property(property="prev_page_url", type="string", nullable=true, example=null),
     *             @OA\Property(property="path", type="string", example="http://127.0.0.1:8000/api/products"),
     *             @OA\Property(property="per_page", type="integer", example=15),
     *             @OA\Property(property="total", type="integer", example=45)
     *         )
     *     )
     * )
     */
    public function index()
    {
        $filters = [
            'name'        => request('name'),           
            'description' => request('description'),  
            'price'       => [
                'operator' => request('operator', '='),  
                'value'    => request('price', null),   
            ],
            'product_type'=> request('product_type'),   
        ];

        $perPage = request('per_page', 15);


        return $this->iProductService->listRecords($filters, $perPage);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}

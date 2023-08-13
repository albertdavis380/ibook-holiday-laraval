<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;


class ProductController extends Controller
{

    public function fetchSortOptions()
    {
        $sortOptions = [
            array('value' => '', 'label' => 'All'),
            array('value' => 'name_asc', 'label' => 'Name (A-Z)'),
            array('value' => 'name_desc', 'label' => 'Name (Z-A)'),
            array('value' => 'price_asc', 'label' => 'Price (Low to High)'),
            array('value' => 'price_desc', 'label' => 'Price (High to Low)'),
            // Add more sort options as needed
        ];

        return response()->json(['sortOptions' => $sortOptions]);
    }

    public function index(Request $request)
    {
        $query = $request->input('query');
        $perPage = $request->input('perPage');



        $productsQuery = Product::query();

        if ($query) {
            $productsQuery->where('name', 'like', "%$query%");
            // Add more search criteria here
        }


        if ($request->has('category') && $request->category != "") {
            $productsQuery->where('category', $request->category);
        }
        // Add more filters here



        if ($request->has('sort')) {
            $sortCriteria = explode('_', $request->sort);
            if (count($sortCriteria)) {


                if ($sortCriteria[0] != "") {

                    $productsQuery->orderBy($sortCriteria[0], $sortCriteria[1]);

                }
            }
        }

        $products = $productsQuery->paginate($perPage);

        return response()->json($products);
    }



    public function fetchFilterOptions()
    {
        $categories = Product::distinct()->pluck('category');
        // You can fetch other filter options dynamically here based on your data

        $c = [array('value' => '', 'label' => 'All')];

        foreach ($categories as $value) {
            array_push($c, array("label" => $value, "value" => $value));
        }

        return response()->json(['categories' => $c]);
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $user = Auth::user();
        $isFavorite = $user->favoriteProducts->contains($product->id);

        // Add the is_favorite key to the product array
        $product['is_favorite'] = $isFavorite;

        return response()->json(['product' => $product, 'success' => true]);
    }




    public function addToFavorites($productId)
    {
        $user = Auth::user();

        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Check if the product is already in the user's favorites
        if ($user->favoriteProducts->contains($product->id)) {
            return response()->json(['message' => 'Product is already in favorites', 'success' => false]);
        }

        $user->favoriteProducts()->attach($product->id);

        return response()->json(['message' => 'Product added to favorites', 'success' => true]);
    }


    public function removeFromFavorites($productId)
    {
        $user = Auth::user();

        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Check if the product is in the user's favorites
        if (!$user->favoriteProducts->contains($product->id)) {
            return response()->json(['message' => 'Product is not in favorites', 'success' => false]);
        }

        $user->favoriteProducts()->detach($product->id);

        return response()->json(['message' => 'Product removed from favorites', 'success' => true]);
    }



    public function listFavorites()
    {
        $user = Auth::user();
        $favoriteProducts = $user->favoriteProducts;

        return response()->json(['favoriteProducts' => $favoriteProducts]);
    }

}
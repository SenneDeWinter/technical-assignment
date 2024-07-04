<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Repositories\Repositories\ComicRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CartController extends Controller
{
    public function addToBasket(Request $request, int $comic_id): JsonResponse
    {
        $comic = ComicRepository::getComicByMarvelId($comic_id);

        $cart = $request->session()->get('cart', []);

        foreach ($cart as &$item) {
            if ($item['comic_id'] === $comic->marvel_id) {
                $item['quantity'] += 1;
                $request->session()->put('cart', $cart);

                return response()->json(['message' => 'Comic added to cart', 'cart' => $cart]);
            }
        }

        $cart[] = [
            'comic_id' => $comic->marvel_id,
            'title' => $comic->title,
            'thumbnail' => $comic->thumbnail,
            'quantity' => 1,
        ];

        $request->session()->put('cart', $cart);

        return response()->json(['message' => 'Comic added to cart']);
    }

    public function getCart(Request $request): ResourceCollection
    {
        $cart = $request->session()->get('cart', []);

        return CartResource::collection($cart);
    }
}

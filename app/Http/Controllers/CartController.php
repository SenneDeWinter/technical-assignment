<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Models\DeletedItem;
use App\Repositories\Repositories\ComicRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\View\View;

class CartController extends Controller
{
    public function addToBasket(Request $request, int $comic_id): JsonResponse
    {
        $comic = ComicRepository::getComicByMarvelId($comic_id);

        $cart = $request->session()->get('cart', []);

        foreach ($cart as &$item) {
            if ($item['marvel_id'] === $comic->marvel_id) {
                $item['quantity'] += 1;
                $request->session()->put('cart', $cart);

                return response()->json(['message' => 'Comic added to cart', 'cart' => $cart]);
            }
        }

        $cart[] = [
            'marvel_id' => $comic->marvel_id,
            'title' => $comic->title,
            'thumbnail' => $comic->thumbnail,
            'quantity' => 1,
        ];

        $request->session()->put('cart', $cart);

        return response()->json(['message' => 'Comic added to cart']);
    }

    public function removeFromBasket(Request $request, int $comic_id): JsonResponse
    {
        $cart = $request->session()->get('cart', []);

        foreach ($cart as $key => $item) {
            if ($item['marvel_id'] === $comic_id) {
                unset($cart[$key]);
                $request->session()->put('cart', $cart);

                $deletedItem = DeletedItem::where('marvel_id', $comic_id)->first();
                if ($deletedItem) {
                    $deletedItem->times_deleted += 1;
                    $deletedItem->save();
                } else {
                    DeletedItem::create([
                        'marvel_id' => $comic_id,
                        'title' => $item['title'],
                        'times_deleted' => 1,
                    ]);
                }

                return response()->json(['message' => 'Comic removed from cart']);
            }
        }

        return response()->json(['message' => 'Comic not found in cart'], 404);
    }

    public function getCart(Request $request): ResourceCollection
    {
        $cart = $request->session()->get('cart', []);

        return CartResource::collection($cart);
    }

    public function showCart(Request $request): View
    {
        $cart = $request->session()->get('cart', []);

        return view('cart', ['cart' => $cart]);
    }
}

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Cart</title>
</head>
<body class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
<h1 class="mb-8 text-4xl font-bold text-center">Cart</h1>
<a class="mb-8 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" href="/">Back to shop</a>
@if(count($cart) === 0)
    <p class="text-xl">Your cart is empty</p>
@endif
<div class="grid grid-cols-3 gap-4 justify-items-center">
    @foreach($cart as $cart_item)
        <div class="col-span-1 w-64 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="w-full h-64 overflow-hidden">
                <img class="w-full h-full" src="{{$cart_item['thumbnail']}}" alt="{{$cart_item['title']}}" />
            </div>
            <div class="p-5">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$cart_item['title']}}</h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Quantity: {{$cart_item['quantity']}}</p>
                <button onclick="removeFromCart({{$cart_item['marvel_id']}})"  class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Remove from cart
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </button>
            </div>
        </div>
    @endforeach
</div>
<script>
    function removeFromCart(comicId) {
        fetch(`/remove-from-cart/${comicId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        })
            .then(response => response.json())
            .then(data => {
                console.log(data)
                window.location.reload();
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }
</script>
</body>
</html>

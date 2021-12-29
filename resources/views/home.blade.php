<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <meta name="description" content="Web site created using Laravel" />
    <title>Golden Sneaker</title>

    <link rel="stylesheet" href="{{asset('css/style.css')}}" rel="stylesheet" />
</head>

<body>
    <div id="main-content">
        <div class="card">
            <div class="card-top">
                <img src="{{asset('img/nike.png')}}" class="card-top-logo" />
            </div>
            <div class="card-title">
                Our Products
            </div>
            <div class="card-body">
                <div class="shop-items">
                    @foreach($products as $product)
                    <div class="shop-item">
                        <div class="shop-item-image" style="background-color:{{{ $product->color }}}">
                            <img src="{{$product->image}}" />
                        </div>
                        <div class="shop-item-name">{{$product->name}}</div>
                        <div class="shop-item-description">{{$product->description}}</div>
                        <div class="shop-item-bottom">
                            <div class="shop-item-price">@money($product->price)</div>
                            @if($product->checked == 0)
                            <div class="shop-item-button" data-id="{{$product->id}}">
                                <p>ADD TO CART</p>
                            </div>
                            @else
                            <div class="shop-item-button inactive">
                                <div class="shop-item-button-cover">
                                    <div class="shop-item-button-cover-check-icon"></div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-top">
                <img src="{{asset('img/nike.png')}}" class="card-top-logo" />
            </div>
            <div class="card-title">
                Your cart
                @php $total_price = 0; @endphp
                @foreach($carts as $cart)
                @php $total_price += $cart->quantity * $cart->product->price; @endphp
                @endforeach
                <span class="card-title-amount">@money($total_price)</span>
            </div>
            <div class="card-body">
                <div class="cart-items">
                    <div>
                        @if(count($carts) > 0)
                        @foreach($carts as $cart)
                        <div class="cart-item">
                            <div class="cart-item-left">
                                <div class="cart-item-image" style="background-color:{{{ $cart->product->color }}}">
                                    <div class="cart-item-image-block">
                                        <img src="{{$cart->product->image}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="cart-item-right">
                                <div class="cart-item-name">{{$cart->product->name}}</div>
                                <div class="cart-item-price">@money($cart->product->price)</div>
                                <div class="cart-item-actions">
                                    <div class="cart-item-count">
                                        <div class="cart-item-count-button sub" data-id="{{$cart->id}}">
                                            -
                                        </div>
                                        <div class="cart-item-count-number">{{$cart->quantity}}</div>
                                        <div class="cart-item-count-button add" data-id="{{$cart->id}}">
                                            +
                                        </div>
                                    </div>
                                    <div class="cart-item-remove" data-id="{{$cart->id}}">
                                        <img src="{{asset('img/trash.png')}}" class="cart-item-remove-icon" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="cart-empty">
                            <p class="cart-empty-text">Your cart is empty.</p>
                        </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.24.0/axios.min.js" integrity="sha512-u9akINsQsAkG9xjc1cnGF4zw5TFDwkxuc9vUp5dltDWYCSmyd0meygbvgXrlc/z7/o4a19Fb5V0OUE58J7dcyw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('js/script.js')}}"></script>
</body>

</html>

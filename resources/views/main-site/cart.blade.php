@extends('layouts.main-site')

@push('styles')
    
    
    <!-- Animation CSS -->
    <link rel="stylesheet" href="/assets/css/animate.css">	
    <!-- Latest Bootstrap min CSS -->
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script&amp;display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i&amp;display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&amp;display=swap" rel="stylesheet"> 
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="/assets/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/ionicons.min.css">
    <link rel="stylesheet" href="/assets/css/themify-icons.css">
    <link rel="stylesheet" href="/assets/css/linearicons.css">
    <link rel="stylesheet" href="/assets/css/flaticon.css">
    <!--- owl carousel CSS-->
    <link rel="stylesheet" href="/assets/owlcarousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/owlcarousel/css/owl.theme.css">
    <link rel="stylesheet" href="/assets/owlcarousel/css/owl.theme.default.min.css">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="/assets/css/slick.css">
    <link rel="stylesheet" href="/assets/css/slick-theme.css">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="/assets/css/magnific-popup.css">
    <!-- DatePicker CSS -->
    <link href="/assets/css/datepicker.min.css" rel="stylesheet">
    <!-- TimePicker CSS -->
    <link href="/assets/css/mdtimepicker.min.css" rel="stylesheet">
    <!-- Style CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/responsive.css">
    <link id="layoutstyle" rel="stylesheet" href="/assets/color/theme-red.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endpush

@push('scripts')
    
    <!-- Latest jQuery --> 
    <script src="/assets/js/jquery-1.12.4.min.js"></script> 
    <!-- Latest compiled and minified Bootstrap --> 
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script> 
    <!-- owl-carousel min js  --> 
    <script src="/assets/owlcarousel/js/owl.carousel.min.js"></script> 
    <!-- magnific-popup min js  --> 
    <script src="/assets/js/magnific-popup.min.js"></script> 
    <!-- waypoints min js  --> 
    <script src="/assets/js/waypoints.min.js"></script> 
    <!-- parallax js  --> 
    <script src="/assets/js/parallax.js"></script> 
    <!-- countdown js  --> 
    <script src="/assets/js/jquery.countdown.min.js"></script> 
    <!-- jquery.countTo js  -->
    <script src="/assets/js/jquery.countTo.js"></script>
    <!-- imagesloaded js --> 
    <script src="/assets/js/imagesloaded.pkgd.min.js"></script>
    <!-- isotope min js --> 
    <script src="/assets/js/isotope.min.js"></script>
    <!-- jquery.appear js  -->
    <script src="/assets/js/jquery.appear.js"></script>
    <!-- jquery.dd.min js -->
    <script src="/assets/js/jquery.dd.min.js"></script>
    <!-- slick js -->
    <script src="/assets/js/slick.min.js"></script>
    <!-- DatePicker js -->
    <script src="/assets/js/datepicker.min.js"></script>
    <!-- TimePicker js -->
    <script src="/assets/js/mdtimepicker.min.js"></script>
    <!-- scripts js --> 
    <script src="/assets/js/scripts.js"></script>

    <script>
        $(document).ready(function () {
            // Actualizar interfaz del carrito
            function updateCartUI(cart) {
                var cartContainer = $('#cart-container');
                cartContainer.empty(); // Limpiar carrito existente
    
                var total = 0;
                $.each(cart, function (index, item) {
                    var subtotal = item.quantity * item.price;
                    total += subtotal;
                    // Usar el helper de ruta de Laravel para generar las URLs
                    var menuItemUrl = "{{ route('menu.item', ':id') }}".replace(':id', item.id);
                
                    cartContainer.append(`
                        <tr>
                            <td class="product-thumbnail"><a href="${menuItemUrl}"><img src="${item.img_src}" alt="product1"></a></td>
                            <td class="product-name" data-title="Producto"><a href="${item.id}">${item.name}</a></td>
                            <td class="product-price" data-title="Precio">{!! $site_settings->currency_symbol !!}${(item.price).replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</td>
                            <td class="product-quantity" data-title="Cantidad">
                                <div class="quantity">
                                    <input type="button" value="-" class="minus">
                                    <input type="text" min="1" name="quantity" value="${item.quantity}" title="Cant" class="qty quantity-input" size="4" data-id="${item.id}">
                                    <input type="button" value="+" class="plus">
                                </div>
                            </td>
                            <td class="product-subtotal" data-title="Total">{!! $site_settings->currency_symbol !!}${subtotal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</td>
                            <td class="product-remove" data-title="Eliminar"><button class="btn btn-danger btn-sm remove-btn" data-id="${item.id}"  > <i class="ti-close"></i></button></td>
                        </tr>
                    `);
                });
    
                if (total > 0) {
                    $('#customer-cart').show();
                    $('#checkout').show();
                    $('#empty-cart').hide();
                    
                  
                } else {
                    $('#customer-cart').hide();
                    $('#checkout').hide();
                    $('#empty-cart').show();

                }
    
                // Mostrar el total
                $('#cart-subtotal').text("{!! html_entity_decode($site_settings->currency_symbol) !!}" + total.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                $('#total').val(total.toFixed(2));
    
                // Listener para botones de eliminar
                $('.remove-btn').click(function () {
                    var id          = $(this).data('id');
                    
                    removeFromCart(id);
                });
    
                // Listener para inputs de cantidad
                $('.quantity-input').change(function () {
                    var id = $(this).data('id');
                    var newQuantity = $(this).val();
                    updateCartQuantity(id, newQuantity);
                });
            }
    
            // Función para eliminar artículo del carrito
            function removeFromCart(id) {
                var currentCount = parseInt($('#cart_count').text());
                
                $.post('{{ route('customer.cart.remove') }}', { _token: "{{ csrf_token() }}", cartkey: 'customer', id: id }, function (data) {
                    if (data.success) {
                        updateCartUI(data.cart);
                        if (currentCount > 0) {
                            $('#cart_count').text(data.total_items);
                        }
                    }
                });
            }
    

            // Función para vaciar carrito
            $('#clear-cart').click(function () {
                $.post('{{ route('customer.cart.clear') }}', { _token: "{{ csrf_token() }}", cartkey: 'customer' }, function (data) {
                    if (data.success) {
                        updateCartUI([]);
                        $('#cart_count').text(0);

                    }
                });
            });


            // Función para actualizar cantidad en el carrito
            function updateCartQuantity(id, quantity) {
                $.post('{{ route('customer.cart.update')  }}', {   _token: "{{ csrf_token() }}",   cartkey: 'customer', id: id, quantity: quantity }, function (data) {
                    if (data.success) {
                        updateCartUI(data.cart);
                        $('#cart_count').text(data.total_items);
                    }
                });
            }

            // Listener para botones de eliminar
            $('.remove-btn').click(function () {
                var id = $(this).data('id');
                removeFromCart(id);
            });
    
            // Obtención inicial de artículos del carrito
            $.get('{{ route('customer.cart.view') }}', { cartkey: 'customer' }, function (data) {
                updateCartUI(data.cart);
            });

            $(document).on('click', '.plus', function () {
                var input = $(this).prev();  
                if (input.val()) {
                    input.val(+input.val() + 1).trigger('change');  
                }
            });

            $(document).on('click', '.minus', function () {
                var input = $(this).next(); 
                if (input.val() > 1) {
                    input.val(+input.val() - 1).trigger('change'); 
                }
            });
                        
        });
    </script>
    
@endpush


@section('title', 'Carrito')


@section('header')
    <!-- START HEADER -->
        <header class="header_wrap fixed-top header_with_topbar light_skin main_menu_uppercase">
        <div class="container">
            @include('partials.nav')
        </div>
    </header>
    <!-- END HEADER -->
@endsection


@section('content')

 <!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section background_bg overlay_bg_50 page_title_light" data-img-src="/assets/images/cart_bg.jpg">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title">
            		<h1>Carrito de Compras</h1>
                </div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Carrito de Compras</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START SECTION SHOP -->
<div class="section">
	<div class="container">
        <div class="row" id="customer-cart">
         
            <div class="col-12">
                <div class="table-responsive shop_cart_table">
                	<table class="table">
                    	<thead>
                        	<tr>
                            	<th class="product-thumbnail">&nbsp;</th>
                                <th class="product-name">Producto</th>
                                <th class="product-price">Precio</th>
                                <th class="product-quantity">Cantidad</th>
                                <th class="product-subtotal">Total</th>
                                <th class="product-remove">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="cart-container">

                            <!-- Los artículos del carrito se insertarán aquí -->


                        </tbody>
                        <tfoot>
                        	<tr>
                            	<td colspan="6" class="px-0">
                                	<div class="row no-gutters align-items-center">

                                    	<div class="col-lg-4 col-md-6 mb-3 mb-md-0">
                                  
                                    	</div>
                                        <div class="col-lg-8 col-md-6 text-left text-md-right">
                                            <button id="clear-cart"  class="btn btn-dark btn-sm" type="submit">Vaciar Carrito</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tfoot> 
                    </table>

                    
                </div>
            </div>
 
        </div>
        <div class="row">
            <div class="col-12">
            	<div class="medium_divider"></div>

 
            </div>
        </div>
        <div class="row" id="checkout">
            <div class="col-lg-8">

            	<div class="cart_totals">
             
                    <div class="table-responsive">

                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="cart_total_label">Subtotal del Carrito</td>
                                    <td class="cart_total_amount" id="cart-subtotal">{!! $site_settings->currency_symbol !!}0.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('customer.checkout') }}" class="btn btn-default">Proceder al Pago</a>

                </div>
            </div>
        </div>
        <div class="row" id="empty-cart">
            <div class="col-12">
                <div class="alert alert-secondary text-center" role="alert">
                    <h4 class="alert-heading">¡Tu Carrito está Vacío!</h4>
                    <p>Parece que aún no has agregado ningún artículo a tu carrito. No te preocupes, tenemos muchas opciones deliciosas esperándote.</p>
                    <hr>
                    <p class="mb-0">Dirígete a nuestro <a href="{{ route('menu') }}" class="alert-link">menú</a> y ¡comienza a explorar!</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION SHOP -->
@endsection
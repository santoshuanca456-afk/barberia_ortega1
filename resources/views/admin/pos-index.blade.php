@extends('layouts.admin')

@push('styles')
    <!-- base:css -->
    <link rel="stylesheet" href="/admin_resources/vendors/typicons.font/font/typicons.css">
    <link rel="stylesheet" href="/admin_resources/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/admin_resources/css/vertical-layout-light/style.css">

<!-- DataTables   CSS -->

    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">

    
@endpush

@push('scripts')
 
<script src="/admin_resources/vendors/js/vendor.bundle.base.js"></script>
<script src="/admin_resources/js/off-canvas.js"></script>
<script src="/admin_resources/js/hoverable-collapse.js"></script>
<script src="/admin_resources/js/template.js"></script>
<script src="/admin_resources/js/settings.js"></script>
<script src="/admin_resources/js/todolist.js"></script>
<!-- plugin js for this page -->
<script src="/admin_resources/vendors/progressbar.js/progressbar.min.js"></script>
<script src="/admin_resources/vendors/chart.js/Chart.min.js"></script>
<!-- Custom js for this page-->
 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 
<!-- DataTables JS  -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        // Inicializar DataTable para la tabla de menú
        $('#menu-table').DataTable({
            "paging": true,        
            "searching": true,      
            "ordering": false,      
            "info": false,          
            "lengthChange": false, 
            "processing": true,     
            "bPaginate": true,      
            "bSort": false,         
     
        });
    });
</script>

<script>  

$(document).ready(function () {
    // Función para agregar artículo al carrito
    function addToCart(id, name, price) {
        $.post('{{ route('admin.cart.add') }}', {  _token: "{{ csrf_token() }}", cartkey: 'admin', id: id, name: name, price: price }, function (data) {
            if (data.success) {
                updateCartUI(data.cart);
 
            }
        });
    }

    // Función para eliminar artículo del carrito
    function removeFromCart(id) {
        $.post('{{ route('admin.cart.remove') }}', {  _token: "{{ csrf_token() }}", cartkey: 'admin', id: id }, function (data) {
            if (data.success) {
                updateCartUI(data.cart);
            }
        });
    }

    // Función para vaciar carrito
    $('#clear-cart').click(function () {
        $.post('{{ route('admin.cart.clear') }}', { _token: "{{ csrf_token() }}", cartkey: 'admin' }, function (data) {
            if (data.success) {
                updateCartUI([]);
            }
        });
    });

    // Actualizar interfaz del carrito
    function updateCartUI(cart) {
        var cartContainer = $('#cart-container');
        cartContainer.empty(); // Limpiar carrito existente

        var total = 0;
        $.each(cart, function (index, item) {
            var subtotal = item.quantity * item.price;
            total += subtotal;

            cartContainer.append(`
                <tr class="cart-item">
                    <td>${item.name}</td>
                    <td>{!! $site_settings->currency_symbol !!}${(item.price).replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</td>
                    <td><input type="number" value="${item.quantity}" min="1" data-id="${item.id}" class="quantity-input" style="width: 4.5em;"></td>
                    <td>{!! $site_settings->currency_symbol !!}${subtotal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</td>
                    <td><button class="btn btn-danger btn-sm remove-btn" data-id="${item.id}"> <i class="fa fa-times" aria-hidden="true"></i></button></td>
                </tr> 

            `);
        });

        if(total > 0){
            $('#clear-cart').show();  
            if ($('#payment_method').val() !== "") { $('#checkout-btn').show();  } else { $('#checkout-btn').hide();  }
        } else {
          $('#clear-cart').hide();  
          $('#checkout-btn').hide();         
        }

        // Mostrar el total
        $('#cart-total').text('Total: {!! html_entity_decode($site_settings->currency_symbol) !!}' + total.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        $('#total').val(total.toFixed(2))
        
        // listener para botones de eliminar
        $('.remove-btn').click(function () {
            var id = $(this).data('id');
            removeFromCart(id);
        });

      // listener para inputs de cantidad
      $('.quantity-input').change(function () {
          var id = $(this).data('id');
          var newQuantity = $(this).val();
          updateCartQuantity(id, newQuantity);
      });

    }

    // Asignar función addToCart a los botones
    $('.add-to-cart').click(function () {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var price = $(this).data('price');
        addToCart(id, name, price);
    });


      // Función para actualizar cantidad en el carrito
    function updateCartQuantity(id, quantity) {
        $.post('{{ route('admin.cart.update')  }}', {   _token: "{{ csrf_token() }}",   cartkey: 'admin', id: id, quantity: quantity }, function (data) {
            if (data.success) {
                updateCartUI(data.cart);
            }
        });
    }


    // Obtención inicial de artículos del carrito
    $.get('{{ route('admin.cart.view') }}', { cartkey: 'admin' }, function (data) {
        updateCartUI(data.cart);
    });
});

 
document.querySelector('[data-bs-toggle="collapse"]').addEventListener('click', function () {
    const icon = this.querySelector('.toggle-icon');
    if (icon.classList.contains('fa-plus')) {
        icon.classList.remove('fa-plus');
        icon.classList.add('fa-minus');
    } else {
        icon.classList.remove('fa-minus');
        icon.classList.add('fa-plus');
    }
});

$('#payment_method').on('change', function() {
    if ($(this).val() !== "" && $('#total').val() > 0) {
        $('#checkout-btn').show();   
    } else {
        $('#checkout-btn').hide();   
    }
});


     $('#checkout-btn').click(function(event) {
        event.preventDefault();
        $('#confirmationModal').modal('show');
    });

     $('#confirmSubmit').click(function() {
        $('#checkout-form').submit();
    });

</script>
 
@endpush


@section('title', 'Admin - Punto de Venta')




@section('content')

<div class="main-panel">
    <div class="content-wrapper">
 
      @include('partials.message-bag')
 

      <div class="row">
        <div class="col-lg-6 d-flex grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-wrap justify-content-between">
                    <h4 class="card-title mb-3">Menús</h4>
                  </div>
                  <div class="table-responsive">
                    <table class="table" id="menu-table">
                        <thead style="display: none;">
                            <tr>
                                <th>Elemento del Menú</th>
                                <th>Precio</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                      <tbody>
                        @forelse ($menus as $menu)
                        <tr>
                            <td>
                                <!-- Disparador para Modal de Lightbox -->
                                <img src="{{ asset('storage/' . $menu->image) }}" alt="Imagen del Menú" width="50" class="img-thumbnail trigger-lightbox" data-bs-toggle="modal" data-bs-target="#imageModal" data-image="{{ asset('storage/' . $menu->image) }}">  {{ $menu->name }}
                            </td>
                            <td>{!! $site_settings->currency_symbol !!}{{ $menu->price }}</td>
                            <td>
     
                                <button class="m-1 btn btn-secondary btn-sm add-to-cart"
                                data-id="{{ $menu->id }}"
                                data-name="{{ $menu->name }}"
                                data-price="{{ $menu->price }}" >
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No hay menús disponibles.</td>
                        </tr>
                    @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
        </div>
        <div class="col-lg-6 d-flex grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div style="" class="d-flex flex-wrap justify-content-between">
                <h4 class="card-title mb-3">Carrito</h4>
              </div>
 

              <div style="overflow-x: auto;">
              <table class="table" >
                <thead >
                    <tr>
                        <th>Artículo</th>
                        <th>Precio</th>
                        <th style="width:20%;">Cantidad</th>
                        <th>Subtotal</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="cart-container">
                    <!-- Los artículos del carrito se insertarán aquí -->
                </tbody>
            </table>
            </div>

            <hr/>
            <div id="cart-total" class="mt-3"></div>
            <hr/>

 


            </div>
            <div class="card-footer">
              <button id="clear-cart" style="display: none;" class="btn-block btn btn-warning mt-3"> Vaciar Carrito</button>

            </div>

          </div>
        </div>
      </div>

    @if ($menus->count() != 0)
       <div class="card mb-4">
        <div class="card-body">
          <form id="checkout-form" method="POST" action="{{ route('admin.order.store') }}">
            <input type="hidden"   id="total" value="0">
            <input type="hidden"   name="cartkey" value="admin">
            @csrf
              <div class="mt-4">
                  <!-- Botón de Alternancia -->
                  <button class="btn btn-outline-secondary btn-fw mb-2 btn-block" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleTable" aria-expanded="false" aria-controls="collapsibleTable">
                    <i class="fa fa-plus toggle-icon"></i> Detalles del Cliente
                </button>
                

                  <!-- Tabla Colapsable -->
                  <div class="collapse" id="collapsibleTable">
                      <table class="table table-bordered">
                          <tbody>
                              <tr>
                                  <td><strong>Nombre</strong></td>
                                  <td><input type="text" class="form-control" id="name" name="name"></td>
                              </tr>
                              <tr>
                                  <td><strong>Email</strong></td>
                                  <td><input type="email" class="form-control" id="email" name="email"></td>
                              </tr>
                              <tr>
                                  <td><strong>Número de Teléfono</strong></td>
                                  <td><input type="text" class="form-control" id="phone_number" name="phone_number"></td>
                              </tr>
                              <tr>
                                  <td><strong>Dirección</strong></td>
                                  <td><input type="text" class="form-control" id="address" name="address"></td>
                              </tr>
             
                          </tbody>
                      </table>
                  </div>
              </div>

              <hr>
              <table class="table table-bordered"> 
                <tbody>
                    <tr>
                        <td><strong>Información Adicional</strong></td>
                        <td>
                            <textarea class="form-control" id="additional_info" name="additional_info" rows="2" placeholder="ej. alergias o cualquier otra información"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Método de Pago</strong></td>
                        <td>
                            <select class="form-control" id="payment_method" name="payment_method" required>
                                <option value="">Seleccione un método de pago</option>
                                <option>Tarjeta de Crédito / Débito</option>
                                <option>Transferencia Bancaria</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            


            </form>
        </div>
        <div class="card-footer text-right">
            <button type="button" style="display:none;" id="checkout-btn" form="checkout-form" class="btn btn-primary">Finalizar Compra</button>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('admin.dashboard') }}'">Cancelar</button>

        </div>
    </div>     
    @endif

    
 



<!-- Modal de Confirmación -->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="confirmationModalLabel">Confirmar Pedido</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <i class="fa fa-times" aria-hidden="true"></i>
              </button>
          </div>
          <div class="modal-body">
              ¿Está seguro de que desea enviar este pedido?
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary" id="confirmSubmit">Confirmar</button>
          </div>
      </div>
  </div>
</div>




    </div>
    <!-- content-wrapper ends -->
    @include('partials.admin.footer')
  </div>
  <!-- main-panel ends -->
@endsection
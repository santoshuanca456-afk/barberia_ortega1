@extends('layouts.admin')

@push('styles')
    <!-- base:css -->
    <link rel="stylesheet" href="/admin_resources/vendors/typicons.font/font/typicons.css">
    <link rel="stylesheet" href="/admin_resources/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/admin_resources/css/vertical-layout-light/style.css">
    
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
<script src="/admin_resources/js/dashboard.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function () {
        // Modal de Números de Teléfono
        function resetPhoneNumberModal() {
            $('#phoneNumberForm')[0].reset();
            $('#phoneNumberForm').attr('action', "{{ route('admin.phone-number.store') }}");
            $('#phoneNumberFormMethod').val('');
        }

        window.createPhoneNumber = function () {
            resetPhoneNumberModal();
            $('#phoneNumberModalLabel').text('Agregar Número de Teléfono');
        };

        window.editPhoneNumber = function (id, phoneNumber, useWhatsapp) {
            resetPhoneNumberModal();
            $('#phone_number').val(phoneNumber);
            $('#use_whatsapp').prop('checked', useWhatsapp === 1); // Marcar si useWhatsapp es 1
            let actionUrl = "{{ route('admin.phone-number.update', ':id') }}".replace(':id', id);
            $('#phoneNumberForm').attr('action', actionUrl);
            $('#phoneNumberFormMethod').val('PUT');
            $('#phoneNumberModalLabel').text('Editar Número de Teléfono');
        };

        // Modal de Direcciones
        function resetAddressModal() {
            $('#addressForm')[0].reset();
            $('#addressForm').attr('action', "{{ route('admin.address.store') }}");
            $('#addressFormMethod').val('');
        }

        window.createAddress = function () {
            resetAddressModal();
            $('#addressModalLabel').text('Agregar Dirección');
        };

        window.editAddress = function (id, address) {
            resetAddressModal();
            $('#address').val(address);
            let actionUrl = "{{ route('admin.address.update', ':id') }}".replace(':id', id);
            $('#addressForm').attr('action', actionUrl);
            $('#addressFormMethod').val('PUT');
            $('#addressModalLabel').text('Editar Dirección');
        };

        // Modal de Horarios de Trabajo
        function resetWorkingHourModal() {
            $('#workingHourForm')[0].reset();
            $('#workingHourForm').attr('action', "{{ route('admin.working-hour.store') }}");
            $('#workingHourId').val('');
        }

        window.createWorkingHour = function () {
            resetWorkingHourModal();
            $('#workingHourModalLabel').text('Agregar Horario de Trabajo');
        };

        window.editWorkingHour = function (id, workingHour) {
            resetWorkingHourModal();
            $('#working_hours').val(workingHour);
            let actionUrl = "{{ route('admin.working-hour.update', ':id') }}".replace(':id', id);
            $('#workingHourForm').attr('action', actionUrl);
            $('#workingHourId').val('PUT');
            $('#workingHourModalLabel').text('Editar Horario de Trabajo');
        };

        // Modal de Redes Sociales
        function resetSocialMediaModal() {
            $('#socialMediaForm')[0].reset();
            $('#socialMediaForm').attr('action', "{{ route('admin.social-media-handles.store') }}");
            $('#handle').val('');
            $('#socialMediaFormMethod').val('');
        }

        window.createSocialMediaHandle = function () {
            resetSocialMediaModal();
            $('#socialMediaModalLabel').text('Agregar Red Social');
        };

        window.editSocialMediaHandle = function (id, handle, socialMedia) {
            resetSocialMediaModal();
            $('#handle').val(handle);
            $('#social_media').val(socialMedia);
            let actionUrl = "{{ route('admin.social-media-handles.update', ':id') }}".replace(':id', id);
            $('#socialMediaForm').attr('action', actionUrl);
            $('#socialMediaFormMethod').val('PUT');
            $('#socialMediaModalLabel').text('Editar Red Social');
        };      

        // Eliminar Número de Teléfono
        window.deletePhoneNumber = function (id) {
            let actionUrl = "{{ route('admin.phone-number.delete', ':id') }}".replace(':id', id);
            $('#deletePhoneNumberForm').attr('action', actionUrl);
            $('#deletePhoneNumberModal').modal('show');
        };

        // Eliminar Dirección
        window.deleteAddress = function (id) {
            let actionUrl = "{{ route('admin.address.delete', ':id') }}".replace(':id', id);
            $('#deleteAddressForm').attr('action', actionUrl);
            $('#deleteAddressModal').modal('show');
        };

        // Eliminar Horario de Trabajo
        window.deleteWorkingHour = function (id) {
            let actionUrl = "{{ route('admin.working-hour.delete', ':id') }}".replace(':id', id);
            $('#deleteWorkingHourForm').attr('action', actionUrl);
            $('#deleteWorkingHourModal').modal('show');
        };

        // Eliminar Red Social
        window.deleteSocialMediaHandle = function (id) {
            let actionUrl = "{{ route('admin.social-media-handles.delete', ':id') }}".replace(':id', id);
            $('#deleteSocialMediaHandleForm').attr('action', actionUrl);
            $('#deleteSocialMediaHandleModal').modal('show');
        };
    });
</script>



 <script>
    $(document).ready(function () {
        $('#country').on('change', function () {
            // Obtener el país seleccionado
            var country = $(this).val();

            // Asegurarse de que se seleccionó un país
            if (!country) return;

            // URL de la API
            var apiUrl = "https://www.getcountrycurrency.com/api/country-currency/" + encodeURIComponent(country);

            // Hacer solicitud AJAX para obtener detalles de la moneda
            $.ajax({
                url: apiUrl,
                method: "GET",
                dataType: "json",
                success: function (data) {
                    // Verificar si los datos contienen los campos esperados
                    if (data.currency_name && data.currency_code && data.currency_symbol) {
                        // Decodificar la entidad HTML para el símbolo de moneda
                        var parser = new DOMParser();
                        var decodedSymbol = parser.parseFromString(data.currency_symbol, 'text/html').body.textContent;
                        

                        // Rellenar los campos con los detalles de la moneda
                        $('#decoded_symbol').val(decodedSymbol);
                        $('#currency_code').val(data.currency_code);
                        $('#currency_symbol').val(data.currency_symbol);

                    } else {
                        alert("No se encontraron detalles de moneda para el país seleccionado.");
                        $('#currency_code, #currency_symbol, #decoded_symbol').val("");

                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error al obtener detalles de la moneda:", error);
                    alert("Ocurrió un error al obtener los detalles de la moneda.");
                    $('#currency_code, #currency_symbol, #decoded_symbol').val("");

                }
            });
        });
    });

 </script>
 


@endpush


@section('title', 'Admin - Configuración - General')




@section('content')

<div class="main-panel">
    <div class="content-wrapper">
 
      @include('partials.message-bag')

 
      <hr/>
      <h1>Configuración General</h1>
      




      <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <!-- Números de Teléfono -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Números de Teléfono del Restaurante</span>
                    <button class="btn-sm btn btn-primary" data-bs-toggle="modal" data-bs-target="#phoneNumberModal" onclick="createPhoneNumber()">
                        <i class="fa fa-plus"></i> Agregar Teléfono
                    </button>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="col-8">Número de Teléfono</th>
                                <th class="col-4 text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="phoneNumbersTable">
                            @forelse($phoneNumbers as $phoneNumber)
                                <tr>
                                    <td>
                                        <i class="fa fa-phone" aria-hidden="true"></i> 
                                        {{ $phoneNumber->phone_number }}
                                        @if($phoneNumber->use_whatsapp == 1)
                                            <span class="badge bg-success"><i class="fab fa-whatsapp"></i></span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#phoneNumberModal" onclick="editPhoneNumber({{ $phoneNumber->id }}, '{{ $phoneNumber->phone_number }}', {{ $phoneNumber->use_whatsapp }})">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm" onclick="deletePhoneNumber({{ $phoneNumber->id }})">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">No hay números de teléfono disponibles. Por favor agregue un nuevo número.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    
        <div class="col-md-6 grid-margin stretch-card">
            <!-- Direcciones -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Direcciones del Restaurante</span>
                    <button class="btn-sm btn btn-primary" data-bs-toggle="modal" data-bs-target="#addressModal" onclick="createAddress()">
                        <i class="fa fa-plus"></i> Agregar Dirección
                    </button>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="col-8">Dirección</th>
                                <th class="col-4 text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($addresses as $address)
                                <tr>
                                    <td>
                                        <i class="fa fa-map-marker" aria-hidden="true"></i> 
                                        {{ $address->address }}
                                    </td>
                                    <td class="text-end">
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#addressModal" onclick="editAddress({{ $address->id }}, '{{ $address->address }}')">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm" onclick="deleteAddress({{ $address->id }})">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">No hay direcciones disponibles. Por favor agregue una nueva dirección.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <!-- Redes Sociales -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Redes Sociales</span>
                    <button class="btn-sm btn btn-primary" data-bs-toggle="modal" data-bs-target="#socialMediaModal" onclick="createSocialMediaHandle()">
                        <i class="fa fa-plus"></i> Agregar Red
                    </button>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Red Social</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($socialMediaHandles as $handle)
                                <tr>
                                    <td>
                                        @if($handle->social_media === 'facebook')
                                            <i class="fab fa-facebook-square"></i>
                                        @elseif($handle->social_media === 'instagram')
                                            <i class="fab fa-instagram"></i>
                                        @elseif($handle->social_media === 'youtube')
                                            <i class="fab fa-youtube-square"></i>         
                                        @elseif($handle->social_media === 'tiktok')
                                            <i class="fab fa-tiktok"></i>                                        
                                        @else
                                            <i class="fa fa-globe"></i> 
                                        @endif
                                        {{ $handle->handle }}</td>
                                    <td>{{ ucfirst($handle->social_media) }}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#socialMediaModal" onclick="editSocialMediaHandle({{ $handle->id }}, '{{ $handle->handle }}', '{{ $handle->social_media }}')">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm" onclick="deleteSocialMediaHandle({{ $handle->id }})"> <i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No hay redes sociales disponibles. Por favor agregue nuevas redes.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
        <div class="col-md-6 grid-margin stretch-card">
            <!-- Horarios de Trabajo -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Horarios del Restaurante</span>
                    <button class="btn-sm btn btn-primary" data-bs-toggle="modal" data-bs-target="#workingHourModal" onclick="createWorkingHour()">
                        <i class="fa fa-plus"></i> Agregar Horario
                    </button>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="col-8">Horario de Trabajo</th>
                                <th class="col-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($workingHours as $workingHour)
                                <tr>
                                    <td>
                                        <i class="fa fa-clock" aria-hidden="true"></i> 
                                        {{ $workingHour->working_hours }}
                                    </td>
                                    <td class="text-end">
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#workingHourModal" onclick="editWorkingHour({{ $workingHour->id }}, '{{ $workingHour->working_hours }}')">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm" onclick="deleteWorkingHour({{ $workingHour->id }})">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">No hay horarios disponibles. Por favor agregue nuevos horarios.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
    





    
    <div class="row">
        <div class="col-lg-6 d-flex grid-margin stretch-card">
            <form method="POST" action="{{ $script ? route('admin.livechat.update', $script->id) : route('admin.livechat.store') }}">
                <div class="card">
                    <div class="card-header">
                        <span>{{ $script ? 'Editar Script de Chat en Vivo' : 'Agregar Script de Chat en Vivo' }}</span>
                    </div>
                    <div class="card-body">
                        @csrf
                        @if($script)
                            @method('PUT')
                        @endif
                        <div class="alert alert-danger" role="alert">
                            <i class="fa fa-exclamation-triangle"></i> <b>Por favor asegúrese de ingresar un código de script de chat en vivo válido. Asegúrese de que el código sea copiado de un proveedor de chat en vivo confiable.</b>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <label for="name">Nombre del Chat en Vivo</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="ej. Tawk.to" value="{{ $script->name ?? '' }}" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="script_code">Código del Script</label>
                            <textarea class="form-control" id="script_code" name="script_code" rows="2" placeholder="Pegue el código del script aquí..." required>{{ $script->script_code ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between mt-4">
                        @if($script)
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                            <button type="button" class="btn btn-danger" onclick="if(confirm('¿Está seguro de que desea eliminar este script?')) { document.getElementById('form-delete-livechat').submit(); }">Eliminar Chat</button>
                        @else
                            <button type="submit" class="btn btn-primary">Agregar Chat</button>
                        @endif
                    </div>
                </div>
            </form>
    @if($script)
        <form method="POST" id="form-delete-livechat" action="{{ route('admin.livechat.destroy', $script->id) }}">
            @csrf
            @method('DELETE')
        </form>
    @endif
        </div>
        <div class="col-lg-6 d-flex grid-margin stretch-card">
 
            <div class="card">
                <div class="card-header">
                    Otras Configuraciones
                </div>
                     <form action="{{ route('site-settings.save') }}" method="POST" style="display: contents;">
                    @csrf
                    <input value="{{ $site_settings->currency_symbol ?? '' }}" required type="hidden" id="currency_symbol" name="currency_symbol" class="form-control">
            
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <!-- Selección de País -->
                                <tr>
                                    <td><strong>País</strong></td>
                                    <td>
                                        <select required class="form-control" id="country" name="country">
                                            <option value="" disabled {{ is_null($site_settings->country) ? 'selected' : '' }}>Seleccione un país</option>
                                            @php
                                                $countries = [
                                                    "Afganistán", "Albania", "Argelia", "Andorra", "Angola", "Antigua y Barbuda", "Argentina", "Armenia",
                                                    "Australia", "Austria", "Azerbaiyán", "Bahamas", "Baréin", "Bangladés", "Barbados", "Bielorrusia", "Bélgica",
                                                    "Belice", "Benín", "Bután", "Bolivia", "Bosnia y Herzegovina", "Botsuana", "Brasil", "Brunéi", "Bulgaria",
                                                    "Burkina Faso", "Burundi", "Cabo Verde", "Camboya", "Camerún", "Canadá", "República Centroafricana", "Chad",
                                                    "Chile", "China", "Colombia", "Comoras", "Congo (Congo-Brazzaville)", "Costa Rica", "Croacia", "Cuba", "Chipre",
                                                    "Chequia (República Checa)", "Dinamarca", "Yibuti", "Dominica", "República Dominicana", "Ecuador", "Egipto",
                                                    "El Salvador", "Guinea Ecuatorial", "Eritrea", "Estonia", "Esuatini (ant. \"Suazilandia\")", "Etiopía", "Fiyi",
                                                    "Finlandia", "Francia", "Gabón", "Gambia", "Georgia", "Alemania", "Ghana", "Grecia", "Granada", "Guatemala",
                                                    "Guinea", "Guinea-Bisáu", "Guyana", "Haití", "Santa Sede", "Honduras", "Hungría", "Islandia", "India", "Indonesia",
                                                    "Irán", "Irak", "Irlanda", "Israel", "Italia", "Jamaica", "Japón", "Jordania", "Kazajistán", "Kenia", "Kiribati",
                                                    "Kuwait", "Kirguistán", "Laos", "Letonia", "Líbano", "Lesoto", "Liberia", "Libia", "Liechtenstein", "Lituania",
                                                    "Luxemburgo", "Madagascar", "Malaui", "Malasia", "Maldivas", "Malí", "Malta", "Islas Marshall", "Mauritania",
                                                    "Mauricio", "México", "Micronesia", "Moldavia", "Mónaco", "Mongolia", "Montenegro", "Marruecos", "Mozambique",
                                                    "Myanmar (ant. Birmania)", "Namibia", "Nauru", "Nepal", "Países Bajos", "Nueva Zelanda", "Nicaragua", "Níger",
                                                    "Nigeria", "Corea del Norte", "Macedonia del Norte", "Noruega", "Omán", "Pakistán", "Palaos", "Estado de Palestina", "Panamá",
                                                    "Papúa Nueva Guinea", "Paraguay", "Peru", "Filipinas", "Polonia", "Portugal", "Catar", "Rumania", "Rusia",
                                                    "Ruanda", "San Cristóbal y Nieves", "Santa Lucía", "San Vicente y las Granadinas", "Samoa", "San Marino",
                                                    "Santo Tomé y Príncipe", "Arabia Saudita", "Senegal", "Serbia", "Seychelles", "Sierra Leona", "Singapur",
                                                    "Eslovaquia", "Eslovenia", "Islas Salomón", "Somalia", "Sudáfrica", "Corea del Sur", "Sudán del Sur", "España",
                                                    "Sri Lanka", "Sudán", "Surinam", "Suecia", "Suiza", "Siria", "Tayikistán", "Tanzania", "Tailandia",
                                                    "Timor-Leste", "Togo", "Tonga", "Trinidad y Tobago", "Túnez", "Turquía", "Turkmenistán", "Tuvalu", "Uganda",
                                                    "Ucrania", "Emiratos Árabes Unidos", "Reino Unido", "Estados Unidos", "Uruguay", "Uzbekistán", "Vanuatu",
                                                    "Venezuela", "Vietnam", "Yemen", "Zambia", "Zimbabue"
                                                ];
                                            @endphp
                                            @foreach ($countries as $country)
                                                <option value="{{ $country }}" {{ $site_settings->country == $country ? 'selected' : '' }}>
                                                    {{ $country }}
                                                </option>
                                            @endforeach
                                        </select>
                                        
                                    </td>
                                </tr>
            
                                <!-- Detalles de Moneda -->
                                <tr>
                                    <td><strong>Símbolo de Moneda</strong></td>
                                    <td>
                                        <input value="{!! $site_settings->currency_symbol ?? '' !!}" required type="text" id="decoded_symbol" class="form-control" placeholder="Símbolo de Moneda" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Código de Moneda</strong></td>
                                    <td>
                                        <input value="{{ $site_settings->currency_code ?? '' }}" required type="text" id="currency_code" name="currency_code" class="form-control" placeholder="Código de Moneda" readonly>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
            
   
        </div>
      </div>

    

      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Configuración de Pedidos</span>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.order-settings.update') }}" method="POST">
                @csrf
    
                <div class="form-group">
                    <label for="price_per_mile">Precio por Milla ({!! $site_settings->currency_symbol !!})</label>
                    <input type="number" name="price_per_mile" id="price_per_mile" class="form-control" value="{{ $order_settings->price_per_mile ?? '' }}" step="0.01" required>
                </div>
    
                <div class="form-group">
                    <label for="distance_limit_in_miles">Límite de Distancia en Millas</label>
                    <input type="number" name="distance_limit_in_miles" id="distance_limit_in_miles" class="form-control" value="{{ $order_settings->distance_limit_in_miles ?? '' }}" required>
                </div>
    
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>






<div class="modal fade" id="socialMediaModal" tabindex="-1" aria-labelledby="socialMediaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="socialMediaForm" method="POST">
                @csrf
                <input type="hidden" id="socialMediaFormMethod" name="_method" value="">
                <div class="modal-header">
                    <h5 class="modal-title" id="socialMediaModalLabel">Red Social</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="handle" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="handle" name="handle" required>
                    </div>
                    <div class="mb-3">
                        <label for="social_media" class="form-label">Red Social</label>
                        <select class="form-control" id="social_media" name="social_media" required>
                            <option value="facebook">Facebook</option>
                            <option value="instagram">Instagram</option>
                            <option value="youtube">YouTube</option>
                            <option value="tiktok">TikTok</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>






    <div class="modal fade" id="phoneNumberModal" tabindex="-1" aria-labelledby="phoneNumberModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="phoneNumberForm" method="POST">
                    @csrf
                    <input type="hidden" id="phoneNumberFormMethod" name="_method" value="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="phoneNumberModalLabel">Número de Teléfono</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Número de Teléfono</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Ejemplo: +34 123 456 789" required>
                        </div>

 
                        
                        <div class="form-check form-check-flat form-check-primary">

                            <label class="form-check-label" for="use_whatsapp">
                            <input type="checkbox" class="form-check-input"  id="use_whatsapp" name="use_whatsapp" value="1">  Usar WhatsApp <i class="input-helper"></i>
                            </label>
                        
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    






    <div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addressForm" method="POST">
                    @csrf
                    <input type="hidden" id="addressFormMethod" name="_method" value="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addressModalLabel">Dirección</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="address" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    


    <div class="modal fade" id="workingHourModal" tabindex="-1" aria-labelledby="workingHourModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="workingHourForm" method="POST">
                    @csrf
                    <input type="hidden" id="workingHourId" name="_method" value="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="workingHourModalLabel">Horario de Trabajo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="working_hours" class="form-label">Horario de Trabajo</label>
                            <input type="text" class="form-control" id="working_hours" name="working_hours" placeholder="ej. Lunes a Sábado - 9 AM a 10 PM" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

 
    






    <div class="modal fade" id="deletePhoneNumberModal" tabindex="-1" aria-labelledby="deletePhoneNumberModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deletePhoneNumberForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deletePhoneNumberModalLabel">Eliminar Número de Teléfono</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times"></i></button>
                    </div>
                    <div class="modal-body">
                        ¿Está seguro de que desea eliminar este número de teléfono?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    


    <div class="modal fade" id="deleteAddressModal" tabindex="-1" aria-labelledby="deleteAddressModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deleteAddressForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteAddressModalLabel">Eliminar Dirección</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times"></i></button>
                    </div>
                    <div class="modal-body">
                        ¿Está seguro de que desea eliminar esta dirección?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
   






    <div class="modal fade" id="deleteWorkingHourModal" tabindex="-1" aria-labelledby="deleteWorkingHourModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deleteWorkingHourForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteWorkingHourModalLabel">Eliminar Horario de Trabajo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times"></i></button>
                    </div>
                    <div class="modal-body">
                        ¿Está seguro de que desea eliminar este horario de trabajo?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="deleteSocialMediaHandleModal" tabindex="-1" aria-labelledby="deleteAddressModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deleteSocialMediaHandleForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteAddressModalLabel">Eliminar red social</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times"></i></button>
                    </div>
                    <div class="modal-body">
                        ¿Está seguro de que desea eliminar esta red social?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    
    </div>
    <!-- content-wrapper ends -->
    @include('partials.admin.footer')
  </div>
  <!-- main-panel ends -->
@endsection
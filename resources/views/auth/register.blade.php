@extends('theme.base')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @if (isset($auth))
                        <h1>Editar usuario</h1>
                    @else
                        <h1>Registrar usuario</h1>
                    @endif
                </div>
                <div class="card-body">
                    @if (isset($auth))
                        <form action={{ route('auth.update', $auth->id) }} method="post">
                            @method('PUT')
                    @else
                        <form action={{ route('auth.store') }} method="post">
                    @endif
                    
                    @csrf
                        <div class="form-group mb-2">
                            <label for="name" class="form-label">Nombre completo</label>
                            <input class="form-control input" type="text" name="name" placeholder="Escriba el nombre completo" value="{{ old('name') ?? @$auth->name }}">
                            @error('name')
                                <p class="form-text text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="email" class="form-label">Correo institucional</label>
                            <input class="form-control" type="email" name="email" placeholder="Escriba el email del usuario" value="{{ old('email') ?? @$auth->email }}">
                            @error('email')
                                <p class="form-text text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="id_perfil" class="form-label">Perfil</label>
                            <select name="id_perfil" class="form-control" required>
                                <option value="">Seleccione el Perfil</option>
                                @foreach($perfil as $id => $nombre_perfil)
                                    @if(isset($auth))
                                        <option value="{{ $id }}" {{ ($id == old("id_perfil", $auth->id_perfil))? "selected":"" }}>{{ $nombre_perfil }}</option>
                                    @else
                                        <option value="{{ $id }}" >{{ $nombre_perfil }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('id_perfil')
                                <p class="form-text text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        @if(isset($auth))
                            <input hidden id="valor" value="{{ old('id') ?? @$auth->id }}">
                            <div class="input-group d-inline m-2">
                                <label for="mostrar">Cambiar contraseña de usuario: (Si ó No)</label>
                                <input type="checkbox" id="mostrar" name="mostrar" class="form-checkbox">
                                <br/>
                            </div>
                        @endif
                        <hr/>
                        <div class="form-group" id="lbl_password">
                            <label for="password" class="form-label">Contraseña</label>
                        </div>
                        <div class="form-group input-group mb-2" id="div_password">
                            <input class="form-control" type="password" id="password" name="password" placeholder="Escriba la contraseña del usuario" >
                            <i class="bi bi-eye-slash" style="font-size: 30px;"
                                id="togglePassword">
                            </i>
                        </div>
                        <div class="form-group">
                            @error('password')
                                <p class="form-text text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group mb-2" id="div_confirm">
                            <label for="confirm" class="form-label">Confirmar contraseña</label>
                            <input class="form-control" type="password" id="confirm" name="confirm" placeholder="Escriba la contraseña del usuario" >
                            @error('confirm')
                                <p class="form-text text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        @if (isset($auth))
                        <div class="input-group d-inline m-2">
                            <input hidden id="valor2" value="{{ old('estado') ?? @$auth->estado }}">
                            <label for="check">Marcar Estado de Usuario como: (Activo ó Inactivo)</label>
                            <input type="checkbox" id="check" name="check" class="form-checkbox">
                            <input type="hidden" class="form-control" id="estado" name="estado">
                            <br/>
                        </div>
                        @else
                        <input type="hidden" class="form-control" id="estado" name="estado">
                        @endif
                        <br/>
                        @if (isset($auth))
                            <button type="submit" class="btn btn-success" onclick="return confirm('¿Deseá modificar el usuario?')">Editar</button>
                        @else
                            <button type="submit" class="btn btn-success" onclick="return confirm('¿Deseá registrar el usuario?')">Guardar</button>
                        @endif
                        <a href={{ route('auth.index') }} type="button" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script src="{{asset('js/jquery.min.js')}}"></script>

<script type="text/javascript">
    const togglePassword = document
        .querySelector('#togglePassword');

    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', () => {

        // Toggle the type attribute using
        // getAttribure() method
        const type = password
            .getAttribute('type') === 'password' ?
            'text' : 'password';
              
        password.setAttribute('type', type);

        // Toggle the eye and bi-eye icon
        this.classList.toggle('bi-eye');
    });

    $('#estado').val('activo');

    $(document).ready(function()
    {
        var valor = $('#valor').val();

        if(valor != undefined){
            $('#div_password').attr({'hidden': true});
            $('#div_confirm').attr({'hidden': true});
            $('#lbl_password').attr({'hidden': true});
        }else{
            $('#div_password').attr({'hidden': false});
            $('#div_confirm').attr({'hidden': false});
            $('#lbl_password').attr({'hidden': false});
        }

        $('#mostrar').on('change', function(){
            if( $('#mostrar').is(':checked') ) {
                $('#div_password').attr({'hidden': false});
                $('#div_confirm').attr({'hidden': false});
                $('#lbl_password').attr({'hidden': false});
            }else{
                $('#div_password').attr({'hidden': true});
                $('#div_confirm').attr({'hidden': true});
                $('#lbl_password').attr({'hidden': true});
            }
        });

        var valor2 = $('#valor2').val();

        if(valor2 == "activo"){
            $('#check').prop('checked', true);
        }else if(valor2 == "inactivo"){
            $('#check').prop('checked', false);
        }else{
            $('#check').prop('checked', false);
        }

        $('#check').on('change', function(){
            if( $('#check').is(':checked') ) {
                $('#estado').val('activo');
            }else{
                $('#estado').val('inactivo');
            }
        });

    });
</script>

<style>
    form i {
        margin-left: -30px;
        cursor: pointer;
    }
</style>
@endsection

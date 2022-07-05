


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Kodinger">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/login.css')}}">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>


<body class="my-login-page">
    <section class="h-100 ">
        <div class="container h-100">
            <div class="row justify-content-md-center h-100 ">
                <div class="card-wrapper">
                    <div class="brand">
                        <img src="{{$empresa->emp_logo}}" alt="logo">
                    </div>
                    <div class="card fat">
                        <div class="card-body">
                            <h4 class="card-title text-center">Recuperar Contraseña</h4>
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}"
                                        placeholder="Ingrese su email">
                                </div>
                                <div class="form-group">
                                    <label for="password"><b>Nueva Contraseña: </b></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password"
                                        placeholder="Ingrese su Contraseña">
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation"><b>Confirmar contraseña: </b></label>
                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                        name="password_confirmation" id="password_confirmation" placeholder="Confirme su Contraseña">
                                </div>
                                
                                <div class="form-group m-0 mb-4">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Actualizar Contraseña
                                    </button>
                                </div>
                               
                                @if (session('status'))
                                <div class="alert alert-success mt-1" role="alert">
                                    {{ session('status') }}
                                </div>
                                @endif
                               
                            </form>
                          
                         
                        </div>
                    </div>
                    <div class="footer text-dark ">
                        Todos los derechos reservados &copy; 2021 &mdash; {{$empresa->emp_razon_social}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="js/my-login.js"></script>

    @if($errors->any())

    <script>
        var message = @json($errors->first());
    console.log(message);

    const Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        customClass: 'swal-wide',
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: 'error',
        title: message
    })

    </script>

    @endif

</body>

</html>

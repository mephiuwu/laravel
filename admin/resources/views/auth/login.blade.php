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
                            <h4 class="card-title text-center">Login</h4>
                            <form method="POST" class="my-login-validation" action="{{route('login')}}">
                                @csrf
                                @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                                @endif
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Ingrese su email" name="email" value="" required autofocus>

                                  {{--   <div class="invalid-feedback">
                                        Email is invalid
                                    </div> --}}
                                </div>

                                <div class="form-group">
                                    <label for="password">Contraseña

                                    </label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Ingrese su contraseña" name="password" required data-eye>
                                   {{--  <div class="invalid-feedback">
                                        Password is required
                                    </div> --}}
                                </div>

                                {{-- 	<div class="form-group">
									<div class="custom-checkbox custom-control">
										<input type="checkbox" name="remember" id="remember" class="custom-control-input">
										<label for="remember" class="custom-control-label">Remember Me</label>
									</div>
								</div> --}}
                                @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="float-left py-2">
                                    Olvidaste tu contraseña?
                                </a>
                                @endif
                                <div class="form-group m-0">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Entrar
                                    </button>
                                </div>
                                {{-- <div class="mt-4 text-center">
									Don't have an account? <a href="register.html">Create One</a>
								</div> --}}
                            </form>
                        </div>
                    </div>
                    <div class="footer">
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


{{-- <div class="container" id="container">
    <a href="{{route('home')}}" class="imagenAeurus mt-4"> <img src="{{ asset('public/img/aeurus.png') }}"
    style="height: 100%" width="100%" alt="logo"></a>
<form method="POST" action="{{ route('login') }}">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    @if (session('status_error'))
    <div class="alert alert-danger" role="alert">
        {{ session('status_error') }}
    </div>
    @endif
    @csrf
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror"
            name="email" placeholder="Ingrese su email">
    </div>

    <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
            placeholder="Ingrese su Contraseña">
    </div>

    <button type="submit" class="btn btn-secondary">Entrar</button>
    <br>
    @if (Route::has('password.request'))
    <div>
        <a href="{{ route('password.request') }}" class="float-right mt-3" style="color: #ffffff;">¿Olvidaste tu
            contraseña?</a>
    </div>
    @endif

</form>
</div>
--}}
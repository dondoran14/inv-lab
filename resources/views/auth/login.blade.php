@extends('theme.base_auth')

<section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img src="img/img_auth.png"
            class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          <form action={{ route('auth.authenticate') }} method="post">
            @csrf
            <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-center">
              <p class="lead fw-normal mb-0 me-3">Iniciar Sesión</p>
            </div>
  
            <div class="divider d-flex align-items-center my-4">
              <p class="text-center fw-bold mx-3 mb-0"></p>
            </div>
  
            <!-- Email input -->
            <div class="form-floating mb-4">
              <input type="email" id="email" name="email" class="form-control form-control-lg"
                placeholder="Enter a valid email address" required/>
              <label class="form-label" for="email">Correo Institucional</label>
            </div>
  
            <!-- Password input -->
            <div class="input-group form-floating mb-3">
                <input type="password" id="password" name="password" class="form-control form-control-lg"
                  placeholder="Enter password" required/>
                <label class="form-label" for="password">Contraseña</label>
                <i class="bi bi-eye-slash" style="font-size: 57px;"
                    id="togglePassword"></i>
            </div>

            <div class="text-center text-lg-start mt-4 pt-2">
              <button type="submit" class="btn btn-primary btn-lg"
                style="padding-left: 2.5rem; padding-right: 2.5rem;">Ingresar</button>
            </div>
  
          </form>
        </div>
      </div>
    </div>
    <div
      class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
      <!-- Copyright -->
      <div class="text-white mb-3 mb-md-0">
        Copyright © 2022. Derechos Reservados Versión 1.0.
      </div>
    </div>
  </section>

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
  </script>

  <style>
    .divider:after,
    .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
    }
    .h-custom {
        height: calc(100% - 73px);
    }
    @media (max-width: 450px) {
        .h-custom {
            height: 100%;
        }
    }

    form i {
        margin-left: -30px;
        cursor: pointer;
    }
  </style>
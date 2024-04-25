<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="author" content="Muhamad Nauval Azhar">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Login - Agendamento Oficina</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
  <?php if (isset($_COOKIE["email"])) {
    $email = $_COOKIE["email"];
   }  if (isset($_COOKIE["password"])) {
    $email = $_COOKIE["password"];
   } 
   ?>
  <section class="h-100">
    <div class="container h-100">
      <div class="row justify-content-sm-center h-100">
        <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
          <div class="text-center m-2">
            <img src="img/logo-agenda-oficina.png" alt="logo" width="200">
          </div>
          <div class="card shadow">
            <div class="card-body p-4">
              <form action="scripts/login_.php" method="post" class="needs-validation" novalidate="" autocomplete="off">
                <div class="col" style="width: auto;">
                  <?php
                  if (isset($_GET['retorno'])) {
                    include './includes/erro.php';
                  }
                  ?>
                </div>
                <div class="mb-3">
                  <div class="form-floating">
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="<?php if (isset($_COOKIE["email"])) {
                                                                                                                              echo $_COOKIE["email"];
                                                                                                                            } ?>" required>
                    <label for="floatingInput">Email address</label>
                    <div class="invalid-feedback">
                      Email inválido
                    </div>
                  </div>
                </div>

                <div class="mb-3">
                  <div class="form-floating">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?php if (isset($_COOKIE["password"])) {
                                                                                                                              echo $_COOKIE["password"];
                                                                                                                            } ?>" required>
                    <label for="floatingPassword">Password</label>
                    <div class="invalid-feedback">
                      Preencha a senha
                    </div>
                  </div>
                  <div class="mb-2 w-100">
                    <a href="#" class="float-end" style="text-decoration: none;">
                      Esqueci a senha
                    </a>
                  </div>
                </div>

                <div class="d-flex align-items-center">
                  <div class="form-check">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input" <?php if (isset($_COOKIE["email"])) { ?> checked <?php } ?>>
                    <label for="remember" class="form-check-label">Lembrar</label>
                  </div>
                </div>
                <div class="d-flex align-items-center">
                  <button type="submit" class="btn btn-primary ms-auto">
                    Entrar
                  </button>
                </div>
              </form>
            </div>
            <div class="card-footer py-3 border-0">
              <div class="text-center">
                Não tem um cadastro? <a href="#" class="text-dark">Criar</a>
              </div>
            </div>
          </div>
          <div class="text-center mt-5 text-muted">
            Copyright &copy; 2024 &mdash; Projeto desenvolvido por: <br> Catharina Britto, Dayane Silvestre, Heric Silvestre, Marcos Felipe A. D. Silva, Tammy Regina
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="js/login.js"></script>
</body>

</html>
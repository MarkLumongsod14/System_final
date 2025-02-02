<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .btn-large {
            padding: 15px 30px;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>

<!-- New Bootstrap Section -->
<section class="h-100 gradient-form" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
      <div class="card rounded-3 text-black" style="height: 20%; width: 90%;"> <!-- You can set a specific width here -->
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-10 mx-md-4">

                <div class="text-center">
                  <!-- Ensure the logo image path is correct -->
                  <img src="img/logo.png" style="width: 185px;" alt="Company Logo">
                  <h4 class="mt-1 mb-5 pb-1">Welcome!</h4>
                </div>

                <form action="../actions/user-actions.php" method="post">
                  <p>Login to your account</p>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" name="username" id="form2Example11" class="form-control" placeholder="" required />
                    <label class="form-label" for="form2Example11">Username</label>
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" name="password" id="form2Example22" class="form-control" required />
                    <label class="form-label" for="form2Example22">Password</label>
                  </div>

                  <div class="text-center pt-1 mb-5 pb-1">
                    <button type="submit" class="btn btn-primary btn-block btn-lg btn-large fa-lg gradient-custom-2 mb-3" name="login">Log in</button>
                    <a class="text-muted" href="#!"></a>
                  </div>

                  <div class="d-flex align-items-center justify-content-center pb-4">
                    <p class="mb-0 me-2">Don't have an account?</p>
                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#registration">Create new</button>
                  </div>

                </form>

              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              <div class="text-black px-3 py-4 p-md-5 mx-md-4">
                <h4 class="mb-4">We are more than just an I.T. Students</h4>
                <p class="small mb-0">This development team was originally formed to work on a school project, but we discovered a passion for creating innovative systems along the way.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- REGISTRATION MODAL -->
<div class="modal fade" id="registration" tabindex="-1" aria-labelledby="registration" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header border-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-5">
        <h1 class="display-4 fw-bold text-danger text-center"><i class="fa-solid fa-user-plus"></i> Registration</h1>

        <form action="../actions/user-actions.php" method="post" class="w-75 mx-auto pt-4 p-5">
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="first-name" class="form-label small text-secondary">First Name</label>
              <input type="text" name="first_name" id="first-name" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label for="last-name" class="form-label small text-secondary">Last Name</label>
              <input type="text" name="last_name" id="last-name" class="form-control" required>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md">
              <label for="username" class="form-label small text-secondary">Username</label>
              <input type="text" name="username" id="username" class="form-control" required>
            </div>
          </div>

          <div class="row mb-4">
            <div class="col-md">
              <label for="password" class="form-label small text-secondary">Password</label>
              <input type="password" name="password" id="password" class="form-control" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md">
              <button type="submit" class="btn btn-danger w-100" name="register">Register</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>

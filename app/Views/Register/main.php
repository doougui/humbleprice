<div class="container pt-5">
    <div class="card">
        <div class="card-header">
            <h4>Crie uma conta</h4>
        </div>

        <div class="card-body">
            <div class="alert alert-danger d-none" data-error="register" role="alert">
                <p class="error-msg"></p>
            </div>

            <form method="POST" data-form="register" action="<?= DIRPAGE ?>register/signup">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-themed">Registrar conta</button>
                <a href="<?= DIRPAGE ?>login">Já está cadastrado? Entre!</a>
            </form>
        </div>
    </div>
</div>
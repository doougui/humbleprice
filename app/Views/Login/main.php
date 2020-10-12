<div class="container pt-5">
    <div class="card">
        <div class="card-header">
            <h4>Entre na sua conta</h4>
        </div>
        <div class="card-body">
            <div id="error" class="alert alert-danger d-none" role="alert">
                <p id="error-msg"></p>
            </div>
            <form method="POST" id="login">
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-danger">Fazer login</button>
                <a href="<?= DIRPAGE ?>register">Registrar sua conta!</a>
            </form>
        </div>
    </div>
</div>
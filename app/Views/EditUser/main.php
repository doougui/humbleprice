<div class="container pt-5">
    <div class="card">
        <div class="card-header">
            <h4>Editar Perfil</h4>
        </div>

        <div class="card-body">
            <form method="POST" data-form="user-form" enctype="multipart/form-data" action="<?= DIRPAGE ?>user/update">
                <div class="alert alert-danger d-none" data-error="user-form" role="alert">
                    <p class="error-msg"></p>
                </div>

                <div class="form-group">
                    <label for="name">Nome de usuário</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?= $user['name'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control" value="<?= $user['email'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password-confirmation">Repetir senha</label>
                    <input type="password" name="password-confirmation" id="password-confirmation" class="form-control">
                </div>

                <div class="form-group">
                    <label for="avatar">Imagem de perfil</label>
                    <input type="file" name="avatar" id="avatar" class="form-control-file">
                </div>

                <button type="submit" class="btn btn-themed">Editar perfil</button>
            </form>
        </div>
    </div>
</div>
<section id="filters">
    <div class="container">
        <h1 class="h4">Painel de usuários</h1>
    </div>
</section>

<div class="container">
    <section id="offers" class="table-responsive">
        <table class="table table-hover table-dark">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $manageableUser): ?>
                    <tr data-item="<?= $manageableUser["email"] ?>">
                        <td><?= $manageableUser["name"] ?></td>
                        <td><?= $manageableUser["email"] ?></td>
                        <td class="form-group">
                            <select name="role" id="role" class="form-control">
                                <?php foreach ($roles as $role): ?>
                                    <option
                                        value="<?= $role['label'] ?>"
                                        <?=
                                            ($role['label'] === $manageableUser['role_label'])
                                                ? 'selected'
                                                : '';
                                        ?>
                                    >
                                        <?= $role['name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <div class="alert alert-danger error tr-error d-none" role="alert">
                                <p class="error-msg"></p>
                            </div>
                            <button
                                type="button"
                                class="btn btn-outline-<?= ($manageableUser["suspended"])
                                    ? 'success'
                                    : "warning"
                                ?> suspend"

                                <?= ($manageableUser["email"] === $user["email"]
                                    || $manageableUser["id_role"] === $user["id_role"])
                                    ? 'disabled title="Você não pode suspender ou re-ativar uma conta com o mesmo nível hierárquico que você."'
                                    : ''
                                ?>
                            >
                                <?= ($manageableUser["suspended"]) ? 'Re-ativar' : "Suspender" ?>
                            </button>
                            <button class="btn btn-outline-danger delete">Deletar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</div>
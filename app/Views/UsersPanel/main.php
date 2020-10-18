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
                    <tr>
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
                            <button class="btn btn-outline-warning">Suspender</button>
                            <button class="btn btn-outline-danger">Deletar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</div>
<section id="filters">
    <div class="container">
        <h1 class="h4">Painel de usuários</h1>
    </div>
</section>

<div class="container">
    <section id="users">
        <div class="table-responsive">
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
                    <?php foreach ($users as $user): ?>
                        <tr data-item="<?= $user["email"] ?>">
                            <td><?= $user["name"] ?></td>
                            <td><?= $user["email"] ?></td>
                            <td class="form-group">
                                <div class="alert alert-danger tr-error d-none" data-error="roles" role="alert">
                                    <p class="error-msg"></p>
                                </div>

                                <select name="role" data-select="role" class="form-control">
                                    <?php foreach ($roles as $role): ?>
                                        <option
                                            value="<?= $role['label'] ?>"
                                            <?=
                                                ($role['label'] === $user['role_label'])
                                                    ? 'selected'
                                                    : '';
                                            ?>

                                            <?= ($role["id"] >= user()["id_role"]
                                                || $user["id_role"] >= user()["id_role"])
                                                ? 'disabled title="Você não pode atribuir um cargo maior ou mudar o cargo de alguém com o nível hierárquico maior ou igual ao seu."'
                                                : ''
                                            ?>
                                        >
                                            <?= $role['name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                <div class="alert alert-danger tr-error d-none" data-error="actions" role="alert">
                                    <p class="error-msg"></p>
                                </div>

                                <button
                                    type="button"
                                    class="btn btn-outline-<?= ($user["suspended"])
                                        ? 'info'
                                        : "warning"
                                    ?>"
                                    data-btn="suspend"

                                    <?= ($user["email"] === user()["email"]
                                        || $user["id_role"] >= user()["id_role"])
                                        ? 'disabled title="Você não pode suspender ou re-ativar uma conta com o nível hierárquico maior ou igual ao seu."'
                                        : ''
                                    ?>
                                >
                                    <?= ($user["suspended"]) ? 'Re-ativar' : "Suspender" ?>
                                </button>
                                <button
                                        type="button"
                                        class="btn btn-outline-danger"
                                        data-btn="delete-user"

                                    <?= ($user["email"] === user()["email"]
                                        || $user["id_role"] >= user()["id_role"])
                                        ? 'disabled title="Você não pode deletar uma conta com o nível hierárquico maior ou igual ao seu."'
                                        : ''
                                    ?>
                                >
                                    Deletar
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <?php if (empty($users)): ?>
                        <p class="text-muted text-center">Listagem de usuários vazia.</p>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <nav class="d-flex justify-content-center mt-3" aria-label="navigation">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="<?= DIRPAGE ?>userspanel?page=<?= (intval($currentPage) === 1) ? $totalPages : $currentPage - 1 ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Anterior</span>
                    </a>
                </li>
                <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                    <li class="page-item <?= ($p === intval($currentPage)) ? 'active' : '' ?>"><a class="page-link" href="<?= DIRPAGE ?>userspanel?page=<?= $p ?>"><?= $p ?></a></li>
                <?php endfor; ?>
                <li class="page-item">
                    <a class="page-link" href="<?= DIRPAGE ?>userspanel?page=<?= (intval($currentPage) == $totalPages) ? '1' : $currentPage + 1 ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Próximo</span>
                    </a>
                </li>
            </ul>
        </nav>
    </section>
</div>
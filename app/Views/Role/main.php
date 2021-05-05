<section id="filters">
    <div class="container">
        <h1 class="h4">Painel de cargos</h1>
    </div>
</section>

<div class="container">
    <section id="roles">
        <div class="table-responsive">
            <table class="table table-hover table-dark">
                <thead>
                    <tr>
                        <th scope="col">Tag</th>
                        <th scope="col">Cargo</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($roles as $role): ?>
                        <tr data-item="<?= $role['label'] ?>">
                            <td><?= $role['label'] ?></td>
                            <td><?= $role['name'] ?></td>
                            <td>
                                <div class="alert alert-danger tr-error d-none" data-error="actions" role="alert">
                                    <p class="error-msg"></p>
                                </div>

                                <a href="<?= DIRPAGE ?>role/edit/<?= $role['label'] ?>"
                                    <?= ($role['id'] >= user()['id_role'])
                                        ? 'title="Você não pode editar as habilidades de um cargo com o nível hierárquico maior ou igual ao seu."'
                                        : ''
                                    ?>
                                   class="btn btn-info
                                    <?= ($role['id'] >= user()['id_role'])
                                        ? 'disabled'
                                        : ''
                                    ?>
                                "
                                >
                                    Editar permissões
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <?php if (empty($roles)): ?>
                        <p class="text-muted text-center">Listagem de cargos vazia.</p>
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
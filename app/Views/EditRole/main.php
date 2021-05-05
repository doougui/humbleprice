<section id="filters">
    <div class="container">
        <h1 class="h4">Permissões para o cargo <?= $role['name'] ?></h1>
    </div>
</section>

<div class="container">
    <section id="roles">
        <div class="table-responsive">
            <table class="table table-hover table-dark">
                <thead>
                    <tr>
                        <th scope="col">Tag</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allAbilities as $ability): ?>
                        <tr data-role="<?= $role['label'] ?>" data-ability="<?= $ability["label"] ?>">
                            <td><?= $ability["label"] ?></td>
                            <td><?= $ability["name"] ?></td>
                            <td>
                                <div class="alert alert-danger tr-error d-none" data-error="ability" role="alert">
                                    <p class="error-msg"></p>
                                </div>

                                <?php if (in_array($ability, $roleAbilities)): ?>
                                    <button class="btn btn-danger" data-btn="permission" <?= (! $hasAllPermissions && ! authorized($ability['label'])) ? 'disabled title="Você não pode remover uma permissão que você não possui."' : '' ?>>
                                        Remover permissão
                                    </button>
                                <?php else: ?>
                                    <button class="btn btn-info" data-btn="permission" <?= (! $hasAllPermissions && ! authorized($ability['label'])) ? 'disabled title="Você não pode adicionar uma permissão que você não possui."' : '' ?>>
                                        Adicionar permissão
                                    </button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <?php if (empty($allAbilities)): ?>
                        <p class="text-muted text-center">Listagem de habilidades vazia.</p>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>
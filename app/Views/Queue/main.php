<section id="filters">
    <div class="container">
        <h1 class="h4">Ofertas pendentes aguardando aprovação</h1>
    </div>
</section>

<div class="container">
    <section id="offers">
        <div class="card">
            <div class="card-header">
                <h4>Ofertas</h4>
            </div>

            <div class="card-body">
                <?php foreach ($pendingOffers as $offer): ?>
                    <div class="card card-item" data-item="<?= $offer['slug'] ?>">
                        <div class="card-body d-flex align-items-center flex-md-column flex-wrap">
                            <a href="<?= DIRPAGE ?>offer/view/<?= $offer['slug'] ?>">
                                <div class="offer-img" style="background: url('<?= DIRIMG ?>products/<?= $offer['image'] ?>') no-repeat center; background-size: cover;"></div>
                            </a>

                            <a href="<?= DIRPAGE ?>offer/view/<?= $offer['slug'] ?>" class="btn btn-link"><?= $offer['name'] ?></a>

                            <div class="d-flex justify-content-between w-100">
                                <p class="text-muted mb-0">R$<del><?= number_format($offer['old_price'], 2, ',', '.') ?></del></p>
                                <p class="text-themed font-weight-bold mb-0">R$<?= number_format($offer['new_price'], 2, ',', '.') ?></p>
                            </div>

                            <?php if (authorized("MANAGE_OFFERS")): ?>
                                <div class="offer-actions">
                                    <a class="d-block text-center card-link my-2" href="<?= DIRPAGE ?>offer/edit/<?= $offer['slug'] ?>">Editar oferta</a>
                                    <button class="delete text-center" data-btn="delete">Excluir oferta</button>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="alert alert-danger d-none" data-error="offer-card" role="alert">
                            <p class="error-msg"></p>
                        </div>

                        <div class="card-footer">
                            <a href="<?= $offer['link'] ?>" target="_blank" class="btn btn-themed mb-2">Avaliar oferta</a>

                            <div class="row justify-content-center">
                                <button class="btn btn-success m-1" data-btn="approve">Aprovar</button>
                                <button class="btn btn-danger m-1" data-btn="refuse">Recusar</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <?php if (empty($pendingOffers)): ?>
                    <p class="text-muted text-center">Não há ofertas pendentes.</p>
                <?php endif; ?>

                <nav class="d-flex justify-content-center mt-3" aria-label="navigation">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="<?= DIRPAGE ?>category/offers/<?= $category['slug'] ?>?page=<?= (intval($currentPage) === 1) ? $totalPages : $currentPage - 1 ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Anterior</span>
                            </a>
                        </li>
                        <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                            <li class="page-item <?= ($p === intval($currentPage)) ? 'active' : '' ?>"><a class="page-link" href="<?= DIRPAGE ?>category/offers/<?= $category['slug'] ?>?page=<?= $p ?>"><?= $p ?></a></li>
                        <?php endfor; ?>
                        <li class="page-item">
                            <a class="page-link" href="<?= DIRPAGE ?>category/offers/<?= $category['slug'] ?>?page=<?= (intval($currentPage) == $totalPages) ? '1' : $currentPage + 1 ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Próximo</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
</div>
<section id="filters">
    <div class="container">
        <h1 class="h4">Confira as últimas ofertas.</h1>
    </div>
</section>

<div class="container">
    <section id="offers">
        <div class="card">
            <div class="card-header">
                <h4>Ofertas</h4>
            </div>

            <div class="card-body">
                <?php foreach ($offers as $offer): ?>
                    <div class="card card-item" data-item="<?= $offer['slug'] ?>">
                        <div class="card-body d-flex align-items-center flex-md-column">
                            <a href="<?= DIRPAGE ?>offer/view/<?= $offer['slug'] ?>">
                                <div class="product-img">
                                    <img src="<?= DIRIMG ?>products/<?= $offer['image'] ?>" alt="Imagem do produto" class="img img-fluid">
                                </div>
                            </a>

                            <a href="<?= DIRPAGE ?>offer/view/<?= $offer['slug'] ?>" class="btn btn-link"><?= $offer['name'] ?></a>

                            <div class="card-prices d-flex justify-content-between w-100">
                                <p class="text-muted mb-0">R$<del><?= number_format($offer['old_price'], 2, ',', '.') ?></del></p>
                                <p class="text-themed font-weight-bold mb-0">R$<?= number_format($offer['new_price'], 2, ',', '.') ?></p>
                            </div>

                            <?php if (user() && authorized("MANAGE_OFFERS")): ?>
                                <a class="d-block text-center card-link my-2" href="<?= DIRPAGE ?>offer/edit/<?= $offer['slug'] ?>">Editar oferta</a>
                                <button class="delete text-center" data-btn="delete">Excluir oferta</button>
                            <?php endif; ?>
                        </div>

                        <div class="alert alert-danger d-none" data-error="offer-card" role="alert">
                            <p class="error-msg"></p>
                        </div>

                        <div class="card-footer">
                            <a href="<?= $offer['link'] ?>" target="_blank" class="btn btn-themed">Ir para oferta</a>
                        </div>
                    </div>
                <?php endforeach; ?>

                <?php if (empty($offers)): ?>
                    <p class="text-muted text-center">Não há ofertas disponíveis.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>
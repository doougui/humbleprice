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
                        <div class="card-body">
                            <div class="product-img">
                                <img src="<?= DIRIMG ?>products/<?= $offer['image'] ?>" alt="Imagem do produto" class="img img-fluid">
                            </div>

                            <a href="#" class="btn btn-link"><?= utf8_encode($offer['name']) ?></a>

                            <div class="card-prices">
                                <div class="old-price">R$<del><?= number_format($offer['old_price'], 2, ',', '.') ?></del></div>
                                <div class="new-price">R$<?= number_format($offer['new_price'], 2, ',', '.') ?></div>
                            </div>

                            <?php if (isset($_SESSION['hLogin']) && $_SESSION['user']['admin'] == 1): ?>
                                <a href="<?= DIRPAGE ?>ofertas/deletar/<?= $offer['id'] ?>" class="delete text-center">Excluir anúncio</a>
                            <?php endif; ?>
                        </div>

                        <div class="alert alert-danger d-none error" role="alert">
                            <p class="error-msg"></p>
                        </div>

                        <div class="card-footer">
                            <a href="<?= $offer['link'] ?>" target="_blank" class="btn btn-danger mb-2">Pegar promoção</a>

                            <div class="row justify-content-center">
                                <a href="<?= DIRPAGE ?>queue/approve/<?= $offer['slug'] ?>" class="btn btn-success m-1 approve">Aprovar</a>
                                <a href="<?= DIRPAGE ?>queue/refuse/<?= $offer['slug'] ?>" class="btn btn-danger m-1 refuse">Recusar</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</div>
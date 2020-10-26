<section id="filters">
    <div class="container">
        <h1 class="h4">Ofertas e promoções de <?= $category["name"] ?>.</h1>
        <a href="?" class="btn btn-light border">Tudo</a>
        <?php foreach ($subcategories as $subcategory): ?>
            <a href="?subcategory=<?= $subcategory['slug'] ?>" class="btn btn-light border"><?= $subcategory["name"] ?></a>
        <?php endforeach; ?>
    </div>
</section>

<div class="container pt-3">
    <section id="offers">
        <div class="card">
            <div class="card-header">
                <h4>Ofertas</h4>
            </div>

            <div class="card-body">
                <?php foreach ($offers as $offer): ?>
                    <div class="card card-item" data-item="<?= $offer['slug'] ?>">
                        <div class="card-body">
                            <div class="product-img">
                                <img src="<?= DIRIMG ?>products/<?= $offer['image'] ?>" alt="Imagem do produto" class="img img-fluid">
                            </div>

                            <a href="<?= DIRPAGE ?>offer/view/<?= $offer['slug'] ?>" class="btn btn-link"><?= $offer['name'] ?></a>

                            <div class="card-prices">
                                <div class="old-price">R$<del><?= number_format($offer['old_price'], 2, ',', '.') ?></del></div>
                                <div class="new-price">R$<?= number_format($offer['new_price'], 2, ',', '.') ?></div>
                            </div>

                            <?php if (authorized("MANAGE_OFFERS")): ?>
                                <a class="d-block text-center card-link my-2" href="<?= DIRPAGE ?>offer/edit/<?= $offer['slug'] ?>">Editar anúncio</a>
                                <button class="delete text-center">Excluir anúncio</button>
                            <?php endif; ?>
                        </div>

                        <div class="alert alert-danger d-none error" role="alert">
                            <p class="error-msg"></p>
                        </div>

                        <div class="card-footer">
                            <a href="<?= $offer['link'] ?>" target="_blank" class="btn btn-themed">Ir para oferta</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</div><?php

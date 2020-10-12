<section id="filters">
    <div class="container">
        <h1 class="h4">Ofertas e promoções de jogos.</h1>
        <a href="./" class="btn btn-light border">Tudo</a>
        <a href="./?filter=PC" class="btn btn-light border">PC</a>
        <a href="./?filter=PlayStation 3" class="btn btn-light border">PlayStation 3</a>
        <a href="./?filter=PlayStation 4" class="btn btn-light border">PlayStation 4</a>
        <a href="./?filter=Xbox One" class="btn btn-light border">Xbox One</a>
        <a href="./?filter=Xbox 360" class="btn btn-light border">Xbox 360</a>
        <a href="./?filter=Outros" class="btn btn-light border">Outros</a>
    </div>
</section>

<div class="container pt-5">
    <section id="offers">
        <div class="card">
            <div class="card-header">
                <h4>Ofertas</h4>
            </div>

            <div class="card-body">
                <?php foreach ($offers as $offer): ?>
                    <div class="card card-item">
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

                        <div class="card-footer">
                            <a href="<?= $offer['link'] ?>" target="_blank" class="btn btn-danger">Pegar promoção</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</div>
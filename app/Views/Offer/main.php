<div class="container my-5">
    <div class="row">
        <section id="offer" class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h4>Oferta</h4>
                </div>

                <div class="card-body">
                    <div class="row m-2">
                        <img src="<?= DIRIMG ?>products/<?= $offer['image'] ?>" alt="<?= $offer['name'] ?>" class="img img-thumbnail img-fluid w-25">

                        <div class="col-6 mx-2 d-flex flex-md-column justify-content-between">
                            <div>
                                <h1 class="offer-title font-weight-bold my-0"><?= $offer["name"] ?></h1>
                                <p class="mt-2 text-muted"><?= $offer["category"] ?>・<?= $offer["subcategory"] ?></p>
                            </div>

                            <div>
                                <p class="text-muted mb-0">R$<del><?= number_format($offer['old_price'], 2, ',', '.') ?></del></p>
                                <p class="h4 mb-0 text-themed font-weight-bold">R$<?= number_format($offer['new_price'], 2, ',', '.') ?></p>
                            </div>
                        </div>


                        <div class="d-flex flex-md-column justify-content-between">
                            <div>
                                <p>Oferta publicada por:</p>

                                <div class="offer-author row">
                                    <img class="img img-fluid rounded rounded-circle" src="<?= DIRIMG ?>default.jpg" alt="Usuário">

                                    <div class="d-flex flex-column ml-2">
                                        <small class="text-themed font-weight-bold offer-author-name" title="Author name"><?= $offer["author"] ?></small>
                                        <small>Em: <span class="font-weight-bold"><?= date("d/m/Y", strtotime($offer["published_at"])) ?></span></small>
                                    </div>
                                </div>
                            </div>

                            <a href="<?= $offer['link'] ?>" target="_blank" class="btn btn-themed">Ir para oferta</a>
                        </div>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-between">
                    <div>
                        <button class="btn badge btn-secondary px-3 py-2 mr-2">
                            <i class="fas fa-thumbs-up"></i>
                            Reportar
                        </button>

                        <button class="btn badge btn-secondary px-3 py-2 mr-2">
                            <i class="fas fa-thumbs-up"></i>
                            435
                        </button>

                        <button class="btn badge btn-secondary px-3 py-2 mr-2">
                            <i class="fas fa-comments"></i>
                            14
                        </button>
                    </div>

                    <div>
                        <div class="badge badge-light" data-toggle="tooltip" data-placement="top" title="Visualizações">
                            <i class="fas fa-eye"></i>
                            <?= $offer["views"] ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="recommended-offers" class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h4>Veja também</h4>
                </div>

                <div class="card-body">
                    <?php foreach($relatedOffers as $index => $relatedOffer): ?>
                        <div id="recommended-offer">
                            <div class="row">
                                <img src="<?= DIRIMG ?>products/<?= $relatedOffer['image'] ?>" alt="<?= $relatedOffer['name'] ?>" class="img img-fluid img-thumbnail w-25 ml-2">

                                <div class="col-md d-flex flex-column justify-content-between ml-1 text-wrap">
                                    <small>
                                        <a href="<?= DIRPAGE ?>offer/view/<?= $relatedOffer['slug'] ?>">
                                            <?= $relatedOffer["name"] ?>
                                        </a>
                                    </small>

                                    <div class="prices">
                                        <small class="text-muted mb-0">R$<del><?= number_format($relatedOffer['old_price'], 2, ',', '.') ?></del></small>
                                        <p class="mb-0 text-themed font-weight-bold">R$<?= number_format($relatedOffer['new_price'], 2, ',', '.') ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?= ($index !== array_key_last($relatedOffers)) ? "<hr>" : '' ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </div>
</div>
<div class="container my-5">
    <div class="row">
        <div class="col-md-9">
            <section id="offer" class="mb-4">
                <div class="card" data-item="<?= $offer['slug'] ?>" data-end="<?= $offer['end_offer'] ?>">
                    <div class="card-header">
                        <h4>Oferta</h4>
                    </div>

                    <div class="card-body">
                        <div class="alert alert-danger d-none error" role="alert">
                            <p class="error-msg"></p>
                        </div>

                        <div class="row m-2">
                            <img src="<?= DIRIMG ?>products/<?= $offer['image'] ?>" alt="<?= $offer['name'] ?>" class="img img-thumbnail img-fluid w-25 <?= ($isClosed) ? 'grayscaled-img' : '' ?>">

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
                                            <small class="text-themed font-weight-bold offer-author-name" title="<?= $offer['author'] ?>"><?= $offer["author"] ?></small>
                                            <small>Em: <span class="font-weight-bold"><?= date("d/m/Y", strtotime($offer["published_at"])) ?></span></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-100 d-flex flex-md-column">
                                    <a href="<?= $offer['link'] ?>" target="_blank" class="offer-link btn <?= ($isClosed) ? 'disabled btn-secondary' : 'btn-themed' ?> w-100 mb-1"><?= ($isClosed) ? "Oferta encerrada" : "Ir para oferta" ?></a>

                                    <?php if (authorized("MANAGE_OFFERS") && ! $isClosed && $offer["status"] === "approved"): ?>
                                        <button class="btn btn-danger w-100 close-offer">Fechar oferta</button>
                                    <?php endif; ?>

                                    <?php if (authorized("MANAGE_QUEUE") && ! $isClosed && $offer["status"] === "pending"): ?>
                                        <div class="w-100" id="queue-actions">
                                            <button class="btn w-100 mb-1 btn-success approve">Aprovar</button>
                                            <button class="btn w-100 mb-1 btn-danger refuse">Recusar</button>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <div>
                            <button class="btn badge btn-secondary px-3 py-2 mr-2">
                                <i class="fas fa-flag"></i>
                                Reportar
                            </button>

                            <button class="btn badge <?= ($liked) ? 'btn-success' : 'btn-secondary' ?> px-3 py-2 mr-2 like" <?= (! user()) ? 'disabled' : '' ?>>
                                <i class="fas fa-thumbs-up"></i>
                                <span><?= $likes ?></span>
                            </button>

                            <a href="#comment">
                                <button class="btn badge btn-secondary px-3 py-2 mr-2" <?= (! user()) ? 'disabled' : '' ?>>
                                    <i class="fas fa-comments"></i>
                                    14
                                </button>
                            </a>
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

            <section id="additional-info" class="mb-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Informações adicionais</h4>
                    </div>

                    <div class="card-body">
                        <?php if (! empty($offer["additional_info"]) || ! empty($offer["end_offer"])): ?>
                            <?php if (! empty($offer["additional_info"])): ?>
                                <p><?= htmlspecialchars_decode($offer["additional_info"]); ?></p>
                            <?php endif; ?>

                            <?php if (! empty($offer["end_offer"])): ?>
                                <small>Esta oferta <?= ($isClosed) ? "encerrou" : "encerra" ?> em: <span class="font-weight-bold text-themed"><?= date("d/m/Y", strtotime($offer["end_offer"])) ?></span>.</small>
                            <?php endif; ?>
                        <?php else: ?>
                            <p class="text-muted">Nenhuma informação adicional disponível.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

            <section id="comments" class="mb-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Comentários</h4>
                    </div>

                    <div class="card-body">
                        <?php if (user()): ?>
                            <form method="POST" id="comment" action="<?= DIRPAGE ?>comment/publish">
                                <div class="alert alert-danger d-none error" role="alert">
                                    <p class="error-msg"></p>
                                </div>

                                <div class="form-group">
                                    <textarea placeholder="O que achou desta oferta? Compartilhe aqui sua opinião" name="comment" id="editor"></textarea>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-themed">Publicar comentário</button>
                                </div>
                            </form>

                            <hr>
                        <?php endif; ?>

                        <div class="comments">
                            <?php foreach ($comments as $comment): ?>
                                <div class="comment d-flex mx-2 pt-3 align-items-start">
                                    <img class="img img-fluid rounded rounded-circle mr-3" src="<?= DIRIMG ?>default.jpg" alt="Usuário">

                                    <div class="w-100">
                                        <div class="comment-header">
                                            <p class="mb-0 font-weight-bold comment-author-name"><?= $comment["author"] ?></p>
                                            <small class="text-muted">Postado em: <?= date("d/m/Y H:i", strtotime($comment["created_at"])) ?></small>
                                        </div>

                                        <div class="comment-content">
                                            <p><?= $comment["comment"] ?></p>
                                        </div>

                                        <div class="comment-actions d-flex justify-content-end">
                                            <button class="btn btn-link btn-sm py-2 mr-1" <?= (! user()) ? 'disabled' : '' ?>>
                                                <i class="fas fa-thumbs-up"></i>
                                                <span>14</span>
                                            </button>

                                            <button class="btn btn-link btn-sm py-2 mr-1" <?= (! user()) ? 'disabled' : '' ?>>
                                                <i class="fas fa-comments"></i>
                                                Responder
                                            </button>

                                            <button class="btn btn-link btn-sm py-2 mr-1" data-toggle="tooltip" data-placement="top" title="Denunciar">
                                                <i class="fas fa-flag"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <?php foreach ($comment["children"] as $child): ?>
                                    <div class="comment d-flex mr-2 pt-3 align-items-start child-comment">
                                        <img class="img img-fluid rounded rounded-circle mr-3" src="<?= DIRIMG ?>default.jpg" alt="Usuário">

                                        <div class="w-100">
                                            <div class="comment-header">
                                                <p class="mb-0 font-weight-bold comment-author-name"><?= $child["author"] ?></p>
                                                <small class="text-muted">Postado em: <?= date("d/m/Y H:i", strtotime($child["created_at"])) ?></small>
                                            </div>

                                            <div class="comment-content">
                                                <p><?= $child["comment"] ?></p>
                                            </div>

                                            <div class="comment-actions d-flex justify-content-end">
                                                <button class="btn btn-link btn-sm py-2 mr-1" <?= (! user()) ? 'disabled' : '' ?>>
                                                    <i class="fas fa-thumbs-up"></i>
                                                    <span>14</span>
                                                </button>

                                                <button class="btn btn-link btn-sm py-2 mr-1" <?= (! user()) ? 'disabled' : '' ?>>
                                                    <i class="fas fa-comments"></i>
                                                    Responder
                                                </button>

                                                <button class="btn btn-link btn-sm py-2 mr-1" data-toggle="tooltip" data-placement="top" title="Denunciar">
                                                    <i class="fas fa-flag"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endforeach; ?>

                            <?php if (empty($comments)): ?>
                                <p class="text-muted text-center">Ainda não há comentários disponíveis. Que tal fazer um?</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <section id="recommended-offers" class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h4>Veja também</h4>
                </div>

                <div class="card-body">
                    <?php foreach($relatedOffers as $index => $relatedOffer): ?>
                        <div id="recommended-offer">
                            <div class="row">
                                <a class="w-25 ml-2" href="<?= DIRPAGE ?>offer/view/<?= $relatedOffer['slug'] ?>">
                                    <img src="<?= DIRIMG ?>products/<?= $relatedOffer['image'] ?>" alt="<?= $relatedOffer['name'] ?>" class="img img-fluid img-thumbnail">
                                </a>

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

                    <?php if (empty($relatedOffers)): ?>
                        <p class="text-muted text-center">Não há ofertas relacionadas.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </div>
</div>
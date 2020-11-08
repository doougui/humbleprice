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
                <ul class="list-group">
                    <?php foreach ($pendingReports as $report): ?>
                        <li class="list-group-item" data-item="<?= $report['offer_slug'] ?>" data-report="<?= $report['id'] ?>" data-reason="<?= $report['reason_slug'] ?>">
                            <div class="alert alert-danger d-none" data-error="report" role="alert">
                                <p class="error-msg"></p>
                            </div>

                            <div class="row align-items-center flex-nowrap">
                                <a href="<?= DIRPAGE ?>offer/view/<?= $report['offer_slug'] ?>" class="report-img">
                                    <img src="<?= DIRIMG ?>products/<?= $report['image'] ?>" alt="<?= $report['offer_name'] ?>" class="img img-fluid img-thumbnail">
                                </a>

                                <div class="flex-grow-1 report-info">
                                    <a href="<?= DIRPAGE ?>offer/view/<?= $report['offer_slug'] ?>" class="card-link ml-2 my-0" title="<?= $report['offer_name'] ?>">
                                        <?= $report['offer_name'] ?>
                                    </a>
                                    <p class="ml-2 my-0">Reportado por: <span class="text-themed m-0 font-weight-bold" title="<?= $report['author'] ?>"><?= $report['author'] ?></span></p>
                                    <p class="ml-2 my-0">Em: <span class="font-weight-bold"><?= date("d/m/Y H:i:s", strtotime($report['reported_at'])) ?></span></p>
                                </div>

                                <div class="flex-grow-1 report-reason">
                                    <p class="ml-2 my-1">Motivo: <span class="font-weight-bold" title="<?= $report['reason'] ?>"><?= $report['reason'] ?></span></p>
                                </div>

                                <div class="flex-grow-1 d-flex justify-content-end report-actions">
                                    <button class="btn btn-danger" data-btn="accept-report">Encerrar oferta</button>
                                    <button class="btn btn-info ml-2" data-btn="refuse-report" title="Recusar report">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <?php if (empty($pendingReports)): ?>
                    <p class="text-muted text-center">Não há reports pendentes.</p>
                <?php endif; ?>

                <nav class="d-flex justify-content-center mt-3" aria-label="navigation">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="<?= DIRPAGE ?>report?page=<?= (intval($currentPage) === 1) ? $totalPages : $currentPage - 1 ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Anterior</span>
                            </a>
                        </li>
                        <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                            <li class="page-item <?= ($p === intval($currentPage)) ? 'active' : '' ?>"><a class="page-link" href="<?= DIRPAGE ?>report?page=<?= $p ?>"><?= $p ?></a></li>
                        <?php endfor; ?>
                        <li class="page-item">
                            <a class="page-link" href="<?= DIRPAGE ?>report?page=<?= (intval($currentPage) == $totalPages) ? '1' : $currentPage + 1 ?>" aria-label="Next">
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
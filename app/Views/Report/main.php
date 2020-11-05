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
                    <li class="list-group-item">
                        <div class="alert alert-danger d-none" data-error="report" role="alert">
                            <p class="error-msg"></p>
                        </div>

                        <div class="row align-items-center flex-nowrap">
                            <a href="<?= DIRPAGE ?>offer/view/dummy" class="report-img">
                                <img src="<?= DIRIMG ?>products/4805a0b5bc10794363ba327d034141e1.jpg" alt="" class="img img-fluid img-thumbnail" >
                            </a>

                            <div class="flex-grow-1">
                                <a href="<?= DIRPAGE ?>offer/view/dummy" class="card-link ml-2 my-0">
                                    Red Dead Redemption 2
                                </a>
                                <p class="ml-2 my-0">Reportado por: <span class="text-themed font-weight-bold offer-author-name" title="">Douglas Pinheiro Goulart</span></p>
                                <p class="ml-2 my-0">Em: <span class="font-weight-bold">04/11/2020</span></p>
                            </div>

                            <div class="flex-grow-1">
                                <p class="ml-2 my-1">Motivo: <span class="font-weight-bold" title="">O valor do produto é diferente do anunciado</span></p>
                            </div>

                            <div class="d-flex align-items-end report-close-offer">
                                <button class="btn btn-danger" data-btn="close-offer">Encerrar oferta</button>
                            </div>
                        </div>
                    </li>
                </ul>

                <?php if (empty($pendingReports)): ?>
                    <p class="text-muted text-center">Não há reports pendentes.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>
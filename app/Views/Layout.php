<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Douglas Pinheiro Goulart">
    <meta name="description" content="<?= $this->getDescription() ?>">
    <meta name="keywords" content="<?= $this->getKeywords() ?>">
    <title><?= $this->getTitle() ?></title>
    <link rel="stylesheet" href="<?= DIRCSS ?>bootstrap.min.css">
    <link rel="stylesheet" href="<?= DIRCSS ?>normalize.css">
    <link rel="stylesheet" href="<?= DIRCSS ?>style.css">
    <?= $this->addExtraHead($data) ?>
</head>
<body>
    <header id="header">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a href="<?= DIRPAGE ?>" class="navbar-brand">Humbleprice</a>

                <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="navbar-collapse collapse" id="navbar-menu">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbar-dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Categorias
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbar-dropdown">
                                <?php foreach (categories() as $category): ?>
                                    <a class="dropdown-item" href="<?= DIRPAGE."category/offers/{$category['slug']}" ?>"><?= $category["name"] ?></a>
                                <?php endforeach; ?>
                            </div>
                        </li>
                        <?php if (user()): ?>
                            <?php if (authorized('NANAGE_USERS')): ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbar-dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Painel
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbar-dropdown">
                                        <a class="dropdown-item" href="<?= DIRPAGE."userspanel" ?>">Painel de usuários</a>
                                    </div>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if (user()): ?>
                            <?php if (authorized('MANAGE_QUEUE')): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= DIRPAGE ?>queue">Fila</a>
                                </li>
                            <?php endif; ?>
                            <li class="nav-item nav-link"><?= user()['name'] ?></li>
                            <li class="nav-item alert-link">
                                <a class="nav-link" href="<?= DIRPAGE ?>login/logout">Sair</a>
                            </li>
                        <?php else: ?>
                           <li class="nav-item">
                               <a class="nav-link" href="<?= DIRPAGE ?>login">Login</a>
                           </li>
                        <?php endif; ?>
                    </ul>
                </div>

                <a href="<?= DIRPAGE ?>offer/suggest" class="btn btn-themed <?= (user()) ? '' : 'disabled' ?>">Sugerir oferta</a>
            </div>
        </nav>
    </header>

    <main>
        <section id="content">
            <?= $this->addMainContent($data) ?>
        </section>
    </main>

    <footer id="footer" class="mt-5">
        <h4>Humbleprice © Todos os direitos reservados.</h4>
    </footer>

    <!-- JavaScript -->
    <script src="<?= DIRJS ?>jquery-3.5.1.min.js"></script>
    <script src="<?= DIRJS ?>bootstrap.bundle.min.js"></script>
<!--    <script src="--><?//= DIRJS ?><!--ckeditor.js"></script>-->
<!--    <script>-->
<!--      ClassicEditor-->
<!--          .create( document.querySelector( '#editor' ), {-->
<!--            toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'blockQuote', '|', 'undo', 'redo']-->
<!--          } )-->
<!--          .then( editor => {-->
<!--            window.editor = editor;-->
<!--          } )-->
<!--          .catch( err => {-->
<!--            console.error( err.stack );-->
<!--          } );-->
<!--    </script>-->
    <script>const DIRPAGE = '<?= DIRPAGE ?>';</script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?= $this->addExtraFooter($data) ?>
<!--    <script src="--><?//= DIRJS ?><!--script.js"></script>-->
</body>
</html>

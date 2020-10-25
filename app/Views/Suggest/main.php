<div class="container pt-5">
    <div class="card">
        <div class="card-header">
            <h4>Adicionar Oferta</h4>
        </div>
        <div class="card-body">
            <form method="POST" id="offer-form" enctype="multipart/form-data" action="<?= DIRPAGE ?>offer/publish">
                <div id="error" class="alert alert-danger d-none" role="alert">
                    <p id="error-msg"></p>
                </div>
                <div class="form-group">
                    <label for="link">Link do produto</label>
                    <input type="text" name="link" id="link" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="name">Nome do produto</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="editor">Informações adicionais</label>
                    <textarea name="additional-info" id="editor"></textarea>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="old-price">Preço antigo</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="old-price-currency">R$</span>
                            </div>
                            <input type="text" name="old-price" id="old-price" class="form-control" aria-label="Old price" aria-describedby="old-price-currency">
                        </div>
                    </div>

                    <div class="form-group col-6">
                        <label for="new-price">Preço na promoção</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="new-price-currency">R$</span>
                            </div>
                            <input type="text" name="new-price" id="new-price" class="form-control" aria-label="New price" aria-describedby="new-price-currency">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="category">Categoria</label>
                        <select name="category" id="category" class="form-control">
                            <option value="">Escolha uma categoria</option>
                            <?php foreach (categories() as $category): ?>
                                <option value="<?= $category["slug"] ?>"><?= $category["name"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group col-6">
                        <label for="subcategory">Subcategoria</label>
                        <select name="subcategory" id="subcategory" class="form-control">
                            <option value="">Escolha uma subcategoria</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="picture">Imagem do produto</label>
                    <input type="file" name="picture" id="picture" class="form-control-file" required>
                </div>

                <div class="form-group">
                    <label for="end-offer">Fim da oferta</label>
                    <input type="date" name="end-offer" id="end-offer" class="form-control" required>
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="offer-end-date-not-specified" name="offer-end-date-not-specified">
                        <label class="form-check-label" for="offer-end-date-not-specified">
                            Fim da oferta não especificado
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-themed">Cadastrar promoção</button>
            </form>
        </div>
    </div>
</div>
<?php
require_once 'backend/sdbh.php';
$dbh = new sdbh();

$products = $dbh->getProducts();
$services = $dbh->getServices();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="assets/css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
</head>
<body>
    <div class="container">
        <div class="row row-body">
            <div class="col-3">
                <span style="text-align: center">Форма расчета</span>
                <i class="bi bi-calculator"></i>
            </div>
            <div class="col-9">
                <form id="calculationForm">
                    <label class="form-label" for="product">Выберите продукт:</label>
                    <select class="form-select" name="product" id="product">
                        <?php foreach($products as $product) {
                            echo "<option value='{$product['ID']}' data-price='{$product['PRICE']}' data-tariff='{$product['TARIFF']}'>{$product['NAME']} за {$product['PRICE']} рублей</option>";
                        } ?>
                    </select>

                    <label for="days" class="form-label">Количество дней:</label>
                    <input type="number" class="form-control" name="days" id="days" min="1" max="30">

                    <label for="additional" class="form-label">Дополнительно:</label>
                    <?php foreach($services as $k => $s) { ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="services[]" value="<?= htmlspecialchars($k) ?>" id="service_<?= htmlspecialchars($k) ?>">
                            <label class="form-check-label" for="service_<?= htmlspecialchars($k) ?>">
                                <?= htmlspecialchars($k) ?> за <?= htmlspecialchars($s) ?> рублей
                            </label>
                        </div>
                    <?php } ?>

                    <button type="submit" class="btn btn-primary">Рассчитать</button>
                </form>
                <div id="result" class="mt-3"></div>
            </div>
        </div>
    </div>
</body>
</html>

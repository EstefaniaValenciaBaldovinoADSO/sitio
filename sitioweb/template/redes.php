<div class="container mt-5">
    <h2>Detalle de Compra</h2>
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="path_to_image.jpg" class="img-fluid rounded-start" alt="Producto">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Nombre del Producto</h5>
                            <p class="card-text">Descripción del producto.</p>
                            <p class="card-text"><small class="text-muted">Precio unitario: $10.00</small></p>
                            <div class="input-group mb-3">
                                <button class="btn btn-outline-secondary" type="button" id="button-decrease">-</button>
                                <input type="text" class="form-control text-center" value="1" id="quantity" readonly>
                                <button class="btn btn-outline-secondary" type="button" id="button-increase">+</button>
                            </div>
                            <p class="card-text">Precio total: $<span id="total-price">10.00</span></p>
                            <button class="btn btn-danger" type="button" id="button-delete">Borrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Resumen de la Compra</h5>
                    <p class="card-text">Total de artículos: <span id="total-items">1</span></p>
                    <p class="card-text">Total a pagar: $<span id="grand-total">10.00</span></p>
                    <button class="btn btn-primary btn-block">Pagar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [
        'quantity' => 1,
        'unit_price' => 10.00,
        'total_price' => 10.00
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['increase'])) {
        $_SESSION['cart']['quantity']++;
    } elseif (isset($_POST['decrease']) && $_SESSION['cart']['quantity'] > 1) {
        $_SESSION['cart']['quantity']--;
    } elseif (isset($_POST['delete'])) {
        $_SESSION['cart']['quantity'] = 0;
    }

    $_SESSION['cart']['total_price'] = $_SESSION['cart']['unit_price'] * $_SESSION['cart']['quantity'];
}
?>

<form method="post">
    <button class="btn btn-outline-secondary" type="submit" name="decrease">-</button>
    <input type="text" class="form-control text-center" value="<?php echo $_SESSION['cart']['quantity']; ?>" readonly>
    <button class="btn btn-outline-secondary" type="submit" name="increase">+</button>
    <button class="btn btn-danger" type="submit" name="delete">Borrar</button>
</form>

<script>
    document.getElementById('total-price').innerText = "<?php echo number_format($_SESSION['cart']['total_price'], 2); ?>";
    document.getElementById('total-items').innerText = "<?php echo $_SESSION['cart']['quantity']; ?>";
    document.getElementById('grand-total').innerText = "<?php echo number_format($_SESSION['cart']['total_price'], 2); ?>";
</script>

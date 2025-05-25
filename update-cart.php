<?php
session_start();

// Pastikan permintaan POST dan ada parameter yang dibutuhkan
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'], $_POST['quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = (int) $_POST['quantity'];

    // Periksa apakah produk ada di cart
    if (isset($_SESSION['cart'][$product_id])) {
        if ($quantity > 0) {
            $_SESSION['cart'][$product_id]['quantity'] = $quantity;
            $message = "Jumlah produk berhasil diperbarui.";
        } else {
            // Jika jumlah 0 atau kurang, hapus produk dari cart
            unset($_SESSION['cart'][$product_id]);
            $message = "Produk dihapus dari keranjang.";
        }
    } else {
        $message = "Produk tidak ditemukan di keranjang.";
    }
} else {
    $message = "Data tidak lengkap atau metode tidak valid.";
}

// Redirect kembali ke halaman keranjang atau tampilkan pesan
header("Location: cart.php?message=" . urlencode($message));
exit;
?>
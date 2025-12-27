<?php
include 'header.php';
?>

<div class="products">
    <div class="container">
        <div class="col-md-12 product-w3ls-right">
            <div class="product-top">
                <h4>Products</h4>
                <div class="clearfix"> </div>
            </div>

            <div class="products-row">
                <?php
                $category = isset($_GET['cat']) ? $_GET['cat'] : '';
                // Map legacy file numbers to categories if passed via include logic, or get from URL
                if (isset($legacy_category)) {
                    $category = $legacy_category;
                }

                if ($category) {
                    echo "<h4>Category: " . htmlspecialchars(ucfirst($category)) . "</h4>";
                    $products = $db->get_products_by_category($category);
                } else {
                    echo "<h4>All Products</h4>";
                    // Fallback: fetch all or empty
                    $products = $db->tampil_pro(); // Using existing method for all
                }

                if (!empty($products)) {
                    foreach ($products as $r) {
                        ?>
                        <div class="col-md-3 product-grids">
                            <div class="agile-products">
                                <div class="new-tag">
                                    <h6><?php echo $r['diskon'] ? $r['diskon'] : 'New'; ?></h6>
                                </div>
                                <a href="single.php?id=<?php echo $r['id']; ?>"><img src="admin/<?php echo $r['gambar']; ?>"
                                        class="img-responsive" alt="img" style="height: 150px; object-fit: cover;"></a>
                                <div class="agile-product-text">
                                    <h5><a href="single.php?id=<?php echo $r['id']; ?>"><?php echo $r['nama_produk']; ?></a>
                                    </h5>
                                    <h6>Rp.<?php echo number_format($r['harga'], 0, ',', '.'); ?></h6>
                                    <a href="detail.php?id_barang=<?php echo $r['id'] ?>"><button type="submit"
                                            class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add
                                            to cart</button></a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<div class='alert alert-warning'>No products found in this category.</div>";
                }
                ?>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>

<?php
include 'footer.php';
?>
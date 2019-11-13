<?php foreach ($queryCatalogResult as $row) {
	$image = ($row['image'] === '') ? 'none' : $row['image'];
?>

	<div class="catalog-product">
		<a class="catalog-product__link"
			href="card-product.php?idProduct=<?= $row['id'] ?>">

			<img class="catalog-product__image"
				src="./src/images/catalog/products/<?= $image ?>.webp"
				alt=<?= $row['title'] ?> title="Событие - <?= $row['title'] ?>">

			<div class="catalog-product__content">
				<p class="catalog-product__title"><?= $row['title'] ?></p>
				<p class="catalog-product__price"><?= $row['price'] . ' ₽' ?></p>
			</div>
		</a>
	</div>
<?php }; ?>
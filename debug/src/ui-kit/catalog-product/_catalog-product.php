<?php foreach ($queryEventsResult as $row) { ?>
<!-- product-card__img-container -->
	<div class="catalog-product">
		<a class="catalog-product__link"
			href="card-product.php?idProduct=<?= $row['id'] ?>">

			<img class="catalog-product__image"
				src="./src/images/catalog/products/<?= $row['image_file'] ?>.webp"
				alt=<?= $row['title'] ?> title="Событие - <?= $row['title'] ?>">

			<div class="events__content">
				<p class="events__title"><?= $row['title'] ?></p>
				<p class="events__desc"><?= $row['miniDescription'] ?></p>
			</div>
		</a>
	</div>
<?php }; ?>
<?php foreach ($getResultData as $row) { ?>
	<div class="article">
		<img class="article__picture"
			src="./src/images/articles/<?= $row['image_file'] ?>.webp"
			alt=<?= $row['title'] ?> title="Полезные статьи - <?= $row['title'] ?>"/>
		<a class="article__link"
			href= "browsing-articles.php?idArticles=<?= $row['id'] ?>">
			<img class="article__image"
				src="./src/images/articles/quotes.svg"
				alt= "Статьи"
				title= "Блок полезных статей"/>
			<p class="article__title"> <?= $row['title'] ?></p>
			<div class="article__desc"> <?= $row['miniDescription'] ?>
				<p class="article__desc-date"><?= $row['date_create'] ?></p>
			</div>
		</a>
	</div>
<?php }; ?>
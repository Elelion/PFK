<?php foreach ($queryEventsResult as $row) { ?>
	<div class="events">
		<a class="events__link" href="browsing-events.php?idEvents=<?= $row['id'] ?>">
			<img class="events__image"
				src="./src/images/events/<?= $row['image_file'] ?>.webp"
				alt=<?= $row['title'] ?> title="Событие - <?= $row['title'] ?>">

			<div class="events__content">
				<p class="events__title"><?= $row['title'] ?></p>
				<p class="events__desc"><?= $row['miniDescription'] ?></p>
			</div>
		</a>
	</div>
<?php }; ?>
<article class="news news-extended">
	<aside>
		Aangemaakt op: <time><?php echo Utils::displayDate($data->item->date_created) ?></time>
		<?php if($data->item->date_created != $data->item->date_changed) { ?>
			, Laatst bewerkt op: <time><?php echo Utils::displayDate($data->item->date_changed, true); ?></time><?php } ?>, 
		Auteur: <?php echo $data->item->author->name; ?>
	</aside>
	<hr />
	<summary>
		<?php echo $data->excerpt; ?>
	</summary>
	<hr />
	<section>
		<?php echo $data->item->content; ?>
	</section>
</article>
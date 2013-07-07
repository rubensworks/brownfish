<div class="well">
<small class="muted">Aangemaakt op: <?php echo Utils::displayDate($data->item->date_created) ?>
<?php if($data->item->date_created != $data->item->date_changed) { ?>
, Laatst bewerkt op: <?php echo Utils::displayDate($data->item->date_changed, true); } ?>, 
Auteur: <?php echo $data->item->author->name; ?></small>
<hr />
<i><?php echo $data->excerpt; ?></i>
<hr />
<?php echo $data->item->content; ?>
</div>
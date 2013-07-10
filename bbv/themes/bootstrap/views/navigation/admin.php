<?php
$this->breadcrumbs=array(
	'Dashboard'=>array('user/dashboard'),
	'Navigatie',
);

?>
<section>
<h1>Navigatie</h1>
<div class="auto-save">
	<p>Onderstaande veranderingen worden automatisch opgeslaan.</p>
	<div id="saving"></div>
</div>
<div class="hide">
<?php
// Render the navigation template
$this->renderPartial('_navigation_admin', array('navigation'=>NULL))
?>
</div>

<?php $this->renderPartial('_navigation_admin', array('navigation'=>$root)); ?>

</section>
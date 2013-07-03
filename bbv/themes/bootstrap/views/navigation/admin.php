<?php
$this->breadcrumbs=array(
	'Dashboard'=>array('user/dashboard'),
	'Navigatie',
);

?>
<div class="section">
<h1>Navigatie</h1>
<div class="row-fluid">
	<p class="muted span6">Onderstaande veranderingen worden automatisch opgeslaan.</p>
	<div id="saving" class="span6"></div>
</div>
<div class="hide">
<?php
// Render the navigation template
$this->renderPartial('_navigation_admin', array('navigation'=>NULL))
?>
</div>

<?php $this->renderPartial('_navigation_admin', array('navigation'=>$root)); ?>

</div>
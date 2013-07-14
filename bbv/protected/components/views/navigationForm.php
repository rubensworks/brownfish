<div class="auto-save">
	<p>Onderstaande veranderingen worden automatisch opgeslaan.</p>
	<div id="saving"></div>
</div>
<div class="hide">
<?php
// Render the navigation template
$this->render('_navigation_admin', array('navigation'=>NULL))
?>
</div>

<?php $this->render('_navigation_admin', array('navigation'=>$root)); ?>
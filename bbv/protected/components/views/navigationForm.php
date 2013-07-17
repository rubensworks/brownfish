<div class="auto-save">
	<p><? echo Yii::t('messages', 'form.general.changesAutoSaved') ?></p>
	<div id="saving"></div>
</div>
<div class="hide">
<?php
// Render the navigation template
$this->render('_navigation_admin', array('navigation'=>NULL))
?>
</div>

<?php $this->render('_navigation_admin', array('navigation'=>$root)); ?>
<?php
$navigation = Navigation::buildNavigation();
/* @var $this Controller */
?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
	<div id="sidebar" class="span2">
        <?php
            echo Navigation::printNavigation($navigation);
        ?>
        <?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Operations',
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'htmlOptions'=>array('class'=>'operations'),
			));
			$this->endWidget();
		?>
		<div class='sponsors'>
		
			SPONSORS
		
		</div>
    </div><!-- sidebar -->
    <div class="span10">
        <div id="content">
            <?php echo $content; ?>
        </div><!-- content -->
    </div>
</div>
<?php $this->endContent(); ?>
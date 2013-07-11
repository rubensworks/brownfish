<?php
$navigation = Navigation::buildNavigation();
/* @var $this Controller */
?>
<?php $this->beginContent('//layouts/main'); ?>
<section class="wrapper row-fluid">
	<section class="sidebar span2">
		<div class="inner-sidebar">
			<nav>
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
			</nav>
			<section class='sponsors'>
			
				SPONSORS
			
			</section>
		</div>
    </section><!-- sidebar -->
    <section class="content span10">
    	<?php if(isset($this->breadcrumbs)):?>
			<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
				'links'=>$this->breadcrumbs,
			)); ?><!-- breadcrumbs -->
		<?php endif?>	
    	<?php echo $content; ?>
    </section>
</section>
<?php $this->endContent(); ?>
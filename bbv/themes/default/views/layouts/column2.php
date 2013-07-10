<?php
$navigation = Navigation::buildNavigation();
/* @var $this Controller */
?>
<?php $this->beginContent('//layouts/main'); ?>
<section class="wrapper">
	<section class="sidebar">
		<section>
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
		</section>
    </section><!-- sidebar -->
    <section class="content">
    	<?php echo $content; ?>
    </section>
</section>
<?php $this->endContent(); ?>
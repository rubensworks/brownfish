<?php
/* @var $this Controller */
?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
	<div class="span2">
        <div id="sidebar">
        <?php
            echo Navigation::printNavigation();
        ?>
        </div><!-- sidebar -->
    </div>
    <div class="span10">
        <div id="content">
            <?php echo $content; ?>
        </div><!-- content -->
    </div>
</div>
<?php $this->endContent(); ?>
<div id="comment-page" class="form">
<?php if(Yii::app()->user->hasFlash('successComment')):?>
    <div class="alert alert-success">
        <?php echo Yii::app()->user->getFlash('successComment'); ?>
    </div>
<?php endif; ?>
<h3>Reacties</h3>
<?php
if($comments!=NULL){
foreach ($comments as $comment){ //when adding comments to other stuff, make a widget of this piece
	?>
	<blockquote id="comment<?php echo $comment->id; ?>">
		<div class="well well-small">
			<?php 
			if(!Yii::app()->user->isGuest && ($comment->author->id==Yii::app()->user->id || Yii::app()->user->checkAccess('deleteComment'))){
				echo "<div class='close'>";
				echo CHtml::ajaxLink(
						'&times;',
						CHtml::normalizeUrl(array('comment/deleteComment')),
						array(
								'update'=>'#comment'.$comment->id,
								'type'=>'GET',
								'success'=>"$('#comment".$comment->id."').hide('slow')",
								'data' => array( 'id' => $comment->id),
						),
						array('id'=>'c'.$comment->id)
				);
				echo "</div>";
			}
			?>
			
			<div><?php echo $comment->content; ?></div>
			<small class="timeago muted">
				Geplaatst op: <?php echo Utils::displayDate($comment->date_created, true); ?> door <strong><?php echo $comment->author->name; ?></strong>
			</small>
			
		</div>
	</blockquote>
	<?php
}
}
?>

<?php
if(!Yii::app()->user->isGuest){
	$form=$this->beginWidget('CActiveForm', array(
		'id'=>'comment-form',
		'enableAjaxValidation'=>true,
	    'enableClientValidation'=>true,
		'action'=>CHtml::normalizeUrl(array('comment/comment')),
	));
?>
	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->hiddenField($model,'item_id'); ?>
    <div id='error'></div>
    <blockquote>
	<div class="row-fluid">
		<?php echo $form->textArea($model,'content', array('class'=>'span12')); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="buttons">
	
		<?php
		echo CHtml::ajaxSubmitButton(
		    'Verstuur',
		    CHtml::normalizeUrl(array('comment/comment')),
		    array(
		        'update'=>'#comment-page',
				'type'=>'submit',
		    ),
			array(
				'id'=>'comment',
				'class'=>'btn btn-primary'
			)
		);

?>
	</div>
	</blockquote>

<?php
	$this->endWidget();
} else {
	?>
	<i class="muted">Je moet ingelogd zijn om reacties te plaatsen.</i>
	<?php	
}?>

</div><!-- form -->
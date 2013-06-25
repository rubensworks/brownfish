<?php
class Commenting extends CWidget
{
	private $comments;
	public $model;
	public $item;

	public function init()
	{
		$this->model = new Comment();
		if($this->item!=NULL) {
			$this->comments = Comment::model()->findAll('item_id=:item_id order by date_created', array(':item_id'=>$this->item->id));
			$this->model->item_id = $this->item->id;
		}
	}
	
	/**
	 * An AJAX powered commenting form
	 */
	public function run(){
		Yii::app()->clientScript->registerScript('enterComment',"
			$('#Comment_content').live('keypress', function(e){
			      if(e.keyCode == 13){
					e.preventDefault();
					//jQuery.ajax({'type':'POST','url':'/comment/comment','cache':false,'data':jQuery(this).parents(\"form\").serialize(),'success':function(html){jQuery(\"#comment-page\").html(html)}});$('#Comment_content').attr('disabled', 'disabled');
				    $('#comment').trigger('click');  
					return false;
				  }
      	});", CClientScript::POS_END);
		
		Yii::app()->clientScript->registerScript('deleteComment',"
			$('.close > a').live('click', function(e){jQuery.ajax({'type':'GET','success':$('#comment'+$(this).attr('id').substring(1)).hide('slow'),'data':{'id':$(this).attr('id').substring(1)},'url':'".CHtml::normalizeUrl(array('/comment/deleteComment'))."','cache':false});return false;
		});", CClientScript::POS_END);
		
		$this->render('commenting',array(
			'model'=>$this->model,
			'comments'=>$this->comments,
		));
    }
	
	public function getModel()
	{
		return $this->model;
	}

}
?>
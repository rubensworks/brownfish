<?php
Yii::import('bootstrap.widgets.TbGridView');
/**
 * 
 * @author Ruben Taelman
 *
 * The default item-list display widget.
 * if buttonColumn=true, then a default button column will be appended at the end for RUD actions.
 *
 */
class ItemTable extends TbGridView
{
	public $buttonColumn = true;

	public function init()
	{
		$this->type = 'striped bordered condensed hover';
		$this->template = "{summary}{items}<div class='text-center'>{pager}</div>";
		$this->summaryText = "<span class='muted'>Toont {start}-{end} van de {count} resultaten</span>.";
		$this->enablePagination = true;
		if($this->buttonColumn) {
			$this->columns[] = array(
					'class'=>'bootstrap.widgets.TbButtonColumn',
					'htmlOptions'=>array('style'=>'width: 50px'),
			);
		}
		parent::init();
	}
	
	public function run(){
		parent::run();
    }

}
?>
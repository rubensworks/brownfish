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
	private $commonColumns = array(
				array('name'=>'item_search', 'value'=>'$data->item->name'),
				array('name'=>'author_search', 'value'=>'$data->item->author->name'),
				array('name'=>'date_created_search', 'value'=>'Utils::displayDate($data->item->date_created)'),
				array('name'=>'date_changed_search', 'value'=>'Utils::displayDate($data->item->date_changed)'),
				array('name'=>'category_search', 'value'=>'$data->item->category->name'),
				array('name'=>'tags_search', 'value'=>'strlen($data->item->tags)<20?$data->item->tags:substr($data->item->tags, 0, 17)."..."'),
			);

	public function init()
	{
		$this->dataProvider = $this->filter->search();
		$this->type = 'striped bordered condensed hover';
		$this->template = "{summary}{items}<div class='text-center'>{pager}</div>";
		$this->summaryText = "<span class='muted'>Toont {start}-{end} van de {count} resultaten</span>.";
		$this->enablePagination = true;
		if($this->buttonColumn) {
			$this->columns = array_merge($this->columns, $this->commonColumns);
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
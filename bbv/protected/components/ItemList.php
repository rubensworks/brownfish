<?php
Yii::import('zii.widgets.CListView');
/**
 * 
 * @author Ruben Taelman
 *
 * The default item-list display widget.
 *
 */
class ItemList extends CListView
{
	public $filter;
	public $condition = "";
	public $params = array();
	
	public function init()
	{
		$this->dataProvider = $this->filter->search();
		$this->dataProvider->criteria->order = "date_created DESC";
		//$this->dataProvider->criteria->condition = "item.category_id = 1";
		$this->dataProvider->criteria->condition = $this->condition;
		$this->dataProvider->criteria->params = $this->params;
		$this->template = ItemTable::$TEMPLATE;
		$this->summaryText = ItemTable::$SUMMARYTEXT;
		$this->enablePagination = false;
		$this->itemView = '_item';
		parent::init();
	}
	
	/**
	 * Show a collection of items
	 */
	public function run(){
		parent::run();
    }
	
	public function getModel()
	{
		return $this->model;
	}
	
	public function countComments($item_id)
	{
		return count(Comment::model()->findAll('item_id=:item_id', array(':item_id'=>$item_id)));
	}

}
?>
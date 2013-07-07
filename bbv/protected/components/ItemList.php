<?php
Yii::import('zii.widgets.CListView');
Yii::import('bootstrap.widgets.TbPager');
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
		$this->dataProvider->criteria->condition = $this->condition;
		$this->dataProvider->criteria->params = $this->params;
		$this->template = ItemTable::$TEMPLATE;
		$this->summaryText = ItemTable::$SUMMARYTEXT;
		$this->enablePagination = true;
		$this->pager = array(
		   'class'=>'TbPager',
		);
		$this->pagerCssClass = 'pagination';
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

}
?>
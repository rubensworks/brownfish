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
	public $class;
	public $criteria;
	
	public function init()
	{
		$class = $this->class;
		$this->dataProvider = new CActiveDataProvider($class::model()->visible(), array(
		    'criteria'=>$this->criteria,
		));
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
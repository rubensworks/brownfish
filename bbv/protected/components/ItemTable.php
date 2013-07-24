<?php
Yii::import('bootstrap.widgets.TbGridView');
/**
 * 
 * @author Ruben Taelman
 *
 * The default item management list display widget.
 * if buttonColumn=true, then a default button column will be appended at the end for RUD actions.
 *
 */

define('SUMMARY_TEXT', "<span class='muted'>" . Yii::t('messages', 'form.general.showingNumOf') . "</span>");

class ItemTable extends TbGridView
{
	public $buttonColumn = true;
	public $ignoreOtherColumns = false;
	public $pageSize = 10;
	public $sort = "item.id";
	
	public static $TYPE = "striped bordered condensed hover";
	public static $TEMPLATE = "{summary}{items}<div class='text-center'>{pager}</div>";
	public static $SUMMARYTEXT = SUMMARY_TEXT;
	public static $BUTTONCOLUMN = array(
					'class'=>'bootstrap.widgets.TbButtonColumn',
					'htmlOptions'=>array('style'=>'width: 20px'),
					'template'=>'{view}{update}{delete}'
			);
	
	private $commonColumns = array(
				array('name'=>'item_search', 'value'=>'$data->item->name'),
				array('name'=>'author_search', 'value'=>'$data->item->author->name'),
				array('name'=>'date_created_search', 'value'=>'Utils::displayDate($data->item->date_created)'),
				array('name'=>'date_changed_search', 'value'=>'Utils::displayDate($data->item->date_changed)'),
				array('name'=>'category_search', 'value'=>'$data->item->category->name'),
				array('name'=>'tags_search', 'value'=>'Utils::limitLength($data->item->tags, 20)'),
			);

	public function init()
	{
		$this->dataProvider = $this->filter->search();
		$this->dataProvider->pagination->pageSize = $this->pageSize;
		$this->dataProvider->sort = array(
                                                'defaultOrder'=>$this->sort,
                                );
		$this->type = ItemTable::$TYPE;
		$this->template = ItemTable::$TEMPLATE;
		$this->summaryText = ItemTable::$SUMMARYTEXT;
		$this->enablePagination = true;
		if($this->buttonColumn) {
			if($this->ignoreOtherColumns) {
				$this->columns = $this->columns;
			} else {
				$this->columns = array_merge($this->columns, $this->commonColumns);
				$this->columns[] = self::$BUTTONCOLUMN;
			}
		}
		parent::init();
	}
	
	public function run(){
		parent::run();
    }

}
?>
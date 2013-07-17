<?php
class ViewAction extends CAction
{
/**
	 * View a particular page.
	 * @param integer $id the ID of the model to view
	 */
	public function run($id)
	{
		$model = Page::model()->findByPk($id);
	
		if(isset($_POST['Page']))
		{
			$model->attributes=$_POST['Page'];
			if($model->save())
				$this->redirect(array('update', 'id'=>$model->id));
		}
	
		$criteria = new CDbCriteria();
		$criteria->condition = "page_id = :page_id";
		$criteria->params = array(":page_id"=>$model->id);
		$criteria->order = "row_order";
		$widgets = Widget::model()->findAll($criteria);
	
		$this->controller->render('/page/view',array(
				'model' => $model,
				'widgets' => $widgets,
		));
	}
}
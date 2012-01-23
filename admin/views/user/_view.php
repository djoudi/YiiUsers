<?php
/**
 * A partial view that shows information about an {@link AUser} model
 * @var AUser $data The User model being rendered
 * @var integer $index the zero-based index of the data item being rendered
 * @var CListView $widget The CListView widget rendering this view
 */
?>
<article class="user view">
<?php
if (Yii::app()->getModule("users")->enableProfileImages) {
	$this->widget("packages.users.widgets.AUserImageWidget",
			array(
				"user" => $data,
				"showLink" => true,
				"linkUrl" => array("/admin/users/user/view", "id" => $data->id),
				"htmlOptions" => array(
				"class" => "left thumbnail"
				)
			));
}
?>
	<h4><?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id'=>$data->id)); ?></h4>
	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</article>
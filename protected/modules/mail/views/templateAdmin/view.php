<?php
$this->breadcrumbs=array(
    $this->module->getCategory() => array('index'),
    Yii::t('MailModule.mail','Mail events')=>array('/mail/eventAdmin/'),
    Yii::t('MailModule.mail','Mail templates')=>array('index'),
    $model->name,
);
$this-> pageTitle = Yii::t('MailModule.mail','View mail template');
$this->menu=array(
    array('icon'=> 'list-alt', 'label' => Yii::t('MailModule.mail','Templates list'),'url'=>array('/mail/templateAdmin/index')),
    array('icon'=> 'plus-sign', 'label' =>  Yii::t('MailModule.mail','Template creation'),'url'=>array('/mail/templateAdmin/create')),
    array('icon'=>'pencil','encodeLabel'=> false, 'label' => Yii::t('MailModule.mail','Edit template'),'url'=>array('/mail/templateAdmin/update','id'=>$model->id)),
    array('icon'=>'eye-open','encodeLabel'=> false, 'label' => Yii::t('MailModule.mail','View template'),'url'=>array('/mail/templateAdmin/view','id'=>$model->id)),
    array('icon'=>'remove', 'label' =>  Yii::t('MailModule.mail','Remove template'),'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=> Yii::t('MailModule.mail','Do you really want to remove?'))),
);
?>
<div class="page-header">
    <h1><?php echo Yii::t('MailModule.mail','View mail template');?><br /><small style='margin-left:-10px;'>&laquo;<?php echo  $model->name; ?>&raquo;</small></h1>
</div>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
    'data'=>$model,
    'attributes'=>array(
        'id',
        'code',
        array(
            'name'  => 'event_id',
            'value' => $model->event->name,
        ),
        'name',
        'description',
        'from',
        'to',
        'theme',
        'body',
        array(
            'name'  => 'status',
            'value' => $model->getStatus(),
        ),
    ),
)); ?>

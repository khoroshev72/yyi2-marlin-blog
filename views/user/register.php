<?php

use app\components\SidebarWidget;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<div class="row">
    <div class="col-md-8">

        <div class="leave-comment mr0"><!--leave comment-->

            <h3 class="text-uppercase">Register</h3>
            <br>

            <? $form = ActiveForm::begin([
                    'options' => [
                            'class' => 'form-horizontal contact-form',
                            'role' => 'form',
                    ],
                    'fieldConfig' => [
                            'template' => '<div class="col-md-12">{input}</div>',
                    ]
            ])  ?>

            <?=$form->field($model, 'login')->textInput(['class' => 'form-control', 'placeholder' => 'Login']) ?>

            <?=$form->field($model, 'email')->input('email', ['class' => 'form-control', 'placeholder' => 'Email']) ?>

            <?=$form->field($model, 'password')->passwordInput(['class' => 'form-control', 'placeholder' => 'Password']) ?>

            <?=Html::submitButton('Register', ['class' => 'btn send-btn']) ?>

            <? ActiveForm::end() ?>
        </div><!--end leave comment-->
    </div>
    <?=SidebarWidget::widget() ?>
</div>

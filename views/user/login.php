<?php

use app\components\SidebarWidget;
use yii\bootstrap\ActiveForm;
use \yii\helpers\Html;
?>

<div class="row">
    <div class="col-md-8">

        <div class="leave-comment mr0"><!--leave comment-->

            <h3 class="text-uppercase">Login</h3>
            <br>
<!--            <form class="form-horizontal contact-form" role="form" method="post" action="">-->
<!--                <div class="form-group">-->
<!--                    <div class="col-md-12">-->
<!--                        <input type="text" class="form-control" id="email" name="email"-->
<!--                               placeholder="Email">-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="form-group">-->
<!--                    <div class="col-md-12">-->
<!--                        <input type="text" class="form-control" id="password" name="password"-->
<!--                               placeholder="password">-->
<!--                    </div>-->
<!--                </div>-->
<!--                <button type="submit" name="submit" class="btn send-btn">Login</button>-->
<!---->
<!--            </form>-->

            <? $form = ActiveForm::begin([
                    'options' => [
                            'class' => 'form-horizontal contact-form',
                            'role' => 'form',
                    ],
                    'fieldConfig' => [
                            'template' => '<div class="col-md-12">{input}</div>',
                    ],
            ])  ?>

            <?=$form->field($model, 'email')->input('email', ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'Email']) ?>

            <?=$form->field($model, 'password')->passwordInput(['id' => 'password', 'class' => 'form-control', 'placeholder' => 'Password']) ?>

            <?=$form->field($model, 'rememberMe')->checkbox(['template' => "<div class='col-md-1'>{input}</div><div class='col-md-11'>{label}</div>"]) ?>

            <?=Html::submitButton('Login', ['class' => 'btn send-btn']) ?>

            <? ActiveForm::end() ?>
        </div><!--end leave comment-->
    </div>
    <?=SidebarWidget::widget() ?>
</div>

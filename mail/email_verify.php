<?
use yii\helpers\Url;
?>
Для подтверждения вашего Email кликните по <b><a href="<?=Yii::$app->params['host'] . '/verify/' . $user->token ?>">ссылке</a></b>

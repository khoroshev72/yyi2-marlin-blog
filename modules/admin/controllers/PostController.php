<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Category;
use app\modules\admin\models\Tag;
use app\modules\admin\models\UploadForm;
use Yii;
use app\modules\admin\models\Post;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->with('category'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpload($id)
    {
        $model = new UploadForm();
        $post = Post::findOne($id);

        if ($model->load(Yii::$app->request->post())){
            $model->img = UploadedFile::getInstance($model, 'img');
            if ($filename = $model->saveImage($post->img)){
                $post->img = $filename;
                if ($post->save(false)){
                    Yii::$app->session->setFlash('success', 'You have successfully uploaded file');
                }
            } else {
                Yii::$app->session->setFlash('error',  'You have unsuccessfully uploaded file');
            }
            return Yii::$app->response->refresh();
         }
        return $this->render('upload', compact('model', 'post'));
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();
        $tags = Tag::find()->all();
        $cats = Category::find()->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $tags = Yii::$app->request->post('tags');
            $model->saveTags($tags);
            return $this->redirect(['view', 'id' => $model->id]);

        }

        return $this->render('create', compact('model', 'cats', 'tags'));
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $tags = Tag::find()->all();
        $cats = Category::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $tags = Yii::$app->request->post('tags');
            $model->saveTags($tags);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', compact('model', 'cats', 'tags'));
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

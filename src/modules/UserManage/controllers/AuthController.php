<?php

namespace thienhungho\UserManagement\modules\UserManage\controllers;

use Yii;
use common\modules\auth\AuthItem;
use thienhungho\UserManagement\modules\UserManage\search\AuthSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AuthController implements the CRUD actions for AuthItem model.
 */
class AuthController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @param string $type
     *
     * @return string
     */
    public function actionIndex($type = 'role')
    {
        $searchModel = new AuthSearch();
        $query = request()->queryParams;
        if ($type == 'role') {
            $query['AuthSearch']['type'] = 1;
        } else {
            $query['AuthSearch']['type'] = 1;
        }
        $dataProvider = $searchModel->search($query);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthItem model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerAuthAssignment = new \yii\data\ArrayDataProvider([
            'allModels' => $model->authAssignments,
        ]);
        $providerAuthItemChild = new \yii\data\ArrayDataProvider([
            'allModels' => $model->authItemChildren,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerAuthAssignment' => $providerAuthAssignment,
            'providerAuthItemChild' => $providerAuthItemChild,
        ]);
    }

    /**
     * Creates a new AuthItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuthItem();

        if ($model->loadAll(request()->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->name]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AuthItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (request()->post('_asnew') == '1') {
            $model = new AuthItem();
        }else{
            $model = $this->findModel($id);
        }

        if ($model->loadAll(request()->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->name]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AuthItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->deleteWithRelated();

        return $this->redirect(['index']);
    }
    
    /**
     * 
     * Export AuthItem information into PDF format.
     * @param string $id
     * @return mixed
     */
    public function actionPdf($id) {
        $model = $this->findModel($id);
        $providerAuthAssignment = new \yii\data\ArrayDataProvider([
            'allModels' => $model->authAssignments,
        ]);
        $providerAuthItemChild = new \yii\data\ArrayDataProvider([
            'allModels' => $model->authItemChildren,
        ]);

        $content = $this->renderAjax('_pdf', [
            'model' => $model,
            'providerAuthAssignment' => $providerAuthAssignment,
            'providerAuthItemChild' => $providerAuthItemChild,
        ]);

        $pdf = new \kartik\mpdf\Pdf([
            'mode' => \kartik\mpdf\Pdf::MODE_UTF8,
            'format' => \kartik\mpdf\Pdf::FORMAT_A4,
            'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT,
            'destination' => \kartik\mpdf\Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '.kv-heading-1{font-size:18px}',
            'options' => ['title' => \Yii::$app->name],
            'methods' => [
                'SetHeader' => [\Yii::$app->name],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);

        return $pdf->render();
    }

    /**
    * Creates a new AuthItem model by another data,
    * so user don't need to input all field from scratch.
    * If creation is successful, the browser will be redirected to the 'view' page.
    *
    * @param mixed $id
    * @return mixed
    */
    public function actionSaveAsNew($id) {
        $model = new AuthItem();

        if (request()->post('_asnew') != '1') {
            $model = $this->findModel($id);
        }
    
        if ($model->loadAll(request()->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->name]);
        } else {
            return $this->render('saveAsNew', [
                'model' => $model,
            ]);
        }
    }
    
    /**
     * Finds the AuthItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AuthItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for AuthAssignment
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddAuthAssignment()
    {
        if (request()->isAjax) {
            $row = request()->post('AuthAssignment');
            if((request()->post('isNewRecord') && request()->post('_action') == 'load' && empty($row)) || request()->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formAuthAssignment', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for AuthItemChild
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddAuthItemChild()
    {
        if (request()->isAjax) {
            $row = request()->post('AuthItemChild');
            if((request()->post('isNewRecord') && request()->post('_action') == 'load' && empty($row)) || request()->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formAuthItemChild', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
}

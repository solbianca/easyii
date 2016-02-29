<?php
namespace yii\easyii\controllers;

use app\components\Controller;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use Yii;

class DefaultController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'actions' => ['index'],
                        'matchCallback' => function ($rule, $action) {
                            $roles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);
                            if (0 < count($roles)) {
                                return true;
                            } else {
                                throw new ForbiddenHttpException('You are not allowed to access this page');
                            }
                        }
                    ]
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}
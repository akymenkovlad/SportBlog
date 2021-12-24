<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\SignupForm;
use app\models\User;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class AuthController extends Controller
{
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
                if (Yii::$app->user->identity->login == 'admin'){
                   return $this->redirect(['/admin/default']);
                }
            return $this->redirect(['/index']);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (Yii::$app->user->identity->login == 'admin'){
                return $this->redirect(['/admin/user']);
            }
            return $this->redirect(['/index']);
        }

        $model->password = '';
        return $this->render('/site/login.php', [
            'model' => $model,
        ]);
    }
    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();


        return $this->redirect(['/index']);
    }

    public function actionSignup()
    {
        $model = new SignupForm();

        if (Yii::$app->request->isPost)
        {
            $model->load(Yii::$app->request->post());
            if ($model->signup())
            {
                return $this->redirect(['auth/login']);
            }
        }

        return $this->render('/site/signup',['model'=>$model]);
    }
}
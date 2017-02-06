<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $rePassword;
    public $verify;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required','message' => '告诉Axo名字才能记住你哦~'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => '你的用户名已经被调皮的Axo用掉了哟！'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required','message' => '不给人家邮箱怎么会给你发邮件呢！'],
            ['email', 'email','message' => '你根本就没输入邮箱！哼！'],
            ['email', 'string', 'max' => 255 , 'message' => '你邮箱太长了！我健忘记不住的！'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => '你的依妹儿已经被人家注册了啦！'],

            ['password', 'required','message' => '不给人家密码怎么认识你呢？'],
            ['password', 'string', 'min' => 6 ,'message' => '密码小于6位了啦！会让Axo认错人的！'],

            ['rePassword', 'required','message' => '你万一输错了咋办呢？再输入一次呗！担心.jpg'],
            ['rePassword', 'string', 'min' => 6,'message' => '位数都小了啦！'],

            ['verify', 'captcha','message' => '你看错了啦！Axo眼镜都比你好！'],

            ['rePassword','compare','compareAttribute' => 'password','message' => '你看你输错了吧！^_^ ']
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
    public function attributeLabels(){
        return [
            'username' => '可爱的名字nico~',
            'email' => '电子邮件',
            'password' => '你的密码哦',
            'rePassword' => '再输一次密码啦',
            'verify' => '考你视力的讨厌验证码'
        ];

    }
}

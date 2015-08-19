<?php
/*****************************************************************************************
 * X2Engine Open Source Edition is a customer relationship management program developed by
 * X2Engine, Inc. Copyright (C) 2011-2015 X2Engine Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY X2ENGINE, X2ENGINE DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact X2Engine, Inc. P.O. Box 66752, Scotts Valley,
 * California 95067, USA. or at email address contact@x2engine.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * X2Engine" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by X2Engine".
 *****************************************************************************************/

//$this->pageTitle = Yii::app()->settings->appName . ' - Login';
Yii::app()->clientScript->registerCssFile(
    Yii::app()->controller->module->assetsUrl.'/css/main.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/x2IconsStandalone.css');

$hasProfile = false;
if(isset($_COOKIE['LoginForm'])) {
    $model->setAttributes($_COOKIE['LoginForm']);
    if (is_array ($_COOKIE['LoginForm']) &&
        in_array ('username', array_keys ($_COOKIE['LoginForm']))) {

        $username = $_COOKIE['LoginForm']['username'];
        $profile = Profile::model ()->findByAttributes (array (
            'username' => $username
        ));
        if ($profile) {
            $profileId = $profile->id;
            $fullName = $profile->fullName;
            $hasProfile = true;
        } 
    }
}

?>

<!--<div class='background-stripe'>-->
<!--</div>-->

<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', 
            array(
                'id' => 'login-form',
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),    
            )
        );
    echo X2Html::logo ('mobile', array (
        'id' => 'login-form-logo',
    ));
    ?>
    <div data-role="fieldcontain">
        <!--?php echo $form->label($model, 'username', array()); ?-->
        <?php 
        if ($hasProfile) $model->username = $profile->username;
        echo $form->textField($model, 'username', 
            array(
                'placeholder'=>Yii::t('app','username')
            )
        ); ?>
    </div>
    <div data-role="fieldcontain">
        <!--?php echo $form->label($model, 'password', array()); ?-->
        <?php echo $form->passwordField($model, 'password', 
            array(
                'placeholder'=>Yii::t('app','password')
            )
        ); ?>
        <?php echo $form->error($model, 'password'); ?>
    </div>

    <?php if($model->useCaptcha && CCaptcha::checkRequirements()) { ?>
        <div data-role="field contain">
            <?php
            $this->widget('CCaptcha',array(
                'clickableImage'=>true,
                'showRefreshButton'=>false,
                'imageOptions'=>array(
                    'style'=>'display:block;cursor:pointer;',
                    'title'=>Yii::t('app','Click to get a new image')
                )
            ));
            echo '<p class="hint">'.Yii::t('app','Please enter the letters in the image above.').'</p>';
            echo $form->textField($model,'verifyCode', array('style'=>'height:50px;'));
            echo $form->error($model, 'verifyCode'); 
            ?>
        </div>
    <?php } ?>
    <?php echo CHtml::submitButton(Yii::t('app', 'X2 Login')); ?>
    <table class='login-row'>
        <tbody>
            <tr>
                <td>
                    <div data-role="fieldcontain" class='remember-me-checkbox-container'>
                        <?php 
                        if ($model->rememberMe) {
                            echo $form->hiddenField($model,'rememberMe',array('value'=>1));
                        ?>
                        <a href='<?php echo Yii::app()->createUrl ('/mobile/site/forgetMe'); ?>'
                         class='x2-link x2-minimal-link'>
                            <?php echo Yii::t('app', 'Change User'); ?>
                        </a>
                        <?php
                        } else {
                            echo $form->checkBox(
                                $model,'rememberMe',array('value'=>'1','uncheckedValue'=>'0')); 
                            echo $form->label($model,'rememberMe',array('style'=>'font-size:10px;')); 
                            echo $form->error($model,'rememberMe'); 
                        }
                        ?>
                    </div>
                </td>
                <td>
                    <div data-corners="true" data-shadow="true" 
                    data-iconshadow="true" data-wrapperels="span" 
                    data-theme="a" data-disabled="false" 
                    class="ui-btn ui-btn-corner-all ui-btn-up-a full-site" 
                    aria-disabled="false">
                        <?php echo CHtml::link (
                            Yii::t('mobile', 'Go to Full Site'),
                            Yii::app()->getBaseUrl().'/index.php/site/index?mobile=false',
                            array(
                                'rel'=>'external', 
                                'onClick'=>'setMobileBrowserFalse()',
                                'class'=>'ui-btn-inner'
                                )
                            ); ?>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>


    <?php $this->endWidget(); ?>
</div>
<script>
// prevent ajax form post to ensure that application config settings get set after login
$.mobile['ajaxEnabled'] = false; 
</script>

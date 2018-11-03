<?php

$this->title = t('app', 'Account Settings');
$this->params['breadcrumbs'][] = ['label' => t('app', 'Account Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $user->username;

?>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PROFILE SIDEBAR -->
        <div class="profile-sidebar">
            <!-- PORTLET MAIN -->
            <div class="portlet light profile-sidebar-portlet bordered">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img src="/<?= $user->avatar ?>" class="img-responsive" alt=""> </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"> @<?= $user->username ?> </div>
                    <div class="profile-usertitle-job"> <?= $user->job ?> </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR BUTTONS -->
<!--                <div class="profile-userbuttons">-->
<!--                    <button type="button" class="btn btn-circle green btn-sm">Follow</button>-->
<!--                    <button type="button" class="btn btn-circle red btn-sm">Message</button>-->
<!--                </div>-->
                <!-- END SIDEBAR BUTTONS -->
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <ul class="nav">
<!--                        <li>-->
<!--                            <a href="page_user_profile_1.html">-->
<!--                                <i class="icon-home"></i> Overview </a>-->
<!--                        </li>-->
                        <li class="active">
                            <a href="<?= \yii\helpers\Url::to('user-profile') ?>">
                                <i class="icon-settings"></i> <?= t('app', 'Account Settings') ?> </a>
                        </li>
<!--                        <li>-->
<!--                            <a href="page_user_profile_1_help.html">-->
<!--                                <i class="icon-info"></i> Help </a>-->
<!--                        </li>-->
                    </ul>
                </div>
                <!-- END MENU -->
            </div>
            <!-- END PORTLET MAIN -->
            <!-- PORTLET MAIN -->
            <div class="portlet light bordered">
                <!-- STAT -->
<!--                <div class="row list-separated profile-stat">-->
<!--                    <div class="col-md-4 col-sm-4 col-xs-6">-->
<!--                        <div class="uppercase profile-stat-title"> 37 </div>-->
<!--                        <div class="uppercase profile-stat-text"> Projects </div>-->
<!--                    </div>-->
<!--                    <div class="col-md-4 col-sm-4 col-xs-6">-->
<!--                        <div class="uppercase profile-stat-title"> 51 </div>-->
<!--                        <div class="uppercase profile-stat-text"> Tasks </div>-->
<!--                    </div>-->
<!--                    <div class="col-md-4 col-sm-4 col-xs-6">-->
<!--                        <div class="uppercase profile-stat-title"> 61 </div>-->
<!--                        <div class="uppercase profile-stat-text"> Uploads </div>-->
<!--                    </div>-->
<!--                </div>-->
                <!-- END STAT -->
                <div>
                    <h4 class="profile-desc-title"><?= t('app', 'About') ?></h4>
                    <span class="profile-desc-text"> <?= $user->bio ?> </span>
<!--                    <div class="margin-top-20 profile-desc-link">-->
<!--                        <i class="fa fa-globe"></i>-->
<!--                        <a href="http://www.keenthemes.com">www.keenthemes.com</a>-->
<!--                    </div>-->
<!--                    <div class="margin-top-20 profile-desc-link">-->
<!--                        <i class="fa fa-twitter"></i>-->
<!--                        <a href="http://www.twitter.com/keenthemes/">@keenthemes</a>-->
<!--                    </div>-->
                    <div class="margin-top-20 profile-desc-link">
                        <i class="fa fa-facebook"></i>
                        <a href="<?= $user->facebook_url ?>" target="_blank">@<?= $user->username ?></a>
                    </div>
                </div>
            </div>
            <!-- END PORTLET MAIN -->
        </div>
        <!-- END BEGIN PROFILE SIDEBAR -->
        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title tabbable-line">
                            <div class="caption caption-md">
                                <i class="icon-globe theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase"><?= t('app', 'Profile Account') ?></span>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_1_1" data-toggle="tab"><?= t('app', 'Profile Info') ?></a>
                                </li>
                                <li>
                                    <a href="#tab_1_2" data-toggle="tab"><?= t('app', 'Change Avatar') ?></a>
                                </li>
                                <li>
                                    <a href="#tab_1_3" data-toggle="tab"><?= t('app', 'Change Password') ?></a>
                                </li>
                                <li>
                                    <a href="#tab_1_4" data-toggle="tab"><?= t('app', 'Security Settings') ?></a>
                                </li>
                            </ul>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <!-- PERSONAL INFO TAB -->
                                <div class="tab-pane active" id="tab_1_1">
                                    <?= $this->render('_form_change_user_info', ['changeUserInfoForm' => $changeUserInfoForm]) ?>
                                </div>
                                <!-- END PERSONAL INFO TAB -->
                                <!-- CHANGE AVATAR TAB -->
                                <div class="tab-pane" id="tab_1_2">
                                    <?= $this->render('_form_change_avatar', ['changeAvatarForm' => $changeAvatarForm]) ?>
                                </div>
                                <!-- END CHANGE AVATAR TAB -->
                                <!-- CHANGE PASSWORD TAB -->
                                <div class="tab-pane" id="tab_1_3">
                                    <?= $this->render('_form_change_password', ['changePasswordForm' => $changePasswordForm]) ?>
                                </div>
                                <!-- END CHANGE PASSWORD TAB -->
                                <!-- PRIVACY SETTINGS TAB -->
                                <div class="tab-pane" id="tab_1_4">
                                    <?= $this->render('_form_change_security', ['changePasswordForm' => $changePasswordForm]) ?>
                                </div>
                                <!-- END PRIVACY SETTINGS TAB -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PROFILE CONTENT -->
    </div>
</div>
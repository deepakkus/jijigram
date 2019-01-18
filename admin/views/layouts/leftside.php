<?php

use adminlte\widgets\Menu;
use yii\helpers\Html;
use yii\helpers\Url;
use admin\models\Settings;
use admin\models\User;
$id = 0;
$uid=0;
$settings = Settings::find()->all();
$changepassword = User::find()->all();
if(!empty($changepassword))
 {
	 $uid = $changepassword[0]->id;
 }

 if(!empty($settings))
 {
	 $id = $settings[0]->settings_id;
 }


/*if (($model = settings::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }*/
		
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <!--<div class="pull-left image">
<?= Html::img('@web/img/user2-160x160.jpg', ['class' => 'img-circle', 'alt' => 'User Image']) ?>
            </div>-->
            <!--<div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>-->
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <!--<div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>-->
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <?=
        Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                      /*  ['label' => 'Menu', 'options' => ['class' => 'header']],
						
                        ['label' => 'Dashboard', 'icon' => 'fa fa-dashboard', 
                            'url' => ['/'], 'active' => $this->context->route == 'site/index'
                        ],
						*/
						[
                            
                        ],
						
						
						[
                            'label' => 'Dashboard',
                            'icon' => 'fa fa-tachometer icon-2x',
                            //'url' => 'http://jamesmatthewspublishing.com/crm/admin/dashboard/index',
							'url' => '#',
                            'items' => [
                                 
                                 
                            ]
                        ], 
						
						
						 /* [
                            'label' => 'Admin',
                            'icon' => 'fa fa-key',
							//'visible'=>(Yii::$app->user->identity->usertype=='administrator')?1:0,
                            'url' => '#',
                            'items' => [
                                 
                                [
                                    'label' => 'Change Password',
                                    'icon' => 'fa fa-key',
                                    'url' => ($uid>0)?['/default/index?uid='.$uid]:['/default/index'],
        'active' => $this->context->route == 'master2/index'
                                ]
                            ]
                        ], */
      					
					
                        [
                            'label' => 'Categories',
                            'icon' => 'fa fa-file',
                            'url' => '#',
                            'items' => [
                                [
                                    'label' => 'Categories List',
                                    'icon' => 'fa fa-file',
                                    'url' => ['/categories/index'],
        							//'active' => $this->context->route == 'master1/index'
                                ],
                                [
                                    'label' => 'Create Categories',
                                    'icon' => 'fa fa-file',
                                    'url' => ['/categories/create'],
        							//'active' => $this->context->route == 'master2/index'
                                ]
                            ]
                        ],
						
						[
                            'label' => 'Post',
                            'icon' => 'fa fa-file',
                            'url' => '#',
                            'items' => [
                                [
                                    'label' => 'Post List',
                                    'icon' => 'fa fa-file',
                                    'url' => ['/post/index'],
        							'active' => $this->context->route == 'master1/index'
                                ],
                                [
                                    'label' => 'Create Post',
                                    'icon' => 'fa fa-file',
                                    'url' => ['/post/create'],
        							'active' => $this->context->route == 'master2/index'
                                ]
                            ]
                        ],
						[
                            'label' => 'Invite Leader',
                            'icon' => 'fa fa-envelope',
                            'url' => '#',
                            'items' => [
                                [
                                    'label' => 'Invite Leader List',
                                    'icon' => 'fa fa-envelope',
                                    'url' => ['/leader-invite/index'],
        							//'active' => $this->context->route == 'master1/index'
                                ],
                                [
                                    'label' => 'Create Invite Leader',
                                    'icon' => 'fa fa-envelope',
                                    'url' => ['/leader-invite/create'],
        							//'active' => $this->context->route == 'master2/index'
                                ]
                            ]
                        ],
						[
                            'label' => 'Nominate Leader',
                            'icon' => 'fa fa-envelope',
                            'url' => '#',
                            'items' => [
                                [
                                    'label' => 'Nominate Leader List',
                                    'icon' => 'fa fa-envelope',
                                    'url' => ['/nominated-leader-details/index'],
        							//'active' => $this->context->route == 'master1/index'
                                ],
                                /*[
                                    'label' => 'Create Invite Leader',
                                    'icon' => 'fa fa-envelope',
                                    'url' => ['/leader-invite/create'],
        							//'active' => $this->context->route == 'master2/index'
                                ]*/
                            ]
                        ],
						[
                            'label' => 'Pages',
                            'icon' => 'fa fa-file',
                            'url' => '#',
                            'items' => [
                                [
                                    'label' => 'Pages List',
                                    'icon' => 'fa fa-file',
                                    'url' => ['/pages/index'],
        							//'active' => $this->context->route == 'master1/index'
                                ],
                                [
                                    'label' => 'Create Pages',
                                    'icon' => 'fa fa-file',
                                    'url' => ['/pages/create'],
        							//'active' => $this->context->route == 'master2/index'
                                ]
                            ]
                        ],
						[
                            'label' => 'Settings',
                            'icon' => 'fa fa-cog',
                           'url' => ($id>0)?['/settings/update?id='.$id]:['/settings/create'],
                            //'active' => $this->context->route == 'settings/create',
                        ],
						[
                            'label' => 'User',
                            'icon' => 'fa fa-users',
                            'url' => '#',
                            'items' => [
                                [
                                    'label' => 'User List',
                                    'icon' => 'fa fa-users',
                                    'url' => ['/user/index'],
        							'active' => $this->context->route == 'master1/index'
                                ],
                                [
                                    'label' => 'Create User',
                                    'icon' => 'fa fa-users',
                                    'url' => ['/user/create'],
        							'active' => $this->context->route == 'master2/index'
                                ]
                            ]
                        ],
						
						/* [
                            'label' => 'Settings',
                            'icon' => 'fa fa-cog',
							//'visible'=>(Yii::$app->user->identity->usertype=='administrator')?1:0,
                           'url' => ($id>0)?['/settings/update?id='.$id]:['/settings/create'],
                            'active' => $this->context->route == 'settings/create',
                        ],*/
						
						/* [
                            'label' => 'Slider',
                            'icon' => 'fa fa-sliders',
                            'url' => ['/slider/index'],
                            'active' => $this->context->route == 'slider/index',
                        ],*/
						
						
                        //['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii'],],
                        //['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
                    ],
                ]
        )
        ?>
        
    </section>
    <!-- /.sidebar -->
</aside>

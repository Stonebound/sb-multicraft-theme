
        <nav class="navbar navbar-default navbar-static-top navbar-inverse" role="navigation" id="navbar">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-main">
                    <span class="sr-only">Toggle navigation</span>
                    <?php echo Theme::img('icons/bars.png') ?>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse-main">
                <?php
                $items = array();

                $simple = (Yii::app()->theme && in_array(Yii::app()->theme->name, array('simple', 'mobile', 'platform')));
                $items[] = array('label'=>Yii::t('mc', 'Home'), 'url'=>array('/site/page', 'view'=>'home'));

                if (@Yii::app()->params['installer'] !== 'show')
                {
                    $items[] = array(
                        'label'=>Yii::t('mc', 'Servers'),
                        'url'=>array('/server/index', 'my'=>0),
                        'visible'=>(!Yii::app()->user->isGuest || Yii::app()->user->showList),
                    );
                    $items[] = array(
                        'label'=>Yii::t('mc', 'Users'),
                        'url'=>array('/user/index'),
                        'visible'=>(Yii::app()->user->isStaff()
                            || !(Yii::app()->user->isGuest || (Yii::app()->params['hide_userlist'] === true) || $simple)),
                    );
                    $items[] = array(
                        'label'=>Yii::t('mc', 'Profile'),
                        'url'=>array('/user/view', 'id'=>Yii::app()->user->id),
                        'visible'=>(!Yii::app()->user->isStaff() && !Yii::app()->user->isGuest
                            && ((Yii::app()->params['hide_userlist'] === true) || $simple)),
                    );
                    $items[] = array(
                        'label'=>Yii::t('mc', 'Settings'),
                        'url'=>array('/daemon/index'),
                        'visible'=>Yii::app()->user->isSuperuser(),
                    );
                }
                if (Yii::app()->user->isGuest)
                {
                    $items[] = array(
                        'label'=>Yii::t('mc', 'Login'),
                        'url'=>array('/site/login'),
                    );
                }
                else
                {
                    $items[] = array(
                        'label'=>Yii::t('mc', 'Logout'),
                        'url'=>array('/site/logout'),
                    );
                }
                $items[] = array(
                    'label'=>Yii::t('mc', 'About'),
                    'url'=>array('/site/page', 'view'=>'about'),
                    'visible'=>$simple,
                    'itemOptions'=>array('style'=>'float: right'),
                );
                
                
                $this->widget('zii.widgets.CMenu', array(
                    'items'=>$items,
                    'htmlOptions'=>array('class' => 'nav navbar-nav')
                ));
                ?>
            </div>
            <div class="notice"><?php echo $this->notice ?></div>
        </nav>

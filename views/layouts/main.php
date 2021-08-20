<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;

use yii\widgets\Breadcrumbs;
use app\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
      
    <link rel="shortcut icon" href="/web/images/ico/favicon.ico">

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/web/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/web/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/web/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/web/images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
<?php $this->beginBody() ?>
	<header id="header">      
        <div class="container">
            <div class="row">
                <div class="col-sm-12 overflow">
                   <div class="social-icons pull-right">
                        <ul class="nav nav-pills">
                            <li><a href=""><i class="fa fa-facebook"></i></a></li>
                            <li><a href=""><i class="fa fa-twitter"></i></a></li>
                            <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                            <li><a href=""><i class="fa fa-dribbble"></i></a></li>
                            <li><a href=""><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div> 
                </div>
             </div>
        </div>
        <div class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="<?= Url::home() ?>">
                    	<h1><img src="/web/images/logo.png" alt="logo"></h1>
                    </a>
                    
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="<?= Url::home() ?>"><?= Yii::t('app', 'NAV_HOME') ?> </a></li>
                        <li class="dropdown"><a href="#"><?= Yii::t('app', 'NAV_PAGES') ?> <i class="fa fa-angle-down"></i></a>
                            <ul role="menu" class="sub-menu">
                                <li><a href="<?= Url::toRoute(['pages/index']) ?>">About</a></li>
                                <li><a href="<?= Url::toRoute(['pages/about2']) ?>">About 2</a></li>
                                <li><a href="<?= Url::toRoute(['pages/service']) ?>">Services</a></li>
                                <li><a href="<?= Url::toRoute(['pages/picting']) ?>">Pricing</a></li>
                                <li><a href="<?= Url::toRoute(['pages/contact']) ?>">Contact us</a></li>
                                <li><a href="<?= Url::toRoute(['pages/contact2']) ?>">Contact us 2</a></li>
                                <li><a href="<?= Url::toRoute(['pages/404']) ?>">404 error</a></li>
                                <li><a href="<?= Url::toRoute(['pages/comming-soon']) ?>">Coming Soon</a></li>
                            </ul>
                        </li>                    
                        <li class="dropdown"><a href="<?= Url::toRoute(['blog/index']) ?>"><?= Yii::t('app', 'NAV_BLOG') ?> <i class="fa fa-angle-down"></i></a>
                            <ul role="menu" class="sub-menu">
                                <li><a href="<?= Url::toRoute(['blog/index']) ?>">Blog Default</a></li>
                                <li><a href="<?= Url::toRoute(['blog/timeline_blog']) ?>">Timeline Blog</a></li>
                                <li><a href="<?= Url::toRoute(['blog/2_columns+right_sidebar']) ?>">2 Columns + Right Sidebar</a></li>
                                <li><a href="<?= Url::toRoute(['blog/1_columns+right_sidebar']) ?>">1 Column + Left Sidebar</a></li>
                                <li><a href="<?= Url::toRoute(['blog/blog_masounary']) ?>">Blog Masonary</a></li>
                                <li><a href="<?= Url::toRoute(['blog/blog_details']) ?>">Blog Details</a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a href="<?= Url::toRoute(['portfolio/index']) ?>"><?= Yii::t('app', 'NAV_PORTFOLIO') ?> <i class="fa fa-angle-down"></i></a>
                            <ul role="menu" class="sub-menu">
                                <li><a href="<?= Url::toRoute(['portfolio/index']) ?>">Portfolio Default</a></li>
                                <li><a href="<?= Url::toRoute(['portfolio/isotope_3_columns+right_sidebar']) ?>">Isotope 3 Columns + Right Sidebar</a></li>
                                <li><a href="<?= Url::toRoute(['portfolio/3_columns+right_sidebar']) ?>">3 Columns + Right Sidebar</a></li>
                                <li><a href="<?= Url::toRoute(['portfolio/3_columns+left_sidebar']) ?>">3 Columns + Left Sidebar</a></li>
                                <li><a href="<?= Url::toRoute(['portfolio/2_columns']) ?>">2 Columns</a></li>
                                <li><a href="<?= Url::toRoute(['portfolio/portfolio_details']) ?>">Portfolio Details</a></li>
                            </ul>
                        </li>                         
                        <!--<li><a href="<?//= Url::toRoute(['shortcodes/index']) ?>">Шорткоды</a></li>-->
                        <?php if (Yii::$app->user->isGuest) : ?>
                            <li><a href="<?= yii\helpers\Url::toRoute(['/user/default/login']) ?>"><?= Yii::t('app', 'NAV_LOGIN') ?></a></li>
                        <?php else : ?>
                        <li class="dropdown"><a href="<?= Url::toRoute(['/user/profile/index']) ?>"><?= Yii::t('app', 'NAV_PROFILE') ?> (<?= Yii::$app->user->identity->username ?>) <i class="fa fa-angle-down"></i></a>
                            <ul role="menu" class="sub-menu">
                                <li><a href="<?= yii\helpers\Url::toRoute(['/user/default/logout']) ?>"><?= Yii::t('app', 'NAV_LOGOUT') ?></a></li>
                                <li><a href="<?= yii\helpers\Url::toRoute(['/user/profile/index']) ?>"><?= Yii::t('app', 'NAV_PROFILE') ?></a></li>
                                <?//php if(Yii::$app->user->can('admin')): ?>
                                    <li><a href="<?= yii\helpers\Url::toRoute(['/admin/default/index']) ?>"><?= Yii::t('app', 'NAV_ADMIN') ?></a></li>
                                <?//php endif; ?>
                            </ul>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="search">
                    <form role="form">
                        <i class="fa fa-search"></i>
                        <div class="field-toggle">
                            <input type="text" class="search-form" autocomplete="off" placeholder="Search">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <!--/#header-->

    <!-- Flash-сообщения -->
    <section id="flash">
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
        </div>
    </section>
    <!-- Flash-сообщени -->
    
    <?= $content ?>

    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center bottom-separator">
                    <img src="/web/images/home/under.png" class="img-responsive inline" alt="">
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="testimonial bottom">
                        <h2>Testimonial</h2>
                        <div class="media">
                            <div class="pull-left">
                                <a href="#"><img src="/web/images/home/profile1.png" alt=""></a>
                            </div>
                            <div class="media-body">
                                <blockquote>Nisi commodo bresaola, leberkas venison eiusmod bacon occaecat labore tail.</blockquote>
                                <h3><a href="#">- Jhon Kalis</a></h3>
                            </div>
                         </div>
                        <div class="media">
                            <div class="pull-left">
                                <a href="#"><img src="/web/images/home/profile2.png" alt=""></a>
                            </div>
                            <div class="media-body">
                                <blockquote>Capicola nisi flank sed minim sunt aliqua rump pancetta leberkas venison eiusmod.</blockquote>
                                <h3><a href="">- Abraham Josef</a></h3>
                            </div>
                        </div>   
                    </div> 
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="contact-info bottom">
                        <h2>Contacts</h2>
                        <address>
                        E-mail: <a href="mailto:someone@example.com">email@email.com</a> <br> 
                        Phone: +1 (123) 456 7890 <br> 
                        Fax: +1 (123) 456 7891 <br> 
                        </address>

                        <h2>Address</h2>
                        <address>
                        Unit C2, St.Vincent's Trading Est., <br> 
                        Feeder Road, <br> 
                        Bristol, BS2 0UY <br> 
                        United Kingdom <br> 
                        </address>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="contact-form bottom">
                        <h2>Send a message</h2>
                        <form id="main-contact-form" name="contact-form" method="post" action="sendemail.php">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" required="required" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" required="required" placeholder="Email Id">
                            </div>
                            <div class="form-group">
                                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Your text here"></textarea>
                            </div>                        
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-submit" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="copyright-text text-center">
                        <p>&copy; Your Company 2014. All Rights Reserved.</p>
                        <p>Designed by <a target="_blank" href="http://www.themeum.com">Themeum</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--/#footer-->

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
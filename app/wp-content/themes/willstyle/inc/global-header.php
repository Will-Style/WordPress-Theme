<?php include('drawer.php'); ?>
<a class="sr-only sr-only-focusable" href="#content">本文までスキップする</a>
<header id="l-header" data-header headroom role="banner"<?php if(is_home()):?> class="is-home"<?php endif;?>>
    <div id="l-header__bg">
        <div class="l-header__wrapper">
           <?php if(is_home()):?><h1 id="l-header__logo"><?php else:?><h2 id="l-header__logo"><?php endif;?>
                <a href="/" class="l-header__logo--link">
                    <img src="/dist/img/header/logo.svg" class="l-header__logo--img" alt="有限会社三宅商店">
                </a>
           <?php if(is_home()):?></h1><?php else:?></h2><?php endif;?>
            <div id="l-gnav">
                <nav>
                    <ul class="l-gnav__nav">
                        <li class="l-gnav__item"><a href="/concept/" class="l-gnav__link"><span>Concept</span></a></li>
                        <li class="l-gnav__item"><a href="/service/" class="l-gnav__link"><span>Service</span></a></li>
                        <li class="l-gnav__item"><a href="/company/" class="l-gnav__link"><span>Company</span></a></li>
                    </ul>
                </nav>
            </div>
            <div class="l-header__cta">
                <a href="/contact/" class="l-header__cta--button"><span>Contact</span></a>
            </div>
        </div>
    </div>
</header><!-- #header -->
<div id="l-sns__link">
    <a href="https://www.instagram.com/miyakeshoten_blancozap/" target="_blank"><i class="fab fa-instagram"></i></a>
    <a href="" target="_blank"><i class="fab fa-youtube"></i></a>
</div>
<a href="#page" id="l-scroll__pagetop">
    <div class="l-scroll">
        <div class="l-scroll__pagetop--txt"></div>
        <div class="l-scroll__pagetop--bar"></div>
    </div>
    <div class="l-pagetop">
        <div class="l-scroll__pagetop--txt"></div>
        <div class="l-scroll__pagetop--bar"></div>
    </div>
</a>
<div id="l-onlineshop__button">
    <a href="https://www.rakuten.co.jp/blancozap/" target="_blank"><span>Online Shop</span></a>
</div>
<main id="content">
<?php if(is_home() || get_post_type() == "pickup"):?>
    
    <?php include("aside-blog.php");?>
<?php else:?>
    <?php include("pickup.php");?>
<?php endif;?>

</main>
                
    <aside id="l-footer__contact">
        <div class="l-footer__contact--wrapper">
            <div class="l-footer__contact--bg"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h3 class="l-footer__contact--heading c-section__title">Contact</h3>
                        <div class="l-footer__contact--body">三宅商店のお問い合わせはこちら</div>
                        <div class="l-footer__contact--btn">
                            <a href="/contact/" class="btn btn-outline btn-inverse btn-arrow"><span>Contact us</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <footer id="l-footer">
        <div class="l-footer__wrapper">
            <div class="l-footer__top">
                <div class="container">
                    <div class="l-footer__nav--wrapper">
                        <div class="l-footer__nav--list">
                            <h3 class="l-footer__nav--title"><a href="/concept/" data-drawer-animate>Concept</a></h3>
                            <ul class="l-footer__nav">
                                <li class="l-footer__nav--item">
                                    <a href="/concept/" class="l-footer__nav--link">
                                        <span class="l-footer__nav--str" data-drawer-animate>三宅商店について</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="l-footer__nav--list">
                            <h3 class="l-footer__nav--title"><a href="/service/" data-drawer-animate>Service</a></h3>
                            <ul class="l-footer__nav">
                                <li class="l-footer__nav--item">
                                    <a href="/service/#business" class="l-footer__nav--link">
                                        <span class="l-footer__nav--str" data-drawer-animate>事業内容</span>
                                    </a>
                                </li>
                                <li class="l-footer__nav--item">
                                    <a href="/service/#items" class="l-footer__nav--link">
                                        <span class="l-footer__nav--str" data-drawer-animate>取扱品目</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="l-footer__nav--list">
                            <h3 class="l-footer__nav--title"><a href="/company/" data-drawer-animate>Company</a></h3>
                            <ul class="l-footer__nav">
                                <li class="l-footer__nav--item">
                                    <a href="/company/#greeting" class="l-footer__nav--link">
                                        <span class="l-footer__nav--str" data-drawer-animate>ごあいさつ</span>
                                    </a>
                                </li>
                                <li class="l-footer__nav--item">
                                    <a href="/company/#outline" class="l-footer__nav--link">
                                        <span class="l-footer__nav--str" data-drawer-animate>会社概要</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="l-footer__nav--list">
                            <h3 class="l-footer__nav--title"><a href="/contact/" data-drawer-animate>Contact</a></h3>
                            <ul class="l-footer__nav">
                                <li class="l-footer__nav--item">
                                    <a href="/contact/" class="l-footer__nav--link">
                                        <span class="l-footer__nav--str" data-drawer-animate>お問い合わせ</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="l-footer__nav--list">
                            <h3 class="l-footer__nav--title"><span data-drawer-animate>Post menu</span></h3>
                            <ul class="l-footer__nav">
                                <li class="l-footer__nav--item">
                                    <a href="/information/" class="l-footer__nav--link">
                                        <span class="l-footer__nav--str" data-drawer-animate>お知らせ</span>
                                    </a>
                                </li>
                                <li class="l-footer__nav--item">
                                    <a href="/blog/" class="l-footer__nav--link">
                                        <span class="l-footer__nav--str" data-drawer-animate>ブログ</span>
                                    </a>
                                </li>
                                <li class="l-footer__nav--item">
                                    <a href="/pickup/" class="l-footer__nav--link">
                                        <span class="l-footer__nav--str" data-drawer-animate>おすすめ商品</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="l-footer__logo">
                        <img src="/dist/img/header/logo-w.svg" alt="Miyake Shoten">
                    </div>
                    <ul class="l-footer__sns">
                        <li>
                            <a href="https://www.instagram.com/miyakeshoten_blancozap/" target="_blank"><i class="fab fa-instagram"></i></a>
                        </li>
                        <li>
                            <a href="" target="_blank"><i class="fab fa-youtube"></i></a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="l-footer__bottom">
                <div class="container">
                    <div class="row justify-content-lg-end">
                        <div class="col-lg-4 order-lg-2">
                            <div class="l-footer__sub">
                                <ul class="l-footer__subnav">
                                    <li class="l-footer__subnav--item"><a href="/social-policy/" class="l-footer__subnav--link" data-window-open target="_blank">Socialmedia policy</a></li>
                                    <li class="l-footer__subnav--item"><a href="/pp/" class="l-footer__subnav--link" data-window-open target="_blank">Privacy Policy</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 order-lg-1">
                            <p id="l-copyright"><small lang="en">&copy; <span class="copyright__year">2021</span> Miyake Shoten</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
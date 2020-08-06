<menu>
    <!-- Nav for wordpress start -->
    <nav data-default_back_btn_text="Menu">
        <ul>
            <?php if ($informations): ?>
                <li class="menu-item-has-children">
                    <span><?php echo $menu_title_about_us; ?></span>
                    <div class="dropdown-menu-wrap">
                        <ul class="dropdown-menu">
                            <?php foreach ($informations as $information): ?>
                                <li>
                                    <a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>
            <?php if ($categories): ?>
                        <li class="menu-item-has-children">
                        <span><a href="<?php echo $menu_link_productions ?>"><?php echo $menu_title_productions; ?></a></span>
                        <div class="dropdown-menu-wrap">
                            <ul class="dropdown-menu">
                                <?php foreach ($categories as $category): ?>
                                    <li>
                                        <a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
            <?php endif; ?>
            <li>
                <a href="about.html">Магазин</a>
            </li>
            <li class="menu-item-has-children">
                <span> Знайти локацію</span>
                <div class="dropdown-menu-wrap">
                    <ul class="dropdown-menu">
                        <li><a href="#">Test 12</a></li>
                        <li><a href="##">Test 22</a></li>
                        <li><a href="###">Test 33</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <a href="#">Інформаційний центр</a>
            </li>
            <li>
                <a href="<?php echo $contact; ?>"><?php echo $menu_contact; ?></a>
            </li>
        </ul>
        <div class="header-cab">
            <a href="#">
                <svg width="17" height="20" viewBox="0 0 17 20" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.2779 4.95839C13.2779 7.48969 11.2258 9.54161 8.69447 9.54161C6.16318 9.54161 4.11108 7.48969 4.11108 4.95839C4.11108 2.42709 6.16318 0.375 8.69447 0.375C11.2258 0.375 13.2779 2.42709 13.2779 4.95839Z"
                          fill="#029C99"/>
                    <path d="M12.5902 11.375H4.79845C2.39774 11.375 0.444336 13.3284 0.444336 15.7291V18.9375C0.444336 19.317 0.752335 19.625 1.13184 19.625H16.2568C16.6363 19.625 16.9443 19.317 16.9443 18.9375V15.7291C16.9443 13.3284 14.9909 11.375 12.5902 11.375Z"
                          fill="#029C99"/>
                </svg>
                <p>
                    <?php echo $text_account; ?>
                </p>
            </a>
        </div>
        <div class="header-select">
            <div class="select-lg menu-item-has-children js-select-lg">
                <span><?php echo strtoupper($lang); ?></span>
                <?php echo $language; ?>
            </div>
        </div>
    </nav>

    <!-- Nav for wordpress end -->
    <div class="burger hidden-on-desktop">
        <span>&nbsp;</span>
        <span>&nbsp;</span>
        <span>&nbsp;</span>
    </div>
</menu>
<!-- Start text-img -->
<!-- Start text-img section -->
<?php $i = 0; ?>
<?php foreach ($banners as $banner): ?>

    <!-- Start text-img section -->
    <section class="section text-img<?php echo $i % 2 ? null : ' text-img--revers' ?> text-img--small">
        <div class="container">
            <div class="text-img-inner">
                <div class="text-img__content fadeInRight animated">

                    <div class="title-head">

                        <h3 class="title-head__main title--desh"><?php echo $banner['title']; ?></h3>
                    </div>

                    <p>
                        Зменшення маси. Сучасні двигуни тепер працюють при більш високих температурах, ніж будь-коли раніше. Це надмірне тепло не відображається на індикаторі приладової панелі - це тиха проблема, глибоко в двигуні. Мастило грає важливу роль в відведення цієї тепла, і воно постійно піддається атакам, що призводить до втрати продуктивності і пошкодження критичних компонентів через руйнівний зносу металу на металі.
                    </p>

                </div>

                <div class="text-img__picture fadeInLeft animated text-img__picture--border">
                    <div class="img-wrap">
                        <img data-src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>">
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- End text-img section -->

<?php $i++; ?>
<?php endforeach; ?>
<?php header("Cache-Control: no-cache, must-revalidate"); ?><!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=55d7f767-15bc-4e82-863e-31000395a522&suggest_apikey=ee0101d4-9a5a-4ee2-9a97-116d9e6207c9" type="text/javascript"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <?php wp_head(); ?>
    <script src="/wp-content/themes/theme/js/cookie.js"></script>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-PS4BM6F');</script>
    <!-- End Google Tag Manager -->

    <meta name="yandex-verification" content="02de7abccf41bbae" />
    <meta name="yandex-verification" content="50671f6ce40cf19f" />
    <meta name="mailru-domain" content="Rsg5YmdfoMnfaRN0" />
    <style type="text/css">
        html, body { width: 100%; height: 95%; margin: 0; padding: 0; font-family: Arial; font-size: 14px; }
        #map, #map2 { width: 100%; height: 95%; }
        .header { padding: 5px; }
    </style>
</head>

<body>
<?if ( is_user_logged_in() && get_user_meta( get_current_user_id(), 'delivery', true ) == '1' ) {?>
    <style>
        #billing_delivery_field { display: none; }
        #billing_comment_field { display: none; }
    </style>
<?} if ( is_user_logged_in() && get_user_meta( get_current_user_id(), 'delivery', true ) == '0') {?>
    <style>
        #billing_samoviziv_field, h6#primer { display: none; }
    </style>
<?}?>
<?if ( !is_user_logged_in() && $_COOKIE['delivery'] == '1' ) {?>
    <style>
        #billing_delivery_field { display: none; }
        #billing_comment_field { display: none; }
    </style>
<?} if ( !is_user_logged_in() && $_COOKIE['delivery'] == '0' ) {?>
    <style>
        #billing_samoviziv_field, h6#primer { display: none; }
    </style>
<?}?>
<style>
    #map, #map2 { height: 250px; width: 100%; }
    .mapboxgl-popup { max-width: 200px; }
    .selected { border: 2px solid blue; }
    .mapboxgl-marker { cursor: pointer; }
    .red-marker { background-image: url('https://cdn.mapmarker.io/api/v1/pin?size=50&background=%2300ff00&text=%20'); background-size: contain; margin-top: -5px !important; }
    .blue-marker { background-image: url('https://cdn.mapmarker.io/api/v1/pin?size=50&background=%2300ff00&text=%20'); margin-top: -5px !important; background-size: contain; }
</style>
<style>
    .xoo-wsc-basket { display: block !important; }
    .but { font-size: 100%; margin: 0; line-height: 1; cursor: pointer; position: relative; text-decoration: none; overflow: visible; padding: 0.618em 1em; font-weight: 700; border-radius: 3px; left: auto; color: #ffffff; background-color: #6ba802; border: 0; display: inline-block; background-image: none; box-shadow: none; text-shadow: none; }
</style>
<style>.xoo-wsc-footer { z-index: 111111111111111; }</style>
<p style="display:none;">
    <?
    $user_id = get_current_user_id();
    $args_check = $_COOKIE['market'];
    ?>
</p>
<?
$url = $_SERVER['REQUEST_URI'];
if($url == "/my-account/user-market/") {
    header('Location: https://ferma-dv.ru/user-market/');
}
if( is_product_category() ) {
    $url = $_SERVER['REQUEST_URI'];
    $parts = parse_url($url);
    parse_str($parts['query'], $query);
    $check = $query['wms-addon-store-filter-form'][0];
    $check1 = $query['post_type'];
    $term_id = get_queried_object_id();
    $term_link = get_term_link( $term_id );
    if($_COOKIE['delivery'] == 0) {
        if($check != null) { header('Location: '.$term_link); }
    } else {
        if($check != null and empty($check1)) {
            $term_id = get_queried_object_id();
            $term_link = get_term_link( $term_id );
            if ($check != $_COOKIE['key_market']) {
                header('Location: '.$term_link . '?wms-addon-store-filter-form%5B0%5D=' . $_COOKIE['key_market']);
            }
        }
        if ($check == null) {
            header('Location: '.$term_link . '?wms-addon-store-filter-form%5B0%5D=' . $_COOKIE['key_market']);
        }
        if(!empty($check1)) {
            $term_id = get_queried_object_id();
            $term_link = get_term_link( $term_id );
            if ( is_user_logged_in() && get_user_meta( get_current_user_id(), 'delivery', true ) == '0') {
                header('Location: '.$term_link);
            } elseif (!is_user_logged_in() && $_COOKIE['delivery'] == 0) {
                header('Location: '.$term_link);
            } else {
                if ($check != $_COOKIE['key_market']) {
                    header('Location: '.$term_link . '?post_type=page&wms-addon-store-filter-form%5B0%5D=' . $_COOKIE['key_market']);
                }
            }
        }
    }
}
?>
<?
if (isset($_COOKIE["market"])) { ?>
    <style>
        .vibgoroda {display: none !important;}
        .viborgoroda_1 {display: none !important;}
        .menumobile {display: none !important;}
    </style>
<?}?>
<p id="postsumma" style="display:none">
    <?
    global $woocommerce;
    echo $woocommerce->cart->total;
    ?>
</p>
<p style="display:none" id="carttovar" class="carttovar"><?
    global $woocommerce;
    $age = 0;
    foreach ($woocommerce->cart->get_cart() as $item):
        $array[$age] = $item['product_id'];
        $age++;
    endforeach;
    echo json_encode($array);
    ?></p>
<?
if ($_COOKIE["vibor"] == 1 or $_POST["vib"] == 1 ) { ?>
    <style>
        .vibgoroda {display: none !important;}
        .viborgoroda_1 {display: block !important;}
    </style>
<?}?>
<?
if ($_COOKIE["vibor"] == 2 or $_POST["vib"] == 2 or isset($_COOKIE["market"])) { ?>
    <style>
        .vibgoroda {display: none !important;}
        .viborgoroda_1 {display: none !important;}
        .menumobile {display: none !important;}
    </style>
<?}?>
<?
if (!empty($_POST["asd"])) {
    SetCookie("market", $_POST["asd"], time()+60*60*24*1, '/');
    $_COOKIE["market"] = $_POST["asd"];
}
?>
<?
if (!empty($_POST["asd1"])) {
    SetCookie("market", $_POST["asd1"], time()+60*60*24*1, '/');
    $_COOKIE["market"] = $_POST["asd1"];
}
?>
<?
if (!empty($_POST["vib"])) {
    SetCookie("vibor", $_POST["vib"], time()+60*60*24*1, '/');
    $_COOKIE["vibor"] = $_POST["vib"];
}
?>
<?if (isset($_COOKIE["market"])) {?>
    <style>.dblock22 { display: none !important; }</style>
<?} ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PS4BM6F"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<style>
    @media (max-width: 500px) {
        .xoo-wsc-basket { right: 16em !important; }
        #telegrambott { top: 88% !important; }
    }
</style>
<style>
    .mobmenu-content li a { display: block; letter-spacing: 1px; padding: 5px 20px; text-decoration: none; font-size: 14px; text-decoration: underline; }
    body { background: #f3f0eb; font-family: 'Roboto', sans-serif; }
    .wpcf7-form input { margin-bottom: 10px !important; padding-left: 15px; width: 100%; }
    input.wpcf7-form-control.wpcf7-submit { cursor: pointer; }
    .row.jc-center{ justify-content: center; }
    .top_head { background: #6ba802; color: white; padding: 15px; max-width: 1140px; }
    .top_head a { color: white; margin-right: 10px; transition: 0.3s; }
    .top_head a:hover { color: #fbe018; text-decoration: none; }
    .head_fix { position: fixed; top: 0; background: white; z-index: 98; box-shadow: 0px 0px 8px 2px rgba(0, 0, 0, 0.1); }
    .head_menu { padding-top: 16px; padding-bottom: 16px; }
    .head_menu .second_menu { padding-top: 0px; }
    .des_rlogo { padding-top: 25px; font-size: 20px; line-height: 0.5; margin-bottom: 0px; font-weight: 700; font-size: xx-large }
    .open-modal__st{ display: inline; cursor:pointer; color: white!important; text-align: center; border-radius: 10px; background: #3d7739; text-decoration: none; padding: 13px; font-size: 24px; line-height: 1; font-weight: 700; transition: 0.3s; }
    .open-modal__st{ font-size: 17px; display: block; width: auto; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .slider_home { padding: 0px; }
    .slider_home.mrg-0 { margin: 0!important; }
    .yit_footer { font-weight: bold; display: block; margin-bottom: 20px; color: #ffeb3b; }
    .footer_ferma { color: white; padding-top: 20px; padding-bottom: 20px; }
    .footer_ferma a { color: white; display: block; margin-bottom: 10px; transition: 0.3s; }
    .menu_pic { padding-top: 130px; }
    .container.menu_pic.d-none.d-lg-block { padding-top: 20px !important; }
    a.item_m { display: block; padding: 5px; transition: 0.3s; text-align: center; border-radius: 10px; width: 140px; font-size: 13px; color: #6ba802; font-weight: 700; }
    a.item_m span { display: block; background: #6ba802; border-radius: 5px; padding: 3px; color: #fff; }
    a.item_m.green-friday span { background: #000; }
    a.item_m:hover { box-shadow: 0px 0px 8px 2px rgba(0, 0, 0, 0.1); text-decoration: none; color: black; }
    .footer_ferma a:hover { text-decoration: none; color: rgb(226, 223, 25); }
    .adress_right { font-size: 14px; padding-top: 5px; }
    button, input[type="button"], input[type="reset"], input[type="submit"] { border: 1px solid; border-color: #ccc #ccc #bbb; border-radius: 3px; background: black; color: white; font-size: 12px; font-size: 0.75rem; line-height: 1; padding: .8em 1em .7em; cursor: pointer; }
    input.search-field { width: 285px !important; padding-left: 10px; }
    form.search-form { margin-top: 15px; }
    .son_m { padding-top: 5px; }
    .second_menu { padding: 0px; padding-top: 20px; }
    .second_menu a { display: inline; margin-right: 10px; color: grey; font-weight: 700; transition: 0.3s; }
    .second_menu a:hover { color: red; text-decoration: none; }
    .main_menu { border-bottom: 1px solid gainsboro; padding-bottom: 10px; margin-top: 1em; padding-top: 10px; justify-content: center; }
    .row.main_menu a.item_m img { height: 64px; }
    .info_page { margin-top: 40px; }
    .footer_info { height: 338px; }
    .breadcums a { color: #6ba802; }
    .dropdown, .dropup { position: relative; width: 50px !important; display: inline; }
    .prod_tit { color: black; font-weight: 700; font-size: 24px; margin-top: -20px; }
    .products.pb-0 { padding-bottom: 0!important; }
    .woocommerce-tabs.wc-tabs-wrapper { display: none; }
    .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt { background-color: #6ba802; color: #fff; -webkit-font-smoothing: antialiased; }
    .woocommerce ul.products li.product .woocommerce-loop-category__title, .woocommerce ul.products li.product .woocommerce-loop-product__title, .woocommerce ul.products li.product h3 { padding: .5em 0; margin: 0; font-size: 1em; color: black; font-weight: 700; height: auto !important; min-height: 52px; }
    .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button { font-size: 100%; margin: 0; line-height: 1; cursor: pointer; position: relative; text-decoration: none; overflow: visible; padding: .618em 1em; font-weight: 700; border-radius: 3px; left: auto; color: #ffffff; background-color: #6ba802; border: 0; display: inline-block; background-image: none; box-shadow: none; text-shadow: none; }
    span.woocommerce-Price-amount.amount { font-weight: 700; font-size: 18px; color: black; }
    mark.count { display: none; }
    .product-category { background: white; text-align: center; border-radius: 10px; transition: 0.3s; }
    .product-category img { border-radius: 10px 10px 0px 0px; height: 250px !important; object-fit: cover; width: 100%; }
    .product-category:hover { transition: 0.3s; box-shadow: 0px 0px 17px 9px rgba(0, 0, 0, 0.07); }
    a.added_to_cart.wc-forward { display: none; }
    h2.woocommerce-loop-product__title { color: red !important; }
    select.orderby { padding: 5px; font-weight: bold; }
    p.woocommerce-result-count { display: none; }
    .dropdown:hover>.dropdown-menu { display: block; }
    .dropdown>.dropdown-toggle:active { pointer-events: none; }
    li.product { transition: 0.3s; text-align: center; padding-bottom: 20px !important; background: white; border-radius: 10px; }
    a.add_to_cart_button { background: #6ba802 !important; transition: 0.3s; }
    a.add_to_cart_button:hover { background: #507a06 !important; color: white !important; }
    li.product:hover { box-shadow: 0px 0px 21px 0px rgba(34, 60, 80, 0.25); }
    .xoo-wsc-pname a { color: red; }
    .xoo-wsc-ft-buttons-cont a { color: black; }
    span.xoo-wsc-ft-amt-label { display: none; }
    .xoo-wsc-ft-amt-value::before { content: "Итого: "; }
    .new_life { position: fixed; z-index: 99999; top: 5px; left: 50px; color: white; font-size: 14px; line-height: 1.3; }
    .coupon { display: none; }
    a.xoo-wsc-ft-btn.button.btn.xoo-wsc-cart-close.xoo-wsc-ft-btn-continue { display: none; }
    a.xoo-wsc-ft-btn.button.btn.xoo-wsc-ft-btn-cart { display: none; }
    a.xoo-wsc-ft-btn.button.btn.xoo-wsc-ft-btn-checkout { background: #4caf50; color: white; }
    article { width: 30%; float: left; margin: 10px; }
    article p { display: none; }
    article a { font-size: 16px; color: black; }
    .serach_new { padding-top: 10px; }
    @media(max-width: 1200px){ .container.max-row_2{ max-width: 1148px; } .container.max-row_2 .item_m{ width: 120px; } }
    @media(max-width: 1070px){ .head_menu { max-width: 1060px; padding-top: 18px; padding-bottom: 14px; } .head_menu img[src="https://ferma-dv.ru/wp-content/uploads/2022/07/Logotype-svg.svg"]{ height: 48px!important; } .head_menu .second_menu { padding-top: 0; } .head_menu .dgwt-wcas-no-submit .dgwt-wcas-sf-wrapp input[type=search].dgwt-wcas-search-input { padding: 5px 15px 5px 40px; } .head_menu .dgwt-wcas-sf-wrapp input[type=search].dgwt-wcas-search-input { height: 30px; } .top_head .row.jc-center .col-6 img { height: 20px!important; } .des_rlogo{ padding-top: 0; font-size: 18px; } .open-modal1{ font-size: 18px; } .open-modal1 span{ font-size: 14px; } .row.jc-center { justify-content: space-between; align-items: flex-start; } .container.menu_pic.d-none.d-lg-block { padding-top: 8em !important; } .top_head { padding: 10px; } }
    @media(max-width: 1025px){ .container.menu_pic.d-none.d-lg-block { padding-top: 5em !important; } }
    @media(max-width:1000px) { .product-category img { height: 150px !important; object-fit: cover; width: 100%; } .mob-menu-header-holder { width: 100%; background-color: #68aa2f; height: 50px; position: fixed; } .xoo-wsc-basket { top: 2vw; right: -5px; } }
    .mobile-search { margin-top: 20px; }
    @media(min-width: 992px) { .mobile-search { display: none; } .logo-flex{ display: flex; } }
    @media(min-width: 1200px) { .open-modal1{ font-size: 24px; } .open-modal1 span{ font-size: 17px; } }
    @media(max-width: 2560px) { .slider_home { margin-bottom: -150px; margin-top: 30px; } }
    @media(max-width: 1440px) { .slider_home { margin-bottom: -150px; margin-top: -70px; } }
    @media(max-width: 992px) { .slider_home.d-none { display: block!important; } .slider_home { margin-bottom: -50px; margin-top: -50px; } }
    @media(max-width: 768px) { .slider_home { margin-bottom: -100px; margin-top: -50px; } }
    @media(max-width: 425px) { .slider_home { margin-bottom: -70px; margin-top: -30px; } }
    .related .qib-container { display: none !important; }
    .discount-offset { padding-top: 32px; }
    .new-price { margin-top: 6px; }
    @media(max-width: 768px) { .discount-offset { padding-top: 34px; } .discount-offset span { display: block; } .menu-item-9430 a { display: inline-block; background: #6ba802; border-radius: 5px; padding: 3px; color: #fff !important; } .woocommerce ul.products li.product .woocommerce-loop-product__title { min-height: 72px; } }
    .date-label { position: absolute; top: 10px; left: 10px; background: #6ba802; border-radius: 4px; font-size: 12px; padding: 3px; color: #fff; }
</style>
<style>
    @media (max-width:500px) { .menumobile { display: block; } .modal-content1 { margin: 0 !important; border-radius: 0 !important; } }
</style>

<?php
/**
 * Вспомогательная функция: генерирует строку фильтра склада для URL категории.
 * Убирает дублирование одного и того же блока if/if/if 20+ раз в файле.
 */
function ferma_page_get_store_filter_param() {
    $args_check = $_COOKIE['market'];
    $map = array(
        'ГринМаркет ТЦ Море' => 'cab1caa9-da10-11eb-0a80-07410026c356',
        'Жигура'              => '8cc659e5-4bfb-11ec-0a80-075000080e54',
        'Реми-Сити'           => 'b24e4c35-9609-11eb-0a80-0d0d008550c2',
        'Эгершельд'           => '7c0dc9ce-ce1e-11ea-0a80-09ca000e5e93',
        'Космос'              => 'a99d6fdf-0970-11ed-0a80-0ed600075845',
        'Уссурийск'           => '9c9dfcc4-733f-11ec-0a80-0da1013a560d',
    );
    if (isset($map[$args_check])) {
        return '?wms-addon-store-filter-form%5B0%5D=' . $map[$args_check];
    }
    return '';
}

/**
 * Вспомогательная функция: текст кнопки доставки/самовывоза для mobile bar.
 */
function ferma_page_delivery_label() {
    if ( is_user_logged_in() ) {
        $user_id = get_current_user_id();
        $row = get_user_meta( $user_id, 'delivery', true );
        if($row == '') { unset($row); }
        if (isset($row)) {
            if ($row == 1) {
                echo 'Самовывоз';
                $resultArray = get_user_meta( $user_id, 'billing_samoviziv', true );
            }
            if ($row == 0) {
                if(isset($_COOKIE['delivery_time']) && isset($_COOKIE['delivery_day'])) {
                    $day = $_COOKIE['delivery_day'];
                    $time = $_COOKIE['delivery_time'];
                    if($day == "today" && $time == "express") { echo 'Экспресс-доставка'; }
                    else if($day == "today" && $time == "morning") { echo 'Доставка с&nbsp;10&nbsp;до&nbsp;12'; }
                    else if($day == "today" && $time == "day") { echo 'Доставка с&nbsp;15&nbsp;до&nbsp;17'; }
                    else if($day == "today" && $time == "evening") { echo 'Доставка с&nbsp;19&nbsp;до&nbsp;22'; }
                    else if($day == "tomorrow" && $time == "morning") { echo 'Завтра с&nbsp;10&nbsp;до&nbsp;12'; }
                    else if($day == "tomorrow" && $time == "day") { echo 'Завтра с&nbsp;15&nbsp;до&nbsp;17'; }
                    else if($day == "tomorrow" && $time == "evening") { echo 'Завтра с&nbsp;19&nbsp;до&nbsp;22'; }
                } else { echo 'Доставка'; }
                $cookieValue = get_user_meta( $user_id, 'billing_delivery', true );
                $cookieArray = explode(',', $cookieValue);
                $resultArray = implode(',', array_slice($cookieArray, 2));
            }
        } else {
            echo 'Доставка или самовывоз';
            $resultArray = 'Выберите способ получения';
        }
    } else {
        $row = $_COOKIE['delivery'];
        if (isset($row)) {
            if ($row == 1) { echo 'Самовывоз'; $resultArray = $_COOKIE['billing_samoviziv']; }
            if ($row == 0) {
                $cookieValue = $_COOKIE['billing_delivery'];
                $cookieArray = explode(',', $cookieValue);
                $resultArray = implode(',', array_slice($cookieArray, 2));
            }
        } else {
            echo 'Доставка или самовывоз';
            $resultArray = 'Выберите способ получения';
        }
    }
    echo '<br>' . $resultArray;
}

/**
 * Текст кнопки доставки для desktop (без времени, упрощённый).
 */
function ferma_page_delivery_label_desktop() {
    $resultArray = '';
    if ( is_user_logged_in() ) {
        $user_id = get_current_user_id();
        $row = get_user_meta( $user_id, 'delivery', true );
        if ( $row === '' ) { unset( $row ); }
        if ( isset( $row ) ) {
            if ( $row == 1 ) {
                $resultArray = get_user_meta( $user_id, 'billing_samoviziv', true );
            } elseif ( $row == 0 ) {
                $cookieValue = get_user_meta( $user_id, 'billing_delivery', true );
                $resultArray = implode( ',', array_slice( explode( ',', $cookieValue ), 2 ) );
            }
        } else { $resultArray = 'Выберите способ получения'; }
    } else {
        $row = isset( $_COOKIE['delivery'] ) ? $_COOKIE['delivery'] : null;
        if ( $row == 1 ) {
            $resultArray = isset( $_COOKIE['billing_samoviziv'] ) ? $_COOKIE['billing_samoviziv'] : '';
        } elseif ( $row == 0 ) {
            if ( isset( $_COOKIE['billing_delivery'] ) ) {
                $resultArray = implode( ',', array_slice( explode( ',', $_COOKIE['billing_delivery'] ), 2 ) );
            }
        } else { $resultArray = 'Выберите способ получения'; }
    }
    echo $resultArray;
}
?>

<p class="new_life dblock d-lg-none" style="display: flex; align-items: center; width: 83%;">
    <a href="/"><img src="https://ferma-dv.ru/wp-content/uploads/2022/07/Logotype-svg.svg" alt="Логотип Ферма ДВ" style="height:40px"></a>
    <span style="font-size: 11px; margin-left: auto; margin-right: auto; width: 14em; color: black; background: white; border: 2px solid #036313c9; padding: 8px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; padding-top: 3px; padding-bottom: 3px; border-radius: 9px;" class="<?if( wp_is_mobile() ) { echo "open-modal1"; }?>"><?php ferma_page_delivery_label(); ?></span>
    <a href="https://ferma-dv.ru/my-account/" style="color:#ffffff;"><?if ( is_user_logged_in() ) { echo "ЛК"; } else { echo "ВХОД"; }?></a>
</p>

<div class="container-fluid head_fix d-none d-lg-block">
    <div class="container top_head">
        <div class="row jc-center">
            <div class="col-6">
                <a href="https://ferma-dv.ru/about/">О нас</a>
                <a href="https://ferma-dv.ru/category/fermerskij-blog/">Фермерский блог</a>
                <a href="https://ferma-dv.ru/otziv/">Отзывы</a>
                <a href="https://ferma-dv.ru/novosti/">Новости</a>
                <a href="https://ferma-dv.ru/bonusnaya-programma/">Бонусная система</a>
            </div>
            <div style="position: relative; right:0px; max-width: max-content;" class="col-6">
                <a href="https://wa.me/79084411110" target="_blank" style="color:#ffeb3b;">Написать нам</a>
                <a href="https://wa.me/79084411110" target="_blank"><img src="https://ferma-dv.ru/wp-content/themes/theme/img/whatsapp.svg" style="height:26px" alt=""></a>
                <a href="https://vk.com/fermadv25/" target="_blank"><img style="height: 26px" src="https://ferma-dv.ru/wp-content/themes/theme/img/vk.svg" alt=""></a>
                <a href="tel:+79084411110"><img style="height:26px" src="https://ferma-dv.ru/wp-content/themes/theme/img/telephone.svg" alt=""> +7 908 441 1110</a>
                <a id="vhodacc" href="https://ferma-dv.ru/my-account/" style="color:#ffffff;">Вход/регистрация</a>
                <?php if(is_user_logged_in()) {?>
                    <style>#vhodacc { display: none !important; }</style>
                    <a href="https://ferma-dv.ru/my-account/" style="color:#ffffff;">Личный кабинет</a>
                    <?
                    if (!empty($_POST["asd"])) {
                        require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-config.php' );
                        require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-includes/wp-db.php' );
                        $wpdb = new wpdb( DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
                        $market = $_POST['asd'];
                        $cur_user_id = get_current_user_id();
                        $wpdb->update( 'wp_users', [ 'user_market' => $market], [ 'ID' => $cur_user_id ] );
                        header("Location: https://ferma-dv.ru/");
                    }
                    ?>
                    <?
                    if ($_POST["vib"] == 2) {
                        require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-config.php' );
                        require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-includes/wp-db.php' );
                        $wpdb = new wpdb( DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
                        $market = "Уссурийск";
                        $cur_user_id = get_current_user_id();
                        $wpdb->update( 'wp_users', [ 'user_market' => $market], [ 'ID' => $cur_user_id ] );
                        header("Location: https://ferma-dv.ru/");
                    }
                    ?>
                    <?
                    $cur_user_id = get_current_user_id();
                    $user = get_userdata($cur_user_id);
                    $username = $user->user_market;
                    if(!$username){ ?>
                        <style>
                            @media (min-width:900px) { .menu{ margin-left: 178px !important; } }
                            @media (min-width:1200px) { .menu{ margin-left: 265px !important; } }
                            @media (min-width:1370px) { .menu{ margin-left: 7.7em !important; } }
                        </style>
                        <?
                        if ($_COOKIE["vibor"] == 1 or $_POST["vib"] == 1) { ?>
                            <style>.vibgoroda {display: none !important;} .viborgoroda2 {display: block !important;}</style>
                        <?}?>
                        <?
                        if ($_POST["vibor"] == 2 or $_POST["vib"] == 2) { ?>
                            <style>.vibgoroda {display: none !important;} .viborgoroda2 {display: none !important;}</style>
                        <?}?>
                    <?php } ?>
                <?php } ?>

                <?if ( is_user_logged_in() ) {
                } else {?>
                    <?if (!empty($_POST["asd1"])) {?><style>.dblock22 { display: none !important; }</style><?}?>
                    <?if (!empty($_POST["asd"])) {?><style>.dblock22 { display: none !important; }</style><?}?>
                    <?if (isset($_COOKIE["market"])) {?>
                    <?} else {?>
                        <style>
                            @media (min-width:1199px) { .menu{ margin-left: 178px !important; } }
                            @media (min-width:1200px) { .menu{ margin-left: 265px !important; } }
                            @media (min-width:1370px) { .menu{ margin-left: 7.7em !important; } }
                        </style>
                    <?}?>
                <?}?>

            </div>
        </div>
    </div>
    <?php if ($_COOKIE["market"] != null) {?>
    <?}?>

    <div class="container head_menu">
        <div style="display:flex;">
            <style>.menu_pic { padding-top: 10em !important; }</style>
        </div>
        <div class="row jc-center">
            <div class="col-3 logo-flex" style="max-width:100%">
                <a href="https://ferma-dv.ru/"><img src="https://ferma-dv.ru/wp-content/uploads/2022/07/Logotype-svg.svg" style="float:left;height:75px;margin-right: 15px;" alt="логотип Ферма ДВ"></a>
                <div class="flex_block" style="max-width:100%">
                    <div class="col-4" style="max-width:100%;font-family: Jingleberry"><p class="des_rlogo">Ферма ДВ</p></div>
                    <div class="col-4" style="max-width:100%"><h1 style="font-size: 14px;">Доставка продуктов</h1></div>
                </div>
            </div>
            <div class="flex_block" style="width: fit-content">
                <div class="col-5 second_menu" style="max-width:100%">
                    <div class="dropdown">
                        <a href="#" data-toggle="dropdown" aria-haspopup="false" aria-expanded="true">Каталог</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="https://ferma-dv.ru/product-category/bady/<?php echo ferma_page_get_store_filter_param(); ?>">Бады</a><br>
                            <a class="dropdown-item" href="https://ferma-dv.ru/product-category/bakaleya/<?php echo ferma_page_get_store_filter_param(); ?>">Бакалея</a>
                            <a class="dropdown-item" href="https://ferma-dv.ru/product-category/varene/<?php echo ferma_page_get_store_filter_param(); ?>">Варенье, домашние соки и компоты</a>
                            <a class="dropdown-item" href="https://ferma-dv.ru/product-category/domashnie-syry/<?php echo ferma_page_get_store_filter_param(); ?>">Домашние сыры</a>
                            <a class="dropdown-item" href="https://ferma-dv.ru/product-category/domashnyaya-konservacziya/<?php echo ferma_page_get_store_filter_param(); ?>">Домашняя консервация</a><br>
                            <a class="dropdown-item" href="https://ferma-dv.ru/product-category/kolbasy/<?php echo ferma_page_get_store_filter_param(); ?>">Kолбасные изделия</a><br>
                            <a class="dropdown-item" href="https://ferma-dv.ru/product-category/kopchenosti/<?php echo ferma_page_get_store_filter_param(); ?>">Мясные деликатесы</a><br>
                            <a class="dropdown-item" href="https://ferma-dv.ru/product-category/med/<?php echo ferma_page_get_store_filter_param(); ?>">Мед</a><br>
                            <a class="dropdown-item" href="https://ferma-dv.ru/product-category/molochnaya-produkcziya/<?php echo ferma_page_get_store_filter_param(); ?>">Молочная продукция</a><br>
                            <a class="dropdown-item" href="https://ferma-dv.ru/product-category/myaso/<?php echo ferma_page_get_store_filter_param(); ?>">Мясо и рыба</a><br>
                            <a class="dropdown-item" href="https://ferma-dv.ru/product-category/ovoshhi/<?php echo ferma_page_get_store_filter_param(); ?>">Овощи, фрукты, ягоды</a><br>
                            <a class="dropdown-item" href="https://ferma-dv.ru/product-category/podarochnye-nabory/<?php echo ferma_page_get_store_filter_param(); ?>">Подарочные наборы</a><br>
                            <a class="dropdown-item" href="https://ferma-dv.ru/product-category/polufabrikaty-domashnie/<?php echo ferma_page_get_store_filter_param(); ?>">Полуфабрикаты домашние</a><br>
                            <a class="dropdown-item" href="https://ferma-dv.ru/product-category/remeslennyj-hleb-i-vypechka/<?php echo ferma_page_get_store_filter_param(); ?>">Ремесленный хлеб и выпечка</a><br>
                            <a class="dropdown-item" href="https://ferma-dv.ru/product-category/sladosti-i-deserty/<?php echo ferma_page_get_store_filter_param(); ?>">Сладости и десерты</a><br>
                            <a class="dropdown-item" href="https://ferma-dv.ru/product-category/tushenka-i-kashi-sobstvennoe-proizvodstvo/<?php echo ferma_page_get_store_filter_param(); ?>">Тушенки и каши собственного производства</a>
                            <a class="dropdown-item" href="https://ferma-dv.ru/product-category/chaj-travy-i-dikorosy/<?php echo ferma_page_get_store_filter_param(); ?>">Чай, травы и дикоросы</a>
                            <a class="dropdown-item" href="https://ferma-dv.ru/product-category/yajczo/<?php echo ferma_page_get_store_filter_param(); ?>">Яйцо домашнее</a>
                        </div>
                    </div>
                    <a href="https://ferma-dv.ru/dostavka/">Доставка и оплата</a>
                    <a href="https://ferma-dv.ru/nashi-magaziny/">Наши магазины</a>
                    <a href="https://ferma-dv.ru/category/akcii/">Акции</a>
                </div>
                <div class="col-4 serach_new" style="max-width:100%">
                    <?php echo do_shortcode('[fibosearch]'); ?>
                </div>
            </div>
            <div class="new_block_vibor col-5" style="width: 35%; flex: 0 0 35%; justify-content: center; display: flex; align-items: center;">
                <a class="open-modal1 open-modal__st"><?php ferma_page_delivery_label_desktop(); ?></a>
            </div>
        </div>
    </div>
</div>

<div class="head-sep"></div>
<?php
$cur_shop = false;
if(isset($_COOKIE['delivery']) && $_COOKIE['delivery'] == 1 && isset($_COOKIE['key_market']) && $_COOKIE['key_market'] != '') {
    $cur_shop = $_COOKIE['key_market'];
} else if((!isset($_COOKIE['delivery']) || $_COOKIE['delivery'] == 0) && isset($_COOKIE['coords']) && $_COOKIE['coords'] != '') {
    $shops = ferma_get_shops_by_coords($_COOKIE['coords']);
    $cur_shop = $shops[0];
}
if($cur_shop) {
    while( have_rows('wide_banners', 'option') ) {
        the_row();
        $shops = get_sub_field('wide_banners_shop');
        if(in_array($cur_shop, $shops)) {
            $banner_desktop = get_sub_field("wide_banners_image");
            $banner_link = get_sub_field("wide_banners_link");
        }
    }
} else {
    $banner_desktop = get_field("wide_banner_image", "option");
    $banner_link = get_field("wide_banner_link", "option");
}
?>

<?php if($banner_desktop != '') : ?>
    <div class="bwide-desktop">
        <a href="<?php echo $banner_link; ?>"><img src="<?php echo $banner_desktop; ?>" /></a>
    </div>
<?php endif; ?>

<link href='<?php echo get_template_directory_uri(); ?>/css/slick.css?v=1.9' rel='stylesheet' />

<?php if ( is_home() || is_front_page() ) : ?>
    <?php if( have_rows('mslider') ): ?>
        <div class="mslider">
            <?php while( have_rows('mslider') ) : the_row(); ?>
                <div class="mslider__item">
                    <div class="mslider__image-mobile"><img src="<?php echo get_sub_field('mslider_image'); ?>" /></div>
                    <div class="container">
                        <div class="mslider__title" style="color: <?php echo get_sub_field('mslider_color'); ?>"><?php echo get_sub_field('mslider_title'); ?></div>
                        <div class="mslider__descr" style="color: <?php echo get_sub_field('mslider_color'); ?>"><?php echo get_sub_field('mslider_text'); ?></div>
                        <div class="mslider__nav">
                            <a href="<?php echo get_sub_field('mslider_link'); ?>" class="mslider__btn"><?php echo get_sub_field('mslider_button'); ?></a>
                            <div class="mslider__arrows">
                                <a href="javascript:;" class="mslider__arrow mslider__arrow-prev">Назад</a>
                                <a href="javascript:;" class="mslider__arrow mslider__arrow-next">Вперед</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
<?php endif; ?>

<div class="container menu_pic d-none d-lg-block max-row_2">
    <?php if(!is_product_category() && $pagename != 'checkout') { ?>
        <div class="row main_menu">
            <?php
            $sf = ferma_page_get_store_filter_param();
            $cats = array(
                array('slug' => 'green-prices', 'img' => 'akcii4.png', 'label' => 'Зеленые ценники'),
                array('slug' => 'molochnaya-produkcziya', 'img' => '3.jpg', 'label' => 'Молочная продукция'),
                array('slug' => 'polufabrikaty-domashnie', 'img' => '1.jpg', 'label' => 'Полуфабрикаты домашние'),
                array('slug' => 'kopchenosti', 'img' => '0.jpg', 'label' => 'Мясные деликатесы'),
                array('slug' => 'kolbasy', 'img' => 'kolbasa.jpg', 'label' => 'Колбасные изделия'),
                array('slug' => 'ovoshhi', 'img' => 'ovoshi.jpg', 'label' => 'Овощи, фрукты, ягоды'),
                array('slug' => 'domashnie-syry', 'img' => '6.jpg', 'label' => 'Домашние сыры'),
                array('slug' => 'yajczo', 'img' => 'eggs.jpg', 'label' => 'Яйцо'),
                array('slug' => 'domashnyaya-konservacziya', 'img' => 'conservaziya.jpg', 'label' => 'Домашняя консервация'),
                array('slug' => 'myaso', 'img' => 'icons-food-1-1.jpg', 'label' => 'Мясо и рыба'),
                array('slug' => 'remeslennyj-hleb-i-vypechka', 'img' => 'hleb.jpg', 'label' => 'Ремесленный хлеб'),
                array('slug' => 'bakaleya', 'img' => '5.jpg', 'label' => 'Бакалея'),
                array('slug' => 'varene', 'img' => '7.jpg', 'label' => 'Варенья, соки и компоты'),
                array('slug' => 'chaj-travy-i-dikorosy', 'img' => '8.jpg', 'label' => 'Чай и дикоросы'),
                array('slug' => 'med', 'img' => 'med.jpg', 'label' => 'Мёд'),
                array('slug' => 'gotovaya-eda', 'img' => 'icons-food-2.jpg', 'label' => 'Кулинария'),
            );
            $img_base_old = 'https://ferma-dv.ru/wp-content/uploads/2021/04/';
            $img_base_new = 'https://ferma-dv.ru/wp-content/uploads/2022/02/';
            $img_base_23 = 'https://ferma-dv.ru/wp-content/uploads/2023/03/';
            $img_base_akcii = 'https://ferma-dv.ru/wp-content/uploads/2023/08/';

            foreach ($cats as $cat) {
                $slug = $cat['slug'];
                $img = $cat['img'];
                $label = $cat['label'];
                // Determine image base
                if (in_array($img, ['3.jpg','1.jpg','0.jpg','6.jpg','7.jpg','8.jpg','5.jpg'])) { $base = $img_base_old; }
                elseif (in_array($img, ['kolbasa.jpg','ovoshi.jpg','eggs.jpg','conservaziya.jpg','hleb.jpg','med.jpg'])) { $base = $img_base_new; }
                elseif (in_array($img, ['icons-food-1-1.jpg','icons-food-2.jpg'])) { $base = $img_base_23; }
                elseif ($img == 'akcii4.png') { $base = $img_base_akcii; }
                else { $base = $img_base_old; }
                $url = "https://ferma-dv.ru/product-category/{$slug}/{$sf}";
                echo "<a href=\"{$url}\" class=\"item_m\"><img src=\"{$base}{$img}\" alt=\"{$label}\" width=\"84px\" height=\"67px\"> <br>{$label}</a>\n";
            }
            ?>
        </div>
    <?php } ?>
</div>

<?php if($pagename == 'checkout') : ?>
    <h2 style="text-align: center; color: #6ba802; margin-top: 80px; font-size: -webkit-xxx-large;"><strong>Оформление заказа</strong></h2>
<?php endif; ?>

<?php if(is_product_category()) {
    $curcat_id = get_queried_object()->term_id;
    $current_term = get_queried_object();
    $par_cat = $current_term->parent;
    $subcats_list = get_categories( array('taxonomy' => 'product_cat', 'parent' => $curcat_id) );
    $sf = ferma_page_get_store_filter_param();

    if( $par_cat || $subcats_list ){
        echo '<div class="container list_subcat_menu" style="margin-top: 80px">';
        if( $par_cat ){ ?>
            <a href="<?php echo get_term_link( $par_cat, 'product_cat' ) . $sf; ?>" class="url_upimg"><img src="/wp-content/themes/theme/img/up_img.png"></a>
        <?}
        if( $subcats_list ){
            $kulich = get_term( 301, 'product_cat' );
            foreach( $subcats_list as $cat ){ ?>
                <a href="<?php echo get_term_link( $cat->slug, 'product_cat' ) . $sf; ?>"> <?php echo $cat->name?> (<strong><?php echo ($cat->term_id == 30145464564) ? $kulich->count : $cat->count; ?></strong>)</a>
            <?}
        }
        echo '</div>';
    }
} ?>

<div class="container">
    <div class="breadcums" style="color:#999999; margin-bottom:30px; margin-top:20px;">
        <?php if(function_exists('bcn_display')) { bcn_display(); } ?>
    </div>
</div>

<style>
    .mapboxgl-ctrl-geocoder { position: absolute; top: 1px; left: 6px; transform: translateX(-159%); width: 300px; margin: 0; padding: 10px; border-radius: 4px; background-color: #fff; box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.2); }
    .mapboxgl-ctrl-geocoder input { width: 100%; padding: 8px 10px; border: none; border-bottom: 1px solid #ccc; font-size: 16px; font-weight: 300; color: #444; }
    .mapboxgl-ctrl-geocoder .suggestions { background-color: #fff; border: 1px solid #ccc; border-radius: 4px; max-height: 300px; overflow-y: auto; margin-top: 10px; }
    .mapboxgl-ctrl-geocoder .suggestion { padding: 10px; cursor: pointer; }
    .mapboxgl-ctrl-geocoder .suggestion:hover { background-color: #f2f2f2; }
    .mapboxgl-ctrl-geocoder .suggestion.active { background-color: #e5e5e5; }
</style>

<!-- Модальное окно -->
<div class="modal1">
    <div class="modal-content1">
        <span class="close-modal1">&times;</span>
        <h2>Выберите способ получения</h2>
        <div class="tab-container1">
            <button class="tab-button1 active1" data-target="#tab1">Доставка</button>
            <button class="tab-button1" data-target="#tab2">Самовывоз</button>

            <div id="tab1" class="tab-content1 active1">
                <p style="font-weight:bold; margin-bottom:5px;">Укажите адрес и нажмите ниже кнопку ВЫБРАТЬ ДОСТАВКУ, чтобы мы показали доступные товары</p>
                <input type="text" placeholder="Поиск..." id="suggest1">
                <ul style="margin-bottom:0px" id="suggest-list1"></ul>
                <p style="margin-top:5px;margin-bottom:5px;" class="map__note">Вы можете выбрать точку на карте и если она в зоне доставки, то мы сможем привезти заказ</p>
                <div class="VV_RWayChoiceModalDR__Note" id="delivery-message" style="display: none; gap: 8px; color: #c31611; margin-bottom:0rem">
                    <div class="VV_RWayChoiceModalDR__NoteCol _img">
                        <svg class="VV_RWayChoiceModalDR__NoteImg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <circle cx="10" cy="10" r="10" fill="#D21E19"></circle>
                            <path d="M11.0964 4.755C11.0964 4.155 10.6164 3.66 10.0014 3.66C9.40141 3.66 8.89141 4.155 8.89141 4.755C8.89141 5.37 9.40141 5.865 10.0014 5.865C10.6164 5.865 11.0964 5.37 11.0964 4.755ZM9.17641 15H10.8264V7.5H9.17641V15Z" fill="white"></path>
                        </svg>
                    </div>
                    <div class="VV_RWayChoiceModalDR__NoteCol _text">
                        <span class="VV_RWayChoiceModalDR__NoteText rtext _desktop-sm _tablet-sm _mobile-sm">К сожалению, доставка не работает в выбранном месте.</span>
                    </div>
                </div>
                <p style="display:none"><?if ( is_user_logged_in() ) { $user_id = get_current_user_id(); $address2 = get_user_meta( $user_id, 'billing_delivery', true ); } else { if (isset($_COOKIE['billing_delivery'])) { echo "Текущий выбранный адрес: " . $_COOKIE['billing_delivery']; } }?></p>
                <div id="map"></div>
                <style>
                    .disabled-btn { pointer-events: none; cursor: default; }
                    .enable-dev { background: #2dbe64 !important; color: white !important; }
                    .mainblock_time, .mainblock_time1 { display: flex; padding: 10px; border-radius: 18px; cursor: pointer; width: fit-content; align-items: center; border: 1px solid; justify-content: center; }
                    .mainblock_time_express { grid-column: 1 / -1; max-width: 100%; }
                    .underblocktime { height: fit-content; display: block; align-items: center; font-size: 15px; justify-content: center; }
                    .underblocktime > p { margin: 0; text-align: center; }
                    .enable { border-color: #2dbe64 !important; color: #2dbe64 !important; }
                    .enable1 { border-color: #2dbe64 !important; background: #2dbe77; color: white; }
                </style>
                <p id="status_delivery" style="display:none"><?
                    if ( is_user_logged_in() ) {
                        $user_id = get_current_user_id();
                        $coords_in_map_delivery = get_user_meta( $user_id, 'coords', true );
                        if ( ! empty( $coords_in_map_delivery ) ) { echo $coords_in_map_delivery; }
                    } else {
                        if ( isset( $_COOKIE['coords']) ) { echo $_COOKIE['coords']; }
                    }
                    ?></p>
                <style>.notenable { display: none; }</style>
                <p id="user_authorize" style="display:none"><?if ( is_user_logged_in() ) {echo 1;} else {echo 0;}?></p>
                <div id="marker-coordinates"></div>
                <div id="coords" style="display:none"></div>
                <div id="infodev" style="display:none;"></div>
                <div id="time_change">
                    <?$current_time = current_time( 'H:i' );?>
                    <div class="flex_time" id="flex_time" style="">
                        <div class="mainblock_time <?if ( $current_time > '14:00' ) {echo 'notenable';}?>" data-count='1' data-time='1'>
                            <div class="underblocktime"><p class="delivery-text">Доставка</p><p>15-17</p><p>Сегодня</p></div>
                        </div>
                        <style>#billing_asdx1, #billing_type_delivery_sam { height: 35px; }</style>
                        <div class="mainblock_time <?if ( $current_time > '20:00' ) {echo 'notenable';}?>" data-count='2' data-time='1'>
                            <div class="underblocktime"><p class="delivery-text">Доставка</p><p>19-22</p><p>Сегодня</p></div>
                        </div>
                        <div class="mainblock_time" data-count='1' data-time='2'>
                            <div class="underblocktime"><p class="delivery-text">Доставка</p><p>15-17</p><p>Завтра</p></div>
                        </div>
                        <div class="mainblock_time" data-count='2' data-time='2'>
                            <div class="underblocktime"><p class="delivery-text">Доставка</p><p>19-22</p><p>Завтра</p></div>
                        </div>
                    </div>
                    <script>
                        const mainblock = document.querySelector('.mainblock_time:not(.notenable)');
                        if (mainblock) { mainblock.classList.add('enable'); }
                        $('.mainblock_time').click(function() { $('.mainblock_time').removeClass('enable'); $(this).addClass('enable'); });
                    </script>
                </div>
                <input type="text" id="comment_cur" placeholder="Комментарий курьеру" style="width: 100%; margin-top: 1em; display:none; border-radius: 10px; background: #f8f8fa; height: 47px; padding-left: 15px;">
                <input type="text" id="comment_cur1" placeholder="Комментарий по заказу" style="width: 100%; margin-top: 1em; display:none; border-radius: 10px; background: #f8f8fa; height: 47px; padding-left: 15px;">
                <p id="com_cur" style="margin-bottom:5px;margin-top:5px;display:none;">Здесь Вы можете оставить дополнительный комментарий для курьера</p>
                <button type="button" id="but_dev" class="disabled-btn" style="border-radius:20px;width:100%; height:60px; margin-top:0.5rem; font-size:20px; background:#eee;color: #bcbcc3">Выбрать доставку</button>
                <style>.ymaps-2-1-79-gototech, .ymaps-2-1-79-map-copyrights-promo{ display: none; }</style>
                <script>
                    ymaps.ready(init);
                    function init() {
                        const deliveryMessage = document.getElementById('delivery-message');
                        var suggestView1 = new ymaps.SuggestView('suggest1');
                        let myPlacemark, myMap = new ymaps.Map('map', { center: [43.1056, 131.874], zoom: 4, controls: ['zoomControl', 'searchControl'] }, { searchControlProvider: 'yandex#search' });

                        function get_delivery_prices(lat, lon) {
                            if (!myPlacemark) {
                                myPlacemark = new ymaps.Placemark([lat, lon], {}, { preset: 'islands#dotIcon', iconColor: '#0095b6' });
                                myMap.geoObjects.add(myPlacemark);
                            } else { myPlacemark.geometry.setCoordinates([lat, lon]); }
                            myMap.setCenter([lat, lon], 17);
                            document.getElementById('status_delivery').innerHTML = lat + ',' + lon;
                            ymaps.geocode([lat, lon]).then(function (res) {
                                let firstGeoObject = res.geoObjects.get(0);
                                if(res.geoObjects.get(0).getPremiseNumber() != null) {
                                    jQuery.ajax({
                                        type: "post", dataType: "json", url: "/wp-admin/admin-ajax.php",
                                        data: { action:'get_delivery_prices', coords: [lat, lon] },
                                        beforeSend: function() {
                                            document.getElementById('comment_cur').style.display="none";
                                            document.getElementById('comment_cur1').style.display="none";
                                            document.getElementById('com_cur').style.display="none";
                                            const button = document.getElementById('but_dev');
                                            button.classList.remove('enable-dev');
                                            button.classList.add('disabled-btn');
                                            document.getElementById('flex_time').classList.remove('active');
                                        },
                                        success: function(data) {
                                            if(!data.success) {
                                                document.querySelector('.VV_RWayChoiceModalDR__NoteText').innerHTML = data.data.error;
                                                deliveryMessage.style.display = 'flex';
                                            } else {
                                                const infodev = document.getElementById('infodev');
                                                infodev.innerHTML = firstGeoObject.getAddressLine();
                                                document.getElementById('comment_cur').style.display="block";
                                                document.getElementById('comment_cur1').style.display="block";
                                                document.getElementById('com_cur').style.display="block";
                                                const button = document.getElementById('but_dev');
                                                button.classList.remove('disabled-btn');
                                                button.classList.add('enable-dev');
                                                const times = document.getElementById('flex_time');
                                                let choices = '';

                                                <?php
                                                date_default_timezone_set("Asia/Vladivostok");
                                                $coords = ($_COOKIE['coords']) ? $_COOKIE['coords'] : '43.111787507251414,131.88327396290603';
                                                ?>

                                                if(typeof data.data.today != "undefined") {
                                                    $.each(data.data.today, function(type, price) {
                                                        if(price.price == 0) { price.price = 'Бесплатно'; } else { price.price = 'от 0 до ' + price.price + '&nbsp;₽'; }
                                                        let checked = (data.data.current == 'today_' + type) ? ' enable' : '';
                                                        choices += '<div class="mainblock_time' + checked + '" data-day="today" data-time="' + type + '"><div class="underblocktime"><p class="delivery-text">Сегодня</p><p>' + price.description + '</p><p class="mainblock_time__price">' + price.price + '</p></div></div>';
                                                    });
                                                }
                                                if(typeof data.data.tomorrow != "undefined") {
                                                    $.each(data.data.tomorrow, function(type, price) {
                                                        if(price.price == 0) { price.price = 'Бесплатно'; } else { price.price = 'от 0 до ' + price.price + '&nbsp;₽'; }
                                                        let checked = (data.data.current == 'tomorrow_' + type) ? ' enable' : '';
                                                        choices += '<div class="mainblock_time' + checked + '" data-day="tomorrow" data-time="' + type + '"><div class="underblocktime"><p class="delivery-text">Завтра</p><p>' + price.description + '</p><p class="mainblock_time__price">' + price.price + '</p></div></div>';
                                                    });
                                                }
                                                $(document).on('click', '.mainblock_time', function() { $('.mainblock_time').removeClass('enable'); $(this).addClass('enable'); });
                                                times.innerHTML = choices;
                                                if(data.data.current == "") { $('.mainblock_time').first().addClass('enable'); }
                                                times.classList.add('active');
                                            }
                                        },
                                        error: function () { deliveryMessage.innerHTML = 'Ошибка'; deliveryMessage.style.display = 'flex'; }
                                    });
                                }
                            });
                        }

                        suggestView1.events.add('select', function (e) {
                            var item = e.get('item');
                            ymaps.geocode(item.value).then(function (res) {
                                var coords = res.geoObjects.get(0).geometry.getCoordinates();
                                get_delivery_prices(coords[0], coords[1]);
                            });
                        });
                        suggestView1.events.add('suggest', function (e) {
                            var suggestData = e.get('suggestData');
                            var suggestList = document.getElementById('suggest-list1');
                            while (suggestList.firstChild) { suggestList.removeChild(suggestList.firstChild); }
                            for (var i = 0; i < suggestData.length; i++) { var li = document.createElement('li'); li.textContent = suggestData[i].displayName; suggestList.appendChild(li); }
                        });

                        var searchControl = myMap.controls.get('searchControl');
                        searchControl.options.set({ openBalloon: true, noPopup: true});

                        function open_modal() {
                            if (document.getElementById('status_delivery').innerHTML.trim() === '') {
                                navigator.geolocation.getCurrentPosition(function (position) { get_delivery_prices(position.coords.latitude, position.coords.longitude); });
                            } else {
                                let arrCoords = document.getElementById('status_delivery').innerHTML.split(',');
                                get_delivery_prices(arrCoords[0], arrCoords[1]);
                            }
                            document.querySelector(".modal1").style.display = "block";
                        }

                        let openModal1Button = document.querySelector('.open-modal1');
                        openModal1Button.addEventListener('click', function () { open_modal(); });

                        let openModalInput = document.getElementById('billing_delivery');
                        if(openModalInput) {
                            openModalInput.readOnly = true;
                            let link = document.createElement('a'); link.href = "javascript:;"; link.innerHTML = "Изменить адрес";
                            document.getElementById('billing_delivery_field').append(link);
                            link.addEventListener('click', function () { open_modal(); });
                        }

                        myMap.events.add('click', function (e) {
                            var coords = e.get('coords');
                            ymaps.geocode(coords).then(function (res) {
                                document.getElementById('comment_cur').style.display="none";
                                document.getElementById('comment_cur1').style.display="none";
                                document.getElementById('com_cur').style.display="none";
                                const button = document.getElementById('but_dev');
                                button.classList.remove('enable-dev'); button.classList.add('disabled-btn');
                                document.getElementById('flex_time').classList.remove('active');
                                get_delivery_prices(coords[0], coords[1]);
                                getAddress(coords);
                            });
                        });

                        function createPlacemark(coords) { return new ymaps.Placemark(coords, { iconCaption: 'поиск...' }, { preset: 'islands#violetDotIconWithCaption', draggable: true }); }
                        function getAddress(coords) {
                            myPlacemark.properties.set('iconCaption', 'поиск...');
                            ymaps.geocode(coords).then(function (res) {
                                var fo = res.geoObjects.get(0);
                                myPlacemark.properties.set({
                                    iconCaption: [fo.getLocalities().length ? fo.getLocalities() : fo.getAdministrativeAreas(), fo.getThoroughfare() || fo.getPremise()].filter(Boolean).join(', '),
                                    balloonContent: fo.getAddressLine()
                                });
                            });
                        }
                    }
                </script>
                <style>
                    .search-container { position: relative; display: none; }
                    #search-results { position: absolute; top: 100%; display: none; left: 0; z-index: 1; background-color: #fff; border: 1px solid #ccc; max-height: 200px; overflow-y: auto; }
                    #suggest, #suggest1 { height: 50px; width: 100%; background: #eee; border-radius: 15px; padding-left: 20px; border: 1px solid #008000; }
                </style>
            </div>
            <div id="tab2" class="tab-content1">
                <p style="font-weight:bold;margin-bottom:-1px;">Выберите магазин, чтобы посмотреть товары в наличии и оформить заказ</p>
                <button type="button" style="background: #eee; margin-top: 10px; margin-bottom:15px;" id="list_market" class="VV_RWayModalMap__ListShopsShower">
                    <svg width="15" height="20" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.666667 8H11.3333C11.7 8 12 7.7 12 7.33333C12 6.96667 11.7 6.66667 11.3333 6.66667H0.666667C0.3 6.66667 0 6.96667 0 7.33333C0 7.7 0.3 8 0.666667 8ZM0.666667 4.66667H11.3333C11.7 4.66667 12 4.36667 12 4C12 3.63333 11.7 3.33333 11.3333 3.33333H0.666667C0.3 3.33333 0 3.63333 0 4C0 4.36667 0.3 4.66667 0.666667 4.66667ZM0 0.666667C0 1.03333 0.3 1.33333 0.666667 1.33333H11.3333C11.7 1.33333 12 1.03333 12 0.666667C12 0.3 11.7 0 11.3333 0H0.666667C0.3 0 0 0.3 0 0.666667Z" fill="#1A1A1A"></path></svg>
                    <span style="color: black; font-weight: 700; font-size: 14px; vertical-align: super;">Список магазинов</span>
                </button>
                <input style="display:none" type="text" placeholder="Поиск..." id="suggest">
                <ul style="display:none" id="suggest-list"></ul>
                <div id="map2"></div>
                <div style="display:flex;margin-top:0.5rem;">
                    <div class="first_part_time" style="width:27%;">
                        <select name="data" id="id_select_time_samoviviz" style="width: 100%; height: 40px; border-radius: 47px; padding-left: 10px; background: #fbfbfb;">
                            <?$current_time1 = current_time('H:i');?>
                            <option value="today">Сегодня</option>
                            <option value="tomorrow" <?if ($current_time1 > '20:00') {echo 'selected';}?>>Завтра</option>
                        </select>
                    </div>
                    <div class="second_part_time" style="width:73%;">
                        <select name="" class="enable_time" id="select_time_1" style="width: 100%; height: 40px; <?if ($current_time1 > '20:00') {echo 'display:none;';}?> border-radius: 47px; padding-left: 10px; background: #fbfbfb;">
                            <?php
                            $current_time = current_time('H:i'); $start_time = strtotime('10:00'); $end_time = strtotime('21:00'); $interval = 7200;
                            for ($time = $start_time; $time <= $end_time; $time += $interval) { $s = date('H:i', $time); $e = date('H:i', $time + $interval); if ($e > '21:00') $e = '21:00'; if ($s > $current_time) echo '<option value="'.$s.'-'.$e.'">'.$s.'-'.$e.'</option>'; }
                            ?>
                        </select>
                        <select name="" id="select_time_2" style="width: 100%; height: 40px; border-radius: 47px; padding-left: 10px; <?if ($current_time1 > '20:00') {echo 'display:block !important;';}?> display:none; background: #fbfbfb;">
                            <?php
                            for ($time = $start_time; $time <= $end_time; $time += $interval) { $s = date('H:i', $time); $e = date('H:i', $time + $interval); if ($e > '21:00') $e = '21:00'; echo '<option value="'.$s.'-'.$e.'">'.$s.'-'.$e.'</option>'; }
                            ?>
                        </select>
                    </div>
                </div>
                <p style="margin-top:5px;">Выберете удобное для Вас время и мы подготовим заказ</p>
                <script>
                    jQuery(function($) {
                        $('#id_select_time_samoviviz').on('change', function() {
                            if ($(this).val() === 'tomorrow') { $('#select_time_1').removeClass('enable_time').hide(); $('#select_time_2').show().addClass('enable_time'); }
                            else { $('#select_time_1').addClass('enable_time').show(); $('#select_time_2').hide().removeClass('enable_time'); }
                        });
                    });
                </script>
                <div id="selectedMarker"></div>
                <div id='geocoder' class='geocoder'></div>
                <p id="samoviziv" style="display:none"></p>
                <button type="button" id="but_dev2" class="disabled-btn" style="border-radius:20px;width:100%; height:60px; margin-top:0.5rem; font-size:20px; background:#eee;color: #bcbcc3">Выбрать самовывоз</button>
            </div>
        </div>
    </div>
</div>

<style>
    .market_el p{ margin-bottom: 0px !important; }
    .market_el { display: flex; border-bottom: 1px solid #afafaf; align-items: baseline; margin-bottom: 14px; padding-bottom: 14px; }
    .mainblock_time1 { margin-left:auto; }
</style>
<!-- FIX: уникальные id магазинов -->
<div id="modal2" class="modal1">
    <div class="modal-content">
        <span id="close_list_market" class="close">&times;</span>
        <h2>Выбор магазина</h2>
        <h5 style="font-weight: bold;">Владивосток:</h5>
        <div id="market_egersheld" class="market_el">
            <p>Эгершельд, Верхнепортовая,68а</p>
            <div class="mainblock_time1 enable1" data-market="11"><div class="underblocktime1"><p class="delivery-text" style="margin-bottom:0px;">Выбрать</p></div></div>
        </div>
        <script>
            const closeButton2 = document.getElementById('close_list_market');
            const modal2 = document.getElementById('modal2');
            closeButton2.addEventListener('click', function() { modal2.style.display = 'none'; });
        </script>
        <div id="market_remicity" class="market_el">
            <p>Реми-Сити (ул. Народный пр-т, 20)</p>
            <div class="mainblock_time1 enable1" data-market="1"><div class="underblocktime1"><p class="delivery-text" style="margin-bottom:0px;">Выбрать</p></div></div>
        </div>
        <div id="market_zarya" class="market_el">
            <p>Заря (ул. Чкалова, 30)</p>
            <div class="mainblock_time1 enable1" data-market="6"><div class="underblocktime1"><p class="delivery-text" style="margin-bottom:0px;">Выбрать</p></div></div>
        </div>
        <div id="market_more" class="market_el">
            <p>ТЦ «Море», Гипермаркет (ул. Некрасовская, 49а)</p>
            <div class="mainblock_time1 enable1" data-market="2"><div class="underblocktime1"><p class="delivery-text" style="margin-bottom:0px;">Выбрать</p></div></div>
        </div>
        <div id="market_sputnik" class="market_el">
            <p>ул. Тимирязева,31 строение 1 (район Спутник)</p>
            <div class="mainblock_time1 enable1" data-market="3"><div class="underblocktime1"><p class="delivery-text" style="margin-bottom:0px;">Выбрать</p></div></div>
        </div>
    </div>
</div>
<style>@media (max-width:500px) { .first_part_time { width:40% !important; } }</style>

<script>
    ymaps.ready(init);
    function init() {
        var map2 = new ymaps.Map('map2', { center: [43.1798, 131.8869], zoom: 10, controls: ['zoomControl'] });
        var suggestView = new ymaps.SuggestView('suggest');
        suggestView.events.add('select', function (e) { ymaps.geocode(e.get('item').value).then(function (res) { map2.setCenter(res.geoObjects.get(0).geometry.getCoordinates(), 16); }); });
        suggestView.events.add('suggest', function (e) {
            var d = e.get('suggestData'), l = document.getElementById('suggest-list');
            while (l.firstChild) l.removeChild(l.firstChild);
            for (var i = 0; i < d.length; i++) { var li = document.createElement('li'); li.textContent = d[i].displayName; l.appendChild(li); }
        });

        var myPlacemark11 = new ymaps.Placemark([43.09968, 131.863907], { hintContent: 'Эгершельд, Верхнепортовая,68а' }, { balloonContentLayout: null });
        var myPlacemark1 = new ymaps.Placemark([43.128381, 131.919746], { hintContent: 'Реми-Сити (ул. Народный пр-т, 20)' }, { balloonContentLayout: null });
        var myPlacemark2 = new ymaps.Placemark([43.127427, 131.909317], { hintContent: 'ТЦ «Море», Гипермаркет (ул. Некрасовская, 49а)' }, { balloonContentLayout: null });
        var myPlacemark3 = new ymaps.Placemark([43.24827778336888, 132.02109573106299], { hintContent: 'ул. Тимирязева,31 строение 1 (район Спутник)' }, { balloonContentLayout: null });
        var myPlacemark6 = new ymaps.Placemark([43.181235883133674, 131.9154298472213], { hintContent: 'Заря (Чкалова, 30)' }, { balloonContentLayout: null });

        var myGroup = new ymaps.GeoObjectCollection({}, { draggable: false, preset: 'islands#blueIcon', iconColor: '#3caa3c' });
        myGroup.add(myPlacemark11).add(myPlacemark1).add(myPlacemark2).add(myPlacemark3).add(myPlacemark6);
        map2.geoObjects.add(myGroup);

        myGroup.events.add('click', function (e) {
            var target = e.get('target');
            ymaps.geocode(target.geometry.getCoordinates()).then(function (res) {
                var addr = document.getElementById('suggest'); if (addr) addr.value = res.geoObjects.get(0).getAddressLine();
                myGroup.each(function (el) { el.options.set('iconColor', '#3caa3c'); });
                target.options.set('iconColor', '#ff0000');
                document.getElementById('samoviziv').innerHTML = target.properties.get('hintContent');
                document.getElementById('but_dev2').classList.remove('disabled-btn');
                document.getElementById('but_dev2').classList.add('enable-dev');
            });
        });

        /* FIX: маппинг data-market → placemark, убраны myPlacemark4/5 */
        var placemarkMap = { '11': myPlacemark11, '1': myPlacemark1, '2': myPlacemark2, '3': myPlacemark3, '6': myPlacemark6 };

        document.querySelectorAll('.mainblock_time1').forEach(function(button) {
            button.addEventListener('click', function() {
                var dm = button.getAttribute('data-market');
                myGroup.each(function (el) { el.options.set('iconColor', '#3caa3c'); });
                var pm = placemarkMap[dm];
                if (pm) {
                    pm.options.set('iconColor', '#ff0000');
                    document.getElementById('samoviziv').innerHTML = pm.properties.get('hintContent');
                    ymaps.geocode(pm.geometry.getCoordinates()).then(function (res) { document.getElementById('suggest').value = res.geoObjects.get(0).getAddressLine(); });
                    map2.setCenter(pm.geometry.getCoordinates()); map2.setZoom(15);
                }
                document.getElementById('but_dev2').classList.remove('disabled-btn');
                document.getElementById('but_dev2').classList.add('enable-dev');
                document.getElementById('modal2').style.display = 'none';
            });
        });
    }
</script>

<style>
    .open-modal1, .open-modal2 { background-color: green; color: white; width:100%; max-width:347px; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; }
    .modal1, .modal2 { display: none; position: fixed; z-index: 11111111111; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.4); }
    #map, #map2, #time_change, #flex_time, .mainblock_time, .tab-content1.active1 #map, .tab-content1.active1 #map2 { display: none !important; visibility: hidden !important; height: 0 !important; width: 0 !important; opacity: 0 !important; position: absolute !important; left: -9999px !important; }
    .tab-content1 #map, .tab-content1 #map2 { display: none !important; }
    .modal-content1, .modal-content2, .modal-content { background-color: white; margin: 10% auto; margin-top:2% !important; padding: 20px; padding-bottom: 0px; border-radius: 5px; min-width: 300px; max-width: 700px; position: relative; }
    .close-modal1, .close-modal2, .close { position: absolute; top: 10px; right: 10px; font-size: 30px; font-weight: bold; cursor: pointer; }
    .tab-container1 { margin-top: 5px; }
    .tab-button1 { background-color: lightgreen; color: white; border: none; padding: 10px 20px; width: 49%; font-size: 17px; border-top-left-radius: 5px; border-top-right-radius: 5px; cursor: pointer; }
    .tab-button1.active1 { background-color: green; }
    .tab-content1 { display: none; padding: 20px; padding-top:5px; }
    .tab-content1.active1 { display: block; }
    @media (max-width: 500px) { .tab-content1 { padding:5px; } }
</style>

<script>
    /* FIX: защита от null при чтении .enable */
    const updateAddressButton = document.getElementById('but_dev');
    updateAddressButton.addEventListener('click', () => {
        var element = document.querySelector('.mainblock_time.enable');
        var count = '', time = '', delivery_day = '', delivery_time = '';
        if (element) {
            count = element.getAttribute('data-count') || '';
            time = element.getAttribute('data-time') || '';
            delivery_day = element.getAttribute('data-day') || '';
            delivery_time = element.getAttribute('data-time') || '';
        }
        const comment = document.getElementById('comment_cur').value;
        const comment1 = document.getElementById('comment_cur1').value;
        $.ajax({
            type: 'POST', url: 'https://ferma-dv.ru/wp-admin/admin-ajax.php',
            data: { action: 'update_user_address', address: {
                    'billing_delivery': document.getElementById('infodev').innerHTML,
                    'billing_comment': comment, 'billing_comment_zakaz': comment1,
                    'time_type': count, 'coords': document.getElementById('status_delivery').innerHTML,
                    'time': time, 'delivery_day': delivery_day, 'delivery_time': delivery_time
                }},
            success: function() { window.location.reload(); },
            error: function(xhr, status, error) { console.log(error); }
        });
    });
</script>
<p id="data_of_samoviviz" style="display:none;"><?echo $_COOKIE['data_of_samoviviz'];?></p>
<script>document.getElementById('list_market').addEventListener('click', () => { document.getElementById('modal2').style.display = 'block'; });</script>
<script>
    const updateAddressButton1 = document.getElementById('but_dev2');
    updateAddressButton1.addEventListener('click', () => {
        var sel = document.getElementById("id_select_time_samoviviz");
        var result_data = sel.options[sel.selectedIndex].innerHTML + ', ' + $('.enable_time').val();
        $.ajax({
            type: 'POST', url: 'https://ferma-dv.ru/wp-admin/admin-ajax.php',
            data: { action: 'update_user_address1', address: { 'billing_samoviziv': document.getElementById('samoviziv').innerHTML, 'data_of': result_data } },
            success: function() { window.location.reload(); },
            error: function(xhr, status, error) { console.log(error); }
        });
    });
</script>
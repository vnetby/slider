<?php

/**
 * vnet-theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package vnet-theme
 */


if (!class_exists('acf')) {
  $l = dirname(__FILE__) . ' => ::' . __LINE__ . ' => please, install ACF plugin';
  alert($l);
  return;
}


require(dirname(__FILE__) . '/includes/global_vars.php');

require(THEME_PATH . 'extensions/install.php');

require(THEME_PATH . 'admin/functions.php');


add_action('after_setup_theme', 'vnet_theme_setup');

add_action('after_setup_theme', 'vnet_theme_content_width', 0);

add_action('widgets_init', 'vnet_theme_widgets_init');

add_action('init', 'edit_post_supports', 50);

add_filter('get_avatar_url', 'change_root_avatar', 10, 3);

add_action('wp_enqueue_scripts', 'register_jquery');

add_action('nav_menu_css_class', 'add_current_nav_class', 10, 2);

add_filter('upload_mimes', 'cc_mime_types');

add_action('admin_head', 'add_back_dates_var');

add_action('wp_head', 'add_back_dates_var');

add_action('init', 'vnet_remove_post_type_supports');


function vnet_remove_post_type_supports()
{
  remove_post_type_support('page', 'editor');
}










function cc_mime_types($mimes)
{
  $mimes['svg'] = 'file';
  return $mimes;
}




function add_back_dates_var()
{
  // print_r ('asdasdasdas');
  $user = false;

  if (is_user_logged_in()) {
    $user = wp_get_current_user();
    if ($user) {
      $user = json_encode($user, JSON_UNESCAPED_UNICODE);
    }
  }
?>


  <script>
    var responsive = {
      mobile: 768,
      tablet: 1200
    }

    var woof_lang = {
      'orderby': "",
      'date': "по дате",
      'perpage': "per page",
      'pricerange': "цена",
      'menu_order': "исходная сортировка",
      'popularity': "по популярности",
      'rating': "по рейтингу",
      'price': "по возрастанию цены",
      'price-desc': "по убыванию цены"
    };

    var woof_lang_loading = "Поиск ...";

    var back_dates = {
      'ajax_url': '<?= admin_url("admin-ajax.php"); ?>',
      'SRC': '<?= CURRENT_SRC; ?>',
      'url': '<?= get_site_url(); ?>',
      'catalog': '<?= get_permalink(get_page_by_path('shop')); ?>',
      'block_post': '<?= defined('BLOCKS_POST') ? BLOCKS_POST : false; ?>',
      'about_post': '<?= defined('ABOUT_POST') ? ABOUT_POST : false; ?>',
      'user': '<?= $user; ?>'
    };
  </script>

<?php
}



function add_current_nav_class($classes, $item)
{
  return $classes;
  if (is_product_category()) {

    $object  = get_queried_object();

    $_id     = $object->term_id;

    $shop_id = get_option('woocommerce_shop_page_id');

    if ($shop_id === $item->object_id) {

      $classes[] = 'current-menu-item';
    }
  } else {

    if (is_single()) {

      global $post;

      $_id = $post->ID;

      $current_post_type      = get_post_type_object(get_post_type($_id));

      $current_post_type_slug = $current_post_type->rewrite['slug'];

      $menu_slug              = strtolower(trim($item->url));

      if (strpos($menu_slug, $current_post_type_slug) !== false) {

        $classes[] = 'current-menu-item';
      }
    }
  }

  return $classes;
}






function change_set_search_box($s_options)
{
  // $s_options['defaultsearchtext']   = 'Поиск ...';
  $s_options['showmoreresultstext'] = 'Еще ...';
  $s_options['noresultstext']       = 'Нет результатов!';
  $s_options['didyoumeantext']      = 'Возможно Вы искали:';
  return $s_options;
}








function register_jquery()
{
  wp_deregister_script('jquery');
  wp_register_script('jquery', SRC . 'assets/jquery3/jquery3.min.js');
  wp_enqueue_script('jquery');
}





function save_var($var, $path, $overwrite = false)
{
  $check = false;
  if (!$overwrite) {
    if (!file_exists($path)) {
      $check = true;
    }
  } else {
    $check = true;
  }

  if ($check) {
    $json = json_encode($var, JSON_PRETTY_PRINT);
    $file = fopen($path, 'w');
    fwrite($file, $json);
    fclose($file);
    return true;
  }
  return false;
}




function var_console(&$item)
{
?>
  <div class="block-var-display" id="blockVarDisplay" style="display: none;">
    <?php
    echo json_encode($item);
    ?>
  </div>
  <script>
    {
      let block = document.querySelector('#blockVarDisplay');
      if (block) {
        let content = block.textContent;
        if (content) {
          console.log(JSON.parse(content));
        }
        block.parentNode.removeChild(block);
      }
    }
  </script>
<?php
}




function change_root_avatar($url, $id_or_email, $args)
{
  if (gettype($id_or_email) === 'string' || gettype($id_or_email) === 'integer') {
    if ($id_or_email == 1) {
      return SRC . 'img/root-avatar.jpg';
    }
  }

  if (gettype($id_or_email) === 'object') {
    if ($id_or_email->user_id == 1) {
      return SRC . 'img/root-avatar.jpg';
    }
  }
  return $url;
}



function edit_post_supports()
{
  remove_post_type_support('page', 'excerpt');
  remove_post_type_support('page', 'author');
  remove_post_type_support('page', 'revisions');
  remove_post_type_support('page', 'trackbacks');
  remove_post_type_support('page', 'post-formats');
  register_taxonomy_for_object_type('post_tag', 'page');
  // register_taxonomy_for_object_type ( 'category', 'news' );
}










if (!function_exists('vnet_theme_setup')) {


  function vnet_theme_setup()
  {


    load_theme_textdomain('vnet_theme', THEME_PATH . 'languages');


    add_theme_support('automatic-feed-links');


    add_theme_support('menus');


    add_theme_support('title-tag');


    add_theme_support('post-thumbnails');


    register_nav_menus(

      array(

        'top_menu'     => 'Главное меню',

        'foot_menu'    => 'Меню в подвале'

      )

    );


    add_theme_support('html5', array(

      'search-form',

      'comment-form',

      'comment-list',

      'gallery',

      'caption',

    ));


    add_theme_support('custom-background', apply_filters('vnet_theme_custom_background_args', array(

      'default-color' => 'ffffff',

      'default-image' => '',

    )));


    add_theme_support('customize-selective-refresh-widgets');


    add_theme_support('custom-logo', array(

      'height'      => 250,

      'width'       => 250,

      'flex-width'  => true,

      'flex-height' => true,

    ));




    add_theme_support('woocommerce');

    add_theme_support('wc-product-gallery-zoom');

    add_theme_support('wc-product-gallery-lightbox');

    add_theme_support('wc-product-gallery-slider');
  }
}




function vnet_theme_content_width()
{

  $GLOBALS['content_width'] = apply_filters('vnet_theme_content_width', 640);
}



function vnet_theme_widgets_init()
{

  register_sidebar(array(

    'name'          => esc_html__('Меню каталог продукции', 'vnet_theme'),

    'id'            => 'top_menu_catalog',

    'description'   => esc_html__('Добавьте сюда каталог.', 'vnet_theme'),

    'before_widget' => '<div class="wc-cat-sidebar">',

    'after_widget'  => '</div>',

    'before_title'  => '<h2 class="widget-title">',

    'after_title'   => '</h2>',

  ));


  register_sidebar(array(

    'name'          => esc_html__('Сайдбар в калалоге', 'vnet_theme'),

    'id'            => 'catalog_sidebar',

    'description'   => esc_html__('Добавьте сюда элементы.', 'vnet_theme'),

    'before_widget' => '<div class="wc-cat-sidebar">',

    'after_widget'  => '</div>',

    'before_title'  => '<h2 class="widget-title">',

    'after_title'   => '</h2>',

  ));
}








function _echo($item)
{
  if (gettype($item) === 'array' || gettype($item) === 'object') {

    if (gettype($item) === 'array') echo 'Array:<br><br>';

    if (gettype($item) === 'object') echo 'Object:<br><br>';

    foreach ($item as $key => $str) {
      echo $key . ' => ';
      print_r($str);
      echo '<hr>';
    }
    return;
  }
  print_r($item);
  echo '<hr>';
}





function strip_text($post, $num)
{
  if ($num > 0) {
    $post = strip_tags($post);
    $ex_post = explode(' ', $post);
    if (count($ex_post) > $num) {
      $max = $num;
    } else {
      $max = count($ex_post);
    }
    $res = '';
    for ($i = 0; $i < $max; $i++) {
      $res .= $ex_post[$i] . ' ';
    }
    if ($max === $num) {
      return $res . '...';
    } else {
      return $res;
    }
  } else {
    return $post;
  }
}








function random_str($length = 10)
{
  $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}






function vn_translit($s)
{
  $s = (string) $s; // преобразуем в строковое значение
  $s = strip_tags($s); // убираем HTML-теги
  $s = str_replace(array("\n", "\r"), " ", $s); // убираем перевод каретки
  $s = preg_replace("/\s+/", ' ', $s); // удаляем повторяющие пробелы
  $s = trim($s); // убираем пробелы в начале и конце строки
  $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); // переводим строку в нижний регистр (иногда надо задать локаль)
  $s = strtr($s, array('а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'e', 'ж' => 'j', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shch', 'ы' => 'y', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya', 'ъ' => '', 'ь' => ''));
  $s = preg_replace("/[^0-9a-z-_ ]/i", "", $s); // очищаем строку от недопустимых символов
  $s = str_replace(" ", "-", $s); // заменяем пробелы знаком минус
  return $s; // возвращаем результат
}






function print_filters_for($hook = '')
{
  global $wp_filter;
  if (empty($hook) || !isset($wp_filter[$hook]))
    return;
  print '<pre>';
  print_r($wp_filter[$hook]);
  print '</pre>';
}








function hr($str = '')
{
  print_r($str);
  echo '<hr>';
}

function br()
{
  echo '<br>';
}

function rn()
{
  echo "\r\n";
}






function array_shift_before(&$arr, $beforeIndex, $val)
{
  $before = array_slice($arr, 0, $beforeIndex);
  $after  = array_slice($arr, $beforeIndex);
  array_push($before, $val);
  $arr = array_merge($before, $after);
}





function alert(&$var)
{
  $id = random_str();
?>
  <div id="<?= $id; ?>">
    <?php
    print_r($var);
    ?>
  </div>
  <script>
    let div = document.querySelector('#' + '<?= $id; ?>');
    alert(div.textContent);
  </script>
<?php
}






function get_from_array(&$arr, $key, $def = false)
{
  if (!isset($arr[$key])) return $def;
  if (!$arr[$key]) return $def;
  return $arr[$key];
}






function strip_tag($str, $tag)
{
  $str = preg_replace("/<[\w]*" . $tag . "[^>]*>/", '', $str);
  $str = preg_replace("/<[\w]*\/[\w]*" . $tag . "[\w]*>/", '', $str);
  return $str;
}



function strip_editor($str = false)
{
  if (!$str) return false;
  $str = preg_replace("/<[\w]*p[^>]*>/", '', $str);
  $str = preg_replace("/<[\w]*\/[\w]*p[\w]*>/", '<br>', $str);
  $str = preg_replace("/(<br>)(?!.*\1)/su", '', $str);
  return $str;
}





function get_acf_img_src($img = false)
{
  if (!$img) return false;
  if (is_string($img)) return $img;
  if (is_array($img)) {
    if (isset($img['url'])) return $img['url'];
  }
  return false;
}



function vnet_get_template($name)
{
  $path = CURRENT_PATH . 'template-parts/' . $name . '.php';
  if (!file_exists($path) ) {
    ?>
    <span style="color: brown; font-weight: bold">[template]</span><?= $path; ?><span style="color: brown; font-weight: bold">[/template]</span>
    <?php
    return;
  }
  require($path);
}


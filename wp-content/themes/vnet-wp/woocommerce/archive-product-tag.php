<?php
global $wpdb;
global $wp_query;

$object = get_queried_object();

$term_id     = $object->term_id;


the_page_header();
?>

<section class="section loop-terms-section light-bg">
  <div class="container-fluid">
    <?php
    if ( is_supplier() ) {
      ?>
      <div class="row">
        <?php
        $parent_cats = get_cats_by_supplier( $object->term_taxonomy_id );

        foreach ( $parent_cats as &$cat ) {
          $name = $cat->name;
          $link = vnet_add_to_link( $cat->slug );
          ?>
          <div class="col-xl-3 cat-col">
            <div class="cat">
              <h3 class="parent-cat-name">
                <a href="<?= $link; ?>" class="parent-cat-link">
                  <?= $name; ?>
                </a>
              </h3>
              <div class="childs">
                <?php
                $childs = get_cats_by_supplier( $object->term_taxonomy_id, $cat->term_id );
                if ( $childs ) {
                  foreach ( $childs as &$child ) {
                    $name = $child->name;
                    $link = vnet_add_to_link( [ $cat->slug, $child->slug ] );
                    $prods = get_products_supplier_cat($object->term_taxonomy_id, $child->term_taxonomy_id );
                    if ( $prods ) {
                      if ( count ( $prods ) === 1 ) {
                        $link = get_permalink( $prods[0] );
                      }
                    }
                    ?>
                    <div class="child-row">
                      <a href="<?= $link; ?>" class="child-link"><?= $name; ?></a>
                    </div>
                    <?php
                  }
                }
                ?>
              </div>
            </div>
          </div>
          <?php
        }
        ?>
      </div>
      <?php
    }

    if ( is_supplier_cat() ) {
      ?>
      <div class="row terms-row">
        <?php
        $supplier = $wp_query->supplier;


        if ( $object->parent ) {

          $prod_ids = get_products_supplier_cat( $supplier->term_taxonomy_id, $object->term_taxonomy_id );
          if ( $prod_ids ) {

            foreach ( $prod_ids as $prod_id ) {
              $prod  = get_post( $prod_id );
              $title = vnet_translate_str( $prod->post_title );
              $img   = get_the_post_thumbnail_url( $prod->ID, 'thumbnail' );
              $def_img = false;
              if ( !$img ) {
                $def_img = true;
                $img     = SRC . 'img/red_bg.jpg';
              }
              $link  = get_permalink ( $prod->ID );

              ?>
              <div class="col-xl-4 col-lg-6 col-md-6 supplier-prod-col">
                <div class="wrapper direction-hover like-link pointer" data-target=".next-link">
                  <?php
                  if ( $img ) {
                    ?>
                    <div class="bg-img hover-bg hover-dir-el <?= $def_img ? 'def-img' : ''; ?>">
                      <div class="img-lazy-load opacity" data-src="<?= $img; ?>" data-alt="<?= $title; ?>"></div>
                    </div>
                    <?php
                  }
                  ?>
                  <div class="content">

                    <h3 class="prod-title"><?= $title; ?></h3>
                    <a href="<?= $link; ?>" class="next-link"></a>
                  </div>
                </div>
              </div>
              <?php
            }
          }

        } else {
          $cats = get_cats_by_supplier( $supplier->term_taxonomy_id, $object->term_id );
          if ( $cats ) {
            foreach ( $cats as &$cat ) {
              $title   = $cat->name;
              $link    = vnet_add_to_link( $cat->slug );
              $img     = get_wc_term_img_url ( $cat->term_id );
              $def_img = false;
              if ( !$img ) {
                $def_img = true;
                $img     = SRC . 'img/red_bg.jpg';
              }
              $prods = get_products_supplier_cat( $supplier->term_taxonomy_id, $cat->term_taxonomy_id );

              if ( $prods ) {
                if ( count ( $prods ) === 1 ) {
                  $link = get_permalink( $prods[0] );
                }
              }
              ?>
              <div class="col-xl-4 col-lg-6 col-md-6 supplier-prod-col">
                <div class="wrapper direction-hover like-link pointer" data-target=".next-link">
                  <?php
                  if ( $img ) {
                    ?>
                    <div class="bg-img hover-bg hover-dir-el <?= $def_img ? 'def-img' : ''; ?>">
                      <div class="img-lazy-load opacity" data-src="<?= $img; ?>" data-alt="<?= $title; ?>"></div>
                    </div>
                    <?php
                  }
                  ?>
                  <div class="content">
                    <h3 class="prod-title"><?= $title; ?></h3>
                    <a href="<?= $link; ?>" class="next-link"></a>
                  </div>
                </div>
              </div>
              <?php
            }
          }
        }
        ?>
      </div>
      <?php
    }
    ?>
  </div>
</section>

<?php
the_block('contact_form');

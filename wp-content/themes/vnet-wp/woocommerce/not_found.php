<?php


$back_request = get_field ( 'block_back_request', BLOCKS_POST );

$form_id = $back_request['form_id'];



get_block ( 'block_back_request', [
    'title'      => vnet_translate('product_not_found'),
    'form_id'    => $form_id,
    'form_title' => vnet_translate('send_request_form_title')
  ] );

?>

<?php

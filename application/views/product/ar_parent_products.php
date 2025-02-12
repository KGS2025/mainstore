<?php 
/*
$product_id = $this->security->xss_clean($this->input->get_post('product_id'));
$type = $this->security->xss_clean($this->input->get_post('type'));
$element_number = $this->security->xss_clean($this->input->get_post('element_number'));

$product_number = $this->comman_model->get_data_by_id("products", array("id" => $product_id));
//echo "product_id: $product_id, type: $type, element_number: $element_number <br/>";

if ($type == "child") {
    $products = $this->product_model->getProductChild($product_id, $this->lang->default_lang_id);
} else {
    $products = $this->product_model->getProductParent($product_id, $this->lang->default_lang_id);
}
*/
// echo "product_id: $product_id, type: $type, element_number: $element_number <br/>";  print_r($products);        exit;
$products = json_decode(json_encode($products));

// this code  get data from database abd session which is required for view file
$userLangData = get_user_lang_data(array('cart_instruction', 'product_instruction', 'general_instruction'), $this->lang->default_lang_id);
$product_items = $this->product_items_model->getproductitems_data();
$product_model_items = $this->product_items_model->getproductitems_data("product_model");

$comingsoon = getNoImage('coming-soon');
$i = 1;

$parent_word = $userLangData['general_instruction']['parent_of'];

$result = "";

foreach ($products as $child) {
    $number = $element_number . "." . $i;
    $data['product'] = $child;
    $data['view_type'] = "0";
    $data['count'] = 0;
    if ($type == "child") {
        $data['child_open'] = 1;
    } else {
        $number = $parent_word . $product_number['kgt_ref_number'];
        $data['child_open'] = 2;
    }
    $data['i'] = $number;
    $data['product_instruction'] = (object) $userLangData['product_instruction'];
    $data['general_instruction'] = (object) $userLangData['general_instruction'];
    $data['product_items'] = $product_items;
    $data['product_model_items'] = $product_model_items;
    $data['searchItemValue'] = "";
    $data['comingsoon'] = $comingsoon;
    $data['colors'] = $this->comman_model->get_row_array('front_colors', '*', array('id' => 1))[0];
    $data['all_data'] = allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $this->lang->default_lang_id, 'home_page_country'));
    $this->load->view('product/product_element', $data);
    $i++;
}
?>
</div>

<?php

if (isset($addscripts) && $addscripts != '') {
    switch ($addscripts) {
        case 'add_model':
            ?>

            

            <?php
            break;
        case 'add_productmakers':
            ?>

            <?php
            break;
        case 'add_producttype':
            ?>

            <?php
            break;
        case 'add_product_category':
            ?>

            <?php
            break;
        case 'cart_list':
            ?>

            <?php
            break;
        case 'country_list':
            ?>

            <?php
            break;
        case 'edit_maker':
            ?>

            <?php
            break;
        case 'edit_producttype':
            ?>

            <?php
            break;
        case 'edit_product_category':
            ?>

            <?php
            break;
        case 'edit_product_model':
            ?>

            <?php
            break;
        case 'list_cart_details':
            ?>

            <?php
            break;
        case 'makers_list':
            ?>

            <?php
            break;
        case 'product_catagory_list':
            ?>

            <?php
            break;
        case 'product_list':
            ?>

            <?php
            break;
        case 'product_model_list':
            ?>

            <?php
            break;
        case 'product_type_list':
            ?>

            <?php
            break;
        case 'welcome_page_list':
            ?>

            <?php
            break;
        default: ?>
        <?php break;
    }
}?>

<?php $base_url = base_url(); ?>


<script>
    
    $(document).ready(function () {

        $('.edit_text').click(function () {
            $(this).hide();
            $(this).prev().hide();
            $(this).next().show();
            $(this).next().select();
        });

        $('.edit_input_text').focusout(function () {
            if ($.trim(this.value) == '') {
                this.value = (this.defaultValue ? this.defaultValue : '');
            } else {
                $(this).prev().prev().html(this.value);
            }
            $(this).hide();
            $(this).prev().show();
            $(this).prev().prev().show();
            var url = $(this).next().val();
            $.ajax({
                type: 'POST',
                url: url,
                data: {field_value: this.value},
                success: function (html) {
                }
            }); 
        });

        $('.edit_input_text').keypress(function (event) {
            if (event.keyCode == '13') {
                if ($.trim(this.value) == '') {
                    this.value = (this.defaultValue ? this.defaultValue : '');
                } else
                {
                    $(this).prev().prev().html(this.value);
                }
                $(this).hide();
                $(this).prev().show();
                $(this).prev().prev().show();
                var url = $(this).next().next().val();
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {field_value: this.value},
                    success: function (html) {
     
                    }
                }); 
            }
        });
        
        $(":file").filestyle({
            input: false,
            buttonText: "<?php echo $admin_static_links['choose_file']['front']; ?>"
        });
        $(".icon-span-filestyle").css("display", "none");
    });
</script>
</body>
</html>


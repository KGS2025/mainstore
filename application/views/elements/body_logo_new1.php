<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
<style>    
    [dir="rtl"] .slider {
        width: 100vw;
        margin-left: -3.5vw;
        left: 15px;
    }
    [dir="rtl"] .slick-arrow{
        display: none !important;
    }
    [dir="ltr"] .slider {
        width: 100vw;
        margin-left: -3.5vw;
    }
    .slider img {
        width: 100%;
        height: auto;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px;
    }
    .slick-prev,
    .slick-next {
        font-size: 24px;
        line-height: 1;
        color: #007185;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 1;
    }
    .slick-prev {
        left: 10px;
        color: transparent;
    }
    .slick-next {
        right: 10px;
        color: transparent;
    }
    .slick-dots {
        position: absolute;
        bottom: 10px;
        width: 100%;
        text-align: center;
    }
    .slick-dots li {
        display: inline-block;
        margin: 0 5px;
    }
    .slick-dots li button {
        font-size: 0;
        line-height: 0;
        display: block;
        width: 10px;
        height: 10px;
        padding: 5px;
        border: 1px solid #999;
        border-radius: 50%;
        background: #fff;
        cursor: pointer;
        outline: none;
    }
    .slick-dots li.slick-active button {
        background: #007185;
    }    
    @media screen and (min-width: 1200px) {
        .productbaselisting {
            top: -430px;
            position: relative;
        }
        .product-list {
            margin-bottom: -430px;
        }
        [dir="rtl"] .slider {
            width: 100vw;
            margin-left: -3vw;
            left: 48px;
        }
    }
    .slick-prev:before, .slick-next:before {
        content: "";
    }
    .slick-prev:after, .slick-next:after {
        color: #A19F9F!important;
    }
    .slider div {
        position: relative;
        text-align: center;
    }

    .description {
        position: absolute;
        /* bottom: 900px; */
        left: 50%;
        transform: translateX(-50%);
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        padding: 10px;
        border-radius: 5px;
    }

    .button-container {
        position: absolute;
        /* bottom: 900px; */
        left: 50%;
        transform: translateX(-50%);
        margin-top: 15px;

    }

    .overlay {
        position: absolute !important;
        top: 5%;
        left: 0;
        width: 100%;
        text-align: center;
        padding: 10px;
    }

</style>
<?php if(count($banner_images)>0){ ?>
<div class="slider">
    <?php foreach($banner_images as $b_image){?>
        <div>
            <img src="<?php echo base_url();?>assets/uploads/banner_images/<?php echo $b_image['banner_image'];?>" alt="<?php echo $b_image['banner_image'];?>">
            <div class="overlay">
                <?php if($b_image['desc_text']){?>
                    <div class="description">
                        <?php echo $b_image['desc_text']; ?>
                    </div>
                <?php }?>
                <?php if($b_image['button_url']){?>
                    <div class="button-container">
                        <a href="<?php echo $b_image['button_url']; ?>" class="btn2 cart_submit_btn_color rounded" target="_blank"><?php echo $b_image['button_text'];?></a>
                    </div>
                <?php }?>
            </div>
        </div>    
    <?php }?>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script>
    var $j = jQuery.noConflict();
    $j(document).ready(function(){
        $j('.slider').slick({
            autoplay: true,
            autoplaySpeed: 5000,
            arrows: true,
            dots: false,
            infinite: true,
            speed: 500,
            fade: true,
            cssEase: 'ease-out',
            slidesToShow: 1,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        arrows: false,
                    }
                }
            ]
        });
    });
</script>
<?php }?>

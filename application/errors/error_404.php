<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>404 Page Not Found</title>
   <style>
   html {
     position: relative;
     min-height:100vh;
   }
   body{
     width: 100%;
     height: 100%;
     background-color: #<?= $all_data['cart_productdisp_txt_color'];?>;
     color: white;
     font-family: sans-serif;
   }
   .errorBlock {
     position: absolute;
     width: 400px;
     height: 300px;
     z-index: 15;
     top: 45%;
     left: 50%;
     margin: -100px 0 0 -200px;
     text-align: center;
   }
   .errorBlock h1, .errorBlock h2{
     text-align: center;
   }
   .errorBlock h1{
     font-size: 60px;
     margin-bottom: 10px;
     border-bottom: 1px solid white;
     padding-bottom: 10px;
   }
   . errorBlockh2{
     margin-bottom: 40px;
   }
   .errorBlock a{
      text-decoration: none;
      padding: 15px 25px;
      background-color: #<?= $all_data['entry_pop_guest_text_color'];?>;
      color: #<?= $all_data['cart_productdisp_txt_color'];?>;
      margin-top: 20px;
      border-radius: 4px;
      display: inline-block;
   }
   </style>
 </head>
 <body>
   <div class="errorBlock">
     <h1>404</h1>
     <h2><?= $general_instruction->page_404_content;?></h2>
     <a class="btn rounded" href='<?= base_url(); ?>' ><?= $general_instruction->button_404_text;?></a>
   </div>
 </body>
</html>
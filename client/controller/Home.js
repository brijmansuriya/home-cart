$(document).ready(function(e){   

    // Load Category
    $('#CatagoryCard').html(Generator('GetCatagoryCard','client/controller/HomeController.php'));

    // Load Brands

    $('#brand_slider').html(Generator('GetBrandSliderContent','client/controller/HomeController.php'));
});
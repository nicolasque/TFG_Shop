window.onload = function() {
    ft_scroll_images();

};


function ft_scroll_images()
{
    $('.next').click(function()
    {
        var $currentGallery = $(this).parent('.image');
        var $currentImage = $currentGallery.find('.gallery-image:visible');
        var $nextImage = $currentImage.next('.gallery-image');
        //DEBUG
        console.log("HELLLO");
        if ($nextImage.length)
        {
            $currentImage.hide();
            $nextImage.show();
        }
        else
        {
            $currentImage.hide();
            $currentGallery.find('.gallery-image:first').show();
        }
    });

    $('.prev').click(function()
    {
        var $currentGallery = $(this).parent('.image');
        var $currentImage = $currentGallery.find('.gallery-image:visible');
        var $prevImage = $currentImage.prev('.gallery-image');
        if ($prevImage.length)
        {
            $currentImage.hide();
            $prevImage.show();
        }
        else
        {
            $currentImage.hide();
            $currentGallery.find('.gallery-image:last').show();
        }
    });
}


function ft_add_like($user_id, $product_id)
{
    console.log("add like");
    var $like = $(this);
    var $data = {'product_id': $product_id,
                'user_id' : $user_id };
    $.ajax({
        type: 'POST',
        url: '/tfg_shop/php/ajax/add_like.php',
        data: $data,
        success: function(data)
        {
            console.log(data);
            $like.html(data);
            location.reload();
        }

        
    });
}

function ft_remove_like($user_id, $product_id)
{
    console.log("remove like");
    var $like = $(this);
    var $data = {'product_id': $product_id,
                'user_id' : $user_id };
    $.ajax({
        type: 'POST',
        url: '/tfg_shop/php/ajax/remove_like.php',
        data: $data,
        success: function(data)
        {
            console.log(data);
            $like.html(data);
            location.reload();

        }

        
    });
}
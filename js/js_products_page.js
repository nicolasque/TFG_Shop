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
        console.log("HELLL");
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
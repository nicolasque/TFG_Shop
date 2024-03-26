window.onload = function() {
    ft_scroll_images();
};

function ft_scroll_images()
{
    var galleries = document.getElementsByClassName('image-gallery');
    for (var i = 0; i < galleries.length; i++)
    {
        var images = galleries[i].getElementsByTagName('img');
        var index = 0;

        galleries[i].getElementsByClassName('prev')[0].onclick = function()
        {
            images[index].style.display = 'none';
            index = (index - 1 + images.length) % images.length;
            images[index].style.display = 'block';
        };

        galleries[i].getElementsByClassName('next')[0].onclick = function()
        {
            images[index].style.display = 'none';
            index = (index + 1) % images.length;
            images[index].style.display = 'block';
        };
    }
}
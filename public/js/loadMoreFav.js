var parentFav = document.querySelector('div.displayFav'),
    itemsFav = parentFav.querySelectorAll('div.itemFav'),
    loadMoreFav = document.querySelector('#load-more-favs'),
    maxItems = 6,
    hiddenClassFav = "visually-hidden-fav";


[].forEach.call(itemsFav, function (itemFav, index) {
    if (index > maxItems - 1) {
        itemFav.classList.add(hiddenClassFav);
    }
});

loadMoreFav.addEventListener('click', function () {
    [].forEach.call(document.querySelectorAll('.' + hiddenClassFav), function (itemFav, index) {
        console.log(itemFav);
        if (index < maxItems) {
            itemFav.classList.remove(hiddenClassFav);
        }

        if (document.querySelectorAll('.' + hiddenClassFav).length === 0) {
            loadMoreFav.style.display = 'none';
        }
    });
});
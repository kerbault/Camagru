var parent = document.querySelector('div.display'),
    items = parent.querySelectorAll('div.item'),
    loadMorePost = document.querySelector('#load-more-posts'),
    maxItems = 6,
    hiddenClass = "visually-hidden";


[].forEach.call(items, function (item, index) {
    if (index > maxItems - 1) {
        item.classList.add(hiddenClass);
    }
});

loadMorePost.addEventListener('click', function () {
    [].forEach.call(document.querySelectorAll('.' + hiddenClass), function (item, index) {
        console.log(item);
        if (index < maxItems) {
            item.classList.remove(hiddenClass);
        }

        if (document.querySelectorAll('.' + hiddenClass).length === 0) {
            loadMorePost.style.display = 'none';
        }
    });
});
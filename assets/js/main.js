$(document).ready(function () {
    //search
    $('#search').on('keyup', function () {
        var filter = $(this).val().toLowerCase();
        var results = document.getElementById('search-container');
        var items = results.getElementsByClassName('search-item');
        var i, j, matched;
        for (i = 0; i < items.length; i++) {
            matched = false;
            var p = items[i].getElementsByTagName('p');
            for (j = 0; j < p.length; j++) {
                if (p[j].innerHTML.toLowerCase().indexOf(filter) > -1) {
                    matched = true;
                    break;
                }
            }
            if (matched) {
                items[i].style.display = '';
            } else {
                items[i].style.display = 'none';
            }
        }
    });
});
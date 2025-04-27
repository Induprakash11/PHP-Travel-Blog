document.addEventListener("DOMContentLoaded", function() {
    var loadingBar = document.getElementById('loading-bar');
    if (!loadingBar) return;

    loadingBar.style.width = '0%';
    loadingBar.style.display = 'block';

    var width = 0;
    var direction = 1; // 1 for increasing, -1 for decreasing

    var interval = setInterval(function() {
        width += direction * 2;
        if (width >= 100) {
            width = 100;
            direction = -1;
        } else if (width <= 30) {
            direction = 1;
        }
        loadingBar.style.width = width + '%';
    }, 30);

    window.addEventListener('load', function() {
        clearInterval(interval);
        loadingBar.style.width = '100%';

        setTimeout(function() {
            loadingBar.style.display = 'none';
            loadingBar.style.width = '0%';
            }, 400);
        });
    });

document.addEventListener('DOMContentLoaded', function () {
    const shareBtn = document.getElementById('shareBtn');
    const copyUrlBtn = document.getElementById('copyUrlBtn');
    const copyMessage = document.getElementById('copyMessage');

    // Get current page URL
    const currentUrl = window.location.href;

    // Share button click handler
    shareBtn.addEventListener('click', function () {
        if (navigator.share) {
            navigator.share({
                title: document.title,
                url: currentUrl
            }).catch((error) => {
                alert('Error sharing: ' + error);
            });
        } else {
            alert('Web Share API is not supported in your browser. Please use the Copy URL button.');
        }
    });

    // Copy URL button click handler
    copyUrlBtn.addEventListener('click', function () {
        if (navigator.clipboard) {
            navigator.clipboard.writeText(currentUrl).then(() => {
                copyMessage.style.display = 'block';
                setTimeout(() => {
                    copyMessage.style.display = 'none';
                }, 2000);
            }).catch(() => {
                alert('Failed to copy URL. Please copy manually.');
            });
        } else {
            // Fallback for older browsers
            const textArea = document.createElement('textarea');
            textArea.value = currentUrl;
            document.body.appendChild(textArea);
            textArea.select();
            try {
                document.execCommand('copy');
                copyMessage.style.display = 'block';
                setTimeout(() => {
                    copyMessage.style.display = 'none';
                }, 2000);
            } catch (err) {
                alert('Failed to copy URL. Please copy manually.');
            }
            document.body.removeChild(textArea);
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const likeCheckboxes = document.querySelectorAll('.like-checkbox');

    likeCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const blogId = this.getAttribute('data-blog-id');
            const userId = this.getAttribute('data-user-id');
            const liked = this.checked ? 1 : 0;

            if (!userId) {
                alert('You must be logged in to like a blog post.');
                this.checked = !this.checked; // revert checkbox state
                return;
            }

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '/Travel Blog/models/like_blog.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        try {
                            const response = JSON.parse(xhr.responseText);
                            if (response.success) {
                                const likeCountSpan = checkbox.parentElement.parentElement.querySelector('.like-count');
                                likeCountSpan.textContent = response.likeCount;
                            } else {
                                alert('Failed to update like status.');
                                checkbox.checked = !checkbox.checked; // revert checkbox state
                            }
                        } catch (e) {
                            alert('Error parsing server response.');
                            checkbox.checked = !checkbox.checked; // revert checkbox state
                        }
                    } else {
                        alert('Server error. Please try again later.');
                        checkbox.checked = !checkbox.checked; // revert checkbox state
                    }
                }
            };
            xhr.send('blog_id=' + encodeURIComponent(blogId) + '&user_id=' + encodeURIComponent(userId) + '&liked=' + liked);
        });
    });
});
<footer class="footer text-center py-3">
    <p>&copy <span id="year"></span> Travel Blog. All Rights Reserved.</p>
</footer>

<script>
    // this function is used to display the current year in the footer    
    document.getElementById('year').textContent = new Date().getFullYear();
</script>

<!-- AOS Animation Library -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
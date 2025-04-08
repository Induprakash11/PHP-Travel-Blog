<div class="container">
    <div class="animation">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <span>404 - PAGE NOT FOUND</span>
    <p>Oops! The page you're looking for doesn't exist.</p>
    <a href="/Travel Blog">Go Back Home</a>
</div>

<style>
    body {
        background-color: #f0f0f0;
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: start;
        position: relative;
        top: 100px;
        max-height: 80%;
        margin: 0;
        color: #333;
    }

    .container {
        text-align: center;
    }

    span {
        font-size: 3rem;
        font-weight: bold;
        margin: 0;
        color: #ff6b6b;
        animation: pulse 1.5s infinite;

    }

    p {
        font-size: 1.5rem;
        margin: 20px 0;
    }

    a {
        text-decoration: none;
        color: #fff;
        background-color: #007bff;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 1rem;
        transition: background-color 0.3s ease;
    }

    a:hover {
        background-color: #0056b3;
    }

    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }
    }

    .animation {
        margin: 40px auto;
        width: 60px;
        height: 60px;
        position: relative;
    }

    .animation div {
        position: absolute;
        width: 80%;
        height: 80%;
        border: 5px solid rgb(80, 158, 194);
        border-radius: 50%;
        animation: ripple 1.5s infinite;
    }

    .animation div:nth-child(2) {
        animation-delay: 1s;
    }

    .animation div:nth-child(3) {
        animation-delay: 2s;
    }

    @keyframes ripple {
        0% {
            transform: scale(0.3);
            opacity: 1;
        }

        100% {
            transform: scale(2);
            opacity: 0;
        }
    }
</style>
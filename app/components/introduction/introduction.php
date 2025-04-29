<style>
.hero-section {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 0 1rem;
    background: transparent;
    /* Ensure transparency for background animation */
    color: #fff;
}

.hero-title {
    font-size: 3rem;
    font-weight: 700;
    letter-spacing: -1px;
    line-height: 1.1;
    margin-bottom: 1.2rem;
}

.hero-gradient {
    background: linear-gradient(90deg, #ff8800 0%, #ff5722 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-subtitle {
    font-size: 1.4rem;
    color: #b0b0b0;
    margin-bottom: 2.5rem;
    font-weight: 400;
}

.hero-button {
    font-size: 1.1rem;
    padding: 0.75rem 2rem;
    border-radius: 0.5rem;
    font-weight: 600;
    background: linear-gradient(90deg, #ff8800, #ff5722);
    color: #fff;
    border: none;
    box-shadow: 0 2px 16px 0 rgba(255, 136, 0, 0.15);
    transition: background 0.2s, box-shadow 0.2s;
    text-decoration: none;
    display: inline-block;
}

.hero-button:hover {
    background: linear-gradient(90deg, #ff5722, #ff8800);
    color: #fff;
    box-shadow: 0 4px 24px 0 rgba(255, 136, 0, 0.25);
}

@media (min-width: 768px) {
    .hero-title {
        font-size: 4rem;
    }

    .hero-subtitle {
        font-size: 1.7rem;
    }
}
</style>
<section class="hero-section">
    <div class="container">
        <h1 class="hero-title">
            A better way to build <span class="hero-gradient">products</span>
        </h1>
        <p class="hero-subtitle">
            Streamline issues, sprints, and product roadmaps with a fast, modern interface.<br>
            Built for teams who care about speed and quality.
        </p>
        <a href="#" class="hero-button">Get Started</a>
    </div>
</section>
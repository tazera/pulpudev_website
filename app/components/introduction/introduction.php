<style>
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
    background: linear-gradient(90deg, #ff8800, #ff5722);
    color: #fff;
    border: none;
    font-weight: 600;
    padding: 0.6rem 1.5rem;
    border-radius: 0.5rem;
    box-shadow: 0 2px 16px 0 rgba(255, 136, 0, 0.15);
    transition: background 0.2s, box-shadow 0.2s;
}

.hero-button:hover {
    background: linear-gradient(90deg, #ff5722, #ff8800);
    color: #fff;
    box-shadow: 0 4px 24px 0 rgba(255, 136, 0, 0.25);
}
</style>
<section class="d-flex align-items-center justify-content-center text-center"
    style="min-height:45vh; background:transparent;">
    <div class="container py-5">
        <h1 class="display-4 fw-bold mb-3">
            A better way to build <span class="hero-gradient">products</span>
        </h1>
        <p class="hero-subtitle">
            Streamline issues, sprints, and product roadmaps with a fast, modern interface.<br>
            Built for teams who care about speed and quality.
        </p>
        <a href="#" class="btn hero-button">Get Started</a>
    </div>
</section>
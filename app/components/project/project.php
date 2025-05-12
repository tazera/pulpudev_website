<?php

/**
 * Projects Component
 * 
 * Displays project case studies in a responsive, card-based layout
 * with elegant styling inspired by Linear's design aesthetic.
 * 
 * @version 1.1
 * @author PulpuDev
 */
?>

<style>
    /**
     * Main section styling
     * Uses container width similar to contact section for consistency
     * and to keep background animation visible
     */
    .projects-section {
        padding: 6rem 0;
        background-color: transparent;
        /* Changed to transparent to show background animation */
        color: var(--bs-light);
        position: relative;
        z-index: 1;
    }

    /* Section heading typography */
    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        letter-spacing: -0.02em;
    }

    /* Section description styling */
    .section-subtitle {
        font-size: 1.2rem;
        color: #b0b0b0;
        margin-bottom: 3rem;
        font-weight: 400;
        max-width: 700px;
    }

    /* Project card styling with glass-morphism effect */
    .project-card {
        background-color: rgba(30, 30, 30, 0.7);
        /* Semi-transparent background */
        backdrop-filter: blur(10px);
        /* Glass effect */
        -webkit-backdrop-filter: blur(10px);
        /* Safari support */
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
        position: relative;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .project-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
    }

    /* Project image styling */
    .project-image {
        width: 100%;
        height: 220px;
        object-fit: cover;
        object-position: center;
        transition: transform 0.4s ease;
    }

    .project-card:hover .project-image {
        transform: scale(1.05);
    }

    /* Content area styling */
    .project-content {
        padding: 1.5rem;
    }

    /* Tag styling with gradient */
    .project-tag {
        display: inline-block;
        background: linear-gradient(90deg, rgba(255, 136, 0, 0.1) 0%, rgba(211, 61, 16, 0.1) 100%);
        color: #ff8800;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        margin-right: 0.5rem;
        margin-bottom: 0.5rem;
        transition: all 0.3s ease;
    }

    .project-tag:hover {
        background: linear-gradient(90deg, rgba(255, 136, 0, 0.2) 0%, rgba(211, 61, 16, 0.2) 100%);
        transform: translateY(-1px);
    }

    /* Project title styling */
    .project-title {
        font-size: 1.4rem;
        font-weight: 700;
        margin: 0.75rem 0;
        letter-spacing: -0.01em;
    }

    /* Project description styling */
    .project-description {
        font-size: 0.95rem;
        color: #b0b0b0;
        margin-bottom: 1rem;
        line-height: 1.6;
    }

    /* Section divider styling */
    .project-section {
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* Section title styling */
    .project-section-title {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #888;
        margin-bottom: 0.5rem;
        font-weight: 600;
    }

    /* Section content styling */
    .project-section-content {
        font-size: 0.95rem;
        line-height: 1.6;
    }

    /* Results section styling with subtle gradient */
    .project-result {
        background: linear-gradient(90deg, rgba(255, 136, 0, 0.05) 0%, rgba(211, 61, 16, 0.05) 100%);
        padding: 1rem;
        border-radius: 8px;
        margin-top: 1.5rem;
    }

    /* Metrics styling with gradient text */
    .result-metric {
        font-size: 1.8rem;
        font-weight: 700;
        background: linear-gradient(90deg, #ff8800 0%, #ff5722 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* CTA button styling */
    .project-cta-btn {
        background: linear-gradient(90deg, rgba(255, 136, 0, 0.1) 0%, rgba(211, 61, 16, 0.1) 100%);
        border: 1px solid rgba(255, 136, 0, 0.3);
        transition: all 0.3s ease;
    }

    .project-cta-btn:hover {
        background: linear-gradient(90deg, rgba(255, 136, 0, 0.2) 0%, rgba(211, 61, 16, 0.2) 100%);
        border: 1px solid rgba(255, 136, 0, 0.5);
        transform: translateY(-2px);
    }

    /* Using standard container class for consistency across the site */
    /* No custom container needed as we'll use Bootstrap's standard .container */

    /* Responsive adjustments */
    @media (max-width: 992px) {
        .projects-section {
            padding: 5rem 0;
        }

        .section-title {
            font-size: 2.2rem;
        }
    }

    @media (max-width: 768px) {
        .projects-section {
            padding: 4rem 0;
        }

        .project-card {
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 2rem;
        }

        .section-subtitle {
            font-size: 1.1rem;
        }
    }

    @media (max-width: 576px) {
        .projects-section {
            padding: 3rem 0;
        }

        .result-metric {
            font-size: 1.5rem;
        }
    }
</style>

<?php
/**
 * Project data structure
 * In a production environment, this would be fetched from a database
 */
$projects = [
    [
        'image' => '/images/projects/project1.png',
        'tags' => ['Web App', 'SaaS'],
        'title' => 'Enterprise Task Management System',
        'description' => 'A comprehensive task management platform for enterprise teams with real-time collaboration features.',
        'challenge' => 'The client needed to unify their task management across 12 departments with varying workflows and compliance requirements.',
        'solution' => 'We developed a flexible system with customizable workflows, role-based permissions, and detailed audit logs for compliance tracking.',
        'result' => 'Reduced task handoff time by 42% and improved cross-department visibility by implementing shared dashboards.',
        'metrics' => ['42% faster handoffs', '87% user adoption']
    ],
    [
        'image' => '/images/projects/project1.png',
        'tags' => ['Mobile', 'E-commerce'],
        'title' => 'Retail Mobile Shopping Experience',
        'description' => 'A sleek mobile application for a retail chain enabling personalized shopping experiences.',
        'challenge' => 'The retail chain was losing market share to competitors with better digital presence and needed a mobile-first approach.',
        'solution' => 'We created a native mobile app with AR product previews, personalized recommendations, and seamless checkout process.',
        'result' => 'The application achieved 230,000 downloads in the first quarter and increased mobile conversions by 28%.',
        'metrics' => ['230K downloads', '28% higher conversion']
    ],
    [
        'image' => '/images/projects/project1.png',
        'tags' => ['Data Analytics', 'Dashboard'],
        'title' => 'Healthcare Analytics Platform',
        'description' => 'Data visualization and analytics dashboard for healthcare providers tracking patient outcomes.',
        'challenge' => 'Healthcare providers struggled with disconnected data systems and lacked insights for improving patient care.',
        'solution' => 'We built a HIPAA-compliant analytics platform that unified patient data from multiple sources with customizable dashboards.',
        'result' => 'Enabled data-driven decisions that reduced average hospital stay duration by 1.5 days and improved resource allocation.',
        'metrics' => ['1.5 days shorter stays', '$2.4M annual savings']
    ]
];

/**
 * Display projects in a responsive grid layout
 * 
 * @param array $projects Array of project data
 * @return void
 */
function displayProjects($projects = null)
{
    // Use default projects if none provided
    if ($projects === null) {
        global $projects;
    }

    // Validate projects array
    if (!is_array($projects) || empty($projects)) {
        echo '<!-- No projects to display -->';
        return;
    }
?> <section class="projects-section" id="projects">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Our Work</h2>
                <p class="section-subtitle mx-auto">We've partnered with ambitious companies to build products that make a difference.
                    Here are some of our recent projects and the results they've achieved.</p>
            </div>
            <div class="row g-4">
                <?php foreach ($projects as $index => $project): ?>
                    <!-- Project card with staggered animation delay -->
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4" data-aos="fade-up" data-aos-delay="<?php echo 100 + ($index * 50); ?>">
                        <div class="project-card">
                            <?php if (isset($project['image']) && !empty($project['image'])): ?>
                                <!-- Project image with error fallback -->
                                <img src="<?php echo htmlspecialchars($project['image']); ?>"
                                    class="project-image"
                                    alt="<?php echo htmlspecialchars($project['title']); ?> Project"
                                    onerror="this.src='/images/projects/project1.png'">
                            <?php endif; ?>

                            <div class="project-content">
                                <!-- Project tags -->
                                <?php if (!empty($project['tags'])): ?>
                                    <div class="mb-3">
                                        <?php foreach ($project['tags'] as $tag): ?>
                                            <span class="project-tag"><?php echo htmlspecialchars($tag); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Project title and description -->
                                <h3 class="project-title"><?php echo htmlspecialchars($project['title']); ?></h3>
                                <p class="project-description"><?php echo htmlspecialchars($project['description']); ?></p>

                                <!-- Challenge section -->
                                <div class="project-section">
                                    <h4 class="project-section-title">Challenge</h4>
                                    <p class="project-section-content"><?php echo htmlspecialchars($project['challenge']); ?></p>
                                </div>

                                <!-- Solution section -->
                                <div class="project-section">
                                    <h4 class="project-section-title">Solution</h4>
                                    <p class="project-section-content"><?php echo htmlspecialchars($project['solution']); ?></p>
                                </div>

                                <!-- Results section with metrics -->
                                <div class="project-result">
                                    <h4 class="project-section-title">Results</h4>
                                    <p class="project-section-content"><?php echo htmlspecialchars($project['result']); ?></p>

                                    <?php if (!empty($project['metrics'])): ?>
                                        <div class="d-flex flex-wrap justify-content-between mt-3">
                                            <?php foreach ($project['metrics'] as $metric): ?>
                                                <div class="mb-2">
                                                    <div class="result-metric"><?php echo htmlspecialchars($metric); ?></div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Call to action -->
            <div class="text-center mt-5">
                <a href="#contact" class="btn btn-outline-light rounded-pill px-4 py-2 project-cta-btn">
                    Discuss your project with us
                </a>
            </div>
        </div>
    </section>
<?php
}

// Execute the function to display projects
displayProjects();
?>
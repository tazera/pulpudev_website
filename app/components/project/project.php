<?php

/**
 * Projects Component
 * 
 * Displays project case studies in a responsive, card-based layout
 * with elegant styling inspired by Linear's design aesthetic.
 * 
 * @version 1.2
 * @author PulpuDev
 */

// Get project data from component_functions.php if it was passed
$display_projects = isset($customProjects) && is_array($customProjects) && !empty($customProjects)
    ? $customProjects
    : [
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

        ]
    ];
?>


<link rel="stylesheet" href="/components/project/project.css">

<section class="projects-section" id="projects">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Our Work</h2>
            <p class="section-subtitle mx-auto">We've partnered with ambitious companies to build products that make a difference.
                Here are some of our recent projects and the results they've achieved.</p>
        </div>

        <?php if (is_array($display_projects) && !empty($display_projects)): ?>
            <div class="row g-4">
                <?php foreach ($display_projects as $index => $project): ?>
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
        <?php else: ?>
            <!-- No projects available message -->
            <div class="text-center py-5">
                <p>No projects to display at this time.</p>
            </div>
        <?php endif; ?>

    </div>
</section>
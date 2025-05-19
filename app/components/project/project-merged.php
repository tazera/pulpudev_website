<?php

/**
 * Projects Component (Merged Version)
 * 
 * Combines card-based layout with carousel functionality and modal details view.
 * 
 * @version 2.0
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
            'metrics' => ['42% faster handoffs', '87% user adoption'],
            'media' => ['/images/projects/project1.png', '/images/projects/project1.png']
        ],
        [
            'image' => '/images/projects/project1.png',
            'tags' => ['Mobile', 'E-commerce'],
            'title' => 'Retail Mobile Shopping Experience',
            'description' => 'A sleek mobile application for a retail chain enabling personalized shopping experiences.',
            'challenge' => 'The retail chain was losing market share to competitors with better digital presence and needed a mobile-first approach.',
            'solution' => 'We created a native mobile app with AR product previews, personalized recommendations, and seamless checkout process.',
            'result' => 'The application achieved 230,000 downloads in the first quarter and increased mobile conversions by 28%.',
            'metrics' => ['230K downloads', '28% higher conversion'],
            'media' => ['/images/projects/project1.png', '/images/projects/project1.png']
        ],
        [
            'image' => '/images/projects/project1.png',
            'tags' => ['Data Analytics', 'Dashboard'],
            'title' => 'Healthcare Analytics Platform',
            'description' => 'Data visualization and analytics dashboard for healthcare providers tracking patient outcomes.',
            'challenge' => 'Healthcare providers struggled with disconnected data systems and lacked insights for improving patient care.',
            'solution' => 'We built a HIPAA-compliant analytics platform that unified patient data from multiple sources with customizable dashboards.',
            'result' => 'Enabled data-driven decisions that reduced average hospital stay duration by 1.5 days and improved resource allocation.',
            'metrics' => ['1.5 days shorter stays', '$2.4M annual savings'],
            'media' => ['/images/projects/project1.png', '/images/projects/project1.png']
        ]
    ];

// Filter featured projects for the carousel (you can customize this logic)
$featured_projects = array_slice($display_projects, 0, min(3, count($display_projects)));
?>

<link rel="stylesheet" href="/components/project/project-merged.css">

<section class="projects-section" id="projects">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Our Work</h2>
            <p class="section-subtitle mx-auto">We've partnered with ambitious companies to build products that make a difference.
                Here are some of our recent projects and the results they've achieved.</p>
        </div>

        <!-- Featured Projects Carousel -->
        <div class="featured-projects">
            <div class="carousel-container">
                <button class="arrow left" aria-label="Previous project">&#8249;</button>
                <div class="carousel">
                    <?php foreach ($featured_projects as $index => $project): ?>
                        <div class="project-card carousel-card" data-index="<?php echo $index; ?>">
                            <?php if (isset($project['image']) && !empty($project['image'])): ?>
                                <img src="<?php echo htmlspecialchars($project['image']); ?>"
                                    class="project-image"
                                    alt="<?php echo htmlspecialchars($project['title']); ?> Project"
                                    onerror="this.src='/images/projects/project1.png'">
                            <?php endif; ?>
                            <div class="project-content">
                                <?php if (!empty($project['tags'])): ?>
                                    <div class="mb-3">
                                        <?php foreach ($project['tags'] as $tag): ?>
                                            <span class="project-tag"><?php echo htmlspecialchars($tag); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                                <h3 class="project-title"><?php echo htmlspecialchars($project['title']); ?></h3>
                                <p class="project-description"><?php echo htmlspecialchars($project['description']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button class="arrow right" aria-label="Next project">&#8250;</button>
            </div>
        </div>

        <!-- Additional Projects Grid -->
        <?php if (count($display_projects) > count($featured_projects)): ?>
            <div class="row g-4">
                <?php foreach (array_slice($display_projects, count($featured_projects)) as $index => $project): ?>
                    <!-- Project card with staggered animation delay -->
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4" data-aos="fade-up" data-aos-delay="<?php echo 100 + ($index * 50); ?>">
                        <div class="project-card" data-index="<?php echo $index + count($featured_projects); ?>">
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
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Project Modal -->
    <div id="projectModal" class="project-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle"></h2>
                <button class="modal-close" aria-label="Close modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="project-details" id="projectDetails">
                    <!-- Will be populated by JavaScript -->
                </div>
                <div class="media-list" id="projectMedia">
                    <!-- Will be populated by JavaScript -->
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    /**
     * Project Component JavaScript
     * Handles carousel and modal functionality
     */
    document.addEventListener('DOMContentLoaded', function() {
        // Projects data from PHP
        const projectsData = <?php echo json_encode($display_projects); ?>;

        // Set up carousel navigation
        const carousel = document.querySelector('.carousel');
        const leftArrow = document.querySelector('.arrow.left');
        const rightArrow = document.querySelector('.arrow.right');
        let currentIndex = 0;

        // Set up modal
        const modal = document.getElementById('projectModal');
        const modalClose = document.querySelector('.modal-close');
        const projectDetails = document.getElementById('projectDetails');
        const projectMedia = document.getElementById('projectMedia');

        // Handle carousel navigation
        if (leftArrow && rightArrow) {
            // Left arrow click
            leftArrow.addEventListener('click', function() {
                // Move the first card to the end
                const firstCard = carousel.firstElementChild;
                carousel.appendChild(firstCard);
            });

            // Right arrow click
            rightArrow.addEventListener('click', function() {
                // Move the last card to the beginning
                const lastCard = carousel.lastElementChild;
                carousel.prepend(lastCard);
            });
        }

        // Set up click handlers for all project cards
        const projectCards = document.querySelectorAll('.project-card');
        projectCards.forEach(card => {
            card.addEventListener('click', function() {
                const index = parseInt(this.dataset.index, 10);
                showProjectDetails(projectsData[index], index);
            });
        });

        // Modal close button
        modalClose.addEventListener('click', function() {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto'; // Re-enable scrolling
        });

        // Close modal when clicking outside content
        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto'; // Re-enable scrolling
            }
        });

        // Show project details in modal
        function showProjectDetails(project, index) {
            // Set modal title
            document.getElementById('modalTitle').textContent = project.title;

            // Build details HTML
            let detailsHTML = `
            <p class="project-description">${project.description}</p>
            
            <div class="detail-section">
                <h4 class="detail-section-title">Challenge</h4>
                <p class="detail-section-content">${project.challenge || 'No challenge information available.'}</p>
            </div>
            
            <div class="detail-section">
                <h4 class="detail-section-title">Solution</h4>
                <p class="detail-section-content">${project.solution || 'No solution information available.'}</p>
            </div>
            
            <div class="detail-section">
                <h4 class="detail-section-title">Results</h4>
                <p class="detail-section-content">${project.result || 'No results information available.'}</p>
                
                ${project.metrics && project.metrics.length ? `
                    <div class="d-flex flex-wrap justify-content-between mt-3">
                        ${project.metrics.map(metric => `
                            <div class="mb-2">
                                <div class="result-metric">${metric}</div>
                            </div>
                        `).join('')}
                    </div>
                ` : ''}
            </div>
        `;

            // Update project details
            projectDetails.innerHTML = detailsHTML;

            // Build media HTML
            let mediaHTML = '';
            if (project.media && project.media.length) {
                project.media.forEach(media => {
                    if (typeof media === 'string') {
                        // Determine if it's a video or image based on extension
                        if (media.match(/\.(mp4|webm|ogg)$/i)) {
                            mediaHTML += `
                            <video controls>
                                <source src="${media}" type="video/${media.split('.').pop()}">
                                Your browser does not support the video tag.
                            </video>
                        `;
                        } else {
                            mediaHTML += `<img src="${media}" alt="${project.title}" loading="lazy">`;
                        }
                    }
                });
            } else {
                // Fallback if no media
                mediaHTML = `<img src="${project.image}" alt="${project.title}" loading="lazy">`;
            }

            // Update media list
            projectMedia.innerHTML = mediaHTML;

            // Show modal
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden'; // Prevent scrolling behind modal
        }
    });
</script>
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

<link rel="stylesheet" href="/components/project/project.css">

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
    </div> <!-- Project Modal - Opens when a project card is clicked -->
    <div id="projectModal" class="project-modal">
        <div class="modal-content">
            <!-- Modal Header with title and close button -->
            <div class="modal-header">
                <h2 id="modalTitle"></h2>
                <button class="modal-close" aria-label="Close modal">&times;</button>
            </div>

            <!-- Navigation arrows for modal - allows users to navigate between projects while in detail view -->
            <button class="modal-nav modal-prev" aria-label="Previous project">&lsaquo;</button>
            <button class="modal-nav modal-next" aria-label="Next project">&rsaquo;</button>

            <!-- Modal Body with project details and media -->
            <div class="modal-body">
                <!-- Left side: Project details (challenge, solution, results) -->
                <div class="project-details" id="projectDetails">
                    <!-- Will be populated by JavaScript -->
                </div>

                <!-- Right side: Media gallery (images and videos) -->
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
     * 
     * This script handles:
     * 1. Carousel functionality for featured projects section
     * 2. Modal display with project details when a card is clicked
     * 3. Navigation between projects within the modal
     * 
     * @version 2.1
     * @author PulpuDev
     */
    document.addEventListener('DOMContentLoaded', function() {
        // Load project data from PHP into JavaScript
        const projectsData = <?php echo json_encode($display_projects); ?>;

        // Current project being viewed in the modal
        let currentModalIndex = 0;

        // DOM element references - Carousel
        const carousel = document.querySelector('.carousel');
        const leftArrow = document.querySelector('.arrow.left');
        const rightArrow = document.querySelector('.arrow.right');

        // DOM element references - Modal
        const modal = document.getElementById('projectModal');
        const modalClose = document.querySelector('.modal-close');
        const modalPrev = document.querySelector('.modal-prev');
        const modalNext = document.querySelector('.modal-next');
        const projectDetails = document.getElementById('projectDetails');
        const projectMedia = document.getElementById('projectMedia');
        const modalTitle = document.getElementById('modalTitle');

        /**
         * Carousel Navigation - Main project carousel
         * Implements circular navigation through featured projects
         */
        if (leftArrow && rightArrow) {
            // Left arrow click handler
            leftArrow.addEventListener('click', function(e) {
                e.stopPropagation(); // Prevent triggering card click

                // Move the first card to the end - creates visual carousel effect
                const firstCard = carousel.firstElementChild;
                carousel.appendChild(firstCard);
            });

            // Right arrow click handler
            rightArrow.addEventListener('click', function(e) {
                e.stopPropagation(); // Prevent triggering card click

                // Move the last card to the beginning - creates visual carousel effect
                const lastCard = carousel.lastElementChild;
                carousel.prepend(lastCard);
            });
        }
        /**
         * Project Card Click Event Handlers
         * Adds click listeners to all project cards to show details in modal
         */
        const projectCards = document.querySelectorAll('.project-card');
        projectCards.forEach(card => {
            card.addEventListener('click', function() {
                const index = parseInt(this.dataset.index, 10);
                currentModalIndex = index; // Update current index for modal navigation
                showProjectDetails(projectsData[index]);
            });
        });
        /**
         * Modal Navigation Handlers
         * Allow users to navigate between projects while in the modal view
         */
        // Previous project button in modal
        modalPrev.addEventListener('click', function(e) {
            e.stopPropagation();
            currentModalIndex = (currentModalIndex - 1 + projectsData.length) % projectsData.length;
            showProjectDetails(projectsData[currentModalIndex]);
            // Add a brief highlight effect on click
            this.classList.add('nav-clicked');
            setTimeout(() => this.classList.remove('nav-clicked'), 300);
        });

        // Next project button in modal
        modalNext.addEventListener('click', function(e) {
            e.stopPropagation();
            currentModalIndex = (currentModalIndex + 1) % projectsData.length;
            showProjectDetails(projectsData[currentModalIndex]);
            // Add a brief highlight effect on click
            this.classList.add('nav-clicked');
            setTimeout(() => this.classList.remove('nav-clicked'), 300);
        });

        /**
         * Modal Close Handlers
         * Methods to close the modal and restore page scrolling
         */
        // Close button click
        modalClose.addEventListener('click', function() {
            closeModal();
        });

        // Close when clicking outside modal content
        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                closeModal();
            }
        }); // Keyboard navigation for modal
        document.addEventListener('keydown', function(event) {
            if (modal.style.display === 'flex') {
                // ESC key to close modal
                if (event.key === 'Escape') {
                    closeModal();
                }

                // Left/Right arrow keys for navigation with visual feedback
                if (event.key === 'ArrowLeft') {
                    modalPrev.classList.add('nav-clicked');
                    setTimeout(() => modalPrev.classList.remove('nav-clicked'), 300);
                    modalPrev.click();
                } else if (event.key === 'ArrowRight') {
                    modalNext.classList.add('nav-clicked');
                    setTimeout(() => modalNext.classList.remove('nav-clicked'), 300);
                    modalNext.click();
                }
            }
        });

        /**
         * Close the project modal and restore page scrolling
         */
        function closeModal() {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto'; // Re-enable page scrolling
        }

        /**
         * Displays project details in the modal
         * 
         * @param {Object} project - The project data object to display
         */
        function showProjectDetails(project) {
            // Apply transition effect
            projectDetails.style.opacity = '0';
            projectMedia.style.opacity = '0';

            // Short timeout for smooth transition
            setTimeout(() => {
                // Update modal title
                modalTitle.textContent = project.title;

                // Build details HTML with sections for challenge, solution, and results
                let detailsHTML = `
                    <p class="project-description">${project.description}</p>
                    
                    <!-- Challenge Section -->
                    <div class="detail-section">
                        <h4 class="detail-section-title">Challenge</h4>
                        <p class="detail-section-content">${project.challenge || 'No challenge information available.'}</p>
                    </div>
                    
                    <!-- Solution Section -->
                    <div class="detail-section">
                        <h4 class="detail-section-title">Solution</h4>
                        <p class="detail-section-content">${project.solution || 'No solution information available.'}</p>
                    </div>
                    
                    <!-- Results Section with Metrics -->
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

                // Update project details content
                projectDetails.innerHTML = detailsHTML;

                // Build media gallery HTML
                let mediaHTML = '';

                // Process media array if it exists
                if (project.media && project.media.length) {
                    project.media.forEach(media => {
                        if (typeof media === 'string') {
                            // Determine if media is video or image based on file extension
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
                    // Fallback if no media array is present
                    mediaHTML = `<img src="${project.image}" alt="${project.title}" loading="lazy">`;
                }

                // Update media gallery content
                projectMedia.innerHTML = mediaHTML;

                // Fade elements back in
                projectDetails.style.opacity = '1';
                projectMedia.style.opacity = '1';
            }, 200);

            // Display the modal
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden'; // Prevent scrolling behind modal
        }
    });
</script>
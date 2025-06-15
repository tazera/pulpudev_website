<?php
// filepath: c:\Work\pulpudev_website\app\components\contact\contact.php
?>

<section class="section-padding">
    <div class="container">
        <div class="row g-4 mb-4 align-items-stretch">
            <div class="col-12">
                <div class="card p-4 p-lg-5">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="contact-info mb-5 mb-lg-0">
                                <h2 class="contact-title" id="contact">Contact us</h2>
                                <p class="contact-description">Get in touch with our team to discuss your project requirements or learn more about our services.</p>
                                <div class="contact-details mt-4">
                                    <div class="contact-detail-item">
                                        <strong>Email:</strong>
                                        <a href="mailto:info@pulpudev.com" class="contact-link">sales@pulpudev.com</a>
                                    </div>
                                    <div class="contact-detail-item">
                                        <strong>Phone:</strong>
                                        <a href="tel:+11234567890" class="contact-link">+359 87 881 8575</a>
                                    </div>
                                    <!-- For now we don`t have so leave it for later-->
                                    <!-- <div class="contact-detail-item">
                                        <strong>Address:</strong>
                                        <address class="mb-0">123 Tech Street, Suite 100<br>Silicon Valley, CA 94000</address>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="contact-form-container">
                                <h3 class="mb-4">Send us a message</h3>
                                <form id="contactForm" action="/submit-contact" method="post" enctype="multipart/form-data">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Full Name" required>
                                                <label for="fullName">Full Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="companyName" name="companyName" placeholder="Company Name" required>
                                                <label for="companyName">Company Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="email" class="form-control" id="workEmail" name="workEmail" placeholder="Work Email" required>
                                                <label for="workEmail">Work Email</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Phone Number (optional)">
                                                <label for="phoneNumber">Phone Number (optional)</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="serviceInterest" name="serviceInterest" required>
                                                    <option value="" selected disabled>Select a service</option>
                                                    <option value="Digitalization">Digitalization</option>
                                                    <option value="WebsiteBuilding">Website Building</option>
                                                    <option value="HardwareMaintenance">Hardware Maintenance</option>
                                                    <option value="B2BSoftware">B2B Software</option>
                                                    <option value="CustomSoftware">Custom Software/System Development</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                                <label for="serviceInterest">Service of Interest</label>
                                            </div>
                                        </div>
                                        <div class="col-12" id="otherServiceContainer" style="display: none;">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="otherService" name="otherService" placeholder="Please specify">
                                                <label for="otherService">Please specify</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <textarea class="form-control" id="message" name="message" placeholder="How can we help?" style="height: 150px" required></textarea>
                                                <label for="message">How can we help?</label>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Attachments (optional)</label>
                                            <div class="input-group">
                                                <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
                                                <label class="input-group-text" for="attachments">Upload</label>
                                            </div>
                                            <div class="form-text">Share specifications, diagrams, or drafts (Max 10MB)</div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="referralSource" name="referralSource">
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="Google">Google Search</option>
                                                    <option value="SocialMedia">Social Media</option>
                                                    <option value="Recommendation">Recommendation</option>
                                                    <option value="Event">Event or Conference</option>
                                                    <option value="Advertisement">Advertisement</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                                <label for="referralSource">How did you hear about us? (optional)</label>
                                            </div>
                                        </div>
                                        <div class="col-12" id="otherReferralContainer" style="display: none;">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="otherReferral" name="otherReferral" placeholder="Please specify">
                                                <label for="otherReferral">Please specify</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary btn-lg w-100">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Add CSS for the contact section -->
<style>
    .section-padding {
        padding: 100px 0;
    }

    .card {
        background-color: #1A1A1A;
        border: none;
        border-radius: 12px;
        color: #F7F8F8;
    }

    .contact-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
    }

    .contact-description {
        font-size: 1.1rem;
        margin-bottom: 2rem;
        opacity: 0.85;
    }

    .contact-form-container {
        padding: 0 1rem;
    }

    .contact-link {
        color: #6EC6F6;
        text-decoration: none;
    }

    .contact-link:hover {
        text-decoration: underline;
    }

    .contact-detail-item {
        margin-bottom: 1rem;
    }

    /* Form styling */
    .form-control,
    .form-select {
        background-color: #232323;
        border: 1px solid #333;
        color: #F7F8F8;
    }

    .form-control:focus,
    .form-select:focus {
        background-color: #232323;
        border-color: #6EC6F6;
        box-shadow: 0 0 0 0.25rem rgba(110, 198, 246, 0.25);
        color: #F7F8F8;
    }

    .form-floating>.form-control::placeholder,
    .form-floating>.form-select::placeholder {
        color: transparent;
    }

    .form-floating>label {
        color: #B0B0B0;
    }

    .form-floating>.form-control:focus~label,
    .form-floating>.form-control:not(:placeholder-shown)~label,
    .form-floating>.form-select~label {
        color: #B0B0B0;
        opacity: 0.8;
    }

    .btn-primary {
        background-color: #6EC6F6;
        border-color: #6EC6F6;
        color: #0E0E10;
        font-weight: 600;
        padding: 12px 24px;
    }

    .btn-primary:hover {
        background-color: #5bb8e7;
        border-color: #5bb8e7;
    }

    .form-text {
        color: #B0B0B0;
        font-size: 0.875rem;
    }

    .input-group-text {
        background-color: #333;
        border: 1px solid #444;
        color: #F7F8F8;
    }

    /* Make the file input match the theme */
    .form-control[type="file"] {
        padding: 0.375rem 0.75rem;
    }

    .form-control[type="file"]::file-selector-button {
        background-color: #333;
        border: 0;
        border-radius: 4px;
        color: #F7F8F8;
        margin-right: 1rem;
        padding: 0.375rem 0.75rem;
    }

    /* Responsive styles */
    @media (max-width: 991px) {
        .contact-form-container {
            padding: 0;
            margin-top: 2rem;
        }
    }

    @media (max-width: 767px) {
        .contact-title {
            font-size: 2rem;
        }

        .card {
            padding: 2rem 1.5rem !important;
        }
    }
</style>

<!-- Add JavaScript for the form logic -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const serviceInterest = document.getElementById('serviceInterest');
        const otherServiceContainer = document.getElementById('otherServiceContainer');
        const otherService = document.getElementById('otherService');
        const referralSource = document.getElementById('referralSource');
        const otherReferralContainer = document.getElementById('otherReferralContainer');
        const otherReferral = document.getElementById('otherReferral');

        // Show/hide "Other" service field
        serviceInterest.addEventListener('change', function() {
            if (this.value === 'Other') {
                otherServiceContainer.style.display = 'block';
                otherService.setAttribute('required', '');
            } else {
                otherServiceContainer.style.display = 'none';
                otherService.removeAttribute('required');
            }
        });

        // Show/hide "Other" referral field
        referralSource.addEventListener('change', function() {
            if (this.value === 'Other') {
                otherReferralContainer.style.display = 'block';
                otherReferral.setAttribute('required', '');
            } else {
                otherReferralContainer.style.display = 'none';
                otherReferral.removeAttribute('required');
            }
        });

        // Basic form validation
        const contactForm = document.getElementById('contactForm');
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // You can add more validation here

            // For demo purposes, show success message
            alert('Form submitted successfully! In a real implementation, this would be sent to the server.');
            contactForm.reset();
        });
    });
</script>
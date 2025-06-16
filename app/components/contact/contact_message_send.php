<?php
if (isset($_GET['contact']) && $_GET['contact'] == 'success'): ?>
    <div id="contact-success-alert" class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-4" style="z-index: 9999;" role="alert">
        Your message has been sent successfully! We'll get back to you soon.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <script>
        setTimeout(function() {
            var alert = document.getElementById('contact-success-alert');
            if (alert) {
                var bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                bsAlert.close();
            }
        }, 5000);
    </script>
<?php elseif (isset($_GET['contact']) && $_GET['contact'] == 'failed'): ?>
    <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-4" style="z-index: 9999;" role="alert">
        Sorry, there was a problem sending your message. Please try again later.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
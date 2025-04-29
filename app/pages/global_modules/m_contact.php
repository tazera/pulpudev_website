<?php
$heading = $_SESSION['phrases']['contact-section-heading'];
$paragraph = $_SESSION['phrases']['contact-section-paragraph'];
$button = $_SESSION['phrases']['contact-section-button'];
$image = 'https://media.istockphoto.com/id/1462936293/photo/phone-office-and-business-woman-networking-on-social-media-the-internet-or-a-mobile-app.jpg?s=612x612&w=0&k=20&c=cuEDZI9O720ygWjJk58I45qeylPSI4P1rcmR23iv1EE=';
$href = '/pages/contact_us/contact_us.php';
contact_section($heading, $paragraph, $image, $button, $href);

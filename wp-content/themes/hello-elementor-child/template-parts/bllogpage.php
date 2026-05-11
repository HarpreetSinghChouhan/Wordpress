<?php 
/* Template Name: Exact Font Match */
get_header(); 
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@900&display=swap" rel="stylesheet">

<style>
    .hero-container {
        background-color: #f9f8f3; 
        padding: 8rem 2rem;
    }

    .hero-text {
        max-width: 1000px;
        margin-left: 5%;
        /* Spacing ko tight kiya gaya hai Image 4 ki tarah */
        line-height: 0.90;
        letter-spacing: -0.05em; 
        font-family: 'Inter', sans-serif !important;
    }
.hero-text h1 {
        margin: 0;
        font-size: clamp(3.5rem, 8vw, 6rem);
        font-weight: 900;
        color: #1a1a1a;
        line-height: 0.90;
        letter-spacing: -0.04em;

        /* Segoe UI Windows ke liye, baki systems ke liye backup */
        font-family: "Segoe UI", Roboto, Helvetica, Arial, sans-serif !important;
    }
    /* .hero-text h1 {
        margin: 0;
        font-size: clamp(3.5rem, 8vw, 6.5rem);
        font-weight: 900;
        color: #111;
        
        font-feature-settings: "cv05" 1, "cv08" 1, "ss01" 1; 
    } */

    .hero-text .accent {
        display: block;
        color: #f6b300;
    }
</style>

<div class="hero-container">
    <div class="hero-text">
        <h1>
            Custom Digital<br>
            Solutions Built for<br>
            <span class="accent">Growing Businesses</span>
        </h1>
    </div>
</div>

<?php 
// get_footer();
?>
<?php
get_header(); // Include the header template

// Get current taxonomy information
$term = get_queried_object();
$category_name =  $term->name ?? '';

wp_enqueue_script('jquery');

$child_terms = get_terms(array(
    'taxonomy' => $term->taxonomy,
    'parent' => $term->term_id,
    'hide_empty' => false,
));
?>

<style>
    .kd_container_class {
        max-width: 1440px;
        align-items: center;
        margin: auto;
    }
</style>

<div class="ak_travelpackage_container">
    <div class="kd_container_class">
        <div class="container">
            <div class="row">
                <div class="col-12 packagePageBanner">
                    <h1 class="package_title"><?php echo esc_html($category_name); ?></h1>
                </div>
            </div>
        </div>

        <div class="main_packagesContianer">
            <div class="heading_container">
                <h2><?php echo esc_html($category_name); ?></h2>
                <?= get_the_archive_description(); ?>
            </div>

            <!-- Locations section start -->
            <section class="loactions-container">
                <div class="locations_card_container">
                    <!-- Initial content loaded here -->
                </div>
                <div class="pagination location_pagination">
                    <!-- Pagination will be injected here by AJAX -->
                </div>
            </section>
            <!-- Locations section end -->
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    jQuery(document).ready(function($) {
        function loadTravelPackages(page) {
            var term = '<?= $term->slug; ?>'; // Pass the taxonomy term

            $.ajax({
                url: '<?= admin_url("admin-ajax.php"); ?>',
                type: 'POST',
                data: {
                    action: 'load_travel_packages',
                    page: page,
                    term: term
                },
                success: function(response) {
                    $('.locations_card_container').html(response.content); // Update content
                    $('.pagination').html(response.pagination); // Update pagination
                }
            });
        }

        // Load the first page initially
        loadTravelPackages(1);

        // Handle pagination click
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var page = $(this).data('page');
            loadTravelPackages(page);
        });
    });
</script>

<?php
wp_reset_postdata();
get_footer();
?>

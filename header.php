<?php

?>

<!DOCTYPE html>
<html lang="<?php language_attributes( ); ?>" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(  )?>
    <!-- <link rel="shortcut icon" href="<?php print get_template_directory_uri() . '/img/logo.png' ?>" type="image/x-icon"> -->
</head>
<body <?php body_class( )?>>
<?php wp_body_open(); ?>
    <!-- header area start -->
    <header class="dm_header_area">
        <!-- top_header area start -->
        <div id="dm_top_header">
            <div class="container">
                <div class="left_box">
                    <!-- this is insitute select box  -->
                                            <style>
                            #dm_select_box {
                                max-width: 592px;
                                display: grid;
                                grid-template-columns: 1fr 1fr 1fr 1fr;
                                gap: 10px;
                            }
                            @media screen and (max-width: 992px) {
                                #dm_select_box {
                                grid-template-columns: 1fr 1fr 1fr;
                                }
                            }
                            @media screen and (max-width: 768px) {
                                #dm_select_box {
                                grid-template-columns: 1fr 1fr;
                                }
                            }
                            @media screen and (max-width: 540px) {
                                #dm_select_box {
                                grid-template-columns: 1fr;
                                }
                            }
                            #dm_select_box select {
                                padding: 3px 5px;
                                font-size: 13px;
                                width: 100%;
                                border: 1px solid rgba(8, 8, 8, 0.137);
                                border-radius: 2px;
                                outline: none;
                            }
                            </style>
                            <div id="dm_select_box">
                            <select id="divisionDropdown">
                                <option value="">বিভাগ</option>
                            </select>

                            <select id="zilaDropdown" style="display: none"></select>

                            <select id="upazilaDropdown" style="display: none"></select>

                            <select id="instituteDropdown" style="display: none"></select>
                            </div>

                            <script>
                            document.addEventListener("DOMContentLoaded", function () {
                                const divisionDropdown = document.getElementById("divisionDropdown");
                                const zilaDropdown = document.getElementById("zilaDropdown");
                                const upazilaDropdown = document.getElementById("upazilaDropdown");
                                const instituteDropdown = document.getElementById("instituteDropdown");

                                // Fetch JSON data from your JSON file (dm-school-list-data.json)
                                fetch("https://raw.githubusercontent.com/dmoksedul/dm-school-select/main/dm-school-list-data.json")
                                .then((response) => response.json())
                                .then((data) => {
                                    // Populate the Division dropdown
                                    data.divisions.forEach((division) => {
                                    const option = document.createElement("option");
                                    option.value = division;
                                    option.textContent = division;
                                    divisionDropdown.appendChild(option);
                                    });

                                    divisionDropdown.addEventListener("change", function () {
                                    // Hide all other dropdowns
                                    zilaDropdown.style.display = "none";
                                    upazilaDropdown.style.display = "none";
                                    instituteDropdown.style.display = "none";

                                    // Show the selected division's dropdown
                                    const selectedDivision = this.value;
                                    if (selectedDivision) {
                                        // Filter zilas based on the selected division
                                        const filteredZilas = data.zilas.filter(
                                        (zila) => zila.division === selectedDivision
                                        );

                                        // Populate the Zila dropdown
                                        zilaDropdown.innerHTML = '<option value="">জেলা</option>';
                                        filteredZilas.forEach((zila) => {
                                        const option = document.createElement("option");
                                        option.value = zila.name;
                                        option.textContent = zila.name;
                                        zilaDropdown.appendChild(option);
                                        });
                                        zilaDropdown.style.display = "block";
                                    }
                                    });

                                    zilaDropdown.addEventListener("change", function () {
                                    // Hide all other dropdowns
                                    upazilaDropdown.style.display = "none";
                                    instituteDropdown.style.display = "none";

                                    // Show the selected zila's dropdown
                                    const selectedZila = this.value;
                                    if (selectedZila) {
                                        // Filter upazilas based on the selected zila
                                        const filteredUpazilas = data.upazilas.filter(
                                        (upazila) => upazila.zila === selectedZila
                                        );

                                        // Populate the Upazila dropdown
                                        upazilaDropdown.innerHTML = '<option value="">উপজেলা</option>';
                                        filteredUpazilas.forEach((upazila) => {
                                        const option = document.createElement("option");
                                        option.value = upazila.name;
                                        option.textContent = upazila.name;
                                        upazilaDropdown.appendChild(option);
                                        });
                                        upazilaDropdown.style.display = "block";
                                    }
                                    });

                                    upazilaDropdown.addEventListener("change", function () {
                                    // Hide all other dropdowns
                                    instituteDropdown.style.display = "none";

                                    // Show the selected upazila's dropdown
                                    const selectedUpazila = this.value;
                                    if (selectedUpazila) {
                                        // Filter institutes based on the selected upazila
                                        const filteredInstitutes = data.institutes.filter(
                                        (institute) => institute.upazila === selectedUpazila
                                        );

                                        // Populate the Institute dropdown
                                        instituteDropdown.innerHTML =
                                        '<option value="">প্রতিষ্ঠান সমূহ</option>';
                                        filteredInstitutes.forEach((institute) => {
                                        const option = document.createElement("option");
                                        option.value = institute.link;
                                        option.textContent = institute.name;
                                        instituteDropdown.appendChild(option);
                                        });
                                        instituteDropdown.style.display = "block";
                                    }
                                    });

                                    instituteDropdown.addEventListener("change", function () {
                                    // Open the selected institute's link
                                    const selectedLink = this.value;
                                    if (selectedLink) {
                                        window.location.href = selectedLink;
                                    }
                                    });
                                })
                                .catch((error) => console.error("Error loading JSON data:", error));
                            });
                            </script>
                </div>
                <div class="right_box">
                    <!-- contact info box start -->
                    <ul class="dm_top_contact_box">
                        <!-- <li><a href="/"><i class="fas fa-house-user"></i><?php print get_option('address-info'); ?></a></li> -->
                        <li><a href="tel:<?php print get_option('phone-number', '+8801518301895'); ?>"><i class="fas fa-phone"></i><?php print get_option('phone-number', '8801518301895'); ?></a></li>
                        <li><a href="mailto:<?php print get_option('email-info', 'info@moksedul.dev'); ?>"><i class="fas fa-envelope"></i><?php print get_option('email-info', 'info@moksedul.dev'); ?></a></li>
                    </ul>
                    <!-- contact info box end -->
                </div>
            </div>
        </div>
        <!-- top_header area end -->
        <!-- header banner start -->
        <div id="dm_header_banner_area">
            <div class="container">
                <!-- Display the logo -->
                <?php $logoUrl = get_option('dm_header_banner', '/img/banner.png'); ?>
                <?php if (!empty($logoUrl)) : ?>
                    <img src="<?php echo esc_url($logoUrl); ?>" alt="Logo">
                <?php else : ?>
                    <!-- Display the default logo if no custom logo is set -->
                    <img src="<?php echo get_template_directory_uri() . '/img/banner.png'; ?>" alt="Logo">
                <?php endif; ?>
            </div>
        </div>

        <!-- nav menheader banner end -->
        <!-- navbar area start -->
        <nav id="dm_navbar_area">
            <div class="container">
                <div id="dm_mobile_logo">
                    <!-- Display the logo -->
                <?php $logoUrl = get_option('dm_mobile_logo', '/img/mobile-logo.png'); ?>
                <?php if (!empty($logoUrl)) : ?>
                    <img src="<?php echo esc_url($logoUrl); ?>" alt="Logo">
                <?php else : ?>
                    <!-- Display the default logo if no custom logo is set -->
                    <img src="<?php echo get_template_directory_uri() . '/img/mobile-logo.png'; ?>" alt="Logo">
                <?php endif; ?>
                </div>
                <?php
        wp_nav_menu(array(
            'theme_location' => 'header_menu',
            'menu_id'        => 'dm_navbar_menu',
            'walker'         => new Custom_Submenu_Walker(),
        ));
        ?>
                <button id="dm_menu_toggler"><i class="fas fa-bars-staggered"></i></button>
                <!-- navbar clos button -->
                <div id="navbar_close_button"></div>
            </div>
        </nav>
        <!-- navbar area end -->
    </header>
    <!-- header area end -->
    <!-- Preloader Container -->
    <div class="preloader">
        <div class="spinner"></div>
    </div>
    <section id="body_area">
    <div class="container">
    <?php
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        </article>

    <button id="scrollToTopButton"><i class="far fa-arrow-alt-circle-up"></i></button>
    </div>
  </section>



<?php wp_footer(  )?>
</body>
</html>
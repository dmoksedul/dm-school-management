//javascript code start
      // Get the ul element
      const ul = document.querySelector('#customize_side_bar ul');

      // Add a click event listener to the ul to capture clicks on buttons
      ul.addEventListener('click', function (event) {
          // Check if the clicked element is a button
          if (event.target.tagName === 'BUTTON') {
              // Remove the "active" class from all buttons within the ul
              const buttons = ul.querySelectorAll('button');
              buttons.forEach(button => button.classList.remove('active'));

              // Add the "active" class to the clicked button
              event.target.classList.add('active');
          }
      });

      // Get all buttons with the "toggle-tab" class
      const toggleButtons = document.querySelectorAll('.toggle-tab');

      // Get all editor tabs
      const editorTabs = document.querySelectorAll('.editor-tab');

      // Add click event listeners to each button
      toggleButtons.forEach(button => {
          button.addEventListener('click', function () {
              // Remove the "active" class from all buttons
              toggleButtons.forEach(btn => btn.classList.remove('active'));

              // Add the "active" class to the clicked button
              this.classList.add('active');

              // Get the target tab ID from the "data-target" attribute
              const targetTabId = this.getAttribute('data-target');

              // Toggle the visibility of editor tabs
              editorTabs.forEach(tab => {
                  if (tab.id === targetTabId) {
                      tab.style.display = 'block';
                  } else {
                      tab.style.display = 'none';
                  }
              });
          });
      });

      // Locate the "Save Change" button element by its class
      const saveButton = document.querySelector('.dm_save_button');
      // Locate the custom popup elements
      const savePopup = document.querySelector('.save_popup_box');
      const yesButton = document.querySelector('.save_yes_btn');
      const noButton = document.querySelector('.save_no_btn');
      // Add a click event listener to the "Save Change" button
      saveButton.addEventListener('click', function () {
          // Display the custom popup
          savePopup.classList.add("save_popup_box_active");
      });
      // Add a click event listener to the "Save Change" button
      noButton.addEventListener('click', function () {
          // Display the custom popup
          savePopup.classList.remove("save_popup_box_active");
      });

      jQuery(document).ready(function($) {
          $('#upload-image-button').click(function() {
              var image = wp.media({ title: 'Upload Image', multiple: false }).open()
                  .on('select', function(e) {
                      var uploadedImage = image.state().get('selection').first();
                      var imageSrc = uploadedImage.toJSON().url;
                      $('#banner_image').attr('src', imageSrc);
                      $('input[name="dm_header_banner"]').val(imageSrc);
                      // Show the "Restore Default" button
                      $('#restore-default-button').show();
                  });
          });

      });
//javascript code end
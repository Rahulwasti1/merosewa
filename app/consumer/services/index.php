<?php
require_once '../../helpers/redirect-to-login.php';
$_SESSION['page_title'] = "MeroSewa - All Services";
ob_start()
?>
<!-- Success and Error Messages -->
<?php if (isset($_SESSION['success_message'])): ?>
    <span style="color: green; display: block; margin: 10px 0;">
        <?= htmlspecialchars($_SESSION['success_message']) ?>
    </span>
    <?php unset($_SESSION['success_message']); // Clear the message
    ?>
<?php elseif (isset($_SESSION['error_message'])): ?>
    <span style="color: red; display: block; margin: 10px 0;">
        <?= htmlspecialchars($_SESSION['error_message']) ?>
    </span>
    <?php unset($_SESSION['error_message']); // Clear the message
    ?>
<?php endif; ?>
<div class="services-container">

    <!-- Left Sidebar Filter -->
    <aside class="services-filter">
        <h2>Filter Services</h2>
        <!-- Price Range -->
        <div class="filter-section">
            <h3>Price Range</h3>
            <div class="price-range">
                <div class="range-slider">
                    <input type="range" min="0" max="5000" value="0" class="range-min">
                    <input type="range" min="0" max="5000" value="5000" class="range-max">
                </div>
                <div class="range-values">
                    <span>NPR 0</span>
                    <span>NPR 5000</span>
                </div>
            </div>
        </div>

        <!-- Ratings -->
        <div class="filter-section">
            <h3>Ratings</h3>
            <ul class="filter-list">
                <li>
                    <a href="#">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <span>& Up</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <span>& Up</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <span>& Up</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Location -->
        <div class="filter-section">
            <h3>Location</h3>
            <div class="location-search">
                <input type="text" placeholder="Enter locality...">
                <select>
                    <option value="">Select City</option>
                    <option value="kathmandu">Kathmandu</option>
                    <option value="lalitpur">Lalitpur</option>
                    <option value="bhaktapur">Bhaktapur</option>
                </select>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="services-content">
        <h2>All Services (<span id="services-count">0</span>)</h2>
        <div class="services-list" id="services-list">
            <!-- Services inserted here via AJAX -->
            <!-- Loading Indicator -->
            <div id="loading-indicator" class="loading-container" style="text-align: center; padding: 20px;">
                <div class="spinner" style="border: 4px solid #f3f3f3; border-top: 4px solid #3498db; border-radius: 50%; width: 40px; height: 40px; animation: spin 2s linear infinite; margin: 0 auto;"></div>
                <p style="margin-top: 10px; color: #666;">Loading services...</p>
            </div>
        </div>
        <!-- Service Modal -->
        <div id="service-modal" class="service-modal" style="display:none;">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="modal-service-name"></h3>
                    <a href="#" class="modal-close" onclick="closeModal()">&times;</a>
                </div>
                <div class="modal-body">
                    <div class="modal-image" style="text-align:center; margin-bottom: 15px;">
                        <img id="modal-service-image" src="" alt="" style="max-width: 100%; max-height: 200px; border-radius: 8px;" />
                    </div>
                    <p><strong>Provider:</strong> <span id="modal-service-provider"></span></p>
                    <p><strong>Description:</strong></p>
                    <p class="service-features" id="modal-service-description"></p>
                    <p><strong>Rate per hour:</strong> NPR <span id="modal-service-rate"></span></p>
                </div>
                <div class="modal-footer" style="text-align: right; margin-top: 20px;">
                    <a id="modal-book-link" href="#" class="btn-book" style="padding: 10px 20px; background-color: #3498db; color: white; border-radius: 5px; text-decoration: none;">
                        Book Now
                    </a>
                </div>
            </div>
        </div>
    </main>
</div>
<style>
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* Modal styles */
    .service-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .modal-content {
        background: white;
        padding: 20px;
        border-radius: 8px;
        width: 90%;
        max-width: 600px;
        position: relative;
    }

    .modal-close {
        position: absolute;
        top: 10px;
        right: 16px;
        font-size: 24px;
        color: #333;
        text-decoration: none;
        cursor: pointer;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(function() {
        loadServices();
    });

    function loadServices() {
        $.ajax({
            url: 'http://localhost/merosewa/api/getAllServices.php',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    populateServices(response.services);
                } else {
                    $('#services-list').html('<p>No services available.</p>');
                }
            },
            error: function() {
                $('#services-list').html('<p>Error loading services.</p>');
            }
        });
    }

    function populateServices(services) {
        $('#services-count').text(services.length);
        const container = $('#services-list');
        container.empty();

        services.forEach(service => {
            const serviceId = service.id;
            const serviceHtml = `
        <div class="service-item">
          <div class="service-image">
            <img src="/merosewa/${escapeHtml(service.image)}" alt="${escapeHtml(service.name)}">
          </div>
          <div class="service-content">
            <h3>${escapeHtml(service.name)}</h3>
            <p class="provider">${escapeHtml(service.service_provider)}</p>
            <div class="service-footer">
              <span class="price">NPR ${parseFloat(service.rate_per_hour).toLocaleString('en-NP')} / Hr</span>
              <a href="#" class="btn-details" onclick='openModal(${JSON.stringify(service)})'>View Details</a>
            </div>
          </div>
        </div>
      `;
            container.append(serviceHtml);
        });
    }

    function openModal(service) {
        $('#modal-service-name').text(service.name);
        $('#modal-service-provider').text(service.service_provider);
        $('#modal-service-description').text(service.description);
        $('#modal-service-rate').text(parseFloat(service.rate_per_hour).toLocaleString('en-NP', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }));
        $('#modal-service-image').attr('src', '/merosewa/' + service.image).attr('alt', service.name);
        $('#modal-book-link').attr('href', `/merosewa/app/consumer/bookings/create.php?id=${encodeURIComponent(service.id)}`);
        $('#service-modal').fadeIn();
    }


    function closeModal() {
        $('#service-modal').fadeOut();
    }

    function escapeHtml(text) {
        return $('<div>').text(text).html();
    }
</script>

<?php
$content = ob_get_clean();
$additional_css = ['/merosewa/app/consumer/assets/css/services.css'];
$additional_js = ['/merosewa/app/consumer/assets/js/services.js'];
require '../layouts/provider.php';
?>

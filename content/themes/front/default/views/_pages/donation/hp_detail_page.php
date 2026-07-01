<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<style>
.hospital-detail-section {
    padding: 60px 0;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    min-height: 100vh;
}

.hospital-hero-card {
    background: linear-gradient(135deg, #b40028 0%, #8b0000 100%);
    border-radius: 20px;
    padding: 50px 40px;
    margin-bottom: 40px;
    box-shadow: 0 20px 60px rgba(180, 0, 40, 0.15);
    position: relative;
    overflow: hidden;
}

.hospital-hero-card::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 400px;
    height: 400px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 50%;
}

.hospital-hero-card::after {
    content: '';
    position: absolute;
    bottom: -30%;
    left: -10%;
    width: 300px;
    height: 300px;
    background: rgba(255, 255, 255, 0.03);
    border-radius: 50%;
}

.hospital-category-badge {
    display: inline-block;
    background: rgba(255, 255, 255, 0.2);
    color: #fff;
    padding: 8px 20px;
    border-radius: 30px;
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 20px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.hospital-title {
    color: #fff;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 15px;
    line-height: 1.3;
    position: relative;
    z-index: 1;
}

.hospital-address-hero {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1.1rem;
    margin-bottom: 0;
    position: relative;
    z-index: 1;
}

.info-card {
    background: #fff;
    border-radius: 16px;
    padding: 30px;
    margin-bottom: 25px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    border: 1px solid rgba(0, 0, 0, 0.04);
    transition: all 0.3s ease;
}

.info-card:hover {
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
}

.info-card-header {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #f8f9fa;
}

.info-icon {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #b40028 0%, #8b0000 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    box-shadow: 0 4px 15px rgba(180, 0, 40, 0.2);
}

.info-icon i {
    color: #fff;
    font-size: 20px;
}

.info-card-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1a1a2e;
    margin: 0;
}

.info-item {
    display: flex;
    align-items: flex-start;
    padding: 12px 0;
    border-bottom: 1px solid #f0f0f0;
}

.info-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.info-label {
    font-weight: 600;
    color: #6c757d;
    min-width: 120px;
    font-size: 14px;
}

.info-value {
    color: #1a1a2e;
    font-weight: 500;
    flex: 1;
}

.action-buttons-section {
    margin-top: 30px;
}

.action-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 14px 28px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 15px;
    text-decoration: none;
    transition: all 0.3s ease;
    margin-right: 15px;
    margin-bottom: 15px;
    border: none;
    cursor: pointer;
}

.btn-directions {
    background: linear-gradient(135deg, #b40028 0%, #8b0000 100%);
    color: #fff;
    box-shadow: 0 4px 15px rgba(180, 0, 40, 0.3);
}

.btn-directions:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(180, 0, 40, 0.4);
    color: #fff;
}

.btn-call {
    background: #28a745;
    color: #fff;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
}

.btn-call:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
    color: #fff;
}

.btn-email {
    background: #fff;
    color: #b40028;
    border: 2px solid #b40028;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
}

.btn-email:hover {
    background: #b40028;
    color: #fff;
    transform: translateY(-2px);
}

.action-btn i {
    margin-right: 8px;
    font-size: 16px;
}

.review-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #fff 100%);
    border-radius: 16px;
    padding: 30px;
    border: 1px solid rgba(0, 0, 0, 0.04);
}

.review-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1a1a2e;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
}

.review-title i {
    color: #ffc107;
    margin-right: 10px;
}

.review-text {
    color: #495057;
    line-height: 1.8;
    font-size: 15px;
}

.no-review {
    color: #adb5bd;
    font-style: italic;
}

.back-btn-section {
    margin-bottom: 30px;
}

.back-btn {
    display: inline-flex;
    align-items: center;
    color: #6c757d;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 15px;
}

.back-btn:hover {
    color: #b40028;
}

.back-btn i {
    margin-right: 8px;
}

@media (max-width: 768px) {
    .hospital-detail-section {
        padding: 30px 0;
    }
    
    .hospital-hero-card {
        padding: 30px 20px;
        border-radius: 16px;
        margin-bottom: 25px;
    }
    
    .hospital-title {
        font-size: 1.75rem;
    }
    
    .hospital-address-hero {
        font-size: 1rem;
    }
    
    .info-card {
        padding: 20px;
        border-radius: 12px;
    }
    
    .info-item {
        flex-direction: column;
    }
    
    .info-label {
        margin-bottom: 5px;
    }
    
    .action-btn {
        width: 100%;
        margin-right: 0;
    }
    
    .action-buttons-section .row {
        --bs-gutter-x: 0;
    }
}
</style>

<section class="hospital-detail-section">
    <div class="container">
        <!-- Back Button -->
        <div class="back-btn-section">
            <a href="javascript:history.back()" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Back to Hospital List
            </a>
        </div>

        <!-- Hero Card -->
        <div class="hospital-hero-card">
            <span class="hospital-category-badge">
                <i class="fas fa-hospital-alt"></i>
                <?php echo htmlspecialchars($detail_data[0]['category'] ?? 'Hospital'); ?>
            </span>
            <h1 class="hospital-title"><?php echo htmlspecialchars($detail_data[0]['company_name']); ?></h1>
            <p class="hospital-address-hero">
                <i class="fas fa-map-marker-alt"></i>
                <?php echo htmlspecialchars($detail_data[0]['address']); ?>, 
                <?php echo htmlspecialchars($detail_data[0]['city']); ?>, 
                <?php echo htmlspecialchars($detail_data[0]['state']); ?> - 
                <?php echo htmlspecialchars($detail_data[0]['pincode']); ?>
            </p>
        </div>

        <div class="row">
            <!-- Contact Information -->
            <div class="col-lg-6">
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="info-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <h3 class="info-card-title">Contact Information</h3>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">Phone</span>
                        <span class="info-value">
                            <?php if(!empty($detail_data[0]['phone'])): ?>
                                <a href="tel:<?php echo htmlspecialchars($detail_data[0]['phone']); ?>" style="color: #b40028;">
                                    <?php echo htmlspecialchars($detail_data[0]['phone']); ?>
                                </a>
                            <?php else: ?>
                                <span class="text-muted">Not available</span>
                            <?php endif; ?>
                        </span>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">Email</span>
                        <span class="info-value">
                            <?php 
                            $emails = array_filter([
                                $detail_data[0]['email_1'] ?? null,
                                $detail_data[0]['email_2'] ?? null,
                                $detail_data[0]['email_3'] ?? null
                            ]);
                            if(!empty($emails)): 
                            ?>
                                <?php foreach($emails as $email): ?>
                                    <a href="mailto:<?php echo htmlspecialchars($email); ?>" style="color: #b40028; display: block;">
                                        <?php echo htmlspecialchars($email); ?>
                                    </a>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <span class="text-muted">Not available</span>
                            <?php endif; ?>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Location Details -->
            <div class="col-lg-6">
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="info-icon">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <h3 class="info-card-title">Location Details</h3>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">Address</span>
                        <span class="info-value"><?php echo htmlspecialchars($detail_data[0]['address']); ?></span>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">City</span>
                        <span class="info-value"><?php echo htmlspecialchars($detail_data[0]['city']); ?></span>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">State</span>
                        <span class="info-value"><?php echo htmlspecialchars($detail_data[0]['state']); ?></span>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">Pincode</span>
                        <span class="info-value"><?php echo htmlspecialchars($detail_data[0]['pincode']); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons-section">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <?php if(!empty($detail_data[0]['lat']) && !empty($detail_data[0]['long'])): ?>
                        <button class="action-btn btn-directions" onclick="getDirections(<?php echo $detail_data[0]['lat']; ?>, <?php echo $detail_data[0]['long']; ?>)">
                            <i class="fas fa-directions"></i>
                            Get Directions
                        </button>
                    <?php endif; ?>
                </div>
                <div class="col-lg-4 col-md-6">
                    <?php if(!empty($detail_data[0]['phone'])): ?>
                        <a href="tel:<?php echo htmlspecialchars($detail_data[0]['phone']); ?>" class="action-btn btn-call">
                            <i class="fas fa-phone-alt"></i>
                            Call Now
                        </a>
                    <?php endif; ?>
                </div>
                <div class="col-lg-4 col-md-6">
                    <?php if(!empty($detail_data[0]['email_1'])): ?>
                        <a href="mailto:<?php echo htmlspecialchars($detail_data[0]['email_1']); ?>" class="action-btn btn-email">
                            <i class="fas fa-envelope"></i>
                            Send Email
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Review Section -->
        <?php if(!empty($detail_data[0]['review'])): ?>
        <div class="review-section">
            <h4 class="review-title">
                <i class="fas fa-star"></i>
                Review & Rating
            </h4>
            <p class="review-text"><?php echo nl2br(htmlspecialchars($detail_data[0]['review'])); ?></p>
        </div>
        <?php endif; ?>
    </div>
</section>

<script>
function getDirections(latitude, longitude) {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var currentLatitude = position.coords.latitude;
            var currentLongitude = position.coords.longitude;
            var url = "https://www.google.com/maps/dir/" + currentLatitude + "," + currentLongitude + "/" + latitude + "," + longitude;
            window.open(url, "_blank");
        }, function(error) {
            // Fallback: Open location directly on map
            var url = "https://www.google.com/maps/search/?api=1&query=" + latitude + "," + longitude;
            window.open(url, "_blank");
        });
    } else {
        var url = "https://www.google.com/maps/search/?api=1&query=" + latitude + "," + longitude;
        window.open(url, "_blank");
    }
}
</script>

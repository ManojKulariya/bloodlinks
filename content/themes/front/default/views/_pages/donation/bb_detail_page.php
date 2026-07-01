<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<style>
.bloodbank-detail-section {
    padding: 60px 0;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    min-height: 100vh;
}

.bloodbank-hero-card {
    background: linear-gradient(135deg, #b40028 0%, #8b0000 100%);
    border-radius: 20px;
    padding: 50px 40px;
    margin-bottom: 40px;
    box-shadow: 0 20px 60px rgba(180, 0, 40, 0.15);
    position: relative;
    overflow: hidden;
}

.bloodbank-hero-card::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 400px;
    height: 400px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 50%;
}

.bloodbank-hero-card::after {
    content: '';
    position: absolute;
    bottom: -30%;
    left: -10%;
    width: 300px;
    height: 300px;
    background: rgba(255, 255, 255, 0.03);
    border-radius: 50%;
}

.bloodbank-category-badge {
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

.bloodbank-title {
    color: #fff;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 15px;
    line-height: 1.3;
    position: relative;
    z-index: 1;
}

.bloodbank-address-hero {
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
    min-width: 140px;
    font-size: 14px;
}

.info-value {
    color: #1a1a2e;
    font-weight: 500;
    flex: 1;
}

.component-badge {
    display: inline-block;
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: #fff;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 500;
    margin: 3px 5px 3px 0;
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

.officer-card {
    background: linear-gradient(135deg, #f8f9fa 0%, #fff 100%);
    border-radius: 12px;
    padding: 20px;
    margin-top: 15px;
    border-left: 4px solid #b40028;
}

.officer-name {
    font-weight: 600;
    color: #1a1a2e;
    font-size: 16px;
    margin-bottom: 8px;
}

.officer-details {
    color: #6c757d;
    font-size: 14px;
    line-height: 1.6;
}

.officer-details i {
    width: 18px;
    color: #b40028;
}

@media (max-width: 768px) {
    .bloodbank-detail-section {
        padding: 30px 0;
    }
    
    .bloodbank-hero-card {
        padding: 30px 20px;
        border-radius: 16px;
        margin-bottom: 25px;
    }
    
    .bloodbank-title {
        font-size: 1.75rem;
    }
    
    .bloodbank-address-hero {
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
        min-width: auto;
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

<section class="bloodbank-detail-section">
    <div class="container">
        <!-- Back Button -->
        <div class="back-btn-section">
            <a href="javascript:history.back()" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Back to Blood Bank List
            </a>
        </div>

        <!-- Hero Card -->
        <div class="bloodbank-hero-card">
            <span class="bloodbank-category-badge">
                <i class="fas fa-tint"></i>
                <?php echo htmlspecialchars($detail_data[0]['category'] ?? 'Blood Bank'); ?>
            </span>
            <h1 class="bloodbank-title"><?php echo htmlspecialchars($detail_data[0]['blood_bank_name']); ?></h1>
            <p class="bloodbank-address-hero">
                <i class="fas fa-map-marker-alt"></i>
                <?php echo htmlspecialchars($detail_data[0]['address']); ?>, 
                <?php echo htmlspecialchars($detail_data[0]['city'] ?? $detail_data[0]['district']); ?>, 
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
                    
                    <?php if(!empty($detail_data[0]['helpline'])): ?>
                    <div class="info-item">
                        <span class="info-label">Helpline</span>
                        <span class="info-value">
                            <a href="tel:<?php echo htmlspecialchars($detail_data[0]['helpline']); ?>" style="color: #b40028;">
                                <?php echo htmlspecialchars($detail_data[0]['helpline']); ?>
                            </a>
                        </span>
                    </div>
                    <?php endif; ?>
                    
                    <?php if(!empty($detail_data[0]['contact_no'])): ?>
                    <div class="info-item">
                        <span class="info-label">Contact No</span>
                        <span class="info-value">
                            <a href="tel:<?php echo htmlspecialchars($detail_data[0]['contact_no']); ?>" style="color: #b40028;">
                                <?php echo htmlspecialchars($detail_data[0]['contact_no']); ?>
                            </a>
                        </span>
                    </div>
                    <?php endif; ?>
                    
                    <?php if(!empty($detail_data[0]['mobile'])): ?>
                    <div class="info-item">
                        <span class="info-label">Mobile</span>
                        <span class="info-value">
                            <a href="tel:<?php echo htmlspecialchars($detail_data[0]['mobile']); ?>" style="color: #b40028;">
                                <?php echo htmlspecialchars($detail_data[0]['mobile']); ?>
                            </a>
                        </span>
                    </div>
                    <?php endif; ?>
                    
                    <?php if(!empty($detail_data[0]['email'])): ?>
                    <div class="info-item">
                        <span class="info-label">Email</span>
                        <span class="info-value">
                            <a href="mailto:<?php echo htmlspecialchars($detail_data[0]['email']); ?>" style="color: #b40028;">
                                <?php echo htmlspecialchars($detail_data[0]['email']); ?>
                            </a>
                        </span>
                    </div>
                    <?php endif; ?>
                    
                    <?php if(!empty($detail_data[0]['fax'])): ?>
                    <div class="info-item">
                        <span class="info-label">Fax</span>
                        <span class="info-value"><?php echo htmlspecialchars($detail_data[0]['fax']); ?></span>
                    </div>
                    <?php endif; ?>
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
                        <span class="info-label">City/District</span>
                        <span class="info-value"><?php echo htmlspecialchars($detail_data[0]['city'] ?? $detail_data[0]['district']); ?></span>
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

        <!-- Blood Components Available -->
        <?php if(!empty($detail_data[0]['blood_component_available'])): ?>
        <div class="row">
            <div class="col-12">
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="info-icon">
                            <i class="fas fa-tint"></i>
                        </div>
                        <h3 class="info-card-title">Blood Components Available</h3>
                    </div>
                    <div>
                        <?php 
                        $components = explode(',', $detail_data[0]['blood_component_available']);
                        foreach($components as $component): 
                            $component = trim($component);
                            if(!empty($component)):
                        ?>
                            <span class="component-badge"><?php echo htmlspecialchars($component); ?></span>
                        <?php 
                            endif;
                        endforeach; 
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Nodal Officer Information -->
        <?php if(!empty($detail_data[0]['nodal_officer'])): ?>
        <div class="row">
            <div class="col-12">
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="info-icon">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <h3 class="info-card-title">Nodal Officer</h3>
                    </div>
                    
                    <div class="officer-card">
                        <div class="officer-name">
                            <i class="fas fa-user"></i>
                            <?php echo htmlspecialchars($detail_data[0]['nodal_officer']); ?>
                            <?php if(!empty($detail_data[0]['qualification_nodal_officer'])): ?>
                                <span style="color: #6c757d; font-weight: 400; font-size: 14px;">
                                    (<?php echo htmlspecialchars($detail_data[0]['qualification_nodal_officer']); ?>)
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="officer-details">
                            <?php if(!empty($detail_data[0]['contact_nodal_officer'])): ?>
                                <div><i class="fas fa-phone"></i> <?php echo htmlspecialchars($detail_data[0]['contact_nodal_officer']); ?></div>
                            <?php endif; ?>
                            <?php if(!empty($detail_data[0]['mobile_nodal_officer'])): ?>
                                <div><i class="fas fa-mobile-alt"></i> <?php echo htmlspecialchars($detail_data[0]['mobile_nodal_officer']); ?></div>
                            <?php endif; ?>
                            <?php if(!empty($detail_data[0]['email_nodal_officer'])): ?>
                                <div><i class="fas fa-envelope"></i> 
                                    <a href="mailto:<?php echo htmlspecialchars($detail_data[0]['email_nodal_officer']); ?>" style="color: #b40028;">
                                        <?php echo htmlspecialchars($detail_data[0]['email_nodal_officer']); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Action Buttons -->
        <div class="action-buttons-section">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <?php if(!empty($detail_data[0]['latitude']) && !empty($detail_data[0]['longitude'])): ?>
                        <button class="action-btn btn-directions" onclick="getDirections(<?php echo $detail_data[0]['latitude']; ?>, <?php echo $detail_data[0]['longitude']; ?>)">
                            <i class="fas fa-directions"></i>
                            Get Directions
                        </button>
                    <?php endif; ?>
                </div>
                <div class="col-lg-4 col-md-6">
                    <?php if(!empty($detail_data[0]['helpline']) || !empty($detail_data[0]['contact_no']) || !empty($detail_data[0]['mobile'])): ?>
                        <a href="tel:<?php echo htmlspecialchars($detail_data[0]['helpline'] ?? $detail_data[0]['contact_no'] ?? $detail_data[0]['mobile']); ?>" class="action-btn btn-call">
                            <i class="fas fa-phone-alt"></i>
                            Call Now
                        </a>
                    <?php endif; ?>
                </div>
                <div class="col-lg-4 col-md-6">
                    <?php if(!empty($detail_data[0]['email'])): ?>
                        <a href="mailto:<?php echo htmlspecialchars($detail_data[0]['email']); ?>" class="action-btn btn-email">
                            <i class="fas fa-envelope"></i>
                            Send Email
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
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

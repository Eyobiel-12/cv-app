<!-- Services Section-->
<section class="section-card py-5" id="services">
    <div class="container px-5">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bolder"><span class="text-gradient d-inline">{{ __('messages.services') }}</span></h2>
            <p class="lead fw-light mb-4">{{ __('messages.what_i_offer') }}</p>
        </div>
        
        <!-- Modern Services Grid -->
        <div class="row g-4 justify-content-center">
            <!-- Service Card 1 - Web Development -->
            <div class="col-lg-4 col-md-6">
                <div class="service-card h-100">
                    <div class="service-icon-wrapper">
                        <div class="service-icon">
                            <i class="bi bi-code-slash"></i>
                        </div>
                        <div class="service-icon-bg"></div>
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">{{ __('messages.web_development') }}</h3>
                        <p class="service-description">{{ __('messages.web_development_desc') }}</p>
                        <div class="service-features">
                            <span class="feature-tag">Laravel</span>
                            <span class="feature-tag">React</span>
                            <span class="feature-tag">Vue.js</span>
                        </div>
                    </div>
                    <div class="service-hover-effect"></div>
                </div>
            </div>

            <!-- Service Card 2 - Mobile Development -->
            <div class="col-lg-4 col-md-6">
                <div class="service-card h-100">
                    <div class="service-icon-wrapper">
                        <div class="service-icon">
                            <i class="bi bi-phone"></i>
                        </div>
                        <div class="service-icon-bg"></div>
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">{{ __('messages.mobile_app_development') }}</h3>
                        <p class="service-description">{{ __('messages.mobile_app_development_desc') }}</p>
                        <div class="service-features">
                            <span class="feature-tag">React Native</span>
                            <span class="feature-tag">Flutter</span>
                            <span class="feature-tag">iOS/Android</span>
                        </div>
                    </div>
                    <div class="service-hover-effect"></div>
                </div>
            </div>

            <!-- Service Card 3 - Database Design -->
            <div class="col-lg-4 col-md-6">
                <div class="service-card h-100">
                    <div class="service-icon-wrapper">
                        <div class="service-icon">
                            <i class="bi bi-database"></i>
                        </div>
                        <div class="service-icon-bg"></div>
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">{{ __('messages.database_design') }}</h3>
                        <p class="service-description">{{ __('messages.database_design_desc') }}</p>
                        <div class="service-features">
                            <span class="feature-tag">MySQL</span>
                            <span class="feature-tag">PostgreSQL</span>
                            <span class="feature-tag">MongoDB</span>
                        </div>
                    </div>
                    <div class="service-hover-effect"></div>
                </div>
            </div>

            <!-- Service Card 4 - API Development -->
            <div class="col-lg-4 col-md-6">
                <div class="service-card h-100">
                    <div class="service-icon-wrapper">
                        <div class="service-icon">
                            <i class="bi bi-cloud-arrow-up"></i>
                        </div>
                        <div class="service-icon-bg"></div>
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">API Development</h3>
                        <p class="service-description">RESTful en GraphQL API's ontwikkelen met Laravel, inclusief authenticatie en documentatie.</p>
                        <div class="service-features">
                            <span class="feature-tag">REST API</span>
                            <span class="feature-tag">GraphQL</span>
                            <span class="feature-tag">Sanctum</span>
                        </div>
                    </div>
                    <div class="service-hover-effect"></div>
                </div>
            </div>

            <!-- Service Card 5 - DevOps -->
            <div class="col-lg-4 col-md-6">
                <div class="service-card h-100">
                    <div class="service-icon-wrapper">
                        <div class="service-icon">
                            <i class="bi bi-gear"></i>
                        </div>
                        <div class="service-icon-bg"></div>
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">DevOps & Deployment</h3>
                        <p class="service-description">Automatisering van deployment processen en server configuratie voor optimale prestaties.</p>
                        <div class="service-features">
                            <span class="feature-tag">Docker</span>
                            <span class="feature-tag">AWS</span>
                            <span class="feature-tag">CI/CD</span>
                        </div>
                    </div>
                    <div class="service-hover-effect"></div>
                </div>
            </div>

            <!-- Service Card 6 - Consulting -->
            <div class="col-lg-4 col-md-6">
                <div class="service-card h-100">
                    <div class="service-icon-wrapper">
                        <div class="service-icon">
                            <i class="bi bi-lightbulb"></i>
                        </div>
                        <div class="service-icon-bg"></div>
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Tech Consulting</h3>
                        <p class="service-description">Strategisch advies over technologie keuzes en architectuur voor jouw project.</p>
                        <div class="service-features">
                            <span class="feature-tag">Architectuur</span>
                            <span class="feature-tag">Scaling</span>
                            <span class="feature-tag">Security</span>
                        </div>
                    </div>
                    <div class="service-hover-effect"></div>
                </div>
            </div>
        </div>
    </div>
</section>
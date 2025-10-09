<!-- Modern Projects Section -->
<section class="modern-projects-section">
    <div class="projects-container">
        <!-- Header Section -->
        <div class="projects-header">
            <div class="header-content">
                <div class="header-logo">
                    <img src="{{ asset('assets/work.png') }}" alt="MC" class="logo-img">
                </div>
                <div class="header-info">
                    <h1 class="header-title">{{ __('messages.projects') }}</h1>
                </div>
                <div class="header-status">
                    <div class="status-badge">
                        <div class="status-dot"></div>
                        <span class="status-text">What I'm working on</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Projects Grid -->
        <div class="projects-grid" id="project-cards-container">
            <!-- Project Cards will be loaded here -->
        </div>
    </div>
</section>

<!-- Project Detail Modal -->
<div class="modal fade" id="projectDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bolder" id="modal-project-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <div id="modal-project-image" class="rounded-3 overflow-hidden"></div>
                    </div>
                    <div class="col-md-6">
                        <div id="modal-project-languages" class="mb-3"></div>
                        <div id="modal-project-description" class="mb-4"></div>
                        <div id="modal-project-link"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Modern Projects Section */
.modern-projects-section {
    background-color: #181824;
    min-height: 100vh;
    padding: 60px 0;
    transition: background-color 0.3s ease;
}

/* Light mode */
body:not(.darkmode) .modern-projects-section {
    background-color: #f8f9fa;
}

.projects-container {
    max-width: 1100px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Header Section */
.projects-header {
    margin-bottom: 60px;
}

.header-content {
    display: flex;
    align-items: center;
    gap: 18px;
    background-color: rgba(32, 32, 40, 0.32);
    border-radius: 38px;
    padding: 20px 30px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(10px);
}

/* Light mode header */
body:not(.darkmode) .header-content {
    background-color: rgba(255, 255, 255, 0.8);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.05);
}

.header-logo {
    flex-shrink: 0;
}

.logo-img {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    border: 2px solid #23272b;
    object-fit: cover;
}

/* Light mode logo */
body:not(.darkmode) .logo-img {
    border-color: #e9ecef;
}

.header-info {
    flex: 1;
}

.header-title {
    font-size: 2rem;
    font-weight: 600;
    color: #ffffff;
    margin: 0;
    letter-spacing: 0.03em;
}

/* Light mode title */
body:not(.darkmode) .header-title {
    color: #212529;
}

.header-status {
    flex-shrink: 0;
}

.status-badge {
    display: flex;
    align-items: center;
    gap: 8px;
    background-color: rgba(59, 130, 246, 0.1);
    border: 1px solid rgba(59, 130, 246, 0.2);
    border-radius: 18px;
    padding: 8px 18px;
}

.status-dot {
    width: 8px;
    height: 8px;
    background-color: #3b82f6;
    border-radius: 50%;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.status-text {
    font-size: 0.9rem;
    font-weight: 500;
    color: #3b82f6;
}

/* Projects Grid */
.projects-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 32px;
}

/* Project Cards */
.project-card {
    background-color: #23272b;
    border: 1px solid #2d323a;
    border-radius: 18px;
    overflow: hidden;
    transition: all 0.18s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
    min-height: 340px;
    display: flex;
    flex-direction: column;
}

/* Light mode project cards */
body:not(.darkmode) .project-card {
    background-color: #ffffff;
    border-color: #e9ecef;
}

.project-card:hover {
    transform: translateY(-4px) scale(1.02);
    border-color: #3b82f6;
    box-shadow: 0 12px 48px rgba(59, 130, 246, 0.2);
}

.project-image-container {
    position: relative;
    width: 100%;
    height: 180px;
    overflow: hidden;
}

.project-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.project-card:hover .project-image {
    transform: scale(1.05);
}

.project-image-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #3b82f6, #8b5cf6);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    font-size: 0.9rem;
    font-weight: 500;
}

.project-link-btn {
    position: absolute;
    top: 12px;
    right: 12px;
    width: 36px;
    height: 36px;
    background-color: rgba(59, 130, 246, 0.9);
    color: #ffffff;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    opacity: 0;
    transform: translateY(-10px);
}

.project-card:hover .project-link-btn {
    opacity: 1;
    transform: translateY(0);
}

.project-link-btn:hover {
    background-color: #3b82f6;
    transform: scale(1.1);
}

.project-content {
    padding: 24px 22px 18px 22px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

/* Placeholder cards */
.project-card.placeholder {
    opacity: 0.85;
    cursor: default;
}
.project-card.placeholder .view-details-btn {
    opacity: 0.6;
    cursor: not-allowed;
}

.project-title {
    font-size: 1.18rem;
    font-weight: 700;
    color: #ffffff;
    margin: 0 0 12px 0;
    line-height: 1.3;
}

/* Light mode title */
body:not(.darkmode) .project-title {
    color: #212529;
}

.project-tech {
    margin-bottom: 16px;
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
}

.tech-badge {
    background-color: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 500;
    border: 1px solid rgba(59, 130, 246, 0.2);
    transition: all 0.3s ease;
}

.more-badge {
    background-color: rgba(108, 117, 125, 0.1);
    color: #6c757d;
    border-color: rgba(108, 117, 125, 0.2);
}

.project-description {
    color: #b0b6be;
    font-size: 1.01rem;
    line-height: 1.5;
    margin: 0 0 20px 0;
    flex: 1;
}

/* Light mode description */
body:not(.darkmode) .project-description {
    color: #6c757d;
}

.view-details-btn {
    background: linear-gradient(135deg, #3b82f6, #8b5cf6);
    color: #ffffff;
    border: none;
    border-radius: 12px;
    padding: 10px 20px;
    font-size: 0.9rem;
    font-weight: 600;
    transition: all 0.3s ease;
    align-self: flex-start;
}

.view-details-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
}

/* Responsive Design */
@media (max-width: 600px) {
    .projects-grid {
        grid-template-columns: 1fr;
        gap: 24px;
    }
    
    .header-content {
        flex-direction: column;
        text-align: center;
        gap: 12px;
        padding: 16px 20px;
    }
    
    .header-title {
        font-size: 1.6rem;
    }
    
    .projects-container {
        padding: 0 15px;
    }
    
    .project-content {
        padding: 20px 18px 16px 18px;
    }
    
    .project-title {
        font-size: 1.1rem;
    }
    
    .project-description {
        font-size: 0.95rem;
    }
}

@media (max-width: 480px) {
    .project-content {
        padding: 18px 16px 14px 16px;
    }
    
    .project-title {
        font-size: 1rem;
    }
    
    .project-description {
        font-size: 0.9rem;
    }
}
</style>

<script>
    // Globale variabele om projectgegevens op te slaan
    let projectsData = [];
    
    // Bootstrap modal object
    let projectModal;
    
    const callAllPostApi = async () => {
        document.getElementById('loading-div').classList.remove('d-none');
        try {
            const response = await axios.get('/getAllProjectDetails');
            document.getElementById('loading-div').classList.add('d-none');

            if (response.status === 200) {
                projectsData = response.data; // Sla projecten op in globale variabele

                // Voeg 3 extra projecten toe zodat ze exact als de rest renderen
                const extraProjects = [
                    {
                        title: 'OnTourly',
                        details: 'Platform voor tour- & eventmanagement: bookings, contracts, logistics.',
                        thumbLink: `{{ asset('assets/ontourly.png') }}`,
                        previewLink: 'https://ontourly.com',
                        languages: [
                            { name: 'Laravel', color_code: '#6610f2', icon: '' },
                            { name: 'PHP', color_code: '#777bb3', icon: '' },
                            { name: 'HTML', color_code: '#e34f26', icon: '' },
                            { name: 'JavaScript', color_code: '#f59e0b', icon: '' },
                            { name: 'SQL', color_code: '#00758f', icon: '' },
                            { name: 'CSS', color_code: '#264de4', icon: '' }
                        ]
                    },
                    {
                        title: 'Partijzorg',
                        details: 'Specialist in thuiszorg, werving en selectie van zorgpersoneel.',
                        thumbLink: `{{ asset('assets/partijzorg.png') }}`,
                        previewLink: 'https://partijzorg.nl',
                        languages: [
                            { name: 'PHP', color_code: '#0d6efd', icon: '' },
                            { name: 'Laravel', color_code: '#6610f2', icon: '' },
                            { name: 'JavaScript', color_code: '#f59e0b', icon: '' },
                        ]
                    },
                    {
                        title: 'IA Ticket',
                        details: 'Vind de beste events. Gratis registratie, gegarandeerde entree.',
                        thumbLink: `{{ asset('assets/iaticket.png') }}`,
                        previewLink: 'https://iaticket.com',
                        languages: [
                            { name: 'PHP', color_code: '#0d6efd', icon: '' },
                            { name: 'Laravel', color_code: '#6610f2', icon: '' },
                            { name: 'JavaScript', color_code: '#f59e0b', icon: '' },
                        ]
                    }
                ];
                projectsData = [...projectsData, ...extraProjects];

                // Forceer badges: deze projecten zijn gebouwd met WordPress
                const wordpressTitles = ['house of lush', 'despit hold', 'nieuwspitholt', 'romys touch', 'partijzorg'];
                projectsData = projectsData.map(p => {
                    const titleLc = (p.title || '').toLowerCase();
                    if (wordpressTitles.includes(titleLc)) {
                        p.languages = [
                            { name: 'WordPress', color_code: '#21759b', icon: '' }
                        ];
                    } else if (titleLc === 'oliviwilson') {
                        p.languages = [
                            { name: 'Shopify', color_code: '#95BF47', icon: '' }
                        ];
                    }
                    return p;
                });

                // Sorteer projecten: eerst platform (WordPress -> Shopify -> overige), daarna titel
                const platformRank = (p) => {
                    const langs = Array.isArray(p.languages) ? p.languages : [];
                    const names = langs.map(l => (l.name || '').toLowerCase());
                    if (names.includes('wordpress')) return 0;
                    if (names.includes('shopify')) return 1;
                    return 2;
                };
                projectsData.sort((a, b) => {
                    const ra = platformRank(a);
                    const rb = platformRank(b);
                    if (ra !== rb) return ra - rb;
                    const ta = (a.title || '').toLowerCase();
                    const tb = (b.title || '').toLowerCase();
                    return ta.localeCompare(tb);
                });
                const projectsContainer = document.getElementById('project-cards-container');
                projectsContainer.innerHTML = ''; // Clear existing content
                
                if (projectsData.length === 0) {
                    projectsContainer.innerHTML = `
                        <div class="col-12">
                            <div class="alert alert-info text-center">
                                <i class="bi bi-info-circle me-2"></i>{{ __('messages.no_projects_found') }}
                            </div>
                        </div>
                    `;
                    return;
                }
                
                // Maak moderne project kaartjes
                projectsData.forEach((project, index) => {
                    // Genereer HTML voor programmeertalen badges
                    let languagesHTML = '';
                    if (project.languages && project.languages.length > 0) {
                        project.languages.slice(0, 3).forEach(lang => {
                            const bgColor = lang.color_code || '#6c757d';
                            const icon = lang.icon ? `<i class="${lang.icon} me-1"></i>` : '';
                            languagesHTML += `
                                <span class="tech-badge" style="background-color: ${bgColor}; color: #ffffff; border: none;">
                                    ${icon}${lang.name}
                                </span>
                            `;
                        });
                        
                        // Toon een '+X meer' badge als er meer dan 3 talen zijn
                        if (project.languages.length > 3) {
                            languagesHTML += `
                                <span class="tech-badge more-badge">
                                    +${project.languages.length - 3} {{ __('messages.more') }}
                                </span>
                            `;
                        }
                    }
                    
                    // Genereer HTML voor project thumbnail
                    let thumbnailHTML = '';
                    if (project.thumbLink && project.thumbLink.trim() !== '') {
                        const imgSrc = project.thumbLink.startsWith('http') ? 
                            project.thumbLink : 
                            `{{ asset('') }}${project.thumbLink}`;
                        thumbnailHTML = `<img class="project-image" src="${imgSrc}" alt="${project.title}">`;
                    } else {
                        thumbnailHTML = `
                            <div class="project-image-placeholder">
                                <span class="placeholder-text">{{ __('messages.no_image') }}</span>
                            </div>
                        `;
                    }
                    
                    // Voeg het project toe aan de container
                    const projectCard = `
                        <div class="project-card" data-project-index="${index}">
                            <div class="project-image-container">
                                ${thumbnailHTML}
                                ${project.previewLink ? `
                                    <a href="${project.previewLink}" target="_blank" class="project-link-btn" title="Bekijk live project">
                                        <i class="bi bi-link-45deg"></i>
                                    </a>
                                ` : ''}
                            </div>
                            <div class="project-content">
                                <h3 class="project-title">${project.title}</h3>
                                <div class="project-tech">
                                    ${languagesHTML}
                                </div>
                                <p class="project-description">${project.details.substring(0, 120)}${project.details.length > 120 ? '...' : ''}</p>
                                <button class="view-details-btn">
                                    <i class="bi bi-eye me-1"></i>{{ __('messages.view_details') }}
                                </button>
                            </div>
                        </div>
                    `;
                    
                    projectsContainer.innerHTML += projectCard;
                });
                
                // Voeg event listeners toe aan de kaartjes
                document.querySelectorAll('.project-card').forEach(card => {
                    card.addEventListener('click', function(e) {
                        // Voorkom dat de klik doorgaat als op de link is geklikt
                        if (e.target.closest('a[target="_blank"]')) {
                            return;
                        }
                        
                        const projectIndex = this.getAttribute('data-project-index');
                        showProjectDetails(projectIndex);
                    });
                });
                
                // Voeg event listeners toe aan de detail knoppen
                document.querySelectorAll('.view-details-btn').forEach(btn => {
                    btn.addEventListener('click', function(e) {
                        e.stopPropagation(); // Voorkom dat de klik doorgaat naar de kaart
                        const projectIndex = this.closest('.project-card').getAttribute('data-project-index');
                        showProjectDetails(projectIndex);
                    });
                });

                // Geen aparte statische rendering: extra projecten zijn mee-gerenderd in dezelfde loop
            }
        } catch (error) {
            console.error('Error fetching projects:', error);
            document.getElementById('loading-div').classList.add('d-none');
            document.getElementById('project-cards-container').innerHTML = `
                <div class="col-12">
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle me-2"></i>{{ __('messages.error_loading_projects') }}
                    </div>
                </div>
            `;
        }
    };
    
    // Functie om projectdetails te tonen in de modal
    function showProjectDetails(index) {
        const project = projectsData[index];
        if (!project) return;
        
        // Vul de modal met projectgegevens
        document.getElementById('modal-project-title').textContent = project.title;
        
        // Afbeelding
        const imageContainer = document.getElementById('modal-project-image');
        if (project.thumbLink && project.thumbLink.trim() !== '') {
            const imgSrc = project.thumbLink.startsWith('http') ?
                project.thumbLink :
                `{{ asset('') }}${project.thumbLink}`; // Zelfde resolver als kaartjes
            imageContainer.innerHTML = `<img src="${imgSrc}" alt="${project.title}" class="img-fluid rounded-3">`;
        } else {
            imageContainer.innerHTML = `
                <div class="bg-light rounded-3 d-flex align-items-center justify-content-center" style="height: 250px;">
                    <span class="text-muted">{{ __('messages.no_image') }}</span>
                </div>
            `;
        }
        
        // Programmeertalen
        const languagesContainer = document.getElementById('modal-project-languages');
        if (project.languages && project.languages.length > 0) {
            let languagesHTML = '';
            project.languages.forEach(lang => {
                const bgColor = lang.color_code || '#6c757d';
                const icon = lang.icon ? `<i class="${lang.icon} me-1"></i>` : '';
                languagesHTML += `
                    <span class="badge me-1 mb-1" style="background-color: ${bgColor}; color: #ffffff; border: none; font-size: 0.85rem; padding: 0.35em 0.65em;">
                        ${icon}${lang.name}
                    </span>
                `;
            });
            languagesContainer.innerHTML = languagesHTML;
        } else {
            languagesContainer.innerHTML = '';
        }
        
        // Beschrijving
        document.getElementById('modal-project-description').innerHTML = `<p>${project.details}</p>`;
        
        // Link
        const linkContainer = document.getElementById('modal-project-link');
        if (project.previewLink && project.previewLink.trim() !== '') {
            linkContainer.innerHTML = `
                <a href="${project.previewLink}" target="_blank" class="btn btn-primary">
                    <i class="bi bi-link-45deg me-1"></i>{{ __('messages.view_project') }}
                </a>
            `;
        } else {
            linkContainer.innerHTML = '';
        }
        
        // Toon de modal
        projectModal.show();
    }
    
    // Initialiseer de pagina wanneer deze is geladen
    document.addEventListener('DOMContentLoaded', function() {
        // Initialiseer de Bootstrap modal
        projectModal = new bootstrap.Modal(document.getElementById('projectDetailModal'));
        
        // Laad de projecten
        callAllPostApi();
    });
</script>

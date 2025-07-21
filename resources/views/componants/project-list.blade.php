<!-- Projects Section-->
<section class="py-5">
    <div class="container px-5 mb-5">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bolder mb-0"><span class="text-gradient d-inline">{{ __('messages.projects') }}</span></h1>
        </div>
        <div class="row" id="project-cards-container">
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
                
                // Maak project kaartjes
                projectsData.forEach((project, index) => {
                    // Genereer HTML voor programmeertalen badges
                    let languagesHTML = '';
                    if (project.languages && project.languages.length > 0) {
                        project.languages.slice(0, 3).forEach(lang => {
                            const bgColor = lang.color_code || '#6c757d';
                            const icon = lang.icon ? `<i class="${lang.icon} me-1"></i>` : '';
                            languagesHTML += `
                                <span class="badge me-1 mb-1" style="background-color: ${bgColor}; font-size: 0.75rem; padding: 0.25em 0.5em;">
                                    ${icon}${lang.name}
                                </span>
                            `;
                        });
                        
                        // Toon een '+X meer' badge als er meer dan 3 talen zijn
                        if (project.languages.length > 3) {
                            languagesHTML += `
                                <span class="badge bg-secondary me-1 mb-1" style="font-size: 0.75rem; padding: 0.25em 0.5em;">
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
                            `/storage/${project.thumbLink}`;
                        thumbnailHTML = `<img class="card-img-top" src="${imgSrc}" alt="${project.title}" style="height: 180px; object-fit: cover;">`;
                    } else {
                        thumbnailHTML = `
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 180px;">
                                <span class="text-muted">{{ __('messages.no_image') }}</span>
                            </div>
                        `;
                    }
                    
                    // Voeg het project toe aan de container
                    const projectCard = `
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 shadow-sm border-0 rounded-4 project-card" data-project-index="${index}">
                                <div class="position-relative">
                                    ${thumbnailHTML}
                                    <div class="position-absolute top-0 end-0 p-2">
                                        ${project.previewLink ? `
                                            <a href="${project.previewLink}" target="_blank" class="btn btn-sm btn-light rounded-circle shadow-sm" title="Bekijk live project">
                                                <i class="bi bi-link-45deg"></i>
                                            </a>
                                        ` : ''}
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title fw-bold mb-2">${project.title}</h5>
                                    <div class="mb-3">
                                        ${languagesHTML}
                                    </div>
                                    <p class="card-text text-muted small mb-3">${project.details.substring(0, 100)}${project.details.length > 100 ? '...' : ''}</p>
                                    <button class="btn btn-primary btn-sm view-details-btn">
                                        <i class="bi bi-eye me-1"></i>{{ __('messages.view_details') }}
                                    </button>
                                </div>
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
                `/storage/${project.thumbLink}`;
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
                    <span class="badge me-1 mb-1" style="background-color: ${bgColor}; font-size: 0.85rem; padding: 0.35em 0.65em;">
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

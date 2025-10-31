import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Sidebar toggle functionality
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    // Get sidebar state from localStorage
    const sidebarState = localStorage.getItem('sidebarState') || 'expanded';
    
    // Apply saved state
    if (window.innerWidth >= 1024) {
        if (sidebarState === 'collapsed') {
            sidebar?.classList.add('collapsed');
            sidebar?.classList.remove('expanded');
            mainContent?.classList.add('sidebar-collapsed');
            mainContent?.classList.remove('sidebar-expanded');
        } else {
            sidebar?.classList.add('expanded');
            sidebar?.classList.remove('collapsed');
            mainContent?.classList.add('sidebar-expanded');
            mainContent?.classList.remove('sidebar-collapsed');
        }
    }

    // Toggle sidebar
    sidebarToggle?.addEventListener('click', function() {
        if (window.innerWidth < 1024) {
            // Mobile: toggle sidebar visibility
            sidebar?.classList.toggle('expanded');
            sidebar?.classList.toggle('collapsed');
            sidebarOverlay?.classList.toggle('hidden');
        } else {
            // Desktop: toggle between expanded and collapsed
            const isExpanded = sidebar?.classList.contains('expanded');
            
            if (isExpanded) {
                sidebar?.classList.remove('expanded');
                sidebar?.classList.add('collapsed');
                mainContent?.classList.remove('sidebar-expanded');
                mainContent?.classList.add('sidebar-collapsed');
                localStorage.setItem('sidebarState', 'collapsed');
            } else {
                sidebar?.classList.remove('collapsed');
                sidebar?.classList.add('expanded');
                mainContent?.classList.remove('sidebar-collapsed');
                mainContent?.classList.add('sidebar-expanded');
                localStorage.setItem('sidebarState', 'expanded');
            }
        }
    });

    // Close sidebar when clicking overlay (mobile)
    sidebarOverlay?.addEventListener('click', function() {
        sidebar?.classList.remove('expanded');
        sidebar?.classList.add('collapsed');
        sidebarOverlay?.classList.add('hidden');
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1024) {
            sidebarOverlay?.classList.add('hidden');
            const savedState = localStorage.getItem('sidebarState') || 'expanded';
            
            if (savedState === 'collapsed') {
                sidebar?.classList.add('collapsed');
                sidebar?.classList.remove('expanded');
                mainContent?.classList.add('sidebar-collapsed');
                mainContent?.classList.remove('sidebar-expanded');
            } else {
                sidebar?.classList.add('expanded');
                sidebar?.classList.remove('collapsed');
                mainContent?.classList.add('sidebar-expanded');
                mainContent?.classList.remove('sidebar-collapsed');
            }
        } else {
            sidebar?.classList.add('collapsed');
            sidebar?.classList.remove('expanded');
        }
    });
});

// Flash message auto-hide
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('[data-auto-dismiss]');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });
});

// Image preview for file uploads
window.previewImage = function(input, previewId) {
    const preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
};

// Confirm delete actions
window.confirmDelete = function(message = 'Are you sure you want to delete this item?') {
    return confirm(message);
};

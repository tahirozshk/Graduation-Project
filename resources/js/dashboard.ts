// Dashboard TypeScript Interactivity Module

interface FilterOptions {
    search?: string;
    status?: string;
    department?: string;
    type?: string;
}

// Utility function for debouncing
function debounce<T extends (...args: any[]) => any>(
    func: T,
    wait: number
): (...args: Parameters<T>) => void {
    let timeout: NodeJS.Timeout;
    return function executedFunction(...args: Parameters<T>) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Student Management
class StudentManager {
    private searchInput: HTMLInputElement | null;
    private statusFilter: HTMLSelectElement | null;
    private departmentFilter: HTMLSelectElement | null;
    private studentCards: NodeListOf<Element>;

    constructor() {
        this.searchInput = document.getElementById('searchInput') as HTMLInputElement;
        this.statusFilter = document.getElementById('statusFilter') as HTMLSelectElement;
        this.departmentFilter = document.getElementById('departmentFilter') as HTMLSelectElement;
        this.studentCards = document.querySelectorAll('.student-card');

        this.init();
    }

    private init(): void {
        if (!this.searchInput || !this.statusFilter || !this.departmentFilter) return;

        const debouncedFilter = debounce(() => this.filterStudents(), 300);

        this.searchInput.addEventListener('input', debouncedFilter);
        this.statusFilter.addEventListener('change', () => this.filterStudents());
        this.departmentFilter.addEventListener('change', () => this.filterStudents());
    }

    private filterStudents(): void {
        const searchTerm = this.searchInput?.value.toLowerCase() || '';
        const statusValue = this.statusFilter?.value.toLowerCase() || '';
        const departmentValue = this.departmentFilter?.value || '';

        let visibleCount = 0;

        this.studentCards.forEach((card: Element) => {
            const htmlCard = card as HTMLElement;
            const name = htmlCard.dataset.name || '';
            const email = htmlCard.dataset.email || '';
            const studentId = htmlCard.dataset.studentId || '';
            const status = htmlCard.dataset.status || '';
            const department = htmlCard.dataset.department || '';

            const matchesSearch = name.includes(searchTerm) || 
                                email.includes(searchTerm) || 
                                studentId.includes(searchTerm);
            const matchesStatus = !statusValue || status === statusValue;
            const matchesDepartment = !departmentValue || department === departmentValue;

            if (matchesSearch && matchesStatus && matchesDepartment) {
                htmlCard.style.display = 'block';
                visibleCount++;
            } else {
                htmlCard.style.display = 'none';
            }
        });

        this.updateResultsCount(visibleCount);
    }

    private updateResultsCount(count: number): void {
        const resultsElement = document.getElementById('resultsCount');
        if (resultsElement) {
            resultsElement.textContent = `Showing ${count} student(s)`;
        }
    }
}

// Project Management
class ProjectManager {
    private searchInput: HTMLInputElement | null;
    private statusFilter: HTMLSelectElement | null;
    private typeFilter: HTMLSelectElement | null;
    private projectCards: NodeListOf<Element>;

    constructor() {
        this.searchInput = document.getElementById('searchInput') as HTMLInputElement;
        this.statusFilter = document.getElementById('statusFilter') as HTMLSelectElement;
        this.typeFilter = document.getElementById('typeFilter') as HTMLSelectElement;
        this.projectCards = document.querySelectorAll('.project-card');

        this.init();
    }

    private init(): void {
        if (!this.searchInput || !this.statusFilter || !this.typeFilter) return;

        const debouncedFilter = debounce(() => this.filterProjects(), 300);

        this.searchInput.addEventListener('input', debouncedFilter);
        this.statusFilter.addEventListener('change', () => this.filterProjects());
        this.typeFilter.addEventListener('change', () => this.filterProjects());
    }

    private filterProjects(): void {
        const searchTerm = this.searchInput?.value.toLowerCase() || '';
        const statusValue = this.statusFilter?.value || '';
        const typeValue = this.typeFilter?.value || '';

        let visibleCount = 0;

        this.projectCards.forEach((card: Element) => {
            const htmlCard = card as HTMLElement;
            const title = htmlCard.dataset.title || '';
            const student = htmlCard.dataset.student || '';
            const status = htmlCard.dataset.status || '';
            const type = htmlCard.dataset.type || '';

            const matchesSearch = title.includes(searchTerm) || student.includes(searchTerm);
            const matchesStatus = !statusValue || status === statusValue;
            const matchesType = !typeValue || type === typeValue;

            if (matchesSearch && matchesStatus && matchesType) {
                htmlCard.style.display = 'block';
                visibleCount++;
            } else {
                htmlCard.style.display = 'none';
            }
        });
    }
}

// Report Management
class ReportManager {
    private searchInput: HTMLInputElement | null;
    private statusFilter: HTMLSelectElement | null;
    private reportRows: NodeListOf<Element>;

    constructor() {
        this.searchInput = document.getElementById('searchInput') as HTMLInputElement;
        this.statusFilter = document.getElementById('statusFilter') as HTMLSelectElement;
        this.reportRows = document.querySelectorAll('.report-row');

        this.init();
    }

    private init(): void {
        if (!this.searchInput || !this.statusFilter) return;

        const debouncedFilter = debounce(() => this.filterReports(), 300);

        this.searchInput.addEventListener('input', debouncedFilter);
        this.statusFilter.addEventListener('change', () => this.filterReports());
    }

    private filterReports(): void {
        const searchTerm = this.searchInput?.value.toLowerCase() || '';
        const statusValue = this.statusFilter?.value || '';

        this.reportRows.forEach((row: Element) => {
            const htmlRow = row as HTMLElement;
            const project = htmlRow.dataset.project || '';
            const student = htmlRow.dataset.student || '';
            const status = htmlRow.dataset.status || '';

            const matchesSearch = project.includes(searchTerm) || student.includes(searchTerm);
            const matchesStatus = !statusValue || status === statusValue;

            if (matchesSearch && matchesStatus) {
                htmlRow.style.display = '';
            } else {
                htmlRow.style.display = 'none';
            }
        });
    }
}

// Notification Management
class NotificationManager {
    private typeFilter: HTMLSelectElement | null;
    private readFilter: HTMLSelectElement | null;
    private notificationCards: NodeListOf<Element>;

    constructor() {
        this.typeFilter = document.getElementById('typeFilter') as HTMLSelectElement;
        this.readFilter = document.getElementById('readFilter') as HTMLSelectElement;
        this.notificationCards = document.querySelectorAll('.notification-card');

        this.init();
    }

    private init(): void {
        if (!this.typeFilter || !this.readFilter) return;

        this.typeFilter.addEventListener('change', () => this.filterNotifications());
        this.readFilter.addEventListener('change', () => this.filterNotifications());
    }

    private filterNotifications(): void {
        const typeValue = this.typeFilter?.value || '';
        const readValue = this.readFilter?.value || '';

        this.notificationCards.forEach((card: Element) => {
            const htmlCard = card as HTMLElement;
            const type = htmlCard.dataset.type || '';
            const read = htmlCard.dataset.read || '';

            const matchesType = !typeValue || type === typeValue;
            const matchesRead = !readValue || read === readValue;

            if (matchesType && matchesRead) {
                htmlCard.style.display = 'block';
            } else {
                htmlCard.style.display = 'none';
            }
        });
    }

    public async markAllAsRead(): Promise<void> {
        if (!confirm('Mark all notifications as read?')) return;

        try {
            const response = await fetch('/api/notifications/mark-all-read', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector<HTMLMetaElement>('meta[name="csrf-token"]')?.content || ''
                }
            });

            if (response.ok) {
                window.location.reload();
            } else {
                alert('Failed to mark notifications as read. Please try again.');
            }
        } catch (error) {
            console.error('Error marking notifications as read:', error);
            alert('An error occurred. Please try again.');
        }
    }
}

// Status Update Handler
class StatusUpdateHandler {
    public async updateStatus(entityType: string, entityId: number, newStatus: string): Promise<boolean> {
        try {
            const response = await fetch(`/api/${entityType}/${entityId}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector<HTMLMetaElement>('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({ status: newStatus })
            });

            return response.ok;
        } catch (error) {
            console.error(`Error updating ${entityType} status:`, error);
            return false;
        }
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => {
    // Check which page we're on and initialize appropriate manager
    if (document.querySelector('.student-card')) {
        new StudentManager();
    }
    
    if (document.querySelector('.project-card')) {
        new ProjectManager();
    }
    
    if (document.querySelector('.report-row')) {
        new ReportManager();
    }
    
    if (document.querySelector('.notification-card')) {
        new NotificationManager();
    }
});

// Export for global access
declare global {
    interface Window {
        dashboardManager: {
            statusUpdateHandler: StatusUpdateHandler;
        };
    }
}

window.dashboardManager = {
    statusUpdateHandler: new StatusUpdateHandler()
};

export { StudentManager, ProjectManager, ReportManager, NotificationManager, StatusUpdateHandler };


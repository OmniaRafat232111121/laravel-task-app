import './bootstrap';
import Alpine from 'alpinejs';

// Make Alpine available globally
window.Alpine = Alpine;

// User management functionality
window.UserManager = {
    users: [],
    selectedUsers: new Set(),
    showAddModal: false,
    showEditModal: false,
    showDeleteModal: false,
    showBulkDeleteModal: false,
    editingUser: null,
    newUser: { name: '', email: '' },
    
    init() {
        this.loadUsers();
        this.setupKeyboardShortcuts();
    },
    
    loadUsers() {
        // In a real app, this would fetch from an API
        this.users = [
            { id: 1, name: 'Alice Johnson', email: 'alice@example.com' },
            { id: 2, name: 'Bob Smith', email: 'bob@example.com' },
            { id: 3, name: 'Charlie Brown', email: 'charlie@example.com' },
            { id: 4, name: 'Diana Prince', email: 'diana@example.com' },
            { id: 5, name: 'Eve Wilson', email: 'eve@example.com' }
        ];
    },
    
    setupKeyboardShortcuts() {
        document.addEventListener('keydown', (e) => {
            // Ctrl/Cmd + N for new user
            if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
                e.preventDefault();
                this.openAddModal();
            }
            
            // Ctrl/Cmd + E for edit (if user is selected)
            if ((e.ctrlKey || e.metaKey) && e.key === 'e') {
                e.preventDefault();
                if (this.selectedUsers.size === 1) {
                    const userId = Array.from(this.selectedUsers)[0];
                    this.editUser(userId);
                }
            }
            
            // Delete key for delete
            if (e.key === 'Delete' && this.selectedUsers.size > 0) {
                e.preventDefault();
                if (this.selectedUsers.size === 1) {
                    this.openDeleteModal(Array.from(this.selectedUsers)[0]);
                } else {
                    this.openBulkDeleteModal();
                }
            }
            
            // Escape to close modals
            if (e.key === 'Escape') {
                this.closeAllModals();
            }
        });
    },
    
    openAddModal() {
        this.newUser = { name: '', email: '' };
        this.showAddModal = true;
        this.$nextTick(() => {
            document.getElementById('name-input')?.focus();
        });
    },
    
    openEditModal(userId) {
        const user = this.users.find(u => u.id === userId);
        if (user) {
            this.editingUser = { ...user };
            this.showEditModal = true;
            this.$nextTick(() => {
                document.getElementById('edit-name-input')?.focus();
            });
        }
    },
    
    openDeleteModal(userId) {
        this.editingUser = this.users.find(u => u.id === userId);
        this.showDeleteModal = true;
    },
    
    openBulkDeleteModal() {
        this.showBulkDeleteModal = true;
    },
    
    closeAllModals() {
        this.showAddModal = false;
        this.showEditModal = false;
        this.showDeleteModal = false;
        this.showBulkDeleteModal = false;
        this.editingUser = null;
    },
    
    addUser() {
        if (this.newUser.name && this.newUser.email) {
            const newId = Math.max(...this.users.map(u => u.id)) + 1;
            this.users.push({
                id: newId,
                name: this.newUser.name,
                email: this.newUser.email
            });
            this.closeAllModals();
            this.showNotification('User added successfully!', 'success');
        }
    },
    
    editUser(userId) {
        this.openEditModal(userId);
    },
    
    updateUser() {
        if (this.editingUser && this.editingUser.name && this.editingUser.email) {
            const index = this.users.findIndex(u => u.id === this.editingUser.id);
            if (index !== -1) {
                this.users[index] = { ...this.editingUser };
                this.closeAllModals();
                this.showNotification('User updated successfully!', 'success');
            }
        }
    },
    
    deleteUser(userId) {
        this.users = this.users.filter(u => u.id !== userId);
        this.selectedUsers.delete(userId);
        this.closeAllModals();
        this.showNotification('User deleted successfully!', 'success');
    },
    
    bulkDeleteUsers() {
        const userIdsToDelete = Array.from(this.selectedUsers);
        this.users = this.users.filter(u => !userIdsToDelete.includes(u.id));
        this.selectedUsers.clear();
        this.closeAllModals();
        this.showNotification(`${userIdsToDelete.length} users deleted successfully!`, 'success');
    },
    
    toggleUserSelection(userId) {
        if (this.selectedUsers.has(userId)) {
            this.selectedUsers.delete(userId);
        } else {
            this.selectedUsers.add(userId);
        }
    },
    
    selectAllUsers() {
        if (this.selectedUsers.size === this.users.length) {
            this.selectedUsers.clear();
        } else {
            this.selectedUsers.clear();
            this.users.forEach(user => this.selectedUsers.add(user.id));
        }
    },
    
    isUserSelected(userId) {
        return this.selectedUsers.has(userId);
    },
    
    showNotification(message, type = 'info') {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 animate-slide-up ${
            type === 'success' ? 'bg-green-500 text-white' :
            type === 'error' ? 'bg-red-500 text-white' :
            'bg-blue-500 text-white'
        }`;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        // Remove after 3 seconds
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }
};

// Theme management
window.ThemeManager = {
    currentTheme: localStorage.getItem('theme') || 'light',
    
    init() {
        this.applyTheme(this.currentTheme);
        this.updateThemeIcon();
    },
    
    toggleTheme() {
        this.currentTheme = this.currentTheme === 'light' ? 'dark' : 'light';
        this.applyTheme(this.currentTheme);
        this.updateThemeIcon();
        localStorage.setItem('theme', this.currentTheme);
    },
    
    applyTheme(theme) {
        if (theme === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    },
    
    updateThemeIcon() {
        const themeIcon = document.getElementById('theme-icon');
        if (themeIcon) {
            themeIcon.innerHTML = this.currentTheme === 'light' 
                ? '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path></svg>'
                : '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>';
        }
    }
};

// Language management
window.LanguageManager = {
    currentLanguage: localStorage.getItem('language') || 'en',
    translations: {
        en: {
            home: 'Home',
            users: 'Users',
            welcome: 'Welcome to the App',
            description: 'A modern Laravel application with Tailwind CSS and Alpine.js',
            getStarted: 'Get Started',
            addUser: 'Add User',
            editUser: 'Edit User',
            deleteUser: 'Delete User',
            bulkDelete: 'Bulk Delete',
            name: 'Name',
            email: 'Email',
            actions: 'Actions',
            selectAll: 'Select All',
            cancel: 'Cancel',
            save: 'Save',
            delete: 'Delete',
            confirm: 'Confirm',
            areYouSure: 'Are you sure you want to delete this user?',
            areYouSureBulk: 'Are you sure you want to delete selected users?',
            keyboardShortcuts: 'Keyboard Shortcuts',
            ctrlN: 'Ctrl+N - Add new user',
            ctrlE: 'Ctrl+E - Edit selected user',
            deleteKey: 'Delete - Delete selected user(s)',
            escape: 'Escape - Close modals'
        },
        es: {
            home: 'Inicio',
            users: 'Usuarios',
            welcome: 'Bienvenido a la App',
            description: 'Una aplicación Laravel moderna con Tailwind CSS y Alpine.js',
            getStarted: 'Comenzar',
            addUser: 'Agregar Usuario',
            editUser: 'Editar Usuario',
            deleteUser: 'Eliminar Usuario',
            bulkDelete: 'Eliminar Múltiples',
            name: 'Nombre',
            email: 'Correo',
            actions: 'Acciones',
            selectAll: 'Seleccionar Todo',
            cancel: 'Cancelar',
            save: 'Guardar',
            delete: 'Eliminar',
            confirm: 'Confirmar',
            areYouSure: '¿Estás seguro de que quieres eliminar este usuario?',
            areYouSureBulk: '¿Estás seguro de que quieres eliminar los usuarios seleccionados?',
            keyboardShortcuts: 'Atajos de Teclado',
            ctrlN: 'Ctrl+N - Agregar nuevo usuario',
            ctrlE: 'Ctrl+E - Editar usuario seleccionado',
            deleteKey: 'Suprimir - Eliminar usuario(s) seleccionado(s)',
            escape: 'Escape - Cerrar modales'
        }
    },
    
    init() {
        this.applyLanguage(this.currentLanguage);
    },
    
    toggleLanguage() {
        this.currentLanguage = this.currentLanguage === 'en' ? 'es' : 'en';
        this.applyLanguage(this.currentLanguage);
        localStorage.setItem('language', this.currentLanguage);
    },
    
    applyLanguage(language) {
        const elements = document.querySelectorAll('[data-translate]');
        elements.forEach(element => {
            const key = element.getAttribute('data-translate');
            if (this.translations[language] && this.translations[language][key]) {
                element.textContent = this.translations[language][key];
            }
        });
    },
    
    t(key) {
        return this.translations[this.currentLanguage][key] || key;
    }
};

// Initialize everything when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    ThemeManager.init();
    LanguageManager.init();
    
    // Initialize UserManager if we're on the users page
    if (document.getElementById('users-page')) {
        UserManager.init();
    }
});

// Start Alpine
Alpine.start();

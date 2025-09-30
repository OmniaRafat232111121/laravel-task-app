@extends('layouts.app')

@section('content')
<div id="users-page" x-data="UserManager" class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white" data-translate="users">Users</h1>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">
                        Manage your users with full CRUD operations and keyboard shortcuts
                    </p>
                </div>
                <div class="mt-4 sm:mt-0 flex flex-col sm:flex-row gap-3">
                    <button @click="openAddModal()" 
                            class="btn-primary inline-flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span data-translate="addUser">Add User</span>
                    </button>
                    <button @click="openBulkDeleteModal()" 
                            x-show="selectedUsers.size > 0"
                            class="btn-danger inline-flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        <span data-translate="bulkDelete">Bulk Delete</span>
                        <span class="ml-2 bg-red-700 text-white text-xs px-2 py-1 rounded-full" x-text="selectedUsers.size"></span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Users Table -->
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg overflow-hidden">
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-header">
                        <tr>
                            <th class="table-header-cell w-12">
                                <input type="checkbox" 
                                       @change="selectAllUsers()"
                                       :checked="selectedUsers.size === users.length && users.length > 0"
                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </th>
                            <th class="table-header-cell" data-translate="name">Name</th>
                            <th class="table-header-cell" data-translate="email">Email</th>
                            <th class="table-header-cell" data-translate="actions">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-body">
                        <template x-for="user in users" :key="user.id">
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150"
                                :class="{ 'bg-blue-50 dark:bg-blue-900': isUserSelected(user.id) }">
                                <td class="table-cell">
                                    <input type="checkbox" 
                                           :checked="isUserSelected(user.id)"
                                           @change="toggleUserSelection(user.id)"
                                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                </td>
                                <td class="table-cell font-medium" x-text="user.name"></td>
                                <td class="table-cell" x-text="user.email"></td>
                                <td class="table-cell">
                                    <div class="flex space-x-2">
                                        <button @click="editUser(user.id)" 
                                                class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition-colors duration-200"
                                                title="Edit User">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </button>
                                        <button @click="openDeleteModal(user.id)" 
                                                class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 transition-colors duration-200"
                                                title="Delete User">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </template>
                        <tr x-show="users.length === 0">
                            <td colspan="4" class="table-cell text-center text-gray-500 dark:text-gray-400 py-8">
                                No users found. <button @click="openAddModal()" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium">Add your first user</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Selection Info -->
        <div x-show="selectedUsers.size > 0" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform scale-95"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-95"
             class="mt-4 bg-blue-50 dark:bg-blue-900 border border-blue-200 dark:border-blue-700 rounded-lg p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-blue-800 dark:text-blue-200 font-medium">
                        <span x-text="selectedUsers.size"></span> user(s) selected
                    </span>
                </div>
                <button @click="selectedUsers.clear()" 
                        class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-sm font-medium">
                    Clear selection
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Add User Modal -->
<div x-show="showAddModal" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="modal-overlay" 
     @click.self="closeAllModals()">
    <div class="modal-content animate-slide-up">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white" data-translate="addUser">Add User</h3>
            <button @click="closeAllModals()" 
                    class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <form @submit.prevent="addUser()">
            <div class="mb-4">
                <label class="form-label" data-translate="name">Name</label>
                <input type="text" 
                       id="name-input"
                       x-model="newUser.name"
                       class="form-input" 
                       placeholder="Enter user name"
                       required>
            </div>
            
            <div class="mb-6">
                <label class="form-label" data-translate="email">Email</label>
                <input type="email" 
                       x-model="newUser.email"
                       class="form-input" 
                       placeholder="Enter user email"
                       required>
            </div>
            
            <div class="flex justify-end space-x-3">
                <button type="button" 
                        @click="closeAllModals()"
                        class="btn-secondary" 
                        data-translate="cancel">Cancel</button>
                <button type="submit" 
                        class="btn-primary" 
                        data-translate="save">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit User Modal -->
<div x-show="showEditModal" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="modal-overlay" 
     @click.self="closeAllModals()">
    <div class="modal-content animate-slide-up">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white" data-translate="editUser">Edit User</h3>
            <button @click="closeAllModals()" 
                    class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <form @submit.prevent="updateUser()">
            <div class="mb-4">
                <label class="form-label" data-translate="name">Name</label>
                <input type="text" 
                       id="edit-name-input"
                       x-model="editingUser.name"
                       class="form-input" 
                       placeholder="Enter user name"
                       required>
            </div>
            
            <div class="mb-6">
                <label class="form-label" data-translate="email">Email</label>
                <input type="email" 
                       x-model="editingUser.email"
                       class="form-input" 
                       placeholder="Enter user email"
                       required>
            </div>
            
            <div class="flex justify-end space-x-3">
                <button type="button" 
                        @click="closeAllModals()"
                        class="btn-secondary" 
                        data-translate="cancel">Cancel</button>
                <button type="submit" 
                        class="btn-primary" 
                        data-translate="save">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Delete User Modal -->
<div x-show="showDeleteModal" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="modal-overlay" 
     @click.self="closeAllModals()">
    <div class="modal-content animate-slide-up">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white" data-translate="deleteUser">Delete User</h3>
            <button @click="closeAllModals()" 
                    class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <div class="mb-6">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-red-100 dark:bg-red-900 rounded-full flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-gray-900 dark:text-white font-medium" x-text="editingUser?.name"></p>
                    <p class="text-gray-600 dark:text-gray-300 text-sm" x-text="editingUser?.email"></p>
                </div>
            </div>
            <p class="text-gray-600 dark:text-gray-300" data-translate="areYouSure">Are you sure you want to delete this user?</p>
        </div>
        
        <div class="flex justify-end space-x-3">
            <button @click="closeAllModals()"
                    class="btn-secondary" 
                    data-translate="cancel">Cancel</button>
            <button @click="deleteUser(editingUser?.id)"
                    class="btn-danger" 
                    data-translate="delete">Delete</button>
        </div>
    </div>
</div>

<!-- Bulk Delete Modal -->
<div x-show="showBulkDeleteModal" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="modal-overlay" 
     @click.self="closeAllModals()">
    <div class="modal-content animate-slide-up">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white" data-translate="bulkDelete">Bulk Delete</h3>
            <button @click="closeAllModals()" 
                    class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <div class="mb-6">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-red-100 dark:bg-red-900 rounded-full flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-gray-900 dark:text-white font-medium">
                        Delete <span x-text="selectedUsers.size"></span> selected users
                    </p>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">This action cannot be undone</p>
                </div>
            </div>
            <p class="text-gray-600 dark:text-gray-300" data-translate="areYouSureBulk">Are you sure you want to delete selected users?</p>
        </div>
        
        <div class="flex justify-end space-x-3">
            <button @click="closeAllModals()"
                    class="btn-secondary" 
                    data-translate="cancel">Cancel</button>
            <button @click="bulkDeleteUsers()"
                    class="btn-danger" 
                    data-translate="delete">Delete All</button>
        </div>
    </div>
</div>
@endsection

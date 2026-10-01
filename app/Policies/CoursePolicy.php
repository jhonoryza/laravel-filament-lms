<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Course;

class CoursePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->hasPermissionTo('view-any Course');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, Course $course): bool
    {
        return $admin->hasPermissionTo('view Course');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin): bool
    {
        return $admin->hasPermissionTo('create Course');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, Course $course): bool
    {
        return $admin->hasPermissionTo('update Course');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, Course $course): bool
    {
        return $admin->hasPermissionTo('delete Course');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $admin, Course $course): bool
    {
        return $admin->checkPermissionTo('{{ restorePermission }}');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $admin, Course $course): bool
    {
        return $admin->checkPermissionTo('{{ forceDeletePermission }}');
    }
}

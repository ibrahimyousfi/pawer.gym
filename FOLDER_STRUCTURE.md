# Project Folder Structure

## Views Organization

### Subscription Related Views (`resources/views/abn/`)
All subscription-related views are now organized in the `abn` folder:
- `abn/training_types/` - Training types management
  - `index.blade.php`
  - `create.blade.php`
  - `edit.blade.php`
  - `show.blade.php`
- `abn/plans/` - Subscription plans management
  - `create.blade.php`
  - `edit.blade.php`
- `abn/subscription_expired.blade.php` - Subscription expired page

### Admin Views (`resources/views/super_admin/`)
All admin-related views are in the `super_admin` folder:
- `super_admin/dashboard.blade.php` - Admin dashboard
- `super_admin/gyms/` - Gym management
  - `index.blade.php`
  - `create.blade.php`
  - `edit.blade.php`
  - `show.blade.php`
- `super_admin/users/` - User management
  - `index.blade.php`
- `super_admin/reports/` - Reports
  - `index.blade.php`

### Other Views
- `members/` - Member management
- `dashboard.blade.php` - Main dashboard
- `layouts/` - Layout files
- `components/` - Reusable components
- `auth/` - Authentication views
- `profile/` - User profile views

## Controller Updates

### TrainingTypeController
- Updated to use `abn.training_types.*` views

### PlanController
- Updated to use `abn.plans.*` views

### SuperAdminController
- Uses `super_admin.*` views (already correct)

## Routes

### Admin Routes (`routes/admin.php`)
- All admin routes use `/admin` prefix
- Route names: `admin.*`

### Main Routes (`routes/web.php`)
- Subscription expired route uses `abn.subscription_expired` view

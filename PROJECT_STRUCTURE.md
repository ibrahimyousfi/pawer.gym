# Project Structure Documentation

## 📁 Application Structure

### Controllers (`app/Http/Controllers/`)
- **DashboardController.php** - Main dashboard statistics
- **MemberController.php** - Member CRUD operations
- **TrainingTypeController.php** - Subscription types management
- **PlanController.php** - Subscription plans management

### Models (`app/Models/`)
- **Member.php** - Member/Subscriber model
- **Subscription.php** - Subscription model
- **Plan.php** - Subscription plan model
- **TrainingType.php** - Subscription type/category model
- **User.php** - User authentication model

### Views Structure (`resources/views/`)

#### Layouts (`layouts/`)
- **app.blade.php** - Main application layout
- **header.blade.php** - Page header component (separated)
- **navigation.blade.php** - Sidebar navigation

#### Components (`components/`)
- **page-header.blade.php** - Reusable page header component
- **stat-card.blade.php** - Statistics card component
- **status-badge.blade.php** - Status badge component
- **alert.blade.php** - Alert/notification component

#### Main Views
- **dashboard.blade.php** - Main dashboard
- **members/** - Member management views
  - `index.blade.php` - Members list with search & filters
  - `create.blade.php` - Add new member
  - `edit.blade.php` - Edit member
  - `show.blade.php` - Member details
  - `renew.blade.php` - Renew subscription

#### Subscription Views (`abn/`)
- **training_types/** - Subscription types
  - `index.blade.php` - Types list with search
  - `create.blade.php` - Create type
  - `edit.blade.php` - Edit type
  - `show.blade.php` - Type details with plans
- **plans/** - Subscription plans
  - `create.blade.php` - Create plan
  - `edit.blade.php` - Edit plan

## 🎨 Page Header System

### How It Works
1. **Header File**: `resources/views/layouts/header.blade.php`
   - Separate file for header logic
   - Included in `app.blade.php`

2. **Component**: `resources/views/components/page-header.blade.php`
   - Reusable header component
   - Supports: title, subtitle, action button, search, filters

3. **Controller Setup**:
   ```php
   return view('page.name', compact('data'))
       ->with('pageTitle', 'Page Title')           // Required: Page name (right side)
       ->with('pageSubtitle', 'Subtitle')          // Optional: Subtitle
       ->with('pageActionUrl', route('...'))        // Optional: Action button URL
       ->with('pageActionLabel', 'Add New')        // Optional: Action button label
       ->with('pageShowAction', true)              // Optional: Show action button
       ->with('pageSearchRoute', route('...'))     // Optional: Search route
       ->with('pageSearchPlaceholder', 'Search...') // Optional: Search placeholder
       ->with('pageShowSearch', true)              // Optional: Show search bar
       ->with('pageFilters', $filters);            // Optional: Filter buttons
   ```

### Header Layout
- **Right Side**: Page title (always visible)
- **Left Side**: Action button with border (if `pageShowAction` is true)
- **Center**: Search bar and filters (if `pageShowSearch` is true)

## 🔍 Search & Filter System

### Members Index
- Search by: name, CIN, phone
- Filters: All, Active, Expired, Inactive + Training Types

### Training Types Index
- Search by: name, description

## 📋 Best Practices

### Adding a New Page
1. Create view in appropriate folder
2. In controller, always set `pageTitle`
3. Optionally add search, filters, or action button
4. Use components for repetitive UI elements

### Component Usage
- Use `<x-page-header>` via controller data
- Use `<x-stat-card>` for statistics
- Use `<x-status-badge>` for status indicators
- Use `<x-alert>` for notifications

## 🚀 SaaS Architecture (Future)

### Current State
- Single-tenant application
- Global data (no tenant isolation)

### Future Multi-Tenant Structure
```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Tenant/          # Tenant-specific controllers
│   │   └── Admin/           # Admin controllers
│   └── Middleware/
│       └── EnsureTenantIsActive.php
├── Models/
│   ├── Tenant.php           # Tenant model
│   └── ... (with tenant_id)
└── Services/
    └── TenantService.php    # Tenant management service
```

## 📝 Notes
- All views use English (no Arabic/French)
- No Bootstrap (Tailwind CSS only)
- Minimal JavaScript (Alpine.js when needed)
- Reusable components for consistency

# 📋 Project Organization - Subscription Management SaaS

## 🎯 Project Overview
General subscription management system (SaaS-ready) for managing subscriptions of any type (gyms, pools, support, etc.)

## 📁 Directory Structure

### Controllers (`app/Http/Controllers/`)
```
app/Http/Controllers/
├── Auth/                    # Authentication controllers
│   ├── AuthenticatedSessionController.php
│   ├── RegisteredUserController.php
│   └── ...
├── DashboardController.php  # Main dashboard
├── MemberController.php     # Member/Subscriber management
├── PlanController.php       # Subscription plans
├── TrainingTypeController.php # Subscription types/categories
└── ProfileController.php    # User profile
```

### Models (`app/Models/`)
```
app/Models/
├── Member.php          # Subscriber/Member model
├── Subscription.php    # Subscription model
├── Plan.php           # Subscription plan model
├── TrainingType.php   # Subscription type/category model
└── User.php           # User authentication model
```

### Views (`resources/views/`)

#### Layouts
```
resources/views/layouts/
├── app.blade.php      # Main application layout
├── header.blade.php   # Page header (separated)
├── navigation.blade.php # Sidebar navigation
└── guest.blade.php    # Guest layout
```

#### Components
```
resources/views/components/
├── page-header.blade.php  # Reusable page header
├── stat-card.blade.php   # Statistics card
├── status-badge.blade.php # Status badge
└── alert.blade.php       # Alert/notification
```

#### Main Views
```
resources/views/
├── dashboard.blade.php           # Main dashboard
├── members/                      # Member management
│   ├── index.blade.php          # List with search & filters
│   ├── create.blade.php         # Add new member
│   ├── edit.blade.php           # Edit member
│   ├── show.blade.php           # Member details
│   └── renew.blade.php          # Renew subscription
└── abn/                         # Subscription management
    ├── training_types/          # Subscription types
    │   ├── index.blade.php
    │   ├── create.blade.php
    │   ├── edit.blade.php
    │   └── show.blade.php
    └── plans/                   # Subscription plans
        ├── create.blade.php
        └── edit.blade.php
```

### Routes (`routes/`)
```
routes/
├── web.php      # Main application routes
├── auth.php     # Authentication routes
└── console.php  # Console commands
```

## 🎨 Design System

### Typography
- **Font**: Inter (single font family)
- **Weights**: 400, 500, 600, 700
- **Usage**: Consistent across all pages

### Color Palette
- **Primary**: Orange (600, 700)
- **Background**: Zinc (950, 900, 800)
- **Text**: White, Zinc (300, 400, 500)
- **Status Colors**:
  - Active: Emerald
  - Expired: Red
  - Inactive: Zinc

### Components
1. **PageHeader**: Dynamic header with title, action button, search, filters
2. **StatCard**: Statistics display card
3. **StatusBadge**: Status indicator badge
4. **Alert**: Success/error/warning notifications

## 🔧 Configuration

### Tailwind Config
- Font: Inter
- Colors: Custom zinc palette
- Forms plugin enabled

### Laravel Config
- Single-tenant (ready for multi-tenant upgrade)
- File storage: `uploads` disk
- Pagination: 10 items per page

## 📝 Code Standards

### Controllers
- Always set `pageTitle` for views
- Use `->with()` for page header data
- Implement search and filters in index methods
- Use transactions for complex operations

### Views
- Use Blade components for reusable UI
- English only (no Arabic/French)
- Tailwind CSS only (no Bootstrap)
- Minimal JavaScript (Alpine.js when needed)

### Models
- Use Eloquent relationships
- Implement scopes for common queries
- Use accessors for computed attributes

## 🚀 Features

### Current Features
- ✅ Member/Subscriber management
- ✅ Subscription types & plans
- ✅ Search & filtering
- ✅ Dynamic page headers
- ✅ Responsive design
- ✅ File uploads (member photos)

### Future Enhancements
- Multi-tenant support
- Advanced reporting
- Email notifications
- Payment integration
- API endpoints

## 📊 Database Structure

### Core Tables
- `members` - Subscribers
- `subscriptions` - Active subscriptions
- `plans` - Subscription plans
- `training_types` - Subscription categories
- `users` - System users

### Relationships
- Member → Subscriptions (1:N)
- Subscription → Plan (N:1)
- Plan → TrainingType (N:1)
- TrainingType → Plans (1:N)

## 🔐 Security

### Authentication
- Laravel Breeze
- Email verification
- Password reset

### Authorization
- Middleware: `auth`, `verified`
- Future: Role-based access control

## 📦 Dependencies

### Backend
- Laravel 12
- PHP 8.2+

### Frontend
- Tailwind CSS
- Alpine.js (minimal)
- Inter font

## 🎯 Best Practices

1. **Always set pageTitle** in controllers
2. **Use components** for repetitive UI
3. **Implement search** in index pages
4. **Use transactions** for data integrity
5. **Follow naming conventions**
6. **Keep views clean** and organized
7. **Document complex logic**

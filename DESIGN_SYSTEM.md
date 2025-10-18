# 🎨 Design System Documentation

## Overview

This design system provides a unified set of components, patterns, and guidelines for the Student Monitoring System. It ensures consistency, accessibility, and maintainability across all user interfaces.

## 🎯 Design Principles

### 1. **Consistency**
- Unified visual language across all components
- Consistent spacing, typography, and color usage
- Standardized interaction patterns

### 2. **Accessibility**
- WCAG 2.1 AA compliance
- Keyboard navigation support
- Screen reader compatibility
- High contrast mode support

### 3. **Performance**
- Optimized component loading
- Minimal bundle size impact
- Efficient rendering

### 4. **Maintainability**
- Modular component architecture
- Clear API documentation
- Easy customization and theming

## 🎨 Design Tokens

### Colors

#### Primary Colors
```scss
--color-primary-50: #eff6ff;
--color-primary-100: #dbeafe;
--color-primary-200: #bfdbfe;
--color-primary-300: #93c5fd;
--color-primary-400: #60a5fa;
--color-primary-500: #3b82f6;
--color-primary-600: #2563eb;  // Main brand color
--color-primary-700: #1d4ed8;
--color-primary-800: #1e40af;
--color-primary-900: #1e3a8a;
```

#### Semantic Colors
```scss
--color-success: #16a34a;    // Success states
--color-warning: #d97706;    // Warning states
--color-danger: #dc2626;     // Error states
--color-info: #0284c7;       // Information states
```

### Typography

#### Font Families
```scss
--font-family-sans: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
--font-family-mono: 'SF Mono', Monaco, 'Cascadia Code', 'Roboto Mono', Consolas, 'Courier New', monospace;
```

#### Font Sizes
```scss
--font-size-xs: 0.75rem;     // 12px
--font-size-sm: 0.875rem;    // 14px
--font-size-base: 1rem;      // 16px
--font-size-lg: 1.125rem;    // 18px
--font-size-xl: 1.25rem;     // 20px
--font-size-2xl: 1.5rem;     // 24px
--font-size-3xl: 1.875rem;   // 30px
--font-size-4xl: 2.25rem;    // 36px
```

#### Font Weights
```scss
--font-weight-light: 300;
--font-weight-normal: 400;
--font-weight-medium: 500;
--font-weight-semibold: 600;
--font-weight-bold: 700;
```

### Spacing

```scss
--space-1: 0.25rem;   // 4px
--space-2: 0.5rem;    // 8px
--space-3: 0.75rem;   // 12px
--space-4: 1rem;      // 16px
--space-5: 1.25rem;   // 20px
--space-6: 1.5rem;    // 24px
--space-8: 2rem;      // 32px
--space-10: 2.5rem;   // 40px
--space-12: 3rem;     // 48px
```

### Border Radius

```scss
--radius-sm: 0.125rem;   // 2px
--radius-base: 0.25rem;  // 4px
--radius-md: 0.375rem;   // 6px
--radius-lg: 0.5rem;     // 8px
--radius-xl: 0.75rem;    // 12px
--radius-2xl: 1rem;      // 16px
```

### Shadows

```scss
--shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
--shadow-base: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
--shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
--shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
```

## 🧩 Component Library

### 1. Statistics Cards

Statistics cards display key metrics with icons, values, and optional progress indicators.

#### Usage

**JavaScript:**
```javascript
// Create a stat card
componentSystem.createStatCard({
  id: 'total-students',
  icon: 'icon-students',
  value: 1250,
  label: 'Total Students',
  color: 'primary',
  badge: 'Current',
  progress: 85,
  decimals: 0
}, '#stat-container');
```

**PHP:**
```php
<?php
use App\Helpers\ComponentHelper;

echo ComponentHelper::statCard([
    'id' => 'total-students',
    'icon' => 'icon-students',
    'value' => 1250,
    'label' => 'Total Students',
    'color' => 'primary',
    'badge' => 'Current',
    'progress' => 85,
    'decimals' => 0
]);
?>
```

#### Properties

| Property | Type | Default | Description |
|----------|------|---------|-------------|
| `id` | string | auto-generated | Unique identifier |
| `icon` | string | 'icon-chart' | SVG icon reference |
| `value` | number | 0 | Main value to display |
| `label` | string | 'Label' | Descriptive label |
| `color` | string | 'primary' | Color theme (primary, success, warning, danger, info) |
| `badge` | string | null | Optional badge text |
| `progress` | number | null | Progress percentage (0-100) |
| `decimals` | number | 0 | Decimal places for value |

### 2. Action Cards

Action cards provide quick access to common actions or navigation.

#### Usage

**JavaScript:**
```javascript
componentSystem.createActionCard({
  id: 'quick-grade',
  title: 'Mathematics',
  subtitle: 'Overall: 87.5',
  icon: 'icon-chart',
  color: 'success',
  badge: 'Passed',
  progress: 87.5,
  meta: 'WW: 85 | PT: 88 | QE: 90',
  onclick: 'openGradeModal("math")'
}, '#action-container');
```

**PHP:**
```php
echo ComponentHelper::actionCard([
    'id' => 'quick-grade',
    'title' => 'Mathematics',
    'subtitle' => 'Overall: 87.5',
    'icon' => 'icon-chart',
    'color' => 'success',
    'badge' => 'Passed',
    'progress' => 87.5,
    'meta' => 'WW: 85 | PT: 88 | QE: 90',
    'onclick' => 'openGradeModal("math")'
]);
```

#### Properties

| Property | Type | Default | Description |
|----------|------|---------|-------------|
| `id` | string | auto-generated | Unique identifier |
| `title` | string | 'Title' | Main title |
| `subtitle` | string | '' | Subtitle text |
| `icon` | string | 'icon-plus' | SVG icon reference |
| `color` | string | 'primary' | Color theme |
| `badge` | string | null | Optional badge text |
| `progress` | number | null | Progress percentage |
| `meta` | string | null | Additional metadata |
| `onclick` | string | null | Click handler |

### 3. Form Fields

Standardized form input components with validation and accessibility features.

#### Usage

**JavaScript:**
```javascript
componentSystem.createFormField({
  id: 'student-name',
  name: 'name',
  label: 'Student Name',
  type: 'text',
  placeholder: 'Enter student name',
  required: true,
  help: 'Enter the full name as it appears on official documents'
}, '#form-container');
```

**PHP:**
```php
echo ComponentHelper::formField([
    'id' => 'student-name',
    'name' => 'name',
    'label' => 'Student Name',
    'type' => 'text',
    'placeholder' => 'Enter student name',
    'required' => true,
    'help' => 'Enter the full name as it appears on official documents'
]);
```

#### Supported Types

- `text` - Text input
- `email` - Email input
- `password` - Password input with toggle
- `number` - Number input
- `tel` - Phone number input
- `date` - Date picker
- `time` - Time picker
- `datetime-local` - Date and time picker
- `select` - Dropdown select
- `textarea` - Multi-line text
- `checkbox` - Checkbox input
- `radio` - Radio button input
- `file` - File upload

#### Properties

| Property | Type | Default | Description |
|----------|------|---------|-------------|
| `id` | string | auto-generated | Unique identifier |
| `name` | string | same as id | Form field name |
| `label` | string | 'Label' | Field label |
| `type` | string | 'text' | Input type |
| `placeholder` | string | '' | Placeholder text |
| `value` | string | '' | Default value |
| `required` | boolean | false | Required field |
| `readonly` | boolean | false | Read-only field |
| `help` | string | '' | Help text |
| `validation` | string | '' | Validation message |
| `options` | array | [] | Options for select/radio |

### 4. Alerts

Contextual feedback messages for user actions.

#### Usage

**JavaScript:**
```javascript
// Show notification
componentSystem.showNotification('Student created successfully!', 'success', 3000);

// Create alert
componentSystem.createAlert({
  id: 'form-error',
  type: 'danger',
  message: 'Please correct the errors below.',
  dismissible: true
}, '#alert-container');
```

**PHP:**
```php
echo ComponentHelper::alert([
    'id' => 'form-error',
    'type' => 'danger',
    'message' => 'Please correct the errors below.',
    'dismissible' => true
]);
```

#### Alert Types

- `success` - Success messages (green)
- `danger` - Error messages (red)
- `warning` - Warning messages (yellow)
- `info` - Information messages (blue)

#### Properties

| Property | Type | Default | Description |
|----------|------|---------|-------------|
| `id` | string | auto-generated | Unique identifier |
| `type` | string | 'info' | Alert type |
| `message` | string | '' | Alert message |
| `dismissible` | boolean | false | Can be dismissed |
| `icon` | string | auto | Custom icon |

### 5. Modals

Modal dialogs for forms, confirmations, and detailed content.

#### Usage

**JavaScript:**
```javascript
componentSystem.createModal({
  id: 'student-modal',
  title: 'Add New Student',
  size: 'lg',
  content: '<form>...</form>',
  footer: `
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
    <button type="button" class="btn btn-primary">Save Student</button>
  `
});
```

**PHP:**
```php
echo ComponentHelper::modal([
    'id' => 'student-modal',
    'title' => 'Add New Student',
    'size' => 'lg',
    'content' => '<form>...</form>',
    'footer' => '
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Save Student</button>
    '
]);
```

#### Modal Sizes

- `sm` - Small modal
- `md` - Medium modal (default)
- `lg` - Large modal
- `xl` - Extra large modal

#### Properties

| Property | Type | Default | Description |
|----------|------|---------|-------------|
| `id` | string | auto-generated | Unique identifier |
| `title` | string | 'Modal Title' | Modal title |
| `content` | string | '' | Modal body content |
| `size` | string | '' | Modal size |
| `footer` | string | '' | Modal footer content |

### 6. Tables

Data tables with sorting and responsive design.

#### Usage

**JavaScript:**
```javascript
componentSystem.createTable({
  columns: [
    { key: 'name', label: 'Name' },
    { key: 'grade', label: 'Grade' },
    { key: 'status', label: 'Status' }
  ],
  rows: [
    { name: 'John Doe', grade: 'A', status: 'Active' },
    { name: 'Jane Smith', grade: 'B', status: 'Active' }
  ]
}, '#table-container');
```

**PHP:**
```php
echo ComponentHelper::table([
    'columns' => [
        ['key' => 'name', 'label' => 'Name'],
        ['key' => 'grade', 'label' => 'Grade'],
        ['key' => 'status', 'label' => 'Status']
    ],
    'rows' => [
        ['name' => 'John Doe', 'grade' => 'A', 'status' => 'Active'],
        ['name' => 'Jane Smith', 'grade' => 'B', 'status' => 'Active']
    ]
]);
```

#### Properties

| Property | Type | Default | Description |
|----------|------|---------|-------------|
| `columns` | array | [] | Column definitions |
| `rows` | array | [] | Table data |

## 🎨 Color Themes

### Primary Theme
```scss
--color-primary: #2563eb;
--color-primary-subtle: #dbeafe;
--color-primary-text: #1e40af;
```

### Success Theme
```scss
--color-success: #16a34a;
--color-success-subtle: #dcfce7;
--color-success-text: #15803d;
```

### Warning Theme
```scss
--color-warning: #d97706;
--color-warning-subtle: #fef3c7;
--color-warning-text: #b45309;
```

### Danger Theme
```scss
--color-danger: #dc2626;
--color-danger-subtle: #fee2e2;
--color-danger-text: #b91c1c;
```

## 🌙 Dark Mode Support

All components automatically adapt to dark mode using CSS custom properties:

```scss
[data-theme="dark"] {
  --color-bg: #121212;
  --color-text: #ffffff;
  --color-surface: #282828;
  --color-border: #3f3f3f;
}
```

## 📱 Responsive Design

Components are built mobile-first and adapt to different screen sizes:

- **Mobile**: < 768px
- **Tablet**: 768px - 1024px
- **Desktop**: > 1024px

### Breakpoints
```scss
--breakpoint-sm: 576px;
--breakpoint-md: 768px;
--breakpoint-lg: 992px;
--breakpoint-xl: 1200px;
--breakpoint-2xl: 1400px;
```

## ♿ Accessibility Features

### Keyboard Navigation
- All interactive elements are keyboard accessible
- Tab order follows logical flow
- Focus indicators are clearly visible

### Screen Reader Support
- Semantic HTML structure
- ARIA labels and descriptions
- Live regions for dynamic content

### Color Contrast
- Minimum 4.5:1 contrast ratio for normal text
- Minimum 3:1 contrast ratio for large text
- High contrast mode support

## 🚀 Performance Considerations

### Lazy Loading
- Components load on-demand
- Images use lazy loading
- Charts initialize when visible

### Bundle Optimization
- Tree-shaking removes unused code
- Code splitting reduces initial load
- Critical CSS is inlined

## 🔧 Customization

### CSS Custom Properties
Override design tokens to customize the appearance:

```css
:root {
  --color-primary: #your-brand-color;
  --font-family-sans: 'Your Font', sans-serif;
  --border-radius: 8px;
}
```

### Component Variants
Create custom variants by extending base components:

```javascript
// Custom stat card variant
componentSystem.createStatCard({
  ...baseConfig,
  customClass: 'my-custom-card',
  customStyles: 'background: linear-gradient(45deg, #ff6b6b, #4ecdc4);'
});
```

## 📚 Usage Examples

### Dashboard Layout
```php
<div class="row g-4">
  <div class="col-md-6 col-lg-3">
    <?= ComponentHelper::statCard([
        'icon' => 'icon-students',
        'value' => 1250,
        'label' => 'Total Students',
        'color' => 'primary',
        'progress' => 85
    ]) ?>
  </div>
  <!-- More stat cards... -->
</div>
```

### Form Layout
```php
<form>
  <?= ComponentHelper::formField([
      'id' => 'student-name',
      'label' => 'Student Name',
      'type' => 'text',
      'required' => true
  ]) ?>
  
  <?= ComponentHelper::formField([
      'id' => 'student-email',
      'label' => 'Email Address',
      'type' => 'email',
      'required' => true
  ]) ?>
  
  <button type="submit" class="btn btn-primary">Save Student</button>
</form>
```

### Error Handling
```php
<?php if ($errors): ?>
  <?= ComponentHelper::alert([
      'type' => 'danger',
      'message' => 'Please correct the following errors:',
      'dismissible' => false
  ]) ?>
<?php endif; ?>
```

## 🧪 Testing

### Component Testing
Each component includes automated tests for:
- Rendering accuracy
- Interaction behavior
- Accessibility compliance
- Responsive design

### Visual Regression Testing
Screenshots are captured for each component state to ensure visual consistency.

## 📖 Migration Guide

### From Legacy Components
1. Replace custom card implementations with `ComponentHelper::statCard()`
2. Standardize form fields using `ComponentHelper::formField()`
3. Convert custom alerts to `ComponentHelper::alert()`
4. Update modal implementations to use `ComponentHelper::modal()`

### Breaking Changes
- Component APIs are versioned
- Deprecated methods are marked with warnings
- Migration scripts are provided for major updates

## 🤝 Contributing

### Adding New Components
1. Create component template in `ComponentSystem.js`
2. Add PHP helper method in `ComponentHelper.php`
3. Document component in this file
4. Add tests and examples

### Component Guidelines
- Follow existing naming conventions
- Ensure accessibility compliance
- Include responsive design
- Add dark mode support
- Document all properties

---

**Last Updated**: October 2024  
**Version**: 1.0.0  
**Maintainer**: Student Monitoring System Team

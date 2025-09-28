# Dashboard Includes

This directory contains reusable Blade components for the dashboard.

## Files

### 1. `alerts.blade.php`
Main alerts include file that handles all flash messages and validation errors.

**Usage:**
```blade
@include('dashboard.includes.alerts')
```

**Features:**
- Success messages (green)
- Error messages (red)
- Warning messages (orange)
- Info messages (blue)
- Validation errors
- Auto-hide functionality
- Dismissible alerts

### 2. `alert-scripts.blade.php`
JavaScript file for enhanced alert functionality.

**Features:**
- Smooth animations
- Auto-hide timers
- Close button functionality
- Fade-in/fade-out effects

### 3. `messages.blade.php`
Alternative messages include with "Success:", "Error:" labels.

**Usage:**
```blade
@include('dashboard.includes.messages')
```

## Flash Message Types

### Success Messages
```php
return redirect()->back()->with('success', 'Operation completed successfully!');
```

### Error Messages
```php
return redirect()->back()->with('error', 'Something went wrong!');
```

### Warning Messages
```php
return redirect()->back()->with('warning', 'Please check your input!');
```

### Info Messages
```php
return redirect()->back()->with('info', 'Additional information here!');
```

## Auto-Hide Timers
- Success messages: 5 seconds
- Info messages: 7 seconds
- Error and Warning messages: Manual close only

## Styling
All alerts use Bootstrap 4 classes with custom styling:
- `alert-success` - Green background
- `alert-danger` - Red background
- `alert-warning` - Orange background
- `alert-info` - Blue background

## Icons
- Success: `ft-check-circle`
- Error: `ft-alert-circle`
- Warning: `ft-alert-triangle`
- Info: `ft-info`

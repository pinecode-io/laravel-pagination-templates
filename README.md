# laravel-pagination-templates
Quick start HTML templates for Laravel pagination. There are a handful of templates available for various CSS frameworks.

## Getting Started
Copy the template for your preferred CSS framework into your views diretory.
Initialize the pagination html with:
```php
@if($logs->lastPage() > 1)
  @include('pagination.numbered', ['paginator' => $logs, 'tabs' => 3])
@endif
```

If you want to display even if there is only 1 page, remove the if condition:
```php
@include('pagination.numbered', ['paginator' => $logs, 'tabs' => 3])
```

You can control the amount of tabs displayed by changeing the 'tabs' value.

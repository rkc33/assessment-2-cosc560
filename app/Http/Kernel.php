protected $routeMiddleware = [
    // existing...
    'admin' => \App\Http\Middleware\AdminOnly::class,
];

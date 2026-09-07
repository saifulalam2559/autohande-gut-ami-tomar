<?php //

namespace App\Http\Middleware;

use Closure;

class ContentSecurityPolicy
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Updated CSP to allow necessary resources for PayPal
        $csp = "default-src 'self'; "
            . "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://js.stripe.com https://www.paypal.com https://ajax.googleapis.com https://cdnjs.cloudflare.com https://stackpath.bootstrapcdn.com https://code.jquery.com https://cdn.jsdelivr.net https://www.google-analytics.com https://www.googletagmanager.com https://www.gstatic.com https://www.google.com; "
            . "style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://code.jquery.com https://cdnjs.cloudflare.com https://stackpath.bootstrapcdn.com https://fonts.googleapis.com; "
            . "font-src 'self' data: https://fonts.gstatic.com https://cdnjs.cloudflare.com; " // Allow data URIs for fonts
             . "img-src 'self' data: https://www.paypalobjects.com https://www.google-analytics.com; " // Allow PayPal images and Google Analytics images
            . "connect-src 'self' https://www.paypal.com https://www.sandbox.paypal.com https://www.google-analytics.com https://region1.google-analytics.com https://www.googletagmanager.com https://www.google.com; " // Allow Google Analytics and PayPal connections
            . "frame-src 'self' https://js.stripe.com https://www.paypal.com https://www.sandbox.paypal.com https://www.google.com https://www.gstatic.com; " // Allows Stripe and PayPal in iframes
            . "object-src 'none'; "
            . "frame-ancestors 'self'; "
            . "report-uri /admin/csp-report-endpoint;";

        // Set CSP header
        $response->headers->set('Content-Security-Policy', $csp);

        // Report-To header for reporting CSP violations
        $reportTo = json_encode([
            'group' => 'csp-endpoint',
            'max_age' => 31536000,
            'endpoints' => [
                ['url' => '/admin/csp-report-endpoint']
            ],
            'include_subdomains' => true
        ]);
        $response->headers->set('Report-To', $reportTo);

        return $response;
    }
}

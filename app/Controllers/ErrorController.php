<?php

namespace Controllers;

use Core\Controller;
use Core\View;

class ErrorController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display 404 Not Found page
     */
    public function notFound(): void
    {
        // Don't set HTTP status code for error pages - we want them to be accessible
        $this->view->render('errors/404', [
            'title' => '404 - Page Not Found'
        ]);
    }

    /**
     * Display 403 Forbidden page
     */
    public function forbidden(): void
    {
        // Don't set HTTP status code for error pages - we want them to be accessible
        $this->view->render('errors/403', [
            'title' => '403 - Access Forbidden'
        ]);
    }

    /**
     * Display 500 Internal Server Error page
     */
    public function internalServerError(): void
    {
        // Don't set HTTP status code for error pages - we want them to be accessible
        $this->view->render('errors/500', [
            'title' => '500 - Internal Server Error'
        ]);
    }

    /**
     * Display 401 Unauthorized page
     */
    public function unauthorized(): void
    {
        // Don't set HTTP status code for error pages - we want them to be accessible
        $this->view->render('errors/401', [
            'title' => '401 - Unauthorized Access'
        ]);
    }

    /**
     * Display 503 Service Unavailable page
     */
    public function serviceUnavailable(): void
    {
        // Don't set HTTP status code for error pages - we want them to be accessible
        $this->view->render('errors/503', [
            'title' => '503 - Service Unavailable'
        ]);
    }

    /**
     * Generic error handler
     */
    public function error(int $code = 500, string $message = 'An error occurred'): void
    {
        // Don't set HTTP status code for error pages - we want them to be accessible
        
        // Get custom message from URL parameter if provided
        $customMessage = $_GET['message'] ?? '';
        if ($customMessage) {
            $message = $customMessage;
        }
        
        $errorData = [
            'title' => "{$code} - Error",
            'errorCode' => $code,
            'errorMessage' => $message
        ];

        // Choose appropriate error page based on code
        switch ($code) {
            case 404:
                $this->view->render('errors/404', $errorData);
                break;
            case 403:
                $this->view->render('errors/403', $errorData);
                break;
            case 401:
                $this->view->render('errors/401', $errorData);
                break;
            case 503:
                $this->view->render('errors/503', $errorData);
                break;
            default:
                $this->view->render('errors/500', $errorData);
                break;
        }
    }
}

<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DocumentPriveController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $file): BinaryFileResponse 
    {

        if (!file_exists(storage_path('app/private/' . $file))) {
            abort(404);
        }
        
        return response()->download(storage_path('app/private/' . $file));
    }
}

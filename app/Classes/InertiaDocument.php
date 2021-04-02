<?php
/**
 * Created by PhpStorm.
 * User: AQSSA
 */

namespace App\Classes;


use Inertia\Inertia;

class InertiaDocument
{
    public function setTitle($title) {
        Inertia::share('pageTitle', $title);
        return $this;
    }

    public function setDescription($description) {
        Inertia::share('pageDescription', $description);
        return $this;
    }

    public function setKeywords($keywords) {
        Inertia::share('pageKeywords', $keywords);
        return $this;
    }
}

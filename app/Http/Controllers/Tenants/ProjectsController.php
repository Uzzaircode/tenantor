<?php

namespace App\Http\Controllers\Tenants;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;

class ProjectsController extends Controller
{
    
    public function index(){

        $projects = Project::get();

        return view('tenants.projects.index', compact('projects'));
    }
}
